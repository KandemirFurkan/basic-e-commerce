<?php

namespace App\Http\Controllers\Frontend;

use App\Models\About;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{

    public function urunler(Request $request,$slug=Null){




        $category= request()->segment(1) ?? null;

        $sizes=!empty($request->size) ? explode(',',$request->size) : null;
        $colors= !empty($request->color) ? explode(',',$request->color) : null;

        $startprice=$request->min ?? null;
        $endprice=$request->max ?? null;
        $order=$request->order ?? 'id';
        $sort=$request->sort ?? 'desc';


        $anakategori = null;
        $altkategori = null;
        if(!empty($category) && empty($slug)) {
            $anakategori = Category::where('slug',$category)->first();
            $categorySlug = $anakategori->slug ?? '';
        }else if (!empty($category) && !empty($slug)){
            $anakategori = Category::where('slug',$category)->first();
            $altkategori = Category::where('slug',$slug)->first();
            $categorySlug = $altkategori->slug ?? '';
        }



        $breadcrumb = [
            'sayfalar' => [

            ],
            'active'=> 'Ürünler'
        ];

        if(!empty($anakategori) && empty($altkategori)) {
            $breadcrumb['active'] = $anakategori->name;
        }

        if(!empty($altkategori)) {
            $breadcrumb['sayfalar'][] = [
                'link'=> route($anakategori->slug.'urunler'),
                'name' => $anakategori->name
            ];

            $breadcrumb['active'] = $altkategori->name;
        }



        $Products= Product::where('status','1')->select(['id','name','slug','size','color','price','category_id','image'])
        ->where(function($q) use($sizes,$colors,$startprice,$endprice){
            if(!empty($sizes)) {
                $q->whereIn('size',$sizes);
            }
            if(!empty($colors)) {
                $q->whereIn('color',$colors);
            }

            if(!empty($startprice) && $endprice) {
                //$q->whereBetween('price', [$startprice,$endprice]);

                $q->where('price','>=', $startprice);

                $q->where('price','<=', $endprice);
            }

            return $q;
        })
        ->with('category:id,name,slug')
        ->whereHas('category',function($q) use($categorySlug){
            if(!empty ($categorySlug))   {
                $q->where('slug',$categorySlug);
            }
            return $q;
        })->with('images')->orderBy($order,$sort)->paginate(21);

        if($request->ajax()) {
            $view= view('frontend.ajax.productList',compact('Products'))->render();
            return response(['data'=>$view,'paginate'=>(string) $Products->withQueryString()->links('vendor.pagination.custom')]);
        }

        $sizelists= Product::where('status','1')->groupBy('size')->pluck('size')->toArray();
        $colors= Product::where('status','1')->groupBy('color')->pluck('color')->toArray();
        $maxprice =Product::max('price');



        $seolists = metaolustur($category);

        $seo = [
            'title' =>  $seolists['title'] ?? '',
            'description' => $seolists['description'] ?? '',
            'keywords' => $seolists['keywords'] ?? '',
            'image' => asset('img/page-bg.jpg'),
            'url'=>  $seolists['currenturl'],
            'canonical'=> $seolists['trpage'],
            'robots' => 'index, follow',
        ];

        return view('frontend.pages.products',compact('seo','breadcrumb','Products','maxprice','colors','sizelists'));

    }



    public function indirimdekiurunler(){

        $breadcrumb = [
            'sayfalar' => [

            ],
            'active'=> 'İndirimli Ürünler'
        ];

        return view('frontend.pages.products',compact('breadcrumb'));

    }

    public function urundetay($slug){
        $Products= Product::where('slug',$slug)->where('status','1')->with('images')->firstOrFail();

        $expiresAt = now()->addMinutes(1);
views($Products)
->cooldown($expiresAt)
->record();

$pageViewCount=views($Products)->count();

        $ProductsL = Product::where('id','!=',$Products->id)
        ->where('category_id',$Products->category_id)
        ->where('status','1')
        ->limit(6)
        ->with('images')
        ->orderBy('id','desc')
        ->get();

        $category = Category::where('id',$Products->category_id)->first();



        $breadcrumb = [
            'sayfalar' => [

            ],
            'active'=> $Products->name,
        ];


        if(!empty($category)) {
            $breadcrumb['sayfalar'][] = [
                'link'=> route($category->slug.'urunler'),
                'name' => $category->name
            ];


        }




        $seo = [
            'title' =>  $Products->title ?? '',
            'description' => $Products->description  ??  '',
            'keywords' => $Products->keywords  ??  '',
            'image' => asset($Products->image),
            'url'=>  route('urundetay',$Products->slug),
            'canonical'=> route('urundetay',$Products->slug),
            'robots' => 'index, follow',
        ];


        return view('frontend.pages.product',compact('seo','Products','ProductsL','breadcrumb','pageViewCount'));
    }
    public function hakkimizda(){
        $About=  About::where('id',1)->first();
        $breadcrumb = [
            'sayfalar' => [

            ],
            'active'=> 'Hakkımızda'
        ];



        $seolists = metaolustur('hakkimizda');

        $seo = [
            'title' =>  $seolists['title'] ?? '',
            'description' => $seolists['description'] ?? '',
            'keywords' => $seolists['keywords'] ?? '',
            'image' => asset('img/page-bg.jpg'),
            'url'=>  $seolists['currenturl'],
            'canonical'=> $seolists['trpage'],
            'robots' => 'index, follow',
        ];

        return view('frontend.pages.about',compact('seo','About','breadcrumb'));

    }
    public function iletisim(){

        $breadcrumb = [
            'sayfalar' => [

            ],
            'active'=> 'İletişim'
        ];


        $seolists = metaolustur('iletisim');

        $seo = [
            'title' =>  $seolists['title'] ?? '',
            'description' => $seolists['description'] ?? '',
            'keywords' => $seolists['keywords'] ?? '',
            'image' => asset('img/page-bg.jpg'),
            'url'=>  $seolists['currenturl'],
            'canonical'=> $seolists['trpage'],
            'robots' => 'index, follow',
        ];
        return view('frontend.pages.contact',compact('seo','breadcrumb'));

    }


}
