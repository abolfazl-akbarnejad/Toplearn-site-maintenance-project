@extends('admin.layouts.master')

@section('head-tag')
    <title>اضافه کردن به انبار</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">انبار</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> اضافه کردن به انبار</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        اضافه کردن به انبار
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.store.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.store.store', $product->id) }}" method="POST">
                        @csrf
                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">نام تحویل گیرنده</label>
                                    <input type="text" name="transferee" value="{{ old('transferee') }}"
                                        class="form-control form-control-sm">
                                </div>
                                @error('transferee')
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
                                <label for="">نام تحویل دهنده</label>
                                <input type="text" name="delivery" value="{{ old('delivery') }}"
                                    class="form-control form-control-sm">
                            </div>
                            @error('delivery')
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
                        <label for="">تعداد</label>
                        <input type="text" name="marketable_number" value="{{ old('marketable_number') }}"
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



            <section class="col-12">
                <div class="form-group">
                    <label for="">توضیحات</label>
                    <textarea name="description" rows="4" class="form-control form-control-sm">{{ old('description') }}</textarea>
                </div>
                @error('description')
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
