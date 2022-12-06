@extends('layouts.myapp')
@section('titile','銘柄名')
@section('content')
<form action="{{ route('Meigara.store') }}" method="POST">
    @csrf
    <div>
        <label>新規銘柄<br>
        <input type="hidden" name="meigara_name" value="{{request()->input('meigara_name')}}"></label>
                {{request()->input('meigara_name')}}
    </div>
    <div>
        <label>シンボル<br>
        <input type="hidden" name="symbol" value="{{request()->input('symbol')}}"></label>
                {{request()->input('symbol')}}
    </div>

    <div>
        <label>通貨<br>
        <input type="hidden" name="currency" value="{{request()->input('currency')}}"></label>
                {{request()->input('currency')}}
    </div>
    
    <button>登録</button>
</form>
@endsection
