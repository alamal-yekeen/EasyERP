<?php
include('controller/session.php');
include('common/header.php');
?>

    <div class="main-content">
        <section class="section">
          <div class="section-body">
            <!-- add content here -->
            <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>inbox</h4>
                   
                  </div>
                  <div class="card-body"> <p>Here is the list of the available system settings</p>
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id="dtb" style="width:100%;">
                        <thead>
                          <tr>
                            <th>S/N #</th>
                            <th>Name</th>
                            <th>Short Name</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody id=''>
                          
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
function getsettings(){
    $.ajax({
        type: "POST",
        url: "appcontroller",
        data: {getsettings: 1},
        success: function (response) {
            $('#settingsbd').html(response);
            $('#dtb').DataTable().destroy();
            $('#dtb').DataTable();
        }
    });
}

// $('.dtb').DataTable({
//     paging: true,
//     scrollCollapse: true,  
// });

$(document).ready(function () {
    getsettings();
});
</script>
</body>

</html>