<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-lg-6">

            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

            <?= $this->session->flashdata('message'); ?>


            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#menuModal" id="addMenu">Add Menu</button>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $menu = $this->db->get('user_menu')->result_array();
                    $i = 1; ?>
                    <?php foreach ($menu as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td><?= $m['menu']; ?></td>
                            <td>
                                <a href="" class="badge badge-primary emenu" data-toggle="modal" data-target="#menuModal" data-id="<?= $m['id']; ?>">Edit</a>
                                <a href="tools/deleteMenu/<?= $m['id']; ?>" class=" badge badge-danger" onclick="return confirm('Are You Sure ?')">Delete</a>

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
                <h5 class="modal-title" id="menuModalLabel">Add Menu</h5>
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