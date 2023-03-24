@extends('layouts.admin')

@section('nav')


<nav class="main-header  navbar-expand navbar-white navbar-light " style="padding: 5px !important;z-index: 1">
  <!-- Left navbar links -->
     <div class="row mx-0">
          <div class="col-sm-1">
            <a class="nav-link " data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color: gray"></i></a>
          </div>

          <div class="col-sm-5">
            <h4 style="font-weight: bold" class="mt-1">Member</h4>
          </div>

          <div class="col-sm-3">
            <div class="input-group input-group-sm" >



            </div>
          </div>

          <div class="col-sm-3">
            {{-- modal --}}
               <!-- Button trigger modal -->
                     <button type="button" class="btn btn-primary  mt-1" data-toggle="modal" data-target="#exampleModalScrollable">
                       Add New Member
                     </button>

                     <!-- Modal -->
                     <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                       <div class="modal-dialog modal-lg" role="document">
                         <div class="modal-content">
                           <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalScrollableTitle">Member Information</h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                           <div class="modal-body">
                             <form name="product-add" id="product-add" action="/admin/user" method="POST" enctype="multipart/form-data" auto>
                               @csrf

                               <div class="container">
                                <div class="row">
                                      <div class="col">
                                      <label for="name">Member ID</label>
                                      <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>

                                      </div>

                                      <div class="col">
                                      <label for="loft_name">Member Name</label>
                                      <input type="text" class="form-control" name="loft_name" id="loft_name" placeholder="Member Name" required>

                                      </div>
                                  </div>

                                  <div class="row">
                                      <div class="col">

                                      <label for="email">Username</label>
                                          <input type="email" class="form-control" name="email" id="email" placeholder="Username" required autocomplete="off">

                                      </div>

                                      <div class="col">

                                      <label for="primary_number">Primary Number</label>
                                          <input type="number" class="form-control" name="primary_number" id="primary_number" placeholder="Primary Number" required>

                                      </div>
                                  </div>


                                  <div class="row">
                                      {{-- <div class="col-6">

                                      <label for="address">Address</label>
                                          <input type="text" class="form-control" name="address" id="address" placeholder="Address" required>

                                      </div> --}}


                                      <div class="col-6">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" name="city" id="city" placeholder="City" required>
                                     </div>

                                  <div class="row">
                                      <div class="col">
                                         <label for="password">Password</label>
                                          <input type="password" class="form-control " data-rule-password="true" name="password" id="password" placeholder="Password" required autocomplete="new-password" >

                                    </div>

                                      <div class="col">
                                        <label for="confirm_password">Confirm Password</label>
                                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" data-rule-password="true" data-rule-equalTo="#password" data-msg-equalTo="Password is incorrect" placeholder="Password" required >
                                      </div>
                                  </div>


                                  <br>


                             </div>

                        </div>

                               <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary">Add Member</button>
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
.error {
      color: red;

   }
  </style>
