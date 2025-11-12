<?php include 'admin_check.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Blood Stock - BloodConnect</title>
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
                <h2><i class="fas fa-plus-circle icon"></i> Add Blood Stock</h2>
                <a href="landing_page.php" class="close-btn"><i class="fas fa-times"></i></a>
            </div>
            <div class="form-content">
                <form action="insert_stock.php" method="post">
                    <div class="form-group">
                        <label for="bloodGroup" class="form-label"><i class="fas fa-tint"></i> Blood Group</label>
                        <select class="form-select" id="bloodGroup" name="blood_group" required>
                            <option value="">Select Blood Group</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="availableUnits" class="form-label"><i class="fas fa-vials"></i> Available Units</label>
                        <input type="number" class="form-control" id="availableUnits" name="available_units" min="1" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn-submit" name="submit"><i class="fas fa-plus"></i> Add Stock</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
