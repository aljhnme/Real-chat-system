<?php 
       include 'mysqli.php';
       session_start();
       $query="
          SELECT * FROM data_user
          right join infr_user
          on infr_user.user_id=data_user.user_id
          where infr_user.user_id!='".$_SESSION['user_id']."'
          ";

          $stm=$connect->prepare($query);
          $stm->execute();
          $fetchuser=$stm->fetchAll();
            foreach ($fetchuser as $row) 
             {  
              $query="
               SELECT * FROM block_user
               where user_id_r='".$row['user_id']."'";
               $stmb=$connect->prepare($query);
               $stmb->execute();
              $rowuserp=$stmb->rowCount();
               if ($rowuserp > 0) 
                {
                }else{

              $current_timestamp=strtotime(date("Y-m-d H:i:s")."- 10 second");
              $current_timestamp=date("Y-m-d H:i:s", $current_timestamp);
              $user_last_activity=view_status_user($row["username"], $connect);
             if ($row['img_user'] == "") 
             {
                $img_user='<img class="avatar-md" 
                src="img_profile.jpg" 
                 data-toggle="tooltip" data-placement="top" title="Janette" alt="avatar">';
             }else{
                $img_user='<img class="avatar-md" 
                   src="'.$row['img_user'].'" 
                     data-toggle="tooltip" data-placement="top" title="Janette" alt="avatar">';
             }

            if($user_last_activity>$current_timestamp)             {
                $status='<i class="material-icons online">fiber_manual_record</i>';
             }else{
                $status='<i class="material-icons offline">fiber_manual_record</i>';
             } 

           if ($row["last_name"] != "") 
              {
                $name= $row["last_name"];
              }
           if ($row["first_name"] != "") 
              {
                $name= $row["first_name"];
              }
           if ($row["last_name"] == "" && $row["first_name"] == "")
              {
                $name= $row["username"];
              }

             $user_status='
               <a href="#" user-chat="'.$row['user_id'].'" id="click_chat_user" class="filterMembers all online contact" data-toggle="list">
                   '.$img_user.'
                 <div class="status">
                    '. $status.'
                 </div>
                  <div class="data">
                    <h5>'.$name.'</h5>
                    <p>'.$row['username'].'</p>
                  </div>
                <div class="person-add">
                  <i class="material-icons">person</i>
                </div>
              </a>
             ';

            if (isset($_POST['type_status'])) 
            {
                 
               if($_POST['type_status'] == "online") 
               {
                   if($user_last_activity>$current_timestamp)
                     {
                       echo $user_status;
                     }  
               }
              if ($_POST['type_status'] == "offline") 
               {
                   if($user_last_activity<$current_timestamp)
                     {
                      echo $user_status;
                     }  
               }
               if ($_POST['type_status'] == "all") 
               {
                      echo $user_status;  
               }
              }
             }
           }
      ?>
