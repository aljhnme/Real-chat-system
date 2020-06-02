     <?php
      session_start();
      include 'mysqli.php';
      $query='
             SELECT * FROM infr_user 
             WHERE username = "'.$_POST['add_user'].'" ';
 
               $stmn=$connect->prepare($query);
               $stmn->execute();
               $fetchuser=$stmn->fetchAll();
               $countuser=$stmn->rowCount();
               if ($countuser == 1) 
               {
                
               if (isset($_FILES['imge_chat']['name'])) 
               {
               $name = $_FILES['imge_chat']['name'];
               $target_dir = "upload/";
               $target_file = $target_dir.basename($_FILES["imge_chat"]["name"]);

               $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

               $extensions_arr = array("jpg","jpeg","png");

               if( in_array($imageFileType,$extensions_arr) ){
            
                 $image_base64 = base64_encode(file_get_contents($_FILES['imge_chat']['tmp_name']) );
                   $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;

                 }
                }else{
                   $image='';
                   $name='';
                }
                  foreach ($fetchuser as $row) 
                   {
                     $massge=$_POST['massge'];
                     $user_id_r=$row['user_id'];
                     $user_id_m=$_SESSION['user_id'];
                     $queryins="
                      INSERT INTO chat(user_id_r,user_id_m,mssge,img_chat,datet) 
                       VALUES ($user_id_r,$user_id_m,'".$massge."','".$image."','".date("Y:m:d")."')";

                 $stmins=$connect->prepare($queryins);
                 if ($stmins->execute()) 
                   { 
                
                    if ($name != "") 
                    {
                       $img='yes_img';
                    }else{
                       $img='no_img';

                    } 
                      $queryde='
                        DELETE FROM notices
                        where not_user_m ="'.$user_id_m.'" AND 
                        not_user_r="'.$user_id_r.'"
                        ';
                        $stmde=$connect->prepare($queryde);
                        if ($stmde->execute()) 
                        {
                         $queryin='
                         INSERT INTO 
                         notices(not_user_r,not_user_m,text_not,img) 
                         VALUES ("'.$user_id_r.'","'.$user_id_m.'","'.$massge.'","'.$img.'")';
                         $stmin=$connect->prepare($queryin);
                         $stmin->execute();
                        }
                         
                       echo"<h6 style='color:blue;'>Message has been sent</h6>";
                     }
                   }
                 }else{
                         echo"<h6 style='color:red;'>This username does not exist</h6>";
               }
 
?>