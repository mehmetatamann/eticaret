<?php 

class Update
{
    private $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function update($table, $data, $where)
    {
        if (empty($data) || !array_filter($data) || empty($where)) {
            return false;
        }

        // Datalar için boş bir dizin oluştur
        $setExpressions = [];
        foreach ($data as $key => $value) {
            // Bu dizinin içini gönderilen datalar ile doldurur
            $setExpressions[] = "`$key` = :$key";
        }

        // datalar sorgulara uygun hale getirilir.
        $setClause = implode(", ", $setExpressions);

        $whereExpressions = [];
        foreach ($where as $key => $value) {
            // bir where sorgusu var ise bunuda ekler.
            $whereExpressions[] = "`$key` = :where_$key";
        }
        $whereClause = implode(" AND ", $whereExpressions);

        $sql = "UPDATE `$table` SET $setClause WHERE $whereClause";

        try {
            $stmt = $this->conn->prepare($sql);
            
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            foreach ($where as $key => $value) {
                $stmt->bindValue(":where_$key", $value);
            }

            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo "Sorgu hatası: " . $e->getMessage();
            return false;
        }
    }
}

?>

<!-- Verilen tablo, veri ve koşullar doğrultusunda bir UPDATE SQL sorgusu çalıştırır ve güncellemenin başarılı olup olmadığını döner. -->