<?php
$con  = mysqli_connect('localhost','root','','reservation');
if(mysqli_connect_errno())
{
    echo 'Database Connection Error';
}
