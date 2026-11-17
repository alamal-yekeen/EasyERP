<?php
include('controller/session.php');
include('common/header.php');
?>
<div class="modal fade" id="viewreq" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style='height: 100%;'>
        <div class="modal-content" style='height: 90%'>
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Requisition View</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style='max-height: 90vh; overflow-y: auto; overflow-x: hidden; padding: 1rem; box-sizing: border-box;' id='reqbody'>
                <!-- <iframe id="fileIframe" src="" style="width:100%; height:100%; border:none;"></iframe> -->
                <section class="section">
                <div class="section-body">
                    <!-- add content here -->
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    
                                    <div class="card-body">
                                        <ul id='reqheader'>
                                            
                                        </ul>
                                                                    
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover" id="itemsdisplay"
                                                style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th>S/N</th>
                                                        <th>Item Name</th>
                                                        <th>Code</th>
                                                        <th>Quantity</th>
                                                        <th>Unit</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="5" style="text-align: right;">
                                                            <strong>Total:</strong></td>
                                                        <td id="totalAmount">0.00</td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <!--  -->

                                        </div>
                                        <div id="accordion">
                                            <div class="accordion">
                                                <div class="accordion-header accordion-btn "
                                                    style='background: #6777ef; color: white;' role="button"
                                                    id='accord1'>
                                                    <h4>File Uploads</h4>
                                                </div>
                                                <div class="accordion-section" id="panel-body-1"
                                                    data-parent="#accordion">
                                                    
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-hover"
                                                            id="filedisplay" style="width:100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th>S/N</th>
                                                                    <th>Title</th>
                                                                    <th>File</th>
                                                                    <th>Description</th>
                                                                    <th>action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>

                                                        </table>


                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion">
                                                <div class="accordion-header accordion-btn "
                                                    style='background: #6777ef; color: white;' role="button"
                                                    id='accord2'>
                                                    <h4>Descriptions</h4>
                                                </div>
                                                <div class="accordion-section" id="panel-body-2"
                                                    data-parent="#accordion">

                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <div class="input-group">
                                                            <textarea class="form-control" id='description'
                                                                name='description' readonly></textarea>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>


                                        </div>
                                        
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </section>

                    
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
                                <h4>REQUISITIONS</h4>
                            </div>
                            <div class="card-body">
                                <p>Here is the list the previous requisition</p>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="dtb" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>S/N #</th>
                                                <th>Req By</th>
                                                <th>Req Id</th>
                                                <th>Department</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id='reqtb'>

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

    <!-- </div> -->

    <?php
include('common/footer.php');
?>
    <script>
    function getreqs(user) {
        $.ajax({
            type: "POST",
            url: "reqcontroller",
            data: {
                getreqs: 1,
                user: user
            },
            success: function(response) {
                $('#reqtb').html(response);
                $('#dtb').DataTable().destroy();
                $('#dtb').DataTable();
            }
        });
    }

    function getreq(id) {
        $.ajax({
            type: "POST",
            url: "reqcontroller",
            data: {
                getreq: 1,
                id: id
            },
            success: function(response) {
                const res = JSON.parse(response);
                $('#reqheader').html(res.header);  
                $('#itemsdisplay tbody').html(res.items);  
                $('#totalAmount').html(res.total); 
                $('#description').val(res.description); 
                loadFiles(id);
            }
        });
    }

    // $('.dtb').DataTable({
    //     paging: true,
    //     scrollCollapse: true,  
    // });

    $(document).ready(function() {
        let user = <?php echo json_encode($user) ?>;
        getreqs(user);


    });

    $(document).on('click', '.view', function(e) {
        e.preventDefault(); // Very important to stop the default action (redirect)
        var valu = $(this).val();
        getreq(valu);
        $('#viewreq').modal('show');

    });
    </script>
    </body>

    </html>