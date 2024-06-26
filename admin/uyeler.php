<?php include 'menu.php'; 


if(isset($_GET['uye_id'])){
    $comment_id = $_GET['uye_id'];

    $delete = new Delete($conn);
    if ($delete->delete('uyeler', ['uye_id' => $comment_id])) {
        header("locaiton: uyeler.php");
        echo "Yorum başarıyla silindi.";
    } else {
        echo "Yorum silinirken bir hata oluştu.";
    }
}

$select = new Select($conn);
$users = $select->select('uyeler');

?>
<div class="container mt-5">
    <h2 class="mb-4">Kullanıcı Listesi</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">İsim</th>
                <th scope="col">Soyisim</th>
                <th scope="col">E-posta</th>
                <th scope="col">Şifre</th>
                <th scope="col">İşlemler</th>

            </tr>
        </thead>
        <tbody>
            <?php if($users): ?>
                <?php foreach($users as $user): ?>
                    <tr>
                        <th scope="row"><?= htmlspecialchars($user['uye_id']) ?></th>
                        <td><?= htmlspecialchars($user['isim']) ?></td>
                        <td><?= htmlspecialchars($user['soyisim']) ?></td>

                        <td><?= htmlspecialchars($user['eposta']) ?></td>
                        <td><?= htmlspecialchars($user['sifre']) ?></td>
                        <td>
                        <a href="guncelle.php?type=uye&uye_id=<?= $user['uye_id'] ?>" class="btn btn-sm btn-primary">Güncelle</a>
                            <a href="?uye_id=<?= $user['uye_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Kullanıcı bulunamadı.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- admin paneli üzerinden üye yetkileri ve durumları değiştirilebilir -->