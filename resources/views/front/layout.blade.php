<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Font --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    @isset($breakingNews)
    <section class="py-4" style="color: {{$breakingNewsSettings->text_color}}; background-color: {{$breakingNewsSettings->bg_color}}; ">
        <div class="container">
            <div class="row">
                <h2 class="col font-weight-bold ">Breacking News</h2>
                <p>{{$breakingNews->content}}</p>
            </div>
        </div>
    </section>
    @endisset


    <nav class="navbar navbar-expand-sm navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{route('front.articles')}}">
                <i class="fa-regular fa-face-laugh-wink"></i> News</a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('front.articles')}}">Articles <span class="visually-hidden">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            @foreach ($categories as $category)
                            <a class="dropdown-item" href="{{route('front.show.articles.category', ['slugCategory'=> $category->slug, 'label'=> $category->label])}}"> {{ $category->label}}</a>
                            @endforeach
                        </div>
                    </li>
                </ul>
                {{-- <form class="d-flex my-2 my-lg-0">
                    <input class="form-control me-sm-2" type="text" placeholder="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form> --}}
            </div>
        </div>
    </nav>

    <div class="btn btn-primary position-fixed btnGoToTop">
        <i class="fa-solid fa-angle-up"></i>
    </div>

    {{-- News Letter --}}
    <div class="fixed-bottom alert alert-primary alert-dismissible fade show bg-transparent" role="alert" id="newsletter">
        <button type="button" class="btn-close" aria-label="Close"></button>

        <div class="container bg-info text-white p-4">
            <div class="row">
                <div class="col text-center">
                    <p class="text-uppercase font-weight-bold text-lg ">newsletter</p>
                    <p>Suivre nos dernières nouvelles et événements. Abonnez-vous à notre newsletter</p>
                </div>
            </div>
            <form action="{{ route('newsletter.register') }}" method="POST">
                @csrf
                <div class="form-group d-flex align-items-center gap-4 ">
                    <input type="text" id="email_address" class="form-control flex-fill" name="email" required autofocus>
                    <button type="submit" class="btn btn-primary">
                        S'inscrire
                    </button>
                </div>
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </form>
        </div>
    </div>

    {{--End News Letter--}}


    <section class="py-4">
        <div class="container">
            @yield('breadcrumb')
            <div class="row g-4 flex-wrap-reverse ">
                <div class="col-12 col-lg-3 p-4">
                    <div class="row bg-white rounded-3 p-4">
                        <h2>Category</h2>
                        <ul class="list-unstyled ">
                            @foreach ($categories as $category)
                            <li class="mb-1">
                                <a class="text-decoration-none " href="{{route('front.show.articles.category', ['slugCategory'=> $category->slug, 'label'=> $category->label])}}">
                                    {{ $category->label}}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                </div>

                <div class="col-12 col-lg-9 p-4">
                    @yield('content')
                </div>
            </div>
        </div>
    </section>

    <script>
        let btnGoToTop = document.querySelector('.btnGoToTop')

        btnGoToTop.addEventListener('click', () => {
            document.body.scrollTop = document.documentElement.scrollTop = 0;
        })

        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                btnGoToTop.style.display = "inline-block";
            } else {
                btnGoToTop.style.display = "none";
            }
        }

        let newsletter = document.querySelector('#newsletter')

        document.querySelector('#newsletter .btn-close').addEventListener('click', () => {
            newsletter.classList.remove("show")
            setTimeout(() => {
                if (!newsletter.classList.contains('show')) {
                    newsletter.classList.add("show")
                }

            }, 300000);
        })

    </script>

</body>
</html>
