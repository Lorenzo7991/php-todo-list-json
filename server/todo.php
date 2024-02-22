<?php

// Path to the JSON file containing ToDo data
$file_path = __DIR__ . '/../shared/tasks.json';

// Check the HTTP request method
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // GET request for reading data

    // Read the content of the JSON file
    $json_data = file_get_contents($file_path);

    // Decode the JSON into an associative array
    $todos = json_decode($json_data, true);

    // Check if decoding was successful
    if ($todos === null) {
        // Handle JSON decoding error
        die("Error decoding JSON file.");
    }

    // Set the header to indicate JSON content
    header('Content-Type: application/json');

    // Return ToDo data as JSON
    echo json_encode($todos);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // POST request for adding a new task

    // Read the current content of the JSON file
    $json_data = file_get_contents($file_path);

    // Decode the JSON into an associative array
    $todos = json_decode($json_data, true);

    // Check if decoding was successful
    if ($todos === null) {
        // Handle JSON decoding error
        die("Error decoding JSON file.");
    }

    //Data todo, sent via POST request
    $new_todo = $_POST['todo'];

    // Add the new ToDo to the ToDo array
    $todos[] = $new_todo;

    // Encode the updated array into JSON
    $json_data = json_encode($todos);

    // Write data to the JSON file
    if (file_put_contents($file_path, $json_data)) {
        // Return a success confirmation
        echo "Data written successfully to JSON file.";
    } else {
        // Handle JSON writing error
        echo "Error writing to JSON file.";
    }
}

?>