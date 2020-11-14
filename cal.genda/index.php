<?php 
require_once '../source/session.php'; 
include_once '../classes/dbh.class.php';
include_once '../classes/events.class.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap"/>
    <title>Cal.Genda</title>
</head>
<body>
    <header>
        <div class="container">
            <div id="sideMenu" class="sidemenu">
                <ul>
                    <li><a href="#">School</a></li>
                    <li><a href="#">Work</a></li>
                    <li><a href="#">Birthdays</a></li>
                </ul>
            </div>
            <div class="menu-btn expand" id="expandbtn" onclick="toggleNav()">
                <div class="menu-btn_burger"></div>
            </div>
            <img class="logo" src="logo.png" alt="logo">
            <div class="search-box">
                <input class="search-txt" type="text" name="" placeholder="Type to search">
                <a class="search-btn" href="#">
                    <i class="fas fa-search"></i>
                </a>
            </div>

            <!-- Logout link -->
            <div class="logout">
                <button><a href ="../loginsignup/index.html"> Logout</a></button>
            </div>


            <nav>
                <div class="navright">
                    <div class="create">
                        <button><a href ="../CreateEvent/EventForm.html">Create</a><i class="fas fa-plus"></i></button>
                    </div>
                    <div class="notifications">
                        <div class="icon_wrap">
                            <i class="far fa-bell"></i>
                        </div>
                        <div class="notifcation_bar" style="display: none;">
                            <ul class="notification_ul"> 
                                <li class="upcoming projectplan">
                                    <div class="notify_data">
                                        <div class="title">
                                            project plan
                                        </div>
                                        <div class="date">
                                            oct 28
                                        </div>
                                    </div>
                                </li>
                                <li class="failed alphabeta">
                                    <div class="notify_icon"></div>
                                    <div class="notify_data">
                                        <div class="title">
                                            Alpha beta testing
                                        </div>
                                        <div class="date">
                                            nov 13
                                        </div>
                                    </div>
                                </li>
                            </ul>

                        </div>
                    </div>

                    <div class="profile">
                        <div class="icon_wrap">
                            <img src="pfp.png" alt="profile_pic">   
                            <span class="name"><?php echo $_SESSION['username']; ?></span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                </div>
                <!--
                <ul class="navright">
                    <li><a href="#">settings</a></li>
                    <li><a href="#">notifications</a></li>
                    <li><a href="#">username</a></li>
                </ul>
                -->
            </nav>
        </div>
    </header>

    <div class="calgenda-container">
            <div class="left-side">
                    <div class="title">
                        <div class="date">
                            <h1>Agenda</h1>
                            <p><?php echo date("l");?></p>
                        </div>
                    </div>
                    <div class="to-do-list">
                        <h2>To-Do List</h2>
                        <ul id="myUL">
                        </ul>
                    </div>
                    <div id="myDIV" class="header">
                        <input type="text" id="myInput" placeholder="Add a to-do...">
                        <span onclick="newElement()" class="addBtn">Add</span>
                    </div>
                    <!--<div class="add-event-day">
                        <input type="text" class="add-event-day-field" placeholder="Create an Event">
                        <span class="fa fa-plus-circle cursor-pointer add-event-day-field-btn"></span>
                    </div>-->
            </div>

            <div class="right-side">
            
                <?php
                    // Sara's code
                    // https://codingwithsara.com/how-to-code-calendar-in-php/




                    // Set your timezone
                    date_default_timezone_set('America/Toronto');

                    // Get prev & next month
                    if (isset($_GET['ym'])) {
                        $ym = $_GET['ym'];
                    } else {
                        // This month
                        $ym = date('Y-m');
                    }
                    
                    // checking whether we get to that part of the code if press < or >
                    //if ($ym <> "2020-11"){
                    //echo $ym . "  Y1" . '<br>'; // prints $ym as e.g. 2020-10, i.e. not the initial month which is today is 2020-11, i.e. $ym is reset, i.e. we jump to that part of code when we click < or >
                    //}

                    // Check format
                    // what is that '-01' argument in strtotime
                    $timestamp = strtotime($ym . '-01'); //string-to-time function
                    //echo $timestamp . "<br>";
                    //$tf = !($timestamp === false); 
                    //echo $tf; 
                    if ($timestamp === false) {
                        $ym = date('Y-m');
                        $timestamp = strtotime($ym . '-01');
                        //echo "AAA";
                    }

                    // Today
                    $today = date('Y-m-j', time());
                    //echo $today;
                    //echo $timestamp;
                    // For H3 title
                    $html_title = date('Y / m', $timestamp);
                    //echo $html_title . "   A1" . '<br>';



                    // Create prev & next month link     mktime(hour,minute,second,month,day,year)
                    $prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
                    $next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));
                    //echo $prev . '<br>'; // works


                    //echo $next; //works
                    // You can also use strtotime!
                    // $prev = date('Y-m', strtotime('-1 month', $timestamp));
                    // $next = date('Y-m', strtotime('+1 month', $timestamp));

                    // Number of days in the month
                    $day_count = date('t', $timestamp);
                    //echo $day_count; //works
                    
                    // 0:Sun 1:Mon 2:Tue ...
                    $str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
                    //$str = date('w', $timestamp);
                    //echo gettype($str);
                    //echo $str;

                    // Create Calendar!!
                    $weeks = array();
                    $week = '';
                    //echo gettype($weeks);
                    //echo sizeof($weeks);

                    // Add empty cell
                    $week .= str_repeat('<td></td>', $str); //

                    // loop over your events table and put into $weeks if it is our year and monht, i.e. if matches $ym
                    $object = new Events;
                    //echo $_SESSION['id']; //works
                    $events = $object->getEventsForUser($_SESSION['id']);
                    //print_r($rows);
                    //echo $rows[1]['eventDate'];

                    //echo $ym . "  Y2" . '<br>';
                    //echo $event['username'] . " " . $event['eventTitle'] . '<br>';
                        
                    //echo gettype($ym) . '<br>';
                    //echo gettype($event['eventDate']) . '<br>';
                    //echo $event['eventDate'] . '<br>';
                    //echo substr($event['eventDate'],0,7) . '<br>';

                    for ( $day = 1; $day <= $day_count; $day++, $str++) {

                        $date = $ym . '-' . $day; // format is 2020-11-14 which is November 14, 2020
                        $isDateProcessedFlag = 0;



                        // check whether that date is among dates with events & if it is then add eventTitle to that date & mark that date as processed with $isDateProcessedFlag = 1;
                        // ? will it work if there are two or more events for that date
                        foreach($events as $event){
                            if($date == $event['eventDate']){
                                $week .= '<td>' . $day . '<br>'. $event['eventTitle'];
                                $isDateProcessedFlag = 1;
                            }
                        }

                        // format the current date with "today" style which is orange
                        if ($today == $date & !$isDateProcessedFlag) {
                            $week .= '<td class="today">' . $day;
                        } 
                        else{
                            if ($today == $date & $isDateProcessedFlag) {
                                $week .= '<class="today">';
                            }
                        }

                        // if $date is still unprocessed meaning it has no events then just mark it with date number
                        if (!$isDateProcessedFlag & $today <> $date){
                            $week .= '<td>' . $day;
                        }
                            

                        $week .= '</td>';
                        //echo $week;
                        //if ($day == 2){
                        //    create_post($_post);
                        //};

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

                    } // for ( $day = 1; $day <= $day_count; $day++, $str++)

                    ?>

                    <head>
                        <meta charset="utf-8">
                        <title>PHP Calendar</title>
                        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
                        <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
                        
                        <style>
                            .container1 {
                                font-family: 'Noto Sans', sans-serif;
                                margin-top: 80px;
                            }
                            h3 {
                                margin-bottom: 30px;
                                width: 35%;
                                float: right;
                            }
                            th {
                                height: 30px;
                                text-align: center;
                            }
                            td {
                                height: 100px;
                            }
                            .today {
                                background: orange;
                            }
                            th:nth-of-type(1), td:nth-of-type(1) {
                                color: red;
                            }
                            th:nth-of-type(7), td:nth-of-type(7) {
                                color: blue;
                            }

                            .table{
                                width: 65%;
                                float: right;
                            }
                        </style>
                        
                    </head>                    

                    <div class="container1">
                    <!--<div class="container1">-->
                        <h3><a href="?ym=<?php echo $prev; ?>">&lt;</a> <?php echo $html_title; ?> <a href="?ym=<?php echo $next; ?>">&gt;</a></h3>
                        
                        <table class="table table-bordered">
                            <tr>
                                <th>S</th>
                                <th>M</th>
                                <th>T</th>
                                <th>W</th>
                                <th>T</th>
                                <th>F</th>
                                <th>S</th>
                            </tr>
                            <?php
                                foreach ($weeks as $week) {
                                    echo $week;
                                }
                            ?>
                        </table>
                            
                    <!--</div>-->
                    </div>
            </div>
    </div>
    <script src="main.js"></script>  
</body>
</html>