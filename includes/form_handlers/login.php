<?php
if(isset($_POST['giris'])) {
    $email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL); 
    $password = md5($_POST['log_password']); 

    $check_database_query = $conn->prepare("SELECT * FROM uyeler WHERE eposta = :eposta AND sifre = :sifre");
    $check_database_query->bindParam(":eposta", $email, PDO::PARAM_STR);
    $check_database_query->bindParam(":sifre", $password, PDO::PARAM_STR);
    $check_database_query->execute();
    $check_database_result = $check_database_query->fetchAll(PDO::FETCH_ASSOC);
    $check_login_query = count($check_database_result);

    if($check_login_query == 1) {
        $row = $check_database_result[0];
        $username = $row['uye_id'];


            $user_closed_query = $conn->prepare("SELECT * FROM uyeler WHERE eposta = :eposta AND uye_durum = '1'");
            $user_closed_query->bindParam(":eposta", $email, PDO::PARAM_STR);
            $user_closed_query->execute();
            $user_closed_result = $user_closed_query->fetchAll(PDO::FETCH_ASSOC);

            if (count($user_closed_result) == 1) {
                $reopen_account = $conn->prepare("UPDATE uyeler SET uye_durum='0' WHERE eposta = :eposta");
                $reopen_account->bindParam(":eposta", $email, PDO::PARAM_STR);
                if (!$reopen_account->execute()) {
                    echo "Hesap yeniden açma hatası: " . $reopen_account->errorInfo()[2];
                }
            }

            $_SESSION['username'] = $username;

        header("Location: index.php");
        exit();
    } else {
        header("Location: kayitol.php");
    }
}

?>

<!-- Kullanıcı girişinin yapılmasını sağlar ve istenen değerleri kontrol eder. -->