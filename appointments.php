<?php
require_once('connection.php');

$query = "SELECT * FROM appointments";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>View Records</title>
    <style>
        body {
            background-color: #343a40;
            color: #fff;
        }

        .card {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-top: 50px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            color: #fff;
        }

        table, th, td {
            border: 1px solid #dee2e6;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        a.btn {
            color: #fff;
        }

        a.btn-pencil {
            background-color: #28a745;
        }

        a.btn-danger {
            background-color: #dc3545;
        }
    </style>
</head>
<body class="bg-dark">

    <div class="container">
        <div class="row">
            <div class="col m-auto">
                <div class="card mt-5">
                <div class="text-right">
                        <a href="logout.php" class="btn btn-danger">Logout</a>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <td> User ID </td>
                            <td> User Name </td>
                            <td> User Email </td>
                            <td> Doctor </td>
                            <td> Service </td>
                            <td> Date  </td>
                            <td> Time </td>
                            <td> Edit  </td>
                            <td> Delete </td>
                        </tr>

                        <?php 
                        while($row = mysqli_fetch_assoc($result)) {
                            $UserID = $row['id'];
                            $UserName = $row['name'];
                            $UserEmail = $row['email'];
                            $UserDoctor = $row['doctor'];
                            $UserService = $row['service'];
                            $UserDate = $row['appointment_date'];
                            $UserTime = $row['appointment_time'];
                            ?>
                            <tr>
                                <td><?php echo $UserID ?></td>
                                <td><?php echo $UserName ?></td>
                                <td><?php echo $UserEmail ?></td>
                                <td><?php echo $UserDoctor ?></td>
                                <td><?php echo $UserService ?></td>
                                <td><?php echo $UserDate ?></td>
                                <td><?php echo $UserTime ?></td>
                                <td><a href="edit.php?id=<?php echo $UserID; ?>" class="btn btn-pencil">Edit</a></td>
                                <td><a href="delete.php?id=<?php echo $UserID; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a></td>
                            </tr>        
                            <?php 
                        }  
                        mysqli_close($conn); // Close the database connection
                        ?>                                                                    

                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
