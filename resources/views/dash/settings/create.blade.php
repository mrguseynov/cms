@extends('layouts.dash')
@section('title', __('Register User'))
@section('content')
@role('admin')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{__("Registration")}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('homeAdmin')}}">{{__('Home')}}</a></li>
                    <li class="breadcrumb-item "><a href="{{route('user.index')}}">{{__('All Users')}}</a></li>
                    <li class="breadcrumb-item active">{{__("Register User")}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container">
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
        </div>
    @endif
</div>
<div class="container-fluid">
    <div class="row justify-center">
        <div class="col-lg-6">
            <div class="card card-primary">
                <form action="{{ route('settings.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="payload">{{ __('Value') }}</label>
                            <input id="payload" type="text" class="form-control @error('payload') is-invalid @enderror" name="payload" value="{{ old('payload') }}" required autocomplete="payload">
                            @error('payload')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="group">{{ __('Group') }}</label>
                            <input id="group" type="text" class="form-control @error('group') is-invalid @enderror" name="group" value="{{ old('group') }}" required autocomplete="group" >
                            @error('group')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="locked" id="locked">
                            <label class="custom-control-label" for="locked">{{__('Locked?')}}</label>
                        </div>
                        <div class="form-group row mb-0 justify-content-center">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@else
<div class="container" style=" height: calc(100vh - 57px); display: flex; width: 100%; align-items: center; justify-content: center; ">
    <div class="alert alert-danger" role="alert" style=" padding: 50px; ">
        {{__("That's not you profile, Motherfucker")}}
    </div>
</div>
@endrole
@endsection
