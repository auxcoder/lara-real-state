@extends('frontend.layouts.app')
@section('content')
    <div class="detail">
        <div class="row">
            <div class="col-md-12">
                <div class="payment-detail">
                    <h3>Payment Plan</h3>
                    <p>Binghatti Dawn presents flexible payment plans by Binghatti Developers tailored to meet the diverse
                        needs of prospective homeowners.</p>
                    @if (!empty($developer_property->paymentPlan))
                        @foreach ($developer_property->paymentPlan as $index => $paymentPlan)
                            <h3>{{ $index + 1 }}- {{ $paymentPlan['heading'] }}</h3>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Installment</th>
                                        <th>Payment (%)</th>
                                        <th>Milestone</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($paymentPlan['installments'] as $installment)
                                        <tr>
                                            <td>{{ $installment['installment'] }}</td>
                                            <td>{{ $installment['payment'] }}%</td>
                                            <td>{{ $installment['milestone'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
