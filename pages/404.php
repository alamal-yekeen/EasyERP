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
                    <h4>Page not found</h4>
                   
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