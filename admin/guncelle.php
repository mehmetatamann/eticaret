<?php include 'menu.php';

if(isset($_POST['haber_update'])){
    $uploadDir = '../assets/imgs/';
    
    if (!empty($_FILES['image']['name'])) {
        $uploadPath = $uploadDir . basename($_FILES['image']['name']);
    
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
            $imagePathInDatabase = $uploadPath;
        } else {
            echo "Dosya yükleme hatası.";
            exit; 
        }
    } else {
        $imagePathInDatabase = null; 
    }
    $data = [];

    if (!empty($_POST['title'])) {
        $data['urun_title'] = $_POST['title'];
    }

    if (!empty($_POST['comment'])) {
        $data['urun_aciklama'] = $_POST['comment'];
    }

    if (!empty($_POST['price'])) {
        $data['urun_fiyat'] = $_POST['price'];
    }

    if (!is_null($imagePathInDatabase)) {
        $data['urun_img'] = $imagePathInDatabase;
    }

    $sql = "UPDATE urunler SET ";

    $setExpressions = [];
    foreach ($data as $key => $value) {
        $setExpressions[] = "`$key` = :$key";
    }

    $sql .= implode(", ", $setExpressions);
    $sql .= " WHERE urun_id = :news_id";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':news_id', $_GET['urun_id']);

    foreach ($data as $key => $value) {
        $stmt->bindValue(":$key", $value);
    }

    if ($stmt->execute()) {
        $current_url = $_SERVER['REQUEST_URI'];
        header("Location: $current_url");
        exit;
    } else {
        echo "Haber güncelleme işlemi başarısız oldu.";
    }
}

if (isset($_POST['uye_update'])) {

    $uye_id = $_POST['uye_id'];
    $isim = $_POST['isim'];
    $soyisim = $_POST['soyisim'];
    $eposta = $_POST['eposta'];
    $yetki = $_POST['yetki'];
    $sifre = md5($_POST['sifre']);

    $update = new Update($conn); 
    $table = 'uyeler'; 
    $data = [
        'isim' => $isim,
        'soyisim' => $soyisim,
        'eposta' => $eposta,
        'uye_yetki' => $yetki,
        'sifre' => $sifre
    ];
    $where = ['uye_id' => $uye_id];
    $success = $update->update($table, $data, $where);

    if ($success) {
        echo "Üye bilgileri başarıyla güncellendi.";
        $current_url = $_SERVER['REQUEST_URI'];
        header("Location: $current_url");
    } else {
        echo "Üye bilgileri güncelleme işlemi başarısız oldu.";
    }
}


$select = new Select($conn);
if (isset($_GET['urun_id'])) {
    $news_id = $_GET['urun_id'];

    $sql = "SELECT * FROM urunler WHERE urun_id = $news_id";
    $stmt = $conn->query($sql);

    if ($stmt) {
        $haber = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($haber && isset($haber['urun_title'])) {
            echo $haber['urun_title'];
        } else {
            echo "Haber bulunamadı.";
        }
    } else {
 
    }
} else {
}

if (isset($_GET['uye_id'])) {
    $uye_id = $_GET['uye_id'];

    $sql = "SELECT * FROM uyeler WHERE uye_id = $uye_id";
    $stmt = $conn->query($sql);

    if ($stmt) {
        $uye = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {

    }
} else {
}

?>

<div class="container mt-5">

<?php 
if($_GET['type'] == "news") {
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="mb-4">Ürün Güncelle</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="fiyat">Başlık:</label>
                <input type="text" class="form-control" id="fiyat" name="title" value='<?= $haber['urun_title']?>'>
            </div>
            <div class="form-group">
                <label for="fiyat">İçerik:</label>
                <input type="text" class="form-control" id="fiyat" name="comment" value='<?= $haber['urun_aciklama']?>'>
            </div>
            <div class="form-group">
                <label for="fiyat">Fiyat:</label>
                <input type="text" class="form-control" id="fiyat" name="price" value='<?= $haber['urun_fiyat']?>'>
            </div>
            <div class="form-group">
                <label for="image">Resim Yükle:</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>
            <input class="btn btn-primary" type="submit" value="Güncelle" name="haber_update">
        </form>
    </div>
</div>
<?php 
}else if($_GET['type'] == "uye") {
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="mb-4">Üye Güncelle</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="uye_id">Üye ID:</label>
                <input type="text" class="form-control" id="uye_id" name="uye_id" value="<?= htmlspecialchars($uye['uye_id']) ?>">
            </div>
            <div class="form-group">
                <label for="isim">İsim:</label>
                <input type="text" class="form-control" id="isim" name="isim" value="<?= htmlspecialchars($uye['isim']) ?>">
            </div>
            <div class="form-group">
                <label for="soyisim">Soyisim:</label>
                <input type="text" class="form-control" id="soyisim" name="soyisim" value="<?= htmlspecialchars($uye['soyisim']) ?>">
            </div>
            <div class="form-group">
                <label for="eposta">E-posta:</label>
                <input type="email" class="form-control" id="eposta" name="eposta" value="<?= htmlspecialchars($uye['eposta']) ?>">
            </div>
            <div class="form-group">
                <label for="yetki">Yetki:</label>
                <input type="number" class="form-control" id="yetki" name="yetki" value="<?= htmlspecialchars($uye['uye_yetki']) ?>">
            </div>
            <div class="form-group">
                <label for="sifre">Şifre:</label>
                <input type="password" class="form-control" id="sifre" name="sifre" value="<?= $uye['sifre'] ?>">   
            </div>
            <input class="btn btn-primary" type="submit" value="Güncelle" name="uye_update">
        </form>

    </div>
</div>

<?php
}
?>


</div>

<!-- bu bölümde admin paneli üzerinden ürün güncelleştirmeleri yapılabilir. -->