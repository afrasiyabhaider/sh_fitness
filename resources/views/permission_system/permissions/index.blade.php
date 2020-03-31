@extends('dashboard.app')
@section('title')
    Registered Permissions | {{config('app.name','Doga Group')}}
@endsection
@section('content')
    <div class="jumbotron">
        <h1 class="text-blue">
            Registered Permissions
            <i class="fa fa-clipboard-list"></i>
        </h1>
        <a href="{{url('role/create')}}" class="btn bg-dark-blue text-light">
            Register New Role
            <i class="fa fa-plus"></i>
        </a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <table class="table table-hover text-center" id="data_table">
                    <thead class="table-blue">
                        <tr>
                            <th>
                                Sr#
                            </th>
                            <th>
                                Permission Name
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $key=>$item)
                            <tr>
                                <td>
                                    {{$key+1}}
                                </td>
                                <td>
                                    {{
                                        $item->name
                                    }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
