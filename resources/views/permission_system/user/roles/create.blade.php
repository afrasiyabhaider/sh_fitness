@extends('dashboard.app')
@section('title')
    Assign Role | {{config('app.name','Doga Group')}}
@endsection
@section('content')
    <div class="jumbotron">
        <h1 class="text-blue">
            Assign Role
            <i class="fa fa-list"></i>
        </h1>
        <h6>Only those roles can be assigned who have any permisson</h6>
        @if (Auth::user()->hasPermissionTo('View Assigned Roles'))
            <a href="{{url('user/roles')}}" class="btn bg-dark-blue text-light mt-2">
                View Assigned Roles
                <i class="fa fa-eye"></i>
            </a>
        @endif
         @if ($errors->any())
            <div class="alert alert-danger alert-dismissable mt-4">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    <i class="fa fa-times-circle"></i>
                </button>
                <h3 class="text-light">
                   Must remove following Errors to submit data
                </h3>
                <ol type="1">
                    @foreach ($errors->all() as $error)
                        <li>
                            {{$error}}
                        </li>
                    @endforeach
                </ol>
            </div>
        @endif
    </div>
    <div class="container">
        <form action="{{action('PermissionSystemController@user_roles_store')}}" method="post" id="permission_form" class="mb-5">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label>Portal User</label>
                     <div class="input-group">
                            <div class="input-group-append">
                                <div class="input-group-text  bg-dark-blue text-light">
                                    <i class="fa fa-id-badge"></i>
                                </div>
                            </div>
                            <select name="user"  class="select form-control select2 @error('user') is-invalid @enderror" id="staff_id" required>
                                <optgroup>
                                    <option value="Select Portal User">
                                        Select Portal User
                                    </option>
                                    @php
                                        $i =1;
                                    @endphp
                                    @foreach ($data['user'] as $key=>$item)
                                        <option value="{{$item->id}}">
                                            {{$key+1}}.
                                            {{$item->name}}
                                        </option>
                                    @endforeach
                                </optgroup>
                            </select>
                            @error('user')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                     </div>
                </div>
                <div class="col-md-6">
                    <label>Role</label>
                     <div class="input-group">
                            <div class="input-group-append">
                                <div class="input-group-text  bg-dark-blue text-light">
                                    <i class="fa fa-user-tie"></i>
                                </div>
                            </div>
                            <select name="role" class="form-control select2 @error('role') is-invalid @enderror"  id="select1" required>
                                <optgroup>
                                    <option value="Select Role">
                                        Select Role
                                    </option>
                                    @php
                                        $x=1;
                                    @endphp
                                    @foreach ($data['roles'] as $item)
                                        @if (($item->name != "Super Admin") && ($item->name != "Admin") )
                                            <option value="{{$item->id}}">
                                                {{$x++}}.
                                                {{$item->name}}
                                            </option>
                                        @endif
                                    @endforeach
                                </optgroup>
                            </select>
                            @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                     </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-12">
                    <button type="submit" class="btn bg-dark-blue text-light col-6 offset-3 mt-3">
                        Assign Role
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
