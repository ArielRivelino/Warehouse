<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url() ?>">
        <div class="sidebar-brand-icon">
            <!-- <i class="fas fa-laugh-wink"></i> -->
            <img src="<?= base_url('assets/img/logo.png'); ?>" alt="Logo" style="width: 100%">
        </div>
        <div class="sidebar-brand-text mx-3">Warehouse Application</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?php echo site_url() ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <?php
        $q = $this->User_access_model->get_where(array("t_access.role_id" => $_SESSION['role_id']));
        $res = $q->result();
        $data_menu = [];
        foreach ($res as $row) {
            //print_r($row);
            /*$data_menu[$row->type][] = array(
                                                "menu_id" => $row->menu_id,
                                                "menu_name" => $row->menu_name,
                                                "aksi" => $row->aksi,
                                                );*/
            $data_menu[$row->type][] = $row->menu_id;
        }
        //print_r($data_menu);
    ?>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <?php
        $q = $this->Menu_model->get_parent();
        $res = $q->result();
        foreach ($res as $row):
            if(array_key_exists($row->menu_id, $data_menu)):
                $q2 = $this->Menu_model->get_childern($row->menu_id);
                if($q2->num_rows()>0):
                    $res2 = $q2->result();
    ?>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#<?= str_replace(" ", "_", $row->menu_name); ?>" aria-expanded="true" aria-controls="collapseTwo">
                            <i class="fas fa-fw <?= $row->url; ?>"></i>
                            <span><?= $row->menu_name; ?></span>
                        </a>
                        <div id="<?= str_replace(" ", "_", $row->menu_name); ?>" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <?php foreach($res2 as $row2): 
                                     if(in_array($row2->menu_id, $data_menu[$row->menu_id])):
                                ?>
                                    <a class="collapse-item" href="<?= base_url($row2->url) ?>"><?= $row2->menu_name; ?></a>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </li>
                <?php else: ?>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= $row->url; ?>">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span><?= $row->menu_name; ?></span>
                    </a>
                </li>
                <?php endif; ?>
            <?php endif; ?>
    <?php endforeach; ?>
    <!-- Nav Item - Pages Collapse Menu -->
    

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->