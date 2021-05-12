@extends('layouts.dash')
@section('title', __('Users'))
@section('content')
@if ( auth()->user()->hasRole('admin'))
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{__("Settings")}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('homeAdmin')}}">{{__('Home')}}</a></li>
                    <li class="breadcrumb-item active">{{__("Settings")}}</li>
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

                        <div id="app">
                            <site-settings></site-settings>
                        </div>


@else
<div class="container" style=" height: calc(100vh - 57px); display: flex; width: 100%; align-items: center; justify-content: center; ">
    <div class="alert alert-danger" role="alert" style=" padding: 50px; ">
        {{__("That's not you profile, Motherfucker")}}
    </div>
</div>
@endif
@endsection
