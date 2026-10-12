@extends('admin.layout')
@section('title', 'Inquiries')

@section('content')
<h1>Inquiries</h1>
<p class="sub">Inquiries received through the website form.</p>

@forelse ($inquiries as $q)
    <div class="card">
        <div class="row" style="margin-bottom:8px">
            <strong>{{ $q->name }}</strong>
            <small style="color:#a69c92">{{ $q->created_at->format('d M Y, h:i A') }}</small>
        </div>
        <p>
            <a href="tel:{{ preg_replace('/\s+/', '', $q->phone) }}">{{ $q->phone }}</a>
            @if ($q->email) &middot; <a href="mailto:{{ $q->email }}">{{ $q->email }}</a> @endif
        </p>
        <p style="color:#d9622b;margin:6px 0">{{ $q->product }} @if ($q->quantity) &middot; Qty: {{ $q->quantity }} @endif</p>
        @if ($q->message)<p class="msg">{{ $q->message }}</p>@endif
        <form method="POST" action="{{ route('admin.inquiries.destroy', $q) }}" style="margin-top:12px" onsubmit="return confirm('Delete this inquiry?')">
            @csrf @method('DELETE')
            <button class="btn red sm" type="submit">Delete</button>
        </form>
    </div>
@empty
    <div class="card">No inquiries yet.</div>
@endforelse

<div class="row pager">
    @if ($inquiries->previousPageUrl())<a class="btn ghost sm" href="{{ $inquiries->previousPageUrl() }}">&larr; Newer</a>@else<span></span>@endif
    @if ($inquiries->nextPageUrl())<a class="btn ghost sm" href="{{ $inquiries->nextPageUrl() }}">Older &rarr;</a>@endif
</div>
@endsection
