<?php
include('controller/session.php');
include('common/header.php');
?>
<!-- add module starts here -->
<div class="modal fade" id="addmodule" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Add Module</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="itemForm">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" class="form-control" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label>Code</label>
                        <input type="text" class="form-control" id="code" required>
                    </div>

                    <div class="mb-3">
                        <label>Description</label>
                        <input type="text" class="form-control" id="description" required>
                    </div>
                    <div class="mb-3">
                        <label>Icon</label>
                        <input type="text" class="form-control" id="icon" required>
                    </div>
                    <button type="button" class="btn btn-primary" id="Savemodule">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- add module ends here -->

<!-- view module starts here -->
<div class="modal fade" id="viewmodule" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" >
        <div class="modal-content" style='height: 90%; width: 100%'>
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Modules View</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"
                style='max-height: 90vh; overflow-y: auto; overflow-x: hidden; box-sizing: border-box;' id='reqbody'>
                <h5 id='moduletitle'>Module </h5>
                <p>Below is the list of menu under this module</p>
                <!-- <iframe id="menuframe" src="" style="width:100%; height:100%; border:none;"></iframe> -->
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <h5></h5>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="menubycode" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Module</th>
                                            <th>Route</th>
                                            <th>Path</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id='menubycodebd'>

                                    </tbody>
                                </table>


                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- view modules ends here -->


<!-- edit modules starts here -->
<div class="modal fade" id="editmodule" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Edit Module</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="itemForm">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" class="form-control" id="emodulename" required>
                    </div>
                    <div class="mb-3">
                        <label>Code</label>
                        <input type="hidden" id='emoduleid' name="id">
                        <input type="text" class="form-control" id="emodulecode" required>
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <input type="description" class="form-control" id="emoduledescription" required>
                    </div>
                    <div class="mb-3">
                        <label>Icon</label>
                        <input type="text" class="form-control" id="emoduleicon" required>
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <select name="estatus" id="emodulestatus" class="form-control" required>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>


                    <button type="button" class="btn btn-primary" id="updatemodule">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- edit module ends here -->


<!-- add menu begin here -->
<div class="modal fade" id="addmenu" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Add Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="itemForm">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" class="form-control" id="menuname" required>
                    </div>
                    <div class="mb-3">
                        <label>Module</label>
                        <select name="" class="form-control" id="menumodule" required>
                            <option value="">--Select Module--</option>
                        </select>

                    </div>

                    <div class="mb-3">
                        <label>Route</label>
                        <input type="text" class="form-control" id="menuroute" required>
                    </div>
                    <div class="mb-3">
                        <label>Menu Path</label>
                        <input type="text" class="form-control" id="menupath" required>
                    </div>

                    <div class="mb-3">
                        <label>Description</label>
                        <textarea class="form-control" id="menudescription" required></textarea>
                    </div>

                    <button type="button" class="btn btn-primary" id="Savemenu">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- add menu ends here -->

<!-- edit menu begins here -->
<div class="modal fade" id="editmenu" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Edit Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="itemForm">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="hidden" name='emenuid' id='emenuid'>
                        <input type="text" class="form-control" id="emenuname" required>
                    </div>
                    <div class="mb-3">
                        <label>Module</label>
                        <select name="" class="form-control" id="emenumodule" required>
                            <option value="">--Select Module--</option>
                        </select>

                    </div>

                    <div class="mb-3">
                        <label>Route</label>
                        <input type="text" class="form-control" id="emenuroute" required>
                    </div>

                    <div class="mb-3">
                        <label>Path</label>
                        <input type="text" class="form-control" id="emenupath" required>
                    </div>

                    <div class="mb-3">
                        <label>Description</label>
                        <textarea class="form-control" id="emenudescription" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <select name="estatus" id="emenustatus" class="form-control" required>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>

                    <button type="button" class="btn btn-primary" id="updatemenu">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- edit menu ends here -->


