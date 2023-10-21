@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش تنظیمات سایت</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">اطلاع رسانی</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">اطلاعیه پیامکی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش تنظیمات سایت</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش تنظیمات سایت
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.setting.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.setting.update') }}" method="POST" enctype="multipart/form-data" id="form">
                        @csrf
                        @method('PUT')
                        <section class="row">

                            <section class="col-12 ">
                                <div class="form-group">
                                    <label for=""> نام سایت</label>
                                    <input type="text" class="form-control form-control-sm" name="title"
                                        value="{{ old('title', $setting->title) }}">

                                </div>
                                @error('title')
                                    <div class="">
                                        <span class="alert_require text-danger ">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    </div>
                                @enderror
                            </section>
                            <section class="col-12">
                                <div class="form-group">
                                    <label for=""> آیکون سایت</label>
                                    <input type="file" name="icon" id="">
                                </div>
                                @error('icon')
                                    <div class="">
                                        <span class="alert_require text-danger ">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-12 ">
                                <div class="form-group">
                                    <label for="keywords">کلمات کلیدی </label>
                                    <input type="hidden" class="form-control form-control-sm" name="keywords"
                                        id="keywords" value="{{ old('keywords', $setting->keywords) }}">
                                    <select class="select2 form-control form-control-sm" id="select_keywords" multiple>

                                    </select>
                                </div>
                                @error('keywords')
                                    <div class="">
                                        <span class="alert_require text-danger ">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    </div>
                                @enderror


                                <section class="col-12">
                                    <div class="form-group">
                                        <label for=""> لوگو سایت</label>
                                        <input type="file" name="logo" id="">
                                    </div>
                                    @error('logo')
                                        <div class="">
                                            <span class="alert_require text-danger ">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                        </div>
                                    @enderror
                                </section>

                                <section class="col-12">
                                    <div class="form-group">
                                        <label for=""> توضیحات سایت</label>
                                        <textarea name="description" id="description" class="form-control form-control-sm" rows="6" name="description">{{ old('description', $setting->description) }}</textarea>
                                    </div>
                                    @error('description')
                                        <div class="">
                                            <span class="alert_require text-danger ">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                        </div>
                                    @enderror
                                </section>






                                <section class="col-12">
                                    <button class="btn btn-primary btn-sm">ثبت</button>
                                </section>
                            </section>
                    </form>
                </section>

            </section>
        </section>
    </section>
@endsection
@section('script')
    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('description');
    </script>


    <script script>
        $(document).ready(function() {
            var tags_input = $('#keywords');
            var select_tags = $('#select_keywords');
            var default_tags = tags_input.val();
            var default_data = null;

            if (tags_input.val() !== null && tags_input.val().length > 0) {
                default_data = default_tags.split(',');
            }

            select_tags.select2({
                placeholder: 'لطفا تگ های خود را وارد نمایید',
                tags: true,
                data: default_data
            });
            select_tags.children('option').attr('selected', true).trigger('change');


            $('#form').submit(function(event) {
                if (select_tags.val() !== null && select_tags.val().length > 0) {
                    var selectedSource = select_tags.val().join(',');
                    tags_input.val(selectedSource)
                }
            })
        })
    </script>
@endsection
