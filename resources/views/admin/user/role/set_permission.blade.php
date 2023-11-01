@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش سطح درسترسی</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">نقش ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page">ویرایش سطح درسترسی</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش سطح درسترسی
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3  pb-2">
                    <a href="{{ route('admin.user.role.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.user.role.permissionForm.update' , $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <section class="row">



                            @php
                                $rolepermissionsArray = $role->permissions->pluck('id')->toArray();
                            @endphp
                            <section class="col-12">
                                <section class="row border-top  mt-3 py-3">
                                    @foreach ($permissions as $key => $permision)
                                        <section class="col-md-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="permisions[]"
                                                    id="{{ $permision->id }}" value="{{ $permision->id }}"
                                                    @if (in_Array($permision->id, $rolepermissionsArray)) Checked @endif>\
                                                <label for="{{ $permision->id }}" class="form-check-label mr-3 mt-1">
                                                    {{ $permision->name }}
                                                </label>
                                            </div>
                                            @error('permisions.' . $key)
                                                <div class="">
                                                    <span class="alert_require text-danger ">
                                                        <strong>
                                                            {{ $message }}
                                                        </strong>
                                                    </span>
                                                </div>
                                            @enderror
                                        </section>
                                    @endforeach
                                    <section class="col-md-3">




                                    </section>

                                </section>
                            </section>
                            <section class="col-12 col-md-2">
                                <button class="btn btn-primary btn-sm mt-md-4">ثبت</button>
                            </section>
                        </section>
                    </form>
                </section>

            </section>
        </section>
    </section>
@endsection
