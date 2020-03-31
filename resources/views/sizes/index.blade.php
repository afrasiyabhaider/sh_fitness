@extends('dashboard.app')
@section('title')
    Sizes | {{config('app.name')}}
@endsection
@section('content')
    <div class="jumbotron">
        <h1>
            Sizes
            <i class="fa fa-pencil-ruler text-blue"></i>
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
        <button type="button" class="btn bg-dark-blue text-light" data-toggle="modal" data-target=".add_size">
            <i class="fa fa-plus"></i>
            Add Size
        </button>
    </div>
    <div class="container">
        @if (isset($size))
             <div class="container">
                <form action="{{action('SizesController@update',$size->id)}}" method="POST" class="col-sm-6 offset-sm-3">
                    @csrf 
                    @method('PUT')
                    <div class="form-row">
                            <div class="col-md-12">
                                <label >Weight/Quantity</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-dark-blue text-light">
                                                <i class="fa fa-weight"></i>
                                        </div>
                                    </div>
                                    <input type="text" name="weight" class="form-control @error('weight') is-invalid @enderror" value="{{$size->weight}}" required>
                                </div>
                            </div>
                    </div>
                    <div class="form-row">
                            <div class="col-md-12  @error('unit') is-invalid @enderror">
                                <label>Unit</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-dark-blue text-light">
                                                <i class="fa fa-weight-hanging"></i>
                                        </div>
                                    </div>
                                    <select name="unit" class="form-control select2  @error('unit') is-invalid @enderror">
                                        <optgroup>
                                                <option value="0">Please Select Unit</option>
                                                <option value="kg" @if ($size->unit == "kg")
                                                    selected
                                                @endif>kg</option>
                                                <option value="lbs" @if ($size->unit == "lbs")
                                                    selected
                                                @endif>lbs</option>
                                                <option value="gram" @if ($size->unit == "gram")
                                                    selected
                                                @endif>gram</option>
                                                <option value="mg" @if ($size->unit == "mg")
                                                    selected
                                                @endif>mg</option>
                                                <option value="pcs" @if ($size->unit == "pcs")
                                                    selected
                                                @endif>pcs</option>
                                                <option value="S" @if ($size->unit == "S")
                                                    selected
                                                @endif>S</option>
                                                <option value="M" @if ($size->unit == "M")
                                                    selected
                                                @endif>M</option>
                                                <option value="L" @if ($size->unit == "L")
                                                    selected
                                                @endif>L</option>
                                                <option value="XL" @if ($size->unit == "XL")
                                                    selected
                                                @endif>XL</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                    </div>
                    <div class="form-row">
                            <div class="col-md-12">
                                <label >Servings</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-dark-blue text-light">
                                                <i class="fa fa-users"></i>
                                        </div>
                                    </div>
                                    <input type="number" name="servings" class="form-control @error('servings') is-invalid @enderror" value="{{$size->servings}}" required>
                                </div>
                            </div>
                    </div>
                    </div>
                    <div class="form-row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-success col-3 offset-4">
                                <i class="fa fa-edit"></i>
                                Update
                                </button>
                            </div>
                    </div>
                </form>
            </div>
        @endif
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
                                    <a href="{{url('size/'.encrypt($item->id).'/edit')}}" class="dropdown-item">
                                        <i class="fa fa-edit"></i>
                                        Edit 
                                    </a>
                                    <form action="{{action('SizesController@destroy',$item->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger confirmation">
                                            <i class="fa fa-eye-slash"></i>
                                            Disable
                                        </button>
                                    </form>
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

    {{-- Size Modal --}}
    <div class="modal fade add_size" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Size</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <form action="{{action('SizesController@store')}}" method="POST">
                <div class="modal-body">
                    @csrf
                    
                    <div class="form-row">
                        <div class="col-md-12">
                             <label>Weight/Quantity</label>
                             <div class="input-group mb-2 mr-sm-2">
                                  <div class="input-group-prepend">
                                       <div class="input-group-text bg-dark-blue text-light">
                                            <i class="fa fa-weight"></i>
                                       </div>
                                  </div>
                                  <input type="text" name="weight" class="form-control @error('weight') is-invalid @enderror" placeholder="Enter Weight/Quantity" required>
                                  @error('weight')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                             </div>
                        </div>
                   </div>
                   <div class="form-row">
                        <div class="col-md-12  @error('unit') is-invalid @enderror">
                             <label>Unit</label>
                             <div class="input-group mb-2 mr-sm-2">
                                  <div class="input-group-prepend">
                                       <div class="input-group-text bg-dark-blue text-light">
                                            <i class="fa fa-weight-hanging"></i>
                                       </div>
                                  </div>
                                  <select name="unit" class="form-control select2  @error('unit') is-invalid @enderror">
                                      <optgroup>
                                          <option value="0">Please Select Unit</option>
                                          <option value="kg">kg</option>
                                          <option value="lbs">lbs</option>
                                          <option value="gram">gram</option>
                                          <option value="mg">mg</option>
                                          <option value="pcs">pcs</option>
                                          <option value="S">S</option>
                                          <option value="M">M</option>
                                          <option value="L">L</option>
                                          <option value="XL">XL</option>
                                      </optgroup>
                                  </select>
                                  @error('weight')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                             </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                             <label >Servings</label>
                             <div class="input-group mb-2 mr-sm-2">
                                  <div class="input-group-prepend">
                                       <div class="input-group-text bg-dark-blue text-light">
                                            <i class="fa fa-users"></i>
                                       </div>
                                  </div>
                                  <input type="number" name="servings" class="form-control @error('servings') is-invalid @enderror" placeholder="Enter Servings" required>
                                  @error('servings')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
