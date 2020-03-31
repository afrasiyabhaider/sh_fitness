@extends('dashboard.dashboard')
@section('content')
    <div class="jumbotron">
        <h1 class="text-success">
            View Permisisons
            <i class="fa fa-clipboard-list"></i>
        </h1>

        <a href="{{url('admin/grant_permissions')}}" class="btn btn-success">
            Grant Permissions
            <i class="fa fa-plus"></i>
        </a>
    </div>
    <div class="container">
        <table class="table table-hover" id="data_table">
            <thead class="table-success">
                <tr>
                    <th>
                        Sr#
                    </th>
                    <th>
                        Permission Name
                    </th>
                    <th>
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($role as $key=>$value)
                    @if (!$value->getAllPermissions()->isEmpty() && $value->name != "Admin")
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$value->name}}</td>
                        <td>
                            @if (!$value->getAllPermissions()->isEmpty())

                                <button class="btn btn-success col-md-5" type="button" data-toggle="collapse" data-target="#permissions{{$key+1}}" aria-expanded="false" aria-controls="permissions" title="Click me to see details">
                                    View Permissions
                                    <i class="fa fa-chevron-circle-down" title="Click me to expand"></i>
                                </button>
                                <table class="table collapse col-md-5" id="permissions{{$key+1}}">
                                        @foreach ($value->getAllPermissions() as $item)
                                        <tr class="text-capitalize">
                                            <td>{{$item->name}}</td>
                                        </tr>
                                        @endforeach
                                    </table>
                                @else
                                    <div class="alert alert-danger col-md-5">
                                        No Permission Granted
                                    </div>
                                @endif
                        </td>
                        <td>
                            <form action="{{url('admin/delete_permissions',$value->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"  class="btn btn-danger" title="Remove Permissions">
                                    <i class="fa fa-trash-alt text-danger"></i>
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
