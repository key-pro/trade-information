@extends('layouts.myapp')
@section('title','銘柄カテゴリ名一覧')
@section('content')
        <form action="{{route('Meigara.index')}}" method="get">
            <div class="search_bar">
                <i class="fas fa-search search_icon"></i>
                    <input type="text" name="text_meigara_name_part" id="text2" placeholder="企業名検索" required="required">
                <button>検索</button>
            </div>
        </form>
        @foreach($meigaras as $meigara)
        <div class="meigara-entry">
            {{$meigara->id}}
            {{$meigara->meigara_name}}
            {{$meigara->created_at->format('Y/m/d H:i')}}
            <a class="btn-outline-primary btn" href="{{route('Meigara.show',['meigara' => $meigara])}}"><i class="fas fa-cog"></i>詳細</a>
            <a class="btn-outline-primary btn" href="{{route('Meigara.edit',['meigara' => $meigara])}}"><i class="fas fa-cog"></i>編集</a>
            <a class="btn-outline-primary btn" href="{{route('Meigara.delete',['meigara' => $meigara])}}"><i class="fas fa-trash-alt"></i>削除</a>
        </div>
        @endforeach
        {{$meigaras->onEachSide(3)->links()}}
@endsection