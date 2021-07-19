<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<ul class="nav nav-pills nav-sidebar flex-column nav-legacy" data-widget="treeview" role="menu" data-accordion="false">


    <li class="nav-item">
        <a href="<?php echo url('dashboard') ?>"
           class="nav-link <?php echo ($page->menu == 'dashboard') ? 'active' : '' ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                <?php echo lang('dashboard') ?>
            </p>
        </a>
    </li>

    <?php if (hasPermissions('muhasebe_raporlar')): ?>
        <li class="nav-item">
            <a href="<?php echo url('raporlar') ?>"
               class="nav-link <?php echo ($page->menu == 'raporlar') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Raporlar
                </p>
            </a>
        </li>
<?php endif; ?>

    <li class="nav-item">
        <a href="<?php echo url('starter') ?>"
           class="nav-link <?php echo ($page->menu == 'starter') ? 'active' : '' ?>">
            <i class="nav-icon fas fa-list"></i>
            <p>
                <?php echo lang('blank_page') ?>
            </p>
        </a>
    </li>

    <?php if (hasPermissions('users_list')): ?>
        <li class="nav-item">
            <a href="<?php echo url('users') ?>"
               class="nav-link <?php echo ($page->menu == 'users') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-user"></i>
                <p>
                    <?php echo lang('users') ?>
                </p>
            </a>
        </li>
    <?php endif ?>

    <?php if (hasPermissions('activity_log_list')): ?>
        <li class="nav-item">
            <a href="<?php echo url('activity_logs') ?>"
               class="nav-link <?php echo ($page->menu == 'activity_logs') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-history"></i>
                <p>
                    <?php echo lang('activity_logs') ?>
                </p>
            </a>
        </li>
    <?php endif ?>

    <?php if (hasPermissions('roles_list')): ?>
        <li class="nav-item">
            <a href="<?php echo url('roles') ?>"
               class="nav-link <?php echo ($page->menu == 'roles') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-lock"></i>
                <p>
                    <?php echo lang('manage_roles') ?>
                </p>
            </a>
        </li>
    <?php endif ?>

    <?php if (hasPermissions('permissions_list')): ?>
        <li class="nav-item">
            <a href="<?php echo url('permissions') ?>"
               class="nav-link <?php echo ($page->menu == 'permissions') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-user"></i>
                <p>
                    <?php echo lang('manage_permissions') ?>
                </p>
            </a>
        </li>
    <?php endif ?>


    <?php if (hasPermissions('backup_db')): ?>
        <li class="nav-item">
            <a href="<?php echo url('backup') ?>"
               class="nav-link <?php echo ($page->menu == 'backup') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-user"></i>
                <p>
                    <?php echo lang('backup') ?>
                </p>
            </a>
        </li>
    <?php endif ?>

    <?php if (hasPermissions('company_settings')): ?>
        <li class="nav-item has-treeview <?php echo ($page->menu == 'settings') ? 'menu-open' : '' ?>">
            <a href="#" class="nav-link  <?php echo ($page->menu == 'settings') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                    <?php echo lang('settings') ?>
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?php echo url('settings/general') ?>"
                       class="nav-link <?php echo ($page->submenu == 'general') ? 'active' : '' ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p> <?php echo lang('general_setings') ?> </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo url('settings/company') ?>"
                       class="nav-link <?php echo ($page->submenu == 'company') ? 'active' : '' ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>  <?php echo lang('company_setings') ?> </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo url('settings/email_templates') ?>"
                       class="nav-link <?php echo ($page->submenu == 'email_templates') ? 'active' : '' ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p> <?php echo lang('manage_email_template') ?></p>
                    </a>
                </li>
            </ul>
        </li>
    <?php endif ?>

    <?php if (hasPermissions('car_module')): ?>
        <li class="nav-item has-treeview <?php echo ($page->menu == 'arac-yonetimi') ? 'menu-open' : '' ?>">
            <a href="#" class="nav-link  <?php echo ($page->menu == 'arac-yonetimi') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-car"></i>
                <p>
                    Araçlar Yönetimi
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?php echo url('car/list') ?>"
                       class="nav-link <?php echo ($page->submenu == 'list') ? 'active' : '' ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Araç Listele </p>
                    </a>
                </li>

            </ul>
        </li>
    <?php endif ?>


</ul>