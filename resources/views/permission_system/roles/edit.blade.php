@extends('dashboard.app')
@section('title')
        Edit Role's Permisions | {{config('app.name')}}
@endsection
@section('content')
    <div class="jumbotron" id="assign_permission">
        <h1 class="text-blue">
            Edit Role's Permissions
            <i class="fa fa-check-double"></i>
        </h1>
        @if (Auth::user()->hasPermissionTo('View Role'))
            <a href="{{url('role/')}}" class="btn bg-dark-blue text-light">
                View Registered Roles
                <i class="fa fa-clipboard-list"></i>
            </a>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissable mt-4">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    <i class="fa fa-times-circle"></i>
                </button>
                <h3 class="text-danger">
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
        <form action="{{action('PermissionSystemController@role_permissions_update',$data['role']->id)}}" method="post" class="mb-5" id="store_role">
            @method('PUT')
            @csrf
            <div class="form-row mb-sm-2 ">
                <div class="col-md-12">
                    <label for="role">Role Name</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text bg-dark-blue text-light">
                                <i class="fa fa-user-tie"></i>
                            </div>
                        </div>
                        <input type="text" name="role" class="form-control @error('role') is-invalid @enderror" placeholder="Enter role name" value="{{$data['role']->name}}">
                        {{-- @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror --}}
                    </div>
                </div>
            </div>
            <div class="list-group-item mb-3">
                <b class="d-block mt-3">All Permissions:</b>
                <div class="custom-control custom-control-inline custom-checkbox mr-sm-3 mt-2">
                    <input type="checkbox" name="super_admin" id="super_admin" class="custom-control-input" value="super_admin" >

                    {{-- @if (old('super_admin') == 'super_admin')
                        checked
                    @endif --}}

                    <label for="super_admin" class="custom-control-label">
                        Select All Permissions
                    </label>
                </div>
                <b class="d-block mt-3">Permissions:</b>
                <div class="row">
                    @foreach ($data['all_permissions'] as $key=>$value)
                        <div class="col-md-4 col-12 mt-2">
                            <div class="custom-control custom-control-inline custom-checkbox">
                                <input type="checkbox"  name="permissions[]" id="permission{{$key+1}}" class="custom-control-input @error('permissions') is-invalid @enderror" value="{{$value->id}}" @if ($value == $data['role']->hasPermissionTo($value->name))
                                   checked
                                @endif>

                                {{-- @if (old('permissions.'.$key) == $value->id)
                                    checked
                                @endif --}}

                                <label for="permission{{$key+1}}" class="custom-control-label">
                                    {{$value->name}}
                                </label>
                            </div>
                        </div>
                        @if (($key+1)%3 == 0)
                                <hr>
                            </div>
                            <div class="row mt-md-2 mt-3">
                        @endif
                        @if ($loop->last)
                            </div>
                            @endif
                    @endforeach

            </div>
            <div class="row mt-3">
                <button type="submit" name="_submit" class="btn bg-dark-blue text-light col-md-4 col-6 offset-md-4 offset-3" value="reload_page">
                    Update Role
                    <i class="fa fa-edit"></i>
                </button>
            </div>
        </form>
    </div>
@endsection
