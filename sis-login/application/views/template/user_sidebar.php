<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <i class="fas fa-rainbow"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Profile</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <?php
    $roleId = $this->session->userdata('role_id');
    $query = "SELECT `menu`,`user_menu`.`id`
                FROM `user_access_menu` JOIN `user_menu` 
                  ON `user_access_menu`.`menu_id` = `user_menu`.`id`
               WHERE `role_id` = $roleId;
        ";
    $menu = $this->db->query($query)->result_array();
    // var_dump($menu);
    // die;
    ?>

    <?php foreach ($menu as $m) : ?>
        <div class="sidebar-heading">
            <?= $m['menu']; ?>
        </div>
        <?php
        $menuId = $m['id'];
        $querySub = "SELECT * FROM `user_sub_menu` WHERE `menu_id`=$menuId AND `is_active` = 1";
        $subMenu = $this->db->query($querySub)->result_array();

        ?>
        <?php foreach ($subMenu as $sm) : ?>
            <!-- Nav Item - Dashboard -->
            <?php if ($sm['title'] == $title) { ?>
                <li class='nav-item active' style="margin-bottom:-15px;">
                <?php } else { ?>
                <li class="nav-item" style="margin-bottom:-15px;">
                <?php } ?>

                <a class="nav-link" href="<?= base_url($sm['url']) ?>">
                    <i class="<?= $sm['icon']; ?>"></i>
                    <span><?= $sm['title']; ?></span></a>
            </li>
        <?php endforeach; ?>
        <!-- Divider -->
        <hr class="sidebar-divider mt-1">
    <?php endforeach; ?>


    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout') ?>">
            <i class="fas fa-users"></i>
            <span>Log Out</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->