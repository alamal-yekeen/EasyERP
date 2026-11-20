<?php //require_once __DIR__ . '/../common/FormRenderer.php'; ?>

<div class="page-container">
  <!-- HERO HEADER -->
  <div class="page-hero">
    <div class="hero-bg">
      <div class="shape shape-1"></div>
      <div class="shape shape-2"></div>
    </div>
    <div class="hero-content">
      <div class="hero-icon-wrap"><i class="fa-solid fa-shield-halved"></i></div>
      <div>
        <h1>Role Management</h1>
        <p>Define system roles, map routes, and assign staff</p>
      </div>
    </div>
  </div>

  <div class="container-inner">
    <!-- TABS -->
    <div class="page-tabs">
      <button class="tab-btn active" data-tab-target="role-definition">
        <i class="fa-solid fa-user-tag"></i> Role Definition
      </button>
      <button class="tab-btn" data-tab-target="role-mapping">
        <i class="fa-solid fa-users-gear"></i> Role/User Mapping
      </button>
    </div>

    <!-- TAB 1: ROLE DEFINITION -->
    <div class="tab-pane active" id="role-definition">
      <div class="tab-description">
        <strong>Role Definition:</strong> Create roles and map them to specific system routes.
      </div>

      <div class="toolbar">
        <div class="toolbar-left">
          <button class="btn btn-primary" id="btnAddRole"><i class="fa-solid fa-plus"></i> Add Role</button>
        </div>
      </div>

      <div class="table-container">
        <div class="table-responsive border rounded">
          <table class="data-table" id="roleTable">
            <thead>
              <tr>
                <th>S/N</th>
                <th>Role Name</th>
                <th>Role Code</th>
                <th>Description</th>
                <th>Group Mail</th>
                <th class="text-right">Actions</th>
              </tr>
            </thead>
            <tbody id="roleTableBody">
              <tr><td colspan="6" class="text-center">Loading...</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- TAB 2: ROLE MAPPING -->
    <div class="tab-pane" id="role-mapping">
      <div class="tab-description">
        <strong>Role Mapping:</strong> Assign staff to roles. Click view to manage users.
      </div>

      <div class="table-container">
        <div class="table-responsive border rounded">
          <table class="data-table" id="mappingTable">
            <thead>
              <tr>
                <th>S/N</th>
                <th>Role Name</th>
                <th>Role Code</th>
                <th class="text-right">Actions</th>
              </tr>
            </thead>
            <tbody id="mappingTableBody">
              <tr><td colspan="4" class="text-center">Loading...</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- MODAL: ADD / EDIT ROLE -->
<div class="modal-overlay" id="modalRole">
  <form class="modal-box modal-md" id="roleForm">
      <div class="modal-header">
        <h3 id="modalRoleTitle"><i class="fa-solid fa-plus text-primary"></i> Add New Role</h3>
        <button type="button" class="modal-close" data-modal-close><i class="fa-solid fa-xmark"></i></button>
      </div>
      <div class="modal-body">
        <?= FormRenderer::render('role_definition') ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline" data-modal-close>Cancel</button>
        <button type="submit" class="btn btn-primary">Save Role</button>
      </div>
  </form>
</div>

<!-- MODAL: VIEW MAPPED ROUTES (Large) -->
<div class="modal-overlay" id="modalViewRoutes">
  <div class="modal-box modal-lg">
    <div class="modal-header">
      <h3><i class="fa-solid fa-route text-primary"></i> Routes for <span id="viewRoleName" class="text-primary"></span></h3>
      <button type="button" class="modal-close" data-modal-close><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body">
      <input type="hidden" id="viewRoleCode">
      <div class="toolbar" style="margin-bottom: 16px;">
        <div class="toolbar-left">
          <button class="btn btn-primary btn-sm" id="btnAddRouteToRole"><i class="fa-solid fa-plus"></i> Add Route</button>
        </div>
      </div>
      <div class="table-responsive border rounded">
        <table class="data-table">
          <thead>
            <tr>
              <th>Route Name</th>
              <th>Route Slug</th>
              <th>Module</th>
              <th class="text-right">Action</th>
            </tr>
          </thead>
          <tbody id="mappedRoutesBody"></tbody>
        </table>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-outline" data-modal-close>Close</button>
    </div>
  </div>
