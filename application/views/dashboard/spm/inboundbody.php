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
            <div class="card shadow mb-4 border-bottom-primary">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Inbound Inventory</h6>
                </div>
                <div class="card-body">
                    <form class="form-inline mb-2 float-left" method="post">
                        <label for="partno">Search</label>
                        <div class="input-group" style="margin-left: 6px; margin-right: 6px;">
                            <input type="text" name="searchItem" id="searchItem" class="form-control"
                                placeholder="AR No." required>
                        </div>
                        <button type="submit" class="btn btn-success btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-search"></i>
                            </span>
                            <span class="text">Submit</span>
                        </button>
                    </form>

                    <form class="form-inline mb-2 float-right" id="showEntries" method="get">
                        <label for="partno">Show</label>
                        <div class="input-group" style="margin-left: 6px; margin-right: 6px;">
                            <select class="form-control" id="selectEntries" name="show_entries">
                                <option <?php echo($selectedEntries == 10 ? 'selected="selected"' : null); ?>>10
                                </option>
                                <option <?php echo($selectedEntries == 25 ? 'selected="selected"' : null); ?>>25
                                </option>
                                <option <?php echo($selectedEntries == 50 ? 'selected="selected"' : null); ?>>50
                                </option>
                                <option <?php echo($selectedEntries == 100 ? 'selected="selected"' : null); ?>>100
                                </option>
                            </select>
                        </div>
                        <label for="partno">Entries</label>
                    </form>

                    <table class="table table-bordered table-striped table-hover">
                        <caption><?php echo $totalrows; ?> Items <?php echo $pagelinks; ?></caption>
                        <thead class="thead-dark">
                            <tr>
                                <th>Details</th>
                                <th>Acknowledgement Receipt No.</th>
                                <th>Date In</th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php
            foreach ($tabledata as $rows) {
                echo '<tr>';
                echo '<td scope="row"><a class="btn btn-primary btn-block" href="' . base_url('dashboard/viewspminbounddetails/' . $rows['InboundId']) . '" role="button">View Details</a></td>';
                echo '<td scope="row">' . $rows['ArNo'] . '</td>';
                echo '<td>' . date('F j, Y', strtotime($rows['DateIn'])) . '</td>';
                echo '</tr>';
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