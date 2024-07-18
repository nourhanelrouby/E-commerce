<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <li>
                        <a href="{{ route('admin.dashboard') }}"><i class="ti-home"></i><span class="right-nav-text">HOME</span> </a>
                    </li>
                    <!-- category -->
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#mainCat-menu">
                                <div class="pull-left">
                                    <i class="ti-user"></i>
                                    <span class="right-nav-text">Categories</span>
                                </div>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="mainCat-menu" class="collapse" data-parent="#sidebarnav">
                                <li><a href="{{route('admin.category.index')}}">categories</a></li>
                            </ul>
                        </li>
                    <!-- products -->
                        <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#products">
                            <div class="pull-left">
                                <i class="ti-user"></i>
                                <span class="right-nav-text">Products</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="products" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('admin.product.index')}}">products</a></li>
                        </ul>
                    </li>

                    <!-- users -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#users">
                            <div class="pull-left">
                                <i class="ti-user"></i>
                                <span class="right-nav-text">Users</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="users" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('admin.users.index')}}">users</a></li>
                        </ul>
                    </li>

                    <!-- orders -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#orders">
                            <div class="pull-left">
                                <i class="ti-user"></i>
                                <span class="right-nav-text">Orders</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="orders" class="collapse" data-parent="#sidebarnav">
                            <li><a href="">orders</a></li>
                        </ul>
                    </li>

                    <!-- settings -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#settings">
                            <div class="pull-left">
                                <i class="ti-user"></i>
                                <span class="right-nav-text">Setting</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="settings" class="collapse" data-parent="#sidebarnav">
                            <li><a href="#">setting</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
