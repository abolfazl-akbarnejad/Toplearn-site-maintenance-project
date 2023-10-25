@extends('admin.layouts.master')

@section('head-tag')
    <title>مشتریان</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> مشتریان</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        مشتریان
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.customer.create') }}" class="btn btn-info btn-sm">ایجاد مشتری جدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ایمیل</th>
                                <th>شماره موبایل</th>
                                <th>نام</th>
                                <th>نام خانوادگی</th>
                                <th>کد ملی</th>
                                <th>وضعیت</th>
                                <th> وضعیت فعال سازی</th>
                                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                                <tr>
                                    <th>{{ $key + 1 }}</th>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->mobile }} </td>
                                    <td>{{ $user->first_name }} </td>
                                    <td>{{ $user->last_name }} </td>
                                    <td>{{ $user->national_code }}</td>
                                    <td>
                                        <label>
                                            <input id="{{ $user->id }}" onchange="changeStatus({{ $user->id }})"
                                                data-url="{{ route('admin.user.customer.status', $user->id) }}"
                                                type="checkbox" @if ($user->status === 1) checked @endif>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input id="{{ $user->id }}-activation"
                                                onchange="changeActivation({{ $user->id }})"
                                                data-url="{{ route('admin.user.customer.activation', $user->id) }}"
                                                type="checkbox" @if ($user->activation === 1) checked @endif>
                                        </label>
                                    </td>
                                    <td class="width-22-rem text-left">

                                        <a href="{{ route('admin.user.customer.edit', $user->id) }}"
                                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>
                                            ویرایش</a>
                                        <form action="{{ route('admin.user.customer.destroy', $user->id) }}" method="POST"
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
    <script type="text/javascript">
        function changeActivation(id) {
            var element = $("#" + id + '-activation')
            var url = element.attr('data-url')
            var elementValue = !element.prop('checked');

            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    if (response.commantable) {
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
