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
            <h4 style="font-weight: bold" class="mt-1">Clock In</h4>
          </div>

          <div class="col-sm-3">
            <div class="input-group input-group-sm" >



            </div>
          </div>





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




.padding-bottom--24 {
  padding-bottom: 24px;
}
.padding-horizontal--48 {
  padding: 48px;
}
.padding-bottom--15 {
  padding-bottom: 15px;
}



.formbg {
    margin: 0px auto;
    width: 100%;
    max-width: 448px;
    background: white;
    border-radius: 4px;
    box-shadow: rgba(60, 66, 87, 0.12) 0px 7px 14px 0px, rgba(0, 0, 0, 0.12) 0px 3px 6px 0px;
}
span {
    display: block;
    font-size: 20px;
    line-height: 28px;
    color: #1a1f36;
}
label {
    margin-bottom: 10px;
}
.reset-pass a,label {
    font-size: 14px;
    font-weight: 600;
    display: block;
}
.reset-pass > a {
    text-align: right;
    margin-bottom: 10px;
}
.grid--50-50 {
    display: grid;
    grid-template-columns: 50% 50%;
    align-items: center;
}

.field input {
    font-size: 16px;
    line-height: 28px;
    padding: 8px 16px;
    width: 100%;
    min-height: 44px;
    border: unset;
    border-radius: 4px;
    outline-color: rgb(84 105 212 / 0.5);
    background-color: rgb(255, 255, 255);
    box-shadow: rgba(0, 0, 0, 0) 0px 0px 0px 0px,
                rgba(0, 0, 0, 0) 0px 0px 0px 0px,
                rgba(0, 0, 0, 0) 0px 0px 0px 0px,
                rgba(60, 66, 87, 0.16) 0px 0px 0px 1px,
                rgba(0, 0, 0, 0) 0px 0px 0px 0px,
                rgba(0, 0, 0, 0) 0px 0px 0px 0px,
                rgba(0, 0, 0, 0) 0px 0px 0px 0px;
}

input[type="submit"] {
    background-color: rgb(84, 105, 212);
    box-shadow: rgba(0, 0, 0, 0) 0px 0px 0px 0px,
                rgba(0, 0, 0, 0) 0px 0px 0px 0px,
                rgba(0, 0, 0, 0.12) 0px 1px 1px 0px,
                rgb(84, 105, 212) 0px 0px 0px 1px,
                rgba(0, 0, 0, 0) 0px 0px 0px 0px,
                rgba(0, 0, 0, 0) 0px 0px 0px 0px,
                rgba(60, 66, 87, 0.08) 0px 2px 5px 0px;
    color: #fff;
    font-weight: 600;
    cursor: pointer;
}
.field-checkbox input {
    width: 20px;
    height: 15px;
    margin-right: 5px;
    box-shadow: unset;
    min-height: unset;
}
.field-checkbox label {
    display: flex;
    align-items: center;
    margin: 0;
}
a.ssolink {
    display: block;
    text-align: center;
    font-weight: 600;
}
.footer-link span {
    font-size: 14px;
    text-align: center;
}
.listing a {
    color: #697386;
    font-weight: 600;
    margin: 0 10px;
}

.animationRightLeft {
  animation: animationRightLeft 2s ease-in-out infinite;
}
.animationLeftRight {
  animation: animationLeftRight 2s ease-in-out infinite;
}
.tans3s {
  animation: animationLeftRight 3s ease-in-out infinite;
}
.tans4s {
  animation: animationLeftRight 4s ease-in-out infinite;
}

@keyframes animationLeftRight {
  0% {
    transform: translateX(0px);
  }
  50% {
    transform: translateX(1000px);
  }
  100% {
    transform: translateX(0px);
  }
}

@keyframes animationRightLeft {
  0% {
    transform: translateX(0px);
  }
  50% {
    transform: translateX(-1000px);
  }
  100% {
    transform: translateX(0px);
  }
}
  </style>
<div class="container-fluid">
  @if (session('success'))
      <div class="alert alert-success">
        {{session('success')}}
      </div>
  @endif

  @php

  $dateStart = new DateTime('2011-01-03 17:13:00');
  $dateEnd = new DateTime('2011-01-04 21:13:02');
  $interval = $dateStart->diff($dateEnd);

  // day convert to min
  $day = $interval->format('%a');
  $dayToHour = $day * 24;
  $HourToMin = $dayToHour * 60;

  // hour convert to min
  $hour = $interval->format('%h');
  $HourToMin2 = $hour * 60;

  $min = $interval->format('%i');

  // sec convert to min
  $sec = $interval->format('%s');
  $SecToMin = $sec/60;

  $totalMin = $HourToMin + $HourToMin2 +  $min + $SecToMin;


  @endphp
