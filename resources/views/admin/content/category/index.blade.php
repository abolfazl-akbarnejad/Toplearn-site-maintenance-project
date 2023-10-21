@extends('admin.layouts.master')

@section('head-tag')
    <title>دسته بندی</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> دسته بندی</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        دسته بندی
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.category.create') }}" class="btn btn-info btn-sm">ایجاد دسته بندی</a>
                    <div class="max-width-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نام دسته بندی</th>
                                <th>توضیحات</th>
                                <th>اسلاگ</th>
                                <th>نگ ها</th>
                                <th>عکس</th>
                                <th>وضعیت</th>
                                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($postCategories as $key => $postCategory)
                                <tr>
                                    <th>{{ $key += 1 }}</th>
                                    <td>{{ $postCategory->name }}</td>
                                    <td>{!! $postCategory->description !!}</td>
                                    <td>{{ $postCategory->slug }}</td>
                                    <td>{{ $postCategory->tags }}</td>
                                    <td><img src=" {{ asset($postCategory->image) }}" alt="{{ $postCategory->image }}">
                                    </td>
                                    <td>
                                        <label>
                                            <input id="{{ $postCategory->id }}"
                                                onchange="changeStatus({{ $postCategory->id }})"
                                                data-url="{{ route('admin.content.category.status', $postCategory->id) }}"
                                                type="checkbox" @if ($postCategory->status === 1) checked @endif>
                                        </label>
                                    </td>

                                    <td class="width-16-rem text-left">
                                        <a href="{{ route('admin.content.category.edit', $postCategory->id) }}"
                                            class="btn btn-primary btn-sm">

                                            <i class="fa fa-edit"></i>
                                            ویرایش</a>

                                        <form action="{{ route('admin.content.category.destroy', $postCategory->id) }}"
                                            method="POST" class="d-inline">
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
@section('alert')
    @include('admin.alerts.sweetalert.error')
    @include('admin.alerts.sweetalert.success')
    @include('admin.alerts.sweetalert.delete_conferm', ['className' => 'delete'])
@endsection

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
