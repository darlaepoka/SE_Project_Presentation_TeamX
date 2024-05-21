 <?php

use PHPUnit\Framework\TestCase;

class appointmentsTest extends TestCase
{
    private $conn;

public function setUp(): void
{
    // Create database connection
    $this->conn = new mysqli("localhost", "enton", "@Enton@2334", "dental_clinic");
    if ($this->conn->connect_error) {
        die("Connection failed: ". $this->conn->connect_error);
    }
}


    public function tearDown(): void
    {
        // Close the database connection
        $this->conn->close();
    }

    public function testCreateAppointment()
    {
        $appointment = new Appointment($this->conn);
        $result = $appointment->create("John Doe", "johndoe@example.com", "Dr. Smith", "Check-up", "2023-03-15", "10:00");
        $this->assertTrue($result);
    }

    

    public function testEditAppointment()
    {
        $appointment = new Appointment($this->conn);
        $result = $appointment->edit(7, "Jane Doe", "janedoe@example.com", "Dr. Johnson", "Follow-up", "2023-03-16", "11:00");
        $this->assertTrue($result);
    }

    public function testDeleteAppointment()
    {
        $appointment = new Appointment($this->conn);
        $result = $appointment->delete(8);
        $this->assertTrue($result);
    }

    public function testGetAppointments()
    {
        $appointment = new Appointment($this->conn);
        $result = $appointment->getAll();
        $this->assertNotEmpty($result);
    }
}

class Appointment
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function create($name, $email, $doctor, $service, $date, $time)
    {
        $query = "INSERT INTO appointments (name, email, doctor, service, appointment_date, appointment_time) VALUES (?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssss", $name, $email, $doctor, $service, $date, $time);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    public function edit($id, $name, $email, $doctor, $service, $date, $time)
    {
        $query = "UPDATE appointments SET name =?, email =?, doctor =?, service =?, appointment_date =?, appointment_time =? WHERE id =?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssssi", $name, $email, $doctor, $service, $date, $time, $id);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    public function delete($id)
    {
        $query = "DELETE FROM appointments WHERE id =?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    public function getAll()
    {
        $query = "SELECT * FROM appointments";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}