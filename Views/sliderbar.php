
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-purple elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link navbar-white">
      <img src="Views/dist/img/logoFormunica.png" alt="Cootel" class="brand-image "
           style="opacity: .8">
      <span class="brand-text font-weight-light" >FORMUNICA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          
        </div>
        
        <div class="info">
          <a href="#" class="d-block" style="color: #003300;"><?php echo $_SESSION['Usuario']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active" style="background: rgb(0, 51, 0);">
              <i class="nav-icon fab fa-buromobelexperte"></i>
              <p>
                 FORMUNICA
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            
          </li>
        </ul>
        
        
      
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>