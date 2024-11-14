@extends('backend.layout.app')

@section('customcss')
<style>
    .ck-content {
        height: 300px !important;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Hakkımızda</h4>

                @if ($errors)
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
                @endforeach
                @endif
                @if (session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
                @endif
                <form action="{{ route('panel.about.update') }}" class="forms-sample" method="post"
                enctype="multipart/form-data">
                @csrf

                <div class="col-lg-12 d-flex images">
                    @if (!empty($about->images->data))
                    @php
                    $images = collect($about->images->data ?? '');
                    @endphp
                    @foreach ($images->sortByDesc('vitrin') as $item)
                    <div class="item mx-4" data-id="{{$about->id}}" data-model="About" data-image_no="{{$item['image_no']}}">
                        <img src="{{asset($item['image'])}}" class="img-thumbnail">
                        <button type="button" class="deleteImage btn btn-sm btn-danger btn btn-sm btn-danger d-flex align-items-center px-2 mt-3">X</button>
                        <div class="mt-4">
                            <label class="d-block">
                                <input class="radio_animated vitrinBtn" type="radio" {{$item['vitrin'] == 1 ? 'checked' : ''}}  >Vitrin Yap
                            </label>
                        </div>
                    </div>
                    @endforeach
                @endif
               </div>


                <div class="form-group">
                    <label>Resim Yükle</label>
                    <input type="file" name="image" class="file-upload-default">
                    <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled
                        placeholder="Resim Yükle">
                        <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Seç</button>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Başlık</label>
                    <input type="text" class="form-control" value="{{ $about->name ?? '' }}" id="name"
                    name="name" placeholder="Slider Başlık">
                </div>
                <div class="form-group">
                    <label for="editor">İçerik</label>
                    <textarea rows="4" class="form-control" id="editor" name="content">{!! $about->content ?? '' !!}</textarea>
                </div>
                <div class="form-group">
                    <label for="text_1_icon">Icon 1</label>
                    <input type="text" class="form-control" value="{{ $about->text_1_icon ?? '' }}"
                    id="link" name="text_1_icon" placeholder="Icon1">
                </div>
                <div class="form-group">
                    <label for="text_1">Text 1</label>
                    <input type="text" class="form-control" value="{{ $about->text_1 ?? '' }}" id="link"
                    name="text_1" placeholder="Text1">
                </div>

                <div class="form-group">
                    <label for="text_1_content">text 1 Content</label>
                    <textarea rows="4" class="form-control" id="text_1_content" name="text_1_content">{!! $about->text_1_content ?? '' !!}</textarea>
                </div>

                <div class="form-group">
                    <label for="text_2_icon">Icon 2</label>
                    <input type="text" class="form-control" value="{{ $about->text_2_icon ?? '' }}"
                    id="link" name="text_2_icon" placeholder="Icon2">
                </div>
                <div class="form-group">
                    <label for="text_2">Text 2</label>
                    <input type="text" class="form-control" value="{{ $about->text_2 ?? '' }}" id="link"
                    name="text_2" placeholder="Text2">
                </div>

                <div class="form-group">
                    <label for="text_2_content">text 2 Content</label>
                    <textarea rows="4" class="form-control" id="text_2_content" name="text_2_content">{!! $about->text_2_content ?? '' !!}</textarea>
                </div>


                <div class="form-group">
                    <label for="text_3_icon">Icon 3</label>
                    <input type="text" class="form-control" value="{{ $about->text_3_icon ?? '' }}"
                    id="link" name="text_3_icon" placeholder="Icon3">
                </div>
                <div class="form-group">
                    <label for="text_3">Text 3</label>
                    <input type="text" class="form-control" value="{{ $about->text_3 ?? '' }}" id="link"
                    name="text_3" placeholder="Text3">
                </div>

                <div class="form-group">
                    <label for="text_3_content">text 3 Content</label>
                    <textarea rows="4" class="form-control" id="text_3_content" name="text_3_content">{!! $about->text_3_content ?? '' !!}</textarea>
                </div>


                <button type="submit" class="btn btn-primary mr-2">Onayla</button>

            </form>
        </div>
    </div>
</div>

</div>
@endsection

@section('customjs')
<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/translations/tr.js"></script>

<script>

    const option = {
        language: 'tr',
        heading: {
            options: [
            { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
            { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
            { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
            { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
            { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
            { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
            { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
            ]
        },
    };

    ClassicEditor
    .create( document.querySelector( '#editor' ), option )
    .catch( error => {
        console.error( error );
    } );
</script>
@endsection

