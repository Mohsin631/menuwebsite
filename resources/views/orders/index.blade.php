@extends('layouts.contentNavbarLayout')

@section('title', 'الطلبات - قائمة الطلبات')

@section('content')
<div class="card">
    <h5 class="card-header">قائمة الطلبات</h5>
    <div class="card-body">
        <!-- Search form -->
        <form method="GET" action="{{ route('orders.index') }}">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="search" placeholder="البحث حسب اسم العميل أو الهاتف أو العنوان" value="{{ request()->input('search') }}">
                <button class="btn btn-outline-secondary" type="submit">بحث</button>
            </div>
        </form>

        <!-- Orders Table -->
        <div class="table-responsive text-nowrap">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>رقم الطلب</th>
                        <th>اسم العميل</th>
                        <th>الهاتف</th>
                        <th>العنوان</th>
                        <th>تفاصيل الطلب</th>
                        <th>المبلغ الإجمالي</th>
                        <th>التاريخ</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>
                                <a href="{{ route('customers.show', $order->customer->id) }}">
                                    {{ $order->customer->name }}
                                </a>                       
                            </td>     
                            <td>{{ $order->customer->phone }}</td>
                            <td>{{ $order->customer->address }}</td>
                            <td>{{ $order->menuItem->name }}</td>
                            <td>{{ $order->menuItem->price }}</td>
                            <td>{{ $order->created_at->format('d-m-Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">لم يتم العثور على طلبات</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
