function successmessage(message) {
    Swal.fire({
        title: "Success!",
        text: message,
        icon: "success"
    });

}

function errormessage(message) {
    Swal.fire({
        title: "Error!",
        text: message,
        icon: "error"
    });
}


function formValidator(formId) {
    // console.log('[formValidator] init for form:', formId);

    const form = document.getElementById(formId);
    if (!form) {
        console.warn(`[formValidator] No form found with id="${formId}"`);
        return null;
    }

    // Let the validator own the UX — stop native browser tooltips.
    form.setAttribute('novalidate', 'novalidate');

    // ✅ CHANGED: strip stale backend error state using YOUR classes,
    //    not `is-invalid`. Matches showValidationErrors() behaviour.
    form.querySelectorAll('.input-group.has-error').forEach((g) => {
        g.classList.remove('has-error');
    });
    form.querySelectorAll('.error-msg').forEach((el) => {
        el.classList.remove('show');
        el.textContent = '';
    });

    // ---- Rule definitions ------------------------------------------------
    const rules = {
    // -------- Presence --------
        required: (value, _param, field) => {
            if (field && field.type === 'checkbox') {
                return { valid: !!field.checked, message: 'This field is required.' };
            }
            if (field && field.type === 'radio') {
                const any = form.querySelector(
                    `input[name="${CSS.escape(field.name)}"]:checked`
                );
                return { valid: !!any, message: 'Please select an option.' };
            }
            return {
                valid: String(value ?? '').trim() !== '',
                message: 'This field is required.',
            };
        },

        // -------- Type / format --------
        integer: (value) => {
            const v = value.trim();
            if (v === '') return { valid: true };
            return {
                valid: /^-?\d+$/.test(v),
                message: 'Please enter a valid integer.',
            };
        },

        // PHP: 'numeric' → is_numeric(). JS alias: 'number'.
        numeric: (value) => {
            const v = value.trim();
            if (v === '') return { valid: true };
            return {
                valid: v !== '' && !isNaN(Number(v)),
                message: 'Please enter a valid number.',
            };
        },
        // Backwards-compatible alias
        number: (value) => rules.numeric(value),

        // PHP: 'money:N' → /^-?\d+(\.\d{1,N})?$/ with N default 2.
        money: (value, param) => {
            const v = value.trim();
            if (v === '') return { valid: true };
            const decimals = Number(param) || 2;
            const re = new RegExp(`^-?\\d+(\\.\\d{1,${decimals}})?$`);
            return {
                valid: re.test(v),
                message: `Please enter a valid amount with up to ${decimals} decimals.`,
            };
        },

        // Legacy decimal — kept for compatibility with old data-val strings
        decimal: (value) => {
            const v = value.trim();
            if (v === '') return { valid: true };
            return {
                valid: /^-?\d+\.\d+$/.test(v),
                message: 'Please enter a valid decimal number.',
            };
        },

        email: (value) => {
            const v = value.trim();
            if (v === '') return { valid: true };
            return {
                valid: /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v),
                message: 'Please enter a valid email address.',
            };
        },

        // PHP: 'alphanum' → letters + digits only (no punctuation).
        alphanum: (value) => {
            const v = value.trim();
            if (v === '') return { valid: true };
            return {
                valid: /^[\p{L}\p{N}]+$/u.test(v),
                message: 'Only letters and numbers are allowed.',
            };
        },

        // Legacy: previously allowed _ . - — kept as alias to avoid breaking schemas.
        // If you want the stricter PHP behavior everywhere, swap JSON to 'alphanum'.
        alphanumeric: (value) => {
            const v = value.trim();
            if (v === '') return { valid: true };
            return {
                valid: /^[a-zA-Z0-9_.-]+$/.test(v),
                message: 'Only letters, numbers, and _ . - are allowed.',
            };
        },

        alpha: (value) => {
            const v = value.trim();
            if (v === '') return { valid: true };
            return {
                valid: /^[\p{L}\s]+$/u.test(v),
                message: 'Only letters and spaces are allowed.',
            };
        },

        url: (value) => {
            const v = value.trim();
            if (v === '') return { valid: true };
            let ok = false;
            try { new URL(v); ok = true; } catch (_) {}
            return { valid: ok, message: 'Please enter a valid URL.' };
        },

        ip: (value) => {
            const v = value.trim();
            if (v === '') return { valid: true };
            // IPv4 or IPv6 (with optional CIDR-less strictness)
            const ipv4 = /^(\d{1,3}\.){3}\d{1,3}$/;
            const ipv6 = /^[0-9a-fA-F:]+$/;
            const validV4 = ipv4.test(v) && v.split('.').every(n => +n >= 0 && +n <= 255);
            const validV6 = v.includes(':') && ipv6.test(v);
            return {
                valid: validV4 || validV6,
                message: 'Please enter a valid IP address.',
            };
        },

        // PHP: 'date:FMT' → exact format match, default Y-m-d.
        date: (value, param) => {
            const v = value.trim();
            if (v === '') return { valid: true };

            // Only support common formats; PHP has more, but these cover 99%.
            const fmt = (param || 'Y-m-d').trim();
            const valid = validateDateByFormat(v, fmt);

            return {
                valid,
                message: `Please enter a valid date (${fmt}).`,
            };
        },

        // -------- Explicit length rules --------
        minlen: (value, param) => {
            const v = String(value ?? '');
            if (v.trim() === '') return { valid: true };
            const n = Number(param);
            return {
                valid: v.length >= n,
                message: `Must be at least ${n} characters.`,
            };
        },

        maxlen: (value, param) => {
            const v = String(value ?? '');
            if (v.trim() === '') return { valid: true };
            const n = Number(param);
            return {
                valid: v.length <= n,
                message: `Must be no more than ${n} characters.`,
            };
        },

        // -------- Explicit numeric range rules --------
        minval: (value, param) => {
            const v = String(value ?? '').trim();
            if (v === '') return { valid: true };
            const n = Number(param);
            const num = Number(v);
            if (isNaN(num)) {
                return { valid: false, message: 'Must be a number.' };
            }
            return {
                valid: num >= n,
                message: `Must be at least ${n}.`,
            };
        },

        maxval: (value, param) => {
            const v = String(value ?? '').trim();
            if (v === '') return { valid: true };
            const n = Number(param);
            const num = Number(v);
            if (isNaN(num)) {
                return { valid: false, message: 'Must be a number.' };
            }
            return {
                valid: num <= n,
                message: `Must not exceed ${n}.`,
            };
        },

        // -------- Length / range --------
        // PHP: numeric values compare as number, strings compare as length.
        min: (value, param) => {
            const v = String(value).trim();
            if (v === '') return { valid: true };
            const n = Number(param);
            const isNum = v !== '' && !isNaN(Number(v));
            return {
                valid: isNum ? Number(v) >= n : v.length >= n,
                message: isNum
                    ? `Must be at least ${n}.`
                    : `Must be at least ${n} characters.`,
            };
        },

        max: (value, param) => {
            const v = String(value).trim();
            if (v === '') return { valid: true };
            const n = Number(param);
            const isNum = v !== '' && !isNaN(Number(v));
            return {
                valid: isNum ? Number(v) <= n : v.length <= n,
                message: isNum
                    ? `Must not exceed ${n}.`
                    : `Must be no more than ${n} characters.`,
            };
        },

        // PHP: 'between:min,max' → numeric only.
        between: (value, param) => {
            const v = String(value).trim();
            if (v === '') return { valid: true };
            const [loRaw, hiRaw] = String(param).split(',');
            const lo = Number(loRaw), hi = Number(hiRaw);
            if (isNaN(lo) || isNaN(hi)) {
                return { valid: false, message: 'Invalid between rule.' };
            }
            const num = Number(v);
            return {
                valid: !isNaN(num) && num >= lo && num <= hi,
                message: `Must be between ${lo} and ${hi}.`,
            };
        },

        // -------- Membership --------
        // PHP: 'in:a,b,c' → strict string match.
        in: (value, param) => {
            const v = String(value).trim();
            if (v === '') return { valid: true };
            const allowed = String(param).split(',').map(s => s.trim());
            return {
                valid: allowed.includes(v),
                message: `Must be one of: ${allowed.join(', ')}.`,
            };
        },

        not_in: (value, param) => {
            const v = String(value).trim();
            if (v === '') return { valid: true };
            const forbidden = String(param).split(',').map(s => s.trim());
            return {
                valid: !forbidden.includes(v),
                message: `Cannot be one of: ${forbidden.join(', ')}.`,
            };
        },

        // -------- Cross-field --------
        // PHP: 'same:otherfield' → value must equal another field's value.
        same: (value, param, field) => {
            const other = form.querySelector(`[name="${CSS.escape(param)}"]`);
            if (!other) return { valid: true };
            const v = String(value ?? '');
            const otherV = String(other.value ?? '');
            return {
                valid: v === otherV,
                message: `Must match ${param}.`,
            };
        },

        different: (value, param, field) => {
            const other = form.querySelector(`[name="${CSS.escape(param)}"]`);
            if (!other) return { valid: true };
            const v = String(value ?? '');
            const otherV = String(other.value ?? '');
            return {
                valid: v !== otherV,
                message: `Must be different from ${param}.`,
            };
        },

        // -------- Pattern (PHP name: 'regex') --------
        regex: (value, param) => {
            const v = value.trim();
            if (v === '') return { valid: true };
            try {
                return {
                    valid: new RegExp(param).test(v),
                    message: 'Invalid format.',
                };
            } catch (e) {
                return { valid: false, message: 'Invalid validation pattern.' };
            }
        },
        // Backwards-compatible alias
        pattern: (value, param) => rules.regex(value, param),

        // -------- Boolean --------
        // PHP accepts 1/0, '1'/'0', true/false, 'true'/'false'.
        bool: (value) => {
            const v = String(value).trim().toLowerCase();
            if (v === '') return { valid: true };
            return {
                valid: ['1', '0', 'true', 'false'].includes(v),
                message: 'Must be true or false.',
            };
        },
        file: (value, param, field) => {
            if (!field || field.type !== 'file') return { valid: true };
            const f = field.files?.[0];
            if (!f) return { valid: true }; // empty handled by required
            // Parse params like "max:2048|types:jpg,png"
            for (const p of String(param).split('|')) {
                const [k, v] = p.split(':');
                if (k === 'max' && f.size > Number(v) * 1024) {
                    return { valid: false, message: `File must be under ${v} KB.` };
                }
                if (k === 'types') {
                    const ext = f.name.split('.').pop().toLowerCase();
                    const allowed = v.split(',');
                    if (!allowed.includes(ext)) {
                        return { valid: false, message: `Allowed types: ${allowed.join(', ')}` };
                    }
                }
            }
            return { valid: true };
        }
    };

    // ---- Helpers ---------------------------------------------------------
    const getFields = () =>
        Array.from(form.querySelectorAll('input, textarea, select'))
            .filter((el) => el.type !== 'hidden' && !el.disabled);

    // Same lookup strategy as showValidationErrors(): closest .input-group,
    // fall back to the field's parent element.
    const getGroup = (field) => {
        return field.closest('.input-group') || field.parentElement;
    };

    const getErrorEl = (group) => {
        if (!group) return null;
        let errEl = group.querySelector('.error-msg');
        if (!errEl) {
            // Match showValidationErrors(): create one if missing.
            errEl = document.createElement('div');
            errEl.className = 'error-msg';
            group.appendChild(errEl);
        }
        return errEl;
    };

    // ✅ CHANGED: mirror showValidationErrors() — toggle `has-error` on the
    //    wrapper and `show` on .error-msg, instead of `is-invalid` on the input.
    const setError = (field, message) => {
        const group = getGroup(field);
        if (!group) return;

        const errEl = getErrorEl(group);
        const hasError = !!message;

        group.classList.toggle('has-error', hasError);
        if (errEl) {
            errEl.textContent = message || '';
            errEl.classList.toggle('show', hasError);
        }

        // Keep aria-invalid in sync for accessibility (harmless if unused by CSS)
        field.setAttribute('aria-invalid', hasError ? 'true' : 'false');
    };

    const isFieldRequired = (field) => {
        const valAttr = (field.getAttribute('data-val') || '').trim();
        const hasRequiredRule = /(^|\|)\s*required\s*(\||$)/.test(valAttr);
        const isRequiredAttr =
            field.hasAttribute('required') ||
            field.getAttribute('aria-required') === 'true';
        return hasRequiredRule || isRequiredAttr;
    };

    const parseRules = (valAttr) =>
        valAttr
            .split('|')
            .map((s) => s.trim())
            .filter(Boolean)
            .map((part) => {
                const [name, ...rest] = part.split(':');
                return [name, rest.join(':')];
            });

    // ---- Core validation -------------------------------------------------
    function validateField(field) {
        const valAttr = (field.getAttribute('data-val') || '').trim();
        const rawValue = field.value ?? '';

        // Required first — short-circuits so its message isn't masked.
        if (isFieldRequired(field)) {
            const { valid, message } = rules.required(rawValue, null, field);
            if (!valid) {
                setError(field, message);
                return false;
            }
        }

        if (!valAttr) {
            setError(field, '');
            return true;
        }

        for (const [name, param] of parseRules(valAttr)) {
            if (name === 'required') continue;

            const rule = rules[name];
            if (!rule) continue;

            // Empty optional fields skip non-required rules.
            const isEmpty =
                field.type === 'checkbox' || field.type === 'radio'
                    ? false
                    : String(rawValue).trim() === '';
            if (isEmpty) continue;

            const { valid, message } = rule(rawValue, param, field);
            if (!valid) {
                setError(field, message);
                return false;
            }
        }

        setError(field, '');
        return true;
    }

    function validate() {
        let ok = true;
        for (const field of getFields()) {
            if (!validateField(field)) ok = false;
        }
        return ok;
    }

    function isValid() {
        return getFields().every((field) => {
            const valAttr = (field.getAttribute('data-val') || '').trim();
            const rawValue = field.value ?? '';

            if (isFieldRequired(field)) {
                if (!rules.required(rawValue, null, field).valid) return false;
            }

            if (!valAttr) return true;

            return parseRules(valAttr).every(([name, param]) => {
                if (name === 'required') return true;
                const rule = rules[name];
                if (!rule) return true;

                const isEmpty =
                    field.type === 'checkbox' || field.type === 'radio'
                        ? false
                        : String(rawValue).trim() === '';
                if (isEmpty) return true;

                return rule(rawValue, param, field).valid;
            });
        });
    }

    // ✅ ADDED: clear an individual field's error manually (e.g. after an AJAX fix)
    function clearError(fieldOrId) {
        const field = typeof fieldOrId === 'string'
            ? form.querySelector('#' + CSS.escape(fieldOrId))
            : fieldOrId;
        if (field) setError(field, '');
    }

    // ---- Event binding ---------------------------------------------------
    const handlers = new WeakMap();

    function attach() {
        for (const field of getFields()) {
            if (handlers.has(field)) continue;

            const handler = () => validateField(field);
            const evt =
                field.tagName === 'SELECT' ||
                field.type === 'checkbox' ||
                field.type === 'radio' ||
                field.type === 'date'
                    ? 'change'
                    : 'blur';

            field.addEventListener(evt, handler);
            if (field.type === 'radio' || field.type === 'checkbox') {
                field.addEventListener('change', handler);
            }
            handlers.set(field, { evt, handler });
        }
    }

    function destroy() {
        for (const field of getFields()) {
            const meta = handlers.get(field);
            if (meta) {
                field.removeEventListener(meta.evt, meta.handler);
                handlers.delete(field);
            }
        }
    }

    attach();

    return { validate, isValid, clearError, destroy, form };
}