<div class="row">
   <div class="col-12">

   <div class="login-root">
    <div class="box-root flex-flex flex-direction--column" style="min-height: 100vh;flex-grow: 1;">
      <div class="loginbackground box-background--white padding-top--64">
        <div class="loginbackground-gridContainer">
          <div class="box-root flex-flex" style="grid-area: top / start / 8 / end;">

          </div>
          <div class="box-root flex-flex" style="grid-area: 4 / 2 / auto / 5;">
            <div class="box-root box-divider--light-all-2 animationLeftRight tans3s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 6 / start / auto / 2;">
            <div class="box-root box-background--blue800" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 7 / start / auto / 4;">
            <div class="box-root box-background--blue animationLeftRight" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 8 / 4 / auto / 6;">
            <div class="box-root box-background--gray100 animationLeftRight tans3s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 2 / 15 / auto / end;">
            <div class="box-root box-background--cyan200 animationRightLeft tans4s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 3 / 14 / auto / end;">
            <div class="box-root box-background--blue animationRightLeft" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 4 / 17 / auto / 20;">
            <div class="box-root box-background--gray100 animationRightLeft tans4s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 5 / 14 / auto / 17;">
            <div class="box-root box-divider--light-all-2 animationRightLeft tans3s" style="flex-grow: 1;"></div>
          </div>
        </div>
      </div>
      <div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9;">
   <br>
        <div class="formbg-outer">
          <div class="formbg">
          <ul id="update_msgList"></ul>

          <div id="success_message"></div>

            <div class="formbg-inner padding-horizontal--48">
              <span class="padding-bottom--15">Clock In</span>

                <div class="field padding-bottom--24">
                  <label for="serial_code">Serial Code</label>
                  <input type="text" name="serial_code" id="serial_code">
                </div>
                <div class="field padding-bottom--24">
                  <button type="submit" class="btn btn-primary update_clock">Submit</button>
                </div>

            </div>
          </div>
          <div class="footer-link padding-top--24">

            <div class="listing padding-top--24 padding-bottom--24 flex-flex center-center">
              <span><a href="#">Contact</a></span>
              <span><a href="#">Privacy & terms</a></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


    </div>
</div>


<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog  " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle">Pigeon Information</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="alert alert-success">
            Serial code submitted successfully!
          </div>
        <div class="modal-body">


                <div class="col-md-12" style="font-size:20px;">
                    <div class="row">
                        <div class="col-sm-12">
                          Date Start: <data id="date_start"  style="font-weight: bold"></data>
                        </div>
                        <div class="col-sm-9 text-secondary"  id="viewName">

                        </div>
                      </div>
                      <hr>
                        <div class="row">
                          <div class="col-sm-12">
                            Distance: <data id="ld"  style="font-weight: bold"></data>
                          </div>
                          <div class="col-sm-9 text-secondary"  id="viewName">

                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-12">
                            BC: <data id="bc"  style="font-weight: bold"></data>
                          </div>
                          <div class="col-sm-9 text-secondary"  id="viewAddress">

                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-12">
                            Percentage: <data id="percentage"  style="font-weight: bold"></data><strong>%</strong>
                          </div>
                          <div class="col-sm-9 text-secondary"  id="viewMobile">

                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-12">
                            Ring No: <data id="bn"  style="font-weight: bold"></data>
                          </div>
                          <div class="col-sm-9 text-secondary"  id="viewEmail">

                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-12">
                            Arrival: <data id="arrival"  style="font-weight: bold"></data>
                          </div>
                          <div class="col-sm-9 text-secondary"  id="viewMobile">

                          </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                              Points: <data id="points"  style="font-weight: bold">  </data>
                            </div>
                            <div class="col-sm-9 text-secondary"  id="viewMobile">

                            </div>
                          </div>

                          <hr>
                        <div class="row">
                            <div class="col-sm-12">
                              Speed:<data id="speed"  style="font-weight: bold"></data>
                            </div>
                            <div class="col-sm-9 text-secondary"  id="viewMobile">

                            </div>
                          </div>
                        <hr>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

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

    $(document).on('click', '.update_clock', function (e) {
            e.preventDefault();


            // alert(id);

            var data = {
                'serial_code': $('#serial_code').val(),
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "PUT",
                url: "/member/clock/in",
                data: data,
                dataType: "json",
                success: function (response) {
                    // console.log(response);
                    if (response.status == 400) {
                        $('#update_msgList').html("");
                        $('#update_msgList').addClass('alert alert-danger');
                        $.each(response.errors, function (key, err_value) {
                            $('#update_msgList').append('<li>' + err_value +'</li>');
                        });
                    }
                    else if (response.status == 404) {
                        $('#update_msgList').html("");
                        $('#update_msgList').addClass('alert alert-danger');
                        $('#update_msgList').append('<li>' +response.message+'</li>');

                    }
                    else {
                        $('#update_msgList').html("");
                        $('#update_msgList').removeClass('alert alert-danger');
                        $('#success_message').addClass('alert alert-success');
                        $('#serial_code').val("");
                        $('#success_message').text(response.message);

                        $('#exampleModalScrollable').modal('show');
                      // dito modal
                      if (response.data != null) {
                          $.each(response.data, function (key, item) {
                              console.log(response.data.BC);
                        $('#ld').text(response.data.LD);
                        $('#bc').text(response.data.BC);
                        $('#bn').text(response.data.BN);
                        $('#arrival').text(response.data.Arrival);
                        $('#speed').text(response.data.Speed);
                        $('#points').text(response.data.points);
                        $('#percentage').text(response.data.percentage);
                        $('#date_start').text(response.data.date_start);
                        //       $('.OrderTbody2').append('<tr>\
                        //           <td>' + item.medicine + '</td>\
                        //           <td class="text-wrap">' + item.quantity + '</td>\
                        //           <td>' + item.times + '</td></tr>');
                          });

                        }




                    }
                }
            });

        });
      });


    </script>


<script>
   $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>




{{--  --}}
@endsection

