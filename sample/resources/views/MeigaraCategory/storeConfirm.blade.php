@extends('layouts.myapp')
@section('title','銘柄カテゴリ名')
@section('content')
@foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
@endforeach
        <form action="{{ route('MeigaraCategory.store') }}" method="POST">
            @csrf
            <label>銘柄カテゴリ名
            @if ($errors->has('category_name'))
                {{ $errors->first('category_name') }}<br>
            @endif
            <input type="hidden" name="category_name" value="{{request()->input('category_name')}}"></label>
            {{request()->input('category_name')}}
            <button>送信</button>
        </form>
@endsection