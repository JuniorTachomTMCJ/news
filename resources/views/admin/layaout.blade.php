<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{config('app.name', 'News') }}</title>

    <!-- Custom fonts for this template-->
    <link href="{{URL::asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{URL::asset('admin_assets/css/sb-admin-2.css')}}" rel="stylesheet">

    <!-- Custom styles for this datatable -->
    <link href="{{URL::asset('admin_assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @auth
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('article.index')}}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">News Admin</div>
            </a>

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

            <!-- Nav Item - Article -->
            <li class="nav-item">
                <a class="nav-link" href="{{route('article.index')}}">
                    <i class="far fa-newspaper"></i>
                    <span>Article</span></a>
            </li>

            <!-- Nav Item - BreakingNews -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('breakingNews.index')}}" data-toggle="collapse" data-target="#collapseBreakingNews" aria-expanded="false" aria-controls="collapseBreakingNews">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Nouvelles</span>
                </a>
                <div id="collapseBreakingNews" class="collapse" aria-labelledby="headingBreakingNews" data-parent="#accordionSidebar" style="">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{route('breakingNews.index')}}">Liste</a>
                        <a class="collapse-item" href="{{route('breakingNews.setting.index')}}">Paramettres</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Category -->
            <li class="nav-item">
                <a class="nav-link" href="{{route('category.index')}}">
                    <i class="fa fa-list-alt"></i>
                    <span>Categorie</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
        @endauth

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                @auth
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle" src="{{URL::asset('admin_assets/img/undraw_profile.svg')}}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profil
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Paramètres
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Déconnexion
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                @endauth

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; news 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Prêt à partir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Sélectionnez "Déconnexion" ci-dessous si vous êtes prêt à mettre fin à votre session en cours.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                    <a class="btn btn-primary" href="{{route('logout')}}">Déconnexion</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{URL::asset('admin_assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{URL::asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{URL::asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all BreakingNews-->
    <script src="{{URL::asset('admin_assets/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{URL::asset('admin_assets/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{URL::asset('admin_assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('admin_assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{URL::asset('admin_assets/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{URL::asset('admin_assets/js/demo/chart-pie-demo.js')}}"></script>
    <script src="{{URL::asset('admin_assets/js/demo/datatables-demo.js')}}"></script>


    @yield('script')

</body>

</html>
