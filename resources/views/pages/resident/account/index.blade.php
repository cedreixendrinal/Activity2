@extends('layouts.resident')

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
            <h4 style="font-weight: bold" class="mt-1">My Account</h4>
          </div>

          <div class="col-sm-3">
            <div class="input-group input-group-sm" >



            </div>
          </div>

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

textarea{
    text-align:right;
}
  </style>


{{-- {{ $errors }} --}}

<div class="container-fluid">
  @if (session('success'))
      <div class="alert alert-success">
        {{session('success')}}
      </div>
  @endif
{{--
  @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}
{{-- <div class="row">
          <div class="col-12">
          @if($errors->any())
              {{ implode('', $errors->all(':message')) }}
          @endif


            @if ($errors->has('email'))
            <p style="color:red;">
                @foreach ($errors->get('email') as $errormessage)
                {{ $errormessage }}<br>
                @endforeach
            </p>
            @endif

          </div>
</div> --}}
<div class="container-xl px-4 mt-4">
  <!-- Account page navigation-->

  <div class="row">
      <div class="col-xl-6">
          <!-- Profile picture card-->
          <div class="card mb-4 mb-xl-0 h-100">
              {{-- <div class="card-header">Profile Picture</div> --}}
              <div class="card-header">My Account</div>
              <div class="card-body text-center ">
                  <!-- Profile picture image-->
                  <img class=" rounded-circle mt-5 " style=" width: 100%;
                  height: auto;max-width:300px;"  src="{{ asset('img/pbg.png') }}" alt="">
                  <!-- Profile picture help block-->
                  {{-- <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div> --}}
                  <!-- Profile picture upload button-->
                  {{-- <button class="btn btn-primary" type="button">Upload new image</button> --}}
              </div>
          </div>
      </div>
      <div class="col-xl-6">
          <!-- Account details card-->
          <div class="card mb-4 h-100">
              <div class="card-header">Account Details</div>
              <div class="card-body">
                @foreach($users as $user)
                  <form action="/member/account/{{ $user->id }}" method="POST" enctype="multipart/form-data" id="updateroute">
                    @csrf
                    @method('PUT')
                      <!-- Form Group (username)-->

                      <div class="mb-3">
                          <label class="small mb-1" for="">Member ID</label>
                          <input readonly value="{{$user ->name}}" class="form-control @error('name') is-invalid @enderror" id="name" name="name" type="text" placeholder="Enter your ID" >
                          @if ($errors->has('name'))
                          <p style="color:red;">
                              @foreach ($errors->get('name') as $errormessage)
                              {{ $errormessage }}<br>
                              @endforeach
                          </p>
                          @endif
                      </div>

                      <div class="mb-3">
                        <label class="small mb-1" for="">Member Name</label>
                        <input readonly value="{{$user ->loft_name}}" class="form-control @error('loft_name') is-invalid @enderror" id="emaloft_nameil" name="loft_name" type="text" placeholder="Enter your Name address">
                        @if ($errors->has('email'))
                        <p style="color:red;">
                            @foreach ($errors->get('email') as $errormessage)
                            {{ $errormessage }}<br>
                            @endforeach
                        </p>
                        @endif
                    </div>

                      <div class="mb-3">
                            <label class="small mb-1" for="">Primary Number</label>
                            <input readonly value="{{$user ->primary_number}}" class="form-control @error('primary_number') is-invalid @enderror" id="primary_number" name="primary_number" type="text" placeholder="Enter your primary number">
                            @if ($errors->has('primary_number'))
                            <p style="color:red;">
                                @foreach ($errors->get('primary_number') as $errormessage)
                                {{ $errormessage }}<br>
                                @endforeach
                            </p>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="">Address</label>
                            <input readonly value="{{$user ->address}}" class="form-control @error('address') is-invalid @enderror" id="address" name="address" type="text" placeholder="Enter your address">
                            @if ($errors->has('address'))
                            <p style="color:red;">
                                @foreach ($errors->get('address') as $errormessage)
                                {{ $errormessage }}<br>
                                @endforeach
                            </p>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="">Username</label>
                            <input  readonly value="{{$user ->email}}" class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" placeholder="Enter your email address">
                            @if ($errors->has('email'))
                            <p style="color:red;">
                                @foreach ($errors->get('email') as $errormessage)
                                {{ $errormessage }}<br>
                                @endforeach
                            </p>
                            @endif
                        </div>




                      <div class=" mb-3">
                        <label class="small mb-1" for="">Password</label>

                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                    </div>

                    <div class="mb-3">
                        <label class="small mb-1" for="">Confirm Password</label>

                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">

                    </div>

                      <!-- Form Row-->
                      {{-- <div class="row gx-3 mb-3">
                          <!-- Form Group (first name)-->
                          <div class="col-md-6">
                              <label class="small mb-1" for="inputFirstName">First name</label>
                              <input class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name" value="Valerie">
                          </div>
                          <!-- Form Group (last name)-->
                          <div class="col-md-6">
                              <label class="small mb-1" for="inputLastName">Last name</label>
                              <input class="form-control" id="inputLastName" type="text" placeholder="Enter your last name" value="Luna">
                          </div>
                      </div> --}}
                      <!-- Save changes button-->
                      @endforeach
                      <div class="footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
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


         let updateroutes = "/resident/client/"+user_id;
          $("#updateroute").attr("action", updateroutes);


      $.get('/admin/admin/'+user_id+'/edit', function (data) {
        console.log(data.name);
           $('#name').val(data.name);
           $('#email').val(data.email);
           $("#role").val(data.role);
           $('#password').val(data.password);
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

