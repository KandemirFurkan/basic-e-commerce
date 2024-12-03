@extends('frontend.layout.layout');

@section('content')
@include('frontend.inc.breadcrumb')

<div class="site-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-12">
                @if (session()->get('success'))
                <div class="alert alert-success">{{session()->get('success')}}</div>
                @endif
                @if (session()->get('error'))
                <div class="alert alert-danger">{{session()->get('error')}}</div>
                @endif
            </div>
        </div>
        <div class="row mb-5 ">
            <div class="site-blocks-table col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="product-thumbnail">Resim</th>
                            <th class="product-name">Ürün</th>
                            <th class="product-name">Beden</th>
                            <th class="product-price">Tutar</th>
                            <th class="product-quantity">Adet</th>
                            <th class="product-total">Toplam</th>
                            <th class="product-remove">İşlem</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($cartItem)


                        @foreach ($cartItem as $key => $cart)
                        <tr class="orderItem" data-id="{{$key}}">
                            <td class="product-thumbnail">
                                <img src="{{asset($cart['image'])}}" alt="Image" class="img-fluid">
                            </td>
                            <td class="product-name">
                                <h2 class="h5 text-black">{{$cart['name']}}</h2>
                            </td>
                            <td>{{$cart['size'] }}</td>
                            <td>{{$cart['price'] }} ₺</td>
                            <td>
                                <div class="input-group mb-3" style="max-width: 120px;">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-primary js-btn-minus decreaseBtn" type="button">&minus;</button>
                                    </div>
                                    <input type="text" class="form-control text-center qtyItem" value="{{$cart['qty']}}" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary js-btn-plus increaseBtn" type="button">&plus;</button>
                                    </div>
                                </div>

                            </td>
                            @php
                            $kdvOrani=$cart['kdv'] ?? 0;
                            $fiyat = $cart['price'];
                            $adet=$cart['qty'];
                            $kdvtutar=($fiyat*$adet)* ($kdvOrani /100);
                            $toplamTutar=$fiyat*$adet+$kdvtutar;
                            @endphp
                            <td class="itemTotal">{{ $toplamTutar}} ₺</td>
                            <td>
                                <form method="POST" class="removeItem">

                                    @csrf
                                    <input type="text" hidden name="product_id" value="{{sifrele($key)}}" > </input>
                                    <button  type="submit" class="btn btn-primary btn-sm">X</button>

                                </form>


                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <form action="{{route('coupon.check')}}" name="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label class="text-black h4" for="coupon">Kupon</label>
                            <p>Kupon kodunuzu buraya giriniz</p>
                        </div>
                        <div class="col-md-8 mb-3 mb-md-0">
                            <input type="text" class="form-control py-3" value="{{ session()->get('coupon_code') ?? ''}}" id="coupon" name="coupon_name" placeholder="Kupon Kodu">
                        </div>
                        <div class="col-md-4">
                            <button tyoe="submit" class="btn btn-primary btn-sm">Kupon Kodunu Uygula</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 pl-5">
                <div class="row justify-content-end">
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-12 text-right border-bottom mb-5">
                                <h3 class="text-black h4 text-uppercase">Toplam Tutar</h3>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-md-6">
                                <span class="text-black">Toplam</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <strong class="text-black newTotalPrice">{{session()->get('total_price') ?? ''}} ₺</strong>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-primary btn-lg py-3 btn-block paymentButton" >Ödemeye Geç</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('customjs')
<script>



    $(document).on('click', '.paymentButton', function(e) {

        var url = "{{route('sepet.form')}}";

        @if (!empty(session()->get('cart'))) { window.location.href=url;}
        @endif


    });


    $(document).on('click', '.decreaseBtn', function(e) {
        $('.orderItem').removeClass('selected');
        $(this).closest('.orderItem').addClass('selected');
        sepetUpdate();

    });

    $(document).on('click', '.increaseBtn', function(e) {
        $('.orderItem').removeClass('selected');
        $(this).closest('.orderItem').addClass('selected');
        sepetUpdate();
    });

    function sepetUpdate() {

        var product_id  = $('.selected').closest('.orderItem').attr('data-id');
        var qty  = $('.selected').closest('.orderItem').find('.qtyItem').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"POST",
            url:"{{route('sepet.newqty')}}",
            data:{
                product_id:product_id,
                qty:qty,
            },
            success: function (response) {
                $('.selected').find('.itemTotal').text(response.itemTotal+' ₺');
                if(qty == 0) {
                    $('.selected').remove();
                }
                $('.newTotalPrice').text(response.totalPrice);
            }
        });
    }





    $(document).on('click', '.removeItem', function(e) {
        e.preventDefault();

        const formData=$(this).serialize();
        var item=$(this);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"POST",
            url:"{{route('sepet.remove')}}",
            data: formData,
            success: function (response) {
                toastr.success(response.message);
                $(".count").text(response.sepetCount);
                item.closest('.orderItem').remove();
            }
        });

    });

</script>

@endsection
