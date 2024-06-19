<?php 
if(isset($_POST['fname']) && isset($_POST['uname']) && isset($_POST['pass'])){
    include "../db_conn.php";

    // Sanitize user inputs
    $fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
    $uname = filter_input(INPUT_POST, 'uname', FILTER_SANITIZE_STRING);
    $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);

    $data = "fname=".$fname."&uname=".$uname;

    if (empty($fname)) {
        $em = "Full name is required";
        header("Location: ../index.php?error=$em&$data");
        exit;
    } else if (empty($uname)) {
        $em = "User name is required";
        header("Location: ../index.php?error=$em&$data");
        exit;
    } else if (empty($pass)) {
        $em = "Password is required";
        header("Location: ../index.php?error=$em&$data");
        exit;
    } else {
        // Hashing the password
        $pass = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users(fname, username, password) 
                VALUES(?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$fname, $uname, $pass]);

        header("Location: ../index.php?success=Your account has been created successfully");
        exit;
    }
} else {
    header("Location: ../index.php?error=error");
    exit;
}
?>
