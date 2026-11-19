<header class="topbar">
  <div class="topbar-left">
    <button class="icon-btn" id="sidebarToggle" title="Toggle sidebar">
      <i class="fa-solid fa-bars"></i>
    </button>
    <a href="dashboard" class="brand">ERP<span>Suite</span></a>
     <!-- Dynamic Page Description -->
    <div class="topbar-divider"></div>
    <span class="page-desc" id="pageDescription">Dashboard Overview</span>
  </div>

  <div class="topbar-center">
    <div class="search-wrap">
      <i class="fa-solid fa-magnifying-glass"></i>
      <input type="search" placeholder="Search anything…" id="globalSearch">
    </div>
  </div>

  <div class="topbar-right">

    <!-- Two-line live clock -->
    <div class="clock" id="liveClock" title="Current date and time">
      <i class="fa-regular fa-clock clock-ico"></i>
      <div class="clock-text">
        <div class="clock-date" id="clockDate">—</div>
        <div class="clock-time" id="clockTime">—</div>
      </div>
    </div>

    <div class="dropdown" data-dd="notif">
      <button class="icon-btn" data-dd-toggle aria-label="Notifications">
        <i class="fa-regular fa-bell"></i>
        <span class="badge-dot"></span>
      </button>
      <div class="dropdown-menu dd-notif" data-dd-menu>
        <div class="dd-head">Notifications <a href="#inbox" class="dd-link">View all</a></div>
        <ul class="notif-list">
          <li><i class="fa-solid fa-circle-check text-success"></i> Invoice #INV-1024 paid</li>
          <li><i class="fa-solid fa-triangle-exclamation text-warn"></i> 3 products below reorder level</li>
          <li><i class="fa-solid fa-user-plus text-info"></i> New customer registered</li>
          <li><i class="fa-solid fa-box-open text-muted"></i> PO #PO-208 awaiting approval</li>
        </ul>
      </div>
    </div>

    <button class="icon-btn" id="themeToggle" title="Toggle theme">
      <i class="fa-solid fa-moon theme-icon-dark"></i>
      <i class="fa-solid fa-sun theme-icon-light"></i>
    </button>

    <div class="dropdown" data-dd="user">
      <button class="user-chip" data-dd-toggle>
        <img src="" alt="Avartar" class="avatar">
        <span class="user-name"><?= htmlspecialchars($userName ?? 'Admin') ?></span>
        <i class="fa-solid fa-chevron-down chev"></i>
      </button>
      <div class="dropdown-menu dd-user" data-dd-menu>
        <a href="#profile"><i class="fa-regular fa-user"></i> Profile</a>
        <a href="#settings"><i class="fa-solid fa-gear"></i> Settings</a>
        <div class="dd-sep"></div>
        <a href="logout" class="dd-danger"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
      </div>
    </div>

  </div>
</header>