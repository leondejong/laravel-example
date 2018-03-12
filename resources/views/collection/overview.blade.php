@extends('layout.main')
<style>
    @media (min-width: 768px) {
        .minw-8 { min-width: 8rem; }
        .minw-12 { min-width: 12rem; }
    }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="float-left m-0">@lang('collection.list')</h2>
                </div>
                <div class="card-body">
                    @if ($success = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $success }}</p>
                        </div>
                    @endif
                    @if ($failure = Session::get('failure'))
                        <div class="alert alert-danger">
                            <p>{{ $failure }}</p>
                        </div>
                    @endif
                    @if($collection->isEmpty())
                        <p>@lang('collection.not_present')</p>
                    @else
                        <table class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="minw-8">
                                        @lang('collection.name')
                                    </th>
                                    <th scope="col" class="minw-8">
                                        @lang('collection.user')
                                    </th>
                                    <th scope="col">
                                        @lang('collection.description')
                                    </th>
                                    <th scope="col" class="text-right pr-4 minw-12">@lang('collection.actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @each('collection.entry', $collection, 'entry')
                            </tbody>
                        </table>
                    @endif
                    <a role="button" class="btn btn-success m-1"
                        href="{{ route('collection.create') }}">
                        @lang('collection.create')
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection