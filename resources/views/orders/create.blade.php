@extends('layouts/contentNavbarLayout')

@section('title', 'إنشاء طلب')

@section('content')
<div class="card">
    <h5 class="card-header">إنشاء طلب</h5>
    <div class="card-body">
        <form action="{{ route('orders.store') }}" method="POST" id="orderForm">
            @csrf

            <!-- Customer Search Section -->
            <div class="mb-3">
                <label for="customer-search" class="form-label">بحث عن عميل موجود</label>
                <input type="text" id="customer-search" class="form-control" placeholder="ابحث بالاسم أو الهاتف" onkeyup="searchCustomer()">
                <select id="customer" name="customer_id" class="form-select mt-2">
                    <option value="">اختر العميل</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" data-name="{{ $customer->name }}" data-phone="{{ $customer->phone }}">{{ $customer->name }} ({{ $customer->phone }})</option>
                    @endforeach
                </select>
                <div id="customer-not-found" class="mt-2" style="display: none;">
                    <p>العميل غير موجود. يرجى ملء الحقول أدناه لإنشاء عميل جديد.</p>
                </div>
            </div>

            <!-- New Customer Fields -->
            <div id="new-customer-fields" style="display: none;">
                <div class="mb-3">
                    <label for="name" class="form-label">اسم العميل الجديد</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="أدخل الاسم">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">العنوان</label>
                    <input type="text" class="form-control" name="address" id="address" placeholder="أدخل العنوان">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">الهاتف</label>
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="أدخل رقم الهاتف">
                </div>
            </div>

            <!-- Menu Selection -->
            <div class="mb-3">
                <label for="menu_id" class="form-label">اختر من القائمة</label>
                <select class="form-select" name="menu_id" required>
                    @foreach ($menus as $menu)
                        <option value="{{ $menu->id }}">{{ $menu->name }} - ${{ $menu->price }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">إنشاء طلب</button>
        </form>
    </div>
</div>

<script>
    function searchCustomer() {
        const searchInput = document.getElementById('customer-search').value.toLowerCase();
        const customerSelect = document.getElementById('customer');
        const customerNotFound = document.getElementById('customer-not-found');
        const newCustomerFields = document.getElementById('new-customer-fields');
        const nameInput = document.getElementById('name');
        const addressInput = document.getElementById('address');
        const phoneInput = document.getElementById('phone');

        let found = false;

        for (let i = 0; i < customerSelect.options.length; i++) {
            const option = customerSelect.options[i];
            const name = option.text.toLowerCase();

            if (name.includes(searchInput)) {
                customerSelect.selectedIndex = i; // Select the matching option
                nameInput.value = option.getAttribute('data-name'); // Set name field
                phoneInput.value = option.getAttribute('data-phone'); // Set phone field
                found = true;
                break;
            }
        }

        if (!found) {
            customerSelect.selectedIndex = 0; // Reset the selection
            customerNotFound.style.display = 'block'; // Show not found message
            newCustomerFields.style.display = 'block'; // Show new customer fields
            nameInput.value = ''; // Clear name input
            addressInput.value = ''; // Clear address input
            phoneInput.value = searchInput; // Use the search input as phone number
            phoneInput.setAttribute('required', 'required'); // Make phone required for new customers
        } else {
            customerNotFound.style.display = 'none'; // Hide not found message
            newCustomerFields.style.display = 'none'; // Hide new customer fields
            phoneInput.removeAttribute('required'); // Remove required from phone field
        }
    }
</script>
@endsection
