<!-- Begin Page Content -->

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">SP Mamplasan Hub Inventory Monitoring</h1>

    <div class="row">
        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-2">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Add New Item</div>
                            <a href="<?php echo base_url('dashboard/spmhubinventoryadditem');?>"
                                class="btn btn-success btn-icon-split">
                                <span class="text">Add Item</span>
                            </a>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-plus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-2">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Hub Item Count</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $stockCount; ?> Pcs</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add New SPM Hub Item -->
    <!-- <div class="card shadow mb-4 border-bottom-primary">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Item</h6>
        </div>
        <div class="card-body">
            <form class="form-inline" id="addspmitem">
                <label for="partno">Part No</label>
                <div class="input-group" style="margin-left: 6px; margin-right: 6px;">
                    <input type="text" name="partno" id="partno" class="form-control" palceholder="Add new item">
                </div>
                <button type="submit" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="text">Submit</span>
                </button>
                <small id="spmadditemmessage" class="ml-2 form-text"></small>
            </form>
        </div>
    </div> -->
    <!-- End of Add New SPM Hub Item -->

    <!-- SPM Hub Item Table -->
    <div class="card shadow mb-4 border-bottom-primary">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Hub Inventory</h6>
        </div>
        <div class="card-body">
            <form class="form-inline mb-2 float-left" method="post">
                <label for="partno">Search</label>
                <div class="input-group" style="margin-left: 6px; margin-right: 6px;">
                    <input type="text" name="searchItem" id="searchItem" class="form-control" placeholder="Part No.">
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
                        <option <?php echo($selectedEntries == 10 ? 'selected="selected"' : null); ?>>10</option>
                        <option <?php echo($selectedEntries == 25 ? 'selected="selected"' : null); ?>>25</option>
                        <option <?php echo($selectedEntries == 50 ? 'selected="selected"' : null); ?>>50</option>
                        <option <?php echo($selectedEntries == 100 ? 'selected="selected"' : null); ?>>100</option>
                    </select>
                </div>
                <label for="partno">Entries</label>
            </form>

            <table class="table table-bordered table-striped table-hover">
                <caption><?php echo $totalrows;?> Items <?php echo $pagelinks;?></caption>
                <thead class="thead-dark">
                    <tr>
                        <th>Part No.</th>
                        <th>Stock on Hand</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
foreach ($tabledata as $rows) {
    echo '<tr>';
    echo '<td scope="row">' . $rows['PartNo'] . '</td>';
    echo '<td>' . $rows['StockOnHand'] . '</td>';
    echo '</tr>';
}
?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- End of SPM Hub Item Table-->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->