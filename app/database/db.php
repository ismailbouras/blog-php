<?php

require("connect.php");

function dd($value)
{
    echo "<pre>", print_r($value, true), "</pre>";
    die();
}

function selectAll($table, $conditions = [])
{
    global $conn;
    $sql = "SELECT * FROM $table";
    if (empty($conditions)) {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    } else {
        $i = 0;
        foreach ($conditions as $key => $value) {
            if ($i === 0) {
                $sql = $sql . " WHERE $key=$value";
            } else {
                $sql = $sql . " AND $key=$value";
            }
            $i++;
        }
        dd($sql);
    }
}

$conditions = [
    'admine' => 1,
    'username' => 'ismail'
];

$users = selectAll('users');
dd($users);
