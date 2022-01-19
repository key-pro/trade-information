@extends('layouts.myapp')
@section('title','銘柄カテゴリ新規作成')
@section('content')
        <form action="{{ route('MeigaraCategory.storeCofirm') }}" method="POST">
            @csrf
            <label>銘柄カテゴリ名
            <input type="text" name="category_name"></label>
            <button>送信</button>
        </form>
@endsection