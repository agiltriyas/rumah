</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout') ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('asets') ?>/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('asets') ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('asets') ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('asets') ?>/js/sb-admin-2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#addMenu').on('click', function() {
            $('#menu').val('');
            $('.form-group #id').hide();
        })

        $('.emenu').on('click', function() {
            $('.modal-header h5').html('Edit Menu');
            $('.modal-footer button').html('Save Changes');
            $('.modal-body form').attr('action', '<?= base_url("tools/editMenu") ?>');
            $('.form-group #id').hide();

            const id = $(this).data('id');
            $.ajax({
                url: '<?= base_url("tools/getMenu") ?>',
                data: {
                    id: id
                },
                dataType: 'json',
                method: 'post',
                success: function(data) {
                    const namaMenu = data['menu'];
                    const idMenu = data['id'];
                    $('#menu').val(namaMenu);
                    $('#id').val(idMenu);
                }
            })
        });

        $('#addSubMenu').on('click', function() {
            // $('#menuId').html('');
            $('#subTitle').val('');
            $('#subIcon').val('');
            $('#subUrl').val('');
            $('#id').hide();

        })

        $('.esubmenu').on('click', function() {
            $('#id').hide();
            $('.modal-title').html('Edit Sub Menu');
            $('.modal-footer button').html('Save Changes');
            $('.modal-body form').attr('action', '<?= base_url("tools/editSubMenu") ?>');

            const id = $(this).data('id');

            $.ajax({
                url: '<?= base_url("tools/getSubMenu") ?>',
                data: {
                    id: id
                },
                dataType: 'json',
                method: 'post',
                success: function(data) {
                    $('#id').val(data['id']);
                    let meid = data['menu_id'];
                    $('option').removeAttr("selected");
                    $('option[value$=' + meid + ']').attr("selected", "selected");
                    $('#subTitle').val(data['title']);
                    $('#subIcon').val(data['icon']);
                    $('#subUrl').val(data['url']);
                }

            })
        })

        $('#addAccMenu').on('click', function() {
            $('#id').hide();
        })

        $('.cekAccess').on('click', function() {

            const role = $(this).data('role');
            const menu = $(this).data('menu');

            // console.log(role);
            // console.log(menu);

            $.ajax({
                url: '<?= base_url("admin/setMenu") ?>',
                method: 'post',
                data: {
                    role: role,
                    menu: menu
                },
                success: function() {
                    window.location.href = '<?= base_url("admin/accessMenu/") ?>' + role;
                }
            });


        })
    });
</script>
</body>

</html>