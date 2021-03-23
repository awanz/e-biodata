<?php
    session_start();

    if ($_SESSION['level'] != 2) {
        header("Location: index.php");
    }

    require('assets/plugins/fpdf/fpdf.php');
    include_once("includes/config.php");
    $id = $_GET['id'];
    if (empty($id)) {
        header("Location: index.php");
    }
    include_once("includes/mysqlbase.php");
    $db = new MySQLBase($dbhost, $dbname, $dbuser, $dbpass);
    $result = $db->getBy("biodata", "id", $id);
    
    if ($result->num_rows == 0) {
        header("Location: index.php");
    }
    $data = $result->fetch_assoc();
    
    $pdf = new FPDF('P','cm',array(21,33));
    $pdf->AddPage();
    $pdf->SetFont('Times','B',16);
    $pdf->Image('assets/images/biodata/ef4528acd1b53ff64f6a3331358a9585.jpg',1,1,4,6);

    $pdf->SetX(5.5);
    $pdf->Cell(10,0.5,$data['fullname']);
    $pdf->Ln(1);
    $pdf->SetFont('Times','',12);

    $pdf->SetX(5.5);
    $pdf->Cell(10,0,"NIK: " . $data['nik']);
    $pdf->Ln(0.8);

    $pdf->SetX(5.5);
    $pdf->Cell(10,0,"No Whatsapp: 0" . $data['whatsapp']);
    $pdf->Ln(0.8);

    $pdf->SetX(5.5);
    $pdf->Cell(10,0,"Tempat Lahir: " . $data['tempat_lahir']);
    $pdf->Ln(0.8);

    $pdf->SetX(5.5);
    $pdf->Cell(10,0,"Jenis Kelamin: " . $data['jenis_kelamin']);
    $pdf->Ln(0.8);
    
    $pdf->Output();
?>