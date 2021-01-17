<?php
include 'config.php';
require "common.php";

if (isset($_POST['submit'])) {
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die(); }

$conn = openCon();

// Set your timezone
date_default_timezone_set('Europe/Amsterdam');

// Get prev & next month
if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
    // This month
    $ym = date('Y-m');
}

// Check format
$timestamp = strtotime($ym . '-01');
if ($timestamp === false) {
    $ym = date('Y-m');
    $timestamp = strtotime($ym . '-01');
}

// Today
$today = date('Y-m-j', time());

// For H3 title
$html_title = date('Y / m', $timestamp);

// Create prev & next month link     mktime(hour,minute,second,month,day,year)
$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));
// You can also use strtotime!
// $prev = date('Y-m', strtotime('-1 month', $timestamp));
// $next = date('Y-m', strtotime('+1 month', $timestamp));

// Number of days in the month
$day_count = date('t', $timestamp);

// 0:Sun 1:Mon 2:Tue ...
$str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
//$str = date('w', $timestamp);


// Create Calendar!!
$weeks = array();
$week = '';

// Add empty cell
$week .= str_repeat('<td></td>', $str);

for ( $day = 1; $day <= $day_count; $day++, $str++) {

    $date = $ym . '-' . $day;

    if ($today == $date) {
        $week .= '<td class="today">' . $day;
    } else {
        $week .= '<td>' . $day;
    }
    $week .= '</td>';

// End of the week OR End of the month
    if ($str % 7 == 6 || $day == $day_count) {

        if ($day == $day_count) {
// Add empty cell
            $week .= str_repeat('<td></td>', 6 - ($str % 7));
        }

        $weeks[] = '<tr>' . $week . '</tr>';

// Prepare for new week
        $week = '';
    }

}
?>

<html lang="en">
<head>
    <title>Reservering</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<form id="contact-form" method="post" action="create.php">
    <div id="content">
        <div class="box1">
            <img id="logo" src="img/logo.png">
        </div>
        <div class="box2">
            <h1>Create appointment</h1>
        </div>
        <div class="box3">
            <img src="img/2.png" width="533,6" height="262,9">
        </div>
        <div class="box4">
            <input type="text" name="firstName" class="form-control" placeholder="First name" required>
        </div>
        <div class="box5">
            <input type="text" name="lastName" class="form-control" placeholder="Last name" required>
        </div>
        <div class="box6">
            <input type="text" name="emailAdress" class="form-control" placeholder="Your Email" required>
        </div>
        <div class="box7">
            <input type="text" name="phoneNumber" class="form-control" placeholder="Phone number" >
        </div>
        <div class="box8">
            <input type="text" name="message" class="form-control" placeholder="Message">
        </div>
        <div class="box9">
            <div class="container">
                <input type="date" name="date" class="form-control" id="date" required>
                <select name ="time" required>
                    <option value="">--Select--</option>
                    <option value="10:00-10:15">10:00-10:15</option>
                    <option value="14:00-14:15">14:00-14:15</option>
                    <option value="20:00-20:15">20:00-20:15</option>
                </select>
            </div>
        </div>
        <div class="box10">
            <img src="img/3.png" width="533,6" height="262,9">
        </div>
        <div class="box11">
            <input id="submit" type="submit" name="submit" value="SUBMIT APPOINTMENT">
            <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
        </div>
    </div>
</form>
<script>
    const picker = document.getElementById('date');
    picker.addEventListener('input', function(e){
        var day = new Date(this.value).getDay();
        if([0, 2, 4, 5].includes(day)){
            e.preventDefault();
            this.value = '';
            alert('Alleen maandag, woensdag en zaterdag!');
        }
    });
</script>
<footer>
    <li class="site-footer__linklist-item h6">
        <a href="https://your-secondhand.com/search"><strong>SEARCH</strong></a>
    </li>

    <li class="site-footer__linklist-item h6">
        <a href="https://your-secondhand.com/pages/about"><strong>ABOUT US</strong></a>
    </li>

    <li class="site-footer__linklist-item h6">
        <a href="https://your-secondhand.com/pages/return-of-items"><strong>RETURN OF ITEMS</strong></a>
    </li>

    <li class="site-footer__linklist-item h6">
        <a href="https://your-secondhand.com/blogs/nieuws"><strong>NEWS</strong></a>
    </li>
    <li>
    </li>
</footer>
</body>
</html>