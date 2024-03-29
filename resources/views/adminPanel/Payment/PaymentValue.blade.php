@extends('layouts/master')
@section('title', 'Admin Panel')
@section('Username', session('AdminUser'))
@section('contentName', 'Dashboard')
@section('userLogo', 'https://cdn-icons-png.flaticon.com/128/149/149071.png');
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('Panel', app()->getLocale()) }}">AdminPanel</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('SetPaymentData', app()->getLocale()) }}">Set Payment Data</a></li>
@endsection
@section('content')
    {{-- @php
        $token = ;
        $url = route('UpdateConfig', app()->getLocale());
        $str = `<script>
            var __token = $token;
            var __url = $url;
        </script>`;

        echo $str;
    @endphp --}}
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">

                                        <h4 class="mt-0 header-title">{{ __('Set Config Values') }}</h4>
                                        <div class="card-body row justify-content-center align-items-center">
                                            <form role="search" method="GET"
                                                class="mb-3 form-group row col-8 align-items-center justify-content-center">
                                                <div class="input-group">
                                                    {{-- //search label --}}
                                                    {{-- <label for="search" class="col-1">{{ __('Search') }}</label> --}}
                                                    <input type="text" value="{{request()->get("SearchKey")}}" name="SearchKey" class="form-control"
                                                        placeholder="Search...">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="submit"><i
                                                                class="mdi mdi-magnify"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                {{-- <input type="text" placeholder="Search Key" class="form-control">
                                                <i class="fas fa-search"></i> --}}
                                            </form>
                                            <div class="col-12"></div>
                                            <form action="{{ route('SetPaymentDataAddPost', app()->getLocale()) }}"
                                                method="POST"
                                                class="mb-3 form-group row col-8 align-items-center justify-content-between">
                                                @csrf
                                                <label for="key" class="col-1"
                                                    style="margin: 0px; padding:0px 10px; text-align:right;">Key</label>
                                                <input type="text" class="form-control col-4" id="key"
                                                    name="key" placeholder="Enter key" required>
                                                <label for="key" class="col-1"
                                                    style="margin: 0px; padding:0px 10px; text-align:right;">Value</label>
                                                <input type="text" class="form-control col-4" id="value"
                                                    name="value" placeholder="Enter value" required>
                                                {{-- //block buton update configs --}}
                                                <button type="submit" class="btn btn-primary">Add</button>
                                            </form>
                                            <div class="col-12">
                                            </div>

                                            {{-- //add hr line --}}
                                            <hr class="col-12">
                                            @foreach ($configs as $con)
                                                <form id="{{ $con->key }}"
                                                    class="my-4 form-group row col-8 align-items-center justify-content-center">
                                                    <label for="key" class="col-1"
                                                        style="margin: 0px; padding:0px 10px; text-align:right;">Key</label>
                                                    <input type="text" value="{{ $con->key }}"
                                                        class="form-control col-4" id="key{{ $con->key }}"
                                                        name="key" placeholder="Enter key" required>
                                                    <label for="key" class="col-1"
                                                        style="margin: 0px; padding:0px 10px; text-align:right;">Value</label>
                                                    <input type="text" value="{{ $con->value }}"
                                                        class="form-control col-4" id="value{{ $con->key }}"
                                                        name="value" placeholder="Enter value" required>
                                                    {{-- //block buton update configs --}}
                                                    <button type="button"
                                                        onclick="UpdateConfig('{{ $con->key }}',{{ $con->id }},'{{ route('UpdateConfig', app()->getLocale()) }}' , '{{ csrf_token() }}')"
                                                        class="btn btn-primary">Update</button>
                                                    <button type="button" style="height: 100%;"
                                                        onclick="DeleteConfig('{{ $con->key }}',{{ $con->id }},'{{ route('DeleteConfig', app()->getLocale()) }}' , '{{ csrf_token() }}')"
                                                        class="btn btn-danger ml-3">
                                                        {{-- //trash --}}
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endforeach
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            {{ $configs->links() }}
                                        </div>
                                    </div>
                                    <!--end card-body-->
                                </div>
                                <!--end card-->
                            </div> <!-- end col -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        //document ready
        function DeleteConfig(key, id, url, tok) {

            let Formdata = new FormData();
            Formdata.append('_token', tok);
            Formdata.append('id', id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': tok
                }
            })

            $.ajax({
                url: url,
                type: 'POST',
                data: Formdata,
                processData: false,
                contentType: false,
                success: function(data) {
                    console.log(data);
                    if (data.success == 'success') {
                        //remove form
                        document.getElementById(key).remove();
                    } else if (data.success == 'error') {
                        alert('error');
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        function UpdateConfig(key, id, url, tok) {

            FData = new FormData()

            let MyKey = document.getElementById('key' + key).value;
            let MyValue = document.getElementById('value' + key).value;

            FData.append('id', id);
            FData.append('key', MyKey);
            FData.append('value', MyValue);
            FData.append('_token', tok);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': tok
                }
            })

            $.ajax({
                url: url,
                type: 'POST',
                data: FData,
                processData: false,
                contentType: false,
                success: function(data) {
                    alert(data.success);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }
    </script>
    <!-- end page content -->
@endsection
