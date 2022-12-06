@extends('layouts.myapp')
@section('title','銘柄編集')
@section('content')
<!-- @php
var_dump($meigara);
@endphp -->
    <form action="{{ route('Meigara.update',['meigara' => $meigara]) }}" method="POST">
        @csrf
        @method('PUT')
        <label>銘柄名
        <input type="text" name="meigara_name" value="{{ $meigara->meigara_name }}"></label>
        @if($errors -> has("meigara_name"))
            {{ $errors-> first("meigara_name") }}<br>
        @endif
        <button class="btn btn-outline-primary"><i class="fas fa-check"></i>送信</button>
    </form>
@endsection