<?php
function build_calendar ($month, $year){
    //First of all we'll create ab array containing names of all days in a week
    $daysOfWeek = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');

    //wat is de eerste dag van de maand
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);

    // hoeveel dagen heeft de maand
    $numberDays = date('t', $firstDayOfMonth);

    //info over de eerste dag van de maand?
    $dateComponents = getdate($firstDayOfMonth);

    //naam van de maand
    $monthName = $dateComponents['month'];

    //verkrijgen van de 0-6 waarde an de eerste dag van de maand
    $daysOfWeek = $dateComponents ['wday'];

    //huidige datum verkrijgen
    $dateToday = date('Y-m-d');

    // Tabels maken
    $calendar = "<table class='table table-bordered'>";
    $calendar.= "<center><h2>$monthName $year</h2></center>";
    $calendar.= "<tr>";

    //table headers maken aka de dagen laten zien
    foreach($daysOfWeek as $day) {
        $calendar.= "<th class='header'>$day</th>";
    }

    $calendar = "</tr><tr>";

    //The variable $dayOfWeek will make sure that there must be only 7 columns on our table
    if($daysOfWeek > 0){
        for($k=0;$k<$daysOfWeek;$k++){
            $calendar.="<td></td>";
        }
    }

    //initiate de dag teller, begin met dag 1
    $currentDay = 1;

    // maandnummer verkrijgen
    $month = str_pad($month, 2, "0", STR_PAD_LEFT);

    while($currentDay <= $numberDays){

        //if seventh column (saturday) reached, start a new row
        if($daysOfWeek == 7){
            $daysOfWeek = 0;
            $calendar.="</tr>";
        }

        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
        $date = "$year-month-$currentDayRel";

        $calendar.="<td><h4>$currentDay</h4>";

        $calendar.="</td>";

        // incrementing the counters
        $currentDay++;
        $daysOfWeek++;
    }

    //completing the row of the last week in month, if necessary
    if($daysOfWeek != 7){
        $remainingDays = 7-$daysOfWeek;
        for($i=0;$i<$remainingDays; $i++){
           $calendar.= "<td></td>td>";
        }
    }

    $calendar.="</tr>";
    $calendar.="</table>";

    echo $calendar;

}
?>
<html lang="english">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>calendar</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
               <?php
               $dateComponents = getdate();
               $month = $dateComponents['mon'];
               $year = $dateComponents['year'];
               echo build_calendar($month, $year);


               ?>
            </div>
        </div>
    </div>

</body>
</html>
