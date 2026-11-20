<div class="page-container">
    <!-- HERO HEADER -->
    <div class="page-hero">
        <div class="hero-bg">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
        <div class="hero-content">
            <div class="hero-icon-wrap"><i class="fa-solid fa-gears"></i></div>
            <div>
                <h1>System Settings</h1>
                <p>Configure modules, menus, and user roles</p>
            </div>
        </div>
    </div>

    <div class="container-inner">
        <!-- TABS -->
        <div class="page-tabs">
            <button class="tab-btn active" data-tab-target="module-definition">
                <i class="fa-solid fa-puzzle-piece"></i> Module Definition
            </button>
            <button class="tab-btn" data-tab-target="menu-definition">
                <i class="fa-solid fa-bars-staggered"></i> Menu Definition
            </button>
        </div>



        <!-- TAB 1: MODULE DEFINITION -->
        <div class="tab-pane active" id="module-definition">
            <div class="tab-description">
                <strong>Module Definition:</strong> This table manages the core modules of the ERP system. You can add,
                edit, or delete modules (e.g., Inventory, HR, Accounting). The <em>Module Code</em> created here will be
                used to link routes and sidebar menus.
            </div>

            <div class="toolbar">
                <div class="toolbar-left">
                    <button class="btn btn-primary" id="btnAddModule">
                        <i class="fa-solid fa-plus"></i> Add Module
                    </button>
                </div>
            </div>


            <div class="table-container">
                <!-- Toolbar -->
                <div class="table-toolbar">
                    <div class="table-search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" id="moduleTable_search" placeholder="Search modules...">
                    </div>
                    <div class="table-controls">
                        <select class="table-page-length" id="moduleTable_length">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <button class="btn btn-outline btn-sm"
                            onclick="exportTableToCSV('moduleTable', 'modules_export.csv')"><i
                                class="fa-solid fa-file-excel"></i> Export</button>
                    </div>
                </div>

                <div class="table-responsive border rounded">
                    <table class="data-table table-hover" id="moduleTable">
                        <thead>
                            <tr>
                                <th width="50">S/N</th>
                                <th width="60">Icon</th>
                                <th>Module Name</th>
                                <th>Module Code</th>
                                <th>Description</th>
                                <th width="80">Status</th>
                                <th width="120" class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="moduleTableBody">
                            <tr>
                                <td colspan="7" class="text-center">Loading modules...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="table-pagination">
                    <span class="table-info" id="moduleTable_info">Showing 0 entries</span>
                    <div class="page-buttons" id="moduleTable_pagination"></div>
                </div>
            </div>
        </div>

        <!-- TAB 2: MENU DEFINITION -->
        <!-- <div class="tab-pane" id="menu-definition">
            <div class="placeholder-box">
                <i class="fa-solid fa-bars-staggered"></i>
                <h3>Menu Definition</h3>
                <p>Coming soon...</p>
            </div>
        </div> -->
        <!-- TAB 2: ROUTE DEFINITION -->
        <div class="tab-pane" id="menu-definition">
            <!-- Description Header -->
            <div class="tab-description">
                <strong>Route Definition:</strong> Map system routes to pages and modules. Routes defined here control
                the AJAX navigation and the sidebar menu. Select a <em>Module Code</em> to group this route under a
                specific module.
            </div>
            <div class="toolbar">
                <div class="toolbar-left">
                    <button class="btn btn-primary" id="btnAddRoute">
                        <i class="fa-solid fa-plus"></i> Add Route
                    </button>
                </div>
            </div>
            <div class="table-container">
                <div class="table-toolbar">
                    <div class="table-search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" id="routeTable_search" placeholder="Search modules...">
                    </div>
                    <div class="table-controls">
                        <select class="table-page-length" id="routeTable_length">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <button class="btn btn-outline btn-sm"
                            onclick="exportTableToCSV('routeTable', 'routes_export.csv')"><i
                                class="fa-solid fa-file-excel"></i> Export</button>
                    </div>
                </div>

                <div class="table-responsive border rounded">
                    <table class="data-table table-hover" id="routeTable">
                        <thead>
                            <tr>
                                <th class="sortable">S/N</th>
                                <th class="sortable">Menu Name</th>
                                <th>Menu Description</th>
                                <th class="sortable">Module Code</th>
                                <th>Route</th>
                                <th>Page</th>
                                <th>Type</th>
                                <th>Icon</th>
                                <th>Sidebar</th>
                                <th>Status</th>
                                <th style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="routeTableBody">
                            <tr>
                                <td colspan="11" class="text-center">Loading routes...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-pagination">
                    <span class="table-info" id="routeTable_info">Showing 0 entries</span>
                    <div class="page-buttons" id="routeTable_pagination"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL: ADD / EDIT MODULE -->
