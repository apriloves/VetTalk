<style>
        @media only screen and (max-width: 760px), (min-device-width: 802px) and (max-device-width: 1020px) 
        {
            /*Force table to not be like tables anymore */
            table,thead,tbody,th,td,tr
            {
                display: block;
            }
            .empty
            {
                display: none;
            }
            /*Hide table headers (but not display: none;. for accessibility)*/
            th 
            {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }
            tr
            {
                border: 1px solid #ccc;
            }
            td 
            {
                /* Behave like a •row" */
                border: none;
                border-bottom: 1 px solid #eee;
                position: relative;
                padding-left: 50%;
            }
            /*Label the data */
            td:nth-of-type(1):before
            {
                content: "Sunday";
            }
            td:nth-of-type(2):before
            {
                content: "Monday";
            }
            td:nth-of-type(3):before
            {
                content: "Tuesday";
            }
            td:nth-of-type(4):before
            {
                content: "Wednesday";
            }
            td:nth-of-type(5):before
            {
                content: "Thursday";
            }
            td:nth-of-type(6):before
            {
                content: "Friday";
            }
            td:nth-of-type(7):before
            {
                content: "Saturday";
            }
        }

        /*Smartphones (portrait and landscape) */
        @media only screen and (min-device-width: 320px) and (max-device-width: 480px) 
        {
            body
            {
                padding: O;
                margin: O;
            }
        }

        /* iPads (portrait and landscape) */
        @media only screen and (min-device-width: 802px) and (max-device-width: 1020px) 
        {
            body
            {
                width: 495px;
            }
        }
            
        @media (min-width:641 px) 
        {
            table 
            {
                table-layout: fixed;
            }
            td 
            {
                width: 33%;
            }
        }

        .row
        {
            margin-top: 20px;
        }

        .today
        {
            background: yellow;
        }
</style>

