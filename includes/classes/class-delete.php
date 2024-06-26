<?php

class Delete
{
    private $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function delete($table, $condition)
    {
        if (empty($condition) || !is_array($condition)) { //condition: silme işleminin gerçekleştirileceği koşulların bir dizi olarak belirtilmesi
            return false;
        }

        $where = '';
        foreach ($condition as $key => $value) {
            $where .= "$key = :$key AND ";
        }
        $where = rtrim($where, ' AND ');

        $sql = "DELETE FROM `$table` WHERE $where";

        if ($this->conn) {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($condition);
            return $stmt->rowCount() > 0;
        }
    }
}
?>

<!-- veritabanından belirli bir tablodan belirli koşullara göre veri silmeyi sağlar. -->