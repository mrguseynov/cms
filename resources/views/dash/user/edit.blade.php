@extends('layouts.dash')
@section('title', __('Users'))
@section('content')
@if (Auth::user()->name == $user->name)
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{__("Editing")}}: {{$user->name}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('homeAdmin')}}">{{__('Home')}}</a></li>
                    <li class="breadcrumb-item "><a href="{{route('user.index')}}">{{__('All Users')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('user.show', $user->id)}}"> {{$user->name}}</a></li>
                    <li class="breadcrumb-item active">{{__("Edit")}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-primary">
            <!-- form start -->
            <form action="{{ route('user.update', $user['id']) }}" method="POST">
                @csrf
              @method('PUT')
              <div class="card-body">
                <div class="form-group">
                  <label for="categoryTitle">{{ __('Name') }}</label>
                  <input
                  type="text"
                  value="{{ $user['name'] }}"
                  name="name"
                  class="form-control"
                  id="categoryTitle"
                  placeholder="{{ __('Enter Category Title') }}"
                  autofocus
                  required>
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
