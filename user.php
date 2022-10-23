<?php
function isValidIsraeliID($id)
{
    $id = trim($id);
    if (strlen($id) > 9 or strlen($id) < 5 or !is_numeric($id)) return false;
    $id = strlen($id) < 9 ? str_pad($id, 9, '0', STR_PAD_LEFT) : $id;
    $id_12_digits = array(1, 2, 1, 2, 1, 2, 1, 2, 1);
    $res = 0;
    for ($i = 0; $i < strlen($id); $i++) {
        $num = $id[$i] * $id_12_digits[$i];
        $num = ($num / 10) + ($num % 10);
        if ($num >= 10) $res += $num;
    }
    return (0 == $res % 10);
}

include 'connect.php';
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $id = $_POST['id'];
    $address = $_POST['address'];
    $date_of_birth = $_POST['date_of_birth'];
    $phone = $_POST['phone'];
    $cellphone = $_POST['cellphone'];
    $first_vaccine = $_POST['first_vaccine'];
    $second_vaccine = $_POST['second_vaccine'];
    $third_vaccine = $_POST['third_vaccine'];
    $fourth_vaccine = $_POST['fourth_vaccine'];
    $first_manufacture = $_POST['first_manufacture'];
    $second_manufacture = $_POST['second_manufacture'];
    $third_manufacture = $_POST['third_manufacture'];
    $fourth_manufacture = $_POST['fourth_manufacture'];
    $Positive_date = $_POST['Positive_date'];
    $recovery_date = $_POST['recovery_date'];

    //------validation --------
    //valid Id
    if (strlen($id) != 9) {
        echo "<script>alert('id not valid')</script>";
    } elseif (!is_numeric($id)) {
        echo "<script>alert('enter a valid id')</script>";
    } elseif (!isValidIsraeliID($id)) {
        echo "<script>alert('enter a valid id numbers dont match the legal value template')</script>";
    //missing values
    } elseif ($name == '' || $address == '' || $date_of_birth == '' || $phone == '' || $cellphone == '') {
        echo "<script>alert('missing information')</script>";
        //checking for currect phone and celluler numbers
    } elseif (($phone[0] != '0' || strlen($phone) != 10) &&
        (substr($phone, 0, 4) != "+972" || strlen($phone) != 13)) {
        echo "<script>alert('enter a valid phone number')</script>";} 
    //valid Date in 0000-00-00 format
    elseif (strlen($date_of_birth)!=10){
        echo "<script>alert('enter a valid date in 0000-00-00 format')</script>";
    //valid Name
    } elseif (!(str_contains($name, ' '))) {
        echo "<script>alert('enter both forst and last name')</script>";
    } else {
    $sql = "insert into `crud` (name,id,address,date_of_birth,phone,cellphone,first_vaccine,second_vaccine,third_vaccine,
    fourth_vaccine,first_manufacture,second_manufacture,
    third_manufacture,fourth_manufacture,Positive_date,recovery_date)
    values('$name', '$id', '$address', '$date_of_birth', '$phone', '$cellphone','$first_vaccine','$second_vaccine','$third_vaccine',
    '$fourth_vaccine','$first_manufacture','$second_manufacture',
    '$third_manufacture','$fourth_manufacture','$Positive_date','$recovery_date')";
        $result = mysqli_query($con, $sql);
        if ($result) {
            //echo "Data inserted successfully";
            header('location:display.php');
        } else {
            die(mysqli_error($con));
        }
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

</head>

<body>
    <div class="container my-5">
        <form method="post">
            <div class="form-group">
                <label>First and last name</label>
                <input type="text" class="form-control" placeholder="Enter your first and last name" name="name" autocomplete="off>
            </div>

            <div class=" form-group">
                <label>Id</label>
                <input type="text" class="form-control" placeholder="Enter your id" name="id">
            </div>

            <div class="form-group">
                <label>Address</label>
                <input type="text" class="form-control" placeholder="Enter your address" name="address">
            </div>

            <div class="form-group">
                <label>Date of birth</label>
                <input type="text" class="form-control" placeholder="Enter your date of birth" name="date_of_birth">
            </div>

            <div class="form-group">
                <label>Phone number</label>
                <input type="text" class="form-control" placeholder="Enter your phone number" name="phone">
            </div>

            <div class="form-group">
                <label>Cell phone number</label>
                <input type="text" class="form-control" placeholder="Enter your cellphone number" name="cellphone">
            </div>
            <div class="form-group">
                <label>First vaccine date</label>
                <input type="text" class="form-control" placeholder="Enter First vaccine date" name="first_vaccine" autocomplete="off>
            </div>

            <div class=" form-group">
                <label>Second vaccine date</label>
                <input type="text" class="form-control" placeholder="Enter second vaccine date" name="second_vaccine">
            </div>

            <div class="form-group">
                <label>Third vaccine date</label>
                <input type="text" class="form-control" placeholder="Enter third vaccine date" name="third_vaccine">
            </div>

            <div class="form-group">
                <label>Fourth vaccine date</label>
                <input type="text" class="form-control" placeholder="Enter fourth vaccine date" name="fourth_vaccine">
            </div>

            <div class="form-group">
                <label>First manufacturer</label>
                <input type="text" class="form-control" placeholder="Enter first vaccine manufacture" name="first_manufacture">
            </div>

            <div class="form-group">
                <label>Second manufacture</label>
                <input type="text" class="form-control" placeholder="Enter second vaccine manufacture" name="second_manufacture">
            </div>

            <div class="form-group">
                <label>Third manufacture</label>
                <input type="text" class="form-control" placeholder="Enter third vaccine manufacture" name="third_manufacture">

            </div>
            <div class="form-group">
                <label>Fourth manufacture</label>
                <input type="text" class="form-control" placeholder="Enter fourth vaccine manufacture" name="fourth_manufacture">

            </div>
            <div class="form-group">
                <label>Positive date</label>
                <input type="text" class="form-control" placeholder="Enter positive date" name="Positive_date">

            </div>
            <div class="form-group">
                <label>Recovery date</label>
                <input type="text" class="form-control" placeholder="Enter recovery date" name="recovery_date">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>

            <div class="container my-5">
                <form method="post">

                </form>
            </div>

</body>

</html>