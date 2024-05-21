<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "appointments";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service = $_POST["service"];
    $doctor = $_POST["doctor"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $appointment_date = $_POST["appointment_date"];
    $appointment_time = $_POST["appointment_time"];

    $appointment_date = date('Y-m-d', strtotime($_POST["appointment_date"]));

    $sql = "INSERT INTO appointments (service, doctor, name, email, appointment_date, appointment_time)
            VALUES ('$service', '$doctor', '$name', '$email', '$appointment_date', '$appointment_time')";

if ($conn->query($sql) === TRUE) {
    echo "Appointment successfully scheduled!";
    header("Location: index.html");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}

$conn->close();
?>
