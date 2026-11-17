<?php
include('controller/session.php');
include('common/header.php');
?>

<div class="modal fade" id="additem" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Add items to the list</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="itemForm">
                    <div class="mb-3">
                        <label>Item Category</label>
                        <select class="form-control select2" style='width:100%' id="category" required>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Item</label>
                        <select class="form-control select2" style='width:100%' id="item" required>
                        </select>

                    </div>
                    <div class="mb-3">
                        <label>Unit Price</label>
                        <input type="number" class="form-control" id="unitPrice" required>
                    </div>
                    <div class="mb-3">
                        <label>Quantity</label>
                        <input type="number" class="form-control" id="quantity" value='1' required>
                    </div>
                    <div class="mb-3">
                        <label>Amount</label>
                        <input type="number" class="form-control" id="amount" readonly>
                    </div>
                    <button type="button" class="btn btn-primary" id="addItem">Add Item</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewfile" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style='height: 100%;'>
        <div class="modal-content" style='height: 90%'>
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">file view</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe id="fileIframe" src="" style="width:100%; height:100%; border:none;"></iframe>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="addfile" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">File Upload</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>We only accept pdf, pictures and word documents. Ensure there are no special characters in your file
                    name.</p>
                <form id="uploadForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Title</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="filetitle" name='filetitle'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>File</label>
                        <div class="input-group">
                            <input type="file" class="form-control" id='file' name='file'
                                accept=".pdf, .jpg, .jpeg, .png, .doc, .docx">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <div class="input-group">
                            <textarea class="form-control" id='filedescription' name='filedescription'></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary m-t-15 waves-effect" id='submitfile'>Add File</button>
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
                                <h4>New Requisition</h4>

                            </div>
                            <div class="card-body">
                                <p><b>Requistion ID:
                                    </b><?= $req = 'REQ'.date('Ymdhis');  ?><?php //$req = 'REQ20250427071843';  ?></p>
                                <div class="d-flex justify-content-end" style="margin-bottom: 10px">
                                    <!-- <button class="btn btn-primary" id='addnew' style='margin-left: 10px' data-toggle="tooltip" data-placement="top" title="Add an item" ></button> <button class="btn btn-primary" id='addfile' style='margin-left: 10px' data-toggle="tooltip" data-placement="top" title="Add an attachment"></button> -->


                                    <button type="button" id='btnadditem' class="btn btn-outline-primary"
                                        style="margin: 10px 10px; " data-toggle="tooltip" data-placement="top"
                                        title="Add an item">Add an Item <i class='fas fa-plus'></i></button>
                                    <button class="btn btn-outline-danger" id='btndel' style="margin: 10px 10px; "
                                        data-toggle="tooltip" data-placement="top" title="Delete Selection"><i
                                            class='fas fa-trash-alt'></i></button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="itemsdisplay"
                                        style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" name="" id="checkAll"></th>
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
                                                <td colspan="5" style="text-align: right;"><strong>Total:</strong></td>
                                                <td id="totalAmount">0.00</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <!--  -->

                                </div>
                                <div id="accordion">
                                    <div class="accordion">
                                        <div class="accordion-header accordion-btn "
                                            style='background: #6777ef; color: white;' role="button" id='accord1'>
                                            <h4>File Uploads</h4>
                                        </div>
                                        <div class="accordion-section" id="panel-body-1" data-parent="#accordion">
                                            <div class="d-flex justify-content-end" style="margin-bottom: 10px">
                                                <button type="button" class="btn btn-outline-primary"
                                                    style="margin: 10px 10px; " data-toggle="tooltip"
                                                    data-placement="top" id='btnaddfile' title="add a file"><i
                                                        class='fas fa-file-alt'></i></button>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover" id="filedisplay"
                                                    style="width:100%;">
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
                                            style='background: #6777ef; color: white;' role="button" id='accord2'>
                                            <h4>Descriptions</h4>
                                        </div>
                                        <div class="accordion-section" id="panel-body-2" data-parent="#accordion">

                                            <div class="form-group">
                                                <label>Description</label>
                                                <div class="input-group">
                                                    <textarea class="form-control" id='description'
                                                        name='description'></textarea>
                                                </div>
                                            </div>


                                        </div>
                                    </div>


                                </div>
                                <button class='btn btn-outline-success' id='saveItems'>Push For Approval</button>
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
    $(document).ready(function() {

        let req = <?php echo json_encode($req) ?>;
        let a = req + '&getfile=1';
        loadFiles(req);
    });



    $('#btnadditem').click(function(e) {
        e.preventDefault();
        $('#additem').modal('show');
        getcategory();
    });

    $('#btnaddfile').click(function(e) {
        e.preventDefault();
        $('#addfile').modal('show');
    });


    $('#additem').on('shown.bs.modal', function() {
        $('.select2').select2({
            dropdownParent: $('#additem') // Fixes issue with modal focus
        });
    });

    function getcategory() {
        $.ajax({
            type: "POST",
            url: "reqcontroller",
            data: {
                getcategory: 1
            },
            success: function(response) {
                $('#category').html(response);
                // alert(response);
            }
        });
    }


    $('#category').change(function(e) {
        e.preventDefault();
        let category = $(this).val();
        if (category != '') {
            //  alert(category);
            $.ajax({
                type: "POST",
                url: "reqcontroller",
                data: {
                    getitems: 1,
                    category: category
                },
                success: function(response) {
                    // alert(response);
                    $('#item').html(response);
                }
            });
        }


    });
    //to compute the amount to be generated
    function computeamount() {
        let selected = $('#item').find('option:selected');
        let unitprice = $('#unitPrice').val();
        let qty = $('#quantity').val();
        let sum = unitprice * qty;
        $('#amount').val(sum);
    }

    $('#item').change(function(e) {
        e.preventDefault();
        let selected = $(this).find('option:selected');
        let unitprice = selected.attr('price');
        $('#unitPrice').val(unitprice);
        computeamount();
        // alert('Price: ' + unitprice + '\nQuantity: ' + quantity);
    });

    $('#quantity').change(function(e) {
        e.preventDefault();
        computeamount();
        // alert('Price: ' + unitprice + '\nQuantity: ' + quantity);
    });

    $('#unitPrice').change(function(e) {
        e.preventDefault();
        computeamount();
        // alert('Price: ' + unitprice + '\nQuantity: ' + quantity);
    });



    $('#addItem').click(function() {
        let itemText = $('#item option:selected').text();
        let itemcode = $('#item').val();
        let quantity = $('#quantity').val();
        let unitprice = $('#unitPrice').val();
        let amount = $('#amount').val();

        if (itemcode == '' || quantity == '' || unitprice == '' || amount == '') {
            alert('Please fill all fields.');
            return;
        }

        // Append row to the table
        $('#itemsdisplay tbody').append(`
            <tr>
                <td><input type="checkbox" class="row-check" /></td>
                <td data-code="${itemcode}">${itemText}</td>
                <td>${itemcode}</td>
                <td>${quantity}</td>
                <td>${parseFloat(unitprice).toFixed(2)}</td>
                <td class="row-amount">${parseFloat(amount).toFixed(2)}</td>
            </tr>
        `);

        // Reset form

        $('#amount').val('');
        $('#unitPrice').val('');
        $('#quantiry').val('');
        $('#category').val('');
        // Update total
        updateTotal();
        toastr.success('item added successfully!', 'success', {
            timeOut: 2000
        });
    });

    $('#btndel').click(function() {
        $('#itemsdisplay tbody input.row-check:checked').each(function() {
            $(this).closest('tr').remove();
        });
        updateTotal();
    });

    // Check/Uncheck all
    $('#checkAll').on('change', function() {
        $('.row-check').prop('checked', $(this).is(':checked'));
    });

    // Update total amount
    function updateTotal() {
        let total = 0;
        $('#itemsdisplay .row-amount').each(function() {
            total += parseFloat($(this).text()) || 0;
        });
        $('#totalAmount').text(total.toFixed(2));
    }


    //Save items
    $('#saveItems').click(function() {

        let token = <?php echo json_encode(gentoken()) ?>;
        let req = <?php echo json_encode($req) ?>;
        let user = <?php echo json_encode($user) ?>;
        let comment = $('#description').val();
        let items = [];

        $('#itemsdisplay tbody tr').each(function() {
            let itemCode = $(this).find('td:eq(2)').text();
            let quantity = $(this).find('td:eq(3)').text();
            let unitprice = $(this).find('td:eq(4)').text();

            items.push({
                code: itemCode,
                quantity: quantity,
                unitprice: unitprice
            });
        });

        if (items.length === 0) {
            errormessage('No items to save.');
            return;
        }

        // 
        Swal.fire({
            title: "Attention!",
            text: 'Are you sure to push for approval?',
            showCancelButton: true,
            confirmButtonText: "Proceed",
            denyButtonText: `Cancel`
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'reqcontroller',
                    method: 'POST',
                    data: {
                        items: JSON.stringify(items),
                        requisition: 1,
                        req: req,
                        user: user,
                        comment: comment,
                        token: token
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.status === 'success') {
                            // alert('Items saved successfully!');
                            successmessage(response.message);
                            $('#itemsdisplay tbody').empty();
                            $('#totalAmount').text('0.00');
                            setInterval(() => {
                                window.location.reload();
                            }, 2000);

                        } else {
                            errormessage('Save failed: ' + response.message);

                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        errormessage('An error occurred while saving.');
                    }
                });
            } else if (result.isDenied) {

            }
        });

    });





    $(document).on('click', '.view-file', function(e) {
        e.preventDefault(); // Very important to stop the default action (redirect)

        var fileUrl = $(this).data('url');

        $('#viewfile').modal('show');

        $('#fileIframe').attr('src', fileUrl);
        $('#fileModal').fadeIn();
    });

    $('#closeModal').click(function() {
        $('#fileModal').fadeOut();
        $('#fileIframe').attr('src', ''); // Clear iframe src after closing
    });


    $('#uploadForm').on('submit', function(e) {
        e.preventDefault();
        let req = <?= json_encode($req) ?>;
        const formData = new FormData(this);
        formData.append('reqid', req);
        formData.append('addfile', 1);
        $.ajax({
            url: 'upload',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                $('#uploadForm')[0].reset();
                toastr.success(data, 'success', {
                    timeOut: 1500
                });
                loadFiles(req);
            }
        });
    });


    $('#filedisplay').on('click', '.fileDel', function() {
        let req = <?php echo json_encode($req) ?>;
        const index = $(this).data('id');
        const row = $(this).closest('tr');
        const file = row.find('td').eq(2).text(); // Index starts from 0

        Swal.fire({
            title: "Attention",
            text: "Do you want to delete the file",
            showCancelButton: true,
            confirmButtonText: "Process",
            denyButtonText: `Cancel`
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.post('upload', {
                    id: index,
                    filename: file,
                    delfile: 1
                }, function(data) {
                    toastr.success(data, 'success', {
                        timeOut: 1500
                    });
                    loadFiles(req);
                });
            } else if (result.isDenied) {

            }
        });

    });



    // $(document).ready(function () {

    // });
    </script>
    </body>

    </html>