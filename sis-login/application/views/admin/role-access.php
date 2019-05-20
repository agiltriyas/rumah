<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-lg-6">

            <?= $this->session->flashdata('message'); ?>


            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addRole" id="addRole">Add Role</button>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $result = $this->db->get('user_role')->result_array();
                    $i = 1; ?>
                    <?php foreach ($result as $r) : ?>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td><?= $r['role']; ?></td>
                            <td>
                                <a href="<?= base_url('admin/accessMenu/') . $r['id'] ?>" class="badge badge-warning">Access</a>
                                <a href="" class="badge badge-primary" data-toggle="modal" data-target="#menuModal">Edit</a>
                                <a href="tools/deleteMenu/<?= $r['id']; ?>" class=" badge badge-danger" onclick="return confirm('Are You Sure ?')">Delete</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class=" modal fade" id="addRole" tabindex="-1" role="dialog" aria-labelledby="addRoleLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRoleLabel">Add Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="#">
                    <div class="form-group">
                        <input type="text" name="id" value="" id="id">
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Enter new menu">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="subMenu">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>