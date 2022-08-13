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
                            <a class="dropdown-item" href="{{route('article.show.articles', ['slug', $category->slug])}}}"> {{ $category->label}}</a>
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


    <section class="py-4">
        <div class="container">
            <div class="row g-4 flex-wrap-reverse ">
                <div class="col-12 col-lg-3 p-4">
                    <div class="row bg-white rounded-3 p-4">
                        <h2>Category</h2>
                        <ul class="list-unstyled ">
                            @foreach ($categories as $category)
                            <li class="mb-1">
                                <a class="text-decoration-none " href="{{route('article.show.articles', ['slug', $category->slug])}}}">
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

    </script>

</body>
</html>
