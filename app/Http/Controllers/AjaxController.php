<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use App\Mail\ContactMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContentFormRequest;



class AjaxController extends Controller
{
    public function iletisimkaydet(ContentFormRequest $request) {


$data=$request->all();
$data['ip'] = request()->ip();

$newdata=[
'name'=>Str::title($request->name),
'email'=>$request->email,
'subject'=>$request->subject,
'message'=>$request->message,
'ip'=>request()->ip(),
];

$sonkaydedilen= Contact::create($data);
Mail::to('demo@gmail.com')->send(new ContactMail($newdata));
return response()->json(['error'=>false,'message'=>'Başarıyla Gönderildi']);

    }

public function logout(){
Auth::logout();
return  redirect()->route('anasayfa');

}

}
