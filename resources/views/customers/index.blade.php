@extends('layouts.contentNavbarLayout')

@section('title', 'العملاء')

@section('content')
<div class="card">
    <h5 class="card-header">قائمة العملاء</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>الهاتف</th>
                    <th>العنوان</th>
                    <th>سجل الطلبات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                <tr>
                    <td>
                        <a href="{{ route('customers.show', $customer->id) }}">
                            {{ $customer->name }}
                        </a>
                    </td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->address }}</td>
                    <td>
                        <ul>
                            @foreach($customer->orders as $order)
                                <li>{{ $order->menuItem->name }} في {{ $order->created_at }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
