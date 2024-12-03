@extends('layouts.admin.dashboard')

@section('content')
<div class="page-wrapper ">
    <div class="container-fluid">
        <div class="text-right mb-3" style="top: 20px; right: 20px;">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                {{ __('Add User') }}
            </a>
        </div>
        @include('layouts.message')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <h4 class="card-title">{{ __('All Users') }}</h4>
                        </div>
                        <div class="customize-input">
                            <form method="GET" action="{{ route('admin.users.index') }}">
                                <input 
                                    name="search-key" 
                                    value="{{ request('search-key') }}" 
                                    class="form-control custom-shadow custom-radius border-0 bg-white" 
                                    type="search" 
                                    placeholder="Search" 
                                    aria-label="Search"
                                    onkeydown="handleEnterKey(event)">
                                <button type="submit" style="display: none;"></button>
                            </form>
                        </div>
                        <script>
                            function handleEnterKey(event) {
                                if (event.key === "Enter") {
                                    event.target.form.submit(); 
                                }
                            }
                        </script>
                        <div class="table-responsive">
                            <table class="table no-wrap v-middle mb-0">
                                <thead>
                                    <tr class="border-0">
                                        <th class="border-0 font-14 font-weight-medium text-muted">{{ __('Info') }}</th>
                                        <th class="border-0 font-14 font-weight-medium text-muted px-2">{{ __('Phone') }}</th>
                                        <th class="border-0 font-14 font-weight-medium text-muted">{{ __('Role') }}</th>
                                        <th class="border-0 font-14 font-weight-medium text-muted text-center">
                                            {{ __('Status') }}
                                        </th>
                                        <th class="border-0 font-14 font-weight-medium text-muted">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
    @if ($user->id != auth()->user()->id)  
        <tr>
            <td class="border-top-0 px-2 py-4">
                <div class="d-flex no-block align-items-center">
                    <div class="mr-3">
                        <img
                            src="{{ asset('assets/images/users/avatar.png') }}"
                            alt="user" class="rounded-circle" width="45" height="45" />
                    </div>
                    <div>
                        <h5 class="text-dark mb-0 font-16 font-weight-medium">
                            {{ $user->first_name . ' ' . $user->last_name }}</h5>
                        <span class="text-muted font-14">{{ $user->email }}</span>
                    </div>
                </div>
            </td>
            <td class="border-top-0 text-muted px-2 py-4 font-14">{{ $user->phone }}</td>
            <td class="border-top-0 px-2 py-4">{{ $user->role }}</td>
            <td class="border-top-0 text-center px-2 py-4">
                <i class="fa fa-circle font-12 @if($user->status == 'publish') text-success @else text-danger @endif" 
                    data-toggle="tooltip" 
                    data-placement="top" 
                    title="@if($user->status == 'publish') Active @else Inactive @endif"></i>
            </td>
            <td class="font-weight-medium text-dark border-top-0 px-2 py-4">
                <div class="btn-group dropleft">
                    <button type="button" class="btn btn-secondary dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ __('Actions') }}
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('admin.users.edit', $user->id) }}">{{ __('Edit') }}</a>
                        <a class="dropdown-item" href="{{ route('admin.users.delete', $user->id) }}">{{ __('Delete') }}</a>
                    </div>
                </div>
            </td>
        </tr>
    @endif
@endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