<!-- MODAL: ADD / EDIT MODULE -->
<div class="modal-overlay" id="modalModule">
    <div class="modal-box modal-sm">
        <form id="moduleForm" class="modal-box modal-sm">


            <div class="modal-header">
                <h3 id="modalTitle"><i class="fa-solid fa-plus text-primary"></i> Add New Module</h3>
                <button type="button" class="modal-close" data-modal-close><i class="fa-solid fa-xmark"></i></button>
            </div>

            <div class="modal-body">

                <?= FormRenderer::render('moduledev') ?>


            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline" data-modal-close>Cancel</button>
                <button type="submit" class="btn btn-primary" id="btnSaveModule">Save Module</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL: ADD / EDIT ROUTE -->
<div class="modal-overlay" id="modalRoute">
    <form class="modal-box modal-md" id="routeForm">
        <div class="modal-header">
            <h3 id="modalRouteTitle"><i class="fa-solid fa-plus text-primary"></i> Add New Route</h3>
            <button type="button" class="modal-close" data-modal-close><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="modal-body">
            <?= FormRenderer::render('route_definition') ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline" data-modal-close>Cancel</button>
            <button type="submit" class="btn btn-primary" id="btnSaveRoute">Save Route</button>
        </div>
    </form>
</div>

<script>
$(document).ready(function() {
    // 1. Initialize the Table Controller
    const moduleTable = new TableController('moduleTable');

    // 1. Initialize Route Table
    const routeTable = new TableController('routeTable');
    // Store the validator instance for the module form
    let moduleValidator = null;

    // ==========================================
    // 1. Fetch Modules
    // ==========================================
    function loadModules() {
        $.ajax({
            url: 'syssettingbk', // Updated to your new route
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                action: 'getmodules'
            }),
            dataType: 'json',
            success: function(res) {
                if (!res.ok) return;
                let html = '';
                if (res.data.length === 0) {
                    html =
                        '<tr><td colspan="7" class="text-center text-muted">No modules found.</td></tr>';
                } else {
                    res.data.forEach((mod, index) => {
                        const statusBadge = mod.Status == 1 ?
                            '<span class="badge badge-active">Active</span>' :
                            '<span class="badge badge-inactive">Inactive</span>';

                        html += `
                        <tr>
                            <td>${index + 1}</td>
                            <td><i class="${mod.Icon || 'fa-solid fa-box'} text-primary" style="font-size:16px;"></i></td>
                            <td class="fw-600">${mod.ModuleName}</td>
                            <td><span class="badge-code">${mod.ModuleCode}</span></td>
                            <td class="text-muted">${mod.Description || '-'}</td>
                            <td>${statusBadge}</td>
                            <td class="text-right">
                                <button class="btn-action btn-outline-primary edit-btn" 
                                    data-id="${mod.Id}" 
                                    data-name="${mod.ModuleName}" 
                                    data-code="${mod.ModuleCode}" 
                                    data-icon="${mod.Icon || ''}" 
                                    data-desc="${mod.Description || ''}"
                                    data-status="${mod.Status}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button class="btn-action btn-outline-danger delete-btn" data-id="${mod.Id}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </td>
                        </tr>`;
                    });

                }
                $('#moduleTableBody').html(html);
                moduleTable.setData(html); // ADD THIS
            }
        });
    }

    loadModules();

    // ==========================================
    // 2. Open Modal for Add
    // ==========================================
    $('#btnAddModule').on('click', function() {
        const form = document.getElementById('moduleForm');
        form.reset();
        $('#moduleId').val(0);

        // Initialize validator (clears old errors)
        if (moduleValidator) moduleValidator.destroy();
        moduleValidator = formValidator('moduleForm');

        $('#modalTitle').html('<i class="fa-solid fa-plus text-primary"></i> Add New Module');
        $('#modalModule').addClass('active');
    });

    // ==========================================
    // 3. Open Modal for Edit
    // ==========================================
    $(document).off('click', '.edit-btn').on('click', '.edit-btn', function() {
        resetGenericForm('moduleForm');

        // Populate the dynamic inputs using their 'name' attributes
        $('#moduleForm input[name="Id"]').val($(this).data('id'));
        $('#moduleForm input[name="ModuleName"]').val($(this).data('name'));
        $('#moduleForm input[name="ModuleCode"]').val($(this).data('code'));
        $('#moduleForm input[name="Icon"]').val($(this).data('icon'));
        $('#moduleForm textarea[name="Description"]').val($(this).data('desc'));
        $('#moduleForm select[name="Status"]').val($(this).data('status'));

        $('#modalTitle').html('<i class="fa-solid fa-pen-to-square text-primary"></i> Edit Module');
        $('#modalModule').addClass('active');
    });

    // ==========================================
    // 4. Submit Form (With Validation & Sweetalert)
    // ==========================================
    $('#moduleForm').on('submit', function(e) {
        e.preventDefault();

        // Pass 'loadModules' as the 4th parameter!
        genericSave('moduleForm', 'syssettingbk', 'savemodule', function() {
            loadModules(); // This runs ONLY if the save is successful
        });
    });

    // ==========================================
    // 5. Delete Module (With Sweetalert)
    // ==========================================
    $(document).off('click', '.delete-btn').on('click', '.delete-btn', function() {
        const id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444', // Danger color
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                executeDelete(id);
            }
        });
    });

    function executeDelete(id) {
        $.ajax({
            url: 'syssettingbk',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                action: 'deletemodule',
                Id: id
            }),
            dataType: 'json',
            success: function(res) {
                if (res.ok) {
                    successmessage(res.message);
                    loadModules();
                } else {
                    errormessage(res.error);
                }
            },
            error: function() {
                errormessage('Failed to delete module due to server error.');
            }
        });
    }


    // ==========================================
    // ROUTE DEFINITION LOGIC
    // ==========================================

    // 1. Load Routes
    function loadRoutes() {
        $.ajax({
            url: 'syssettingbk',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                action: 'getroutes'
            }),
            dataType: 'json',
            success: function(res) {
                if (!res.ok) return;
                let html = '';
                if (res.data.length === 0) {
                    html =
                        '<tr><td colspan="11" class="text-center text-muted">No routes found.</td></tr>';
                } else {
                    res.data.forEach((r, index) => {
                        // Format Status
                        const statusBadge = r.Status == 1 ?
                            '<span class="badge badge-active">Active</span>' :
                            '<span class="badge badge-inactive">Inactive</span>';

                        // Format Type (0 = Backend, 1 = Frontend)
                        const typeBadge = r.Type == 1 ?
                            '<span class="badge" style="background:#e0f2fe; color:#0369a1;">Frontend</span>' :
                            '<span class="badge" style="background:#fef3c7; color:#b45309;">Backend</span>';

                        // Format Sidebar (1 = Yes, 0 = No)
                        const sidebarBadge = r.SideMenu == 1 ?
                            '<i class="fa-solid fa-check text-success"></i>' :
                            '<i class="fa-solid fa-xmark text-muted"></i>';

                        // Format Icon
                        const iconHtml = r.Icon ?
                            `<i class="${r.Icon} text-primary"></i>` :
                            '-';

                        html += `
                        <tr>
                            <td>${index + 1}</td>
                            <td class="fw-600">${r.MenuName}</td>
                            <td class="text-muted text-truncate" style="max-width: 200px;">${r.MenuDescription || '-'}</td>
                            <td><span class="badge-code">${r.Module}</span></td>
                            <td>${r.Route}</td>
                            <td class="text-muted">${r.Page}</td>
                            <td>${typeBadge}</td>
                            <td style="font-size: 16px;">${iconHtml}</td>
                            <td>${sidebarBadge}</td>
                            <td>${statusBadge}</td>
                            <td class="text-right">
                                <button class="btn-action btn-outline-primary edit-route-btn" 
                                    data-id="${r.Id}" 
                                    data-name="${r.MenuName}" 
                                    data-route="${r.Route}" 
                                    data-page="${r.Page}" 
                                    data-module="${r.Module}"
                                    data-icon="${r.Icon || ''}"
                                    data-type="${r.Type}"
                                    data-sidemenu="${r.SideMenu}"
                                    data-desc="${r.MenuDescription || ''}"
                                    data-status="${r.Status}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button class="btn-action btn-outline-danger delete-route-btn" data-id="${r.Id}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </td>
                        </tr>`;
                    });

                }
                $('#routeTableBody').html(html);
                routeTable.setData(html);
            }
        });
    }
    loadRoutes(); // Load on page init

    // 2. Fetch Modules for the Dropdown
    function populateModuleDropdown(selectedCode = '') {
        $.ajax({
            url: 'syssettingbk',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                action: 'getmodules'
            }),
            dataType: 'json',
            success: function(res) {
                if (res.ok && res.data.length > 0) {
                    const $select = $('#routeForm select[name="Module"]');
                    $select.empty().append('<option value="">Select Module...</option>');

                    res.data.forEach(mod => {
                        const isSelected = (mod.ModuleCode === selectedCode) ?
                            'selected' :
                            '';
                        $select.append(
                            `<option value="${mod.ModuleCode}" ${isSelected}>${mod.ModuleName} (${mod.ModuleCode})</option>`
                        );
                    });
                }
            }
        });
    }

    // 3. Open Modal for Add Route
    $('#btnAddRoute').on('click', function() {
        resetGenericForm('routeForm');
        $('#routeForm input[name="Id"]').val(0);
        $('#modalRouteTitle').html('<i class="fa-solid fa-plus text-primary"></i> Add New Route');

        populateModuleDropdown(); // Fetch fresh modules
        $('#modalRoute').addClass('active');
    });

    // 4. Open Modal for Edit Route
    $(document).off('click', '.edit-route-btn').on('click', '.edit-route-btn', function() {
        resetGenericForm('routeForm');

        const moduleCode = $(this).data('module');

        $('#routeForm input[name="Id"]').val($(this).data('id'));
        $('#routeForm input[name="MenuName"]').val($(this).data('name'));
        $('#routeForm input[name="Route"]').val($(this).data('route'));
        $('#routeForm input[name="Page"]').val($(this).data('page'));
        $('#routeForm input[name="Icon"]').val($(this).data('icon'));
        $('#routeForm textarea[name="MenuDescription"]').val($(this).data('desc'));
        $('#routeForm select[name="Type"]').val($(this).data('type'));
        $('#routeForm select[name="SideMenu"]').val($(this).data('sidemenu'));
        $('#routeForm select[name="Status"]').val($(this).data('status'));

        populateModuleDropdown(moduleCode); // Fetch and select the module

        $('#modalRouteTitle').html(
            '<i class="fa-solid fa-pen-to-square text-primary"></i> Edit Route');
        $('#modalRoute').addClass('active');
    });

    // 5. Submit Route Form
    $('#routeForm').on('submit', function(e) {
        e.preventDefault();
        genericSave('routeForm', 'syssettingbk', 'saveroute', function() {
            loadRoutes(); // Refresh the route table
        });
    });

    // 6. Delete Route
    $(document).off('click', '.delete-route-btn').on('click', '.delete-route-btn', function() {
        const id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'syssettingbk',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        action: 'deleteroute',
                        Id: id
                    }),
                    dataType: 'json',
                    success: function(res) {
                        if (res.ok) {
                            successmessage(res.message);
                            loadRoutes(); // Refresh table
                            // Rebuild route cache
                            $.post('syssettingbk', {
                                action: 'rebuildroutes'
                            });
                        } else {
                            errormessage(res.error);
                        }
                    }
                });
            }
        });
    });
});
</script>