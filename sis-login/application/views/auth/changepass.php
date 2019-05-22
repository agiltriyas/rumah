<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Enter Your New Password</h1>
                                </div>
                                <form method="post" action="<?= base_url('auth/chpass') ?>">
                                    <div class="form-group">
                                        <input type="text" value="<?= $verify ?>" name="email" hidden>
                                        <label for="nPass">New Password</label>
                                        <input type="password" class="form-control" id="nPass" name="nPass">
                                        <?= form_error('nPass', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="nPass2">Confirm Password</label>
                                        <input type="password" class="form-control" id="nPass2" name="nPass2">
                                        <?= form_error('nPass2', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>