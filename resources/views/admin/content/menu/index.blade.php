@extends('admin.layouts.master')

@section('head-tag')
    <title>منو</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> منو</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        منو
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.menu.create') }}" class="btn btn-info btn-sm">ایجاد منوی جدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نام منو</th>
                                <th>منوی والد</th>
                                <th> لینک منو</th>
                                <th> وضعیت</th>
                                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menus as $key => $menu)
                                <tr>
                                    <th>{{ $key += 1 }}</th>
                                    <td>{{ $menu->name }}</td>
                                    <td>
                                        @if ($menu->children?->name != null)
                                            {{ $menu->children->name }}
                                        @else
                                            منوی اصلی
                                        @endif
                                    </td>

                                    <td><a href="{{ $menu->url }}" target="_blonk">{{ $menu->url }}</a></td>
                                    <td>
                                        <label>
                                            <input id="{{ $menu->id }}" onchange="changeStatus({{ $menu->id }})"
                                                data-url="{{ route('admin.content.menu.status', $menu->id) }}"
                                                type="checkbox" @if ($menu->status === 1) checked @endif>
                                        </label>
                                    </td>
                                    <td class="width-16-rem text-left">
                                        <a href="{{ route('admin.content.menu.edit', $menu->id) }}"
                                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>
                                            ویرایش</a>
                                        <form action="{{ route('admin.content.menu.destroy', $menu->id) }}" method="POST"
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
