        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">SP Mamplasan Outbound Inventory Monitoring</h1>
            <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard/spmoutbound/monitor'); ?>">SPM Outbound
                    Inventory</a></li>
            <li class="breadcrumb-item active" aria-current="page">Outbound Inventory Details</li>
        </ol>
    </nav>

            <div class="row">
                <!-- Pending Requests Card Example -->
                <div class="col-lg-4 col-md-6 mb-2">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Add Outbound
                                        Inventory
                                    </div>
                                    <a href="<?php echo base_url('dashboard/spmaddinboundinventory'); ?>"
                                        class="btn btn-success btn-icon-split">
                                        <span class="text">Add Outbound Details</span>
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
                    <h6 class="m-0 font-weight-bold text-primary">Outbound Inventory Details</h6>
                </div>
                <div class="card-body">
                <h6 class="font-weight-bold">APC Dr No: <span class="mt-0 text-success"><?php echo $result['apcdrno']; ?></span></h6>
                <h6 class="font-weight-bold">WM Dr No: <span class="mt-0 text-success"><?php echo $result['controlseries'].'-'.$result['wmdrno']; ?></span></h6>
                <h6 class="font-weight-bold">Facility :<span class="mt-0 text-success"><?php echo $result['facility']; ?></span></h6>
                <h6 class="font-weight-bold">Vehicle Plate No: <span class="mt-0 text-success"><?php echo $result['vehicleplate']; ?></span></h6>
                <h6 class="font-weight-bold">Date Out: <span class="mt-0 text-success"><?php echo date('F j, Y', strtotime($result['dateout'])); ?></span></h6>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Part No</th>
                            <th>Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
for ($i = 0; $i < $result['numrows']; $i++) {
    echo '<tr>
                                    <td>' . $result[$i]['PartNo'] . '</td>
                                    <td>' . $result[$i]['Qty'] . '</td>
                                    </tr>';
}
?>
                    </tbody>
                </table>
                </div>
            </div>
            <!-- End of SPM Inbound Item Table-->
        </div>
        <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->