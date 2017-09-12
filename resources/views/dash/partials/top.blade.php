<!-- ============================================================== -->
<!-- Topbar header - style you can find in pages.scss -->
<!-- ============================================================== -->
<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header">
        <div class="top-left-part">
            <!-- Logo -->
            <a class="logo" href="index.html">
                <!-- Logo icon image, you can use font-icon also --><b>
                    <!--This is dark logo icon--><img src="/admin/plugins/images/admin-logo.png" alt="home" class="dark-logo" /><!--This is light logo icon--><img src="/admin/plugins/images/admin-logo-dark.png" alt="home" class="light-logo" />
                </b>
                <!-- Logo text image you can use text also --><span class="hidden-xs">
                    <!--This is dark logo text-->
                    <img src="/admin/plugins/images/admin-text.png" alt="home" class="dark-logo" /><!--This is light logo text-->
                    <img src="/admin/plugins/images/admin-text-dark.png" alt="home" class="light-logo" />
                     </span> </a>
        </div>
        <!-- /Logo -->
        <ul class="nav navbar-top-links navbar-right pull-right">
            {{--<li>--}}
                {{--<form role="search" class="app-search hidden-sm hidden-xs m-r-10">--}}
                    {{--<input type="text" placeholder="Search..." class="form-control"> <a href=""><i class="fa fa-search"></i></a> </form>--}}
            {{--</li>--}}
            <li>
                <a class="profile-pic" href="#"> <img src="/admin/plugins/images/users/varun.jpg" alt="user-img" width="36" class="img-circle"><b class="hidden-xs">{{ \Illuminate\Support\Facades\Auth::user()->name }}</b></a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-header -->
    <!-- /.navbar-top-links -->
    <!-- /.navbar-static-side -->
</nav>