@extends('backend.layout.app')

@section('content')

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Slider</h4>
          <p class="card-description">
<a class="btn btn-primary" href="{{route('panel.slider.create');}}">Yeni Oluştur</a>
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
                  <th>Slogan</th>
                  <th>Link</th>
                  <th>Durum</th>
                  <th>Düzenle</th>
                </tr>
              </thead>
              <tbody>
@if (!empty($sliders) && $sliders->count()>0)
@foreach ($sliders as $slider)
<tr class="item" item-id="{{$slider->id}}">
    <td class="py-1">
        <img src="{{asset($slider->image)}}" alt="image"/>
      </td>
  <td>{{$slider->name}}</td>
  <td>{{$slider->content ?? ''}}</td>
  <td>{{$slider->seo}}</td>
  <td>

    <div class="checkbox">
        <label>
          <input type="checkbox" class="durum"  data-onstyle="success" data-offstyle="danger" {{$slider->status=='1' ? 'checked' :''}} data-toggle="toggle">
         </label>
      </div>


</td>
  <td class="d-flex">
    <form action="{{route('panel.slider.edit',$slider->id);}}" method="post">
        @method('PUT')
    <a href="{{route('panel.slider.edit',$slider->id);}}" class="btn btn-primary mr-2">Düzenle</a>
    </form>

 {{-- <form action="{{route('panel.slider.destroy',$slider->id);}}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Sil</button>
   </form>  --}}

   <button type="button" class="btn btn-danger silBtn">Sil</button>

</td>
</tr>
@endforeach


@endif




              </tbody>
            </table>
          </div>
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
url:"{{route('panel.slider.status')}}",
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
url:"{{route('panel.slider.destroy')}}",
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
