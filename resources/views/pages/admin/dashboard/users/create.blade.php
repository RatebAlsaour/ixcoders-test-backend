@extends('layouts.admin.dashboard')

@section('content')
<div class="page-wrapper">
    <div class="container-fluid">
        @include('layouts.message')
        <form action="{{ route('admin.users.store') }}" method="POST" class=" g-3 needs-validation" novalidate>
            @csrf
            <div class="row">
                <div class="col-12 col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ __('Create User') }}</h4>
                            <hr>
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="firstName">{{ __('First Name') }}<span class="text-danger"> *</span></label>
                                                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" id="firstName" placeholder="{{ __('First Name') }}" value="{{ old('first_name') }}" required>
                                                @error('first_name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="lastName">{{ __('Last Name') }}<span class="text-danger"> *</span></label>
                                                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" id="lastName" placeholder="{{ __('Last Name') }}" value="{{ old('last_name') }}" required>
                                                @error('last_name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="email">{{ __('Email') }}<span class="text-danger"> *</span></label>
                                                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="{{ __('Email') }}" value="{{ old('email') }}" required>
                                                @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="password">{{ __('Password') }}<span class="text-danger"> *</span></label>
                                                <input type="text" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="{{ __('Password') }}" value="{{ old('password') }}" required>
                                                @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="phone">{{ __('Phone') }}<span class="text-danger"> *</span></label>
                                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="{{ __('Phone') }}" value="{{ old('phone') }}" required>
                                                @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ __('Status') }}</h4>
                            <hr>
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="role">{{ __('Role') }}<span class="text-danger"> *</span></label>
                                                <select class="custom-select @error('role') is-invalid @enderror" name="role" id="role" required>
                                                    <option value="">{{ __('--Select Role--') }}</option>
                                                    @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}" {{ old('role') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('role')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- <div class="col-12">
                                            <div class="form-group">
                                                <label for="role">{{ __('Status') }}<span class="text-danger"> *</span></label>
                                                <select class="custom-select @error('status') is-invalid @enderror" name="status" id="status" required>
                                                    <option value="">{{ __('--Select Status--') }}</option>
                                                    @foreach ($statuses as $status)
                                                    <option value="{{ $status->name }}" {{ old('status') == $statue->name ? 'selected' : '' }}>{{ $status->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('status')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-5">
                    <div class="text-right">
                        <button type="submit" class="btn btn-info">{{ __('Create') }}</button>
                        <button type="reset" class="btn btn-dark">{{ __('Reset') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
