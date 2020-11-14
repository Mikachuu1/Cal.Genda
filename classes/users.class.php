<?php
// https://www.youtube.com/watch?v=T41SMNgyRrc dd 2019
// https://www.youtube.com/watch?v=m_-vmSv2PFo dd 2018

class Users extends Dbh{

    public function getUserDetails($username){
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        return $user;

    }
            

    public function setUser($username, $psw, $email, $to_date){
        // v dd 2019 15:00-
        // first list fields after INSERT INTO then we need VALUES which again will be placeholders
        // probably because these are field names we don't use $ in front of them
        $sql = "INSERT INTO users(username, password, email, to_date) VALUES(?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username, $psw, $email, $to_date]);
    }    
}
?>