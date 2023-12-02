@extends('admin.layouts.master')

@section('head-tag')
    <title>نمایش نظر ها</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> نظرات</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نمایش نظر ها</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        نمایش نظرها
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.comment.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section class="card mb-3">
                    <section class="card-header text-white bg-custom-yellow">
                        {{ $comment->user->first_name }} - {{ $comment->user->id }}
                    </section>
                    <section class="card-body">
                        <h5 class="card-title">تایتل پست : {{ $comment->post->title }} / کد پست:{{ $comment->post->id }}
                        </h5>
                        <p class="card-text">{{ $comment->body }}</p>
                    </section>
                </section>

                <section>
                    <form action="{{ route('admin.content.comment.answer', $comment->id) }}" method="post">
                        @csrf
                        <section class="row">
                            <section class="col-12">
                                <div class="form-group">
                                    <label for="">پاسخ ادمین</label>
                                    ‍
                                    <textarea class="form-control form-control-sm" rows="4" name="body"></textarea>
                                </div>
                            </section>
                            <section class="col-12">
                                <button class="btn btn-primary btn-sm">ثبت</button>
                            </section>
                        </section>
                    </form>
                </section>

                <section class="m-3 ">
                    <h4>پاسخ ها</h4>
                    @foreach ($answers as $answer)
                        <div class="d-flex m-4 border border-dark justify-content-between">
                            <div class="  p-4 d-flex flex-column">
                                <label for="">
                                    <div class=" d-flex">نام ادمین :
                                        {{ $answer->user->first_name . ' ' . $answer->user->last_name }}
                                        -{{ $answer->user->id }}</div>

                                </label>
                                <span class="mt-2">
                                    پاسخ: {{ $answer->body }}
                                </span>
                                <div class="">
                                    <div class=""></div>
                                </div>
                            </div>
                            <div class="m-4">
                                @if ($answer->status == 0)
                                    <a href="{{ route('admin.content.comment.answerStatus', $answer->id) }}"
                                        class="btn btn-success">فعال</a>
                                @else
                                    <a href="{{ route('admin.content.comment.answerStatus', $answer->id) }}"
                                        class="btn btn-warning">غیر فعال</a>
                                @endif

                                <form action="{{ route('admin.content.comment.destroy', $answer->id) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm delete" type="submit"><i
                                            class="fa fa-trash-alt"></i>
                                        حذف</button>
                                </form>


                            </div>
                        </div>
                    @endforeach
                </section>

            </section>
        </section>
    </section>
@endsection
