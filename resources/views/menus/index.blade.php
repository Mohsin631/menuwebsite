@extends('layouts/contentNavbarLayout')

@section('title', 'القائمة')

@section('content')
<div class="card">
    <h5 class="card-header">القائمة</h5>
    <div class="card-body">
        <form action="{{ route('menus.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">اسم القائمة</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">السعر</label>
                <input type="number" class="form-control" name="price" step="0.01" required>
            </div>
            <button type="submit" class="btn btn-primary">إضافة عنصر إلى القائمة</button>
        </form>
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>السعر</th>
                    {{-- <th>الإجراءات</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($menus as $menu)
                <tr>
                    <td>{{ $menu->name }}</td>
                    <td>{{ $menu->price }}</td>
                    <td>
                        {{-- <form action="{{ route('menus.destroy', $menu) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">حذف</button>
                        </form> --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
