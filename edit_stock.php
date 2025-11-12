<?php include 'admin_check.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blood Stock - BloodConnect</title>
    <link rel="shortcut icon" href="favicon.jpg" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="donor.css">
</head>
<body>
    <?php include "header.php"; ?>
    <div class="main-wrapper">
        <div class="form-container">
            <div class="form-header">
                <h2><i class="fas fa-edit icon"></i> Edit Blood Stock</h2>
                <a href="landing_page.php" class="close-btn"><i class="fas fa-times"></i></a>
            </div>
            <div class="form-content">
                <?php
                include 'connect.php';
                $id = $_GET['id'];
                $sql = "SELECT * FROM blood_inventory WHERE id=$id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                ?>
                <form action="update_stock.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <div class="form-group">
                        <label for="bloodGroup" class="form-label"><i class="fas fa-tint"></i> Blood Group</label>
                        <select class="form-select" id="bloodGroup" name="blood_group" required>
                            <option value="">Select Blood Group</option>
                            <option value="A+" <?php if($row['blood_group'] == 'A+') echo 'selected'; ?>>A+</option>
                            <option value="A-" <?php if($row['blood_group'] == 'A-') echo 'selected'; ?>>A-</option>
                            <option value="B+" <?php if($row['blood_group'] == 'B+') echo 'selected'; ?>>B+</option>
                            <option value="B-" <?php if($row['blood_group'] == 'B-') echo 'selected'; ?>>B-</option>
                            <option value="AB+" <?php if($row['blood_group'] == 'AB+') echo 'selected'; ?>>AB+</option>
                            <option value="AB-" <?php if($row['blood_group'] == 'AB-') echo 'selected'; ?>>AB-</option>
                            <option value="O+" <?php if($row['blood_group'] == 'O+') echo 'selected'; ?>>O+</option>
                            <option value="O-" <?php if($row['blood_group'] == 'O-') echo 'selected'; ?>>O-</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="availableUnits" class="form-label"><i class="fas fa-vials"></i> Available Units</label>
                        <input type="number" class="form-control" id="availableUnits" name="available_units" min="1" value="<?php echo $row['available_units']; ?>" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn-submit" name="submit"><i class="fas fa-save"></i> Update Stock</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
