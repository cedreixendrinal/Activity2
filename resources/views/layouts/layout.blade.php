<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CLSU - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin/dist/img/logo.ico') }}" />
</head>

<body>
    <header class="py-2 sticky-top border-bottom border-warning" style="background-color: #2E556A">
        <div class="container">

            <nav class="navbar navbar-expand-lg navbar-dark">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <a class="navbar-brand text-warning" href="#">[ CLSU ]</a>
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                            </li>
                            <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="" id="navbarScrollingDropdown"
                                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        About
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                                        <li><a class="dropdown-item" href="/about">CLSU</a></li>
                                        <li><a class="dropdown-item" href="#">Overview</a></li>
                                        <li><a class="dropdown-item" href="">Timeline</a></li>
                                        <li><a class="dropdown-item" href="#">About the Director</a></li>
                                        <li><a class="dropdown-item" href="#">Leadership & Contacts</a></li>
                                        <li><a class="dropdown-item" href="#">Staff Directory</a></li>
                                        <li><a class="dropdown-item" href="#">Careers</a></li>
                                        <li><a class="dropdown-item" href="#">Visitors Infor</a></li>
                                        {{-- <li><hr class="dropdown-divider"></li> --}}
                                        {{-- <li><a class="dropdown-item" href="#">Something else here</a></li> --}}
                                    </ul>
                                </li>
                            </li>

                            <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="" id="navbarScrollingDropdown"
                                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        What's up
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                                        <li><a class="dropdown-item" href="/about">Announcement</a></li>
                                        <li><a class="dropdown-item" href="#">Media</a></li>
                                        <li><a class="dropdown-item" href="">Speechless</a></li>
                                        <li><a class="dropdown-item" href="#">Featured Stories</a></li>
                                        <li><a class="dropdown-item" href="#">Events</a></li>
                                        {{-- <li><hr class="dropdown-divider"></li> --}}
                                        {{-- <li><a class="dropdown-item" href="#">Something else here</a></li> --}}
                                    </ul>
                                </li>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">Support</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/material">Education & Training</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="/event">News & Events</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/learning">My Learnings</a>
                            </li>
                        </ul>
                        <!-- <form class="d-flex">
                            <input class="form-control form-control-sm me-2" type="search" placeholder="Search"
                                aria-label="Search">
                            <button class="btn btn-dark" type="submit">Search</button>
                        </form> -->
                    </div>
                </div>
            </nav>

        </div>

    </header>

    @yield('content')


    {{-- FOOTER --}}
    <div class='mt-5 mb-5 text-center'> Copyright 2022</div>
    {{-- <div class="row">
    <div style="background-color:#282e32;" class="row p-5 text-light">
        Copyright @ 2022
    </div>
  </div> --}}

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
        integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
    </script>

</body>

</html>

<style>
    body {
        font: normal 15px/22px 'Source Sans Pro', sans-serif;
        background-color: #e7eaed;
    }

    .header-logo {
        width: 30%;
        border: 0px;
    }

    header {
        background-color: '#2F5469';
        font: white;
    }

    nav {
        background-color: '#2F5469';
    }

    button:hover {
        opacity: 10;
    }

</style>
