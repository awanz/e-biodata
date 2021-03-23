<?php 
    session_start();
    if ($_SESSION['level'] != 2) {
      header("Location: index.php");
    }
    $status = null;
    $notif = null;
    include_once("includes/config.php");
    if (!empty($_GET)) {
      if (!empty($_GET['message'])) {
        $status = $_GET['status'];
        $notif = $_GET['message'];
      }
    }

    if (!empty($_SESSION)) {
      if ($_SESSION['login'] != "masuk") {
        header("Location: index.php");
      }
    }else{
      header("Location: index.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Wizhart.">
    <title>Biodata List</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body class="app sidebar-mini">
    <?php include_once("includes/header.php"); ?>
    <?php include_once("includes/sidebar.php"); ?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-users"></i> Biodata Lists</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="#">Biodata</a></li>
          <li class="breadcrumb-item"><a href="#">Lists</a></li>
        </ul>
      </div>
      <div class="row">
      <div class="col-md-12">
      
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
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama Lengkap</th>
                      <th>Tempat Lahir</th>
                      <th>NIK</th>
                      <th>Whatsapp</th>
                      <th>Photo</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      include 'includes/mysqlbase.php';
                      $db = new MySQLBase($dbhost, $dbname, $dbuser, $dbpass, $dbcharset);
                      $result = $db->getAll("biodata");
                      $no = 1;
                      foreach ($result as $r) {
                    ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $r['fullname'] ?></td>
                      <td><?= $r['tempat_lahir'] ?></td>
                      <td><?= $r['nik'] ?></td>
                      <td><a href="https://wa.me/62<?= $r['whatsapp'] ?>" target="_BLANK">0<?= $r['whatsapp'] ?></a></td>
                      <td>
                        <img src="assets/images/biodata/<?= $r['photo'] ?>" alt="" width="64px">
                      </td>
                      <td> 
                        <a target="_BLANK" href="pdf.php?id=<?= $r['id'] ?>">PDF</a>
                    </tr>
                    <?php $no++; } ?>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="assets/js/plugins/pace.min.js"></script>
    <!-- Data table plugin-->
    <script type="text/javascript" src="assets/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
  </body>
</html>