<div class="main-content">
    <section class="section">
        <div class="section-body">
            <!-- add content here -->
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Modules Setup</h4>
                            </div>
                            <div class="card-body">
                                <p>Here is the list of the modules in this application</p>
                                <div class="d-flex justify-content" style="margin-bottom: 10px">
                                    <button type="button" id='addnew' class="btn btn-outline-primary"
                                        style="margin: 10px 10px; " data-toggle="tooltip" data-placement="top"
                                        title="Add an item">Add New <i class='fas fa-plus'></i></button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="dtb" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Code</th>
                                                <th>Description</th>
                                                <th>Icon</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id='approvalsbd'>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- menu states here -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Menu Setup</h4>
                            </div>
                            <div class="card-body">
                                <p>Here is the list of the Menu in this application</p>
                                <div class="d-flex justify-content" style="margin-bottom: 10px">
                                    <button type="button" id='addnewmenu' class="btn btn-outline-primary"
                                        style="margin: 10px 10px; " data-toggle="tooltip" data-placement="top"
                                        title="Add an item">Add New <i class='fas fa-plus'></i></button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="menutb" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Module</th>
                                                <th>Route</th>
                                                <th>Path</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id='menusdbsbd'>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <div class="settingSidebar">
        <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
        </a>
        <div class="settingSidebar-body ps-container ps-theme-default">
            <div class=" fade show active">
                <div class="setting-panel-header">Setting Panel
                </div>
                <div class="p-15 border-bottom">
                    <h6 class="font-medium m-b-10">Select Layout</h6>
                    <div class="selectgroup layout-color w-50">
                        <label class="selectgroup-item">
                            <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout"
                                checked>
                            <span class="selectgroup-button">Light</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                            <span class="selectgroup-button">Dark</span>
                        </label>
                    </div>
                </div>
                <div class="p-15 border-bottom">
                    <h6 class="font-medium m-b-10">Sidebar Color</h6>
                    <div class="selectgroup selectgroup-pills sidebar-color">
                        <label class="selectgroup-item">
                            <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                            <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar"
                                checked>
                            <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                        </label>
                    </div>
                </div>
                <div class="p-15 border-bottom">
                    <h6 class="font-medium m-b-10">Color Theme</h6>
                    <div class="theme-setting-options">
                        <ul class="choose-theme list-unstyled mb-0">
                            <li title="white" class="active">
                                <div class="white"></div>
                            </li>
                            <li title="cyan">
                                <div class="cyan"></div>
                            </li>
                            <li title="black">
                                <div class="black"></div>
                            </li>
                            <li title="purple">
                                <div class="purple"></div>
                            </li>
                            <li title="orange">
                                <div class="orange"></div>
                            </li>
                            <li title="green">
                                <div class="green"></div>
                            </li>
                            <li title="red">
                                <div class="red"></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="p-15 border-bottom">
                    <div class="theme-setting-options">
                        <label class="m-b-0">
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                id="mini_sidebar_setting">
                            <span class="custom-switch-indicator"></span>
                            <span class="control-label p-l-10">Mini Sidebar</span>
                        </label>
                    </div>
                </div>
                <div class="p-15 border-bottom">
                    <div class="theme-setting-options">
                        <label class="m-b-0">
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                id="sticky_header_setting">
                            <span class="custom-switch-indicator"></span>
                            <span class="control-label p-l-10">Sticky Header</span>
                        </label>
                    </div>
                </div>
                <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                    <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                        <i class="fas fa-undo"></i> Restore Default
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- </div> -->

    <?php
