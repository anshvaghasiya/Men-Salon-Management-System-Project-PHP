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
    <title>Services & Pricing — Men's Salon</title>
    <meta name="description"
        content="Explore our premium grooming services and pricing. From classic haircuts to luxury beard treatments.">
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
                        <span class="subtitle">What We Offer</span>
                        <h2 class="page-title">Services & Pricing</h2>
                        <div class="gold-line"></div>
                        <div class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li><a href="index.php">Home</a></li>
                                <li class="active">Services</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container">
            <div class="section-heading blur-in">
                <span class="subtitle">Premium Grooming</span>
                <h2 class="text-reveal">Our Service Menu</h2>
                <div class="gold-line"></div>
                <p>Crafted services to help you look and feel your best, every time.</p>
            </div>

            <div class="services-grid">
                <?php
                $ret = mysqli_query($con, "select * from tblservices");
                $cnt = 1;
                while ($row = mysqli_fetch_array($ret)) {
                    ?>
                    <div class="service-card fade-up">
                        <span class="service-number"><?php echo str_pad($cnt, 2, '0', STR_PAD_LEFT); ?></span>
                        <h3 class="service-name"><?php echo $row['ServiceName']; ?></h3>
                        <div class="service-price">$<?php echo $row['Cost']; ?></div>
                        <p class="service-desc"><?php echo $row['Description']; ?></p>
                    </div>
                    <?php
                    $cnt = $cnt + 1;
                } ?>
            </div>
        </div>
    </div>

    <!-- CTA -->
    <section class="space-small bg-primary">
        <div class="container">
            <div class="row" style="display: flex; align-items: center;">
                <div class="col-lg-8 col-sm-7 col-md-8 col-xs-12">
                    <h1 class="cta-title">Love What You See?</h1>
                    <p class="cta-text">Book your appointment online and experience premium grooming.</p>
                </div>
                <div class="col-lg-4 col-sm-5 col-md-4 col-xs-12" style="text-align: right;">
                    <a href="appointment.php" class="btn btn-white btn-lg">Book Appointment <i
                            class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <?php include_once('includes/footer.php'); ?>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/stitch.js?v=<?php echo time(); ?>"></script>
</body>

</html>