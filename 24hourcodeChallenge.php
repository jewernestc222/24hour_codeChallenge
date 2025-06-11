<!doctype html>
<html lang="en" data-layout="horizontal" data-topbar="dark" data-sidebar-size="lg">
<head>

    <meta charset="utf-8" />
    <title>24 Hour Code Challenge</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Jewernest Casquejo" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="images/favicon.png">

    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="assets/libs/gridjs/theme/mermaid.min.css">
    <link rel="stylesheet" href="assets/libs/%40simonwep/pickr/themes/classic.min.css" /> <!-- 'classic' theme -->
    <link rel="stylesheet" href="assets/libs/%40simonwep/pickr/themes/monolith.min.css" /> <!-- 'monolith' theme -->
    <link rel="stylesheet" href="assets/libs/%40simonwep/pickr/themes/nano.min.css" /> <!-- 'nano' theme -->

    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />

    <style>
        .btn-danger.disabled{
            background-color:#9a9ea4;
            border-color:#9a9ea4;
        }
        #page-topbar{
            background-color:#561705 !important;
        }
        .topbar-user{
            background-color:#532f24 !important;
        }
        .nav.custom .nav-link.active{
            background-color:#561705 !important;
            color:#fff !important;
        }
        /* [data-layout=horizontal] .container-fluid,
        [data-layout=horizontal] .layout-width{
            max-width:100% !important;
        } */
        .searchdate{
            width: 250px;
            position: relative;
            margin-bottom: -37px;
            /* left: 260px; */
            margin-left: 260px;
            z-index: 100;
        }
        .searchdate input{
            padding-left:130px;
        }
        .sdatelabel{
            position: absolute;
            left: 10px;
            top: 9px;
        }
        .datetoday{
            font-size: 26px;
            color: #000;
            font-weight: bold;
            font-family:'tahoma';
        }
        .timer{
            font-size:62px;
            color:#fff;
        }
        .empolyee-img{
            text-align: center;;
        }
        .emp-img{
            height:200px;
            width:200px;
            object-fit: cover;
        }
        .emp-name{
            font-size:16px;
            font-weight:bold;
            text-align: center;
            margin-top:10px;
        }
        #emp-details{
            background:#dddddd;
            padding:30px;
            
        }
        .card-body{
            padding:0;
        }
        .time-cat{
            text-align: center;
            font-size:36px;
            margin-top:20px;
            font-weight:bolder;
        }
        .time-cat span{
            color:red;
        }
        .ampm{
            float:left;
            width:50%;
            margin-top:20px;
            /* border:1px solid red; */
            padding-left:5px;
            padding-right:5px;
        }
        .ampm-btn button{
            width:45%;
            margin-left:2px;
            margin-right:2px;
            padding:10px
        }
        .am-header{
            text-align:center;
            margin-bottom:10px;
            font-weight:bold;
            font-size:16px;
        }
        .shortcut-keys{
            margin-top:20px;
            float:left;
            width:100%;
        }
        .keys-w{
            float:left;
            width:25%;
            text-align: center;
        }
        .key{
            font-size:26px;
            font-weight:bold;
        }
        .imp-input{
            margin-top:20px;
            float:left;
            width:100%;
        }
        .imp-input input{
            font-size:26px;
            text-align: center;;
        }
        .today{
            font-size: 20px;
            font-weight: bold;
            background: #561705;
            padding: 5px 10px;
            color: white;
        }
        .timeschedule{
            background: #ddd;
            padding: 8px 10px;
            font-size: 16px;
            margin-bottom: 10px;
            font-weight: bold;
        }
        td.gridjs-td{
            padding: .2rem .6rem;
        }
        th.gridjs-th{
            padding: .3rem .6rem;
        }
        td[data-column-id=date],
        th[data-column-id=date],
        td[data-column-id=timeIn],
        th[data-column-id=timeIn],
        td[data-column-id=timeOut],
        th[data-column-id=timeOut],
        td[data-column-id=late],
        th[data-column-id=late],
        td[data-column-id=undertime],
        th[data-column-id=undertime],
        td[data-column-id=timeSchedule],
        th[data-column-id=timeSchedule]{
            text-align: center;
            font-size:14px;
        }
        td[data-column-id=timeIn],
        td[data-column-id=timeOut],
        td[data-column-id=employeeName]{
            font-weight:bold;
            font-size:14px;
        }
        .layout-width, .container-fluid{
            max-width:100% !important;
        }
        body{
            overflow:hidden;
        }
    </style>
</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="index.html" class="logo logo-dark">

                    </a>

                    <a href="index.html" class="logo logo-light">

                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

                <!-- App Search-->
                <form class="app-search d-none d-md-block">
                    <div class="position-relative" style="color:#fff;">
                        <span style="display:block;padding-top:5px;font-size:26px;font-weight:bold;">24 Hour Code Challenge</span>
                    </div>
                </form>
            </div>

            <div class="d-flex align-items-center">

                

                <div class="datetoday"></div>


            </div>
        </div>
    </div>
</header>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content" style="margin-top:20px;">
                <div class="container-fluid">
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                   <div class="row">
                                     <div class="col-12">
                                                <div style="height:530px;overflow:auto;margin-top:15px;">
                                                    <div id="dtr-log-table"></div>
                                                </div>
                                            </div>

                                        </div>
                                   </div>
                        </div>
                    </div>

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by Jewernest Casquejo
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    

   

    <!-- JAVASCRIPT -->
    <script src="apps/lib/axios.js"></script>
    <script src="apps/lib/vue.global.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <script src="assets/js/moment.js"></script>
    <script src="assets/js/moment.duration.format.js"></script>

    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <!-- gridjs js -->
    <script src="assets/libs/gridjs/gridjs.umd.js"></script>
    <script src="assets/libs/%40simonwep/pickr/pickr.min.js"></script>
    <script src="assets/js/pages/form-pickers.init.js"></script>
    
    <!-- gridjs init -->
    <script src="assets/app/app.24hourcodeChallenge.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>
</html>