<?php
include('controller/session.php');
include('common/header.php');
?>
<!-- this is for ticket details -->
<div class="modal fade" id="viewticket" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style='height: 90%'>
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Ticket View</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"
                style='max-height: 90vh; overflow-y: auto; overflow-x: hidden; padding: 1rem; box-sizing: border-box;'
                id='reqbody'>
                <!-- <iframe id="fileIframe" src="" style="width:100%; height:100%; border:none;"></iframe> -->
                <section class="section">
                    <div class="section-body">
                        <!-- add content here -->
                        <div class="section-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">

                                        <div class="card-body">
                                            <h6>Title</h6>
                                            <p class='tickettitle'> This is the simple ticket title</p>
                                            <h6>Description</h6>
                                            <p class='ticketbody'> this is the simple ticket description</p>


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


<!-- view file modal begins here -->
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
<!-- view modal ends here -->


<div class="modal fade" id="viewticket" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style='height: 90%'>
            <div class="modal-header" style='background: #6777ef; color: white'>
                <h5 class="modal-title" id="formModal">Ticket View</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style='color: white'>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-12">
                <div class="card" style='width: 100%'>
                    <div class="chat">
                        <div class="chat-header clearfix">
                            <!-- <img src="assets/img/users/user-1.png" alt="avatar"> -->
                            <div class="chat-about">
                                <div class="chat-with name">Maria Smith</div>
                                <div class="chat-num-messages ticket">2 new messages</div>
                            </div>
                        </div>
                    </div>
                    <div class="chat-box" id="mychatbox">
                        <div class="card-body chat-content">

                            <div class="chat-item chat-left" style=""><img src="assets/img/users/user-5.png">
                                <div class="chat-details">
                                    <div class="chat-text">Its going good.</div>
                                    <div class="chat-time">01:05</div>
                                </div>
                            </div>
                            <div class="chat-item chat-right" style=""><img src="assets/img/users/user-1.png">
                                <div class="chat-details">
                                    <div class="chat-text">Very Good</div>
                                    <div class="chat-time">01:05</div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer chat-form">
                            <form id="chat-form">
                                <input type="text" class="form-control" placeholder="Type a message">
                                <button class="btn btn-primary">
                                    <i class="far fa-paper-plane"></i>
                                </button>
                            </form>
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
                                <h4>My Tickets</h4>
                            </div>
                            <div class="card-body">
                                <p>Here is the list of you previous Tickets</p>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="dtb" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>S/N #</th>
                                                <th>Ticket By</th>
                                                <th>Ticket Id</th>
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

</div>

<?php
include('common/footer.php');
?>
<script>

function getickets(user) {
    $.ajax({
        type: "POST",
        url: "ticketcontroller",
        data: {
            getickets: 1,
            user: user
        },
        dataType: "JSON",
        success: function(response) {
            let rows = '';
            let num = 1;

            if (response.status === 'success' && response.data.length > 0) {
                response.data.forEach(function(role) {
                    rows += `<tr>
                        <td>
                            <input type='hidden' value="${role.description}" class='desc'>
                            <input type='hidden' value="${role.title}" class='title'>
                            ${num++}
                        </td>
                        <td>${role.name}</td>
                        <td>${role.requestid}</td>
                        <td>${role.department}</td>`;
                        if(role.stat=='Open'){
                            rows +=   `<td><button class='btn btn-light'>${role.stat}</button></td>`;
                        }else if(role.stat=='Pending'){
                            rows +=   `<td><button class='btn btn-warning'>${role.stat}</button></td>`;
                        }else if(role.stat=='Resolved'){
                            rows +=   `<td><button class='btn btn-primary'>${role.stat}</button></td>`;
                        }
                        else
                        {
                            rows +=   `<td><button class='btn btn-success'>${role.stat}</button></td>`;
                        }
                   rows += `      
                        <td>${role.createdat}</td>
                        <td>
                            <button class="btn btn-outline-primary view" value="${role.requestid}">view</button>
                        </td>
                    </tr>`;
                });
            } else {
                rows = `<tr><td colspan="7" class="text-center">No tickets found</td></tr>`;
            }

            $('#reqtb').html(rows);

            // Reinitialize DataTable if already initialized
            if ($.fn.DataTable.isDataTable('#dtb')) {
                $('#dtb').DataTable().destroy();
            }

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
    getickets(user);

});

$(document).on('click', '.viewchat', function(e) {
    e.preventDefault(); // Very important to stop the default action (redirect)

    var valu = $(this).val();
    var row = $(this).closest('tr');
    // Get the cell values (tds)
    var name = row.find('td:eq(1)').text();
    var ticketid = row.find('td:eq(2)').text();
    var date = row.find('td:eq(5)').text();

    $('.name').html(name);
    $('.ticket').html(ticketid + ' ' + date);

    $('#viewticket').modal('show');

});

$(document).on('click', '.view', function(e) {
    e.preventDefault(); // Very important to stop the default action (redirect)

    var valu = $(this).val();
    var row = $(this).closest('tr');
    // Get the cell values (tds)
    var name = row.find('td:eq(1)').text();
    var ticketid = row.find('td:eq(2)').text();
    var date = row.find('td:eq(5)').text();
    var description = row.find('.desc').val();
    var title = row.find('.title').val();

    $('.tickettitle').text(title);
    $('.ticketbody').text(description);

    $('#viewticket').modal('show');
    loadFiles(ticketid);

});

$(document).on('click', '.view-file', function(e) {
    e.preventDefault(); // Very important to stop the default action (redirect)

    var fileUrl = $(this).data('url');

    $('#viewfile').modal('show');

    $('#fileIframe').attr('src', fileUrl);
    $('#fileModal').fadeIn();
});
</script>
</body>

</html>