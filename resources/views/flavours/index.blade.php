@extends('dashboard.app')
@section('title')
    Flavours | {{config('app.name')}}
@endsection
@section('content')
    <div class="jumbotron">
        <h1>
            Flavours
            <i class="fa fa-apple-alt text-blue"></i>
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
        <button type="button" class="btn bg-dark-blue text-light" data-toggle="modal" data-target=".add_flavour">
            <i class="fa fa-plus"></i>
            Add Flavour
        </button>
    </div>
    <div class="container">
          @if (isset($flavour))
               <h5 class="text-center">
                    Update Flavour [{{$flavour->title}}]
               </h5>
              <form action="{{action('FlavourController@update',$flavour->id)}}" method="POST" class="col-sm-6 offset-sm-3 mb-5">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                         <div class="col-md-12">
                              <label >Flavour Name</label>
                              <div class="input-group mb-2 mr-sm-2">
                                   <div class="input-group-prepend">
                                        <div class="input-group-text bg-dark-blue text-light">
                                             <i class="fa fa-apple-alt"></i>
                                        </div>
                                   </div>
                                   <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{$flavour->title}}" required>
                                   @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                         </div>
                    </div>
                    <div class="form-row">
                         <button type="submit" class="btn bg-dark-blue text-light offset-sm-4 col-sm-4">
                         <i class="fa fa-edit"></i>
                         Update
                         </button>
                    </div>
               </form>
          @endif
          <table class="table table-hover text-center" id="data_table">
               <thead>
                    <tr>
                         <th>Sr#</th>
                         <th>Title</th>
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
                                       <a href="{{url('flavour/'.encrypt($item->id).'/edit')}}" class="dropdown-item">
                                           <i class="fa fa-edit"></i>
                                           Edit 
                                       </a>
                                       <form action="{{action('FlavourController@destroy',$item->id)}}" method="post">
                                           @method('DELETE')
                                           @csrf
                                           <button type="submit" class="dropdown-item text-danger confirmation">
                                               <i class="fa fa-eye-slash"></i>
                                               Disable
                                           </button>
                                       </form>
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

    {{-- Size Modal --}}
    <div class="modal fade add_flavour" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">
                    Add Flavour
               </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <form action="{{action('FlavourController@store')}}" method="POST">
                <div class="modal-body">
                    @csrf
                    
                    <div class="form-row">
                        <div class="col-md-12">
                             <label >Flavour Name</label>
                             <div class="input-group mb-2 mr-sm-2">
                                  <div class="input-group-prepend">
                                       <div class="input-group-text bg-dark-blue text-light">
                                            <i class="fa fa-apple-alt"></i>
                                       </div>
                                  </div>
                                  <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter Flavour Name" required>
                                  @error('title')
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