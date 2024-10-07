<?php
    header('Content-Type: application/json');
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
      require_once(".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "database" . DIRECTORY_SEPARATOR . "DBManager.php");

      $json = file_get_contents('php://input');

      // Decode the JSON data into a PHP associative array
      $data = json_decode($json, true);

      if ($data) {
          // Do something with the received data (e.g., store it, process it)
          // For example, let's just return the received JSON as a response
          echo json_encode([
              'status' => 'success',
              'received_data' => $data
          ]);
      } else {
          echo json_encode([
              'status' => 'error',
              'message' => 'Invalid JSON data'
          ]);
      }
    exit();

    }
?>