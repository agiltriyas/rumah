<!-- Begin Page Content -->
<div class="container-fluid">

    <h3>Edit Profile</h3>
    <div class="row mt-4">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
            <?php echo form_open_multipart('user/edit'); ?>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" value="<?= $sesdata['email']; ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $sesdata['nama']; ?>">
                    <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2">Picture</div>
                <div class="col-lg-10">
                    <div class="col-lg-4 pl-0 float-left">
                        <img src="<?= base_url('asets/img/profile/') . $sesdata['image'] ?>" class="img-thumbnail" name="picture">
                    </div>
                    <div class="col-lg-8 pr-0 pl-0 float-left">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="picture" name="picture">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3 justify-content-end">
                <div class="col-lg-4 pr-0">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->