<?php
// Get the raw POST data
$json = file_get_contents('php://input');

// Decode the JSON data into a PHP associative array
$data = json_decode($json, true);

if ($data) {
    $name = $data['name'];
    $description = $data['description'];
    $dependencies = $data['dependencies'];

    // Process the data (e.g., save it to a database)
    // For now, let's just return a success message
    echo json_encode([
        'status' => 'success',
        'message' => 'Test created successfully!'
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid JSON data'
    ]);
}
?>
