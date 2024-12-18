<nav class="sidebar sidebar-offcanvas" id="sidebar">

    <ul class="nav">


    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{route('panel.index')}}">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Yönetim Paneli</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="icon-layout menu-icon"></i>
          <span class="menu-title">Slider Yönetimi</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{route('panel.slider.index')}}">Slider </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{route('panel.slider.create')}}">Slider Ekle</a></li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
          <i class="icon-grid-2 menu-icon"></i>
          <span class="menu-title">Kategori Yönetimi</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="tables">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{route('panel.category.index')}}">Kategori </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{route('panel.category.create')}}">Kategori Ekle</a></li>
          </ul>
        </div>
      </li>


      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="ui-basic3">
          <i class="icon-layout menu-icon"></i>
          <span class="menu-title">Ürün Yönetimi</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic3">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{route('panel.product.index')}}">Ürünler </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{route('panel.product.create')}}">Ürün Ekle</a></li>

          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="ui-basic3">
          <i class="icon-layout menu-icon"></i>
          <span class="menu-title">Sipariş Yönetimi</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic3">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{route('panel.order.index')}}">Siparişler </a></li>
             </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{route('panel.about.index')}}">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Hakkımızda</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{route('panel.contact.index')}}">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Gelen Kutusu</span>
        </a>
      </li>


      <li class="nav-item">
        <a class="nav-link" href="{{route('panel.setting.index')}}">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Site Ayarları</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('panel.pageseo.index')}}">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Sayfa Seo Ayarları</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{route('panel.imageseo.index')}}">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Resim Seo Ayarları</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{route('panel.coupons.index')}}">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Kuponlar</span>
        </a>
      </li>


    </ul>
  </nav>
