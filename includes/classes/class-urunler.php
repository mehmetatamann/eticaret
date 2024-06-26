<?php 

class Urunler {

    protected $conn;

    public function __construct(PDO $conn) {
        $this->conn = $conn;
    }
    
    public function urun_listele() {
        $select = new Select($this->conn);

        $news = $select->select('urunler');
        $i = 0;
        foreach($news as $row) {
            $i++;
            echo '<div class="col-md-4 mb-4" data-id="'.$i.'" data-name="'.$row['urun_title'].'" data-price="'.$row['urun_fiyat'].'">';
            echo '<div class="card m-2" style="max-width:500px;object-fit:cover;">';
            echo '  <img style="height:200px;" src="blog/'.$row['urun_img'].'" class="card-img-top" alt="...">';
            echo '  <div class="card-body">';
            echo '    <h5 class="card-title">'.$row['urun_title'].'</h5>';
            echo '   <p class="card-text" style="font-size:13px;">'.$row['urun_aciklama'].'</p>';
            echo '    <h5 class="card-title">'.$row['urun_fiyat'].'₺</h5>';
            echo '    <button class="btn btn-primary" onclick="addToCart(this)">Sepete Ekle</button>';
            echo '  </div>';
            echo '</div>';
            echo '</div>';

        }
    }


}

?>

<!-- ürünlerin dinamik olarak web sayfasında listelenmesi için kullanılır ve her bir ürünü, kullanıcıların sepete ekleyebilmesi için gerekli HTML yapısıyla birlikte ekrana basar. -->