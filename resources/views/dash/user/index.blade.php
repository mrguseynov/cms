@extends('layouts.dash')
@section('title', __('Users'))
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('homeAdmin')}}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item active">{{__('All Users')}}</li>

          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->

<div class="container-fluid">
    {{--Settings::GetValue('perPage')--}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">{{__('User List')}}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 5%">ID</th>
                        <th style="width:40%">Name</th>
                        <th style="width:25%">Email</th>
                        <th style="width: 15%">Registered At</th>
                        <th style="width: 15%">Updated At</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>
                                    <a href="{{route('user.show', $user->id)}}">{{$user->name}}</a>

                                </td>
                                <td>{{$user->email}}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($user['created_at'])->format('d.m.Y')}}
                                    {{ \Carbon\Carbon::parse($user['created_at'])->format('G:i')}}
                                </td>
                                <td>
                                    @if($user['updated_at'])
                                        {{ \Carbon\Carbon::parse($user['updated_at'])->format('d.m.Y')}}
                                        {{ \Carbon\Carbon::parse($user['updated_at'])->format('G:i')}}
                                    @else
                                        {{__('Not updated yet!')}}
                                    @endif
                                </td>
                            </tr>

                        @endforeach


                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->

                <div class="card-footer clearfix">
                    {{ $users->links() }}

                </div>
              </div>
        </div>
    </div>

</div>
@endsection
