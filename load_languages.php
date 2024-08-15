<?php
// Database connection settings
$dsn = 'sqlite:languages.db';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
];

try {
    // Create a new PDO instance
    $pdo = new PDO($dsn, null, null, $options);

    // Fetch the languages from the database
    $stmt = $pdo->query("SELECT code FROM languages");
    $languages = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Return the languages as JSON
    echo json_encode($languages);
} catch (PDOException $e) {
    // Return an error message as JSON
    echo json_encode(['error' => $e->getMessage()]);
}
?>
