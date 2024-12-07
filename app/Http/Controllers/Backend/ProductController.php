<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Models\Category;
use App\Models\ImageMedia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\ProductExport;
use App\Imports\ProductImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products=  Product::with('category:id,cat_ust,name')->with('images')->orderBy('id','desc')->paginate(20);

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
        $imageMedia = ImageMedia::where('model_name', 'Product')->where('table_id', $product->id)->first();

        if (!empty($imageMedia->data)) {
            foreach ($imageMedia->data as $img) {
                dosyasil($img['image']);
            }
            $imageMedia->delete();
        }

        $product->delete();

        return response(['error'=>false,'message'=>'Başarıyla Silindi!']);

    }



    public function status(Request $request){
        $update= $request->statu;
        $updatecheck=$update == "false" ? '0' : '1';
        Product::where('id',$request->id)->update(['status'=>$updatecheck]);
        return response(['error'=>false,'status'=>$update]);

    }

    public function export(Request $request){

return Excel::download(new ProductExport, 'products.xlsx');
    }

    public function import(Request $request){
        return view('backend.pages.product.import');
    }

    public function importStore(Request $request){
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');

          Excel::import(new ProductImport, $file);

        return redirect()->back()->with('success', 'Excel Aktarımı Tamamlandı!');
    }
}
