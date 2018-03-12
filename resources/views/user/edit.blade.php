@extends('layout.main')

<script>
    function deleteAccount() {
        event.preventDefault();
        var proceed = confirm('Are you sure you want to remove your account indefinitely?');
        if (proceed) document.getElementById('delete-form').submit();
    }
</script>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="float-left m-0">@lang('user.account')</h2>
                    <button type="button" class="btn btn-danger float-right"
                        onclick="deleteAccount()">
                        @lang('user.delete')
                    </button>
                </div>
                <div class="card-body">
                    @if ($status = session('status'))
                        <div class="alert alert-success">
                            {{ $status }}
                        </div>
                    @endif
                    <form id="delete-form" method="post" action="{{ route('user.remove') }}"
                        style="display: none;">
                        @csrf @method('delete')
                    </form>
                    <form id="update-form" method="post" action="{{ route('user.update') }}">
                        @csrf @method('patch')
                        <div class="form-group">
                            <label for="name">@lang('user.name')</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Full name" value="{{ $user->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">@lang('user.email')</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="E-mail address" value="{{ $user->email }}" required>
                            <small class="form-text text-muted">
                                @lang('user.never_share')
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="password">@lang('user.password')</label>
                            <input type="password" id="password" name="password"
                                class="form-control" placeholder="Password">
                            <small class="form-text text-muted">
                                @lang('user.password_leave_empty')
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">@lang('user.confirm')</label>
                            <input type="password" id="password-confirm" name="password_confirmation"
                                class="form-control" placeholder="Confirm password">
                        </div>
                        @if ($success = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $success }}</p>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <button type="submit" class="btn btn-primary">@lang('user.update')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
