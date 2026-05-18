<?php
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmed — Men's Salon</title>
    <meta name="description" content="Your appointment has been booked successfully.">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet">
</head>

<body>
    <?php include_once('includes/header.php'); ?>

    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-caption">
                        <span class="subtitle">Booking Status</span>
                        <h2 class="page-title">Thank You</h2>
                        <div class="gold-line"></div>
                        <div class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li><a href="index.php">Home</a></li>
                                <li class="active">Confirmation</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container">
            <div class="row" style="justify-content: center; display: flex;">
                <div class="col-lg-7 col-md-9 col-sm-12">
                    <div class="glass-card" style="text-align: center; padding: 56px 36px;">
                        <!-- Animated Checkmark -->
                        <div class="thank-you-icon">
                            <i class="fa-solid fa-check"></i>
                        </div>

                        <h2 style="font-size: 34px; margin-bottom: 10px;">Booking Confirmed!</h2>
                        <p style="font-size: 15px; color: var(--text-secondary); margin-bottom: 28px;">
                            Your appointment has been successfully booked. We look forward to seeing you!
                        </p>

                        <!-- Appointment Number Card -->
                        <div
                            style="background: rgba(200,169,126,0.06); border: 1px solid rgba(200,169,126,0.15); border-radius: var(--radius-sm); padding: 22px; margin-bottom: 28px; display: inline-block; min-width: 260px;">
                            <div
                                style="font-size: 11px; text-transform: uppercase; letter-spacing: 2.5px; color: var(--text-muted); margin-bottom: 6px;">
                                Your Appointment Number</div>
                            <div
                                style="font-family: var(--font-heading); font-size: 38px; font-weight: 700; color: var(--primary); letter-spacing: 2px;">
                                <?php echo $_SESSION['aptno']; ?>
                            </div>
                        </div>

                        <p style="font-size: 13px; color: var(--text-muted); margin-bottom: 24px;">
                            <i class="fa-solid fa-circle-info" style="color: var(--primary); margin-right: 4px;"></i>
                            Please save this number for your reference. You may need it for rescheduling or
                            cancellations.
                        </p>

                        <div style="display: flex; gap: 14px; justify-content: center; flex-wrap: wrap;">
                            <a href="index.php" class="btn btn-default">
                                <i class="fa-solid fa-house"></i> Back to Home
                            </a>
                            <a href="appointment.php" class="btn btn-outline">
                                <i class="fa-solid fa-calendar-plus"></i> Book Another
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once('includes/footer.php'); ?>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/stitch.js?v=<?php echo time(); ?>"></script>
</body>

</html>