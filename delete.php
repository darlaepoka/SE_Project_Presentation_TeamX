<?php
require_once('connection.php');

if (isset($_GET['id'])) {
    $userIdToDelete = $_GET['id'];

    // Perform the deletion
    $deleteQuery = "DELETE FROM appointments WHERE id = $userIdToDelete";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    // Check if the deletion was successful
    if ($deleteResult) {
        header('Location: appointments.php'); // Redirect back to the appointments page
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
