@extends('layouts.contentNavbarLayout')

@section('title', 'تفاصيل العميل')

@section('content')
<div class="container">
    <h1>تفاصيل العميل: {{ $customer->name }}</h1>
    <div class="row">
        <div class="col-md-6">
            <h4>معلومات العميل</h4>
            <ul>
                <li><strong>الاسم:</strong> {{ $customer->name }}</li>
                <li><strong>الهاتف:</strong> {{ $customer->phone }}</li>
                <li><strong>العنوان:</strong> {{ $customer->address }}</li>
            </ul>
        </div>

        <div class="col-md-6">
            <h4>آخر طلب</h4>
            @if ($latestOrder)
                <p><strong>رقم الطلب:</strong> {{ $latestOrder->id }}</p>
                <p><strong>تفاصيل الطلب:</strong> {{ $latestOrder->menuItem->name }}</p>
                <p><strong>التاريخ:</strong> {{ $latestOrder->created_at->format('d M Y, H:i') }}</p>
            @else
                <p>لا توجد طلبات حديثة.</p>
            @endif
        </div>
    </div>

    <hr>

    <h4>سجل الطلبات</h4>
    <div class="table-responsive">
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th>رقم الطلب</th>
                    <th>التفاصيل</th>
                    <th>التاريخ</th>
                    <th>السعر</th>
                    <th>الحالة</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->menuItem->name }}</td>
                        <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                        <td>{{ $order->menuItem->price }}</td>
                        <td>
                            <span class="badge bg-{{ $order->status === 'completed' ? 'success' : 'warning' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <hr>

    <h4>الطلبات المفضلة</h4>
    @if ($favoriteOrders->count() > 0)
        <ul>
            @foreach ($favoriteOrders as $favoriteOrder)
                <li>
                    <strong>رقم الطلب:</strong> {{ $favoriteOrder->id }},
                    <strong>التفاصيل:</strong> {{ $favoriteOrder->order_details }},
                    <strong>التاريخ:</strong> {{ $favoriteOrder->created_at->format('d M Y, H:i') }}
                </li>
            @endforeach
        </ul>
    @else
        <p>لا توجد طلبات مفضلة.</p>
    @endif
</div>
@endsection
