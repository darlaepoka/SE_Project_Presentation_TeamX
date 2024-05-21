<?php
require_once('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userIdToUpdate = $_POST['user_id'];
    $userName = $_POST['name'];
    $userEmail = $_POST['email'];
    $userDoctor = $_POST['doctor'];
    $userService = $_POST['service'];
    $userDate = $_POST['date'];
    $userTime = $_POST['time'];

    // Update the record in the database
    $updateQuery = "UPDATE appointments SET name='$userName', email='$userEmail', doctor='$userDoctor', service='$userService', appointment_date='$userDate', appointment_time='$userTime' WHERE id = $userIdToUpdate";
    $updateResult = mysqli_query($conn, $updateQuery);

    // Check if the update was successful
    if ($updateResult) {
        header('Location: appointments.php'); // Redirect back to the appointments page
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    if (isset($_GET['id'])) {
        $userIdToEdit = $_GET['id'];

        // Retrieve the record from the database
        $query = "SELECT * FROM appointments WHERE id = $userIdToEdit";
        $result = mysqli_query($conn, $query);

        // Check if the record exists
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $userName = $row['name'];
            $userEmail = $row['email'];
            $userDoctor = $row['doctor'];
            $userService = $row['service'];
            $userDate = $row['appointment_date'];
            $userTime = $row['appointment_time'];
        } else {
            echo "Record not found.";
            exit();
        }
    } else {
        echo "Invalid request.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Record</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Edit Record</div>
                <div class="card-body">
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="user_id" value="<?php echo $userIdToEdit; ?>">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $userName; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $userEmail; ?>">
                        </div>
                        <div class="form-group">
                            <label for="doctor">Doctor:</label>
                            <input type="text" class="form-control" id="doctor" name="doctor" value="<?php echo $userDoctor; ?>">
                        </div>
                        <div class="form-group">
                            <label for="service">Service:</label>
                            <input type="text" class="form-control" id="service" name="service" value="<?php echo $userService; ?>">
                        </div>
                        <div class="form-group">
                            <label for="date">Date:</label>
                            <input type="date" class="form-control" id="date" name="date" value="<?php echo $userDate; ?>">
                        </div>
                        <div class="form-group">
                            <label for="time">Time:</label>
                            <input type="time" class="form-control" id="time" name="time" value="<?php echo $userTime; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="appointments.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>