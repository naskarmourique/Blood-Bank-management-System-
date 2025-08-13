<?php
include "connect.php";

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $type = $_POST["type"];
    $rating = $_POST["rating"];
    $feedback = $_POST["feedback"];

    $insert = "INSERT INTO `feedback`(NAME, TYPE, RATING, FEEDBACK) VALUES ('$name','$type','$rating','$feedback')";

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