  <header class="main-header">
    <!-- Logo -->
    <a href="{{ aurl() }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

        @include('admin.layouts.menu')

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ url('/') }}/design/admin/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ admin()->user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>{{ trans('admin.dashbord')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ aurl() }}"><i class="fa fa-home"></i>{{ trans('admin.home')}}</a></li>
            <li><a href="{{ aurl('settings') }}"><i class="fa fa-tasks"></i>{{ trans('admin.settings')}}</a></li>
          </ul>
        </li>
        <li class="treeview {{ active_menu('admin')[0] }}">
          <a href="#">
            <i class="fa fa-user"></i> <span>{{ trans('admin.admin')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('admin')[2] }}">
            <li class="{{ active_menu('admin')[1] }}"><a href="{{ aurl('admin') }}"><i class="fa fa-circle-o"></i>{{ trans('admin.admin')}}</a></li>
          </ul>
        </li>
        <li class="treeview {{ active_menu('users')[0] }}">
          <a href="#">
            <i class="fa fa-users"></i> <span>{{ trans('admin.users')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('users')[2] }}">
            <li class="{{ active_menu('users')[1] }}"><a href="{{ aurl('users') }}"><i class="fa fa-users"></i>{{ trans('admin.users')}}</a></li>
            <li class="{{ active_smenu('user')[0] }}"><a href="{{ aurl('users') }}/?level=user"><i class="fa fa-user-o"></i>{{ trans('admin.user')}}</a></li>
            <li class="{{ active_smenu('vendor')[0] }}"><a href="{{ aurl('users') }}/?level=vendor"><i class="fa fa-user-o"></i>{{ trans('admin.vendor')}}</a></li>
            <li class="{{ active_smenu('company')[0] }}"><a href="{{ aurl('users') }}/?level=company"><i class="fa fa-user-o"></i>{{ trans('admin.company')}}</a></li>
          </ul>
        </li>
        <li class="treeview {{ active_menu('countries')[0] }}">
          <a href="#">
            <i class="fa fa-globe"></i> <span>{{ trans('admin.countries')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('countries')[2] }}">
            <li class="{{ active_menu('countries')[1] }}"><a href="{{ aurl('countries') }}"><i class="fa fa-circle-o"></i>{{ trans('admin.countries')}}</a></li>
            <li><a href="{{ aurl('countries/create') }}"><i class="fa fa-plus"></i>{{ trans('admin.add')}}</a></li>
          </ul>
        </li>
        <li class="treeview {{ active_menu('cities')[0] }}">
          <a href="#">
            <i class="fa fa-map-marker"></i> <span>{{ trans('admin.cities')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('cities')[2] }}">
            <li class="{{ active_menu('cities')[1] }}"><a href="{{ aurl('cities') }}"><i class="fa fa-circle-o"></i>{{ trans('admin.cities')}}</a></li>
            <li><a href="{{ aurl('cities/create') }}"><i class="fa fa-plus"></i>{{ trans('admin.add')}}</a></li>
          </ul>
        </li>
        <li class="treeview {{ active_menu('states')[0] }}">
          <a href="#">
            <i class="fa fa-map-marker"></i> <span>{{ trans('admin.states')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('states')[2] }}">
            <li class="{{ active_menu('states')[1] }}"><a href="{{ aurl('states') }}"><i class="fa fa-circle-o"></i>{{ trans('admin.states')}}</a></li>
            <li><a href="{{ aurl('states/create') }}"><i class="fa fa-plus"></i>{{ trans('admin.add')}}</a></li>
          </ul>
        </li>
        <li class="treeview {{ active_menu('categories')[0] }}">
          <a href="#">
            <i class="fa fa-th-large"></i> <span>{{ trans('admin.categories')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('categories')[2] }}">
            <li class="{{ active_menu('categories')[1] }}"><a href="{{ aurl('categories') }}"><i class="fa fa-circle-o"></i>{{ trans('admin.categories')}}</a></li>
            <li><a href="{{ aurl('categories/create') }}"><i class="fa fa-plus"></i>{{ trans('admin.add')}}</a></li>
          </ul>
        </li>
        <li class="treeview {{ active_menu('brands')[0] }}">
          <a href="#">
            <i class="fa fa-cube"></i> <span>{{ trans('admin.brands')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('brands')[2] }}">
            <li class="{{ active_menu('brands')[1] }}"><a href="{{ aurl('brands') }}"><i class="fa fa-circle-o"></i>{{ trans('admin.brands')}}</a></li>
            <li><a href="{{ aurl('brands/create') }}"><i class="fa fa-plus"></i>{{ trans('admin.add')}}</a></li>
          </ul>
        </li>
        <li class="treeview {{ active_menu('makers')[0] }}">
          <a href="#">
            <i class="fa fa-connectdevelop"></i> <span>{{ trans('admin.manufacturers')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('makers')[2] }}">
            <li class="{{ active_menu('makers')[1] }}"><a href="{{ aurl('makers') }}"><i class="fa fa-circle-o"></i>{{ trans('admin.makers')}}</a></li>
            <li><a href="{{ aurl('makers/create') }}"><i class="fa fa-plus"></i>{{ trans('admin.add')}}</a></li>
          </ul>
        </li>
        <li class="treeview {{ active_menu('shippings')[0] }}">
          <a href="#">
            <i class="fa fa-truck"></i> <span>{{ trans('admin.shippings')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('shippings')[2] }}">
            <li class="{{ active_menu('shippings')[1] }}"><a href="{{ aurl('shippings') }}"><i class="fa fa-circle-o"></i>{{ trans('admin.shippings')}}</a></li>
            <li><a href="{{ aurl('shippings/create') }}"><i class="fa fa-plus"></i>{{ trans('admin.add')}}</a></li>
          </ul>
        </li>
        <li class="treeview {{ active_menu('colors')[0] }}">
          <a href="#">
            <i class="fa fa-tint"></i> <span>{{ trans('admin.colors')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('colors')[2] }}">
            <li class="{{ active_menu('colors')[1] }}"><a href="{{ aurl('colors') }}"><i class="fa fa-circle-o"></i>{{ trans('admin.colors')}}</a></li>
            <li><a href="{{ aurl('colors/create') }}"><i class="fa fa-plus"></i>{{ trans('admin.add')}}</a></li>
          </ul>
        </li>
        <li class="treeview {{ active_menu('sizes')[0] }}">
          <a href="#">
            <i class="fa fa-arrows"></i> <span>{{ trans('admin.sizes')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('sizes')[2] }}">
            <li class="{{ active_menu('sizes')[1] }}"><a href="{{ aurl('sizes') }}"><i class="fa fa-circle-o"></i>{{ trans('admin.sizes')}}</a></li>
            <li><a href="{{ aurl('sizes/create') }}"><i class="fa fa-plus"></i>{{ trans('admin.add')}}</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
