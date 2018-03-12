@extends('layout.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="float-left m-0">@lang('collection.view')</h2>
                </div>
                <div class="card-body">
                    <h3>{{ $collection->name }}</h3>
                    <p>{{ $collection->description }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
