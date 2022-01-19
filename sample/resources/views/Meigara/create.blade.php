@extends('layouts.myapp')
@section('title',"銘柄新規登録")
@section('content')
    <form action="{{ route('Meigara.storeConfirm') }}" method="POST">
        @csrf
    <div>
        <label>新規銘柄<br>
        @if($errors -> has("meigara_name"))
             {{ $errors-> first("meigara_name") }}<br>
        @endif
        <input type="text" name="meigara_name"></label>
    </div>
    
    <div>
        <label>シンボル<br>
        <input type="text" name="symbol"></label>
            
        @if($errors -> has("symbol"))
            {{ $errors-> first("symbol") }}<br>
        @endif    
    </div>
        
    <div>
        <label>通貨<br>
        <input type="text" name="currency"></label>
        @if($errors -> has("currency"))

            {{ $errors-> first("currency") }}<br>
        @endif    
    </div>
        <button>確認</button>
    </form>
@endsection