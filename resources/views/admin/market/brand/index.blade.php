@extends('admin.layouts.master')

@section('head-tag')
    <title>برند</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page">برند ها</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        برند ها
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.brand.create') }}" class="btn btn-info btn-sm">ایجاد برند </a>
                    <div class="max-width-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نام برند</th>
                                <th>لوگو</th>
                                <th>وضعیت</th>

                                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $key => $brand)
                                <tr>
                                    <th>{{ $key + 1 }}</th>
                                    <td>{{ $brand->persian_name }} </td>

                                    <td><img src="{{ asset($brand->logo) }}" alt="" class="max-height-2rem"></td>
                                    <td>
                                        <label>
                                            <input id="{{ $brand->id }}" onchange="changeStatus({{ $brand->id }})"
                                                data-url="{{ route('admin.market.brand.status', $brand->id) }}"
                                                type="checkbox" @if ($brand->status === 1) checked @endif>
                                        </label>
                                    </td>
                                    <td class="width-16-rem text-left">
                                        <a href="{{ route('admin.market.brand.edit', $brand->id) }}"
                                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>
                                            ویرایش</a>
                                        <form action="{{ route('admin.market.brand.destroy', $brand->id) }}" method="POST"
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
