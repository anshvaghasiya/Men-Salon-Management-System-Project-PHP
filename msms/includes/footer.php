<?php
include('includes/dbconnection.php');
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(0);

if (isset($_POST['sub'])) {
    $email = $_POST['email'];
    // Use Prepared Statements for Security
    $stmt = $con->prepare("INSERT INTO tblsubscriber(Email) VALUES (?)");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        echo "<script>alert('Subscribed successfully!');</script>";
        echo "<script>window.location.href='index.php'</script>";
    } else {
        echo '<script>alert("Something went wrong. Please try again.")</script>';
    }
    $stmt->close();
}
?>

<footer class="footer">
    <div class="container">
        <div class="row">
            <!-- Address Column -->
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="footer-widget">
                    <h2 class="widget-title">Our Salon</h2>
                    <ul class="listnone contact">
                        <?php
                        $ret = mysqli_query($con, "select * from tblpage where PageType='contactus' ");
                        while ($row = mysqli_fetch_array($ret)) {
                            ?>
                            <li><i class="fa-solid fa-location-dot"></i> <?php echo $row['PageDescription']; ?></li>
                            <li><i class="fa-solid fa-phone"></i> +<?php echo $row['MobileNumber']; ?></li>
                            <li><i class="fa-solid fa-envelope"></i> <?php echo $row['Email']; ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

            <!-- Social Column -->
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="footer-widget footer-social">
                    <h2 class="widget-title">Follow Us</h2>
                    <ul class="listnone">
                        <li><a href="#"><i class="fa-brands fa-facebook-f"></i> Facebook</a></li>
                        <li><a href="#"><i class="fa-brands fa-x-twitter"></i> Twitter</a></li>
                        <li><a href="#"><i class="fa-brands fa-instagram"></i> Instagram</a></li>
                        <li><a href="#"><i class="fa-brands fa-linkedin-in"></i> LinkedIn</a></li>
                        <li><a href="#"><i class="fa-brands fa-youtube"></i> YouTube</a></li>
                    </ul>
                </div>
            </div>

            <!-- Newsletter Column -->
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <div class="footer-widget widget-newsletter">
                    <h2 class="widget-title">Newsletter</h2>
                    <p>Subscribe to receive updates, exclusive offers, and styling tips straight to your inbox.</p>
                    <form method="post" style="margin-top: 18px;">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Your email address" name="email"
                                required>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit" name="sub"
                                    value="submit">Subscribe</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="tiny-footer">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-content">
                        <p>&copy; <?php echo date('Y'); ?> Men's Salon Management System — Crafted with <i
                                class="fa-solid fa-heart" style="color: var(--primary);"></i></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Back to Top -->
<button class="back-to-top" id="backToTop" aria-label="Back to top">
    <i class="fa-solid fa-arrow-up"></i>
</button>