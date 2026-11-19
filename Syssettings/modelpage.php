<!-- ==========================================
     UNIFIED PAGE CONTAINER
     ========================================== -->
<div class="page-container">

    <!-- ANIMATED HERO HEADER (Flush with top) -->
    <div class="page-hero">
        <div class="hero-bg">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
        <div class="hero-content">
            <div class="hero-icon-wrap">
                <i class="fa-solid fa-gears"></i>
            </div>
            <div>
                <h1>System Settings</h1>
                <p>Configure modules, menus, and user roles</p>
            </div>
        </div>
    </div>

    <!-- INNER CONTENT (Has padding) -->
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

        <!-- ==========================================
         TAB 1: MODULE DEFINITION
         ========================================== -->
        <div class="tab-pane active" id="module-definition">

            <!-- TOOLBAR -->
            <div class="toolbar">
                <div class="toolbar-left">
                    <button class="btn btn-primary" id="btnAddSmall" data-modal-target="modalSmall">
                        <i class="fa-solid fa-plus"></i> Add Module
                    </button>
                    <button class="btn btn-outline" data-modal-target="modalLarge">
                        <i class="fa-solid fa-layer-group"></i> Bulk Add (Large Modal)
                    </button>
                </div>

                <div class="toolbar-right">
                    <div class="search-mini">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="Search by name, ID, type...">
                    </div>

                    <div class="export-group">
                        <button class="btn btn-outline btn-sm"><i class="fa-solid fa-file-excel"></i> Excel</button>
                        <button class="btn btn-outline btn-sm"><i class="fa-solid fa-file-pdf"></i> PDF</button>
                        <select class="form-select select-sm">
                            <option>Show: 25</option>
                            <option>Show: 50</option>
                            <option>Show: 100</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- DATA TABLE -->
            <div class="table-responsive border rounded">
                <table class="data-table table-hover">
                    <thead>
                        <tr>
                            <th width="50">S/N</th>
                            <th width="50">Icon</th>
                            <th>Module Name</th>
                            <th>Module Code</th>
                            <th>Description</th>
                            <th width="80">Status</th>
                            <th width="120" class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample Data -->
                        <tr>
                            <td>1</td>
                            <td><i class="fa-solid fa-user text-primary"></i></td>
                            <td class="fw-600">Onboarding</td>
                            <td><span class="badge-code">Onboarding</span></td>
                            <td class="text-muted">This is the onboarding part of the core banking</td>
                            <td><span class="badge badge-active">Active</span></td>
                            <td class="text-right">
                                <button class="btn-action btn-outline-primary" title="Edit"><i
                                        class="fa-solid fa-pen-to-square"></i></button>
                                <button class="btn-action btn-outline-danger" title="Delete"><i
                                        class="fa-solid fa-trash-can"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><i class="fa-solid fa-file-invoice-dollar text-primary"></i></td>
                            <td class="fw-600">Accounting</td>
                            <td><span class="badge-code">Accounting</span></td>
                            <td class="text-muted">Accounting module</td>
                            <td><span class="badge badge-active">Active</span></td>
                            <td class="text-right">
                                <button class="btn-action btn-outline-primary" title="Edit"><i
                                        class="fa-solid fa-pen-to-square"></i></button>
                                <button class="btn-action btn-outline-danger" title="Delete"><i
                                        class="fa-solid fa-trash-can"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <div class="pagination-wrap mt-3">
                <span class="text-muted" style="font-size:13px;">Showing 1-2 of 2 entries</span>
                <div class="pagination">
                    <button class="page-btn"><i class="fa-solid fa-chevron-left"></i></button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>

        </div> <!-- /#module-definition -->

        <!-- ==========================================
         TAB 2: MENU DEFINITION (Placeholder)
         ========================================== -->
        <div class="tab-pane" id="menu-definition">
            <div class="toolbar">
                <div class="toolbar-left">
                    <button class="btn btn-primary" data-modal-target="modalSmall">
                        <i class="fa-solid fa-plus"></i> Add Menu
                    </button>
                </div>
            </div>

            <div class="placeholder-box">
                <i class="fa-solid fa-bars-staggered"></i>
                <h3>Menu Definition</h3>
                <p>This is a placeholder for the second tab. Here you will list out dynamic menus, sub-menus, and map
                    them to modules.</p>
            </div>
        </div> <!-- /#menu-definition -->

    </div> <!-- /container-inner -->
</div> <!-- /page-container -->


<!-- ==========================================
     MODAL: SMALL
     ========================================== -->
<div class="modal-overlay" id="modalSmall">
    <div class="modal-box modal-sm">
        <div class="modal-header">
            <h3><i class="fa-solid fa-plus text-primary"></i> Add New Module</h3>
            <button class="modal-close" data-modal-close><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Module Name</label>
                <input type="text" class="form-control" placeholder="e.g. Human Resources">
            </div>
            <div class="form-group">
                <label>Module Code</label>
                <input type="text" class="form-control" placeholder="e.g. HR">
            </div>
            <div class="form-group">
                <label>Icon (FontAwesome Class)</label>
                <input type="text" class="form-control" placeholder="e.g. fa-solid fa-users">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" rows="3" placeholder="Brief description..."></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" data-modal-close>Cancel</button>
            <button class="btn btn-primary">Save Module</button>
        </div>
    </div>
</div>

<!-- ==========================================
     MODAL: LARGE
     ========================================== -->
<div class="modal-overlay" id="modalLarge">
    <div class="modal-box modal-lg">
        <div class="modal-header">
            <h3><i class="fa-solid fa-layer-group text-primary"></i> Bulk Add Modules</h3>
            <button class="modal-close" data-modal-close><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="modal-body">
            <div class="form-row">
                <div class="form-group col-6">
                    <label>Module Name</label>
                    <input type="text" class="form-control" placeholder="Module Name">
                </div>
                <div class="form-group col-6">
                    <label>Module Code</label>
                    <input type="text" class="form-control" placeholder="Code">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-4">
                    <label>Icon Class</label>
                    <input type="text" class="form-control" placeholder="fa-solid fa-box">
                </div>
                <div class="form-group col-4">
                    <label>Status</label>
                    <select class="form-control">
                        <option>Active</option>
                        <option>Inactive</option>
                    </select>
                </div>
                <div class="form-group col-4">
                    <label>Sort Order</label>
                    <input type="number" class="form-control" placeholder="1">
                </div>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" rows="2" placeholder="Optional description..."></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" data-modal-close>Cancel</button>
            <button class="btn btn-primary">Save Bulk Modules</button>
        </div>
    </div>
</div>