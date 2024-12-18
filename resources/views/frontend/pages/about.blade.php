@extends('frontend.layout.layout')

@section('content')
@include('frontend.inc.breadcrumb')


  <div class="site-section border-bottom" data-aos="fade">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-6">
          <div class="block-16">
            <figure>
              <img src="images/blog_1.jpg" alt="Image placeholder" class="img-fluid rounded">
              <a href="https://vimeo.com/channels/staffpicks/93951774" class="play-button popup-vimeo"><span class="ion-md-play"></span></a>

            </figure>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5">


          <div class="site-section-heading pt-3 mb-4">
            <h2 class="text-black">{{$About->name}}</h2>
          </div>
        {!! $About->content !!}

        </div>
      </div>
    </div>
  </div>



  <div class="site-section site-section-sm site-blocks-1 border-0" data-aos="fade">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="">
          <div class="icon mr-4 align-self-start">
            <span class="{{$About->text_1_icon}}"></span>
          </div>
          <div class="text">
            <h2 class="text-uppercase">{{$About->text_1}}</h2>
            <p> {{$About->text_2_content}} </p>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="">
            <div class="icon mr-4 align-self-start">
              <span class="{{$About->text_2_icon}}"></span>
            </div>
            <div class="text">
              <h2 class="text-uppercase">{{$About->text_2}}</h2>
              <p> {{$About->text_2_content}} </p>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="">
            <div class="icon mr-4 align-self-start">
              <span class="{{$About->text_3_icon}}"></span>
            </div>
            <div class="text">
              <h2 class="text-uppercase">{{$About->text_3}}</h2>
              <p> {{$About->text_3_content}} </p>
            </div>
          </div>


      </div>
    </div>
  </div>

@endsection
