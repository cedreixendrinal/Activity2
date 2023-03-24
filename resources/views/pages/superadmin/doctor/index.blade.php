@extends('layouts.admin')

@section('nav')

{{-- @if ($errors->any())

@endif --}}
<nav class="main-header  navbar-expand navbar-white navbar-light " style="padding: 5px !important;z-index: 1">
  <!-- Left navbar links -->
     <div class="row mx-0">
          <div class="col-sm-1">
            <a class="nav-link " data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color: gray"></i></a>
          </div>

          <div class="col-sm-5">
            <h4 style="font-weight: bold" class="mt-1">Doctor</h4>
          </div>

          <div class="col-sm-3">
            <div class="input-group input-group-sm" >



            </div>
          </div>

          <div class="col-sm-3">
            {{-- modal --}}
               <!-- Button trigger modal -->
                     <button type="button" class="btn btn-primary  mt-1" data-toggle="modal" data-target="#exampleModalScrollable">
                       Add New Doctor
                     </button>

                     <!-- Modal -->
                     <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                       <div class="modal-dialog " role="document">
                         <div class="modal-content">
                           <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalScrollableTitle">User Information</h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                           <div class="modal-body">
                             <form action="/admin/doctor" method="POST" enctype="multipart/form-data">
                               @csrf

                               <div class="container">
                                <div class="row">
                                      <div class="col-sm">
                                      <label for="name">Name</label>
                                      <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
                                      </div>
                                  </div>


                                  <div class="row">
                                      <div class="col-sm">
                                      <label for="speciality">Speciality</label>
                                      <input type="text" class="form-control" name="speciality" id="speciality" placeholder="Speciality" required>
                                      </div>
                                  </div>

                                  <div class="row">
                                      <div class="col-sm">

                                      <label for="email">Email</label>
                                          <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>

                                      </div>
                                  </div>


                                  <br>


                             </div>

                        </div>

                               <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary">Add Doctor</button>
                               </div>
                               </form>
                           </div>
                         </div>
                       </div>
                     </div>
            {{-- modal --}}
        </div>
     </div>




    <!-- <li class="nav-item d-none d-sm-inline-block">
      <a href="../../index3.html" class="nav-link">Home</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link">Contact</a>
    </li> -->


  <!-- Right navbar links -->

</nav>
@endsection

@section('content')
<style>
    .pac-container {
    background-color: #FFF;
    z-index: 99999;
    position: fixed;
    display: inline-block;
    float: left;
}
.modal{
    z-index: 99999;
}
.modal-backdrop{
    z-index: 10;
}
  </style>
<div class="container-fluid">
  @if (session('success'))
      <div class="alert alert-success">
        {{session('success')}}
      </div>
  @endif
<div class="row">
          <div class="col-12">
          @if($errors->any())
              {{ implode('', $errors->all(':message')) }}
          @endif
              <div class=" card-body table-responsive p-0" style="z-index: -99999">
                <table id="table_id" class="table table-head-fixed text-nowrap table-striped table-hover">
                  <thead class="thead-light">
                    <tr>
                     <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Action</th>

                    </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                    <tr>

                      <td class="align-middle">{{$user ->id }}</td>
                      <td class="align-middle text-wrap" >{{$user ->name}}</td>
                      <td class="align-middle text-wrap">{{$user ->email}}</td>

                      <td class="align-middle">
                          {{-- update modal --}}
                          <button type="button" data-id="{{ $user->id }}" class="btn editbtn" style="background: none;
                          color: inherit;
                          border: none;
                          padding: 0;
                          font: inherit;
                          cursor: pointer;
                          outline: inherit;
                          margin-top:-5px;
                          "> <i class="fas fa-edit"></i>Edit </button>

                          <div class="modal fade" id="editModal" role="dialog" aria-labelledby="exampleModalLabel"
                          aria-bs-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel"> Update User Account Information </h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-bs-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                      <div class="modal-body">
                                        <form action="" method="POST" enctype="multipart/form-data" id="updateroute">
                                        @csrf
                                        @method('PUT')

                                        <div class="container">
                                <div class="row">
                                      <div class="col-sm">
                                      <label for="name2">Name</label>
                                      <input type="text" class="form-control" name="name2" id="name2" placeholder="Name" required>
                                      </div>
                                  </div>

                                 <div class="row">
                                      <div class="col-sm">

                                      <label for="email2">Email</label>
                                          <input type="email2" class="form-control" name="email2" id="email2" placeholder="Email" required>

                                      </div>
                                  </div>




                                  <div class="row">
                                      <div class="col-sm">
                                      <label for="password2">Password</label>
                                      <input type="password" class="form-control" name="password2" id="password2" placeholder="Password" >
                                      </div>
                                  </div>

                                 <div class="row">
                                      <div class="col-sm">
                                          <label for="confirm2">Confirm Password</label>
                                          <input id="password-confirm2" type="password" class="form-control" name="password_confirmation2" class="form-control" placeholder="Password" >
                                      </div>
                                  </div>
                                  <br>


                             </div>

                        </div>

                               <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary">Save changes</button>
                               </div>
                               </form>

                              </div>
                          </div>
                     </div>

                          {{-- update modal --}}

                      </td>


                      {{-- here --}}
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="mt-2">
              {{$users->links()}}
            </div>
          </div>
        </div>
</div>
{{--  --}}



  </body>
  </html>


  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKOU_JfykYBj4kDS8ryXPSd0kxsygDcGU&libraries=places"></script>


  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


  <script>


  $(document).ready(function () {



    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('body').on('click', '.editbtn', function () {
      var user_id = $(this).data('id');
      $('#editModal').modal('show');


         let updateroutes = "/admin/admin/"+user_id;
          $("#updateroute").attr("action", updateroutes);


      $.get('/admin/admin/'+user_id+'/edit', function (data) {
        console.log(data.name);
           $('#name2').val(data.name);
           $('#email2').val(data.email);
           $("#role2").val(data.role);
           $('#password2').val(data.password);
       });

    });
  });



    </script>

<script>
   $(document).ready( function () {
    $('#table_id').DataTable();
} );
</script>

{{--  --}}
@endsection

