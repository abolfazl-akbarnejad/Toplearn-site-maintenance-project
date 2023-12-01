@extends('admin.layouts.master')

@section('head-tag')
    <title>مقدار فرم کالا</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> مقدار فرم کالا</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        مقدار فرم کالا
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.property.value.create', $category_attribute->id) }}"
                        class="btn btn-info btn-sm">ایجاد مقدار فرم
                        کالا
                        جدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th> نام محصول</th>
                                <th>فرم والد</th>
                                <th>مقدار </th>
                                <th>افزایش قیمت</th>
                                <th>نوع</th>
                                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category_attribute->Attribute_value as $key => $category_value)
                                <tr>
                                    <th>{{ $key + 1 }}</th>
                                    <td>{{ $category_value->product->name }} </td>
                                    <td>{{ $category_attribute->name }} </td>
        
                                    <td>{{ json_decode($category_value->value)->value?? "وارد نشده" }}</td>
                                    <td>{{ json_decode($category_value->value)->price ?? "وارد نشده" }}</td>
              
                                    <td>{{ $category_value->type == 0? "ساده" : 'انتخابی'}}</td>
                                    <td class="width-22-rem text-left">

                                        <a href="{{ route('admin.market.property.value.edit', ['category_attribute' => $category_attribute->id, 'value' => $category_value]) }}"
                                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>
                                            ویرایش</a>
                                        <form
                                            action="{{ route('admin.market.property.value.destroy', ['category_attribute' => $category_attribute->id, 'value' => $category_value]) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger  delete" type="submit"><i
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
