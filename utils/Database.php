<?php

class Database {
    private static $conn = null;

    public static function getConnection() {
        if (self::$conn === null) {
            self::$conn = new \PDO(
                "mysql:host=localhost;dbname=lanchonete",
                'root',
                ''
            );
        }
        return self::$conn;
    }

    public static function selectAll($table) {
        $conn = self::getConnection();
        $stmt = $conn->query("SELECT * FROM $table");
        return $stmt->fetchAll();
    }

    public static function select($table, $columns, $conditions = []) {
        $conn = self::getConnection();
        
        $query = "SELECT " . implode(', ', $columns) . " FROM $table";

        if (!empty($conditions)) {
            $where = [];
            foreach ($conditions as $column => $value) {
                $where[] = "$column = ?";
            }
            $query .= " WHERE " . implode(' AND ', $where);
        }

        $stmt = $conn->prepare($query);
        $stmt->execute(array_values($conditions));

        return $stmt->fetchAll();
    }

    public static function insert($table, $data) {
        $conn = self::getConnection();

        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));

        $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        
        $stmt = $conn->prepare($query);
        $stmt->execute(array_values($data));

        return $conn->lastInsertId();
    }

    public static function update($table, $data, $conditions) {
        $conn = self::getConnection();

        $setColumns = [];
        foreach ($data as $column => $value) {
            $setColumns[] = "$column = ?";
        }

        $where = [];
        foreach ($conditions as $column => $value) {
            $where[] = "$column = ?";
        }

        $setQuery = implode(', ', $setColumns);
        $whereQuery = implode(' AND ', $where);

        $query = "UPDATE $table SET $setQuery WHERE $whereQuery";

        $stmt = $conn->prepare($query);
        $values = array_merge(array_values($data), array_values($conditions));
        $stmt->execute($values);

        return $stmt->rowCount();
    }

    public static function delete($table, $conditions) {
        $conn = self::getConnection();

        $where = [];
        foreach ($conditions as $column => $value) {
            $where[] = "$column = ?";
        }

        $query = "DELETE FROM $table WHERE " . implode(' AND ', $where);
        
        $stmt = $conn->prepare($query);
        $stmt->execute(array_values($conditions));

        return $stmt->rowCount();
    }

    public static function rawQuery($query){
        $conn = self::getConnection();

        $stmt = $conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function join($mainTable, $mainColumn, $joinTable, $joinColumn, $selectColumns, $conditions = []) {
        $conn = self::getConnection();

        $selectCols = implode(', ', $selectColumns);
        $query = "SELECT $selectCols FROM $mainTable
                  INNER JOIN $joinTable ON $mainTable.$mainColumn = $joinTable.$joinColumn";

        if (!empty($conditions)) {
            $where = [];
            foreach ($conditions as $column => $value) {
                $where[] = "$mainTable.$column = ?";
            }
            $query .= " WHERE " . implode(' AND ', $where);
        }

        $stmt = $conn->prepare($query);
        $stmt->execute(array_values($conditions));

        return $stmt->fetchAll();
    }
}

?>