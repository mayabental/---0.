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


// including connect.php file so that we can have access to database.
include('./partials/connect.php');
if (isset($_POST['Cancel'])) {
    echo "operation cancled";
    echo "<script>window.open('display.php','_self')</script>";
}

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $image = $_FILES['image'];
    $imagefilename = $image['name'];
    $imagefileerror = $image['error'];
    $imagefiletemp = $image['tmp_name'];
    $filename_sep = explode('.', $imagefilename);
    $file_ex = strtolower(end($filename_sep));
    $extension = array('jpeg', 'jpg', 'png');
    if (in_array($file_ex, $extension)) {
        $upload_image = 'images/' . $imagefilename;
        move_uploaded_file($imagefiletemp, $upload_image);

    // echo $username;
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

    // password hasing

    //------validation --------
    //valid Id
    $len_name = strlen($name);
    if (strlen($id) != 9) {
        echo "<script>alert('id not valid')</script>";
    } elseif (!is_numeric($id)) {
        echo "<script>alert('enter a valid id')</script>";
    } elseif (!isValidIsraeliID($id)) {
        echo "<script>alert('enter a valid id numbers dont match the legal value template')</script>";
    }
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
    } elseif ((!(str_contains($name, ' '))) || ($name[$len_name - 1] == ' ')) {
        echo "<script>alert('enter both first and last name')</script>";
    } else {
        $insert_query = "insert into `crud` (name,id,address,date_of_birth,mobile,cellular,first_vaccine,second_vaccine,third_vaccine,
        fourth_vaccine,first_manufacture,second_manufacture,
        third_manufacture,fourth_manufacture,Positive_date,recovery_date,image) values ('$name','$id','$address','$date_of_birth','$mobile','$cellular','$first_vaccine','$second_vaccine','$third_vaccine',
        '$fourth_vaccine','$first_manufacture','$second_manufacture',
        '$third_manufacture','$fourth_manufacture','$Positive_date','$recovery_date','$upload_image') ";
        $result = mysqli_query($con, $insert_query);
        if ($result) {
            echo "Data inserted successfully";
            echo "<script>window.open('display.php','_self')</script>";
        } else {
            die(mysqli_error($con));
        }
    }}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="/favicon.ico"> <!-- bootstarp css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>
    <div class="container my-5">
        <form action="" method="post" enctype="multipart/form-data">
            <!-- username field -->

            <tilte style="font-size: 30px;"><b>Percinal information</b></tilte>
            <div class="my-5"></div>

            <div class="form-group mb-3">
                <label>First and last name</label>
                <input type="text" required="required" autocomplete="off" placeholder="Enter your first and last" name="name" class="form-control">
            </div>

            <!-- email field -->
            <div class="form-group mb-3">
                <label>Id</label>
                <input type="text" required="required" autocomplete="off" placeholder="Enter your id" name="id" class="form-control">
            </div>

            <!-- password filed -->
            <div class="form-group mb-3">
                <label>Address</label>
                <input type="text" required="required" autocomplete="off" placeholder="Enter your address" name="address" class="form-control">
            </div>
            <!-- password filed -->
            <div class="form-group mb-3">
                <label>Date of birth</label>
                <input type="text" required="required" autocomplete="off" placeholder="Enter your date of birth" name="date_of_birth" class="form-control">
            </div>

            <!-- Mobile filed -->
            <div class="form-group mb-3">
                <label>Mobile number</label>
                <input type="text" required="required" autocomplete="off" placeholder="Enter your mobile number" name="mobile" class="form-control" minLength="10" maxLength="10">
            </div>
            <!-- Mobile filed -->
            <div class="form-group mb-3">
                <label>Cellular number</label>
                <input type="text" required="required" autocomplete="off" placeholder="Enter your cellular number" name="cellular" class="form-control" minLength="10" maxLength="10">
            </div>
            <!-- username field -->
            <div class="my-5"></div>

            <tilte style="font-size: 30px;"><b>Vaccine information</b></tilte>
            <div class="my-5"></div>
            <div class="form-group mb-3">
                <label>First vaccine date</label>
                <input type="text" autocomplete="off" class="form-control" placeholder="Enter First vaccine date" name="first_vaccine">
            </div>
            <div class="form-group mb-3">
                <select name="first_manufacture">
                    <option value="">First manufacture</option>
                    <option value="<?php echo "Pfizer/BioNTech" ?>">Pfizer/BioNTech</option>
                    <option value="<?php echo "Moderna" ?>">Moderna</option>
                    <option value="<?php echo "Oxford/AstraZeneca" ?>">Oxford/AstraZeneca</option>
                    <option value="<?php echo "Johnson&Johnson" ?>">Johnson&Johnson</option>
                    <option value="<?php echo "Sputnik" ?>">Sput>nik</option>
                    <option value="<?php echo "Sinopharm/Beijing" ?>">Sinopharm/Beijing</option>
                    <option value="<?php echo "Novavax" ?>">Novavax</option>
                    <option value="<?php echo "Covaxin" ?>">Covaxin</option>
                </select>
            </div>
           
            <div class="form-group mb-3">
                <label>Second vaccine date</label>
                <input type="text" autocomplete="off" class="form-control" placeholder="Enter second vaccine date" name="second_vaccine">
            </div>
            
            <select name="second_manufacture">
                <option value="">Second manufacture</option>
                <option value="Pfizer/BioNTech">Pfizer/BioNTech</option>
                <option value="Moderna">Moderna</option>
                <option value="Oxford/AstraZeneca">Oxford/AstraZeneca</option>
                <option value="Johnson&Johnson">Johnson&Johnson</option>
                <option value="Sputnik">Sputnik</option>
                <option value="Sinopharm/Beijing">Sinopharm/Beijing</option>
                <option value="Novavax">Novavax</option>
                <option value="Covaxin">Covaxin</option>
            </select>
     
            <div class="form-group mb-3">
                <label>Third vaccine date</label>
                <input type="text"  autocomplete="off" class="form-control" placeholder="Enter third vaccine date" name="third_vaccine">
            </div>
            <select name="third_manufacture">
                <option value="">Third manufacture</option>
                <option value="Pfizer/BioNTech">Pfizer/BioNTech</option>
                <option value="Moderna">Moderna</option>
                <option value="Oxford/AstraZeneca">Oxford/AstraZeneca</option>
                <option value="Johnson&Johnson">Johnson&Johnson</option>
                <option value="Sputnik">Sputnik</option>
                <option value="Sinopharm/Beijing">Sinopharm/Beijing</option>
                <option value="Novavax">Novavax</option>
                <option value="Covaxin">Covaxin</option>
            </select>
         
            <div class="form-group mb-3">
                <label>Fourth vaccine date</label>
                <input type="text" autocomplete="off" class="form-control" placeholder="Enter fourth vaccine date" name="fourth_vaccine">
            </div>
            <select name="fourth_manufacture">
                <option value="">Fourth manufacture</option>
                <option value="Pfizer/BioNTech">Pfizer/BioNTech</option>
                <option value="Moderna">Moderna</option>
                <option value="Oxford/AstraZeneca">Oxford/AstraZeneca</option>
                <option value="Johnson&Johnson">Johnson&Johnson</option>
                <option value="Sputnik">Sputnik</option>
                <option value="Sinopharm/Beijing">Sinopharm/Beijing</option>
                <option value="Novavax">Novavax</option>
                <option value="Covaxin">Covaxin</option>
            </select>
            <div class="form-group mb-3">
                <label>Positive date</label>
                <input type="text"  autocomplete="off" class="form-control" placeholder="Enter positive date" name="Positive_date">

            </div>
            <div class="form-group mb-3">
                <label>Recovery date</label>
                <input type="text"  autocomplete="off" class="form-control" placeholder="Enter recovery date" name="recovery_date">
            </div>
            <div class="form-group mb-3">
                <label>Upload image</label>
                <input type="file"  autocomplete="off" class="form-control"  name="image">
            </div>
            <!-- submit button -->

            <button class="btn btn-success" type="submit" name="submit">Add Details</button>
            <!-- cancle button -->

            <input class="btn btn-danger" type="button" value="cancel" onClick="document.location.href='display.php';" />

    </div>

    </form>

    </div>

</body>

</html>