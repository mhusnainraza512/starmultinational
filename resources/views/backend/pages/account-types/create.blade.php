@extends('backend.layouts.master')

@section('title')
    Create Account Types
@endsection

@section('css')
@endsection

@section('main-content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <h5 class="text-dark font-weight-bold my-1 mr-5">{{ __('Account Types') }}</h5>
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item">
                                <a href="{{ route('manage-account-types.create') }}"
                                    class="text-muted">{{ __('Create Account Type') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="card card-custom">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Create Account Types') }}</h3>
                        <div class="card-toolbar">
                            <div class="example-tools justify-content-center">
                                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                            </div>
                            <div class="card-toolbar">
                                <a href="{{ route('manage-account-types.index') }}" class="btn btn-primary font-weight-bolder"><i
                                        class="la la-eye"></i>{{ __('View Account Types') }}</a>

                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('manage-account-types.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('Account Type Name') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Enter Account Type Name" required>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('Price') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Account Price"
                                            name="price" value="{{ old('Username') }}" required />
                                        @error('Price')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('Left Users') }} <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" placeholder="Enter Left Users"
                                            name="left_users" value="{{ old('left_users') }}" required />
                                        @error('left_users')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('Right Users') }} <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" placeholder="Enter Right Users"
                                            name="right_users" value="{{ old('right_users') }}" required />
                                        @error('right_users')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" style="text-align: end">
                            <button type="submit" class="btn btn-primary mr-2">{{ __('Submit') }}</button>
                            <button type="reset" class="btn btn-secondary">{{ __('Reset') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
