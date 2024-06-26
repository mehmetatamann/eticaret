<?php

class Insert
{
    private $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function insert($table, $data)
    {
        if (empty($data) || !array_filter($data)) {
            return false;
        }
        // Gönderilen veriler sırayla insert metoduna eklenecek şekilde uygun hale getirilir
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO `$table` ($columns) VALUES ($placeholders)";

        if ($this->conn) {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data);
            return $stmt->rowCount() > 0;
        }
    }
}
?>
<!-- // Veritabanına yeni kayıt eklemek için kullanılabilir. insert metodu, belirtilen tabloya ve verilere göre yeni bir kayıt ekler. -->