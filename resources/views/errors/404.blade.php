@extends('layouts.myapp')
@section('title','銘柄名一覧')
@section('content')
      
        <a class="btn-outline-primary btn" href="{{route('Meigara.index')}}"><i class="fas fa-cog"></i>トップへ戻る</a>        
        <p class="meigara_search_not_found">ページがみつかりませんでした。</p>
@endsection
