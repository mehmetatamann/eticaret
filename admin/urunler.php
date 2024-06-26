<?php include 'menu.php'; 


if(isset($_GET['urun_id'])){
    $comment_id = $_GET['urun_id'];

    $delete = new Delete($conn);
    if ($delete->delete('urunler', ['urun_id' => $comment_id])) {
        header("locaiton: urunler.php");
        echo "Ürün başarıyla silindi.";
    } else {
        echo "Ürün silinirken bir hata oluştu.";
    }
}

$select = new Select($conn);
$rows = $select->select('urunler');

?>
<div class="container mt-5">
    <h2 class="mb-4">Ürünler Listesi</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Başlık</th>
                <th scope="col">Açıklama</th>
                <th scope="col">Görsel</th>
                <th scope="col">Fiyat</th>
                <th scope="col">İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <?php if($rows): ?>
                <?php foreach($rows as $row): ?>
                    <tr>
                        <th scope="row"><?= htmlspecialchars($row['urun_id']) ?></th>
                        <td><?= htmlspecialchars($row['urun_title']) ?></td>
                        <td><?= htmlspecialchars($row['urun_aciklama']) ?></td>
                        <td><?= htmlspecialchars($row['urun_img']) ?></td>
                        <td><?= htmlspecialchars($row['urun_fiyat']) ?></td>

                        <td>
                            <a href="guncelle.php?type=news&urun_id=<?= $row['urun_id'] ?>" class="btn btn-sm btn-primary">Güncelle</a>
                            <a href="?urun_id=<?= $row['urun_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Ürün bulunamadı.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>

<!-- admin panelinde ürünlerin güncellenmesi ve silinmesi bu sayfa üzerinden yapılır -->