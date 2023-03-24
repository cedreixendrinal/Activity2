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
            <h4 style="font-weight: bold" class="mt-1">Pigeon</h4>
          </div>

          <div class="col-sm-3">
            <div class="input-group input-group-sm" >



            </div>
          </div>

          <div class="col-sm-3">
            {{-- modal --}}
               <!-- Button trigger modal -->
                     <button type="button" class="btn btn-primary  mt-1" data-toggle="modal" data-target="#exampleModalScrollable">
                       Assign Pigeon
                     </button>

                     <!-- Modal -->
                     <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                       <div class="modal-dialog  " role="document">
                         <div class="modal-content">
                           <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalScrollableTitle">Pigeon Information</h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                           <div class="modal-body">
                             <form action="/admin/kalapati" method="POST" enctype="multipart/form-data" autocomplete="off">
                               @csrf

                               <div class="container">

                               <div class="row">
                                    <label for="Pigeon" class="form-label">Select Owner</label>
                                    <input class="form-control" list="datalistOptions" id="txt" placeholder="Select Owner">
                                    <datalist id="datalistOptions">
                                    @foreach($users as $user)
                                    <option value=" {{$user->name}}" data-id="{{$user->id}}">
                                        @endforeach
                                    </datalist>
                                    <input style="display:none" type="text" id="user_id" name="user_id">

                                </div>



                                <div class="row">
                                    <div class="col-sm">
                                        <label for="ring_no">Ring No</label>
                                        <input type="text" class="form-control" name="ring_no" id="ring_no" placeholder="Ring No" required>
                                    </div>

                                </div>

                                <br>

                        </div>

                               <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary">Assign Pigeon</button>
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
.text {
   overflow: hidden;
   text-overflow: ellipsis;
   display: -webkit-box;
   -webkit-line-clamp: 2; /* number of lines to show */
   -webkit-box-orient: vertical;
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

              <div class=" card-body table-responsive p-0" style="z-index: -99999">
                <table class="table table-head-fixed text-nowrap table-striped table-hover" id="myTable" >
                  <thead class="thead-light">
                    <tr>
                     <th>ID</th>
                      <th>Owner</th>
                      <th>Ring No</th>
                      <th>Action</th>

                    </tr>
                  </thead>
                  <tbody>
                    @foreach($kalapatis as $kalapati)
                    <tr>

                      <td class="align-middle">{{$kalapati ->k_id }}</td>
                      <td class="align-middle">{{$kalapati ->u_name}}</td>
                      <td class="align-middle">{{$kalapati ->k_ring_no}}</td>
                      <td class="align-middle">
                          {{-- update modal --}}
                          <button type="button" data-id="{{ $kalapati->k_id }}"  class="btn editbtn" style="background: none;
                          color: inherit;
                          border: none;
                          padding: 0;
                          font: inherit;
                          cursor: pointer;
                          outline: inherit;
                          margin-top:-5px;
                          "> <i class="fas fa-edit"></i>Edit </button>

                          <div class="modal fade"  id="editmodal" role="dialog" aria-labelledby="exampleModalLabel"
                          aria-bs-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel"> Update  Information </h5>
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
                                                <label for="Pigeon" class="form-label">Select Owner</label>
                                                <input class="form-control" list="datalistOptions" id="txt" placeholder="Select Owner">
                                                <datalist id="datalistOptions">
                                                @foreach($users as $user)
                                                <option value=" {{$user->name}}" data-id="{{$user->id}}">
                                                    @endforeach
                                                </datalist>
                                                <input style="display:" type="text" id="user_id2" name="user_id2">

                                            </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <label for="ring_no2">Ring No</label>
                                        <input type="text" class="form-control" name="ring_no2" id="ring_no2" placeholder="Ring No" required>
                                    </div>

                                </div>

                                <br>

                        </div>

                               <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary">Assign Pigeon</button>
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


  <script>
  $(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('body').on('click', '.editbtn', function () {
      var id = $(this).data('id');
      $('#editmodal').modal('show');


         let updateroutes = "/admin/kalapati/"+id;
          $("#updateroute").attr("action", updateroutes);


      $.get('/admin/kalapati/'+id+'/edit', function (data) {
        console.log(data);
           $('#ring_no2').val(data.ring_no);
           $('#user_id2').val(data.user_id);
       });

    });
  });


  $('#txt').on('change', function() {
        var user_id =  $("#datalistOptions option[value='" + $('#txt').val() + "']").attr('data-id');

        $("#user_id").val(user_id);

var obj = $("#datalistOptions").find("option[value='" + val + "']");

if(obj != null && obj.length > 0){
    // alert("valid");  // allow form submission
}

else{
    alert("invalid"); // don't allow form submission
}

});

    </script>


<script>
   $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>




{{--  --}}
@endsection

