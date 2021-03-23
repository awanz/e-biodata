<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
  <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" width="50px" height="50px" src="https://adminlte.io/themes/dev/AdminLTE/dist/img/user2-160x160.jpg" alt="User Image">
    <div>
      <p class="app-sidebar__user-designation"><small>Selamat datang,</small></p>
      <p class="app-sidebar__user-name"><?= $_SESSION['username'] ?></p>
    </div>
  </div>
  <ul class="app-menu">
    <li><a class="app-menu__item" href="<?= base_url("dashboard.php") ?>"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
    <?php if ($_SESSION['level'] == 2) { ?>
    <li><a class="app-menu__item" href="<?= base_url("listbiodata.php") ?>"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">List Biodata</span></a></li>
    <?php } ?>
    <li><a class="app-menu__item" href="<?= base_url("biodata.php") ?>"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Biodata</span></a></li>
    <li><a class="app-menu__item" href="<?= base_url("surat") ?>"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Surat</span></a></li>
  </ul>
</aside>