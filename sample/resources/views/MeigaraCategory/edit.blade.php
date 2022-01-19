@extends('layouts.myapp')
@section('title','銘柄カテゴリ編集')
@section('content')
        <form action="{{ route('MeigaraCategory.update',['meigaraCategory' => $meigaraCategory]) }}" method="POST">
            @csrf
            @method('PUT')
            <label>銘柄カテゴリ名
            <input type="text" name="category_name" value="{{$meigaraCategory->category_name}}"></label>
            <button class="btn btn-outline-primary"><i class="fas fa-check"></i>送信</button>
        </form>
@endsection