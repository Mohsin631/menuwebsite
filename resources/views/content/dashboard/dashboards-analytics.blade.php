@extends('layouts/contentNavbarLayout')

@section('title', 'لوحة التحكم - التحليلات')

@section('vendor-style')
@vite('resources/assets/vendor/libs/apex-charts/apex-charts.scss')
@endsection

@section('vendor-script')
@vite('resources/assets/vendor/libs/apex-charts/apexcharts.js')
@endsection

@section('page-script')
@vite('resources/assets/js/dashboards-analytics.js')
@endsection

@section('content')
<div class="row">
  
  <!-- قسم آخر الطلبات -->
  <div class="col-lg-6 col-md-12 mb-4">
    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <h5 class="mb-0">آخر الطلبات</h5>
        <div class="dropdown">
          <button class="btn p-0" type="button" id="latestOrders" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bx bx-dots-vertical-rounded"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="latestOrders">
            <a class="dropdown-item" href="javascript:void(0);">عرض المزيد</a>
            <a class="dropdown-item" href="javascript:void(0);">تحديث</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <ul class="list-group">
          @forelse($latestOrders as $order)
          <li class="list-group-item d-flex justify-content-between align-items-center">
            طلب #{{ $order->id }} - {{ $order->created_at->format('d M, Y') }}
            <span class="badge bg-primary rounded-pill">${{ $order->menuItem->price }}</span>
          </li>
          @empty
          <li class="list-group-item">لا توجد طلبات حديثة.</li>
          @endforelse
        </ul>
      </div>
    </div>
  </div>

  <!-- قسم القائمة -->
  <div class="col-lg-6 col-md-12 mb-4">
    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <h5 class="mb-0">القائمة</h5>
        <div class="dropdown">
          <button class="btn p-0" type="button" id="menuOptions" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bx bx-dots-vertical-rounded"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="menuOptions">
            <a class="dropdown-item" href="javascript:void(0);">عرض المزيد</a>
            <a class="dropdown-item" href="javascript:void(0);">تحديث</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <ul class="list-group">
          @forelse($menuItems as $menuItem)
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ $menuItem->name }}
            <span class="badge bg-primary rounded-pill">${{ $menuItem->price }}</span>
          </li>
          @empty
          <li class="list-group-item">لا توجد عناصر قائمة متاحة.</li>
          @endforelse
        </ul>
      </div>
    </div>
  </div>

  <!-- قسم العملاء -->
  <div class="col-lg-6 col-md-12 mb-4">
    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <h5 class="mb-0">العملاء</h5>
        <div class="dropdown">
          <button class="btn p-0" type="button" id="customerOptions" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bx bx-dots-vertical-rounded"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="customerOptions">
            <a class="dropdown-item" href="javascript:void(0);">عرض المزيد</a>
            <a class="dropdown-item" href="javascript:void(0);">تحديث</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <ul class="list-group">
          @forelse($customers as $customer)
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="{{ route('customers.show', $customer->id) }}">
              {{ $customer->name }}
          </a>  
            <span class="badge bg-secondary rounded-pill">{{ $customer->orders_count }} طلبات</span>
          </li>
          @empty
          <li class="list-group-item">لا يوجد عملاء متاحون.</li>
          @endforelse
        </ul>
      </div>
    </div>
  </div>

</div>
@endsection
