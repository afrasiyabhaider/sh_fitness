@extends('dashboard.app')
@section('title')
    Sizes Trash Bin | {{config('app.name')}}
@endsection
@section('content')
    <div class="jumbotron">
        <h1>
            Sizes Trash Bin
            <i class="fa fa-pencil-ruler text-blue"></i>
        </h1>
          <a href="{{url('sizes')}}" class="btn bg-dark-blue text-light">
               <i class="fa fa-eye"></i>
               View Sizes
          </a>
    </div>
    <div class="container">
        <table class="table table-hover text-center" id="data_table">
            <thead>
                <tr>
                    <th>Sr#</th>
                    <th>Weight</th>
                    <th>Unit</th>
                    <th>Servings</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sizes as $item)
                    <tr>
                        <td>
                            {{$loop->iteration}}
                        </td>
                        <td>
                            {{$item->weight}}
                        </td>
                        <td>
                            {{$item->unit}}
                        </td>
                        <td>
                            {{$item->servings}}
                        </td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn bg-dark-blue text-light">Actions</button>
                                <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                    <a href="{{url('size/'.encrypt($item->id).'/restore')}}" class="dropdown-item confirmation">
                                        <i class="fa fa-trash-restore text-success"></i>
                                        Restore 
                                    </a>
                                    <a href="{{url('size/'.encrypt($item->id).'/delete')}}" class="dropdown-item confirmation">
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
