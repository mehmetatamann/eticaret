<?php 
require_once '../config.php';
include '../includes/classes/user-class.php';
include '../includes/classes/class-insert.php';
include '../includes/classes/class-select.php';
include '../includes/classes/class-update.php';
include '../includes/classes/class-delete.php';   


if (!isset($_SESSION['username'])) {
    header("Location: ../kayitol.php");
    exit();
}

$user_id = $_SESSION['username'];

try {
    // Kullanıcı bilgilerini veritabanından çek
    $query = $conn->prepare("SELECT uye_yetki FROM uyeler WHERE uye_id = ?");
    $query->execute([$user_id]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        throw new Exception("Kullanıcı bulunamadı.");
    }

    // Kullanıcı yetkisini kontrol et
    if ($user['uye_yetki'] != 1) {
        header("Location: ../");
        exit();
    }

    echo "Admin sayfasına hoş geldiniz!";
    // Admin'e özel kodlar buraya yazılır

} catch (Exception $e) {
    echo $e->getMessage();
}



?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../assets/lib/bootstrap/css/bootstrap.min.css">
    <title>Kullanıcı Menüsü</title>
    <style>
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            background-color: #333;
            position: fixed;
            left: 0;
            top: 0;
            height: 100%;
            width: 150px;
            overflow: hidden;
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        li {
            text-align: center;
        }

        li a {
            display: block;
            color: white;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover {
            background-color: #111;
        }
    </style>
</head>
<body>

<?php
$menu_items = array(
    array("url" => "urunler.php", "title" => "Urunler"),
    array("url" => "urun_ekle.php", "title" => "Urun Ekle"),
    array("url" => "uyeler.php", "title" => "Üyeler"),

    array("url" => "../", "title" => "Çıkış"), 
);

echo "<ul>";
foreach ($menu_items as $item) {
    echo "<li><a href='" . $item["url"] . "'>" . $item["title"] . "</a></li>";
}
echo "</ul>";
?>

</body>
</html>

<!-- yönetici ana sayfasını oluşturur -->