@extends('layout.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="float-left m-0">{{ $title }}</h2>
                </div>
                <div class="card-body">
                    <form id="update-form" method="post" action="{{ $action }}">
                        @csrf @method($method)
                        <div class="form-group">
                            <label for="name">@lang('collection.name')</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Name" value="{{ $collection->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">@lang('collection.description')</label>
                            <input type="description" id="description" name="description" class="form-control"
                                placeholder="Description" value="{{ $collection->description }}">
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <button type="submit" class="btn btn-primary">@lang('collection.submit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
