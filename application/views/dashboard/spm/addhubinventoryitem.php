<!-- Begin Page Content -->

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">SP Mamplasan Hub Inventory Monitoring</h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard');?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard/spmhubinventory');?>">SPM Hub Inventory</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add New Item</li>
        </ol>
    </nav>

    <!-- Add New SPM Hub Item -->
    <div class="card shadow mb-4 border-bottom-primary">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Item</h6>
        </div>
        <div class="card-body">
            <form class="form-inline" id="addspmitem" >
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
    </div>
    <!-- End of Add New SPM Hub Item-->
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->