@extends('admin.layouts.master')

@section('head-tag')
    <title>اصلاح کردن انبار</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">انبار</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> اصلاح کردن انبار</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        اصلاح کردن انبار
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.store.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.store.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')


                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for=""> تعداد موجود در انبار</label>
                                <input type="text" name="marketable_number"
                                    value="{{ old('marketable_number', $product->marketable_number) }}"
                                    class="form-control form-control-sm">
                            </div>
                            @error('marketable_number')
                                <div class="">
                                    <span class="alert_require text-danger ">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                </div>
                            @enderror
                        </section>
                </section>




                <section class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="">تعداد رزرو شده در سبد خرید</label>
                        <input type="text" name="frozen_number"
                            value="{{ old('frozen_number', $product->frozen_number) }}"
                            class="form-control form-control-sm">
                    </div>
                    @error('frozen_number')
                        <div class="">
                            <span class="alert_require text-danger ">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        </div>
                    @enderror
                </section>
            </section>




            <section class="col-12 col-md-6">
                <div class="form-group">
                    <label for="">تعداد فروخته شده</label>
                    <input type="text" name="sold_number" value="{{ old('sold_number', $product->sold_number) }}"
                        class="form-control form-control-sm">
                </div>
                @error('sold_number')
                    <div class="">
                        <span class="alert_require text-danger ">
                            <strong>
                                {{ $message }}
                            </strong>
                        </span>
                    </div>
                @enderror
            </section>
        </section>





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
