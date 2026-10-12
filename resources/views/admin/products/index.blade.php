@extends('admin.layout')
@section('title', 'Products')

@section('content')
<div class="row">
    <div>
        <h1>Products</h1>
        <p class="sub">Add, change or delete your product pictures here. Changes appear on the website immediately.</p>
    </div>
    <a class="btn" href="{{ route('admin.products.create') }}">+ Add Product</a>
</div>

<div class="card">
    <table class="resp">
        <thead><tr><th>Image</th><th>Name</th><th>Order</th><th>Status</th><th></th></tr></thead>
        <tbody>
        @forelse ($products as $p)
            <tr>
                <td>@if ($p->image_url)<img class="thumb" src="{{ $p->image_url }}" alt="">@else<div class="thumb"></div>@endif</td>
                <td><strong>{{ $p->name }}</strong></td>
                <td>{{ $p->sort_order }}</td>
                <td><span class="badge {{ $p->is_active ? 'on' : 'off' }}">{{ $p->is_active ? 'Visible' : 'Hidden' }}</span></td>
                <td>
                    <div class="acts">
                        <a class="btn ghost sm" href="{{ route('admin.products.edit', $p) }}">Edit</a>
                        <form method="POST" action="{{ route('admin.products.destroy', $p) }}" onsubmit="return confirm('Are you sure you want to delete this product?')">
                            @csrf @method('DELETE')
                            <button class="btn red sm" type="submit">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr><td colspan="5">No products yet. Click "Add Product" to create one.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
