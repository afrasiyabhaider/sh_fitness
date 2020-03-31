@extends('dashboard.app')
@section('title')
    View Role's Permissions | {{config('app.name')}}
@endsection
@section('content')
    <div class="jumbotron">
        <h1 class="text-blue">
            Assigned Permissions
            <i class="fa fa-clipboard-list"></i>
        </h1>
        <h2 class="text-info">
            {{$data['role']->name}}'s Role
        </h2>
        @if (Auth::user()->hasPermissionTo('Register Role'))
            <a href="{{url('role/create')}}" class="btn bg-dark-blue text-light ">
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
                        Permission Name
                    </th>
                    <th>
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['permissions'] as $key=>$item)
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
                            @if (Auth::user()->hasPermissionTo('Revoke Permission'))
                                <form action="{{url('role/'.$data['role']->id.'/permission/'.$item->id)}}" method="post" class="confirmation">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit"class="btn btn-danger confirmation">
                                        Remove Permission
                                        <i class="fa fa-trash-alt"></i>
                                    </button>
                                </form>
                            @else
                                <a href="{{url()->previous()}}" class="btn btn-info">
                                    <i class="fa fa-arrow-left"></i>
                                    Back
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
