@extends('dashboard.app')
@section('title')
    Registered Roles | {{config('app.name')}}
@endsection
@section('content')
    <div class="jumbotron">
        <h1 class="text-blue">
            Registered Roles
            <i class="fa fa-clipboard-list"></i>
        </h1>
        @if (Auth::user()->hasPermissionTo('Register Role'))
            <a href="{{url('role/create')}}" class="btn bg-dark-blue text-light">
                Register New Role
                <i class="fa fa-plus"></i>
            </a>
        @endif
    </div>
    <div class="container">
        <table class="table table-hover text-center" id="data_table">
            <thead class="table-blue">
                <tr>
                    <th>
                        Sr#
                    </th>
                    <th>
                        Role Name
                    </th>
                    <th>
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $key=>$item)
                    @if (($item->name != 'Super Admin') && ($item->name != 'Admin'))
                        <tr>
                            <td>
                                {{$key+1}}
                            </td>
                            <td>
                                {{
                                    $item->name
                                }}
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info">Actions</button>
                                    <button type="button" class="btn bg-dark-blue text-light dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                        
                                        <a href="{{url('role/permissions/'.encrypt($item->id))}}" class="dropdown-item">
                                            <i class="fa fa-list-alt"></i>
                                            View Permissions
                                        </a>
                                        <a href="{{url('role/permissions/'.encrypt($item->id).'/edit')}}" class="dropdown-item">
                                            <i class="fa fa-edit"></i>
                                            Edit Assigned Permissions
                                        </a>
                                        <form action="{{action('PermissionSystemController@role_delete',$item->id)}}" method="post" class="confirmation">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit"class="dropdown-item">
                                                <i class="fa fa-trash-alt text-danger"></i>
                                                Remove Role
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
