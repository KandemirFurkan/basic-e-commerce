@extends('frontend.layout.layout')
@section('content')

@php
$images3 = collect($slider->images->data ?? '');
@endphp

    <div class="site-blocks-cover" style="background-image: url({{asset($images3->sortByDesc('vitrin')->first()['image'] ?? 'img/resimyok.png')}});" data-aos="fade">
      <div class="container">
        <div class="row align-items-start align-items-md-center justify-content-end">
          <div class="col-md-5 text-center text-md-left pt-5 pt-md-0">
            <h1 class="mb-2">  {{ $slider->name ??__('Slider Başlık')}}</h1>
            <div class="intro-text text-center text-md-left">
              <p class="mb-4">{{$slider->content ?? ''}} </p>
              <p>
                <a href="{{$slider->seo ?? ''}}" class="btn btn-sm btn-primary">Ürünlerimiz</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section site-section-sm site-blocks-1">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="">
            <div class="icon mr-4 align-self-start">
              <span class="{{$About->text_1_icon}}"></span>
            </div>
            <div class="text">
              <h2 class="text-uppercase">{{$About->text_1}}</h2>
              <p>{{$About->text_1_content}}</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="">
            <div class="icon mr-4 align-self-start">
              <span class="{{$About->text_2_icon}}"></span>
            </div>
            <div class="text">
              <h2 class="text-uppercase">{{$About->text_2}}</h2>
              <p>{{$About->text_2_content}}</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="">
            <div class="icon mr-4 align-self-start">
              <span class="{{$About->text_3_icon}}"></span>
            </div>
            <div class="text">
              <h2 class="text-uppercase">{{$About->text_3}}</h2>
              <p>{{$About->text_3_content}}</p>
            </div>
          </div>


        </div>
      </div>
    </div>

    <div class="site-section site-blocks-2">
      <div class="container">
        <div class="row">


            @if (!empty($categories) && $categories->count() > 0)
            @foreach ($categories->where('cat_ust',null) as $category)
            <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
                <a class="block-2-item" href="{{url($category->slug)}}">
                  <figure class="image">


                    @php
                    $images = collect($category->images->data ?? '');
                    @endphp
                    <img src="{{asset($images->sortByDesc('vitrin')->first()['image'] ?? 'img/resimyok.png')}}" alt="{{$images->sortByDesc('vitrin')->first()['alt'] ?? ''}}"   class="img-fluid"></img>



                  </figure>
                  <div class="text">
                    <span class="text-uppercase">Giyim</span>
                    <h3>{{$category->name}}</h3>
                  </div>
                </a>
              </div>

@endforeach
        @endif




        </div>
      </div>
    </div>

    <div class="site-section block-3 site-blocks-2 bg-light">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 site-section-heading text-center pt-4">
            <h2>Yeni Eklenen Ürünler</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="nonloop-block-3 owl-carousel">


@if (!empty($lastproducts) && $lastproducts->count()>0)

@foreach ($lastproducts as $item)
<div class="item">
    <div class="block-4 text-center">
      <figure class="block-4-image">

        @php
        $images2 = collect($item->images->data ?? '');
        @endphp
        <img src="{{asset($images2->sortByDesc('vitrin')->first()['image'] ?? 'img/resimyok.png')}}" alt="{{$images2->sortByDesc('vitrin')->first()['alt'] ?? ''}}"   class="img-fluid"></img>



      </figure>
      <div class="block-4-text p-4">
        <h3><a href="#">{{$item->name}}</a></h3>
        <p class="mb-0">{{$item->category->name}}</p>
        <p class="text-primary font-weight-bold">{{$item->price}} ₺</p>
      </div>
    </div>
  </div>
@endforeach

@endif




            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section block-8">
      <div class="container">
        <div class="row justify-content-center  mb-5">
          <div class="col-md-7 site-section-heading text-center pt-4">
            <h2>Kampanya!</h2>
          </div>
        </div>
        <div class="row align-items-center">
          <div class="col-md-12 col-lg-7 mb-5">
            <a href="#"><img src="{{$Settings['TestKEy']}}" alt="Image placeholder" class="img-fluid rounded"></a>
          </div>
          <div class="col-md-12 col-lg-5 text-center pl-md-5">
            <h2><a href="#">{{$Settings['kampamya_title']}}</a></h2>

            <p>{{$Settings['kampamya_text']}}</p>
            <p><a href="{{route('tumurunlerindirim')}}" class="btn btn-primary btn-sm">İndirimdeki Ürünler</a></p>
          </div>
        </div>
      </div>
    </div>
@endsection
