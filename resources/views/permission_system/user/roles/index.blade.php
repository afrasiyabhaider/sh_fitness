@extends('dashboard.app')
@section('title')
    View Roles | {{config('app.name')}}
@endsection
@section('content')
    <div class="jumbotron">
        <h1 class="text-blue">
            Roles Assigned to Staff
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
                        Image
                    </th>
                    <th>
                        Name
                    </th>
                    <th>
                        Email
                    </th>
                    <th>
                        Phone Number
                    </th>
                    <th>
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $x = 1;
                @endphp
                @foreach ($user as $key=>$item)
                    @if ($item != null)
                        @if ($item->roles->first() != null)
                            <tr>
                                <td>
                                    {{$x++}}
                                </td>
                                <td>
                                    <img src="{{asset('uploads/'.$item->image)}}" alt="{{$item->name}}'s image" class="img-fluid img-thumbnail" style="max-width: 150px;max-height: 80px">
                                </td>
                                <td>
                                    {{
                                        $item->name
                                    }}
                                </td>
                                <td>
                                    {{
                                        $item->email
                                    }}
                                </td>
                                <td>
                                    {{
                                        $item->phone_number
                                    }}
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info">Actions</button>
                                        <button type="button" class="btn sidebar-bg-blue text-light dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                            <a href="{{url('user/'.encrypt($item->id).'/roles')}}" class="dropdown-item">
                                                <i class="fa fa-eye"></i>
                                                View Assigned Roles
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
