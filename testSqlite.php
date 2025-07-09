<?php
try {
    $db = new SQLite3(':memory:');
    $db->exec('CREATE TABLE test (id INTEGER PRIMARY KEY, name TEXT)');
    $db->exec("INSERT INTO test (name) VALUES ('Test Entry')");
    $result = $db->query('SELECT * FROM test');
    while ($row = $result->fetchArray()) {
        echo "ID: {$row['id']} Name: {$row['name']}<br>";
    }
    $db->close();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>