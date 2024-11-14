
<footer class="site-footer border-top">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="row">
            <div class="col-md-12">
              <h3 class="footer-heading mb-6">Menü</h3>
            </div>
            <div class="col-md-6 col-lg-4">
              <ul class="list-unstyled">
                <li><a href="{{route('hakkimizda')}}">Hakkımızda</a></li>
          <li><a href="{{route('urunler')}}">Ürünler</a></li>
           <li><a href="{{route('iletisim')}}">İletişim</a></li>
              </ul>
            </div>


          </div>
        </div>

        <div class="col-md-6 col-lg-6">
          <div class="block-5 mb-5">
            <h3 class="footer-heading mb-4">İletişim</h3>
            <ul class="list-unstyled">
              <li class="address">{!! $Settings['adres'] !!}</li>
              <li class="phone"><a href="tel://">{{$Settings['phone']}}</a></li>
              <li class="email">{{$Settings['email']}}</li>
            </ul>
          </div>


        </div>
      </div>
      <div class="row pt-5 mt-5 text-center">
        <div class="col-md-12">
          <p>

          Copyright &copy; FurkanK

          </p>
        </div>

      </div>
    </div>
  </footer>
