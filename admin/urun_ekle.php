<?php include 'menu.php';

if(isset($_POST['urun_ekle'])){
    $baslik = strip_tags($_POST['title']);
    $icerik = strip_tags($_POST['comment']);
    $price = strip_tags($_POST['price']);

    $dosyaYolu = '../assets/imgs/'; 
    $dosyaAdi = $_FILES['image']['name']; 
    $geciciDosya = $_FILES['image']['tmp_name']; 

    if (move_uploaded_file($geciciDosya, $dosyaYolu . $dosyaAdi)) {
        $insert = new Insert($conn);
        $data = [
            'urun_title' => $baslik,
            'urun_aciklama' => $icerik,
            'urun_fiyat' => $price,
            'urun_img' => $dosyaYolu . $dosyaAdi 
        ];

        if ($insert->insert('urunler', $data)) {
            header("Location: urunler.php");
            exit; 
        } else {
            echo "Veri eklenirken bir hata oluştu.";
        }
    } else {
        echo "Dosya yükleme hatası.";
    }
}
?>

<div class="container mt-5">
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="mb-4">Ürün Ekle</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="fiyat">Başlık:</label>
                <input type="text" class="form-control" id="fiyat" name="title" value='' required>
            </div>
            <div class="form-group">
                <label for="fiyat">İçerik:</label>
                <input type="text" class="form-control" id="fiyat" name="comment" value='' required>
            </div>
            <div class="form-group">
                <label for="fiyat">Fiyat:</label>
                <input type="text" class="form-control" id="fiyat" name="price" value='' required>
            </div>
            <div class="form-group">
                <label for="image">Resim Yükle:</label>
                <input type="file" class="form-control-file" id="image" name="image" required>
            </div>
            <input class="btn btn-primary" type="submit" value="Güncelle" name="urun_ekle">
        </form>
    </div>
</div>
</div>

<!-- yönetici panelinden yeni bir ürün eklemek için kullanılırlar -->