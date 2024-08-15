<?php
// Database connection settings
$dsn = 'sqlite:languages.db';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
];

try {
    // Create a new PDO instance
    $pdo = new PDO($dsn, null, null, $options);

    // Get the input data
    $data = json_decode(file_get_contents('php://input'), true);

    // Check if languages are provided
    if (isset($data['languages']) && is_array($data['languages'])) {
        $languages = $data['languages'];

        // Begin a transaction
        $pdo->beginTransaction();

        // First, delete all existing records
        $pdo->exec("DELETE FROM languages");

        // Prepare an SQL statement for insertion
        $stmt = $pdo->prepare("INSERT INTO languages (code) VALUES (:code)");

        // Insert each language code into the database
        foreach ($languages as $code) {
            $stmt->execute(['code' => $code]);
        }

        // Commit the transaction
        $pdo->commit();

        // Return a JSON response indicating success
        echo json_encode(['success' => true]);
    } else {
        // Return a JSON response indicating failure
        echo json_encode(['success' => false, 'message' => 'Invalid data']);
    }
} catch (PDOException $e) {
    // Return a JSON response indicating failure
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
