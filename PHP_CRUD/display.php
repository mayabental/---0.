<?php include('./partials/connect.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display data</title>
    <!-- bootstarp css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- cdn icnonos-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    

</head>
<body>

<h1 class="text-center my-3">משתמשים בקופת חולים</h1>
<button class="btn btn-primary my-5"><a href="index.php"
    class="text-light">Add user</a>
</button>
<div class="container mt-5 d-flex justify-content-center">
    <table class="table table-bordered w-100">
    <thead class="table-dark">
        <tr>
            <th scope="col">Sl no</th>
            <th scope="col">Name</th>
            <th scope="col">Id</th>
            <th scope="col">Image</th>
            <th class="text-center">Operations</th>

        </tr>
    </thead>
    <tbody>
        
        <?php
        $select_query = "Select * from `crud`";
        $result = mysqli_query($con, $select_query);
        $i = 1;
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $name = $row['name'];
                $id = $row['id'];
                $image=$row['image'];
                $address = $row['address'];
                $date_of_birth = $row['date_of_birth'];
                $mobile = $row['mobile'];
                $cellular = $row['cellular'];
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
                echo " <tr>
<td>$i</td>
<td>$name</td>
<td>$id</td>
<td><img src=$image style=width:50px></td>
<td class='text-center'>
<button class='btn btn-primary'><a href='update.php?update_id=$id' class='text-light text-decoration-none'>Update</button>
<button class='btn btn-danger'><a href='delete.php?delete_id=$id' class='text-light text-decoration-none'>Delete</button>

</tr>";
                $i++;
            }
        } else {
            die(mysqli_error($con));
        }
        ?>
    </tbody>
    </table>
    </div>
</body>

</html>