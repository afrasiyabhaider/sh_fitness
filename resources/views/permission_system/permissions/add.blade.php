@extends('dashboard.dashboard')
@section('content')
    <div class="jumbotron" id="assign_permission">
        <h1 class="text-blue">
            Grant Permissions
            <i class="fa fa-plus"></i>
        </h1>
        <a href="{{url('admin/view_permissions')}}" class="btn bg-dark-blue">
            View Permissions
            <i class="fa fa-clipboard-list"></i>
        </a>
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
        <form action="{{action('AdminController@assign_permissions')}}" method="post" class="mb-5">
            @csrf
            {{-- <div class="form-row">
                <label class="form-label">Role Name</label>
                <div class="col-12">
                    <select name="role_name" class="js-example-basic-single form-control col-12 @error('role_name') is-invalid @enderror" id="select2">
                        <optgroup label="Select Role">
                            <option value="Select Role">Select Role</option>
                            @foreach ($role as $item)
                                @if ($item->name != "Admin")
                                    <option name="{{$item->name}}">
                                        {{$item->name}}
                                    </option>
                                @endif
                            @endforeach
                        </optgroup>
                    </select>
                    @error('role_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div> --}}
            <div class="form-row mb-sm-2 ">
                <div class="col-md-12">
                    <label for="fname">Role Name</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text  bg-dark-gradient text-light">
                                <i class="fa fa-user-tie"></i>
                            </div>
                        </div>
                        <input type="text" name="role_name" class="form-control @error('fname') is-invalid @enderror" placeholder="Enter role name" value="{{old('role_name')}}">
                        @error('role_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="list-group-item mb-3">
                {{-- If permission is super admin it should come at top--}}
                @php
                    $permission = $permissions->where('name','Super Admin')->first();
                @endphp
                @if ($permission)
                    <b class="d-block mt-3">All Permission</b>
                    <div class="custom-control custom-control-inline custom-checkbox mr-sm-3">
                        <input type="checkbox" name="permissions[]" id="super_admin" class="custom-control-input" value="{{$permission->id}}">
                        <label for="super_admin" class="custom-control-label">
                            {{$permission->name}}
                        </label>
                    </div>
                @endif
                <b class="d-block mt-3">Permission</b>
                @foreach ($permissions as $key=>$value)
                    @if ($value->name != "Super Admin")
                        <div class="custom-control custom-control-inline custom-checkbox mr-sm-3">
                            <input type="checkbox" name="permissions[]" id="permission{{$key+1}}" class="custom-control-input" value="{{$value->id}}">
                            <label for="permission{{$key+1}}" class="custom-control-label">
                                {{$value->name}}
                            </label>
                        </div>
                        @if (($key+1)%6 == 0)
                            <br>
                        @endif
                    @endif
                @endforeach
            </div>
            <div class="row mt-3">
                <button type="submit" name="_submit" class="btn bg-dark-blue col-4 offset-4" value="reload_page">
                    Create Role
                    <i class="fa fa-plus-circle"></i>
                </button>
            </div>
        </form>
    </div>
@endsection
