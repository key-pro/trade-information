@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @csrf
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="/Meigara" class="btn btn-primary">{{ __('銘柄一覧へ移動') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
