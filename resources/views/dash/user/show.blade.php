@extends('layouts.dash')
@section('title', __('Users'))
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('homeAdmin')}}">{{__('Home')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('user.index')}}">{{__('All Users')}}</a></li>
                    <li class="breadcrumb-item active">{{$user->name}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="{{ asset('dash/dist/img/user4-128x128.jpg')}}" alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">{{$user->name}}</h3>
                    <p class="text-muted text-center" title="{{__("Role Name")}}">{{Str::of($user->getRoleNames())->trim("[\]\"")}}</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                        <b>Followers</b> <a class="float-right">1,322</a>
                        </li>
                        <li class="list-group-item">
                        <b>Following</b> <a class="float-right">543</a>
                        </li>
                        <li class="list-group-item">
                        <b>Friends</b> <a class="float-right">13,287</a>
                        </li>
                    </ul>
                    @if (Auth::user()->name == $user->name )
                        <a href="{{ route('user.edit', $user->id)}}" class="btn btn-primary btn-block"><b>{{ __('Edit') }}</b></a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
