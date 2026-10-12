@extends('admin.layout')
@section('title', 'Edit Product')

@section('content')
<h1>Edit Product</h1>
<p class="sub">{{ $product->name }}</p>
@include('admin.products._form', ['action' => route('admin.products.update', $product), 'method' => 'PUT'])
@endsection
