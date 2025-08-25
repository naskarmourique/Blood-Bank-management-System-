<?php
include "connect.php";

if (isset($_POST["submit"])) {
    $f_name = $_POST["fName"];
    $l_name = $_POST["lName"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $subject = $_POST["subject"];
    $massage = $_POST["massage"];

    $insert = "INSERT INTO `contact_us`(`F_NAME`, `L_NAME`, `EMAIL`, `MOBILE`, `SUBJECT`, `MESSAGE`) VALUES ('$f_name','$l_name','$email','$phone','$subject','$massage')";

    $pass = mysqli_query($conn, $insert);
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