include('common/footer.php');
?>
    <script>
    var token = <?php echo json_encode(gentoken()) ?>;


    $(document).ready(function() {
        getmodules();
        getmenus();
    });

    $('#addnew').click(function(e) {
        e.preventDefault();
        $('#addmodule').modal('show');
    });

    $('#addnewmenu').click(function(e) {
        e.preventDefault();
        $('#addmenu').modal('show');
    });

    $(document).on('click', '.viewmodule', function(e) {
        e.preventDefault();
        $('#viewmodule').modal('show');
        
        var module = $(this).val();
        $.ajax({
            type: "GET",
            url: "appcontroller",
            data: {
                module: module,
                menubycode: 1
            },
            dataType: "JSON",
            success: function(response) {
                var rows = '';

                if (response.data.length > 0) {
                    var num = 1;
                    response.data.forEach(function(role) {
                        rows += `<tr>
                                <td>${num++}</td>
                                <td>${role.name}</td>
                                <td>${role.module}</td>
                                <td>${role.route}</td>
                                <td>${role.path}</td>
                                <td>${role.description}</td>
                                <td>${role.status}</td>
                                <td>${role.date}</td>
                                <td><button class="btn btn-outline-primary editmenu" value="${role.id}"><i class='fas fa-pen'></i></button> <button class="btn btn-outline-danger delmenu" value="${role.id}"><i class='fas fa-trash'></i></button></td>
                             </tr>`;

                    });
                }

                $('#menubycodebd').html(rows);
                // $('#menubycode').DataTable().destroy();
                $('#menubycode').DataTable();
                // return;
            }
        });
        // var frame = $('#menuframe').attr('src', 'getmenus?code=' + valu);
    });


    $(document).on('click', '.editmodule', function(e) {
        e.preventDefault();
        var valu = $(this).val();

        $.ajax({
            type: "GET",
            url: "appcontroller",
            data: {
                id: valu,
                getmodule: 1
            },
            dataType: 'JSON',
            success: function(response) {
                $('#emodulecode').val(response.data.code);
                $('#emodulename').val(response.data.name);
                $('#emoduledescription').val(response.data.description);
                $('#emoduleid').val(response.data.id);
                $('#emoduleicon').val(response.data.icon);
                $('#emodulestatus').val(response.data.status);
                $('#editmodule').modal('show');
            }
        });

    });

    $(document).on('click', '.delmodule', function(e) {
        e.preventDefault();
        var valu = $(this).val();
        Swal.fire({
            title: "Attention!",
            text: "Do you want to delete this record ?",
            icon: "error",
            showCancelButton: true,
            confirmButtonText: "Proceed",
            denyButtonText: `Cancel`
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "appcontroller",
                    data: {
                        id: valu,
                        token: token,
                        delmodule: 1
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.status == 'success') {
                            successmessage(response.message);
                            setInterval(() => {
                                window.location.reload();
                            }, 2000);
                        } else {
                            errormessage(response.message);
                        }
                    }
                });
            } else if (result.isDenied) {
                Swal.fire("Changes are not saved", "", "info");
            }
        });
    });

    $(document).on('click', '.editmenu', function(e) {
        e.preventDefault();
        var valu = $(this).val();
        $.ajax({
            type: "GET",
            url: "appcontroller",
            data: {
                id: valu,
                getmenu: 1
            },
            dataType: 'JSON',
            success: function(response) {
                $('#emenuroute').val(response.data.route);
                $('#emenuname').val(response.data.name);
                $('#emenudescription').val(response.data.description);
                $('#emenuid').val(response.data.id);
                $('#emenumodule').val(response.data.module);
                $('#emenupath').val(response.data.path);
                $('#emenustatus').val(response.data.status);
                $('#editmenu').modal('show');
            }
        });

    });

    $(document).on('click', '.delmenu', function(e) {
        e.preventDefault();
        var valu = $(this).val();
        Swal.fire({
            title: "Attention!",
            text: "Do you want to delete this record ?",
            icon: "error",
            showCancelButton: true,
            confirmButtonText: "Proceed",
            denyButtonText: `Cancel`
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "appcontroller",
                    data: {
                        id: valu,
                        token: token,
                        delmenu: 1
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.status == 'success') {
                            successmessage(response.message);
                            setInterval(() => {
                                window.location.reload();
                            }, 2000);
                        } else {
                            errormessage(response.message);
                        }
                    }
                });
            } else if (result.isDenied) {
                Swal.fire("Changes are not saved", "", "info");
            }
        });
    });

    $('#updatemodule').click(function(e) {
        e.preventDefault();
        let code = $('#emodulecode').val().trim();
        let id = $('#emoduleid').val().trim();
        let name = $('#emodulename').val().trim();
        let status = $('#emodulestatus').val().trim();
        let description = $('#emoduledescription').val().trim();
        let icon = $('#emoduleicon').val().trim();

        $.ajax({
            type: "POST",
            url: "appcontroller",
            data: {
                id: id,
                code: code,
                name: name,
                status: status,
                description: description,
                icon: icon,
                token: token,
                editmodule: 1
            },
            dataType: 'JSON',
            success: function(response) {
                // alert(response);

                if (response.status == 'success') {
                    successmessage(response.message);
                    $('#editrole').modal('hide');
                    setInterval(() => {
                        window.location.reload();
                    }, 2000);
                } else {
                    errormessage(response.message);
                }


            }
        });
    });

    $('#updatemenu').click(function(e) {
        e.preventDefault();
        let module = $('#emenumodule').val().trim();
        let id = $('#emenuid').val().trim();
        let name = $('#emenuname').val().trim();
        let status = $('#emenustatus').val().trim();
        let description = $('#emenudescription').val().trim();
        let route = $('#emenuroute').val().trim();
        let path = $('#emenupath').val().trim();


        $.ajax({
            type: "POST",
            url: "appcontroller",
            data: {
                id: id,
                module: module,
                route: route,
                path: path,
                name: name,
                status: status,
                description: description,
                token: token,
                editmenu: 1
            },
            dataType: 'JSON',
            success: function(response) {
                // alert(response);

                if (response.status == 'success') {
                    successmessage(response.message);
                    $('#editmenu').modal('hide');
                    setInterval(() => {
                        window.location.reload();
                    }, 2000);
                } else {
                    errormessage(response.message);
                }
            }
        });
    });

    $('#Savemodule').click(function(e) {
        e.preventDefault();
        let code = $('#code').val().trim();
        let name = $('#name').val().trim();
        let icon = $('#icon').val().trim();
        let description = $('#description').val().trim();

        $.ajax({
            type: "POST",
            url: "appcontroller",
            data: {
                code: code,
                name: name,
                icon: icon,
                description: description,
                token: token,
                addmodule: 1
            },
            dataType: 'JSON',
            success: function(response) {
                // alert(response);
                if (response.status == 'success') {
                    successmessage(response.message);
                    $('#addmodule').modal('hide');
                    setInterval(() => {
                        window.location.reload();
                    }, 2000);
                } else {
                    errormessage(response.message);
                }

            }
        });
    });

    $('#Savemenu').click(function(e) {
        e.preventDefault();
        let module = $('#menumodule').val().trim();
        let name = $('#menuname').val().trim();
        let route = $('#menuroute').val().trim();
        let path = $('#menupath').val().trim();
        let description = $('#menudescription').val().trim();

        $.ajax({
            type: "POST",
            url: "appcontroller",
            data: {
                module: module,
                name: name,
                route: route,
                path: path,
                description: description,
                token: token,
                addmenu: 1
            },
            dataType: 'JSON',
            success: function(response) {
                // alert(response);
                if (response.status == 'success') {
                    successmessage(response.message);
                    $('#addmenu').modal('hide');
                    setInterval(() => {
                        window.location.reload();
                    }, 2000);
                } else {
                    errormessage(response.message);
                }

            }
        });
    });
    </script>
    </body>

    </html>