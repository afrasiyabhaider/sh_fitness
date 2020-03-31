@extends('dashboard.app')
@section('title')
    Update Portal User | {{config('app.name','Doga Groups')}}
@endsection
@section('content')
    <div class="jumbotron">
         <h2>
              Update Portal User
              <i class="fa fa-user-edit text-blue"></i>
         </h2>
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
          <a href="{{url('portal/user/')}}" class="btn text-light bg-dark-blue">
               View Registered Users
               <i class="fa fa-eye"></i>
          </a>
    </div>
    <div class="container">
          <form action="{{action('PortalUserController@update',$user->id)}}" method="post" enctype="multipart/form-data">
               @csrf
               @method('PUT')
               <div class="form-row">
                    <div class="col-12">
                         <div class="col-6">
                              <img src="{{asset('uploads/'.$user->image)}}" id="img-previewer" alt="" width="150px" height="250px" class="img-thumbnail">
                         </div>
                         <div class="custom-file col-md-3 col-12 mt-3">
                              <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="img-input" name="image">
                              <label class="custom-file-label" for="customFile">
                                   Upload Image... <i class="fa fa-image"></i>
                              </label>
                         </div>
                         <br>
                         <small class="text-blue">
                              <strong>
                                   If no image selected an avatar will be displayed  
                              </strong>
                         </small>
                    </div>
               </div>
               <div class="form-row">
                    <div class="col-md-6">
                         <label>Name</label>
                         <div class="input-group mb-2 mr-sm-2">
                              <div class="input-group-prepend">
                                   <div class="input-group-text bg-dark-blue text-light">
                                        <i class="fa fa-user"></i>
                                   </div>
                              </div>
                              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"  placeholder="Enter Name " value="{{$user->name}}" required>
                         </div>
                    </div>
                    <div class="col-md-6">
                         <label >Phone Number</label>
                         <div class="input-group mb-2 mr-sm-2">
                              <div class="input-group-prepend">
                                   <div class="input-group-text bg-dark-blue text-light">
                                        <i class="fa fa-mobile-alt"></i>
                                   </div>
                              </div>
                              <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" placeholder="Enter Phone Number "  value="{{$user->phone_number}}" required max="20">
                         </div>
                    </div>
               </div>
               <div class="form-row">
                    <div class="col-md-6">
                         <label >Email Address</label>
                         <div class="input-group mb-2 mr-sm-2 ">
                              <div class="input-group-prepend">
                                   <div class="input-group-text bg-dark-blue text-light">
                                        <i class="fa fa-envelope"></i>
                                   </div>
                              </div>
                              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"  placeholder="Enter email"  value="{{$user->email}}" required>
                              {{-- @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}}
                         </div>
                    </div>
                    <div class="col-md-6">
                         <label >Complete Address</label>
                         <div class="input-group mb-2 mr-sm-2">
                              <div class="input-group-prepend">
                                   <div class="input-group-text bg-dark-blue text-light">
                                        <i class="fa fa-home"></i>
                                   </div>
                              </div>
                              <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"  placeholder="Enter Complete Address "  value="{{$user->address}}" required>
                         </div>
                    </div>
               </div>
               <div class="form-row">
                    <div class="col-md-6">
                         <label>Gender</label>
                         <br>
                         <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" id="male" name="gender" class="custom-control-input @error('gender') is-invalid @enderror" value="Male" @if ($user->gender == "Male")
                                  checked
                              @endif>
                              <label class="custom-control-label" for="male">
                                   Male
                              </label>
                         </div>
                         <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" id="female" name="gender" class="custom-control-input @error('gender') is-invalid @enderror" value="Female" @if ($user->gender == "Female")
                                  checked
                              @endif>
                              <label class="custom-control-label" for="female">
                                   Female
                              </label>
                         </div>
                    </div>    
               </div>
               <div class="form-row">
                    <div class="col-12">
                         <button type="submit" class="btn bg-dark-blue text-light col-3 offset-4">
                              <i class="fa fa-save"></i>
                              Save
                         </button>
                    </div>
               </div>
          </form>
    </div>
@endsection