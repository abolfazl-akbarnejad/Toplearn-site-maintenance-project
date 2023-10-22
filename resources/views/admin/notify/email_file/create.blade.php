@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد فایل اطلاعیه ایمیلی</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">اطلاع رسانی</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">اطلاعیه {{ $email->subject }} </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">فایل های اطلاعیه {{ $email->subject }}</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page">ایجاد فایل اطلاعیه {{ $email->subject }}
            </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد فایل اطلاعیه ایمیلی {{ $email->subject }}
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.notify.email_file.index', $email->id) }}"
                        class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.notify.email_file.store', $email->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="file">فایل </label>
                                    <input type="file" name="file" 
                                        class="form-control form-control-sm">
                                    <span class="p-3 text-danger" style="font-size: 15px">فایل هایی که میتوانید آپلود
                                        کنید:image, word, power point, video </span>
                                </div>
                                @error('file')
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
        CKEDITOR.replace('body');
    </script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#published_at_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#published_at',
                timePicker: {
                    enabled: true,
                    meridiem: {
                        enabled: true
                    }
                }
            });
        });
    </script>
@endsection