/* =========================================================
   GENERIC FORM UTILITIES
   ========================================================= */

const activeValidators = {};

/**
 * Generic Form Save Handler
 * @param {string} formId - The ID of the form
 * @param {string} backendRoute - The URL/route to send the AJAX request to
 * @param {string} actionName - The action pointer for the backend
 * @param {function} onSuccessCallback - (Optional) Function to run after a successful save
 */
function genericSave(formId, backendRoute, actionName, onSuccessCallback = null) {
    const formEl = document.getElementById(formId);
    if (!formEl) {
        console.error(`Form with ID "${formId}" not found.`);
        return;
    }

    // 1. Initialize the validator if not already done
    if (!activeValidators[formId]) {
        activeValidators[formId] = formValidator(formId);
    }
    const validator = activeValidators[formId];

    // 2. Frontend Validation
    if (!validator.isValid()) {
        validator.validate(); // Force display of errors
        errormessage('Please correct the highlighted fields.');
        return;
    }

    // 3. SweetAlert Confirmation
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to save these changes?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#6366f1', // Primary color
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Yes, save it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // 4. Execute the AJAX save, passing the callback down
            executeGenericSave(formEl, backendRoute, actionName, onSuccessCallback);
        }
    });
}

function executeGenericSave(formEl, backendRoute, actionName, onSuccessCallback) {
    const $submitBtn = $(formEl).find('button[type="submit"]');
    const originalBtnText = $submitBtn.text();

    $submitBtn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i> Saving...');

    // Dynamically build the payload
    let payload = { action: actionName };
    $(formEl).serializeArray().forEach(item => {
        payload[item.name] = item.value;
    });

    console.log(payload);

    $.ajax({
        url: backendRoute,
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(payload),
        dataType: 'json',
        success: function(res) {
            console.log('AJAX response:', res);
            if (res.ok) {
                successmessage(res.message || 'Saved successfully.');
                
                // Close the closest modal automatically
                const $modal = $(formEl).closest('.modal-overlay');
                if ($modal.length) $modal.removeClass('active');

                // Execute the success callback if provided
                if (typeof onSuccessCallback === 'function') {
                    onSuccessCallback(res);
                }

            } else if (res.errors) {
                // Map backend validation errors to the UI
                errormessage('Please check the errors before saving.');
                console.log('Backend validation errors:', res.errors);
                $.each(res.errors, function(field, msg) {
                    const fieldEl = formEl.querySelector(`[name="${field}"]`);
                    if (fieldEl) {
                        const group = fieldEl.closest('.input-group');
                        if (group) {
                            group.classList.add('has-error');
                            const errEl = group.querySelector('.error-msg');
                            if (errEl) {
                                errEl.textContent = msg;
                                errEl.classList.add('show');
                            }
                        }
                    }
                });
            } else {
                errormessage(res.error || 'An unknown error occurred.');
            }
        },
        error: function(e) {
            console.log('AJAX error:', e);
            errormessage('Server error occurred. Please try again.');
        },
        complete: function() {
            $submitBtn.prop('disabled', false).text(originalBtnText);
        }
    });
}

