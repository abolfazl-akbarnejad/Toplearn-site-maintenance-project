@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش فرم کالا </title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">فرم کالا</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش مقدار فرم کالا</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ({{ $category_attribute->name }}) ویرایش مقدار فرم کالا
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.property.value.index', $category_attribute->id) }}"
                        class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form
                        action="{{ route('admin.market.property.value.update', ['category_attribute' => $category_attribute->id, 'value' => $value->id]) }}"
                        method="POST">
                        @csrf
                        @method('PUT')

                        <section class="row">

                            <section class="col-12 col-md-6">




                                <section class="col-12 col-md-6 ">
                                    <div class="form-group">
                                        <label for="">انتخاب محصول </label>
                                        <select name="product_id" id="" class="form-control form-control-sm">
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}"
                                                    @if (old('product_id', $value->product_id) == $product->id) selected @endif>
                                                    {{ $product->name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>

                                    @error('product_id')
                                        <div class="">
                                            <span class="alert_require text-danger ">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                        </div>
                                    @enderror
                                </section>




                                <section class="col-12 col-md-6 ">
                                    <div class="form-group">
                                        <label for="">نوع</label>
                                        <select name="type" id="" class="form-control form-control-sm">
                                            type
                                            <option value="0" @if (old('type', $value->type) == 0) selected @endif>
                                                ساده
                                            </option>

                                            <option value="1" @if (old('type', $value->type) == 1) selected @endif>
                                                انتخابی
                                            </option>

                                        </select>
                                    </div>

                                    @error('type')
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
                                        <label for="">مقدار</label>
                                        <input type="text" name="value" class="form-control form-control-sm"
                                            value="{{ old('value',json_decode($value->value )->value) }}">
                                    </div>

                                    @error('value')
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
                                        <label for="">افزایش قیمت کالا </label>
                                        <input type="text" class="form-control form-control-sm" name="price_increase"
                                            value="{{ old('price_increase'  , json_decode($value->value )->price) }}">
                                    </div>
                                    @error('price_increase')
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
                                    <button class="btn btn-primary btn-sm">ثبت</button>
                                </section>
                            </section>
                    </form>
                </section>

            </section>
        </section>
    </section>
@endsection
