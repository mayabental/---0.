<?php

$con=new mysqli('localhost','root','','bootstrapcrud');
if(!$con){
    die(mysqli_error($con));
}

?>

<!-- Read README.md to know where MySQL database password can be seen -->