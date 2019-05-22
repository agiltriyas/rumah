<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-lg-6">

            <?= $this->session->flashdata('message'); ?>


            <h5><?= $role['role']; ?></h5>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Access</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $this->db->where('id !=', 1);
                    $result = $this->db->get('user_menu')->result_array();
                    $i = 1; ?>
                    <?php foreach ($result as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td><?= $m['menu']; ?></td>
                            <td>
                                <div class="custom-control custom-switch">
                                    <?php
                                    $result2 = $this->db->get_where('user_access_menu', [
                                        'role_id' => $role['id'],
                                        'menu_id' => $m['id'],
                                    ]);
                                    ?>
                                    <?php if ($result2->num_rows() == 1) : ?>
                                        <input class="custom-control-input cekAccess" type="checkbox" id="cekAccess<?= $m['id'] ?>" checked="checked" data-role="<?= $role['id']; ?>" data-menu="<?= $m['id']; ?>">
                                        <label class="custom-control-label" for="cekAccess<?= $m['id'] ?>"></label>
                                    <?php else : ?>
                                        <input class="custom-control-input cekAccess" type="checkbox" id="cekAccess<?= $m['id'] ?>" data-role="<?= $role['id']; ?>" data-menu="<?= $m['id']; ?>">
                                        <label class="custom-control-label" for="cekAccess<?= $m['id'] ?>"></label>
                                    <?php endif; ?>
                                </div>
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