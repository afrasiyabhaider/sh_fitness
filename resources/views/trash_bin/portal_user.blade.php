@extends('dashboard.app')
@section('title')
    Portal Users Trash | {{config('app.name','Doga Groups')}}
@endsection
@section('content')
    <div class="jumbotron">
         <h2>
               Portal Users Trash
              <i class="fa fa-users text-blue"></i>
         </h2>
         <a href="{{url('portal/user/')}}" class="btn text-light bg-dark-blue">
               View Users
               <i class="fa fa-eye"></i>
          </a>
    </div>
    <div class="container">
         <table class="table table-hover text-center" id="data_table">
              <thead>
                   <th>Sr#</th>
                   <th>Image</th>
                   <th>Name</th>
                   <th>Email</th>
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
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuReference"> <a href="{{url('portal_user/'.encrypt($item->id).'/restore')}}" class="dropdown-item confirmation">
                                             <i class="fa fa-trash-restore text-success"></i>
                                             Restore 
                                        </a>
                                        <a href="{{url('portal_user/'.encrypt($item->id).'/delete')}}" class="dropdown-item confirmation">
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