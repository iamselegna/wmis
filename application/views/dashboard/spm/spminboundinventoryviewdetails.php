        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">SP Mamplasan Inbound Inventory Monitoring</h1>


            <div class="row">
                <!-- Pending Requests Card Example -->
                <div class="col-lg-4 col-md-6 mb-2">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Add Inbound
                                        Inventory
                                    </div>
                                    <a href="<?php echo base_url('dashboard/spmaddinboundinventory');?>"
                                        class="btn btn-success btn-icon-split">
                                        <span class="text">Add Inbound Details</span>
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-plus fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SPM Inbound Item Table -->
            <div class="card col-lg-6 shadow mb-4 border-bottom-primary">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Inbound Inventory</h6>
                </div>
                <div class="card-body">
                <p><?php echo $result[0]['ArNo'];?></p>
                    <?php foreach ($result as $key => $i) {
                        # code...
                    } ?>
                </div>
            </div>
            <!-- End of SPM Inbound Item Table-->
        </div>
        <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->