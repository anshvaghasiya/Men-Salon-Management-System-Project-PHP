<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us — Men's Salon</title>
    <meta name="description"
        content="Get in touch with our salon. Find our address, phone number, email, and business hours.">
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
                        <span class="subtitle">Get in Touch</span>
                        <h2 class="page-title">Contact Us</h2>
                        <div class="gold-line"></div>
                        <div class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li><a href="index.php">Home</a></li>
                                <li class="active">Contact</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container">
            <div class="row">
                <!-- Contact Info Cards -->
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 slide-left">
                    <?php
                    $ret = mysqli_query($con, "select * from tblpage where PageType='contactus' ");
                    while ($row = mysqli_fetch_array($ret)) {
                        ?>
                        <div class="glass-card" style="margin-bottom: 20px;">
                            <div style="text-align: center; margin-bottom: 16px;">
                                <i class="fa-solid fa-location-dot" style="font-size: 24px; color: var(--primary);"></i>
                            </div>
                            <h4 style="text-align: center; margin-bottom: 10px;">Our Address</h4>
                            <p style="text-align: center; font-size: 14px;"><?php echo $row['PageDescription']; ?></p>
                        </div>

                        <div class="glass-card" style="margin-bottom: 20px;">
                            <div style="text-align: center; margin-bottom: 16px;">
                                <i class="fa-solid fa-phone" style="font-size: 24px; color: var(--primary);"></i>
                            </div>
                            <h4 style="text-align: center; margin-bottom: 10px;">Phone</h4>
                            <p style="text-align: center; font-size: 14px;"><strong
                                    style="color: var(--primary);"><?php echo $row['MobileNumber']; ?></strong></p>
                        </div>

                        <div class="glass-card" style="margin-bottom: 20px;">
                            <div style="text-align: center; margin-bottom: 16px;">
                                <i class="fa-solid fa-envelope" style="font-size: 24px; color: var(--primary);"></i>
                            </div>
                            <h4 style="text-align: center; margin-bottom: 10px;">Email</h4>
                            <p style="text-align: center; font-size: 14px;"><?php echo $row['Email']; ?></p>
                        </div>

                        <div class="glass-card" style="margin-bottom: 20px;">
                            <div style="text-align: center; margin-bottom: 16px;">
                                <i class="fa-solid fa-clock" style="font-size: 24px; color: var(--primary);"></i>
                            </div>
                            <h4 style="text-align: center; margin-bottom: 10px;">Business Hours</h4>
                            <p style="text-align: center; font-size: 14px;"><?php echo $row['Timing']; ?></p>
                        </div>
                    <?php } ?>

                    <!-- Social Icons -->
                    <div class="glass-card" style="text-align: center;">
                        <h4 style="margin-bottom: 14px;">Follow Us</h4>
                        <div class="social-circle">
                            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="#"><i class="fa-brands fa-instagram"></i></a>
                            <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                            <a href="#"><i class="fa-brands fa-youtube"></i></a>
                        </div>
                    </div>
                </div>

                <!-- About Section -->
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 slide-right">
                    <div class="well-block">
                        <?php
                        $ret = mysqli_query($con, "select * from tblpage where PageType='aboutus' ");
                        while ($row = mysqli_fetch_array($ret)) {
                            ?>
                            <span class="subtitle" style="display: block; margin-bottom: 10px;">About Our Salon</span>
                            <h2><?php echo $row['PageTitle']; ?></h2>
                            <div class="gold-line" style="margin-left: 0;"></div>
                            <p style="font-size: 15px; line-height: 1.9;"><?php echo $row['PageDescription']; ?></p>
                        <?php } ?>
                        <a href="appointment.php" class="btn btn-default" style="margin-top: 22px;">
                            <i class="fa-solid fa-calendar-check"></i> Book Your Visit
                        </a>
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