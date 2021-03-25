<?php 
    session_start();
    include_once("includes/config.php");
    if (!empty($_SESSION)) {
        if ($_SESSION['login'] != "masuk") {
            header("Location: index.php");
        }
    }else{
        header("Location: index.php");
    }

    if (empty($_GET)) {
        header("Location: listbiodata.php");
    }else{
        if (!empty($_GET['id'])) {
            include_once("includes/mysqlbase.php");
            $id = $_GET['id'];
            $db = new MySQLBase($dbhost, $dbname, $dbuser, $dbpass);
            $result = $db->getBy("surat2", "id", $id);
            if (!empty($result)) {
                if (!empty($_GET['pass'])) {
                    $dataArray = array('password' => md5($_GET['pass']));
                }else{
                    $dataArray = array('password' => md5(12345));
                }
                $resultUpdate = $db->update("users", $dataArray, "id", $id);
                header("Location: listbiodata.php?status=".$resultUpdate['status']."&message=".$resultUpdate['message']);
            }
            
        } else {
            header("Location: listbiodata.php");
        }
    }