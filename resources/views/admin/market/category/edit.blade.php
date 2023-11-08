@extends('admin.layouts.master')

@section('head-tag')
    <title>
        ویرایش دسته بندی </title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">دسته بندی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش دسته بندی</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش دسته بندی
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.category.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.category.update' , $category->id) }}" method="POST" enctype="multipart/form-data"
                        id="form">
                        @csrf
                        @method('PUT')
                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">نام دسته</label>
                                    <input type="text" class="form-control form-control-sm" name="name"
                                        value="{{ old('name', $category->name) }}">
                                </div>
                                <div class=""> @error('name')
                                        <span class="alert_require text-danger ">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="tags">تگ ها</label>
                                    <input type="hidden" class="form-control form-control-sm" name="tags" id="tags"
                                        value="{{ old('tags', $category->tags) }}">
                                    <select class="select2 form-control form-control-sm" id="select_tags" multiple>

                                    </select>
                                </div>
                                @error('tags')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">تصویر</label>
                                    <input type="file" class="form-control form-control-sm" name="image">
                                    <img src="{{asset($category->image)}}" class="m-3" alt="">
                                </div>
                                <div class=""> @error('image')
                                        <span class="alert_require text-danger ">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">وضعیت</label>
                                    <select name="status" id="" class="form-control form-control-sm">
                                        <option value="0" @if (old('status', $category->status) == 0) selected @endif> غیرفعال
                                        </option>
                                        <option value="1" @if (old('status', $category->status) == 1) selected @endif> فعال
                                        </option>
                                    </select>
                                </div>
                            </section>


                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">وضعیت نمایش در منو</label>
                                    <select name="show_in_menu" id="" class="form-control form-control-sm">
                                        <option value="0" @if (old('show_in_menu', $category->show_in_menu) == 0) selected @endif> غیرفعال
                                        </option>
                                        <option value="1" @if (old('show_in_menu', $category->show_in_menu) == 1) selected @endif> فعال
                                        </option>
                                    </select>
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">منو والد</label>
                                    <select name="parent_id" id="" class="form-control form-control-sm">
                                        <option value="0" @if (old('parent_id', $category->parent_id) == 0) selected @endif>منوی اصلی
                                        </option>

                                        @foreach ($product_categories as $product_category)
                                            <option value="{{ $product_category->id }}"
                                                @if ($product_category->id == old('parent_id', $product_category->parent_id)) selected @endif>
                                                {{ $product_category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('parent_id')
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
                                    <label for="">توضیحات</label>
                                    <textarea name="description" id="description">{{ old('description', $category->description) }}</textarea>
                                </div>
                                <div class="mb-4"> @error('description')
                                        <span class="alert_require text-danger ">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>
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
    <script>
        $(document).ready(function() {
            var tags_input = $('#tags');
            var select_tags = $('#select_tags');
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
