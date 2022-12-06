@extends('layouts.myapp')
@section('title','銘柄削除')
@section('content')
        <h1><i class="fas fa-question-circle"></i>以下の銘柄名を削除しますか</h1>
        <form action="{{ route('Meigara.destroy',['meigara' => $meigara]) }}" method="POST">
            @csrf
            @method('DELETE')
            銘柄: {{$meigara->meigara_name}}"
            <button class="btn btn-outline-primary"><i class="fas fa-exclamation-triangle"></i>送信</button>
        </form>
@endsection