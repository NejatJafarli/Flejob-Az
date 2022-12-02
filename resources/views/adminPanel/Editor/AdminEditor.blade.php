@extends('layouts/master')
@section('title', 'Admin Panel')
@section('Username', session('AdminUser'))
@section('contentName', 'Language List')
@section('userLogo', 'https://cdn-icons-png.flaticon.com/128/149/149071.png');
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('Panel', app()->getLocale()) }}">AdminPanel</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('HtmlEditor', app()->getLocale()) }}">Editor</a></li>
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Tinymce wysihtml5</h4>
                            <p class="text-muted mb-4">Bootstrap-wysihtml5 is a javascript
                                plugin that makes it easy to create simple, beautiful wysiwyg editors
                                with the help of wysihtml5 and Twitter Bootstrap.
                            </p>
                            <form method="post">
                                <textarea id="elm1" name="area"></textarea>
                            </form>
                            <button onclick="Convert()" type="button" class="btn btn-primary mb-3"
                               >Convert</button>

                            <textarea id="convert" class="form-control" cols="30" rows="15">

                            </textarea>

                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div><!-- container -->
        <script>
            function Convert() {
                var html = tinymce.get('elm1').getContent();
                console.log(html);
                let convert=document.getElementById('convert');
                console.log(convert);
                convert.value=html;
                
            }
            
        </script>
    @endsection
