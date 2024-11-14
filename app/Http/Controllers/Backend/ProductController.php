<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products=  Product::with('category:id,cat_ust,name')->orderBy('id','desc')->paginate(20);

        return view('backend.pages.product.index',compact('products'));
    }

    /**
    * Show the form for creating a new resource.
    */
    public function create()
    {

        $categories=  Category::get();
        return view('backend.pages.product.edit',compact('categories'));
    }

    /**
    * Store a newly created resource in storage.
    */
    public function store(ProductRequest $request)
    {
/*
        if($request->hasFile('image')){
            $resim=$request->file('image');
            $uzanti=$resim->getClientOriginalExtension();
            $dosyaadi=time().'_'.Str::slug($request->name);
            $yukseklasor='img/urun/';
            klasorac($yukseklasor);
            $resimurl = resimyukle($resim,$dosyaadi,$yukseklasor);

        }
*/



      $product=  Product::create([
            'name'=>$request->name,
            'category_id'=>$request->category_id,
            'status'=>$request->status,
            'content'=>$request->content,
            'piece'=>$request->piece,
            'color'=>$request->color,
            'size'=>$request->size,
            'kdv'=>$request->kdv,
            'price'=>$request->price,
            'short_text'=>$request->short_text,
            'image'=>$resimurl ?? NULL,


        ]);

    if($request->hasFile('image')) {

        $this->fileSave('Product','urun',$request,$product);

        }

        return back()->withSuccess('Başarıyla Oluşturuldu!');

    }

    /**
    * Display the specified resource.
    */
    public function show(string $id)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    */
    public function edit(string $id)
    {
        $product=  Product::where('id',$id)->first();


        $categories=  Category::get();

        return view('backend.pages.product.edit',compact('product','categories'));
    }

    /**
    * Update the specified resource in storage.
    */
    public function update(ProductRequest $request, string $id)
    {




        $product=  Product::where('id',$id)->firstOrFail();



        $product->update([
            'name'=>$request->name,
            'category_id'=>$request->category_id,
            'content'=>$request->content,
            'piece'=>$request->piece,
            'color'=>$request->color,
            'size'=>$request->size,
            'kdv'=>$request->kdv,
            'price'=>$request->price,
            'short_text'=>$request->short_text,
            'status'=>$request->status,
            'image'=>$resimurl ?? $product->image,
            'title'=>$request->title,
            'description'=>$request->description,
            'keywords'=>$request->keywords,


        ]);
        if($request->hasFile('image')) {

            $this->fileSave('Product','urun',$request,$product);

            }
        return back()->withSuccess('Başarıyla Güncellendi!');
    }

    /**
    * Remove the specified resource from storage.
    */
    public function destroy(Request $request)
    {

        $product=  Product::where('id',$request->id)->firstOrFail();

        dosyasil($product->image);
        $product->delete();

        return response(['error'=>false,'message'=>'Başarıyla Silindi!']);

    }



    public function status(Request $request){
        $update= $request->statu;
        $updatecheck=$update == "false" ? '0' : '1';
        Product::where('id',$request->id)->update(['status'=>$updatecheck]);
        return response(['error'=>false,'status'=>$update]);

    }
}
