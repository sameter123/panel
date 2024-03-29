<?php
if(isset($_GET['gorselSil']) && isset($_GET['gorsel']) && isset($_GET['id'])) {
    $sil = $_GET['gorsel'];
    $gorsel = DB::table('urun_gorsel')->where('id', $sil)->first()->gorsel;
    $gorsel = public_path("img/".$gorsel);
    if(File::exists($gorsel)) {
        File::delete($gorsel);
    }
    DB::table('urun_gorsel')->where('id', $sil)->delete();
    header("Location: ?id=" . $_GET['id']);
    die();
}
if(isset($_GET['belgeSil']) && isset($_GET['belge']) && isset($_GET['id'])) {
    $sil = $_GET['belge'];
    $belge = DB::table('urun_belge')->where('id', $sil)->first()->belge;
    $belge = public_path("img/".$belge);
    if(File::exists($belge)) {
        File::delete($belge);
    }
    DB::table('urun_belge')->where('id', $sil)->delete();
    header("Location: ?id=" . $_GET['id']);
    die();
}
use Illuminate\Support\Facades\File;
?>
@section('css')
    <link rel="stylesheet" type="text/css"
          href="{{asset('/public/back/app-assets/vendors/css/editors/tinymce/tinymce.min.css')}}">
@endsection
@extends('back.layouts.app')
@section('content')
    <?php
    if (isset($_GET['id'])) {
        $urunim = DB::table('urun')->where('id', $_GET['id'])->first();
    } else {
        header("Location:" . route('urun'));
    }

    ?>
    <div class="app-content content">
        <div class="content-wrapper">

            <div class="content-body">
                <!-- input groups start -->

                <!-- input groups end -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="row-separator-colored-controls">Ürün Düzenle</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <form class="form-horizontal" method="post" autocomplete="off"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="la la-newspaper-o"></i>Ürün</h4>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="card-body">
                                                            <div class="card-block">
                                                                <label>Ürün Başlığı</label>
                                                                <div class="input-group">
                                                                    <input value="{{$urunim->title}}" name="title"
                                                                           type="text" class="form-control"
                                                                           placeholder="Başlık"
                                                                           aria-describedby="basic-addon3">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="card-body">
                                                            <div class="card-block">
                                                                <label>Ürün Alt Başlığı</label>
                                                                <div class="input-group">
                                                                    <input value="{{$urunim->title_2}}" name="title_2"
                                                                           type="text" class="form-control"
                                                                           placeholder="Alt Başlık"
                                                                           aria-describedby="basic-addon3">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="card-body">
                                                            <div class="card-block">
                                                                <label>Kategori</label>
                                                                <div class="input-group">
                                                                    <select name="kategori" class="form-control"
                                                                            id="basicSelect">
                                                                        <option>Select Option</option>
                                                                        <option>Option 1</option>
                                                                        <option>Option 2</option>
                                                                        <option>Option 3</option>
                                                                        <option>Option 4</option>
                                                                        <option>Option 5</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row">

                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="card-body">
                                                                    <div class="card-block">
                                                                        <div class="row">

                                                                            <div class="col-md-4">
                                                                                <label>Ürün Görsel (Tek
                                                                                    Fotoğraf)</label>
                                                                                <div class="input-group">
                                                                                    <input name="image" type="file"
                                                                                           class="form-control"
                                                                                           placeholder="Alt Başlık"
                                                                                           aria-describedby="basic-addon3">
                                                                                </div>
                                                                                @if($urunim->image != '')
                                                                                    <br>
                                                                                    <div class="input-group">
                                                                                        <img
                                                                                            src="{{asset('public/img/'.$urunim->image)}}"
                                                                                            class="form-control">
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-sm-4 col-md-4">
                                                                                <label class="label-control"
                                                                                       for="userinput4">Yeni Resim Yükle
                                                                                    ( Çoklu )</label>
                                                                                <input
                                                                                    id="userinput4"
                                                                                    type="file"
                                                                                    name="images[]"
                                                                                    class="btn btn-block btn-outline-pink form-control"
                                                                                    accept="image/*"
                                                                                    multiple
                                                                                >
                                                                                @if(DB::table('urun_gorsel')->where('urun_id', $urunim->id)->get())
                                                                                    @foreach(DB::table('urun_gorsel')->where('urun_id', $urunim->id)->get() as $uuuu)
                                                                                        <div class="row mt-1">
                                                                                            <div class="col-8">
                                                                                                <img
                                                                                                    class="form-control"
                                                                                                    src="{{asset('public/img/'.$uuuu->gorsel)}}"
                                                                                                    style="width: 100%;">
                                                                                            </div>
                                                                                            <div class="col-4 mt-3">
                                                                                                <button type="button"
                                                                                                        onclick="location.href='?gorselSil&gorsel={{$uuuu->id}}&id={{$urunim->id}}'"
                                                                                                        class="btn btn-block btn-outline-danger ml-1">
                                                                                                    <i class="ft ft-minus"></i>
                                                                                                    Sil
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                @else
                                                                                    <span class="text-danger">Galeriye Resim Yüklenmemiş</span>
                                                                                @endif
                                                                            </div>



                                                                            <div class="col-sm-4 col-md-4">
                                                                                <div class="form-group">
                                                                                    <label class="label-control text-danger" for="userinput4">Yeni Yüklemek istediğiniz pdf'leri seçin</label>
                                                                                    <input id="userinput4" type="file" name="pdf[]" class="btn btn-block btn-outline-pink form-control" accept="application/pdf" multiple>
                                                                                </div>
                                                                                @if(DB::table('urun_belge')->where('urun_id', $urunim->id)->get())
                                                                                    @foreach(DB::table('urun_belge')->where('urun_id', $urunim->id)->get() as $uu)
                                                                                        <span class="text-info mt-1"
                                                                                              style="display: block;"><a target="_blank" href="/public/img/{{$uu->belge}}"><label>{{$uu->belge}}</label><img style="width: 30%" src="{{ asset('/public/back/icon/pdf.png') }}"></a><button type="button" onclick="location.href='?belgeSil&belge={{$uu->id}}&id={{$urunim->id}}'" class="btn btn-outline-danger ml-1"><i class="ft ft-minus"></i> Sil</button></span><br>
                                                                                    @endforeach
                                                                                @else
                                                                                    <span class="text-danger">PDF Yüklenmemiş</span>
                                                                                @endif
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="card-body">
                                                            <div class="card-block">
                                                                <label>Ürün Metni</label>
                                                                <div class="form-group">
                                                                    <textarea name="text"
                                                                              class="tinymce">{{$urunim->text}}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="form-actions right">
                                            <button type="submit"
                                                    class="btn btn-success btn-min-width btn-glow mr-1 mb-1">Gönder
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('/public/back/app-assets/vendors/js/editors/tinymce/tinymce.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('/public/back/app-assets/js/scripts/editors/editor-tinymce.js')}}"
            type="text/javascript"></script>
@endsection
