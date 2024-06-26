<?php

$kul_isim = ""; 
$kul_soyisim = ""; 
$em = ""; 
$password = ""; 
$error_array = array();

if(isset($_POST['kayit'])){

    $kul_isim = strip_tags($_POST['reg_fname']);
    $kul_isim = str_replace(' ', '', $kul_isim); 
    $kul_isim = ucfirst(strtolower($kul_isim));
    $_SESSION['reg_fname'] = $kul_isim; 

    $kul_soyisim = strip_tags($_POST['reg_lname']);
    $kul_soyisim = str_replace(' ', '', $kul_soyisim); 
    $kul_soyisim = ucfirst(strtolower($kul_soyisim)); 
    $_SESSION['reg_lname'] = $kul_soyisim; 

    $em = strip_tags($_POST['reg_email']); 
    $em = str_replace(' ', '', $em); 
    $em = ucfirst(strtolower($em)); 
    $_SESSION['reg_email'] = $em; 


    $password = strip_tags($_POST['reg_password']); 
    $date = date("Y-m-d H:i:s");
    if(filter_var($em, FILTER_VALIDATE_EMAIL)) {

        $em = filter_var($em, FILTER_VALIDATE_EMAIL);

        $e_check_query = $conn->prepare("SELECT eposta FROM uyeler WHERE eposta = :eposta");
        $e_check_query->bindParam(":eposta", $em, PDO::PARAM_STR);
        $e_check_query->execute();
        $e_check_result = $e_check_query->fetchAll(PDO::FETCH_ASSOC);
        $num_rows = count($e_check_result);

        if($num_rows > 0) {
            array_push($error_array, "Email kayıtlı<br>");
        }

    }
    else {
        array_push($error_array, "Hatalı mail formatı<br>");
    }

    if(preg_match('/[^A-Za-z0-9]/', $password)) {
        array_push($error_array, "Şifre sadece İngilizce karakterler içermeli<br>");
    }


        $password = md5($password); 

            if (filter_var($em, FILTER_VALIDATE_EMAIL)) {

                $query = $conn->prepare("INSERT INTO uyeler (isim, soyisim, uye_tipi, eposta, sifre, uye_durum) VALUES (:isim, :soyisim, :eposta, :sifre, '0')");
                $query->bindParam(':isim', $kul_isim, PDO::PARAM_STR);
                $query->bindParam(':soyisim', $kul_soyisim, PDO::PARAM_STR);
                $query->bindParam(':eposta', $em, PDO::PARAM_STR);
                $query->bindParam(':sifre', $password, PDO::PARAM_STR);
                $query->execute();
                header("location:kayitol.php");           
            }

        $_SESSION['reg_fname'] = "";
        $_SESSION['reg_lname'] = "";
        $_SESSION['reg_email'] = "";
        $_SESSION['reg_email2'] = "";
    }


?>

<!-- kullanıcıların kayıt olmalarını sağlar -->