<?php
include('controller/session.php');
include('common/header.php');
?>

<section class="table-components">
    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                        <h2>Report</h2>
                    </div>
                </div>
                <!-- end col -->

                <div class="col-md-6">
                    <div class="breadcrumb-wrapper">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#0">Settings</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Report
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- ========== title-wrapper end ========== -->

        <!-- ========== tables-wrapper start ========== -->
        <div class="tables-wrapper">



            <!-- end row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card-style mb-30">
                        <h6 class="mb-10">System Settings</h6>
                        <p class="text-sm mb-20">
                            You can set the system profile here with ease
                        </p>
                        <div class="table-wrapper table-responsive">
                            <table class='table dtb'>
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
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>ridwan</td>
                                        <td>rid</td>
                                        <td>lagos nigeria</td>
                                        <td>ridwan</td>
                                        <td>good</td>
                                        <td>true</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>barakat</td>
                                        <td>rid</td>
                                        <td>lagos nigeria</td>
                                        <td>barak</td>
                                        <td>ok</td>
                                        <td>false</td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- end table -->
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- ========== tables-wrapper end ========== -->
    </div>
    <!-- end container -->
</section>


<?php
include('common/footer.php');
?>
<script>
$('.dtb').DataTable({
    paging: true,
    scrollCollapse: true,  
});
</script>
</body>

</html>