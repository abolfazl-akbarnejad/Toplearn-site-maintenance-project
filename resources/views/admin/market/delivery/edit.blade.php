@extends('admin.layouts.master')

@section('head-tag')
    <title> ویرایش روش ارسال</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">روش های ارسال</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش روش ارسال</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش روش ارسال
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.delivery.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.delivery.update', $delivery->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">نام روش ارسال</label>
                                    <input type="text" name="name" class="form-control form-control-sm"
                                        value="{{ old('name', $delivery->name) }}">
                                </div>
                                @error('name')
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
                                    <label for="">هزینه روش ارسال</label>
                                    <input type="text" placeholder="هزینه ارسال به تومان" name="amount"
                                        class="form-control form-control-sm" value="{{ old('amount', $delivery->amount) }}">
                                </div>
                                @error('amount')
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
                                    <label for="">زمان ارسال</label>
                                    <input type="text" name="delivery_time" class="form-control form-control-sm"
                                        value="{{ old('delivery_time', $delivery->delivery_time) }}">
                                </div>
                                @error('delivery_time')
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
                                    <label for="">واحد زمان ارسال</label>
                                    <select name="delivery_time_unit" id="" class="form-control form-control-sm">
                                        <option value="دقیقه" @if (old('delivery_time_unit', $delivery->delivery_time_unit) == "دقیقه") selected @endif> دقیقه
                                        </option>
                                        <option value="ساعت" @if (old('delivery_time_unit', $delivery->delivery_time_unit) == "ساعت") selected @endif> ساعت
                                        </option>
                                        <option value="روز" @if (old('delivery_time_unit', $delivery->delivery_time_unit) == "روز") selected @endif> روز
                                        </option>
                                        <option value="هفته" @if (old('delivery_time_unit', $delivery->delivery_time_unit) == "هفته") selected @endif> هفته
                                        </option>
                                        <option value="ماه" @if (old('delivery_time_unit', $delivery->delivery_time_unit) == "ماه") selected @endif> ماه
                                        </option>
                                    </select>
                                </div>
                                @error('delivery_time_unit')
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