</div>

<!-- MODAL: ADD ROUTE TO ROLE (Small) -->
<div class="modal-overlay" id="modalAddRoute">
  <div class="modal-box modal-sm">
    <div class="modal-header">
      <h3><i class="fa-solid fa-plus text-primary"></i> Select Route</h3>
      <button type="button" class="modal-close" data-modal-close><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body">
      <div class="table-responsive border rounded" style="max-height: 300px; overflow-y: auto;">
        <table class="data-table">
          <thead>
            <tr><th>Route</th><th>Module</th><th class="text-right">Action</th></tr>
          </thead>
          <tbody id="availableRoutesBody"></tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- MODAL: VIEW MAPPED USERS (Large) -->
<div class="modal-overlay" id="modalViewUsers">
  <div class="modal-box modal-lg">
    <div class="modal-header">
      <h3><i class="fa-solid fa-users text-primary"></i> Users for <span id="userRoleName" class="text-primary"></span></h3>
      <button type="button" class="modal-close" data-modal-close><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body">
      <input type="hidden" id="userRoleCode">
      <div class="toolbar" style="margin-bottom: 16px;">
        <div class="toolbar-left">
          <button class="btn btn-primary btn-sm" id="btnAddStaffToRole"><i class="fa-solid fa-plus"></i> Add Staff</button>
        </div>
      </div>
      <div class="table-responsive border rounded">
        <table class="data-table">
          <thead>
            <tr>
              <th>Staff ID</th>
              <th>Staff Name</th>
              <th class="text-right">Action</th>
            </tr>
          </thead>
          <tbody id="mappedStaffBody"></tbody>
        </table>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-outline" data-modal-close>Close</button>
    </div>
  </div>
</div>

