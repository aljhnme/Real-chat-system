
<?php
session_start();
include 'mysqli.php';
if ($_POST['action'] == 'reister') 
{
$password=$_POST['password'];
$passwordc=$_POST['passwordc'];
$username=$_POST['username'];
if (!empty($username)) 
{
$queryf='
SELECT * FROM 
 infr_user WHERE username = "'.$username.'"
';
$stmu=$connect->prepare($queryf);
$stmu->execute();
$rowcus=$stmu->rowcount();
if ($rowcus > 0) 
{
  echo "<h6 style='text-align: center;color: red;'>Registered username</h6>";
}else{

if (strlen($password) >= 6) 
{

if (is_numeric($password)&is_numeric($passwordc)) 
{
  
if ($password != $passwordc) 
{
  echo "<h6 style='text-align: center;color: red;'>password does not match</h6>";
}else{

$query='
INSERT INTO infr_user
(password,username)
 VALUES ("'.password_hash($password,PASSWORD_DEFAULT).'","'.$username.'")
';
$stm=$connect->prepare($query);
if ($stm->execute()) 
{
  echo "<h6 style='text-align: center;color: green;'>Successfully registered</h6>";
}
}
}else{
  echo "<h6 style='text-align: center;color: red;'>choose password numbers only</h6>";
}
}else{

  echo "<h6 style='text-align: center;color: red;'>Please type 6 or more numbers</h6>";
}
}
}else{
  echo "<h6 style='text-align: center;color: red;'>please fill in the username filed</h6>";
}
}

