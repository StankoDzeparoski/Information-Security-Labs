<?php

$db = new SQLite3(__DIR__ . '/database/db.sqlite');

$createTableQuery = <<<SQL
CREATE TABLE IF NOT EXISTS usersTable (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT UNIQUE NOT NULL,
    email TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL
);
SQL;

if ($db->exec($createTableQuery)) {
    echo "Table created successfully.";
} else {
    echo "Error creating table: " . $db->lastErrorMsg();
}

$db->close();


?>