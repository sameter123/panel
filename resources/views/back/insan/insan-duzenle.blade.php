<?php
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
        $Blogim = DB::table('insan_kaynaklari')->where('id', $_GET['id'])->first();
    } else {
        header("Location:" . route('insanlar'));
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
                                <h4 class="card-title" id="row-separator-colored-controls">İş İlanı Düzenle</h4>
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
                                            <h4 class="form-section"><i class="la la-newspaper-o"></i>İş İlanı</h4>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="card-body">
                                                            <div class="card-block">
                                                                <label>Başlığı</label>
                                                                <div class="input-group">
                                                                    <input value="{{$Blogim->title}}" name="title"
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
                                                                <label>Açıklama</label>
                                                                <div class="input-group">
                                                                    <input value="{{$Blogim->title_2}}" name="title_2"
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

                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="card-body">
                                                                    <div class="card-block">
                                                                        <div class="row">

                                                                            <div class="col-md-12">
                                                                                <label>Blog Görsel (Tek
                                                                                    Fotoğraf)</label>
                                                                                <div class="input-group">
                                                                                    <input name="image" type="file"
                                                                                           class="form-control"
                                                                                           placeholder="Alt Başlık"
                                                                                           aria-describedby="basic-addon3">
                                                                                </div>
                                                                                @if($Blogim->image != '')
                                                                                    <br>
                                                                                    <div class="input-group">
                                                                                        <img
                                                                                            src="{{asset('public/img/'.$Blogim->image)}}"
                                                                                            class="form-control">
                                                                                    </div>
                                                                                @endif
                                                                            </div>

                                                                        </div>
                                                                    </div>
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