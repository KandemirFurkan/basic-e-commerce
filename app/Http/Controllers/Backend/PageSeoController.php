<?php

namespace App\Http\Controllers\Backend;

use App\Models\PageSeo;
use App\Models\ImageMedia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageSeoController extends Controller
{
    public function index()
    {
        $pageseos=  PageSeo::with('images')->get();
        return view('backend.pages.pageseo.index',compact('pageseos'));
    }

    public function create()
    {

        return view('backend.pages.pageseo.edit');
    }

    public function store(Request $request)
    {


$pagereq= $request->page;
$sor = PageSeo::where('page',$pagereq)->first();

if(!empty($sor))
{
    return back()->withSuccess('Sayfa zaten mevcut!');
}
        $pageseo= PageSeo::create([

            'dil'=>$request->dil,
            'page'=>$request->page,
            'page_ust'=>$request->page_ust,
            'title'=>$request->title,
            'description'=>$request->description,
            'keywords'=>$request->keywords,
            'contents'=>$request->contents,




        ]);


        if($request->hasFile('image')) {

            $this->fileSave('Pageseo','pageseo',$request,$pageseo);

        }

        return back()->withSuccess('Başarıyla Oluşturuldu!');

    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $pageseo=  PageSeo::where('id',$id)->first();
        return view('backend.pages.pageseo.edit',compact('pageseo'));
    }


    public function update(Request $request, string $id)
    {
        $pageseo=  PageSeo::where('id',$id)->firstOrFail();


        $pagereq= $request->page;
        $sor = PageSeo::where('id','!=',$pageseo->id )->where('page',$pagereq)->first();

        if(!empty($sor))
        {
            return back()->withSuccess('Sayfa zaten mevcut!');
        }


        $pageseo->update([

            'dil'=>$request->dil,
            'page'=>$request->page,
            'page_ust'=>$request->page_ust,
            'title'=>$request->title,
            'description'=>$request->description,
            'keywords'=>$request->keywords,
            'contents'=>$request->contents,

        ]);

        if($request->hasFile('image')) {

            $this->fileSave('Pageseo','pageseo',$request,$pageseo);

        }
        return back()->withSuccess('Başarıyla Güncellendi!');
    }

    public function destroy(Request $request)
    {

        $pageseo=  PageSeo::where('id',$request->id)->firstOrFail();

        $imageMedia = ImageMedia::where('model_name', 'PageSeo')->where('table_id', $pageseo->id)->first();

        if (!empty($imageMedia->data)) {
            foreach ($imageMedia->data as $img) {
                dosyasil($img['image']);
            }
            $imageMedia->delete();
        }

        $pageseo->delete();

        return response(['error'=>false,'message'=>'Başarıyla Silindi!']);

    }


}
