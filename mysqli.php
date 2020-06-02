<?php

$connect=new PDO('mysql:host=localhost;dbname=system_chat','root','');

       function view_status_user($username,$connect)
          {
       $query="
          SELECT * FROM infr_user
          where username='".$username."'
          ORDER BY last_activity DESC
          LIMIT 1
           ";
         $stm=$connect->prepare($query);
         $stm->execute();
         $fetch_status=$stm->fetchAll();
         foreach ($fetch_status as $row) 
          {
            return $row['last_activity'];
          }
         }
?>
