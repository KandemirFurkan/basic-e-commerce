<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ContentFormRequest;



class AjaxController extends Controller
{
    public function iletisimkaydet(ContentFormRequest $request) {


$data=$request->all();
$data['ip'] = request()->ip();

$newdata=[
'name'=>Str::title($request->name),
'email'=>$request->name,
'subject'=>$request->subject,
'message'=>$request->message,
'ip'=>request()->ip(),
];

$sonkaydedilen= Contact::create($data);

return response()->json(['error'=>false,'message'=>'Başarıyla Gönderildi']);

    }

public function logout(){
Auth::logout();
return  redirect()->route('anasayfa');

}

}
