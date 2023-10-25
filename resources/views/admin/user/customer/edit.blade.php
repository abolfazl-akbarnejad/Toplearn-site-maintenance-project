@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش کاربر مشتری</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">مشتریان</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش کاربر مشتری</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش کاربر مشتری
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.customer.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.user.customer.update', $user->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">نام</label>
                                    <input type="text" name="first_name" class="form-control form-control-sm"
                                        value="{{ old('first_name', $user->first_name) }}">
                                </div>

                                @error('first_name')
                                    <div class="">
                                        <span class="alert_require text-danger ">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    </div>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">نام خانوادگی</label>
                                    <input type="text" name="last_name" class="form-control form-control-sm"
                                        value="{{ old('last_name', $user->last_name) }}">
                                </div>
                                @error('last_name')
                                    <div class="">
                                        <span class="alert_require text-danger ">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    </div>
                                @enderror
                            </section>

                    

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">تصویر</label>
                                    <input type="file" name="profile_photo_path" class="form-control form-control-sm">
                               <img src="{{asset($user->profile_photo_path)}}" width="90px" height="48px" alt="">
                                </div>
                                @error('profile_photo_path')
                                    <div class="">
                                        <span class="alert_require text-danger ">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    </div>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">وضعیت فعال بودن کاربر</label>
                                    <select name="activation" id="activation" class="form-control form-control-sm">
                                        <option value="0" @if (old('activation', $user->activation) == 0) selected @endif>غیر فعال
                                        </option>
                                        <option value="1" @if (old('activation', $user->activation) == 1) selected @endif>فعال
                                        </option>
                                    </select>
                                </div>
                                @error('activation')
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
    </section>
@endsection
