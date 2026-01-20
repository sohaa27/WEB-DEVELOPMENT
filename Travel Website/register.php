<?php
$conn = mysqli_connect("localhost", "root", "", "travel_db");
if (!$conn) {
    die("Database connection failed");
}

// User data
$name = $_POST['myname1'];
$email = $_POST['myemail'];
$password = password_hash($_POST['mypassword'], PASSWORD_DEFAULT);

// Insert user
$user_sql = "INSERT INTO users (name, email, password)
VALUES ('$name', '$email', '$password')";

if (!mysqli_query($conn, $user_sql)) {
    die("Email already registered. Please login.");
}

$user_id = mysqli_insert_id($conn);

// Travel data
$phone = $_POST['myphone'];
$age = $_POST['myage'];
$gender = $_POST['mygender'];
$departure = $_POST['departuredate'];
$return = $_POST['returndate'];
$package = $_POST['package'];

// FIX: check if destination selected
if (isset($_POST['td'])) {
    $destinations = implode(", ", $_POST['td']);
} else {
    $destinations = "Not Selected";
}

$travel_sql = "INSERT INTO registrations
(user_id, phone, age, gender, departure, return_date, destination, package)
VALUES
('$user_id', '$phone', '$age', '$gender', '$departure', '$return', '$destinations', '$package')";

mysqli_query($conn, $travel_sql);

echo "<h2>Registration Successful</h2>
<a href='login.html'>Login Here</a>";

mysqli_close($conn);
?>
