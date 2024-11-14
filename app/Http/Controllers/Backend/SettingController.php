<?php

namespace App\Http\Controllers\Backend;

use App\Models\SiteSettings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index(){
        $settings= SiteSettings::get();
        return view('backend.pages.setting.index',compact('settings'));


    }
    public function create(){
        return view('backend.pages.setting.edit');
    }


    public function store(Request $request){
        $key=$request->name;



    SiteSettings::firstOrCreate([
'name'=>$key,
    ],[
'name'=>$key,
'data'=>$request->data,
'set_type'=>$request->set_type,

    ]);
    return back()->withSuccess('Başarılı');



    }




    public function edit($id){
        $setting= SiteSettings::where('id',$id)->first();
        return view('backend.pages.setting.edit',compact('setting'));
    }

    public function update(request $request, $id){
        $setting= SiteSettings::where('id',$id)->first();

        $key=$setting->name;

        if($request->hasFile('data')){
            dosyasil($setting->image);
            $resim=$request->file('data');
            $dosyaadi=$key;
            $yukseklasor='img/setting/';
             $resimurl = resimyukle($resim,$dosyaadi,$yukseklasor);
            }

            if($request->set_type == 'file' || $request->set_type == 'image') {
                $dataItem = $resimurl ?? $setting->data;
            }else {
                $dataItem = $request->data ?? $setting->data;
            }

            $setting->update([
                'name'=>$key,
                'data'=> $dataItem,
                'set_type'=>$request->set_type
            ]);

            return back()->withSuccess('Başarıyla Güncellendi');
    }

    public function destroy(Request $request){

        $setting = SiteSettings::where('id',$request->id)->firstOrFail();

        $setting->delete();
        return response(['error'=>false,'message'=>'Başarıyla Silindi.']);


    }

}
