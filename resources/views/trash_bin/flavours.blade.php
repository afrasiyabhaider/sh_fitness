@extends('dashboard.app')
@section('title')
    Flavours Trash Bin | {{config('app.name')}}
@endsection
@section('content')
    <div class="jumbotron">
        <h1>
            Flavours Trash Bin
            <i class="fa fa-apple-alt text-blue"></i>
        </h1>
          <a href="{{url('flavours')}}" class="btn bg-dark-blue text-light">
               <i class="fa fa-eye"></i>
               View Flavours
          </a>
    </div>
    <div class="container">
        <table class="table table-hover text-center" id="data_table">
            <thead>
                <tr>
                    <th>Sr#</th>
                    <th>Flavour</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($flavours as $item)
                    <tr>
                        <td>
                            {{$loop->iteration}}
                        </td>
                        <td>
                            {{$item->title}}
                        </td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn bg-dark-blue text-light">Actions</button>
                                <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                    <a href="{{url('flavour/'.encrypt($item->id).'/restore')}}" class="dropdown-item confirmation">
                                        <i class="fa fa-trash-restore text-success"></i>
                                        Restore 
                                    </a>
                                    <a href="{{url('flavour/'.encrypt($item->id).'/delete')}}" class="dropdown-item confirmation">
                                        <i class="fa fa-trash-alt text-danger"></i>
                                        Delete Permanently 
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
