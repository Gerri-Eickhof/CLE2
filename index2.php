<?php
include 'config.php';
require "common.php";

if (isset($_POST['submit'])) {
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die(); }

$conn = new PDO($dsn, "$dataUser", "$dataPass", $options);


function build_calendar($month, $year){


    $daysOfWeek = array('Zondag','Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag');

    $firstDayOfMonth = mktime(0,0,0, $month, 1, $year);

    $numberDays = date('t',$firstDayOfMonth);

    $dateComponents = getdate($firstDayOfMonth);

    $monthName = $dateComponents['month'];

    $dayOfWeek = $dateComponents['wday'];

    $dateToday = date('Y-m-d');

    $calendar= "<table class='table table-bordered'>";

    $calendar .="<center><h2>$monthName $year</h2>";

    $calendar.="<a class='btn btn-xs btn-primary' href='?month=".date('m', mktime(0,0, 0, $month-1, 1, $year)).
        "&year=".date('Y', mktime(0,0, 0, $month-1, 1, $year))."'>Vorige Maand</a>";

    $calendar.="<a class='btn btn-xs btn-primary' href='?month=".date('m')."&year=".date('Y')."'>Deze Maand</a>";

    $calendar.="<a class='btn btn-xs btn-primary' href='?month=".date('m', mktime(0,0, 0, $month+1, 1, $year))."&year=".date('Y', mktime(0,0, 0, $month+1, 1, $year))."'>Volgende Maand</a></center><br>";

    $calendar.="<tr>";

    foreach($daysOfWeek as $day){
        $calendar.="<th class='header'>$day</th>";
    }
    $calendar.= "</tr><tr>";

    if($dayOfWeek > 0) {
        for($k=0;$k<$dayOfWeek;$k++){
            $calendar.="<td></td>";
        }
    }

    $currentDay = 1;

    // Krijgen van het nummer van de maand.
    $month = str_pad($month, 2, '0', STR_PAD_LEFT);
    while($currentDay <= $numberDays){

        if($dayOfWeek == 7){
            $dayOfWeek = 0;
            $calendar.="</tr><tr>";
        }

        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
        $date = "$year-$month-$currentDayRel";

        $dayName = strtolower(date('l', strtotime($date)));
        $eventNum = 0;
        $today = $date==date('Y-m-d')? "today" : "";

        if($date<date('Y-m-d')){
            $calendar.="<td><h4>$currentDay</h4> <button class='btn btn-danger btn-xs'>Niet Beschikbaar</button>";
        }elseif(in_array($date, $bookings)){
            $calendar.="<td class='$today'><h4>$currentDay</h4> <button class='btn btn-danger btn-xs'>Vol Geboekt</button>";
        }else{
            $calendar.="<td class='$today'><h4>$currentDay</h4> <a href='reserveer.php?date=".$date."' class='btn btn-success btn-xs'>Reserveer</a>";

        }

        $calendar.="</td>";

        // Hiermee verhoog ik de tellers.
        $currentDay++;
        $dayOfWeek++;
    }

    if($dayOfWeek !=7){
        $remainingDays = 7-$dayOfWeek;
        for($i=0;$i<$remainingDays;$i++){
            $calendar.="<td></td>";
        }
    }

    $calendar.="</tr>";
    $calendar.="</table>";

    echo $calendar;
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
                <img id="logo" src="img/logo.png" width="80" height="80">
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
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            $dateComponents = getdate();
                            $month = $_GET['month'];
                            $year = $_GET['year'];
                            echo build_calendar($month, $year);
                            ?>
                        </div>
                </div>
            </div>
            <div class="box10">
                <img src="img/3.png" width="533,6" height="262,9">
            </div>
            <div class="box11">
                <input id="submit" type="submit" name="submit" value="SUBMIT APPOINTMENT">
                <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
            </div>
            <div class="box12">
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
            </div>
        </div>
    </form>
</body>
</html>
