@extends('layouts.myapp')
@section('title','銘柄カテゴリ削除')
@section('content')
        <h1><i class="fas fa-question-circle"></i>以下の銘柄カテゴリ名を削除しますか</h1>
        <form action="{{ route('MeigaraCategory.destroy',['meigaraCategory' => $meigaraCategory]) }}" method="POST">
            @csrf
            @method('DELETE')
            <label>銘柄カテゴリ名
            <input type="text" name="category_name" value="{{$meigaraCategory->category_name}}"></label>
            <button class="btn btn-outline-primary"><i class="fas fa-exclamation-triangle"></i>送信</button>
        </form>
@endsection