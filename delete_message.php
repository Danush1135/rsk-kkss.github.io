<?php
require_once('Connections/rsk_kkss.php');

// Database connection
$conn = new mysqli($hostname_rsk_kkss, $username_rsk_kkss, $password_rsk_kkss, $database_rsk_kkss);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['ID'])) {
    // Get the ID from the URL
    $id = $_GET['ID'];

    // Delete query
    $query = "DELETE FROM mesej WHERE ID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirect back to the message list page after successful deletion
        header("Location: message_list.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
