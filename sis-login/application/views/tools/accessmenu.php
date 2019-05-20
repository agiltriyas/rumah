<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-lg-8">
            <?php if (validation_errors()) : ?>
                <?= validation_errors('<div class="alert alert-danger col-lg-8" role="alert">', '</div>'); ?>
            <?php endif; ?>
            <?= $this->session->flashdata('message'); ?>


            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#menuModal" id="addAccMenu">Add Sub Menu</button>
            <table class="table table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Role</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $query = "SELECT `user_menu`.`menu`, `user_access_menu`.* , `user_role`.`role`
                    FROM `user_access_menu` JOIN `user_menu`
                    ON `user_access_menu`.`menu_id`= `user_menu`.`id`
                    JOIN `user_role` ON `user_access_menu`.`role_id` = `user_role`.`id`
                    ";

                    $menu = $this->db->query($query)->result_array();
                    // var_dump($menu);
                    // die;

                    $i = 1; ?>
                    <?php foreach ($menu as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i ?></th>

                            <td><?= $m['menu']; ?></td>
                            <td><?= $m['role']; ?></td>
                            <td>
                                <a href="" class="badge badge-primary esubmenu" data-toggle="modal" data-target="#menuModal" data-id="<?= $m['id']; ?>">Edit</a>
                                <a href="deleteSubMenu/<?= $m['id']; ?>" class=" badge badge-danger" onclick="return confirm('Are You Sure ?')">Delete</a>

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
<div class=" modal fade" id="menuModal" tabindex="-1" role="dialog" aria-labelledby="menuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="menuModalLabel">Add Sub Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="#">
                    <div class="form-group">
                        <input type="text" name="id" value="" id="id">
                    </div>
                    <div class="form-group">
                        <?php
                        $result = $this->db->get('user_menu')->result_array();
                        ?>
                        <select class="form-control" id="menuId" name="menuId">
                            <option value="" disabled>Select Menu</option>
                            <?php foreach ($result as $sm) : ?>
                                <option value="<?= $sm['id'] ?>"><?= $sm['menu'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <?php
                        $result1 = $this->db->get('user_role')->result_array();
                        ?>
                        <select class="form-control" id="roleId" name="roleId">
                            <option value="" disabled>Select Role</option>
                            <?php foreach ($result1 as $sm) : ?>
                                <option value="<?= $sm['id'] ?>"><?= $sm['role'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="subMenu">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>