<?php
  session_start();
  include 'mysqli.php';
  $query='
      SELECT * FROM notices 
        WHERE not_user_r="'.$_POST['user_chat'].'" 
        AND not_user_m ="'.$_SESSION['user_id'].'" ';
        $stm=$connect->prepare($query);
        $stm->execute();
        $rowu=$stm->rowCount();
         if ($rowu > 0) 
            {

             $queryup='
              UPDATE notices SET not_user_r
               ="'.$_POST['user_chat'].'",
               not_user_m="'.$_SESSION['user_id'].'"';
              $stmup=$connect->prepare($queryup);
              $stmup->execute();

            }else{               
             $queryin='
                INSERT INTO 
              notices(not_user_r) 
               VALUES ("'.$_POST['user_chat'].'")';
               $stmin=$connect->prepare($queryin);
               $stmin->execute();
           }

?>