<?php
require_once('database.php');

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $description = $_POST['description'];
    $ch_date = $_POST['availability'];

    // Insert the data into the `choice` table
    $stmt = mysqli_prepare($dbc, "INSERT INTO choice (name, address, phone_number, category_id, city_id, description, ch_date, activation) VALUES (?, ?, ?, 8, ?, ?, ?, 'not active')"); 
    mysqli_stmt_bind_param($stmt, "sssiss", $name, $address, $phone_number, $city, $description, $ch_date);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Close the database connection
    $dbc->close();
    header('Location: contact_us.php');
}

?>

