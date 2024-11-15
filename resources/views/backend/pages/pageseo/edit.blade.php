@extends('backend.layout.app')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Sayfa Seo Ayarları</h4>

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


@if (!empty ($pageseo->id))
@php
   $routelink=route('panel.pageseo.update',$pageseo->id);
@endphp
@else
@php
    $routelink=route('panel.pageseo.store');
@endphp

@endif
                <form  action="{{$routelink}}" class="forms-sample" method="post" enctype="multipart/form-data">
                    @csrf
                    @if (!empty ($pageseo->id))
 @method('PUT')

@endif

                  <div class="form-group">
                    <label for="dil">Dil</label>
                    <input type="text" class="form-control" value="{{$pageseo->dil ?? 'tr'}}" id="dil" name="dil" placeholder="Dil">
                  </div>

                  <div class="form-group">
                    <label for="page">Sayfa</label>
                    <input type="text" class="form-control" value="{{$pageseo->page ?? ''}}" id="page" name="page" placeholder="Sayfa">
                  </div>

                  <div class="form-group">
                    <label for="title">Başlık</label>
                    <input type="text" class="form-control" value="{{$pageseo->title ?? ''}}" id="title" name="title" placeholder="Başlık">
                  </div>
                  <div class="form-group">
                    <label for="description">Açıklama</label>
                    <input type="text" class="form-control" value="{{$pageseo->description ?? ''}}" id="description" name="description" placeholder="Açıklama">
                  </div>
                  <div class="form-group">
                    <label for="keywords">Anahtar Kelimeler</label>
                    <input type="text" class="form-control" value="{{$pageseo->keywords ?? ''}}" id="keywords" name="keywords" placeholder="Anahtar Kelimeler">
                  </div>
                  , <div class="form-group">
                    <label for="contents">İçerik</label>
                    <textarea type="text" class="form-control"  id="contents" row="3" name="contents" placeholder="İçerik">{!! $pageseo->contents ?? '' !!}</textarea>
                  </div>

                  <button type="submit" class="btn btn-primary mr-2">Onayla</button>
                  <button class="btn btn-light">İptal Et</button>
                </form>
              </div>
            </div>
          </div>

    </div>
@endsection
