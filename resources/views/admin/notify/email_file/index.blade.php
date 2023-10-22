@extends('admin.layouts.master')

@section('head-tag')
    <title>فایل های اطلاعیه ایمیلی </title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">اطلاع رسانی</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">اطلاعیه {{ $email->subject }} </a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> فایل های اطلاعیه {{ $email->subject }}</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        فایل های اطلاعیه ایمیلی
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.notify.email_file.create', $email->id) }}" class="btn btn-info btn-sm">ایجاد
                        فایل های
                        اطلاعیه ایمیلی</a>
                    <div class="max-width-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان اطلاعیه</th>
                                <th>نوع فایل </th>
                                <th>اندازه فایل</th>
                                <th> وضعیت </th>
                                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($email->files as $key => $mail)
                                <tr>
                                    <th>{{ $key += 1 }}</th>
                                    <td>{{ $email->subject }}</td>
                                    <td>{{ $mail->file_type }}</td>
                                    <td>مگابایت {{ $mail->file_size }} </td>
                                    <td>
                                        <label>
                                            <input id="{{ $email->id }}" onchange="changeStatus({{ $email->id }})"
                                                data-url="{{ route('admin.content.email.status', $email->id) }}"
                                                type="checkbox" @if ($email->status === 1) checked @endif>
                                        </label>
                                    </td>
                                    <td class="width-17-rem text-left">

                                        <a href="{{ route('admin.notify.email.edit', $email->id) }}"
                                            class="btn btn-info btn-sm"><i class="fa fa-edit"></i> ویرایش</a>


                                        <form action="{{ route('admin.notify.email.destroy', $email->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm delete" type="submit"><i
                                                    class="fa fa-trash-alt"></i>
                                                حذف</button>
                                        </form>
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
    @include('admin.alerts.sweetalert.delete_conferm', ['className' => 'delete'])
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
@endsection
