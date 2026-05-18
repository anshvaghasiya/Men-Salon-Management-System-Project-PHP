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
    <title>Men's Salon — Premium Grooming Experience</title>
    <meta name="description"
        content="Experience premium men's grooming services. Book your appointment today for expert haircuts, beard styling, and luxury salon treatments.">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet">
</head>

<body>
    <?php include_once('includes/header.php'); ?>

    <!-- ===== HERO SECTION ===== -->
    <section class="hero-section section-wave">
        <div class="container">
            <div class="row" style="display: flex; align-items: center; flex-wrap: wrap;">
                <div class="col-lg-6 col-md-7 col-sm-12">
                    <div class="hero-content">
                        <p class="subtitle fade-up" style="margin-bottom: 16px;">Premium Grooming Studio</p>
                        <h1 class="hero-title fade-up fade-up-delay-1">
                            Crafted for the<br>
                            <span class="gold">Modern Gentleman</span>
                        </h1>
                        <p class="hero-text fade-up fade-up-delay-2">
                            An elevated grooming experience — expert barbers, timeless techniques, and a space
                            designed for those who appreciate the finer things.
                        </p>
                        <div class="hero-buttons fade-up fade-up-delay-3">
                            <a href="appointment.php" class="btn btn-default btn-lg">
                                <i class="fa-solid fa-calendar-check"></i> Book Appointment
                            </a>
                            <a href="service-list.php" class="btn btn-outline btn-lg">
                                Our Services
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5 col-sm-12 fade-up fade-up-delay-2">
                    <div class="hero-images">
                        <div class="hero-img-main">
                            <img src="images/hero-img.jpg" alt="Premium Salon">
                        </div>
                        <div class="hero-img-float hero-img-float-1">
                            <img src="images/about-img.jpg" alt="Expert Barbers">
                        </div>
                        <div class="hero-img-float hero-img-float-2">
                            <img src="images/service-single.jpg" alt="Grooming Services">
                        </div>
                        <div class="hero-badge">
                            <span class="hero-badge-number">10+</span>
                            <span class="hero-badge-text">Years of<br>Excellence</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== STATS BAR ===== -->
    <section class="section-surface">
        <div class="container">
            <div class="stats-row scale-up">
                <div class="stat-item">
                    <div class="stat-number" data-count="10">10+</div>
                    <div class="stat-label">Years Experience</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-count="5000">5K+</div>
                    <div class="stat-label">Happy Clients</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-count="15">15+</div>
                    <div class="stat-label">Expert Barbers</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-count="20">20+</div>
                    <div class="stat-label">Services Offered</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== ABOUT SECTION ===== -->
    <section class="about-section" style="background: var(--bg-dark);">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12 slide-left">
                    <div class="about-image-wrapper">
                        <img src="images/about-img.jpg" alt="About Our Salon" class="img-reveal">
                    </div>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 slide-right">
                    <div class="about-content">
                        <?php
                        $ret = mysqli_query($con, "select * from tblpage where PageType='aboutus' ");
                        while ($row = mysqli_fetch_array($ret)) {
                            ?>
                            <span class="subtitle">Our Story</span>
                            <h2><?php echo $row['PageTitle']; ?></h2>
                            <div class="gold-line" style="margin-left: 0;"></div>
                            <p><?php echo $row['PageDescription']; ?></p>
                        <?php } ?>
                        <a href="appointment.php" class="btn btn-default" style="margin-top: 28px;">
                            <i class="fa-solid fa-scissors"></i> Get Started
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== SERVICES PREVIEW ===== -->
    <section class="space-medium section-surface">
        <div class="container">
            <div class="section-heading blur-in">
                <span class="subtitle">What We Offer</span>
                <h2 class="text-reveal">Premium Services</h2>
                <div class="gold-line"></div>
                <p>Expert grooming services tailored to elevate your style and confidence.</p>
            </div>
            <div class="services-grid">
                <?php
                $squery = mysqli_query($con, "select * from tblservices LIMIT 6");
                $cnt = 1;
                while ($srow = mysqli_fetch_array($squery)) {
                    ?>
                    <div class="service-card fade-up">
                        <span class="service-number"><?php echo str_pad($cnt, 2, '0', STR_PAD_LEFT); ?></span>
                        <h3 class="service-name"><?php echo $srow['ServiceName']; ?></h3>
                        <div class="service-price">$<?php echo $srow['Cost']; ?></div>
                        <p class="service-desc"><?php echo $srow['Description']; ?></p>
                    </div>
                    <?php $cnt++;
                } ?>
            </div>
            <div style="text-align: center; margin-top: 44px;" class="scale-up">
                <a href="service-list.php" class="btn btn-outline">View All Services <i
                        class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </section>

    <!-- ===== CTA SECTION ===== -->
    <section class="space-small bg-primary">
        <div class="container blur-in">
            <div class="row" style="display: flex; align-items: center;">
                <div class="col-lg-8 col-sm-7 col-md-8 col-xs-12">
                    <h1 class="cta-title">Ready for a Fresh Look?</h1>
                    <p class="cta-text">Book your appointment online and skip the wait. Premium grooming awaits.</p>
                </div>
                <div class="col-lg-4 col-sm-5 col-md-4 col-xs-12" style="text-align: right;">
                    <a href="appointment.php" class="btn btn-white btn-lg">Book Now <i
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