<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>{{env('APP_NAME')}} - Free Bootstrap 4 Admin Template</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    @if(App::getLocale()=='ar')
    <link rel="stylesheet" type="text/css" href="{{asset('admin_panel/ar/css/main.css')}}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    @else

    <link rel="stylesheet" type="text/css" href="{{asset('admin_panel/ar/css/en_main.css')}}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">



    @endif
</head>

<body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="{{route('admin.dashboard')}}">{{trans('dashborad.appname')}}</a>
        <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
        <!-- Navbar Right Menu-->
        <ul class="app-nav">

            <!--language Menu-->
            <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications">
                    @if(app()->getLocale()=='ar') ar @else en @endif</a>
                <ul class="app-notification dropdown-menu dropdown-menu-right">
                    <div class="app-notification__content">
                        <li><a class="app-notification__item" href="{{ LaravelLocalization::getLocalizedURL('en') }}">en

                            </a></li>
                        <li><a class="app-notification__item" href="{{ LaravelLocalization::getLocalizedURL('ar') }}">ar

                            </a></li>
            </li>

            </div>

        </ul>
        </li>

        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
                <li><a class="dropdown-item" href="{{route('admin.profile.index')}}"><i class="fa fa-user fa-lg"></i> Profile</a></li>
                <li>
                    <form method="POST" action="{{route('logout')}}">
                        @csrf
                        <button class="dropdown-item" href="{{ route('logout') }}"><i class="bx bx-log-out"></i>
                            <i class="fa fa-sign-out fa-lg"></i> تسجيل الخروج</button>

                    </form>

                </li>
            </ul>
        </li>
        </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="{{asset('assets/users/'.auth()->user()->image)}}" alt="User Image" width="100px" height="100px">
            <div>
                <p class="app-sidebar__user-name">{{$language=='ar'?auth()->user()->name:auth()->user()->name_en}}</p>
            </div>
        </div>
        <ul class="app-menu">
            <li><a class="app-menu__item active" href="{{route('admin.dashboard')}}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">products</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="{{route('admin.categories.index')}}"><i class="icon fa fa-circle-o"></i>categories</a></li>
                    <li><a class="treeview-item" href="{{route('admin.departments.index')}}"><i class="icon fa fa-circle-o"></i>departments</a></li>
                    <li><a class="treeview-item" href="{{route('admin.advertisements.index')}}"><i class="icon fa fa-circle-o"></i>advertisements</a></li>
                    <li><a class="treeview-item" href="{{route('admin.advertisementUsers.index')}}"><i class="icon fa fa-circle-o"></i>advertisements User</a></li>
                    <li><a class="treeview-item" href="{{route('admin.products.index')}}"><i class="icon fa fa-circle-o"></i> products</a></li>
                    <li><a class="treeview-item" href="{{route('admin.productdetails.index')}}"><i class="icon fa fa-circle-o"></i> منتجات الفرعية</a></li>

                </ul>
            </li>
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">{{__('app.roles')}}</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="{{route('admin.roles.index')}}"><i class="icon fa fa-circle-o"></i>roles</a></li>
                    <li><a class="treeview-item" href="{{--route('admin.supervisors.index')--}}"><i class="icon fa fa-circle-o"></i> supervisors </a></li>
                    <li><a class="treeview-item" href="{{route('admin.sellers.index')}}"><i class="icon fa fa-circle-o"></i> بائعين</a></li>
                    <li><a class="treeview-item" href="{{route('admin.users.index')}}"><i class="icon fa fa-circle-o"></i> users</a></li>
                </ul>
            </li>
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">عمليات المستخدمين </span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="{{route('admin.problems.index')}}"><i class="icon fa fa-circle-o"></i> طلب مشاكل </a></li>
                    <li><a class="treeview-item" href="{{route('admin.appevaluations.index')}}"><i class="icon fa fa-circle-o"></i> تقييم المستخدمين للتطبيق </a></li>

                </ul>
            </li>
            <li><a class="app-menu__item" href="{{route('admin.onslashs.index')}}"><i class="app-menu__icon fa fa-file-code-o"></i><span class="app-menu__label">شاشات onslashs</span></a></li>

            <li><a class="app-menu__item" href="{{route('admin.settings.index')}}"><i class="app-menu__icon fa fa-file-code-o"></i><span class="app-menu__label">settings</span></a></li>
            <li><a class="app-menu__item" href="{{route('admin.productdetialsInputs.index')}}"><i class="app-menu__icon fa fa-file-code-o"></i><span class="app-menu__label">productdetialsInputs</span></a></li>
            <li><a class="app-menu__item" href="{{route('admin.payments.index')}}"><i class="app-menu__icon fa fa-file-code-o"></i><span class="app-menu__label">عمليات الدفع</span></a></li>
            <li><a class="app-menu__item" href="{{route('admin.productuser.index')}}"><i class="app-menu__icon fa fa-file-code-o"></i><span class="app-menu__label">عمليات الدفع مستخدمين</span></a></li>
            <li><a class="app-menu__item" href="{{route('admin.reviewproducts.index')}}"><i class="app-menu__icon fa fa-file-code-o"></i><span class="app-menu__label">تقييمات المنتج من قبل المستخدمين</span></a></li>
            <li><a class="app-menu__item" href="{{route('admin.reviewsalers.index')}}"><i class="app-menu__icon fa fa-file-code-o"></i><span class="app-menu__label">تقييمات التاجر من قبل المستخدمين</span></a></li>
            <li><a class="app-menu__item" href="{{route('admin.colors.index')}}"><i class="app-menu__icon fa fa-file-code-o"></i><span class="app-menu__label"> اللون منتجات</span></a></li>
        </ul>
    </aside>
    <main class="app-content">
        @yield('content')
    </main>
    @include('sweetalert::alert')
    @include('layouts.footer')
    @stack('scripts')
    