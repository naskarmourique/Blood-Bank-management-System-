<?php
include "connect.php";

if (isset($_POST["submit"])) {
    $pName = $_POST["pName"];
    $bloodGroup = $_POST["bloodGroup"];
    $units = $_POST["units"];
    $hospital_name = $_POST["hName"];
    $hospital_location = $_POST["hLocation"];
    $mobile = $_POST["mobile"];
    $required_date = $_POST["rDate"];

    $insert2 = "INSERT INTO `blood_request`(`P_NAME`, `BLOOD_GROUP`, `UNITS`, `HOSPITAL_NAME`, `HOSPITAL_LOCATION`, `MOB`, `REQUIRED_DATE`) VALUES ('$pName' , '$bloodGroup' , '$units' , '$hospital_name' , '$hospital_location' ,'$mobile' , '$required_date')";

    $pass = mysqli_query($conn, $insert2);
    if ($pass) {
?>
        <script>
            window.open("landing_page.php", "_self");
        </script>
<?php
    } else {
        echo "not ok";
    }
}
?>