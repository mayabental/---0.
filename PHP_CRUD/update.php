<?php
include('./partials/connect.php');
if (isset($_GET['update_id'])) {
    $uid = $_GET['update_id'];
    // selecting data from database table,so that we can display in input fields
    $select_query = "Select * from `crud` where id='$uid'";
    $result_query = mysqli_query($con, $select_query);
    $row = mysqli_fetch_assoc($result_query);
    $name = $row['name'];
    //$image=$row['image'];
    //echo $image;
    $address = $row['address'];
    $date_of_birth = $row['date_of_birth'];
    $mobile = $row['mobile'];
    $cellular = $row['cellular'];
    $first_vaccine = $row['first_vaccine'];
    $second_vaccine = $row['second_vaccine'];
    $third_vaccine = $row['third_vaccine'];
    $fourth_vaccine = $row['fourth_vaccine'];
    $first_manufacture = $row['first_manufacture'];
    $second_manufacture = $row['second_manufacture'];
    $third_manufacture = $row['third_manufacture'];
    $fourth_manufacture = $row['fourth_manufacture'];
    $Positive_date = $row['Positive_date'];
    $recovery_date = $row['recovery_date'];

    // echo $userdisplay;
    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        //$image = $_FILES['image'];
        // print_r($image);
        // $imagefilename = $image['name'];
        // $imagefileerror = $image['error'];
        // $imagefiletemp = $image['tmp_name'];
        // $filename_sep = explode('.', $imagefilename);
        // $file_ex = strtolower(end($filename_sep));
        // $extension = array('jpeg', 'jpg', 'png');
        // if (in_array($file_ex, $extension)) {
        //     $upload_image = 'images/' . $imagefilename;
        //     move_uploaded_file($imagefiletemp, $upload_image);

            $address = $_POST['address'];
            $date_of_birth = $_POST['date_of_birth'];
            $mobile = $_POST['mobile'];
            $cellular = $_POST['cellular'];
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

            $len_name = strlen($name);

            //------validation --------
            //valid Id
            //missing values
            if ($name == '' || $address == '' || $date_of_birth == '' || $mobile == '' || $cellular == '') {
                echo "<script>alert('missing information')</script>";
                //checking for currect phone and celluler numbers
                //valid mobile number
            } elseif (($mobile[0] != '0' || (strlen($mobile) != 10 && strlen($mobile) != 9) || (!is_numeric($mobile))) &&
                (substr($mobile, 0, 4) != "+972" || (strlen($mobile) != 13 && strlen($mobile) != 12 && strlen($mobile) != 11) || (!is_numeric(substr($mobile, 1))))
            ) {
                echo "<script>alert('enter a valid phone number')</script>";
                //valid cellular number
            } elseif (($cellular[0] != '0' || (strlen($cellular) != 10 && strlen($cellular) != 9) || (!is_numeric($cellular))) &&
                (substr($cellular, 0, 4) != "+972" || (strlen($cellular) != 13 && strlen($cellular) != 12 && strlen($cellular) != 11) || (!is_numeric(substr($cellular, 1))))
            ) {
                echo "<script>alert('enter a valid phone cellular')</script>";
            }
            //valid Date in 0000-00-00 format
            elseif (strlen($date_of_birth) != 10) {
                echo "<script>alert('enter a valid date in 0000-00-00 format')</script>";
                //valid Name
            } elseif (strlen($first_vaccine) != 10) {
                echo "<script>alert('enter a valid date in 0000-00-00 format')</script>";
                //valid Name
            } elseif (strlen($second_vaccine) != 10) {
                echo "<script>alert('enter a valid date in 0000-00-00 format')</script>";
                //valid Name
            } elseif (strlen($third_vaccine) != 10) {
                echo "<script>alert('enter a valid date in 0000-00-00 format')</script>";
                //valid Name
            } elseif (($first_vaccine == '0000-00-00' && $first_manufacture != '')) {
                echo "<script>alert('Must includ first vaccine date')</script>";
            } elseif (($second_vaccine == '0000-00-00' && $second_manufacture != '')) {
                echo "<script>alert('Must includ second vaccine date')</script>";
            } elseif (($third_vaccine == '0000-00-00' && $third_manufacture != '')) {
                echo "<script>alert('Must includ third vaccine date')</script>";
            } elseif (($fourth_vaccine == '0000-00-00' && $fourth_manufacture != '')) {
                echo "<script>alert('Must includ fourth vaccine date')</script>";
            } elseif (strlen($Positive_date) != 10) {
                echo "<script>alert('enter a valid date in 0000-00-00 format')</script>";
                //valid Name
            } elseif (strlen($recovery_date) != 10) {
                echo "<script>alert('enter a valid date in 0000-00-00 format')</script>";
                //valid Name
            } elseif ((!(str_contains($name, ' '))) || ($name[$len_name - 1] == ' ')) {
                echo "<script>alert('enter both first and last name')</script>";
            } else {
                // updating new data inside database table.
                $update_query = "update `crud` set name='$name',address='$address',date_of_birth='$date_of_birth', mobile='$mobile',cellular='$cellular',first_vaccine='$first_vaccine',second_vaccine='$second_vaccine',third_vaccine='$third_vaccine',fourth_vaccine='$fourth_vaccine',first_manufacture='$first_manufacture',second_manufacture='$second_manufacture',
            third_manufacture='$third_manufacture',fourth_manufacture='$fourth_manufacture',Positive_date='$Positive_date',recovery_date='$recovery_date'         
            where id=$uid";
                $result_query = mysqli_query($con, $update_query);
                if ($result_query) {
                    echo "<script>alert('Data updated successfully')</script>";
                    echo "<script>window.open('display.php','_self')</script>";
                } else {
                    die(mysqli_error($con));
                }
            }
        }
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD Updating data</title>
    <!-- bootstarp css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <form action="" method="post">
            <!-- username field -->
            <div class="form-group mb-3">
                <label>First and last name</label>
                <input required="required" autocomplete="off" placeholder="Enter your first and last" name="name" value="<?php echo $name ?>" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label>Upload image</label>
                <input type="file" autocomplete="off" class="form-control" name="image" value="<?php echo $upload_image ?>">
            </div>
            <!-- email field -->
            <div class="form-group mb-3">
                <label>Address</label>
                <input type="address" required="required" autocomplete="off" placeholder="Enter your address" name="address" value="<?php echo $address ?>" class="form-control">
            </div>

            <!-- Mobile filed -->
            <div class="form-group mb-3">
                <label>Date of birth</label>
                <input type="text" required="required" autocomplete="off" placeholder="Enter your date of birth" name="date_of_birth" value="<?php echo $date_of_birth ?>" class="form-control" minLength="10" maxLength="10">
            </div>
            <div class="form-group mb-3">
                <label>Mobile</label>
                <input type="text" required="required" autocomplete="off" placeholder="Enter your mobile number" name="mobile" value="<?php echo $mobile ?>" class="form-control" minLength="9" maxLength="13">
            </div>
            <div class="form-group mb-3">
                <label>Cellular</label>
                <input type="text" required="required" autocomplete="off" placeholder="Enter your cellular number" name="cellular" value="<?php echo $cellular ?>" class="form-control" minLength="7" maxLength="13">
            </div>

            <!-- username field -->
            <div class="my-5"></div>


            <!-------------------------Vaccine information------------------------------------>





            <tilte style="font-size: 30px;"><b>Vaccine information</b></tilte>
            <div class="my-5"></div>

            <div class="form-group mb-3">
                <label>First vaccine date</label>
                <input type="text" autocomplete="off" placeholder="Enter First vaccine date" name="first_vaccine" value="<?php echo $first_vaccine ?>" class="form-control">

            </div>

            <div class="form-group mb-3">
                <select name="first_manufacture">
                    <option value="<?php echo $first_manufacture ?>"><?php if ($first_manufacture) echo $first_manufacture;
                                                                        else {
                                                                            echo "First manufacture";
                                                                        } ?></option>
                    <option value="<?php echo "Pfizer/BioNTech" ?>">Pfizer/BioNTech</option>
                    <option value="<?php echo "Moderna" ?>">Moderna</option>
                    <option value="<?php echo "Oxford/AstraZeneca" ?>">Oxford/AstraZeneca</option>
                    <option value="<?php echo "Johnson&Johnson" ?>">Johnson&Johnson</option>
                    <option value="<?php echo "Sputnik" ?>">Sput>nik</option>
                    <option value="<?php echo "Sinopharm/Beijing" ?>">Sinopharm/Beijing</option>
                    <option value="<?php echo "Novavax" ?>">Novavax</option>
                    <option value="<?php echo "Covaxin" ?>">Covaxin</option>
                </select>
                <?php if ($first_manufacture) {
                    echo "----->", $first_manufacture;
                } ?>
            </div>

            <div class="form-group mb-3">
                <label>Second vaccine date</label>
                <input type="text" autocomplete="off" class="form-control" placeholder="Enter second vaccine date" name="second_vaccine" value="<?php echo $second_vaccine ?>">
            </div>
            <select name="second_manufacture">
                <option value="<?php echo $second_manufacture ?>"><?php if ($second_manufacture) echo $second_manufacture;
                                                                    else {
                                                                        echo "Second manufacture";
                                                                    } ?></option>
                <option value="Pfizer/BioNTech">Pfizer/BioNTech</option>
                <option value="Moderna">Moderna</option>
                <option value="Oxford/AstraZeneca">Oxford/AstraZeneca</option>
                <option value="Johnson&Johnson">Johnson&Johnson</option>
                <option value="Sputnik">Sputnik</option>
                <option value="Sinopharm/Beijing">Sinopharm/Beijing</option>
                <option value="Novavax">Novavax</option>
                <option value="Covaxin">Covaxin</option>
            </select>
            <?php if ($second_manufacture) {
                echo "----->", $second_manufacture;
            } ?>
            <div class="form-group mb-3">
                <label>Third vaccine date</label>
                <input type="text" autocomplete="off" class="form-control" placeholder="Enter third vaccine date" name="third_vaccine" value="<?php echo $third_vaccine ?>">
            </div>
            <select name="third_manufacture">
                <option value="<?php echo $third_manufacture ?>"><?php if ($third_manufacture) echo $third_manufacture;
                                                                    else {
                                                                        echo "Third manufacture";
                                                                    } ?></option>
                <option value="Pfizer/BioNTech">Pfizer/BioNTech</option>
                <option value="Moderna">Moderna</option>
                <option value="Oxford/AstraZeneca">Oxford/AstraZeneca</option>
                <option value="Johnson&Johnson">Johnson&Johnson</option>
                <option value="Sputnik">Sputnik</option>
                <option value="Sinopharm/Beijing">Sinopharm/Beijing</option>
                <option value="Novavax">Novavax</option>
                <option value="Covaxin">Covaxin</option>
            </select>
            <?php if ($third_manufacture) {
                echo "----->", $third_manufacture;
            } ?>

            <div class="form-group mb-3">
                <label>Fourth vaccine date</label>
                <input type="text" autocomplete="off" class="form-control" placeholder="Enter fourth vaccine date" name="fourth_vaccine" value="<?php echo $fourth_vaccine ?>">
            </div>
            <select name="fourth_manufacture">
                <option value="<?php echo $fourth_manufacture ?>"><?php if ($fourth_manufacture) echo $fourth_manufacture;
                                                                    else {
                                                                        echo "Fourth manufacture";
                                                                    } ?></option>
                <option value="Pfizer/BioNTech">Pfizer/BioNTech</option>
                <option value="Moderna">Moderna</option>
                <option value="Oxford/AstraZeneca">Oxford/AstraZeneca</option>
                <option value="Johnson&Johnson">Johnson&Johnson</option>
                <option value="Sputnik">Sputnik</option>
                <option value="Sinopharm/Beijing">Sinopharm/Beijing</option>
                <option value="Novavax">Novavax</option>
                <option value="Covaxin">Covaxin</option>
            </select>
            <?php if ($fourth_manufacture) {
                echo "----->", $fourth_manufacture;
            } ?>

            <div class="form-group mb-3">
                <label>Positive date</label>
                <input type="text" autocomplete="off" class="form-control" placeholder="Enter positive date" name="Positive_date" value="<?php echo $Positive_date ?>">

            </div>
            <div class="form-group mb-3">
                <label>Recovery date</label>
                <input type="text" autocomplete="off" class="form-control" placeholder="Enter recovery date" name="recovery_date" value="<?php echo $recovery_date ?>">
            </div>
            
            <!-- update button -->

            <button type="submit" class="btn btn-primary" name="update">Update</button>
            <!-- cancle button -->

            <input class="btn btn-danger" type="button" value="cancel" onClick="document.location.href='display.php';" />
    </div>

    </form>
    </div>
</body>

</html>