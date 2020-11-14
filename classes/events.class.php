<?php
// https://www.youtube.com/watch?v=T41SMNgyRrc dd 2019
// https://www.youtube.com/watch?v=m_-vmSv2PFo dd 2018

class Events extends Dbh{
    // without user input, i.e. here in SQL query we put WHERE users.username='argyn' ref: video dd 2019 0-9:20
    // ?i did not get all the output, i.e. two 
    public function getEvents(){
        // because it is inside a separate class instead of $conn variable we created in Dbh we use '$this'
        //What does the variable $this mean in PHP?
        // https://stackoverflow.com/questions/1523479/what-does-the-variable-this-mean-in-php
        //$stmt = $this->connect()->prepare("SELECT users.username, events.eventTitle FROM users INNER JOIN events ON users.id=events.userID WHERE users.username='argyn'");
        //$stmt->execute([$username]); //? does placeholder work?
        $sql = "SELECT users.username, events.eventTitle, events.eventDate, events.startTime, events.endTime FROM users INNER JOIN events ON users.id=events.userID WHERE users.username='cheena'";
        $stmt = $this->connect()->query($sql);

        // output of the query will be in $row - associative array with named indexes, as it is specified in Dbh in setAttributes, see video dd 2019 6:45
        // fetchAll takes all rows from the query results while fetch only the 1st one
        $rows = $stmt->fetchAll();
        // now display what we fetched from the query result in the browser
        foreach ($rows as $row){
            echo $row['username'] . " " . $row['eventTitle'] . '<br>';
        }
    }

    // if we get user input and we get it fter a user logged in then we need to use PREPARED statement dd 2019 9:00- ...
    // $username argument is what we get from the user, i.e. it is a username after login so we know for what user to pull out the calendar
    public function getEventsForUser($id){
        // now we have placeholders that will be user inputs in form of '?'
        // so we need first prepare SQL statement inside db without inputs using 'prepare' and then on the excution step fill ?s with inputs that prevents 'SQL injections'
        // v dd 2019 10:00-
        $sql = "SELECT users.username, events.eventTitle, events.eventDate, events.startTime, events.endTime FROM users INNER JOIN events ON users.id=events.userID WHERE users.id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);

        // now we should say whether we want to fetch the first row or all rows 12:30
        $rows = $stmt->fetchAll();
        // now display what we fetched from the query result in the browser 13:50
        //foreach ($rows as $row){
        //    echo $row['username'] . " " . $row['eventTitle'] . '<br>';
        //}
        return $rows;
    }

    public function setEventsForUser($eventTitle, $eventDate, $startTime, $endTime, $userID){
        // v dd 2019 15:00-
        // first list fields after INSERT INTO then we need VALUES which again will be placeholders
        // probably because these are field names we don't use $ in front of them
        $sql = "INSERT INTO events(eventTitle, eventDate, startTime, endTime, userID) VALUES(?,?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$eventTitle, $eventDate, $startTime, $endTime, $userID]);


        // INSERT INTO users(username,password,email,to_date) VALUES("assel","a2","assel@kw.com","2020-10-29") // works, Note that id is autoincremented => no need to enter it
        // INSERT INTO users(username,password,email) VALUES("assel","a2","assel@kw.com")
        
        // INSERT INTO events(eventTitle, eventDate, eventTime, userID) VALUES("chinups","2020-10-30","14:00:00","cheena")
        // #1452 - Cannot add or update a child row: a foreign key constraint fails (`mydb`.`events`, CONSTRAINT `events_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`))

        // INSERT INTO events(eventTitle, eventDate, eventTime, userID) VALUES("chinups","2020-10-30","14:00:00","3") // worked but it is inconvenient as remembering that cheena ==3 is hard

        //INSERT INTO events(eventTitle, eventDate, startTime, endTime, userID) VALUES("walk", "2020-10-31", "5:10:00", "6:10:00", "7") it worked

    }    
}
?>