<!-- Begin Page Content -->

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">SP Mamplasan Inbound Inventory Monitoring</h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard');?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard/spminboundmonitoring');?>">SPM Inbound
                    Inventory</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Inbound Details</li>
        </ol>
    </nav>

    <!-- Add New SPM Hub Item -->
    <div class="card shadow mb-4 border-bottom-primary col-lg-8">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">New Inbound Details</h6>
        </div>
        <div class="card-body">

            <form method="post">
                <div class="form-group row">
                    <label for="arno" class="col-sm-3 col-lg-4 col-form-label">Acknowledgement Receipt No.</label>
                    <div class="col-sm-9 col-lg-8"><input type="text" class="form-control" id="arno"></div>
                </div>
                <div class="form-group row">
                    <label for="datein" class="col-sm-3 col-lg-4 col-form-label">Date In</label>
                    <div class="col-sm-9 col-lg-8"><input type="date" class="form-control" id="datein"></div>
                </div>
                <fieldset class="border p-1 mb-4 py-2 px-2">
                    <legend class="w-auto">Add Items</legend>

                    <div class="container px-3">
                        <div class="row">
                            <input type="text" id="finditem" class="form-control col-lg-4 mr-2">
                            <button type="button" class="btn btn-info mb-2" onclick="addInboundListItem()">Add
                                Item</button>
                        </div>
                    </div>


                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Remove</th>
                                <th scope="col">Part No.</th>
                                <th scope="col">Quantity</th>
                            </tr>
                        </thead>
                        <tbody id="itemlistbody">
                            <tr id="noitem">
                                <td colspan="3">Please Insert Item(s)</td>
                            </tr>
                            <!-- <tr>
                                <td><button type="button" class="btn btn-danger btn-block"
                                        onclick="deleteInboundItem(this)">Remove</button></td>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                            </tr> -->
                        </tbody>
                    </table>

                    <!-- <div id="inbounditems">
                        <div class="form-group row">
                            <label for="partno" class="col-sm-3 col-lg-4 col-form-label">Part No.</label>
                            <div class="col-sm-9 col-lg-8"><input type="text" name="partno[]" class="form-control"
                                    id="partno"></div>
                        </div>
                        <div class="form-group row">
                            <label for="qty" class="col-sm-3 col-lg-4 col-form-label">Quantity</label>
                            <div class="col-sm-9 col-lg-8"><input type="text" name="itemqty[]" class="form-control"
                                    id="qty"></div>
                        </div>
                    </div> -->
                </fieldset>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>

        </div>
    </div>
    <!-- End of Add New SPM Hub Item-->
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->