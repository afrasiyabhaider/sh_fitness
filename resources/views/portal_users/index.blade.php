@extends('dashboard.app')
@section('title')
    Registered Portal Users | {{config('app.name','Doga Groups')}}
@endsection
@section('content')
    <div class="jumbotron">
         <h2>
              Registered Portal Users
              <i class="fa fa-users text-blue"></i>
         </h2>
         <a href="{{url('portal/user/create')}}" class="btn text-light bg-dark-blue">
               Register Users
               <i class="fa fa-user-plus"></i>
          </a>
    </div>
    <div class="container">
         <table class="table table-responsive table-hover text-center" id="data_table">
              <thead>
                   <th>Sr#</th>
                   <th>Image</th>
                   <th>Name</th>
                   <th>Email</th>
                   {{-- @if (Auth::user()->hasPermissionTo('Reset Portal User Password')) --}}
                    <th>Reset Password</th>
                   {{-- @endif --}}
                   <th>Gender</th>
                   <th>Phone Number</th>
                   <th>Address</th>
                   <th>Actions</th>
              </thead>
              <tbody>
                    @foreach ($users as $key=>$item)
                         <tr>
                              <td>
                                   {{$key+1}}
                              </td>
                              <td>
                                   <img src="{{asset('public/uploads/'.$item->image)}}" alt="User Image" class="img-thumbnail" width="80px" height="80px">
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
                              {{-- @if (Auth::user()->hasPermissionTo('Reset Portal User Password')) --}}
                                   <td>
                                        <a href="{{url('portal/user/password/'.encrypt($item->id))}}" class="btn btn-outline-danger" title="Password of this account will be resetted to 12345678">
                                             <i class="fa fa-user-lock"></i>
                                             Reset Password
                                        </a>
                                   </td>
                              {{-- @endif --}}
                              <td>
                                   {{
                                        $item->gender
                                   }}
                              </td>
                              <td>
                                   {{
                                        $item->phone_number
                                   }}
                              </td>
                              <td>
                                   {{
                                        $item->address
                                   }}
                              </td>
                              <td>
                                   <div class="btn-group">
                                        <button type="button" class="btn bg-dark-blue text-light">Actions</button>
                                        <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                             <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                             <a href="{{url('portal/user/'.encrypt($item->id).'/edit')}}" class="dropdown-item float-left">
                                                  <i class="fa fa-edit"></i>
                                                  Edit
                                             </a>
                                             <form action="{{action('PortalUserController@destroy',$item->id)}}" method="post">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button class="dropdown-item confirmation text-danger">
                                                       <i class="fa fa-eye-slash"></i>
                                                       Disable
                                                  </button>
                                             </form>
                                        </div>
                                   </div>
                              </td>
                         </tr>
                    @endforeach
              </tbody>
         </table>
    </div>
@endsection