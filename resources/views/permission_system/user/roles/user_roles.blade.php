@extends('dashboard.app')
@section('title')
    View Roles | {{config('app.name')}}
@endsection
@section('content')
    <div class="jumbotron">
        <h1 class="text-blue">
            Roles Assigned to User
            <i class="fa fa-clipboard-list"></i>
        </h1>
        @if (Auth::user()->hasPermissionTo('Assign Role'))
            <a href="{{url('user/roles/create')}}" class="btn bg-dark-blue text-light">
                Assign Role
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
                @foreach ($user->roles as $key=>$item)
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
                                    <form action="{{url('user/'.$user->id.'/role/'.$item->id)}}" method="POST" class="confirmation">
                                        @csrf
                                        <button type="submit"  class="dropdown-item" title="Remove Role from '{{$user->name}}'">
                                            <i class="fa fa-trash-alt text-danger"></i>
                                            Revoke Role
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