function resetGenericForm(formId) {
    const formEl = document.getElementById(formId);
    if (formEl) {
        formEl.reset();
        
        // Clear all validation error states manually
        formEl.querySelectorAll('.input-group.has-error').forEach(g => g.classList.remove('has-error'));
        formEl.querySelectorAll('.error-msg').forEach(el => {
            el.textContent = '';
            el.classList.remove('show');
        });
        
        // Destroy the old validator so it rebuilds cleanly
        if (activeValidators[formId]) {
            activeValidators[formId].destroy();
            delete activeValidators[formId];
        }
    }
}


/* =========================================================
   GENERIC TABLE CONTROLLER
   ========================================================= */
class TableController {
    constructor(tableId, options = {}) {
        this.tableId = tableId;
        this.$table = $('#' + tableId);
        this.$tbody = this.$table.find('tbody');
        
        // Default options
        this.config = {
            searchInputId: tableId + '_search',
            pageLengthId: tableId + '_length',
            infoId: tableId + '_info',
            paginationId: tableId + '_pagination',
            defaultLength: 10,
            ...options
        };

        this.allRows = [];       // All <tr> elements
        this.filteredRows = [];  // Rows after search filter
        this.currentPage = 1;
        this.pageLength = this.config.defaultLength;

        this.init();
    }

