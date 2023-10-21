@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش پست</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">پست</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش پست</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش پست
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.post.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.content.post.update', $post->id) }}" method="POST"
                        enctype="multipart/form-data" id="form">
                        @csrf
                        @method('PUT')

                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">عنوان پست</label>
                                    <input type="text" name="title" class="form-control form-control-sm"
                                        value="{{ old('title', $post->title) }}">
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

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="category_id">انتخاب دسته</label>
                                    <select name="category_id" id="" class="form-control form-control-sm">
                                        @foreach ($postCategories as $postCategory)
                                            <option value="{{ $postCategory->id }}"
                                                @if (old('category_id', $post->category_id) == $postCategory->id) selected @endif>{{ $postCategory->name }}
                                            </option>
                                        @endforeach
                                        @error('category_id')
                                            <div class="">
                                                <span class="alert_require text-danger ">
                                                    <strong>
                                                        {{ $message }}
                                                    </strong>
                                                </span>
                                            </div>
                                        @enderror
                                    </select>
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">تصویر </label>
                                    <input type="file" name="image" class="form-control form-control-sm">
                                </div>
                                @error('image')
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
                                    <label for="">وضعیت</label>
                                    <select name="status" id="" class="form-control form-control-sm">
                                        <option value="0" @if (old('status', $post->status) == 0) selected @endif> غیرفعال
                                        </option>
                                        <option value="1" @if (old('status', $post->status) == 1) selected @endif> فعال
                                        </option>
                                    </select>
                                </div>
                                @error('status')
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
                                    <label for="">امکان درج کامنت</label>
                                    <select name="commentable" id="" class="form-control form-control-sm">
                                        <option value="0" @if (old('commentable', $post->commentable) == 0) selected @endif> غیرفعال
                                        </option>
                                        <option value="1" @if (old('commentable', $post->commentable) == 1) selected @endif> فعال
                                        </option>
                                    </select>
                                </div>
                                @error('commentable')
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
                                    <label for="">تاریخ انتشار</label>
                                    <input type="text" name="published_at" id="published_at"
                                        class="form-control form-control-sm d-none" value="{{ old('published_at') }}">
                                    <input type="text" id="published_at_view" class="form-control form-control-sm">
                                </div>
                                @error('published_at')
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
                                    <label for="tags">تگ ها</label>
                                    <input type="hidden" class="form-control form-control-sm" name="tags" id="tags"
                                        value="{{ old('tags', $post->tags) }}">
                                    <select class="select2 form-control form-control-sm" id="select_tags" multiple>

                                    </select>
                                </div>
                                @error('tags')
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
                                    <label for="">خلاصه متن پست </label>
                                    <textarea name="summary" id="summary" class="form-control form-control-sm" rows="6">{{ old('summary', $post->summary) }}</textarea>
                                </div>
                                @error('summary')
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
                                    <label for="">متن پست</label>
                                    <textarea name="body" id="body" class="form-control form-control-sm" rows="6">{{ old('body', $post->body) }}</textarea>
                                </div>
                                @error('body')
                                    <div class="">
                                        <span class="alert_require text-danger ">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    </div>
                                @enderror
                            </section>

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
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>

    <script>
        CKEDITOR.replace('body');
        CKEDITOR.replace('summary');
    </script>
    <script>
        $(document).ready(function() {
            $('#published_at_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#published_at'
            });
        });
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