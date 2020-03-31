@extends('dashboard.dashboard')
@section('content')
    <div class="jumbotron">
        <h1 class="text-success">
            Edit Permissions
            <i class="fa fa-edit"></i>
        </h1>
        <a href="{{url('admin/view_permissions')}}" class="btn btn-success">
            View Permissions
            <i class="fa fa-clipboard-list"></i>
        </a>
    </div>
    <div class="container">
        <form action="{{action('AdminController@update_permissions')}}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-12">
                    <label>Role Name</label>
                    <select name="role_name" class="form-control col-12">
                        <optgroup>
                            <option value="{{$data['role']}}">
                                {{$data['role']}}
                            </option>
                            @foreach ($data['roles'] as $item)
                               @if ($item->name != "Admin")
                                    <option name="{{$item->name}}">
                                        {{$item->name}}
                                    </option>
                                @endif
                            @endforeach
                        </optgroup>
                    </select>
                </div>
            </div>
            <div class="list-group-item">
                <b class="d-block mt-3">Permission</b>
        {{-- @foreach ($data['permission'] as $item) --}}
            <div class="mt-3">
                {{-- @if ($item->name == "create") --}}
                @if (true)
                    <div class="custom-control custom-control-inline custom-checkbox">
                        <input type="checkbox" name="permissions[]" id="permission_1"@if ($data['permission'][0]->name == 'create')
                            checked
                        @endif class="custom-control-input" value="create">
                        <label for="permission_1" class="custom-control-label">
                            Add
                        </label>
                    </div>
                    <div class="custom-control custom-control-inline custom-checkbox">
                        <input type="checkbox" name="permissions[]" id="permission_2"@if ($data['permission'][1]->name == 'read')
                            checked
                        @endif  class="custom-control-input" value="read">
                        <label for="permission_2" class="custom-control-label">
                            View
                        </label>
                    </div>
                    <div class="custom-control custom-control-inline custom-checkbox">
                        <input type="checkbox" name="permissions[]" id="permission_3"@if ($data['permission'][2]->name == 'update')
                            checked
                        @endif  class="custom-control-input" value="update">
                        <label for="permission_3" class="custom-control-label">
                            Update
                        </label>
                    </div>
                    <div class="custom-control custom-control-inline custom-checkbox">
                        <input type="checkbox" name="permissions[]" id="permission_4"@if ($data['permission'][3]->name == 'delete')
                            checked
                        @endif  class="custom-control-input" value="delete">
                        <label for="permission_4" class="custom-control-label">
                            Delete
                        </label>
                    </div>
                </div>
                @endif
                {{-- @endforeach --}}
            </div>
            <div class="row mt-3">
                <button type="submit" name="_submit" class="btn btn-success col-6 offset-3" value="reload_page">
                    Update Permissions
                    <i class="fa fa-check-double"></i>
                </button>
            </div>
    </form>
</div>
@endsection
