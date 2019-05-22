<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Profile Administrator</h1>
    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
            <form method="post" action="<?= base_url('user/changePass') ?>">
                <div class="form-group">
                    <label for="cPass">Current Password</label>
                    <input type="password" id="cPass" name="cPass" class="form-control">
                    <?= form_error('cPass', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="nPass">New Password</label>
                    <input type="password" class="form-control" id="nPass" name="nPass">
                    <?= form_error('nPass', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="nPass2">Confirm Password</label>
                    <input type="password" class="form-control" id="nPass2" name="nPass2">
                    <?= form_error('nPass2', '<small class="text-danger">', '</small>'); ?>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->