<?php
    include'includes/connection.php';
    include'includes/sidebar.php';

    function build_calendar($month, $year)
    {
        include('includes/connection.php');
        //call table from database
        /*$query = $db->prepare('SELECT * FROM lab_bookings WHERE MONTH(date)=? AND YEAR(date)=? ');
        $query->bind_param('ss', $month, $year);
        $bookings = array();

        if($query->execute())
        {
            $result = $query->get_result();
            if($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    $bookings[] = $row['date'];
                    //echo ($bookings);
                }
                $query->close();
            }
        }*/


        //First of all we'll create an array containing names of all days in a week.
        $daysOfWeek = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');

        //Then we'll get the first day of the month that is in the argument of this function
        $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

        //Now getting the number of days this month contains
        $numberDays = date('t', $firstDayOfMonth);

        //Getting some information about the first day of this month
        $dateComponents = getdate($firstDayOfMonth);

        //Getting the name of this month
        $monthName = $dateComponents['month'];

        //Getting the index value 0-6 of the first day of this month
        $dayOfWeek = $dateComponents['wday'];

        //Getting the current date
        $dateToday = date('Y-m-d');

        //Now creating the HTML table
        
        $prev_month = date('m', mktime(0,0,0,$month-1,1,$year));
        $prev_year = date('Y', mktime(0,0,0,$month-1,1,$year));
        $next_month = date('m', mktime(0,0,0,$month+1,1,$year));
        $next_year = date('Y', mktime(0,0,0,$month+1,1,$year));

        $calendar ="<center><h3>$monthName $year </h3>";
        $calendar.="<a class='btn btn-primary btn-xs' href='?month=".$prev_month."&year=".$prev_year."'>Prev Month</a>";
        $calendar.="<a class='btn btn-primary btn-xs' href='?month=".date('m')."&year=".date('Y')."'>Current Month</a>";
        $calendar.="<a class='btn btn-primary btn-xs' href='?month=".$next_month."&year=".$next_year."'>Next Month</a></center>";
        $calendar.= "<br> <table class='table table-bordered'>";  
        $calendar.= "<tr>";
        
        //Creating the calendar headers
        foreach($daysOfWeek as $day)
        {
            $calendar.= "<th class='header'>$day</th>";
        }
        $calendar.= "</tr><tr>";

        //lnitiating the day counter
        $currentDay = 1;

        //The variable $dayOfWeek will make sure that there must be only 7 columns on our table
        if($dayOfWeek > 0)
        {
            for($k=0 ; $k < $dayOfWeek; $k++)
            {
                $calendar.= "<td class='empty'></td>";
            }
        }

        //Getting the month number
        $month = str_pad($month,2,"0", STR_PAD_LEFT);
        while($currentDay <= $numberDays)
        {
            //if 7th row (saturday) reached, start new row
            if($dayOfWeek == 7 )
            {
                $dayOfWeek = 0;
                $calendar.= "</tr><tr>";
            }

            $currentDayRel = str_pad($currentDay,2,"0",STR_PAD_LEFT);
            $date = "$year-$month-$currentDayRel";
            $dayName= strtolower(date('l', strtotime($date)));
            $today = $date==date('Y-m-d') ? 'today':'';

            //block certain days
            if($dayName=='sunday' || $dayName=='saturday')
            {
                $calendar.="<td><h5>$currentDay</h5> <a class='btn btn-danger btn xs' style='color:white'> Closed </a></td>";
            }
            else if($date<date('Y-m-d'))
            {
                $calendar.="<td><h5>$currentDay</h5> <a class='btn btn-secondary btn xs'> </a></td>";
            }
            else
            {
                //

                $totalbookings = checkSlots($db,$date);
                //change if number of slots per day changed
                if($totalbookings > 6)
                {
                    $calendar.="<td class='$today'><h5>$currentDay</h5> <a href='#'class='btn btn-danger btn xs'> All Booked </a></td>";
                }
                else
                {
                    $availableslots = 6 - $totalbookings;
                    $calendar.="<td class='$today'><h5>$currentDay</h5> <a href='book_lab.php?date=".$date."'class='btn btn-success btn xs'> Book 
                        </a><small><i>  $availableslots slots</i></small></td>";
                }
                
            }

            //too see if date is already booked
            /*if(in_array($date,$bookings))
            {
                $calendar.="<td class='$today'><h5>$currentDay</h5> <a class='btn btn-danger btn xs'> Booked </a></td>";
            }
            else
            {
                $calendar.="<td class='$today'><h5>$currentDay</h5> <a class='btn btn-success btn xs'> Book </a></td>";
            }*/
        
            //lncrementing the counters
            $currentDay++;
            $dayOfWeek++;
        }

        //CompIeting the row of the last week in month, if necessary
        if($dayOfWeek < 7)
            {
                $remainingDays = 7-$dayOfWeek;
                for($i=0; $i<$remainingDays; $i++)
                {
                    $calendar.="<td class='empty'></td>";
                }
            }
        $calendar.="</tr></table>"; 


        return $calendar;

    
  }

  function checkSlots($db,$date)
  {
    $query = $db->prepare('SELECT * FROM lab_bookings WHERE date=?');
    $query->bind_param('s', $date);
    $totalbookings = 0;

    if($query->execute())
    {
        $result = $query->get_result();
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $totalbookings++;
            }
            $query->close();
        }
    }

    return $totalbookings;
  }
?>

            

                <div class="row">
                    <div class="col-md-12">
                        <?php
                            $dateComponents = getdate();
                            if(isset($_GET['month']) && isset($_GET['year']))
                            {
                                $month = $_GET['month'];
                                $year = $_GET['year'];
                            }
                            else
                            {
                                $month = $dateComponents['mon'];
                                $year = $dateComponents['year'];
                            }                  
                            echo build_calendar($month,$year);
                        ?>

                    </div> 
                </div>  


<?php
    include'../includes/footer.php';
?>