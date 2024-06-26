<?php
class User {
	private $user;
	private $conn;

	public function __construct($conn, $user){
        $this->conn = $conn;
        $user_details_query = $this->conn->prepare("SELECT * FROM uyeler WHERE uye_id = ?");
        $user_details_query->execute([$user]);
        $this->user = $user_details_query->fetch();
	}

	public function getUsername() {
		return $this->user['uye_id'];
	}

	public function getFirstAndLastName() {
		$username = $this->user['uye_id'];
		$query = $this->conn->prepare("SELECT isim, soyisim FROM uyeler WHERE uye_id = ?");
		$query->execute([$username]);
		$row = $query->fetch(PDO::FETCH_ASSOC);
		return $row['isim'] . " " . $row['soyisim'];
	}

	public function registrationYear() {
		return $this->user['sistem_kayit_tarih'];
	}


	// Admin girişi için önemli
	public function yetki_kontrol() {
        return $this->user['uye_yetki'] == 1;
    }

	public function isClosed() {
		$username = $this->user['uye_id'];
		$query = $this->conn->prepare("SELECT uye_durum FROM uyeler WHERE uye_id = ?");
		$query->execute([$username]);
		$row = $query->fetch(PDO::FETCH_ASSOC);

		if($row['uye_durum'] == 'yes')
			return true;
		else 
			return false;
	}
    public function getYetki() {
        return $this->user['uye_yetki'];
    }
}

?>

<!-- kullanıcı bilgilerini almak ve kullanıcı yetkilerini kontrol etmek için kullanılabilir. Veritabanı bağlantısını ($conn) ve kullanıcı ID'sini ($user) alarak çalışır. -->