<?php 
include('connection.php');

// Validate and sanitize user input
$username = mysqli_real_escape_string($con, $_POST['username']);
$vehicle = mysqli_real_escape_string($con, $_POST['vehicle']);
$parknum = mysqli_real_escape_string($con, $_POST['parknum']);
$date = mysqli_real_escape_string($con, $_POST['date']);

// Check if parknum already exists
$check_sql = "SELECT COUNT(*) as count FROM `reserve` WHERE `parknum` = ?";
$check_stmt = mysqli_prepare($con, $check_sql);
mysqli_stmt_bind_param($check_stmt, "s", $parknum);
mysqli_stmt_execute($check_stmt);
mysqli_stmt_bind_result($check_stmt, $count);
mysqli_stmt_fetch($check_stmt);
mysqli_stmt_close($check_stmt);

if ($count > 0) {
    // Parknum already exists, notify user and do not proceed
    $data = array(
        'status' => 'exists',
        'message' => 'A reservation for this parking number already exists.'
    );
    echo json_encode($data);
} else {
    // Proceed with inserting the reservation
    $sql = "INSERT INTO `reserve` (`username`,`vehicle`,`parknum`,`date`) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);

    if ($stmt) {
        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "ssss", $username, $vehicle, $parknum, $date);

        // Execute the prepared statement
        $query = mysqli_stmt_execute($stmt);

        if ($query) {
            $lastId = mysqli_insert_id($con);
            $data = array(
                'status' => 'true'
            );
            echo json_encode($data);
        } else {
            $data = array(
                'status' => 'false',
                'message' => 'Failed to insert reservation.'
            );
            echo json_encode($data);
        }
    } else {
        // Handle the case where the prepared statement could not be created
        $data = array(
            'status' => 'false',
            'message' => 'Failed to prepare statement.'
        );
        echo json_encode($data);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Close the connection
mysqli_close($con);
?>
