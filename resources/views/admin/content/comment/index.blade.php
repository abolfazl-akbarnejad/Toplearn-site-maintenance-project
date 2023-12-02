@extends('admin.layouts.master')

@section('head-tag')
    <title>نظرات</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نظرات</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        نظرات
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="#" class="btn btn-info btn-sm disabled">ایجاد نظر </a>
                    <div class="max-width-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>کد کاربر</th>
                                <th>نویسنده نظر</th>
                                <th>کد پست</th>
                                <th>پست</th>
                                <th>وضعیت تایید</th>
                                <th>وضعیت کامنت</th>
                                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comments as $key => $comment)
                                <tr>
                                    <th>{{ $key += 1 }}</th>
                                    <td>{{ $comment->user->id }}</td>
                                    <td>{{ $comment->user->first_name }} </td>
                                    <td>{{ $comment->post->id }}</td>
                                    <td>{{ $comment->post->title }}</td>

                                    <td>
                                        {{ $comment->approved == 0 ? 'در انتظار تایید' : 'تایید شده' }}
                                    </td>
                                    <td>
                                        {{ $comment->seen == 0 ? 'هنوز دیده نشده' : 'دیده شده' }}
                                    </td>
                                    <td>
                                        <label>
                                            <input id="{{ $comment->id }}" onchange="changeStatus({{ $comment->id }})"
                                                data-url="{{ route('admin.content.comment.status', $comment->id) }}"
                                                type="checkbox" @if ($comment->status === 1) checked @endif>
                                        </label>
                                    </td>
                                    <td class="width-16-rem text-left">
                                        <a href="{{ route('admin.content.comment.show', $comment->id) }}"
                                            class="btn btn-info btn-sm"><i class="fa fa-eye"></i> نمایش</a>

                                        <div class="d-inline" id="statusApproved">
                                            @if ($comment->approved == 0)
                                                <a href="{{ route('admin.content.comment.approved', $comment->id) }}"
                                                    class="btn btn-success btn-sm" type="submit"><i class="fa fa-check"
                                                        onclick="ChangeApproved({{ $comment->id }})"
                                                        data-url="{{ route('admin.content.comment.approved', $comment->id) }}"
                                                        id="approvedSuccses"></i>
                                                    تایید</a>
                                                <a></a>
                                            @else
                                                <a href="{{ route('admin.content.comment.approved', $comment->id) }}"
                                                    class="btn btn-warning btn-sm" type="submit"><i class="fa fa-check"
                                                        onclick="ChangeApproved({{ $comment->id }})"
                                                        data-url="{{ route('admin.content.comment.approved', $comment->id) }}"
                                                        id="approvedWarning"></i>
                                                    عدم تایید</a>
                                            @endif

                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </section>

            </section>
        </section>
    </section>
@endsection
@section('alert')
    @include('admin.alerts.sweetalert.success')
    @include('admin.alerts.sweetalert.error')
@endsection

@section('script')
    <script type="text/javascript">
        function changeStatus(id) {
            var element = $("#" + id)
            var url = element.attr('data-url')
            var elementValue = !element.prop('checked');

            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    if (response.status) {
                        if (response.checked)
                            element.prop('checked', true);
                        else
                            element.prop('checked', false);
                    } else {
                        // element.prop('checked', elementValue);
                    }
                }
            })
        }
    </script>
    {{-- <script>
        function ChangeApproved(id) {

            var element = $('#' + id);
            var url = element.attr('data-url');
            var buttonSuccses = $('#approvedSuccses');
            var buttonWarning = $('#approvedWarning');
            var statusApproved = $('#statusApproved')
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    if (response.statusApproved == true) {
                        if (response.approved == 0) {
                            $(statusApproved).append(buttonSuccses);
                        } else {
                            $(statusApproved).append(buttonWarning);

                        }
                    }


                }
            });
        }
    </script> --}}
@endsection
