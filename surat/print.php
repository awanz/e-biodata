<?php
    session_start();

    if (!empty($_SESSION)) {
        if ($_SESSION['login'] != "masuk") {
          header("Location: index.php");
        }
    }else{
        header("Location: index.php");
    }

    require('../assets/plugins/fpdf/fpdf.php');
    include_once("../includes/config.php");
    $id = $_GET['id'];
    if (empty($id)) {
        header("Location: index.php");
    }
    include_once("../includes/mysqlbase.php");
    $db = new MySQLBase($dbhost, $dbname, $dbuser, $dbpass);
    $result = $db->getBy("surat", "id", $id);
    
    if ($result->num_rows == 0) {
        header("Location: index.php");
    }
    $data = $result->fetch_assoc();
    
    $pdf = new FPDF('P','cm',array(21,33));
    $pdf->AddPage();
    $pdf->SetFont('Times','B',16);

    $pdf->SetX(2);
    $pdf->Cell(0,1,$data['nama']);
    $pdf->Ln(1);
    $pdf->SetFont('Times','',12);

    $pdf->SetX(2);
    $pdf->Cell(10,0, $data['tanggal']);
    $pdf->Ln(0.8);

    $pdf->SetX(2);
    $pdf->MultiCell(17,0.5, $data['alamat']);
    $pdf->Ln(0.8);

    $pdf->SetX(2);
    $pdf->MultiCell(17,0.4,$data['alasan']);
    $pdf->Ln(0.8);
    
    $pdf->SetX(2);
    $pdf->MultiCell(17,0.4,$data['keperluan']);
    $pdf->Ln(0.8);
    
    $pdf->Output();
?>