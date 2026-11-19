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
            <div class="toolbar">
                <div class="toolbar-left">
                    <button class="btn btn-primary" id="btnAddModule">
                        <i class="fa-solid fa-plus"></i> Add Module
                    </button>
                </div>
            </div>

            <div class="table-responsive border rounded">
                <table class="data-table table-hover">
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
        </div>

        <!-- TAB 2: MENU DEFINITION -->
        <div class="tab-pane" id="menu-definition">
            <div class="placeholder-box">
                <i class="fa-solid fa-bars-staggered"></i>
                <h3>Menu Definition</h3>
                <p>Coming soon...</p>
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

<script>
$(document).ready(function() {
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
            data: JSON.stringify({ action: 'getmodules' }),
            dataType: 'json',
            success: function(res) {
                if (!res.ok) return;
                let html = '';
                if (res.data.length === 0) {
                    html = '<tr><td colspan="7" class="text-center text-muted">No modules found.</td></tr>';
                } else {
                    res.data.forEach((mod, index) => {
                        const statusBadge = mod.Status == 1 
                            ? '<span class="badge badge-active">Active</span>' 
                            : '<span class="badge badge-inactive">Inactive</span>';
                            
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
            data: JSON.stringify({ action: 'deletemodule', Id: id }),
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
});
</script>