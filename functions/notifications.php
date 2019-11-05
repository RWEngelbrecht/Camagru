<?php

function notify_comment($user) {
    include 'includes/connect.php';

    if (verif_user($user)) {
        $usr_email_sql = "SELECT user_email FROM users WHERE user_id=:usr_id";
        $get_usr_email = $con->prepare($usr_email_sql);
        $get_usr_email->execute([':usr_id'=>$user]);
        $usr_email = $get_usr_email->fetch();

        $subject = "Camagru Comments";
        $body = "Hey! Someone commented on one of your posts.";
        $headers = "From: camagru.rigardt@gmail.com\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        if (mail($usr_email['user_email'],$subject,$body,$headers))
            return true;
        else
            return false;
    }

}


?>