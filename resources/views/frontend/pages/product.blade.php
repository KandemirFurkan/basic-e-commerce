@extends('frontend.layout.layout')

@section('content')
@include('frontend.inc.breadcrumb')
    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if (session()->get('success'))
                        <div class="alert alert-success">{{ session()->get('success') }}</div>
                    @endif
                </div>
            </div>

            <div class="row">


                <div class="col-md-6">

                    @php
                    $images = collect($Products->images->data ?? '');
                    @endphp
                    <img src="{{asset($images->sortByDesc('vitrin')->first()['image'] ?? 'img/resimyok.png')}}" alt="{{$images->sortByDesc('vitrin')->first()['alt'] ?? ''}}"   class="img-fluid"></img>

                </div>
                <div class="col-md-6">
                    <h2 class="text-black">{{ $Products->name ?? '' }}</h2>
                    <p> {!! $Products->content ?? '' !!}</p>

                    <p><strong class="text-primary h4">{{ number_format($Products->price, 2) ?? '' }}</strong></p>
                    <form method="POST" action="{{ route('sepet.add') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{sifrele($Products->id)}}">
                        <div class="mb-1 d-flex">

                            <label for="option-xs" class="d-flex mr-3 mb-3">
                                <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input
                                        type="radio" id="option-xs" name="size"
                                        {{ $Products->size == 'XS' ? 'checked' : '' }} value="XS"></span> <span
                                    class="d-inline-block text-black">XS </span>
                            </label>
                            <label for="option-s" class="d-flex mr-3 mb-3">
                                <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input
                                        type="radio" id="option-s" name="size"
                                        {{ $Products->size == 'S' ? 'checked' : '' }} value="S"></span> <span
                                    class="d-inline-block text-black">S</span>
                            </label>
                            <label for="option-m" class="d-flex mr-3 mb-3">
                                <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input
                                        type="radio" id="option-m" name="size"
                                        {{ $Products->size == 'M' ? 'checked' : '' }} value="M"></span> <span
                                    class="d-inline-block text-black">M</span>
                            </label>
                            <label for="option-l" class="d-flex mr-3 mb-3">
                                <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input
                                        type="radio" id="option-l" name="size"
                                        {{ $Products->size == 'L' ? 'checked' : '' }} value="L"></span> <span
                                    class="d-inline-block text-black">L</span>
                            </label>
                            <label for="option-xl" class="d-flex mr-3 mb-3">
                                <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input
                                        type="radio" id="option-xxl" name="size"
                                        {{ $Products->size == 'XXL' ? 'checked' : '' }} value="XXL"></span> <span
                                    class="d-inline-block text-black"> XXL</span>
                            </label>
                            <label for="option-xl" class="d-flex mr-3 mb-3">
                                <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input
                                        type="radio" id="option-xxl" name="size"
                                        {{ $Products->size == 'XXL' ? 'checked' : '' }} value="XXL"></span> <span
                                    class="d-inline-block text-black"> XXL</span>
                            </label>
                        </div>

                        <div class="mb-5">
                            <div class="input-group mb-3" style="max-width: 120px;">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                                </div>
                                <input type="text" class="form-control text-center" name="qty" value="1"
                                    placeholder="" aria-label="Example text with button addon"
                                    aria-describedby="button-addon1">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                                </div>
                            </div>

                        </div>
                        <p><button type="submit" class="buy-now btn btn-sm btn-primary">Sepete Ekle</button></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (!empty($ProductsL) && $ProductsL->count() > 0)
        <div class="site-section block-3 site-blocks-2 bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-7 site-section-heading text-center pt-4">
                        <h2>Diğer Ürünlerimiz</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="nonloop-block-3 owl-carousel">



                            @foreach ($ProductsL as $item)
                                <div class="item">
                                    <div class="block-4 text-center">
                                        <figure class="block-4-image">

                                            @php
                                            $images2 = collect($item->images->data ?? '');
                                            @endphp
                                            <img src="{{asset($images2->sortByDesc('vitrin')->first()['image'] ?? 'img/resimyok.png')}}" alt="{{$images2->sortByDesc('vitrin')->first()['alt'] ?? ''}}"   class="img-fluid"></img>

                                        </figure>
                                        <div class="block-4-text p-4">
                                            <h3><a href="{{ route('urundetay', $item->slug) }}">{{ $item->name }}</a>
                                            </h3>
                                            <p class="mb-0"></p>
                                            <p class="text-primary font-weight-bold">{{ $item->price }} ₺</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach










                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
