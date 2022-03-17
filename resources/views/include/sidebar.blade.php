<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{ asset('public/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-bold">TRB Mall</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('public/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <li class="nav-item">
            <a href="{{ route('dashboard')}}" class="nav-link">
              <i class="fas fa-columns nav-icon"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="{{ route('accounts')}}" class="nav-link">
              <i class="fas fa-users nav-icon"></i>
              <p>Accounts</p>
            </a>
          </li> -->
		  <li class="nav-item">
            <a href="{{ route('products')}}" class="nav-link">
              <i class="fas fa-shopping-bag nav-icon"></i>
              <p>Products</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('orders')}}" class="nav-link">
              <i class="fas fa-cart-arrow-down fa-fw"></i>
              <p>orders</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('orders_transaction')}}" class="nav-link">
              <i class="fas fa-cart-arrow-down fa-fw"></i>
              <p>Transaction</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('promo')}}" class="nav-link">
              <i class="fas fa-money-check-alt nav-icon"></i>
              <p>Promo</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-sitemap nav-icon"></i>
                <p>
                    Categories
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('category')}}" class="nav-link">
                        <i class="fas fa-list-alt"></i>
                        <p>Category</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('subcategory')}}" class="nav-link">
                        <i class="far fa-list-alt"></i>
                        <p>Sub-Category</p>
                    </a>
                </li>
            </ul>
        </li>
            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