    init() {
        // 1. Bind Search
        $(document).on('keyup input', '#' + this.config.searchInputId, (e) => {
            this.search(e.target.value);
        });

        // 2. Bind Page Length
        $(document).on('change', '#' + this.config.pageLengthId, (e) => {
            this.pageLength = parseInt($(e.target).val());
            this.currentPage = 1;
            this.render();
        });

        // 3. Bind Pagination Clicks
        $(document).on('click', '#' + this.config.paginationId + ' .page-btn', (e) => {
            const page = $(e.currentTarget).data('page');
            if (page && page !== this.currentPage) {
                this.currentPage = page;
                this.render();
            }
        });
    }

    // Call this whenever you load new data from AJAX
    setData(htmlRows) {
        this.$tbody.html(htmlRows);
        this.allRows = this.$tbody.find('tr').toArray();
        this.filteredRows = [...this.allRows];
        this.currentPage = 1;
        this.render();
    }

    search(query) {
        query = query.toLowerCase().trim();
        if (query === '') {
            this.filteredRows = [...this.allRows];
        } else {
            this.filteredRows = this.allRows.filter(row => {
                return $(row).text().toLowerCase().includes(query);
            });
        }
        this.currentPage = 1;
        this.render();
    }

    render() {
        const totalRows = this.filteredRows.length;
        const totalPages = Math.ceil(totalRows / this.pageLength) || 1;

        // Ensure current page is within bounds
        if (this.currentPage > totalPages) this.currentPage = totalPages;
        if (this.currentPage < 1) this.currentPage = 1;

        // Hide all rows first
        this.$tbody.find('tr').hide();

        // Calculate slice
        const startIdx = (this.currentPage - 1) * this.pageLength;
        const endIdx = Math.min(startIdx + this.pageLength, totalRows);

        // Show only the sliced rows
        for (let i = startIdx; i < endIdx; i++) {
            $(this.filteredRows[i]).show();
        }

        // Update Info Text
        const infoText = totalRows === 0 
            ? 'Showing 0 entries' 
            : `Showing ${startIdx + 1} to ${endIdx} of ${totalRows} entries`;
        $('#' + this.config.infoId).text(infoText);

        // Render Pagination Buttons
        this.renderPagination(totalPages);
    }