<div class="container-fluid">
@if(session('status'))
<div class="alert alert-success">
{{ session('status') }}
</div>
@endif
<div class="row">
          <div class="col-12">

            <div class=" card-body table-responsive p-0" style="z-index: -99999">
                    <table class="table table-head-fixed text-nowrap table-striped table-hover" id="table_id" >
                  <thead class="thead-light">
                    <tr>
                     <th>Member ID</th>
                      <th>Member Name</th>
                      <th>Username</th>
                      <th>Primary Number</th>
                      {{-- <th>Address</th> --}}
                      <th>City</th>
                      <th>Club</th>
                      <th>Action</th>

                    </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                    <tr>


                      <td class="align-middle">{{$user ->u_name }}</td>
                      <td class="align-middle">{{$user ->u_loft_name }}</td>
                      <td class="align-middle">{{$user ->u_email }}</td>
                      <td class="align-middle">{{$user ->u_primary_number }}</td>
                      {{-- <td class="align-middle text-wrap" >{{$user ->u_address}}</td> --}}
                      <td class="align-middle text-wrap" >{{$user ->u_city}}</td>
                      <td class="align-middle text-wrap">{{$user ->c_name}}</td>

                      <td class="align-middle">
                          {{-- update modal --}}
                          <button type="button" data-id="{{ $user->u_id }}" class="btn editbtn" style="background: none;
                          color: inherit;
                          border: none;
                          padding: 0;
                          font: inherit;
                          cursor: pointer;
                          outline: inherit;
                          margin-top:-5px;
                          "> <i class="fas fa-edit"></i>Edit </button>

                          <div class="modal fade" id="editModal" role="dialog" tabindex="1"  aria-labelledby="exampleModalLabel"
                          aria-bs-hidden="true" style="z-index:999999999999">
                          <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel"> Update User Account Information </h5>
                                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                          <span aria-bs-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                      <div class="modal-body">
                                        <form action="" method="POST" enctype="multipart/form-data" id="updateroute">
                                        @csrf
                                        @method('PUT')

                                        <div class="container">
                                <div class="row">
                                      <div class="col">
                                      <label for="name2">Name</label>
                                      <input type="text" class="form-control" name="name2" id="name2" placeholder="Name" required>
                                      </div>

                                      <div class="col">
                                      <label for="loft_name2">Member Name</label>
                                      <input type="text" class="form-control" name="loft_name2" id="loft_name2" placeholder="Member Name" required>
                                      </div>
                                  </div>

                                  <div class="row">
                                      <div class="col">

                                      <label for="email2">Username</label>
                                          <input type="email" class="form-control" name="email2" id="email2" placeholder="Username" required>

                                      </div>

                                      <div class="col">

                                      <label for="primary_number2">Primary Number</label>
                                          <input type="number" class="form-control" name="primary_number2" id="primary_number2" placeholder="Primary Number" required>

                                      </div>
                                  </div>


                                  <div class="row">
                                      {{-- <div class="col-6">

                                      <label for="address2">Address</label>
                                          <input type="text" class="form-control" name="address2" id="address2" placeholder="Address" required>

                                      </div> --}}
                                      <div class="col6">
                                        <div class="col-6">
                                            <label for="city2">City</label>
                                            <input type="text" class="form-control" name="city2" id="city2" placeholder="City" required>
                                         </div>
                                      </div>
                                  </div>

                                  <div class="row">
                                      <div class="col">
                                         <label for="password">Password</label>
                                          <input type="text" class="form-control" name="password2" id="password2" placeholder="Password" >
                                      </div>

                                      <div class="col">
                                        <label for="confirm_password2">Confirm Password</label>
                                        <input type="text" class="form-control" name="confirm_password2" id="confirm_password2" placeholder="Password" >
                                      </div>
                                  </div>


                                  <br>


                             </div>

                        </div>

                               <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary">Update Member</button>
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

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


         let updateroutes = "/admin/user/"+user_id;
          $("#updateroute").attr("action", updateroutes);


      $.get('/admin/user/'+user_id+'/edit', function (data) {
        console.log(data.name);
           $('#name2').val(data.name);
           $('#loft_name2').val(data.loft_name);
           $('#email2').val(data.email);
           $("#primary_number2").val(data.primary_number);
           $("#club_id2").val(data.club_id);
        //    $("#address2").val(data.address);
           $("#city2").val(data.city);
       });

    });
  });



    </script>

<script>
   $(document).ready( function () {
    var table = $('#table_id').DataTable( {

        responsive: true,
        columnDefs: [
        { responsivePriority: 1, targets: 0 },
        { responsivePriority: 2, targets: -1 }
    ]
    } );

    new $.fn.dataTable.FixedHeader( table );
    // $('#table_id').DataTable();
} );
</script>

<script>
if ($("#product-add").length > 0) {
$("#product-add").validate({
  rules: {
    name: {
      required: true,
      minlength: 5
    },
  },
  password3: {
    minlength: 5,
  },
  confirm_password3: {
      minlength: 5,
      equalTo: "#password3"
  },
  messages: {
    name: {
      required: "Please enter name",
    },
    password3: {
      required: "Please enter password",
    },
    confirm_password: {
      required: "Please confirm password",
    },
  },
  })
}
</script>

{{--  --}}
@endsection

