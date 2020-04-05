@extends('dashboard.app')
@section('title')
    Categories | {{config('app.name')}}
@endsection
@section('content')
    <div class="jumbotron">
        <h1>
            Categories Trash
            <i class="fa fa-tags text-blue"></i>
        </h1>
          <a href="{{url('category')}}" class="btn bg-dark-blue text-light">
               View Categories 
               <i class="fa fa-eye"></i>
          </a>
    </div>
    <div class="container">
          <table class="table table-hover text-center" id="data_table">
               <caption class="caption text-center">
                    [-] is for Parent and [--] is for sub-category
               </caption>
               <thead>
                    <tr>
                         <th>Sr#</th>
                         <th>Name</th>
                         <th>Parent Category</th>
                         <th>Action</th>
                    </tr>
               </thead>
               <tbody>
                   @foreach ($categories as $item)
                       <tr>
                           <td>
                               {{$loop->iteration}}
                           </td>
                           <td>
                                @if ($item->parent_id != 0)
                                   --
                                @else
                                   -
                                @endif
                                {{$item->title}}
                           </td>
                           <td>
                               @if ($item->parent_id != 0)
                                   -
                                   {{
                                        $item->parent_category()->withTrashed()->first()->title
                                   }}
                               @else
                                   -
                               @endif
                           </td>
                           <td>
                               <div class="btn-group">
                                   <button type="button" class="btn bg-dark-blue text-light">Actions</button>
                                   <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                       <span class="sr-only">Toggle Dropdown</span>
                                   </button>
                                   <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                       <a href="{{url('category/'.encrypt($item->id).'/restore')}}" class="dropdown-item">
                                           <i class="fa fa-trash-restore text-success"></i>
                                           Restore 
                                       </a>
                                       <a href="{{url('category/'.encrypt($item->id).'/delete')}}" class="dropdown-item confirmation">
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