@extends('layouts.appgreen')

@section('content')
<div class="container mt-4">
    <h2>Edit Target</h2>
    <form action="{{ route('target.update', $target->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('target.form')
    </form>
</div>
@endsection
