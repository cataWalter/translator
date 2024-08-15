<?php
// init_db.php
try {
    $db = new PDO('sqlite:languages.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $db->exec('CREATE TABLE IF NOT EXISTS languages (
        language_code TEXT PRIMARY KEY
    )');
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>