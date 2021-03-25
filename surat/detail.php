<?php 
  session_start();
  include_once("../includes/config.php");
  $status = null;
  $notif = null;

  if (!empty($_GET)) {
    if (!empty($_GET['message'])) {
      $status = $_GET['status'];
      $notif = $_GET['message'];
    }
  }

  if (!empty($_SESSION)) {
    if ($_SESSION['login'] != "masuk") {
      header("Location: ../index.php");
    }
  }else{
    header("Location: ../index.php");
  }
  include_once("../includes/mysqlbase.php");
  $db = new MySQLBase($dbhost, $dbname, $dbuser, $dbpass);
  
    $resultData = $db->getBy("surat", "id", $_SESSION['user_id']);
    $dataEdit = null;
    if ($resultData->num_rows) {
        $dataEdit = $resultData->fetch_assoc();
    }else{
        header("Location: list.php?status=0&message=Data not found");
    }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>Surat Detail</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body class="app sidebar-mini">
    <?php include_once("../includes/header.php"); ?>
    <?php include_once("../includes/sidebar.php"); ?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-users"></i> Surat</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="#">Surat</a></li>
          <li class="breadcrumb-item"><a href="#">Detail</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form action="" method="POST" enctype="multipart/form-data">
            <div class="tile">
                <?php 
                  if (!empty($notif)) {
                    if ($status == 0) {
                      echo '<div class="alert alert-danger" role="alert"><center>';
                      echo $notif;
                      echo "</center></div>";
                    } 
                    if ($status == 1) {
                      echo '<div class="alert alert-primary" role="alert"><center>';
                      echo $notif;
                      echo "</center></div>";
                    } 
                  }
                ?>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-3">Nama:</div>
                                <div class="col-lg-9"><?= $dataEdit['nama'] ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-3">Alamat:</div>
                                <div class="col-lg-9"><?= $dataEdit['alamat'] ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-3">Keperluan:</div>
                                <div class="col-lg-9"><?= $dataEdit['keperluan'] ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-3">Alasan:</div>
                                <div class="col-lg-9"><?= $dataEdit['alasan'] ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-3">Tanggal:</div>
                                <div class="col-lg-9"><?= $dataEdit['tanggal'] ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-3">Status:</div>
                                <div class="col-lg-9">
                                    <?php if($dataEdit['status'] == 1){ echo "Aktif"; } ?>
                                    <?php if($dataEdit['status'] == 0){ echo "Tidak Aktif"; } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </form>
        </div>
      </div>
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="../assets/js/plugins/pace.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/bootstrap-datepicker.min.js"></script>

  </body>
</html>