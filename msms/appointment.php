<?php
include('includes/dbconnection.php');
session_start();
error_reporting(0);

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $services = $_POST['services'];
    $adate = $_POST['adate'];
    $atime = $_POST['atime'];
    $phone = $_POST['phone'];
    $aptnumber = mt_rand(100000000, 999999999);

    // Use Prepared Statements for Security
    $stmt = $con->prepare("INSERT INTO tblappointment(AptNumber, Name, Email, PhoneNumber, AptDate, AptTime, Services) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssss", $aptnumber, $name, $email, $phone, $adate, $atime, $services);

    if ($stmt->execute()) {
        $_SESSION['aptno'] = $aptnumber;
        echo "<script>window.location.href='thank-you.php'</script>";
    } else {
        echo "<script>alert('Something Went Wrong. Please try again.');</script>";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment — Men's Salon</title>
    <meta name="description" content="Book your grooming appointment online. Quick, easy, and hassle-free scheduling.">
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
                        <span class="subtitle">Schedule Your Visit</span>
                        <h2 class="page-title">Book Appointment</h2>
                        <div class="gold-line"></div>
                        <div class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li><a href="index.php">Home</a></li>
                                <li class="active">Book Appointment</li>
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
                <!-- Booking Form -->
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 slide-left">
                    <div class="glass-card">
                        <div style="margin-bottom: 28px;">
                            <h2 style="margin-bottom: 6px;"><i class="fa-solid fa-calendar-check"
                                    style="color: var(--primary); margin-right: 8px;"></i>Appointment Form</h2>
                            <p style="color: var(--text-secondary); margin: 0;">Reserve your spot — skip the queue and
                                enjoy premium service.</p>
                        </div>
                        <form method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="control-label" for="name">Full Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="John Doe" name="name"
                                        required="true">
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label" for="phone">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="+1 234 567 890" required="true" maxlength="10" pattern="[0-9]+">
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label" for="email">Email Address</label>
                                    <input type="email" class="form-control" id="appointment_email"
                                        placeholder="john@email.com" name="email" required="true">
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label" for="services">Select Service</label>
                                    <select name="services" id="services" required="true" class="form-control">
                                        <option value="">Choose a service...</option>
                                        <?php $query = mysqli_query($con, "select * from tblservices");
                                        while ($row = mysqli_fetch_array($query)) { ?>
                                            <option value="<?php echo $row['ServiceName']; ?>">
                                                <?php echo $row['ServiceName']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="inputdate">Preferred Date</label>
                                        <input type="date" class="form-control" name="adate" id="inputdate"
                                            required="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="atime">Preferred Time</label>
                                        <input type="time" class="form-control" name="atime" id="atime" required="true">
                                    </div>
                                </div>
                                <div class="col-md-12" style="margin-top: 10px;">
                                    <button type="submit" id="submit" name="submit" class="btn btn-default btn-lg"
                                        style="width: 100%;">
                                        <i class="fa-solid fa-paper-plane"></i> Confirm Booking
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Side Info -->
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 slide-right">
                    <div class="glass-card" style="text-align: center; margin-bottom: 20px;">
                        <i class="fa-solid fa-clock"
                            style="font-size: 28px; color: var(--primary); margin-bottom: 14px;"></i>
                        <h4>Opening Hours</h4>
                        <p style="font-size: 14px; margin: 0;">Mon - Sat: 9:00 AM — 8:00 PM<br>Sunday: 10:00 AM — 5:00
                            PM</p>
                    </div>
                    <div class="glass-card" style="text-align: center; margin-bottom: 20px;">
                        <i class="fa-solid fa-phone"
                            style="font-size: 28px; color: var(--primary); margin-bottom: 14px;"></i>
                        <h4>Call Us</h4>
                        <p style="font-size: 14px; margin: 0;">Prefer to call? Reach us at<br><strong
                                style="color: var(--primary);">+1 234 567 890</strong></p>
                    </div>
                    <div class="glass-card" style="text-align: center;">
                        <i class="fa-solid fa-shield-halved"
                            style="font-size: 28px; color: var(--primary); margin-bottom: 14px;"></i>
                        <h4>Guaranteed Quality</h4>
                        <p style="font-size: 14px; margin: 0;">100% satisfaction guaranteed or your next visit is on us.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once('includes/footer.php'); ?>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/stitch.js?v=<?php echo time(); ?>"></script>
    <script>
        $(function () {
            var dtToday = new Date();
            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate() + 1;
            var year = dtToday.getFullYear();
            if (month < 10) month = '0' + month.toString();
            if (day < 10) day = '0' + day.toString();
            var maxDate = year + '-' + month + '-' + day;
            $('#inputdate').attr('min', maxDate);
        });
    </script>
</body>

</html>