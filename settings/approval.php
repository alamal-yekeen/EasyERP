<?php
include('controller/session.php');
include('common/header.php');
?>
<div class="modal fade" id="editapp" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Edit Approval</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="itemForm">
                    <div class="mb-3">
                        <label>Approval Code</label>
                        <input type="hidden" id='eappid' name="id">
                        <input type="text" class="form-control" id="ecode" required>
                    </div>
                    <div class="mb-3">
                        <label>Approval Name</label>
                        <input type="text" class="form-control" id="ename" value='1' required>
                    </div>
                    <div class="mb-3">
                        <label>Approval Description</label>
                        <input type="description" class="form-control" id="edescription" required>
                    </div>
                    <button type="button" class="btn btn-primary" id="eSaveapp">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addapp" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Add Approval</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="itemForm">
                    <div class="mb-3">
                        <label>Approval Code</label>
                        <input type="text" class="form-control" id="code" required>
                    </div>
                    <div class="mb-3">
                        <label>Approval Name</label>
                        <input type="text" class="form-control" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label>Approval Description</label>
                        <input type="description" class="form-control" id="description" required>
                    </div>
                    <button type="button" class="btn btn-primary" id="Saveapp">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <!-- add content here -->
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Approval Setting</h4>
                                

                            </div>
                            <div class="card-body">
                                <p>Here is the list of the approval Definition settings</p>
                                <div class="d-flex justify-content" style="margin-bottom: 10px">
                                    <button type="button" id='addnew' class="btn btn-outline-primary"
                                        style="margin: 10px 10px; " data-toggle="tooltip" data-placement="top"
                                        title="Add an item">Add New <i class='fas fa-plus'></i></button>
                                    </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="dtb" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>S/N #</th>
                                                <th>Code</th>
                                                <th>Name</th>
                                                <th>Description</th>
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
    // $('.dtb').DataTable({
    //     paging: true,
    //     scrollCollapse: true,  
    // });

    $(document).ready(function() {
        getapprovals();
    });
    $('#addnew').click(function (e) { 
      e.preventDefault();
      $('#addapp').modal('show');
    });

    $(document).on('click', '.approval', function(e) {
        e.preventDefault();
        var valu = $(this).val();
        $.ajax({
            type: "GET",
            url: "appcontroller",
            data: {
                id: valu,
                getapproval: 1
            },
            dataType: 'JSON',
            success: function(response) {
                $('#ecode').val(response.data.code);
                $('#ename').val(response.data.name);
                $('#edescription').val(response.data.description);
                $('#eappid').val(response.data.id);
                $('#editapp').modal('show');
            }
        });

    });

    $('#eSaveapp').click(function(e) {
        e.preventDefault();
        let code = $('#ecode').val().trim();
        let id = $('#eappid').val().trim();
        let name = $('#ename').val().trim();
        let description = $('#edescription').val().trim();
        
        
        $.ajax({
            type: "POST",
            url: "appcontroller",
            data: {
                id: id,
                code: code,
                name: name,
                description: description,
                token: token,
                editapp: 1
            },
            dataType: 'JSON',
            success: function(response) {
                // alert(response);
                if(response.status=='success'){
                    successmessage(response.message);
                    $('#editapp').modal('hide');
                    setInterval(() => {
                    window.location.reload();
                    }, 2000);
                }else{
                    errormessage(response.message);
                }
                

            }
        });
    });

    $('#Saveapp').click(function (e) { 
      e.preventDefault();
      let code = $('#code').val().trim();
      let name = $('#name').val().trim();
      let description = $('#description').val().trim();

      $.ajax({
            type: "POST",
            url: "appcontroller",
            data: {
                code: code,
                name: name,
                description: description,
                token: token,
                addapp: 1
            },
            dataType: 'JSON',
            success: function(response) {
                if(response.status=='success'){
                    successmessage(response.message);
                    $('#addapp').modal('hide');
                    setInterval(() => {
                        window.location.reload();
                    }, 2000);
                }else{
                    errormessage(response.message);
                }

                

            }
        });
    });
    </script>
    </body>

    </html>