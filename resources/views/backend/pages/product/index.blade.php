@extends('backend.layout.app')

@section('content')

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Kategori</h4>
          <p class="card-description">
<a class="btn btn-primary" href="{{route('panel.product.create');}}">Yeni</a>
<a class="btn btn-primary" href="{{route('panel.product.export');}}">Dışa Aktar(Excel)</a>
<a class="btn btn-primary" href="{{route('panel.product.import');}}">İçe Aktar(Excel)</a>
          </p>
          @if (session()->get('success'))
          <div class="alert alert-success">
{{session()->get('success')}}
          </div>
          @endif
          <div class="table-responsive">

            <table class="table">
              <thead>
                <tr>
                    <td>Resim</th>
                  <th>Başlık</th>
                  <th>İçerik</th>
                  <th>Kategori</th>
                  <th>Durum</th>
                  <th>Düzenle</th>
                </tr>
              </thead>
              <tbody>
@if (!empty($products) && $products->count()>0)
@foreach ($products as $item)
<tr class="item" item-id="{{$item->id}}">
    <td class="py-1">
        @php
        $images = collect($item->images->data ?? '');
        @endphp
        <img src="{{asset($images->sortByDesc('vitrin')->first()['image'] ?? 'img/resimyok.png')}}" ></img>
      </td>
  <td>{{$item->name}}</td>
  <td>{{$item->category->content ?? ''}}</td>
  <td>{{$item->category->name ?? ''}}</td>

  <td>

    <div class="checkbox">
        <label>
          <input type="checkbox" class="durum"  data-onstyle="success" data-offstyle="danger" {{$item->status=='1' ? 'checked' :''}} data-toggle="toggle">
         </label>
      </div>


</td>
  <td class="d-flex">
    <form action="{{route('panel.product.edit',$item->id);}}" method="post">
        @method('PUT')
    <a href="{{route('panel.product.edit',$item->id);}}" class="btn btn-primary mr-2">Düzenle</a>
    </form>


   <button type="button" class="btn btn-danger silBtn">Sil</button>

</td>
</tr>
@endforeach


@endif




              </tbody>
            </table>
          </div>

{{$products->links('pagination::custom')}}

        </div>
      </div>
    </div>

  </div>

@endsection

@section('customjs')
<script>
$(document).on('change', '.durum', function(e) {

id = $(this).closest('.item').attr('item-id');
statu = $(this).prop('checked');

$.ajax({
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
},
type:"POST",
url:"{{route('panel.product.status')}}",
data:{
    id:id,
    statu:statu
},
success: function (response) {
    if (response.status == "true")
    {
        alertify.success("Durum Aktif Edildi");
    } else {
        alertify.error("Durum Pasif Edildi");
    }
},
error: function() {
    alertify.error("Bir hata oluştu!");
}
});
});


$(document).on('click', '.silBtn', function(e) {

e.preventDefault();



var  item=$(this).closest('.item');
id=item.attr('item-id');




alertify.confirm('Uyarı',"Silmek istediğinizden emin misiniz?",
  function(){


    $.ajax({
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
},
type:"DELETE",
url:"{{route('panel.product.destroy')}}",
data:{
    id:id,

},
success: function (response) {
    if (response.error == false)
    {
        item.remove();
        alertify.success(response.message);
    }
    else {
        alertify.error("Bir Hata Oluştu!");
    }
},
error: function() {
    alertify.error("Bir hata oluştu!");
}
});
  },
  function(){
    alertify.error('Silme İşlemi İptal Edildi!');
  });





});
</script>
@endsection
