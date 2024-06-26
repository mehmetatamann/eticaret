<?php

class Select
{
    private $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function select($table, $where = null)
    {
        $sql = "SELECT * FROM `$table`";
    
        if ($where !== null) {
            // Bir where koşulu var mı var ise sorguya ekle.
            $sql .= " WHERE $where";
        }
    
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
    
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $result;
        } catch (PDOException $e) {
            echo "Sorgu hatası: " . $e->getMessage();
            return false;
        }
    }

    public function getLastInsertId()
    {
        return $this->conn->lastInsertId();
    }
    
    
}
?>
<!-- Bu sınıf, veritabanından veri seçmek ve son eklenen kaydın ID'sini almak için kullanılabilir. -->