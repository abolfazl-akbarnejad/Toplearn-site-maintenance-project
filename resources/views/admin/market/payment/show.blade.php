@extends('admin.layouts.master')

@section('head-tag')
    <title>نمایش پرداخت</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> پرداخت ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نمایش پرداخت</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        نمایش پرداخت
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.payment.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section class="card mb-3">
                    <section class="card-header text-white bg-custom-yellow">
                        {{ $payment->user->first_name }} - {{ $payment->user->id }}
                    </section>
                    <section class="card-body">
                        @if ($payment->type == 0)
                            <h5 class="card-title">
                                پرداخت شده به شکل:آنلاین
                            </h5>
                            <h6>
                                مبلغ:{{ $payment_value->amount }} تومان
                            </h6>
                            <h6>
                                درگاه پرداخت بانک:{{ $payment_value->deteway ?? ' وارد نشده' }}
                            </h6>
                            <h6>
                                کد تراکنش:{{ $payment_value->transaction_id ?? ' وارد نشده' }}
                            </h6>
                        @elseif ($payment->type == 1)
                            <h5 class="card-title">
                                پرداخت شده به شکل:آفلاین
                            </h5>
                            <h6>
                                مبلغ:{{ $payment_value->amount }} تومان
                            </h6>
                            <h6>
                                کد تراکنش:{{ $payment_value->transaction_id ?? ' وارد نشده' }}
                            </h6>

                            <h6>
                                پرداخت شده در تاریخ:{{ $payment_value->pay_date ?? ' وارد نشده' }}
                            </h6>
                        @elseif ($payment->type == 2)
                            <h5 class="card-title">
                                پرداخت شده به شکل:در محل
                            </h5>
                        @endif



                        <h6>

                        </h6>

                    </section>
                </section>


            </section>
        </section>
    </section>
@endsection
