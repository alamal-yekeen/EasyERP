<div class="page-container">
    <!-- HERO HEADER -->
    <div class="page-hero">
        <div class="hero-bg">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
        <div class="hero-content">
            <div class="hero-icon-wrap"><i class="fa-solid fa-file-lines"></i></div>
            <div>
                <h1>Dynamic Form Setup</h1>
                <p>Create and manage dynamic forms using JSON configuration</p>
            </div>
        </div>
    </div>

    <div class="container-inner">
        <div class="toolbar">
            <div class="toolbar-left">
                <button class="btn btn-primary" id="btnAddForm">
                    <i class="fa-solid fa-plus"></i> Create New Form
                </button>
            </div>
        </div>
        <div class="table-container">
            <div class="table-toolbar">
                <div class="table-search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="dynamicFormTB_search" placeholder="Search modules...">
                </div>
                <div class="table-controls">
                    <select class="table-page-length" id="dynamicFormTB_length">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <button class="btn btn-outline btn-sm"
                        onclick="exportTableToCSV('dynamicFormTB', 'dynamicForm_export.csv')"><i
                            class="fa-solid fa-file-excel"></i> Export</button>
                </div>
            </div>

            <div class="table-responsive border rounded">
                <table class="data-table table-hover" id="dynamicFormTB">
                    <thead>
                        <tr>
                            <th width="50">S/N</th>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th width="150" class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="formTableBody">
                        <tr>
                            <td colspan="5" class="text-center">Loading forms...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-pagination">
                <span class="table-info" id="dynamicFormTB_info">Showing 0 entries</span>
                <div class="page-buttons" id="dynamicFormTB_pagination"></div>
            </div>
        </div>
    </div>

    <!-- MODAL: ADD / EDIT FORM (With Live Preview) -->
    <div class="modal-overlay" id="modalFormSetup">
        <div class="modal-box modal-lg">
            <!-- Using large modal for the split view -->
            <form id="formSetupForm">
                <input type="hidden" name="Id" id="formSetupId" value="0">

                <div class="modal-header">
                    <h3 id="formSetupTitle"><i class="fa-solid fa-plus text-primary"></i> Create New Form</h3>
                    <button type="button" class="modal-close" data-modal-close><i
                            class="fa-solid fa-xmark"></i></button>
                </div>

                <div class="modal-body">
                    <div class="split-view">
                        <!-- LEFT SIDE: Inputs -->
                        <div class="split-left p-4 border-end">
                            <div class="form-group input-group">
                                <label>Form Name (Unique)</label>
                                <input type="text" class="form-control" name="name" id="f_name"
                                    data-val="required|alphanumeric|maxlen:100" placeholder="e.g. user_registration">
                                <div class="error-msg"></div>
                            </div>

                            <div class="form-group input-group">
                                <label>Form Title</label>
                                <input type="text" class="form-control" name="title" id="f_title"
                                    data-val="required|maxlen:255" placeholder="e.g. User Registration">
                                <div class="error-msg"></div>
                            </div>

                            <div class="form-group input-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" id="f_desc" rows="2"
                                    data-val="maxlen:500"></textarea>
                                <div class="error-msg"></div>
                            </div>

                            <div class="form-group input-group">
                                <label>Form Details (JSON)</label>
                                <textarea class="form-control font-monospace" name="details" id="f_json" rows="15"
                                    data-val="required" placeholder='{"table": "users", "fields": [...]}'></textarea>
                                <div class="error-msg"></div>
                            </div>
                        </div>

                        <!-- RIGHT SIDE: Live Preview -->
                        <div class="split-right p-4 bg-light">
                            <h4 class="mb-3 text-muted"
                                style="font-size: 14px; text-transform: uppercase; letter-spacing: 1px;">
                                <i class="fa-solid fa-eye"></i> Live Preview
                            </h4>
                            <div id="livePreviewContainer" class="preview-box">
                                <div class="text-center text-muted py-5">
                                    <i class="fa-solid fa-code fa-2x mb-3 opacity-50"></i>
                                    <p>Paste valid JSON to see the form preview.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" data-modal-close>Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btnSaveForm">Save Form</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Change modal-box to include modal-md -->
    <div class="modal-overlay" id="modalViewForm">
        <div class="modal-box modal-md">
            <!-- Added modal-md here -->
            <div class="modal-header">
                <h3><i class="fa-solid fa-eye text-primary"></i> View Form</h3>
                <button type="button" class="modal-close" data-modal-close><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body" id="viewFormBody">
                <!-- Content injected via JS -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" data-modal-close>Close</button>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
       const dynamicFormTB = new TableController('dynamicFormTB');
        // 1. Load Forms
        function loadForms() {
            $.ajax({
                url: 'syssettingbk',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    action: 'getforms'
                }),
                dataType: 'json',
                success: function(res) {
                    if (!res.ok) return;
                    let html = '';
                    if (res.data.length === 0) {
                        html =
                            '<tr><td colspan="5" class="text-center text-muted">No forms found.</td></tr>';
                    } else {
                        res.data.forEach((f, index) => {
                            html += `
                        <tr>
                            <td>${index + 1}</td>
                            <td class="fw-600">${f.name}</td>
                            <td>${f.title}</td>
                            <td class="text-muted text-truncate" style="max-width: 250px;">${f.description || '-'}</td>
                            <td class="text-right">
                                <button class="btn-action btn-outline-primary view-btn" data-id="${f.id}" title="View"><i class="fa-solid fa-eye"></i></button>
                                <button class="btn-action btn-outline-primary edit-btn" data-id="${f.id}" title="Edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                <button class="btn-action btn-outline-danger delete-btn" data-id="${f.id}" title="Delete"><i class="fa-solid fa-trash-can"></i></button>
                            </td>
                        </tr>`;
                        });
                    }
                    $('#formTableBody').html(html);
                    dynamicFormTB.setData(html);
                }
            });
        }
        loadForms();

        // 2. Live Preview Logic (JS version of PHP FormRenderer)
        function renderPreview(jsonString) {
            const $container = $('#livePreviewContainer');
            if (!jsonString.trim()) {
                $container.html('<div class="text-center text-muted py-5">Empty JSON</div>');
                return;
            }

            try {
                const config = JSON.parse(jsonString);
                if (!config.fields || !Array.isArray(config.fields)) {
                    throw new Error("Missing 'fields' array.");
                }

                let html = '<div class="form-row">';
                config.fields.forEach(field => {
                    const col = field.col || 12;
                    const name = field.name || 'unnamed';
                    const id = field.id || name;
                    const type = field.type || 'text';
                    const label = field.label || name;
                    const val = field.val || '';
                    const placeholder = field.placeholder || '';
                    const required = val.includes('required') ? 'required' : '';

                    html += `<div class="form-group col-${col} input-group" id="preview_group_${id}">`;
                    html +=
                        `<label>${label} ${required ? '<span class="text-danger">*</span>' : ''}</label>`;

                    if (type === 'select') {
                        html += `<select class="form-control" disabled>`;
                        html += `<option value="">Select...</option>`;
                        (field.options || []).forEach(opt => {
                            html += `<option value="${opt.value}">${opt.label}</option>`;
                        });
                        html += `</select>`;
                    } else if (type === 'textarea') {
                        html +=
                            `<textarea class="form-control" disabled placeholder="${placeholder}"></textarea>`;
                    } else {
                        html +=
                            `<input type="${type}" class="form-control" disabled placeholder="${placeholder}">`;
                    }
                    html += `</div>`; // end form-group
                });
                html += '</div>'; // end form-row

                $container.html(html);
            } catch (e) {
                $container.html(`
                <div class="alert alert-danger m-3">
                    <i class="fa-solid fa-triangle-exclamation"></i> Invalid JSON: <br>
                    <small>${e.message}</small>
                </div>
            `);
            }
        }

        // Bind live preview to textarea input
        let previewTimeout;
        $('#f_json').on('input', function() {
            clearTimeout(previewTimeout);
            const val = $(this).val();
            previewTimeout = setTimeout(() => renderPreview(val), 300); // 300ms debounce
        });

        // 3. Open Modal for Add
        $('#btnAddForm').on('click', function() {
            resetGenericForm('formSetupForm');
            $('#formSetupId').val(0);
            $('#formSetupTitle').html('<i class="fa-solid fa-plus text-primary"></i> Create New Form');
            $('#livePreviewContainer').html(
                '<div class="text-center text-muted py-5">Paste valid JSON to see the form preview.</div>'
            );
            $('#modalFormSetup').addClass('active');
        });

        // 4. Open Modal for Edit
        $(document).off('click', '.edit-btn').on('click', '.edit-btn', function() {
            const id = $(this).data('id');
            resetGenericForm('formSetupForm');
            $('#formSetupId').val(id);
            $('#formSetupTitle').html(
                '<i class="fa-solid fa-pen-to-square text-primary"></i> Edit Form');

            // Fetch the specific form data
            $.ajax({
                url: 'syssettingbk',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    action: 'getformbyid',
                    id: id
                }),
                dataType: 'json',
                success: function(res) {
                    if (res.ok) {
                        const f = res.data;
                        $('#f_name').val(f.name);
                        $('#f_title').val(f.title);
                        $('#f_desc').val(f.description);

                        // Pretty print the JSON
                        const jsonStr = typeof f.details === 'string' ? f.details : JSON
                            .stringify(f.details, null, 4);
                        $('#f_json').val(jsonStr);

                        renderPreview(jsonStr);
                        $('#modalFormSetup').addClass('active');
                    } else {
                        errormessage(res.error);
                    }
                }
            });
        });

        // 5. Open Modal for View
        $(document).off('click', '.view-btn').on('click', '.view-btn', function() {
            const id = $(this).data('id');

            $.ajax({
                url: 'syssettingbk',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    action: 'getformbyid',
                    id: id
                }),
                dataType: 'json',
                success: function(res) {
                    if (res.ok) {
                        const f = res.data;
                        let html = `
                        <div class="mb-4">
                            <h5 class="fw-bold mb-1">${f.title}</h5>
                            <p class="text-muted mb-0">${f.description || 'No description provided.'}</p>
                            <span class="badge-code mt-2 d-inline-block">${f.name}</span>
                        </div>
                        <hr>
                        <h6 class="text-uppercase text-muted mb-3" style="font-size: 12px; letter-spacing: 1px;">Form Preview</h6>
                    `;
                        // Let's render the actual form inputs disabled
                        try {
                            const config = JSON.parse(f.details);
                            html += '<div class="form-row">';
                            config.fields.forEach(field => {
                                const col = field.col || 12;
                                const type = field.type || 'text';
                                const label = field.label || field.name;
                                const val = field.val || '';
                                const placeholder = field.placeholder || '';
                                const required = val.includes('required') ?
                                    '<span class="text-danger">*</span>' : '';

                                html += `<div class="form-group col-${col}">`;
                                html +=
                                    `<label class="fw-600 text-sm">${label} ${required}</label>`;

                                if (type === 'select') {
                                    html +=
                                        `<select class="form-control" disabled>`;
                                    html += `<option value="">Select...</option>`;
                                    (field.options || []).forEach(opt => {
                                        html +=
                                            `<option value="${opt.value}">${opt.label}</option>`;
                                    });
                                    html += `</select>`;
                                } else if (type === 'textarea') {
                                    html +=
                                        `<textarea class="form-control" disabled placeholder="${placeholder}"></textarea>`;
                                } else {
                                    html +=
                                        `<input type="${type}" class="form-control" disabled placeholder="${placeholder}">`;
                                }
                                html += `</div>`;
                            });
                            html += '</div>';
                        } catch (e) {
                            html +=
                                `<div class="alert alert-danger">Invalid JSON Config</div>`;
                        }

                        $('#viewFormBody').html(html);
                        $('#modalViewForm').addClass('active');
                    }
                }
            });
        });

        // 6. Submit Form
        $('#formSetupForm').on('submit', function(e) {
            e.preventDefault();
            genericSave('formSetupForm', 'syssettingbk', 'saveform', function() {
                loadForms(); // Refresh table
            });
        });

        // 7. Delete Form
        $(document).off('click', '.delete-btn').on('click', '.delete-btn', function() {
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
                            action: 'deleteform',
                            id: id
                        }),
                        dataType: 'json',
                        success: function(res) {
                            if (res.ok) {
                                successmessage(res.message);
                                loadForms();
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