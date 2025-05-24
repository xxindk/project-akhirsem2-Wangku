@extends('layouts.appgreen')

@section('content')
<div class="container mt-4">
    <h2>Tambah Target Tabungan</h2>
   <form action="{{ route('target.store') }}" method="POST">
    @csrf
    @include('target.form')
</form>
</div>
@endsection
