<aside class="sidebar" id="sidebar">
  <nav class="sidebar-nav">

    <a href="<?= date('YmdHis') ?>" class="nav-link" data-page="dashboard" data-description="Dashboard Overview">
      <i class="fa fa-tachometer"></i><span>Dashboard</span>
    </a>
    <a href="<?= date('YmdHis') ?>" class="nav-link" data-page="inbox" data-description="My Inbox">
      <i class="fa-regular fa-envelope"></i><span>Inbox</span>
    </a>
    <a href="<?= date('YmdHis') ?>" class="nav-link" data-page="participated" data-description="Participated Items">
      <i class="fa-regular fa-star"></i><span>Participated</span>
    </a>
    <a href="<?= date('YmdHis') ?>" class="nav-link" data-page="draft" data-description="Draft Items">
      <i class="fa-regular fa-file-lines"></i><span>Draft</span>
    </a>

    <div class="nav-sep"></div>

    <!-- ============ INVENTORY ============ -->
    <div class="nav-group" data-module="inventory">
      <button class="nav-link nav-parent" data-toggle>
        <i class="fa-solid fa-boxes-stacked"></i>
        <span>Inventory</span>
        <i class="fa-solid fa-chevron-down chev"></i>
      </button>
      <div class="nav-sub-wrap">
        <ul class="nav-sub">
          <li><a href="<?= date('YmdHis') ?>" class="nav-link" data-page="inventory/products" data-description="Manage Products">
            <i class="fa-solid fa-tags"></i><span>Products</span>
          </a></li>
          <li><a href="<?= date('YmdHis') ?>" class="nav-link" data-page="inventory/stock" data-description="Stock Levels">
            <i class="fa-solid fa-chart-simple"></i><span>Stock Levels</span>
          </a></li>
          <li><a href="<?= date('YmdHis') ?>" class="nav-link" data-page="inventory/warehouses" data-description="Manage Warehouses">
            <i class="fa-solid fa-warehouse"></i><span>Warehouses</span>
          </a></li>
        </ul>
      </div>
    </div>

    <!-- ============ SALES ============ -->
    <div class="nav-group" data-module="sales">
      <button class="nav-link nav-parent" data-toggle>
        <i class="fa-solid fa-cart-shopping"></i>
        <span>Sales</span>
        <i class="fa-solid fa-chevron-down chev"></i>
      </button>
      <div class="nav-sub-wrap">
        <ul class="nav-sub">
          <li><a href="<?= date('YmdHis') ?>" class="nav-link" data-page="sales/orders" data-description="Sales Orders">
            <i class="fa-solid fa-receipt"></i><span>Orders</span>
          </a></li>
          <li><a href="<?= date('YmdHis') ?>" class="nav-link" data-page="sales/invoices" data-description="Invoices">
            <i class="fa-solid fa-file-invoice-dollar"></i><span>Invoices</span>
          </a></li>
        </ul>
      </div>
    </div>

    <div class="nav-group" data-module="syssettings">
      <button class="nav-link nav-parent" data-toggle>
        <i class="fa-solid fa-gear"></i>
        <span>System Settings</span>
        <i class="fa-solid fa-chevron-down chev"></i>
      </button>
      <div class="nav-sub-wrap">
        <ul class="nav-sub">
          <li><a href="<?= date('YmdHis') ?>" class="nav-link" data-page="modulemenu" data-description="Modules and Menus">
            <i class="fa-solid fa-receipt"></i><span>Module and Menus</span>
          </a></li> 
          <li><a href="<?= date('YmdHis') ?>" class="nav-link" data-page="dynamicform" data-description="Dynamic Forms">
            <i class="fa-solid fa-sliders"></i><span>Dynamic Forms</span>
          </a></li> 
         
          <li><a href="<?= date('YmdHis') ?>" class="nav-link" data-page="modelpage" data-description="Sample Model Page">
            <i class="fa-solid fa-sliders"></i><span>Model Page</span>
          </a></li>          
        </ul>
      </div>
    </div>

    <div class="nav-group" data-module="appsettings">
      <button class="nav-link nav-parent" data-toggle>
        <i class="fa-solid fa-gear"></i>
        <span>App Settings</span>
        <i class="fa-solid fa-chevron-down chev"></i>
      </button>
      <div class="nav-sub-wrap">
        <ul class="nav-sub">
          <li><a href="<?= date('YmdHis') ?>" class="nav-link" data-page="rolemanagement" data-description="">
            <i class="fa-solid fa-receipt"></i><span>Roles Management</span>
          </a></li> 
         
        </ul>
      </div>
    </div>

    <!-- <div class="nav-sep"></div>

    <a href="" class="nav-link" data-page="settings" data-description="System Settings">
      <i class="fa-solid fa-gear"></i><span>Settings</span>
    </a> -->

  </nav>
</aside>