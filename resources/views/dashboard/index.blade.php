@extends('layout.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">@lang('dashboard.title')</div>
                <div class="card-body">
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($collection as $entry)
                                    <tr>
                                        <td>
                                            <a href="{{ route('collection.show', ['collection' => $entry]) }}">
                                                {{ $entry->name }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $entry->user ? $entry->user->name : __('collection.none') }}
                                        </td>
                                        <td>
                                            {{ $entry->description ? $entry->description : __('collection.none') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    <div class="float-right">
                        {{ $collection->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection