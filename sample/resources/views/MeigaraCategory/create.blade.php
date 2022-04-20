@extends('layouts.myapp')
@section('title','銘柄カテゴリ新規作成')
@section('content')
        <form action="{{ route('MeigaraCategory.store') }}" method="POST">
            @csrf
            <label>銘柄カテゴリ名
            <input type="text" name="category_name" value="{{ old('category_name') }}"></label>
            @if($errors -> has("category_name"))
                {{ $errors-> first("category_name") }}<br>
            @endif   
            <button>送信</button>
        </form>
@endsection