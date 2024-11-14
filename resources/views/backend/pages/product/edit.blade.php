@extends('backend.layout.app')
@section('customcss')
    <style>
        .ck-content {
            height: 300px !important;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Ürün Ekle</h4>

                    @if ($errors)
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{$error}}
                                        </div>
                    @endforeach

                    @endif
                @if (session()->get('success'))
                <div class="alert alert-success">
{{session()->get('success')}}
                </div>
                @endif


@if (!empty ($product->id))
@php
   $routelink=route('panel.product.update',$product->id);
@endphp
@else
@php
    $routelink=route('panel.product.store');
@endphp

@endif
                <form  action="{{$routelink}}" class="forms-sample" method="post" enctype="multipart/form-data">
                    @csrf
                    @if (!empty ($product->id))
 @method('PUT')

@endif

<div class="col-lg-12 d-flex images">
    @if (isset($product) && !empty($product->images->data))
    @php
    $images = collect($product->images->data ?? '');
    @endphp
    @foreach ($images->sortByDesc('vitrin') as $item)
    <div class="item mx-4" data-id="{{$product->id}}" data-model="Product" data-image_no="{{$item['image_no']}}">
        <img src="{{asset($item['image'])}}" class="img-thumbnail">
        <button type="button" class="deleteImage btn btn-sm btn-danger btn btn-sm btn-danger d-flex align-items-center px-2 mt-3">X</button>
        <div class="mt-4">
            <label class="d-block">
                <input class="radio_animated vitrinBtn" type="radio" {{$item['vitrin'] == 1 ? 'checked' : ''}}  >Vitrin Yap
            </label>
        </div>
    </div>
    @endforeach
@endif
</div>


                    <div class="form-group">
                        <label>Resim Yükle</label>
                        <input   type="file" name="image" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input   type="text" class="form-control file-upload-info" disabled placeholder="Resim Yükle">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Seç</button>
                          </span>
                        </div>
                      </div>
                  <div class="form-group">
                    <label for="name">Başlık</label>
                    <input type="text" class="form-control" value="{{$product->name ?? ''}}" id="name" name="name" placeholder="Başlık">
                  </div>

                  <div class="form-group">
                    <label for="name">Kategori Seç</label>
                    <select name="category_id" id="" class="form-control" >

@if ($categories)
@foreach ($categories as $alt)
<option value="{{$alt->id}}" {{ isset($product) && $product->category_id == $alt->id ? 'selected' : ''}}>{{$alt->name}} </option>
@endforeach
@endif


                    </select>
                     </div>



                     <div class="form-group">
                        <label for="name">Renk</label>
                        <input type="text" class="form-control" value="{{$product->color ?? ''}}" id="color" name="color" placeholder="Renk">
                      </div>

                     <div class="form-group">
                        <label for="name">Beden</label>

                             <select name="size"  class="form-control">
                                <option value="" >Beden Seçiniz</option>
                                <option value="XS" {{isset($product->size) && $product->size == 'XS' ? 'selected' :''}}>XS</option>
                    <option value="S" {{isset($product->size) && $product->size == 'S' ? 'selected' :''}}>S</option>
                    <option value="M" {{isset($product->size) && $product->size == 'M' ? 'selected' :''}}>M</option>
                    <option value="L" {{isset($product->size) && $product->size == 'L' ? 'selected' :''}}>L</option>
                    <option value="XL" {{isset($product->size) && $product->size == 'XL' ? 'selected' :''}}>XL</option>
                    <option value="XXL" {{isset($product->size) && $product->size == 'XXL' ? 'selected' :''}}>XXL</option>
                    </select>
                    </div>

                     <div class="form-group">
                        <label for="name">Fiyat</label>
                        <input type="text" class="form-control" value="{{$product->price ?? ''}}" id="price" name="price" placeholder="Fiyat">
                      </div>


                     <div class="form-group">
                        <label for="name">Kısa Bilgi</label>
                        <input type="text" class="form-control" value="{{$product->short_text ?? ''}}" id="short_text" name="short_text" placeholder="Kısa Bilgi">
                      </div>


                     <div class="form-group">
                        <label for="content">İçerik</label>
                        <textarea  class="form-control" id="editor" name="content" rows="3">{{$product->content ?? ''}}</textarea>
                      </div>



                      <div class="form-group">
                        <label for="title">Seo title</label>
                        <input type="text" class="form-control" value="{{$product->title ?? ''}}" id="title" name="title" placeholder="Seo title">
                      </div>

                      <div class="form-group">
                        <label for="keywords">Seo Anahtar Kelime </label>
                        <input type="text" class="form-control" value="{{$product->keywords ?? ''}}" id="keywords" name="keywords" placeholder="Seo Anahtar Kelime ">
                      </div>

                      <div class="form-group">
                        <label for="description">Seo Açıklama</label>
                        <input type="text" class="form-control" value="{{$product->description ?? ''}}" id="description" name="description" placeholder="Seo Açıklama">
                      </div>



                  <div class="form-group" >
                    <label for="status">Durum</label>
                    @php
                    $status=$product->status ?? '1';
                    @endphp
                    <select name="status" id="status" class="form-control">
                        <option value="0" {{$status=="0" ? 'selected' : ''}}>Pasif </option>
                        <option value="1"  {{$status=="1" ? 'selected' : ''}}>Aktif </option>
                    </select>

                  </div>


                  <button type="submit" class="btn btn-primary mr-2">Onayla</button>
                  <button class="btn btn-light">İptal Et</button>
                </form>
              </div>
            </div>
          </div>

    </div>
@endsection


@section('customjs')
<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/translations/tr.js"></script>

<script>

   const option = {
            language: 'tr',
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                    ]
                },
            };

       ClassicEditor
        .create( document.querySelector( '#editor' ), option )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection

