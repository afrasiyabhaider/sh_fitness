@extends('dashboard.app')
@section('title')
    Register Portal User | {{config('app.name','Doga Groups')}}
@endsection
@section('content')
    <div class="jumbotron">
         <h2>
              Register Portal Users
              <i class="fa fa-user-plus text-blue"></i>
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
          <form action="{{action('PortalUserController@store')}}" method="post" enctype="multipart/form-data">
               @csrf
               <div class="form-row">
                    <div class="col-12">
                         <div class="col-sm-6">
                              <img src="{{asset('dashboard/images/image_upload.png')}}" id="img-previewer" alt="" width="150px" height="250px" class="img-thumbnail">
                         </div>
                         <div class="custom-file col-md-3 col-sm-6 col-12 mt-3">
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
                              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"  placeholder="Enter Name " required>
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
                              <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" placeholder="Enter Phone Number " required max-length="20" max>
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
                              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"  placeholder="Enter email" value="{{old('email')}}" required>
                              {{-- @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}}
                         </div>
                    </div>
                    <div class="col-md-6">
                         <label >Password</label>
                         <div class="input-group mb-2 mr-sm-2">
                              <div class="input-group-prepend">
                                   <div class="input-group-text bg-dark-blue text-light">
                                        <i class="fa fa-user-lock"></i>
                                   </div>
                              </div>
                              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter Password" required>
                         </div>
                    </div>
               </div>
               <div class="form-row">
                    <div class="col-md-6">
                         <label >Confirm Password</label>
                         <div class="input-group mb-2 mr-sm-2">
                              <div class="input-group-prepend">
                                   <div class="input-group-text bg-dark-blue text-light">
                                        <i class="fa fa-user-lock"></i>
                                   </div>
                              </div>
                              <input type="password" name="conf_pass" class="form-control @error('conf_pass') is-invalid @enderror"  placeholder="Re-Enter Password " required>
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
                              <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"  placeholder="Enter Complete Address " required>
                         </div>
                    </div>
               </div>
               <div class="form-row">
                    <div class="col-md-6">
                         <label>Gender</label>
                         <br>
                         <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" id="male" name="gender" class="custom-control-input @error('gender') is-invalid @enderror" value="Male">
                              <label class="custom-control-label" for="male">
                                   Male
                              </label>
                         </div>
                         <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" id="female" name="gender" class="custom-control-input @error('gender') is-invalid @enderror" value="Female">
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