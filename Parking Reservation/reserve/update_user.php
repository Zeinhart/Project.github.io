<?php 
include('connection.php');
$username = $_POST['username'];
$vehicle = $_POST['vehicle'];
$parknum = $_POST['parknum'];
$date = $_POST['date'];
$id = $_POST['id'];

$sql = "UPDATE `reserve` SET  `username`='$username' , `vehicle`= '$vehicle', `parknum`='$parknum', `date`='$date'  WHERE id='$id' ";
$query= mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);
if($query ==true)
{
   
    $data = array(
        'status'=>'true',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'false',
      
    );

    echo json_encode($data);
} 

?>