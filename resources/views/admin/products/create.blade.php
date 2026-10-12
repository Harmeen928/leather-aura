@extends('admin.layout')
@section('title', 'Add Product')

@section('content')
<h1>Add Product</h1>
<p class="sub">Upload a new picture and fill in the product details.</p>
@include('admin.products._form', ['action' => route('admin.products.store'), 'method' => 'POST'])
@endsection
