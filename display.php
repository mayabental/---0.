<?php
include 'connect.php';?>

<!DOCTYPE html>
<html lang="an">

<head>
    <meta charset="UFT-8">
    <meta http-equiv="X_UA-Compatible" contebt="IE=edge">
    <meta name="viewport" content="width=device-width,
        initial-scale=1.0">
    <title>Crud operation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>


    <div class="container">
    <button class="btn btn-primary my-5"><a href="user.php"
    class="text-light">Add user</a>
    
</button>
<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Id</th>
      <th scope="col">Operations</th>
    </tr>
  </thead>
  <tbody>

  
  <?php 
$sql="Select * from `crud`";
$result=mysqli_query($con,$sql);
if($result){
    while($row=mysqli_fetch_assoc($result)){
        $name=$row['name'];
        $id=$row['id'];
        $address=$row['address'];
        $date_of_birth=$row['date_of_birth'];
        $phone=$row['phone'];
        $cellphone=$row['cellphone'];
        $first_vaccine=$row['first_vaccine'];
        $second_vaccine=$row['second_vaccine'];
        $third_vaccine=$row['third_vaccine'];
        $fourth_vaccine=$row['fourth_vaccine'];
        $first_manufacture=$row['first_manufacture'];
        $second_manufacture=$row['second_manufacture'];
        $third_manufacture=$row['third_manufacture'];
        $fourth_manufacture=$row['fourth_manufacture'];
        $Positive_date=$row['Positive_date'];
        $recovery_date=$row['recovery_date'];
        echo '<tr>
        <th scope="row">'.$name.'</th>
        <td>'.$id.'</td>
  

        <td> 
        <button class="btn btn-primary"><a href="update.php?
        updateid='.$id.'" 
        class="text-light">Update</a></button>
        <button class="btn btn-danger"><a href="delete.php?
        deleteid='.$id.'" class="text-light">Delete</a></button>
        </td>
      </tr>';
    }

}
  ?>

  </tbody>
</table>
</div>

</body>

</html>