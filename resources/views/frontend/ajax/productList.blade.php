
@if (!empty($Products && $Products->count()>0))
@foreach ($Products as $ProList)
<div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
    <div class="block-4 text-center border">
      <figure class="block-4-image">
        <a href="{{route('urundetay',$ProList->slug)}}">


            @php
            $images = collect($ProList->images->data ?? '');
            @endphp
            <img src="{{asset($images->sortByDesc('vitrin')->first()['image'] ?? 'img/resimyok.png')}}" alt="{{$images->sortByDesc('vitrin')->first()['alt'] ?? ''}}"   class="img-fluid"></img>





        </a>
      </figure>
      <div class="block-4-text p-4">
        <h3><a href="{{route('urundetay',$ProList->slug)}}">{{$ProList->name}}</a></h3>
        <p class="mb-0">{{$ProList->short_text}}</p>
        <p class="text-primary font-weight-bold">{{number_format($ProList->price,0)}} ₺</p>
        <p>
@php
    $sifrele= sifrele($ProList->id);
@endphp

            <form  id="addForm" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{$sifrele}}">
                <input type="hidden" name="size" value="{{$ProList->size}}">
                <input type="hidden" name="coupon_code" value="{{request()->segment(1) == 'tumurunler-indirim' ? 'tumurun':''}}">
            <button  type="submit"  class="buy-now btn btn-sm btn-primary">Sepete Ekle</button>
            </form>
            </p>
      </div>
    </div>
  </div>
@endforeach
            @endif
