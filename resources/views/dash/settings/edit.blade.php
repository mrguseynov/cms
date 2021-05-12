@extends('layouts.dash')
@section('title', __('Users'))
@section('content')
@if ( auth()->user()->hasRole('admin'))
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{__("Editing")}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('homeAdmin')}}">{{__('Home')}}</a></li>
                    <li class="breadcrumb-item "><a href="{{route('user.index')}}">{{__('All Users')}}</a></li>
                    <li class="breadcrumb-item active">{{__("Edit")}} : {{$setting->name}}</li>
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
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-primary">
                <form action="{{ route('settings.update', $setting['id']) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input
                            type="text"
                            value="{{ $setting['name'] }}"
                            name="name"
                            class="form-control"
                            id="name"
                            placeholder="{{ __('Enter Setting Name') }}"
                            autofocus
                            required
                            disabled>
                        </div>
                        <div class="form-group">
                            <label for="group">{{__('Group')}}</label>
                            <input id="group" value="{{ $setting['group'] }}" type="text" class="form-control" name="group" required disabled>
                        </div>
                        <div class="form-group">
                            <label for="payload">{{ __('Payload') }}</label>
                            <input type="text" value="{{ $setting['payload'] }}" name="payload" class="form-control" id="payload" placeholder="{{ __('Enter Setting Payload') }}" required>
                        </div>

                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="locked" id="locked" @if($setting['locked'] == 1) checked @endif>
                            <label class="custom-control-label" for="locked">{{__('Locked?')}}</label>
                        </div>
                    </div>
                </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Update User') }}</button>
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
@endif
@endsection
