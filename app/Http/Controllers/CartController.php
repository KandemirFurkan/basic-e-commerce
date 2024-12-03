<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Coupon;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {

        $cartItem = $this->sepetList();

        $seolists = metaolustur('sepet');

        $seo = [
            'title' =>  $seolists['title'] ?? '',
            'description' => $seolists['description'] ?? '',
            'keywords' => $seolists['keywords'] ?? '',
            'image' => asset('img/page-bg.jpg'),
            'url'=>  $seolists['currenturl'],
            'canonical'=> $seolists['trpage'],
            'robots' => 'noindex, follow',
        ];

        $breadcrumb = [
            'sayfalar' => [

            ],
            'active'=> 'Sepet'
        ];




        return view('frontend.pages.cart',compact('seo','breadcrumb','cartItem'));
    }


    public function sepetform() {

        $cartItem = $this->sepetList();



        $seolists = metaolustur('sepet');

        $seo = [
            'title' =>  $seolists['title'] ?? '',
            'description' => $seolists['description'] ?? '',
            'keywords' => $seolists['keywords'] ?? '',
            'image' => asset('img/page-bg.jpg'),
            'url'=>  $seolists['currenturl'],
            'canonical'=> $seolists['trpage'],
            'robots' => 'noindex, follow',
        ];

        $breadcrumb = [
            'sayfalar' => [

            ],
            'active'=> 'Sepet'
        ];




        return view('frontend.pages.cartform',compact('seo','breadcrumb','cartItem'));
    }


    public function sepetList() {
        $cartItem = session()->get('cart') ?? [];
        $totalPrice = 0;
        foreach ($cartItem as $cart) {
            $kdvOrani = $cart['kdv'] ?? 0;
            $kdvtutar = ($cart['price'] * $cart['qty']) * ($kdvOrani / 100);
            $toplamTutar = $cart['price'] * $cart['qty'] + $kdvtutar;
            $totalPrice +=  $toplamTutar;
        }
        if (session()->get('coupon_code') && $totalPrice != 0) {
            $kupon = Coupon::where('name',session()->get('coupon_code'))->where('status','1')->first();
            $kuponprice = $kupon->price ?? 0;
            $newtotalPrice = $totalPrice - $kuponprice;
        }else {
            $newtotalPrice = $totalPrice;
        }

        session()->put('total_price',$newtotalPrice);

        if(count(session()->get('cart')) == 0) {
            session()->forget('coupon_code');
            session()->forget('coupon_price');

        }

        return  $cartItem;
    }

    public function add(Request $request) {
        $productID=sifrecoz($request->product_id);
        $qty=$request->qty ?? 1;
        $size=$request->size;

        $urun= Product::find($productID);
        if(!$urun){
            return back()->withErrors('Ürün bulunamadı.');
        }
        $cartItem = session('cart',[]);

        if(!empty($request->coupon_code) && $request->coupon_code == 'tumurun') {
            $kupon = Coupon::where('name',$request->coupon_code)->where('status','1')->first();

            $kuponprice =   1 - ($kupon->discount_rate /100);

            session()->put('coupon_code',$request->coupon_code);

        }else {
            $kuponprice = 1;
        }


        $sizeExists = false;

        foreach ($cartItem as $key => $item) {
            if ($item['productID'] == $productID && $item['size'] == $size) {
                $cartItem[$key]['qty'] += $qty;
                $sizeExists = true;
                break;
            }
        }

        if (!$sizeExists) {
            $cartItem[] = [
                'productID' => $productID,
                'image' => $urun->image,
                'name' => $urun->name,
                'price' => $urun->price / $kuponprice,
                'qty' => $qty,
                'kdv' => $urun->kdv,
                'size' => $size,
            ];
        }


        session(['cart'=>$cartItem]);

        if($request->ajax()){
            return response()->jSon(['sepetCount'=>count(session()->get('cart')),'message'=>'Ürün Sepete Eklendi!']);
        }


        return back()->withSuccess('Ürün Sepete Eklendi');
    }

    public function newqty(Request $request) {
        $productID= $request->product_id;
        $qty= $request->qty ?? 1;
        $itemtotal = 0;
        $urun = Product::find($productID);
        if(!$urun) {
            return response()->json('Ürün Bulanamadı!');
        }
        $cartItem = session('cart',[]);

if( session()->get('coupon_code')){




}

        if(array_key_exists($productID,$cartItem)){
            $cartItem[$productID]['qty'] = $qty;
            if($qty == 0 || $qty < 0){
                unset($cartItem[$productID]);
            }
            if(session()->get('coupon_code') && session()->get('coupon_code') == 'tumurun') {
                $price = $urun->price / 2;
            }else {
                $price = $urun->price;
            }
            $kdvOraniitem = $urun->kdv ?? 0;
            $kdvtutaritem = ( $price * $qty) * ($kdvOraniitem / 100);
            $itemtotal =  $price * $qty + $kdvtutaritem;
        }
        session(['cart'=>$cartItem]);

        $this->sepetList();
        if($request->ajax()) {
            return response()->json(['itemTotal'=>$itemtotal, 'totalPrice'=>session()->get('total_price'), 'message'=>'Sepet Güncellendi']);
        }
    }

    public function remove(Request $request) {

        $productID=sifrecoz($request->product_id);
        $cartItem = session('cart',[]);
        if(array_key_exists($productID,$cartItem)) {

            unset($cartItem[$productID]);
        }
        session(['cart'=>$cartItem]);
        if(count(session()->get('cart')) == 0) {
            session()->forget('coupon_code');
            session()->forget('coupon_price');
        }

        if($request->ajax()){
            return response()->jSon(['sepetCount'=>count(session()->get('cart')),'message'=>'Ürün Sepetten Kaldırıldı!']);
        }
        return back()->withSuccess('Ürün başarıyla kaldırıldı!');
    }

    public function couponcheck(Request $request){
        $kupon= Coupon::where('name',$request->coupon_name)->where('status','1')->first();

        if(empty ($kupon)) {
            return back()->withError('Kupon Geçersiz!');
        }
        $kuponcode = $kupon->name ?? '';
        session()->put('coupon_code',$kuponcode);

        $kuponprice = $kupon->price ?? 0;
        session()->put('coupon_price',$kuponprice);

        $this->sepetList();

        return back()->withSuccess('Kupon Uygulandı!');

    }


    function generateKod() {
        $siparisno = generateOTP(9);
        if ($this->barcodeKodExists($siparisno)) {
            return $this->generateKod();
        }

        return $siparisno;
    }

    function barcodeKodExists($siparisno) {
        return Invoice::where('order_no',$siparisno)->exists();
    }


    public function cartSave(Request $request){



        $request->validate([

            'name'=>'string|required|min:2',
            'email'=>'required|min:2',
            'phone'=>'required|min:2',
            'address'=>'required|min:2',
            'country'=>'required|min:2',
            'city'=>'required|min:2',
            'district'=>'required|min:2',

        ],[

            'name.required' =>__('Başlık kısmı boş olamaz'),
            'name.min' =>__('2 karakterden az olamaz'),
            'name.string' =>__('Sadece karakter kullanınız'),
            'email.required' =>__('Başlık kısmı boş olamaz'),
            'email.min' =>__('2 karakterden az olamaz'),
            'phone.required' =>__('Başlık kısmı boş olamaz'),
            'phone.min' =>__('2 karakterden az olamaz'),
            'address.required' =>__('Başlık kısmı boş olamaz'),
            'address.min' =>__('2 karakterden az olamaz'),
            'country.required' =>__('Başlık kısmı boş olamaz'),
            'country.min' =>__('2 karakterden az olamaz'),
            'city.required' =>__('Başlık kısmı boş olamaz'),
            'city.min' =>__('2 karakterden az olamaz'),
            'district.required' =>__('Başlık kısmı boş olamaz'),
            'district.min' =>__('2 karakterden az olamaz'),


        ]);




        $invoice =   Invoice::create([
            'user_id'=>auth()->user()->id ?? NULL,
            'order_no' => $this->generateKod(),
            'name' =>$request->name ,
            'email' =>$request->email ?? NULL ,
            'phone' =>$request->phone ?? NULL   ,
            'company_name' =>$request->company_name ?? NULL   ,
            'address' => $request->address ?? NULL  ,
            'country' =>$request->country  ,
            'city' => $request->city ?? NULL ,
            'district' =>$request->district ?? NULL  ,
            'zip_code' =>$request->zip_code ?? NULL  ,
            'note' => $request->note ?? NULL  ,

        ]);

        $cart = session()->get('cart') ?? [];
        foreach ($cart as $key=> $item) {
            Order::create([
                'order_no'=>$invoice->order_no,
                'product_id'=>$key,
                'name'=>$item['name'],
                'price'=>$item['price'],
                'kdv'=>$item['kdv'],
                'qty'=>$item['qty'],

            ]);
        }
        session()->forget('cart');






        return redirect()->route('anasayfa')->withSuccess('Alışveriş Başarıyla Tamamlandı.');
    }

}
