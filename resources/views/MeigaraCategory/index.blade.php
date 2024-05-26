@extends('layouts.myapp')
@section('title','銘柄カテゴリ名一覧')
@section('content')
        <form action="{{route('MeigaraCategory.index')}}" method="get">
            <input type="text" name="text_category_name_part">
            <button class="meigara_category_btn">検索</button>
        </form>
        @csrf
        @foreach($meigaraCategorys as $meigaraCategory)
        <div class="meigara-category-entry">
            {{$meigaraCategory->category_name}}
            {{$meigaraCategory->created_at->format('Y/m/d H:i')}}
            @if(App\Models\User::isAdmin())
            <a class="btn-outline-primary btn" href="{{route('MeigaraCategory.edit',['meigaraCategory' => $meigaraCategory])}}"><i class="fas fa-cog"></i>編集</a>
            <a class="btn-outline-primary btn" href="{{route('MeigaraCategory.delete',['meigaraCategory' => $meigaraCategory])}}"><i class="fas fa-trash-alt"></i>削除</a>
            @endif
        </div>
        @endforeach
        {{$meigaraCategorys->onEachSide(3)->links()}}
@endsection