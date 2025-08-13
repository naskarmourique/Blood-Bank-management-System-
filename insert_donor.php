<?php
include "connect.php";

if (isset($_POST["submit"])) {
    $fullName = $_POST["fullName"];
    $type = $_POST["type"];
    $bloodGroup = $_POST["bloodGroup"];
    $state = $_POST["state"];
    $city = $_POST["city"];
    $mobile = $_POST["mobile"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];
    $securityQuestion = $_POST["securityQuestion"];
    $securityAnswer = $_POST["securityAnswer"];
    $lastDonation = $_POST["lastDonation"];

    $insert = "INSERT INTO `donor`(`FULL_NAME`, `TYPE`, `BLOOD_GROUP`, `STATE`, `CITY`, `MOB`, `EMAIL`, `PASSWORD`, `C_PASSWORD`, `S_QUESTION`, `S_ANSWER`, `LAST_DONATE`) VALUES ('$fullName' , '$type' , '$bloodGroup' , '$state' , '$city' , '$mobile' ,'$email' , '$password' , '$confirmPassword' , '$securityQuestion' ,'$securityAnswer' , '$lastDonation')";

    $pass = mysqli_query($conn,$insert);
    if ($pass)
    {
        ?>
            <script>
                window.open("landing_page.php","_self");
            </script>
        <?php
    }
    else
    {
        echo "not ok";
    }
}
?>