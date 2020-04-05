@extends('dashboard.app')
@section('title')
    Categories | {{config('app.name')}}
@endsection
@section('content')
    <div class="jumbotron">
        <h1>
            Categories
            <i class="fa fa-tags text-blue"></i>
        </h1>
        @if ($errors->all())
             <div class="alert alert-danger alert-dismissable mt-5" role="alert">
                  <button type="button" class="close float-right" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">
                            <i class="fa fa-times-circle fa-2x text-light"></i>
                       </span>
                  </button>
                  <h5>
                       Please Remove Following Errors
                  </h5>
                  <ul>
                       @foreach ($errors->all() as $error)
                           <li>
                                {{
                                     $error
                                }}
                           </li>
                       @endforeach
                  </ul>
             </div>
         @endif
        <button type="button" class="btn bg-dark-blue text-light" data-toggle="modal" data-target=".add_category">
            <i class="fa fa-plus"></i>
            Add Category
        </button>
    </div>
    <div class="container">
          @if (isset($category))
               <h5 class="text-center">
                    Update Category [{{$category->title}}]
               </h5>
              <form action="{{action('CategoryController@update',$category->id)}}" method="POST" class="col-sm-6 offset-sm-3 mb-5">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="col-md-12">
                             <label>Category Title</label>
                             <div class="input-group mb-2 mr-sm-2">
                                  <div class="input-group-prepend">
                                       <div class="input-group-text bg-dark-blue text-light">
                                            <i class="fa fa-tag"></i>
                                       </div>
                                  </div>
                                   <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter Category Name" value="{{$category->title}}" required>
                                  @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                             </div>
                        </div>
                   </div>
                    @if ($category->sub_categories()->get()->count() < 1)
                        <div class="form-row">
                              <div class="col-md-12">
                                   <label>Parent Category</label>
                                   <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                             <div class="input-group-text bg-dark-blue text-light">
                                                  <i class="fa fa-list"></i>
                                             </div>
                                        </div>
                                        <select name="parent" class="select2 form-control">
                                                  <optgroup>
                                                       <option value="0">Please Select</option>
                                                       @foreach ($parent_categories as $item)
                                                            <option value="{{$item->id}}" @if ($item->id == $category->parent_id)
                                                            selected
                                                            @endif>
                                                                 -
                                                                 {{
                                                                      $item->title
                                                                 }}
                                                            </option>
                                                       @endforeach
                                                  </optgroup>
                                        </select>
                                   </div>
                              </div>
                         </div>
                    @else
                         <p class="alert alert-info text-light text-center">
                              You can only change Title of Parent Category
                         </p>
                    @endif
                    <div class="form-row">
                         <button type="submit" class="btn bg-dark-blue text-light offset-sm-4 col-sm-4">
                         <i class="fa fa-edit"></i>
                         Update
                         </button>
                    </div>
               </form>
          @endif
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
                                        $item->parent_category()->first()->title
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
                                       <a href="{{url('category/'.encrypt($item->id).'/edit')}}" class="dropdown-item">
                                           <i class="fa fa-edit"></i>
                                           Edit 
                                       </a>
                                       <form action="{{action('CategoryController@destroy',$item->id)}}" method="post">
                                           @method('DELETE')
                                           @csrf
                                           <button type="submit" class="dropdown-item text-danger confirmation">
                                               <i class="fa fa-eye-slash"></i>
                                               Disable
                                           </button>
                                       </form>
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

    {{-- Size Modal --}}
    <div class="modal fade add_category" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">
                    Add Category
               </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <form action="{{action('CategoryController@store')}}" method="POST">
                <div class="modal-body">
                    @csrf
                    
                    <div class="form-row">
                        <div class="col-md-12">
                             <label>Category Title</label>
                             <div class="input-group mb-2 mr-sm-2">
                                  <div class="input-group-prepend">
                                       <div class="input-group-text bg-dark-blue text-light">
                                            <i class="fa fa-tag"></i>
                                       </div>
                                  </div>
                                  <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter Category Name" required>
                                  @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                             </div>
                        </div>
                   </div>
                    <div class="form-row">
                        <div class="col-md-12">
                             <label>Parent Category</label>
                             <div class="input-group mb-2 mr-sm-2">
                                  <div class="input-group-prepend">
                                       <div class="input-group-text bg-dark-blue text-light">
                                            <i class="fa fa-list"></i>
                                       </div>
                                  </div>
                                  <select name="parent" class="select2 form-control">
                                        <optgroup>
                                             <option value="0">Please Select</option>
                                             @foreach ($parent_categories as $item)
                                                  <option value="{{$item->id}}">
                                                       -
                                                       {{
                                                            $item->title
                                                       }}
                                                  </option>
                                             @endforeach
                                        </optgroup>
                                  </select>
                             </div>
                        </div>
                   </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        <i class="fa fa-times-circle"></i>
                        Close
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i>
                        Save
                    </button>
                </div>
            </form>
        </div>
      </div>
    </div>
@endsection