if ($_POST['action'] == 'login') 
{
   $query='
     SELECT * FROM infr_user
     where username = "'.$_POST['username'].'" 
    ';
    $stm=$connect->prepare($query);
    $stm->execute();
    $rowu=$stm->rowCount();
    $fetchuser=$stm->fetchAll();
    if ($rowu > 0) 
    {
      $queryp='
        SELECT * FROM infr_user
       ';
       $stmp=$connect->prepare($queryp);
       $stmp->execute();
       $rowp=$stmp->rowCount();
         if ($rowp > 0) 
         {
        
         foreach ($fetchuser as $row) 
          {

       if (password_verify($_POST['password'],$row['password'])) 
          {

          if ($_POST['remember_me'] == "true")
          { 
            setcookie("user_id",$row['user_id'],time()+30*24*60*60);
            if (isset($_COOKIE["user_id"])) 
             {  
               echo"good";
                $_SESSION['user_id']=$_COOKIE["user_id"];
             }
          }else
             {
              echo"good";
              $_SESSION['user_id']=$row['user_id'];
             }
            }else{
              echo"wrong password";
            }
          }
        }else{
           echo"wrong password";
           }
         }else{
           echo "wrong username";
         }
      }

      if ($_POST['action'] == "delete_account") 
      {
        $queryp='
          DELETE FROM infr_user WHERE user_id ="'.$_SESSION['user_id'].'"';
         $stmp=$connect->prepare($queryp);
         if ($stmp->execute()) 
         {
          echo "delete_yes"; 
         }
      }

      if ($_POST['action'] == "editor_data") 
      {
            $query='
         SELECT * FROM infr_user 
         WHERE username = "'.$_POST['username'].'"
         AND user_id ="'.$_SESSION['user_id'].'"  ';
 
         $stm=$connect->prepare($query);
         $stm->execute();
         $etchd=$stm->fetchAll();
         $coutuser=$stm->rowCount();
         if ($coutuser == 0) 
         {
           $query='
             SELECT * FROM infr_user 
             WHERE username = "'.$_POST['username'].'" ';
 
               $stmn=$connect->prepare($query);
               $stmn->execute();
               $fetchda=$stmn->fetchAll();
               if ($stmn->rowCount() > 0) 
               {
                echo "<h6 style='text-align: center;color: red;'>This username is used again</h6>";

                  foreach ($fetchda as $row) 
                  {
                    $username=$row['username'];
                  }
               }else{

                  $username=$_POST['username'];
               }
               }else{
                  foreach ($etchd as $row) 
                  {
                    $username=$row['username'];
                  } 
               } 

            if (!empty($_POST['password'])) 
              { 
                 
                 if (strlen($_POST['password']) <= 11) 
                 {
           
                  $query='
                   UPDATE infr_user SET username="'.$username.'",
                   last_name="'.$_POST['last_name'].'",
                   first_name="'.$_POST['first_name'].'",
                   location="'.$_POST['Location'].'",
                   password="'.$_POST['password'].'"
                   WHERE user_id ="'.$_SESSION['user_id'].'" ';
 
                   $stmn=$connect->prepare($query);
                   if ($stmn->execute()) 
                   {
                      echo "<h6 style='text-align: center;color: blue;'>The information has been updated</h6>";
                   }
                   }else{
                     echo "<h6 style='text-align: center;color:   blue;'>You must add 10 characters or less password</h6>";
                  }
                  }else{
                     echo "<h6 style='text-align: center;color: blue;'>Please fill in the password field</h6>";
           }
         }


        if ($_POST['action'] == "fetch_massge_user") 
        {

         $query="
         SELECT * FROM chat 
         WHERE (user_id_m = '".$_SESSION['user_id']."' 
         AND user_id_r = '".$_POST['user_chat']."') 
         OR (user_id_m = '".$_POST['user_chat']."' 
         AND user_id_r = '".$_SESSION['user_id']."') 
           ";

          $stmm=$connect->prepare($query);
          $stmm->execute();
          $fetchmassge=$stmm->fetchAll();
          $rowmssge=$stmm->rowCount();
          $query="
            SELECT * FROM data_user
            right join infr_user
            on infr_user.user_id=data_user.user_id
            where infr_user.user_id='".$_POST['user_chat']."'
           ";
        
            $stmuser=$connect->prepare($query);
            $stmuser->execute();
            $fetchuser=$stmuser->fetchAll();
            foreach ($fetchuser as $rowuser) 
            {
              
            
              $current_timestamp=strtotime(date("Y-m-d H:i:s")."- 10 second");
              $current_timestamp=date("Y-m-d H:i:s", $current_timestamp);
              $user_last_activity=view_status_user($rowuser["username"], $connect);

             if ($rowuser['img_user'] == "") 
             {
                $img_user='<img class="avatar-md"
                src="img_profile.jpg" 
                 data-toggle="tooltip" data-placement="top" title="Keith" alt="avatar">';
             }else{
                $img_user='<img class="avatar-md" 
                   src="'.$rowuser['img_user'].'" 
                      data-toggle="tooltip" data-placement="top" title="Keith" alt="avatar">';
             }


           $queryms='
             SELECT * FROM chat where 
              user_id_r="'.$_SESSION['user_id'].'" AND
              user_id_m="'.$_POST['user_chat'].'"';
            $stmms=$connect->prepare($queryms);
            $stmms->execute();
            $fetchms=$stmms->rowcount();
          if ($fetchms >= 1)
           {
            $querymsu='
             SELECT * FROM chat where 
              user_id_m="'.$_SESSION['user_id'].'" AND
              user_id_r="'.$_POST['user_chat'].'"';
            $stmmsu=$connect->prepare($querymsu);
            $stmmsu->execute();
            $fetchmsu=$stmmsu->rowcount();
           }

             $querymode='
                SELECT * FROM infr_user
                where user_id="'.$_SESSION['user_id'].'"
                AND mode="yes_mode"
                 ';
              $stmode=$connect->prepare($querymode);
              $stmode->execute();
              $fetchmode=$stmode->rowCount();

              if ($fetchmode > 0) 
              {
                  $mode1='style="background:#706E6A;"';
                  $mode2='style="background:#53524E;"';
                  $mode3='style="background:#53524E;"';
                  $mode7='style="background:#1B2631;"';

              }else{
                 $mode1='';
                 $mode2=''; 
                 $mode3='';
                 $mode7='';


              }
                
              ?> 
             <div class="top" <?PHP echo $mode1;  ?>>
               <div class="container">
                 <div class="col-md-12">
                   <div class="inside">
                  <a href="#">
                    <?php echo $img_user;  ?>
                   </a>
                 <div class="status">
                <?php
                    if($user_last_activity>$current_timestamp)  
                    {
                   echo '<i class="material-icons online">fiber_manual_record</i>';
                    }else{
                   echo '<i class="material-icons offline">fiber_manual_record</i>';
                    } 
                   ?>
                 </div>
                 <div class="data">
                  <h5><a href="#"><?php echo $rowuser['username'];  ?></a></h5>
                  <?php
                 if($user_last_activity>$current_timestamp)  
                 {
                   echo "<span>Active now</span>";
                 }else{
                   echo "<span>not connected</span>";
                 } 
                   ?>
                 </div>
                 <div id="massget">
                   
                 </div>

                   <button data-type="phone" class="btn connect d-md-block d-none version" name="1"><i class="material-icons md-30">phone_in_talk</i></button>
                   <button data-type="Video" class="btn connect d-md-block d-none version" name="1"><i class="material-icons md-36">videocam</i></button>
                   <button  class="btn d-md-block d-none"><i data-type="info" class="material-icons md-30 version">info</i></button>
               <div class="dropdown">
                    <button class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons md-30">more_vert</i></button>
               <div class="dropdown-menu dropdown-menu-right" <?php echo $mode7;  ?>>
                   <button class="dropdown-item connect" name="1"><i class="material-icons">phone_in_talk</i>Voice Call</button>
                   <button class="dropdown-item connect" name="1"><i class="material-icons">videocam</i>Video Call</button>
                   <hr>
                   <button class="dropdown-item"><i class="material-icons">clear</i>Clear History</button>
                   <button id="<?php echo $rowuser['user_id'];?>" class="dropdown-item block_user"><i class="material-icons">block</i>Block Contact</button>
                   <button id="<?php echo $rowuser['user_id'];  ?>" class="dropdown-item delete_massg" ><i class="material-icons">delete</i>Delete Contact</button>
                 </div>
               </div>
             </div>
           </div>
         </div>
          </div>
           <?php
           }
           ?>
            <div <?PHP echo $mode2; ?> class="content" id="content">
             <div class="container">
               <div id="massges" class="col-md-12">
                 <div class="date">
                   <hr>
                <span>Yesterday</span>
                 <hr>
                 </div>
              <?php
             foreach ($fetchmassge as $row)
              {

           $query="
            SELECT * FROM block_chat_session 
            WHERE  block_user_massge='".$_SESSION['user_id']."'
            AND chat_id ='".$row['chat_id']."'";
            $stmb=$connect->prepare($query);
            $stmb->execute();
            $rowuserp=$stmb->rowCount();
            if ($rowuserp > 0) 

            {

            }else{

        if ($row["user_id_r"]==$_SESSION["user_id"]) 
                  
           {
            $query="
             SELECT * FROM data_user
             where user_id='".$row['user_id_m']."'
           ";
            $stmuserimg=$connect->prepare($query);
            $stmuserimg->execute();
            $rowimg=$stmuserimg->rowCount();
           
             if ($rowimg > 0) 
             {
               $img_user_m='<img class="avatar-md" 
                   src="'.$rowuser['img_user'].'" 
                      data-toggle="tooltip" data-placement="top" title="Keith" alt="avatar">';
             }else{
               $img_user_m='<img class="avatar-md"
                src="img_profile.jpg" 
                 data-toggle="tooltip" data-placement="top" title="Keith" alt="avatar">';
             }

          if ($fetchmsu == 0) 
            {
           echo'<div class="no-messages request">
                     <a href="#">
                     '.$img_user_m.'
                    </a>
                       <h5>Louis Martinez would like to add you as a contact. <span>Hi Keith, Id like to add you as a contact.</span></h5>
                   <div class="options">
                     <button user-chat="'.$row['user_id_m'].'" id="'.$row['user_id_m'].'" class="btn button Acceptance_user"><i class="material-icons">check</i></button>
                    <button id="'.$row['user_id_m'].'" class="btn button delete_massg"><i class="material-icons">close</i></button>
                 </div>
                </div>';
            }

           if ($fetchmsu != 0) 
            {        
            ?> 
           <div class="message">
           <?php
             echo $img_user_m;
             ?>
                <div class="text-main">
                 <div class="text-group">
             <?php
           if ($row['mssge'] != "") 
           {
             if ($row['mssge'] =="Your message has been approved")
                  { 
                    echo '
                    <div class="text" style="background:#808080;">
                    <p>'.$row['mssge'].'</p>
                    </div>
                    ';
                   }else{
                   echo '
                   <div class="text">
                   <p>'.$row['mssge'].'</p>
                   </div>
                   ';
                    }
                  }
                   ?>
                 </div>

                   <?php
                    if ($row['img_chat'] != "") 
                    {
                      echo "
                       <div class='text'>
                      <img style='width:300px;' src='".$row['img_chat']."' />
                      </div>";
                    }
                 ?>
                <?php
                  if ($row['datet'] !="0000-00-00") 
                  {
                ?>
                <span><?php echo str_replace('-',' / ',$row['datet']); ?></span>
                <?php
                  }
                ?>
                </div>
              </div> 
                 <?php
                  }
                }
                if ($row["user_id_m"]==$_SESSION["user_id"]) 
                {
                ?>
              <div class="message me">
                 <div class="text-main">
                   <div class="text-group me">
              <?php
              if ($row['mssge'] != "") 
              {
               if ($row['mssge'] =="Your message has been approved")
                  { 
                     echo '
                    <div class="text me" style="background:#808080;">
                    <p>'.$row['mssge'].'</p>
                    </div>
                    ';
                  }else{
                   echo '
                 <div class="text me">
                    <p>'.$row['mssge'].'</p>
                  </div>';
                    }
                    }
                 ?>
               </div>
                 <?php
                    if ($row['img_chat'] != "") 
                    {
                      echo "<img style='width:300px;' src='".$row['img_chat']."' />";
                    }
                 ?>
                <?php
                  if ($row['datet'] !="0000-00-00") 
                  {
                ?>
                <span><?php echo str_replace('-',' / ',$row['datet']); ?></span>
                <?php
                  }
                ?>
             </div>
               </div>

              <?php
                }           
              }
            }
            if ($rowmssge == 0) 
            { 
                  echo  '<div class="content empty">
                  <div class="container">
                    <div class="col-md-12">
                      <div class="no-messages">
                        <i class="material-icons md-48">forum</i>
                        <p>Seems people are shy to start the chat. Break the ice send the first message.</p>
                      </div>
                    </div>
                  </div>
                </div>';
            }
              ?>
         <div id="show_live_imgchat">
                
       </div>
        </div>
       </div>
       </div>
         <div <?php echo $mode3; ?> class="container">
           <div class="col-md-12">
             <div class="bottom">
             <div class="position-relative w-100">
              <textarea id="text_chat" class="form-control" placeholder="Start typing for reply..." rows="1"></textarea>
              <button class="btn emoticons"><i class="material-icons">insert_emoticon</i></button>
             <button user-chat="<?php echo $rowuser['user_id'];?>" id="<?php echo$rowuser['username'];  ?>" type="submit" class="btn send"><i class="material-icons">send</i></button>
           </div>
           <label>
             <input id="imge_chat" 
             onchange="showimgchat(this)"  
             accept=".png, .jpg, .jpeg" type="file">
             <span class="btn attach d-sm-block d-none"><i class="material-icons">attach_file</i></span>
             </label> 
           </div>
         </div>
       </div>
      <?php
         }

         if ($_POST['action'] == 'fetch_massge_live') 
         {

            $query="
              SELECT * FROM chat 
              WHERE (user_id_m = '".$_SESSION['user_id']."' 
              AND user_id_r = '".$_POST['user_chat']."') 
              OR (user_id_m = '".$_POST['user_chat']."' 
              AND user_id_r = '".$_SESSION['user_id']."')";
        
             $stmm=$connect->prepare($query);
             $stmm->execute();
             $fetchmassgenew=$stmm->fetchAll();
             foreach ($fetchmassgenew as $row)
                {
                   $query="
                    SELECT * FROM block_chat_session 
                    WHERE block_user_massge ='".$row['chat_id']."'";
                    $stmb=$connect->prepare($query);
                    $stmb->execute();
                    $rowuserp=$stmb->rowCount();
                   if ($rowuserp > 0) 
                     {

                     }else{

               if ($row["user_id_r"]==$_SESSION["user_id"]) 
                  {

           $query="
             SELECT * FROM data_user
             where user_id='".$row['user_id_m']."'";

            $stmuserimg=$connect->prepare($query);
            $stmuserimg->execute();
            $rowimg=$stmuserimg->rowCount();
            $fetchimg=$stmuserimg->fetchAll();
           
             if ($rowimg > 0) 
             {
               foreach ($fetchimg as $fetchimge) 
               {
               $img_user_m='<img class="avatar-md" 
                   src="'.$fetchimge['img_user'].'" 
                      data-toggle="tooltip" data-placement="top" title="Keith" alt="avatar">';
               }
             }else{
               $img_user_m='<img class="avatar-md"
                src="img_profile.jpg" 
                 data-toggle="tooltip" data-placement="top" title="Keith" alt="avatar">';
             }
                ?>

               <div class="message">
                 <?php echo $img_user_m; ?>
                 <div class="text-main">
                 <div class="text-group">
               <?php
                if ($row['mssge'] != "") 
                {
                      
                  if ($row['mssge'] =="Your message has been approved")
                    { 
                     echo '
                    <div class="text" style="background:#808080;">
                    <p>'.$row['mssge'].'</p>
                    </div>
                    ';
                  }else{
                   echo '
                 <div class="text">
                    <p>'.$row['mssge'].'</p>
                  </div>';
                 }
                }
                 ?>
                </div>
                   <?php
                    if ($row['img_chat'] != "") 
                    {
                      echo "<img style='width:300px;' src='".$row['img_chat']."' />";
                    }
                 ?>
               <?php
                  if ($row['datet'] !="0000-00-00") 
                  {
                ?>
               <span><?php echo str_replace('-',' / ',$row['datet']); ?></span>
               <?php
                 }
               ?>
               </div>
              </div> 
                   <?php
                }
                if ($row["user_id_m"]==$_SESSION["user_id"]) 
                {
                ?>
              <div class="message me">
                 <div class="text-main">
                   <div class="text-group me">
               <?php
               if ($row['mssge'] != "") 
               {
               if ($row['mssge'] =="Your message has been approved")
                  { 
                     echo '
                    <div class="text me" style="background:#808080;">
                    <p>'.$row['mssge'].'</p>
                    </div>
                    ';
                  }else{
                   echo '
                 <div class="text me">
                    <p>'.$row['mssge'].'</p>
                  </div>';
                    }
                   }
                 ?>
               </div>
                 <?php
                    if ($row['img_chat'] != "") 
                    {
                      echo "<img style='width:300px;' src='".$row['img_chat']."' />";
                    }
                 ?>
               <?php
                  if ($row['datet'] !="0000-00-00") 
                  {
                ?>
               <span><?php echo str_replace('-',' / ',$row['datet']); ?></span>
                <?php
                  }
                ?>
             </div>
               </div>
              <?php
                }   
               }          
              }
            }

            if ($_POST['action'] == 'delete_massges') 
            {
                $query="
                DELETE FROM chat 
                WHERE (user_id_m = '".$_SESSION['user_id']."' 
                AND user_id_r = '".$_POST['user_chat_delete']."') 
                OR (user_id_m = '".$_POST['user_chat_delete']."' 
                AND user_id_r = '".$_SESSION['user_id']."')";
                $stmdelete=$connect->prepare($query);
                $stmdelete->execute();
            }

           if ($_POST['action'] == 'block_user') 
           {
             $query='
                INSERT INTO block_user
                (block_user,user_id_r,user_id_m) 
                VALUES ("block","'.$_POST['user_id_clock'].'","'.$_SESSION['user_id'].'")
                 ';
              $stm=$connect->prepare($query);
               if ($stm->execute()) 
               {
                 $queryd='
                  DELETE FROM chat 
                  WHERE user_id_r="'.$_SESSION['user_id'].'" AND user_id_m="'.$_POST['user_id_clock'].'"
                  OR user_id_r="'.$_POST['user_id_clock'].'" AND user_id_m="'.$_SESSION['user_id'].'"
                 ';
                 $stmd=$connect->prepare($queryd);
                 if ($stmd->execute()) 
                 { 
                $querydn='
                  DELETE FROM notices 
                  WHERE not_user_r="'.$_SESSION['user_id'].'" AND not_user_m="'.$_POST['user_id_clock'].'"
                  OR not_user_r="'.$_POST['user_id_clock'].'" AND not_user_m="'.$_SESSION['user_id'].'"
                 ';
                 $stmdn=$connect->prepare($querydn);
                 $stmdn->execute();
                 }
               }
           }

           if ($_POST['action'] == "fetch_user_mssge_read") 
           {
              $query='
                 SELECT * FROM notices
                 inner join infr_user on
                 infr_user.user_id=notices.not_user_m
                 left join data_user on
                 data_user.user_id=infr_user.user_id
                 WHERE  not_user_r="'.$_SESSION['user_id'].'" 
                 ORDER BY not_id DESC LIMIT 1';

                 $stm=$connect->prepare($query);
                 $stm->execute();
                 $etchmsr=$stm->fetchAll();
                 foreach ($etchmsr as $row) 
                  {

                   $current_timestamp=strtotime(date("Y-m-d H:i:s")."- 10 second");
                   $current_timestamp=date("Y-m-d H:i:s", $current_timestamp);
                   $user_last_activity=view_status_user($row["username"], $connect);
                   
                    if ($row['img_user'] == "") 
                    {  
                       $img_user='<img class="avatar-md" 
                          src="img_profile.jpg" data-toggle="tooltip" data-placement="top" title="Janette" alt="avatar">';
                    }else{
                       $img_user='<img class="avatar-md" 
                          src="'.$row['img_user'].'" data-toggle="tooltip" data-placement="top" title="Janette" alt="avatar">';  
                       }

                 if($user_last_activity>$current_timestamp)
                 {
                     $status_user='<i class="material-icons online">fiber_manual_record</i>';
                 }else{
                     $status_user='<i class="material-icons offline">fiber_manual_record</i>';
                } 

                        
          ?>
          <?php  
              if ($row['not_user_m'] == $_SESSION['user_id']) 
              {
                $chat_user_id= $row['not_user_r'];
              }
              if ($row['not_user_r'] == $_SESSION['user_id']) 
              {
                $chat_user_id= $row['not_user_m'];
              }
             
          ?>
            <a  id='click_chat_user' not-id="<?php echo $row['not_id']; ?>" user-chat="<?php echo $chat_user_id ?>" href="#list-chat" class="filterDiscussions all unread single active read" id="list-chat-list" data-toggle="list" role="tab">
             <?php echo $img_user; ?>
           <div class="status">
             <?php echo $status_user; ?>
        </div>
        <div class="new bg-yellow">
            <span>+7</span>
       </div>
        <?php
          if ($row['read'] =="yes_read") 
          {
            $clor_read='style="color:#808080;"';
          }else{
            $clor_read='';
          }
        ?>
        <div  class="data">
        <h5 <?php echo $clor_read;?>><?php echo vew_name_chat_user($chat_user_id,$connect); ?></h5>
         <span>Mon</span>
           <p><strong <?php echo $clor_read;?>>
         <?php 
              if ($row['img'] == "yes_img")  
              {
                echo "I have sent a picture of you..";
              }
             $massges=substr($row['text_not'],0,20);
             $Length_line =strlen($massges);
             if ($Length_line >= 20) 
             {
              echo substr_replace($massges,'....',$Length_line,0);
             }else{
              echo $massges;
             }

          ?>
            </strong>
        </p>
       </div>
      </a>
      <?php
         }

        } 

       
        function vew_name_chat_user($user,$connect)
        {
           $query='
                 SELECT * FROM infr_user
                 where user_id ="'.$user.'"';

                 $stm=$connect->prepare($query);
                 $stm->execute();
                 $etchmsr=$stm->fetchAll();
                 foreach ($etchmsr as $row) 
                 {
                   return $row['username'];
                }
               }

        if ($_POST['action'] == "massge_read") 
        {
            $query='
           UPDATE `notices` SET`read`="yes_read"
           WHERE not_id="'.$_POST['not_id'].'"';

            $stm=$connect->prepare($query);
            $stm->execute();
        }

    if ($_POST['action'] == 'delete_chat_all') 
    {
        $query1='
           DELETE FROM chat 
           WHERE user_id_r="'.$_SESSION['user_id'].'"
           OR user_id_m="'.$_SESSION['user_id'].'"
           ';
        $stm1=$connect->prepare($query1);
        
        if ($stm1->execute()) 
        {
         $query='
           DELETE FROM notices 
           WHERE not_user_r="'.$_SESSION['user_id'].'"
           OR not_user_m="'.$_SESSION['user_id'].'"
           ';
           $stm=$connect->prepare($query);
           $stm->execute();
         }
       }
    
       if ($_POST['action'] == 'delete_chat') 
        {
         $query1='
            SELECT * FROM chat 
            where user_id_m="'.$_SESSION['user_id'].'"
            OR user_id_r="'.$_SESSION['user_id'].'"
           ';
          $stm1=$connect->prepare($query1);
          $stm1->execute();
          $fetch=$stm1->fetchAll();
          foreach ($fetch as $row) 
          {  
           $query='
            INSERT INTO block_chat_session(chat_id,block_user_massge)
            VALUES ("'.$row['chat_id'].'","'.$_SESSION['user_id'].'")
           ';
         $stm=$connect->prepare($query);
         $stm->execute();
        }
         }

         if ($_POST['action'] == 'Acceptance_user_chat') 
         {
             $query='
              INSERT INTO chat(user_id_r,user_id_m,mssge) 
              VALUES ("'.$_POST['Acceptance_user_chat'].'","'.$_SESSION['user_id'].'","Your message has been approved")
             ';
            $stm=$connect->prepare($query);
            $stm->execute();
         }

          if ($_POST['action'] == 'night_mode') 
         {
             $query='
             UPDATE infr_user SET
             mode="yes_mode" WHERE 
             user_id="'.$_SESSION['user_id'].'"
             ';
            $stm=$connect->prepare($query);
            $stm->execute();
         }
         if ($_POST['action'] == 'Cancel_night_mode') 
         {
             $query='
             UPDATE infr_user SET
             mode="no_mode" WHERE 
             user_id="'.$_SESSION['user_id'].'"
             ';
            $stm=$connect->prepare($query);
            $stm->execute();
         }
         
      ?>   