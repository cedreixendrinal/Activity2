@extends('layouts.layout')

@section('title', 'About')

@section('content')

    @php
    $page = [
        'title' => 'Central Luzon State University',
        'description' => 'Science City of Muñoz, Nueva Ecija, Philippines 3120',
        'breadcrumbs' => [],
    ];
    @endphp

    <div style="background-color: #2E556A">
        <div class="container p-3">
            <div class="row">
                <div class="col-sm-3">
                    <img src="{{ asset('uploads/event/CLSU-logo-With-border.png') }}" class="rounded float-left img-thumbnail header-logo img-fluid"
                        style="background-color:transparent; width: auto; height: 128px;" alt="...">
                </div>

                <div class="col-sm-6 text-center align-middle">
                    <div class="h1 text-warning font-weight-bold">{{ $page['title'] }}</div>
                    <div class="text-light font-weight-light"> {{ $page['description'] }} </div>
                </div>
                <div class="col-sm-3">
                    <img src="{{ asset('uploads/event/E-LearningLogo.png') }}" class="rounded float-right img-thumbnail header-logo img-fluid"
                        style="float:right; background-color:transparent; width: auto; height: 128px;" alt="...">
                </div>
            </div>
        </div>
    </div>

    </div>
    </small></small>
    </div>


    <div class="bg-light pt-4">
        <div class="container">
            <div class="card mb-12 bg-light" style="border: 0px;">
                {{-- <div class="row">
                    <div class="col-sm ">
                        <img src="/images/CLSU/CLSU-logo-With-border.png"
                            class="rounded float-left img-thumbnail header-logo" alt="...">
                    </div>
                    <div class="col-sm header-logo">
                        <img src="/images/CLSU/E-LearningLogo.png" class="rounded float-right img-thumbnail header-logo"
                            style="float:right;" alt="...">
                    </div>
                </div> --}}

                {{-- DESCRIPTION --}}
                <div class="row g-3">
                    <div class="col-md-4">
                    <img src="{{ asset('uploads/event/University.png') }}" class="img-fluid rounded-start p-0" alt="..." style="height:400px; box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">

                    </div>
                    <div class="col-md-8">
                        <div class="card-body text-justify" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                            <!-- <h5 class="card-title">Card title</h5> -->
                            <p class="card-text">CLSU seeks to empower today’s science and engineering communities and help
                                develop the next generation of scientists, technologists, and engineers. To these ends, CLSU
                                offers professional development for teachers to provide them with knowledge and pedagogy to
                                effectively engage and prepare their students for future use of technology tools in whatever
                                they pursue.
                            </p>
                            <p class="card-text">CLSU also offers hands-on training in computational thinking,
                                high-performance
                                computing, and big data exploration to students and researchers at nearly every level of
                                sophistication. CLSU “Training” for research professionals focuses on building their skills
                                to
                                use high-performance computing, data-intensive computing, and data analytics within their
                                own
                                research disciplines – from neuroscience and geophysics to the humanities, arts, and social
                                sciences.

                            </p>

                            <p>SDSC seeks to empower today’s science and engineering communities and help develop the next
                                generation of scientists, technologists, and engineers. To these ends, SDSC offers
                                professional
                                development for teachers to provide them with knowledge and pedagogy to effectively engage
                                and
                                prepare their students for future use of technology tools in whatever they pursue.
                            </p>
                            <p>
                                SDSC also offers hands-on training in computational thinking, high-performance computing,
                                and
                                big data exploration to students and researchers at nearly every level of sophistication.
                                SDSC
                                “Training” for research professionals focuses on building their skills to use
                                high-performance
                                computing, data-intensive computing, and data analytics within their own research
                                disciplines –
                                from neuroscience and geophysics to the humanities, arts, and social sciences.

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
        @endsection

        <style>
            body {
                font: normal 15px/22px 'Source Sans Pro', sans-serif;
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

        </style>
