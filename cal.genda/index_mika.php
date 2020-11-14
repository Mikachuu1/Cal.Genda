<?php 
require_once '../source/session.php'; 
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
                    <div class="month">
                        <i class="fas fa-angle-left previous-btn"></i>
                        <div class="date">
                            <h1></h1>
                            <p></p>
                        </div>
                        <i class="fas fa-angle-right next-btn"></i>
                    </div>
                    <div class="weekdays">
                        <div>Sun</div>
                        <div>Mon</div>
                        <div>Tue</div>
                        <div>Wed</div>
                        <div>Thu</div>
                        <div>Fri</div>
                        <div>Sat</div>
                    </div>
                    <div class="days"></div>
            </div>
    </div>
    <script src="main.js"></script>  
</body>
</html>