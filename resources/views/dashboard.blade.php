@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    {{ __("You're logged in!") }}
                </div>
            </div>
            <form method="GET" action="{{ route('users.search') }}" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search users...">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="{{ route('users.search') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
            <div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lists as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td><a href="{{ route('user.edit', ['userinfo' => $user] )}}">edit</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $lists-> appends(['search' => request()->search])->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