<!-- MODAL: ADD STAFF TO ROLE (Small) -->
<div class="modal-overlay" id="modalAddStaff">
  <div class="modal-box modal-sm">
    <div class="modal-header">
      <h3><i class="fa-solid fa-plus text-primary"></i> Select Staff</h3>
      <button type="button" class="modal-close" data-modal-close><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body">
      <div class="table-responsive border rounded" style="max-height: 300px; overflow-y: auto;">
        <table class="data-table">
          <thead>
            <tr><th>Staff ID</th><th>Name</th><th class="text-right">Action</th></tr>
          </thead>
          <tbody id="availableStaffBody"></tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
    // ==========================================
    // TAB 1: ROLE DEFINITION
    // ==========================================
    function loadRoles() {
        $.ajax({
            url: 'appsettingbk',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ action: 'getroles' }),
            success: function(res) {
              console.log(res);
                if (!res.ok) return;
                let html = '', mappingHtml = '';
                res.data.forEach((r, i) => {
                    html += `
                    <tr>
                        <td>${i+1}</td>
                        <td class="fw-600">${r.rolename}</td>
                        <td><span class="badge-code">${r.rolecode}</span></td>
                        <td class="text-muted text-truncate">${r.description || '-'}</td>
                        <td class="text-muted">${r.groupmail || '-'}</td>
                        <td class="text-right">
                            <button class="btn-action btn-outline-info view-routes-btn" data-code="${r.rolecode}" data-name="${r.rolename}" title="View Routes"><i class="fa-solid fa-route"></i></button>
                            <button class="btn-action btn-outline-primary edit-role-btn" data-id="${r.id}" data-name="${r.rolename}" data-code="${r.rolecode}" data-desc="${r.description}" data-mail="${r.groupmail}"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button class="btn-action btn-outline-danger delete-role-btn" data-id="${r.id}"><i class="fa-solid fa-trash-can"></i></button>
                        </td>
                    </tr>`;

                    mappingHtml += `
                    <tr>
                        <td>${i+1}</td>
                        <td class="fw-600">${r.rolename}</td>
                        <td><span class="badge-code">${r.rolecode}</span></td>
                        <td class="text-right">
                            <button class="btn-action btn-outline-info view-users-btn" data-code="${r.rolecode}" data-name="${r.rolename}" title="View Users"><i class="fa-solid fa-users"></i></button>
                        </td>
                    </tr>`;
                });
                $('#roleTableBody').html(html || '<tr><td colspan="6" class="text-center text-muted">No roles found.</td></tr>');
                $('#mappingTableBody').html(mappingHtml || '<tr><td colspan="4" class="text-center text-muted">No roles found.</td></tr>');
            }
        });
    }
    loadRoles();

    // Add/Edit Role
    $('#btnAddRole').on('click', function() {
        resetGenericForm('roleForm');
        $('#roleForm input[name="Id"]').val(0);
        $('#modalRoleTitle').html('<i class="fa-solid fa-plus text-primary"></i> Add New Role');
        $('#modalRole').addClass('active');
    });

    $(document).on('click', '.edit-role-btn', function() {
        resetGenericForm('roleForm');
        $('#roleForm input[name="Id"]').val($(this).data('id'));
        $('#roleForm input[name="rolename"]').val($(this).data('name'));
        $('#roleForm input[name="rolecode"]').val($(this).data('code'));
        $('#roleForm textarea[name="description"]').val($(this).data('desc'));
        $('#roleForm input[name="groupmail"]').val($(this).data('mail'));
        $('#modalRoleTitle').html('<i class="fa-solid fa-pen-to-square text-primary"></i> Edit Role');
        $('#modalRole').addClass('active');
    });

    $('#roleForm').on('submit', function(e) {
        e.preventDefault();
        genericSave('roleForm', 'appsettingbk', 'saverole', function() {
            loadRoles();
        });
    });

    $(document).on('click', '.delete-role-btn', function() {
        const id = $(this).data('id');
        Swal.fire({ title: 'Are you sure?', text: "Delete this role?", icon: 'warning', showCancelButton: true, confirmButtonColor: '#ef4444', confirmButtonText: 'Yes, delete it!' })
        .then((result) => {
            if (result.isConfirmed) {
                $.post('appsettingbk', JSON.stringify({ action: 'deleterole', Id: id }), function(res) {
                    if(res.ok) { successmessage(res.message); loadRoles(); }
                }, 'json');
            }
        });
    });

    // ==========================================
    // TAB 1: MANAGE ROUTES (Nested Modals)
    // ==========================================
    let currentRouteRoleCode = '';

    $(document).on('click', '.view-routes-btn', function() {
        currentRouteRoleCode = $(this).data('code');
        $('#viewRoleName').text($(this).data('name'));
        $('#viewRoleCode').val(currentRouteRoleCode);
        loadMappedRoutes(currentRouteRoleCode);
        $('#modalViewRoutes').addClass('active');
    });

    function loadMappedRoutes(rolecode) {
        $.post('appsettingbk', JSON.stringify({ action: 'getmappedroutes', rolecode: rolecode }), function(res) {
            if (!res.ok) return;
            let html = '';
            res.data.forEach(r => {
                html += `
                <tr>
                    <td class="fw-600">${r.MenuName || r.route}</td>
                    <td><span class="badge-code">${r.route}</span></td>
                    <td>${r.Module || '-'}</td>
                    <td class="text-right">
                        <button class="btn-action btn-outline-danger remove-route-btn" data-id="${r.id}"><i class="fa-solid fa-xmark"></i></button>
                    </td>
                </tr>`;
            });
            $('#mappedRoutesBody').html(html || '<tr><td colspan="4" class="text-center text-muted">No routes mapped.</td></tr>');
        }, 'json');
    }

    $(document).on('click', '.remove-route-btn', function() {
        const id = $(this).data('id');
        $.post('appsettingbk', JSON.stringify({ action: 'removeroutefromrole', id: id }), function(res) {
            if(res.ok) { loadMappedRoutes(currentRouteRoleCode); }
        }, 'json');
    });

    $('#btnAddRouteToRole').on('click', function() {
        $.post('appsettingbk', JSON.stringify({ action: 'getavailable_routes' }), function(res) {
            if (!res.ok) return;
            let html = '';
            res.data.forEach(r => {
                html += `
                <tr>
                    <td class="fw-600">${r.MenuName}</td>
                    <td>${r.Module}</td>
                    <td class="text-right">
                        <button class="btn-action btn-outline-primary add-single-route-btn" data-route="${r.Route}"><i class="fa-solid fa-plus"></i></button>
                    </td>
                </tr>`;
            });
            $('#availableRoutesBody').html(html);
            $('#modalAddRoute').addClass('active');
        }, 'json');
    });

    $(document).on('click', '.add-single-route-btn', function() {
        const route = $(this).data('route');
        $.post('appsettingbk', JSON.stringify({ action: 'addroutetorole', rolecode: currentRouteRoleCode, route: route }), function(res) {
            if(res.ok) {
                $('#modalAddRoute').removeClass('active');
                loadMappedRoutes(currentRouteRoleCode);
            }
        }, 'json');
    });

    // ==========================================
    // TAB 2: MANAGE USERS (Nested Modals)
    // ==========================================
    let currentUserRoleCode = '';

    $(document).on('click', '.view-users-btn', function() {
        currentUserRoleCode = $(this).data('code');
        $('#userRoleName').text($(this).data('name'));
        $('#userRoleCode').val(currentUserRoleCode);
        loadMappedStaff(currentUserRoleCode);
        $('#modalViewUsers').addClass('active');
    });

    function loadMappedStaff(rolecode) {
        $.post('appsettingbk', JSON.stringify({ action: 'getmappedstaff', rolecode: rolecode }), function(res) {
            if (!res.ok) return;
            let html = '';
            res.data.forEach(u => {
                html += `
                <tr>
                    <td><span class="badge-code">${u.staffid}</span></td>
                    <td class="fw-600">${u.full_name}</td>
                    <td class="text-right">
                        <button class="btn-action btn-outline-danger remove-staff-btn" data-id="${u.id}"><i class="fa-solid fa-xmark"></i></button>
                    </td>
                </tr>`;
            });
            $('#mappedStaffBody').html(html || '<tr><td colspan="3" class="text-center text-muted">No staff mapped.</td></tr>');
        }, 'json');
    }

    $(document).on('click', '.remove-staff-btn', function() {
        const id = $(this).data('id');
        $.post('appsettingbk', JSON.stringify({ action: 'removestafffromrole', id: id }), function(res) {
            if(res.ok) { loadMappedStaff(currentUserRoleCode); }
        }, 'json');
    });

    $('#btnAddStaffToRole').on('click', function() {
        $.post('appsettingbk', JSON.stringify({ action: 'getavailable_staff', rolecode: currentUserRoleCode }), function(res) {
            if (!res.ok) return;
            let html = '';
            res.data.forEach(u => {
                html += `
                <tr>
                    <td><span class="badge-code">${u.staffid}</span></td>
                    <td class="fw-600">${u.full_name}</td>
                    <td class="text-right">
                        <button class="btn-action btn-outline-primary add-single-staff-btn" data-staffid="${u.staffid}"><i class="fa-solid fa-plus"></i></button>
                    </td>
                </tr>`;
            });
            $('#availableStaffBody').html(html);
            $('#modalAddStaff').addClass('active');
        }, 'json');
    });

    $(document).on('click', '.add-single-staff-btn', function() {
        const staffid = $(this).data('staffid');
        $.post('appsettingbk', JSON.stringify({ action: 'addstafftorole', rolecode: currentUserRoleCode, staffid: staffid }), function(res) {
            if(res.ok) {
                $('#modalAddStaff').removeClass('active');
                loadMappedStaff(currentUserRoleCode);
            }
        }, 'json');
    });

});
</script>