    renderPagination(totalPages) {
        const $container = $('#' + this.config.paginationId);
        let html = '';

        // Prev Button
        html += `<button class="page-btn" data-page="${this.currentPage - 1}" ${this.currentPage === 1 ? 'disabled' : ''}>
                    <i class="fa-solid fa-chevron-left"></i>
                 </button>`;

        // Page Numbers (Show max 5 pages)
        let startPage = Math.max(1, this.currentPage - 2);
        let endPage = Math.min(totalPages, startPage + 4);
        
        if (endPage - startPage < 4) {
            startPage = Math.max(1, endPage - 4);
        }

        for (let i = startPage; i <= endPage; i++) {
            html += `<button class="page-btn ${i === this.currentPage ? 'active' : ''}" data-page="${i}">${i}</button>`;
        }

        // Next Button
        html += `<button class="page-btn" data-page="${this.currentPage + 1}" ${this.currentPage === totalPages ? 'disabled' : ''}>
                    <i class="fa-solid fa-chevron-right"></i>
                 </button>`;

        $container.html(html);
    }
}

/* =========================================================
   GENERIC EXPORT TO EXCEL (CSV)
   ========================================================= */
function exportTableToCSV(tableId, filename = 'export.csv') {
    const $table = $('#' + tableId);
    
    // 1. Get all rows (including hidden ones so it exports everything, not just the current page)
    // We exclude the header row from tbody and any rows with colspan (like "No data found")
    const rows = $table.find('tbody tr').filter(function() {
        return $(this).find('td').length > 1; 
    });

    if (rows.length === 0) {
        errormessage("No data available to export.");
        return;
    }

    let csvContent = "";

    // 2. Extract Headers
    const headers = [];
    $table.find('thead th').each(function() {
        // Remove the "Actions" column from export
        const text = $(this).text().trim();
        if (text !== 'Actions' && text !== '') {
            headers.push(`"${text.replace(/"/g, '""')}"`);
        }
    });
    csvContent += headers.join(",") + "\r\n";

    // 3. Extract Data
    rows.each(function() {
        const rowData = [];
        $(this).find('td').each(function(index) {
            // Skip the last column (Actions)
            if (index === $(this).parent().find('td').length - 1) return;

            // Get text, handle empty cells, escape quotes
            let cellText = $(this).text().trim().replace(/\s+/g, ' '); // Fix multi-line text
            cellText = cellText.replace(/"/g, '""'); // Escape double quotes
            rowData.push(`"${cellText}"`);
        });
        
        // Only add rows that have data
        if (rowData.length > 0) {
            csvContent += rowData.join(",") + "\r\n";
        }
    });

    // 4. Create Download Link
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement("a");
    const url = URL.createObjectURL(blob);
    
    link.setAttribute("href", url);
    link.setAttribute("download", filename);
    link.style.visibility = 'hidden';
    
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
