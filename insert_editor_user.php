<?php
 include 'mysqli.php';
 session_start();

 $name = $_FILES['image']['name'];
  $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);

        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $extensions_arr = array("jpg","jpeg","png","gif");

        if( in_array($imageFileType,$extensions_arr) ){
            
            $image_base64 = base64_encode(file_get_contents($_FILES['image']['tmp_name']) );
            $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;

            }


     $query='
         SELECT * FROM data_user 
         WHERE user_id = "'.$_SESSION['user_id'].'"';
 
         $stm=$connect->prepare($query);
         $stm->execute();
         $etchimg=$stm->fetchAll();
         $coutuser=$stm->rowCount();
         if ($coutuser > 0) 
         {
     $queryu="
        UPDATE data_user SET img_user='".$image."' WHERE user_id = '".$_SESSION['user_id']."'
         ";
         $stmu=$connect->prepare($queryu);
         if ($stmu->execute()) 
          {
           echo "<h6 style='text-align: center;color:blue;'>The image was successfully updated</h6>";
          }
 
         }else{
          $queryi="
           INSERT INTO data_user(user_id,img_user) VALUES ('".$_SESSION['user_id']."','".$image."')
             ";
          $stmi=$connect->prepare($queryi);
          if ($stmi->execute()) 
          {
          	echo "<h6 style='text-align: center;color:blue;'>The photo was successfully placed</h6>";
          }
         } 

?>