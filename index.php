
<?php
session_start();

if (!isset($_SESSION['user_id'])) 
{
	header('location:sign-in.php'); 
}

include 'mysqli.php';
?>
<?php
   $query='
      SELECT * FROM data_user 
      WHERE user_id="'.$_SESSION['user_id'].'"';
   
       $stmc=$connect->prepare($query);
       $stmc->execute();
       $countimg=$stmc->rowCount();
       $fetchimg=$stmc->fetchAll();
?>
<!DOCTYPE html>
<html  lang="en" id="body">
<head>
		<meta charset="utf-8">
		<title>Swipe – The Simplest Chat Platform</title>
		<meta name="description" content="#">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="dist/css/lib/bootstrap.min.css" type="text/css" rel="stylesheet">
		<link href="dist/css/swipe.min.css" type="text/css" rel="stylesheet">
		<link href="dist/img/favicon.png" type="image/png" rel="icon">
	</head>
	<body>
		<?php
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
                  $mode4='style="background:#706E6A;"';
                  $mode5='style="background:#53524E;"';
                  $mode6='style="background:#53524E;"';
                  $mode9='style="background:#808080;"';
                  $mode10='style="background:#686868;"';
              }else{
                 $mode4='';
                 $mode5=''; 
                 $mode6='';
                 $mode9='';
                 $mode10='';
              }
		?>
		<main >
		 <div class="layout"> 
		    <div <?php echo $mode4;  ?>  class="navigation">
			  <div class="container">
			  <div class="inside">
			  <div class="nav nav-tab menu">
				 <button class="btn">
				  <?php
                    if ($countimg > 0) 
                    {
                     foreach ($fetchimg as $rowimg) 
                       {
                       	  echo '<img class="avatar-xl" 
                       	 	src="'.$rowimg['img_user'].'" alt="avatar">';  
                        }
                        }else{
                            echo '<img class="avatar-xl" 
                       	 	src="img_profile.jpg" alt="avatar">';    
                        }
                      ?>
				 </button>
				 <a href="#members" id="status" data-id="all" data-toggle="tab"><i class="material-icons">account_circle</i></a>
				 <a href="#discussions" data-toggle="tab" class="active"><i class="material-icons active">chat_bubble_outline</i></a>
				    <button class="btn mode"><i class="material-icons">brightness_2</i></button>
				      <a href="#settings" data-toggle="tab"><i class="material-icons">settings</i></a>
                        <a href="logout.php">
				         <button class="btn power" ><i class="material-icons">power_settings_new</i></button></a>
							</div>
						</div>
					</div>
				</div>
				<div  <?php echo $mode5;  ?> class="sidebar" id="sidebar">
				  <div class="container">
				    <div class="col-md-12">
					  <div class="tab-content">
						 <div class="tab-pane fade" id="members">
							<div class="search">
							  <form class="form-inline position-relative">
								 <input type="search" class="form-control" id="people" placeholder="Search for people...">
								 <button type="button" class="btn btn-link loop"><i class="material-icons">search</i>
								 </button>
							 </form>
							     <button class="btn create" data-toggle="modal" data-target="#exampleModalCenter"><i class="material-icons">person_add</i></button>
							 </div>
							 <div class="list-group sort">
							    <button id="status" data-id="all" class="btn filterMembersBtn active show" data-toggle="list" data-filter="all">All</button>
								<button id="status" data-id="online"; class="btn filterMembersBtn" data-toggle="list" data-filter="online">Online</button>
								<button id="status"  data-id="offline" class="btn filterMembersBtn" data-toggle="list" data-filter="offline">Offline</button>
						     </div>						
		 <div class="contacts">
		   <h1>Contacts</h1>
		   <div class="list-group" id="contacts" role="tablist">
		   	<div id="user_all">	 
		   	</div>       
          </div>
	    </div>
      </div>
  <div  id="discussions" class="tab-pane fade active show">
		 <div class="search">
				 <form class="form-inline position-relative">
					 <input type="search" class="form-control" id="conversations" placeholder="Search for conversations...">
					 <button type="button" class="btn btn-link loop"><i class="material-icons">search</i></button>
				</form>
					 <button class="btn create" data-toggle="modal" data-target="#startnewchat"><i class="material-icons">create</i></button>
			 </div>				
		   <div class="discussions">
			  <h1>Discussions</h1>

		   <div class="list-group" id="chats" role="tablist">
               <div id="fetch_user_mssge_read">
               	
               </div>
           </div>
        </div>
     </div>
			 <div class="tab-pane fade" id="settings">			
				 <div class="settings">
					 <div class="profile">
	                 <?php
                       if ($countimg > 0) 
                       {
                       	 foreach ($fetchimg as $rowimg) 
                       	 {
                       	 	
                       	 	echo '<img class="avatar-xl" 
                       	 	src="'.$rowimg['img_user'].'" alt="avatar">';  
                       	 }
                         }else{
                         	echo '<img class="avatar-xl" 
                       	 	src="img_profile.jpg" alt="avatar">';    
                        }
                      ?>
                   <?php
                     $query='
                         SELECT * FROM infr_user 
                         WHERE user_id = "'.$_SESSION['user_id'].'"';
 
                        $stm=$connect->prepare($query);
                        $stm->execute();
                        $etchimg=$stm->fetchAll();
                        foreach ($etchimg as $row) 
                        {
			   	     ?>
                     <h1><a href="#">
                     <?php
                      if ($row['last_name'] != "") 
                      {
                         echo $row['last_name'];
                      }
                      if ($row['first_name'] != "") 
                      {
                      	 echo $row['first_name'];
                      }
                       
                      if ($row['last_name'] == "" &&
                          $row['first_name']== "") 
                      {
                      	  echo $row['username'];
                      }
                       
                     ?>
                   
                     </a></h1>
					  <span><?php  echo $row['username']; ?></span>
					 <div class="stats">
						 <div class="item">
							 <h2>122</h2>
							 <h3>Fellas</h3>
							   </div>
					 <div class="item">
							 <h2>305</h2>
							 <h3>Chats</h3>
					 </div>
					 <div class="item">
						 <h2>1538</h2>
						 <h3>Posts</h3>
					 </div>
				  </div>
			 </div>
			 <div class="categories" id="accordionSettings">
					 <h1>Settings</h1>
			  <div class="category">
				 <a href="#" class="title collapsed" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					 <i class="material-icons md-30 online">person_outline</i>
			 <div class="data">
					 <h5>My Account</h5>
						 <p>Update your profile details</p>
		    </div>
					 <i class="material-icons">keyboard_arrow_right</i>
						 </a>
			  <div class="collapse" id="collapseOne" aria-labelledby="headingOne" data-parent="#accordionSettings">
				 <div class="content">
					 <div class="upload">
						 <div class="data">
						 	<div id="imge_new_user">
						 	
						    </div>
						     <?php

						     if ($countimg > 0) 
						     {
						     	 foreach ($fetchimg as $rowimg) 
						     	 {
						     	   echo '<img class="avatar-xl imguser" src="'.$rowimg['img_user'].'" alt="image">';
						     	 }
						     }else{
						     	echo '<img class="avatar-xl imguser" src="img_profile.jpg" alt="image">';
						     }
						     ?>
							 
							  <label>
							  <input onchange="showimguser(this)" type="file" id="image">
								 <span class="btn button">Upload avatar</span>
								 </label>
						 
					    </div>
							 <p>For best results, use an image at least 256px by 256px in either .jpg or .png format!</p>
						 </div>
						 <div class="parent">
							 <div class="field">
								 <label for="first_name">First name <span>*</span></label>
								 <input type="text" class="form-control" id="first_name" placeholder="First name" 
								 value="<?php echo $row['first_name']; ?>" required>
						 </div>
							<div class="field">
							   <label for="last_name">Last name <span>*</span></label>
								 <input type="text" class="form-control" id="last_name" placeholder="Last name"
								 value="<?php echo $row['last_name']; ?>" required>
						   </div>
						 </div>
								<div class="field">
								  <label for="username">Username <span>*</span></label>
									 <input type="Username" class="form-control" id="username" placeholder="Enter your username address" value="<?php echo $row['username']; ?>" required>
						 </div>
						   <div class="field">
							  <label for="password">Password</label>
									 <input type="password" class="form-control" id="password" placeholder="Enter a new password" value="" required>
						  </div>
							 <div class="field">
								 <label for="location">Location</label>
									 <input type="text" class="form-control" id="Location" placeholder="Enter your location" value="<?php echo $row['location']; ?>" required>
							 </div>
							 <div class="delete_account" id="t">
							 </div>
							 <div  id="massage">
							 </div>
							 <button  class="btn btn-link w-100 massages">Delete Account</button>
							     <button id="save_editor" type="submit" class="btn button w-100">Apply</button>
							     <br>
							     <br>
							      <button style="display:none;" 
							      id="save_image" type="submit" class="btn button w-100">save image</button>
						  </div>
						<?php
						   }
						?>
					 </div>
					</div>
					 <div class="category">
						 <a class="title collapsed" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
							 <i class="material-icons md-30 online">mail_outline</i>
					  <div class="data">
						 <h5>Chats</h5>
							 <p>Check your chat history</p>
					 </div>
							 <i class="material-icons">keyboard_arrow_right</i>
					         </a>
					   <div class="collapse" id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordionSettings">
						 <div class="content layer">
							 <div class="history">
							  <p>When you clear your conversation history, the messages will be deleted from your own device.</p>
							 <p>The messages won't be deleted or cleared on the devices of the people you chatted with.</p>
				      <div class="custom-control custom-checkbox">
						 <input type="checkbox"  name="fooby[1][]" class="custom-control-input delete_chat" id="same-address">
							 <label class="custom-control-label" for="same-address">The messages won't be deleted or cleared on the devices of the people you chatted with</label>
					 </div>
					 <div class="custom-control custom-checkbox">
						 <input type="checkbox"  name="fooby[1][]" class="custom-control-input delete_chat_all" id="save-info">
							 <label class="custom-control-label" for="save-info">Messages will be deleted completely.</label>
					 </div>
							 <button id="click_delete" type="submit" class="btn button w-100">Clear blah-blah</button>
					 </div>
					</div>
				 </div>
			 </div>
											
				 <div class="category">
					 <a href="#" class="title collapsed" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
						 <i class="material-icons md-30 online">notifications_none</i>
					     <div class="data">
							 <h5>Notifications</h5>
							 <p>Turn notifications on or off</p>
						 </div>
							 <i class="material-icons">keyboard_arrow_right</i>
								 </a>
					    <div class="collapse" id="collapseThree" aria-labelledby="headingThree" data-parent="#accordionSettings">
						   <div class="content no-layer">
							  <div class="set">
						  <div class="details">
							 <h5>Desktop Notifications</h5>
								 <p>You can set up Swipe to receive notifications when you have new messages.</p>
						 </div>
							 <label class="switch">
								 <input type="checkbox" checked>
									 <span class="slider round"></span>
						    </label>
					    </div>
					    <div class="set">
						   <div class="details">
							 <h5>Unread Message Badge</h5>
								 <p>If enabled shows a red badge on the Swipe app icon when you have unread messages.</p>
						  </div>
							 <label class="switch">
								 <input type="checkbox" checked>
									 <span class="slider round"></span>
							 </label>
						 </div>
							 <div class="set">
								 <div class="details">
									 <h5>Taskbar Flashing</h5>
									 <p>Flashes the Swipe app on mobile in your taskbar when you have new notifications.</p>
							    </div>
								   <label class="switch">
									 <input type="checkbox">
										 <span class="slider round"></span>
											 </label>
						 </div>
						 <div class="set">
							 <div class="details">
								 <h5>Notification Sound</h5>
									 <p>Set the app to alert you via notification sound when you have unread messages.</p>
							</div>
							   <label class="switch">
								 <input type="checkbox" checked>
									 <span class="slider round"></span>
										 </label>
						    </div>
								 <div class="set">
									 <div class="details">
										 <h5>Vibrate</h5>
										 <p>Vibrate when receiving new messages (Ensure system vibration is also enabled).</p>
						 </div>
							 <label class="switch">
								 <input type="checkbox">
									 <span class="slider round"></span>
								 </label>
					    </div>
				  </div>
			 </div>
         </div>
								 <div class="category">
									 <a href="#" class="title collapsed" id="headingFive" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
									   <i class="material-icons md-30 online">colorize</i>
							    <div class="data">
									 <h5>Appearance</h5>
										 <p>Customize the look of Swipe</p>
								 </div>
									 <i class="material-icons">keyboard_arrow_right</i>
									 </a>
								 <div class="collapse" id="collapseFive" aria-labelledby="headingFive" data-parent="#accordionSettings">
									 <div class="content no-layer">
										 <div class="set">
											 <div class="details">
												 <h5>Turn Off Lights</h5>
												 <p>The dark mode is applied to core areas of the app that are normally displayed as light.</p>
								 </div>
								 <?php
                                 foreach ($etchimg as $row) 
								 { 
								    if ($row['mode'] == "yes_mode") 
								    {
								       $checked='checked';
								    }else{
                                       $checked='';
								    }
								    
								 }
								 ?>
								  <div class="custom-control custom-checkbox">
                                    <input <?php echo $checked;  ?> type="checkbox" class="custom-control-input" 
                                    id="defaultUnchecked">
                                    <label class="custom-control-label" for="defaultUnchecked"></label>
                                </div>
							     </div>
						    </div>
						 </div>
					 </div>
						<div class="category">
						    <a href="#" class="title collapsed" id="headingSix" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
							   <i class="material-icons md-30 online">language</i>
						 <div class="data">
							 <h5>Language</h5>
								 <p>Select preferred language</p>
						 </div>
							  <i class="material-icons">keyboard_arrow_right</i>
								 </a>
						<div class="collapse" id="collapseSix" aria-labelledby="headingSix" data-parent="#accordionSettings">
							 <div class="content layer">
								 <div class="language">
									 <label for="country">Language</label>
										 <select class="custom-select" id="country" required>
										 <option value="">Select an language...</option>
										 <option>English, UK</option>
										 <option>English, US</option>
										 </select>
								 </div>
							 </div>
						  </div>
						</div>
						 <div class="category">
							 <a href="#" class="title collapsed" id="headingSeven" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
								 <i class="material-icons md-30 online">lock_outline</i>
						 <div class="data">
							  <h5>Privacy & Safety</h5>
								  <p>Control your privacy settings</p>
						 </div>
								 <i class="material-icons">keyboard_arrow_right</i>
								 </a>
						 <div class="collapse" id="collapseSeven" aria-labelledby="headingSeven" data-parent="#accordionSettings">
							 <div class="content no-layer">
								 <div class="set">
								    <div class="details">
									  <h5>Keep Me Safe</h5>
									  <p>Automatically scan and delete direct messages you receive from everyone that contain explict content.</p>
						  </div>
								 <label class="switch">
									 <input type="checkbox">
										 <span class="slider round"></span>
											 </label>
						 </div>
						  <div class="set">
							 <div class="details">
								 <h5>My Friends Are Nice</h5>
								   <p>If enabled scans direct messages from everyone unless they are listed as your friend.</p>
							 </div>
						  <label class="switch">
							 <input type="checkbox" checked>
								 <span class="slider round"></span>
							 </label>
						 </div>
							 <div class="set">
								 <div class="details">
									 <h5>Everyone can add me</h5>
										 <p>If enabled anyone in or out your friends of friends list can send you a friend request.</p>
								 </div>
										 <label class="switch">
											 <input type="checkbox" checked>
											 <span class="slider round"></span>
										 </label>
								 </div>
								 <div class="set">
									 <div class="details">
										 <h5>Friends of Friends</h5>
										 <p>Only your friends or your mutual friends will be able to send you a friend reuqest.</p>
									 </div>
										 <label class="switch">
											 <input type="checkbox" checked>
												 <span class="slider round"></span>
												 </label>
									 </div>
									 <div class="set">
										 <div class="details">
											 <h5>Data to Improve</h5>
												 <p>This settings allows us to use and process information for analytical purposes.</p>
										  </div>
									 <label class="switch">
										 <input type="checkbox">
											 <span class="slider round"></span>
									 </label>
										 </div>
							 <div class="set">
							 <div class="details">
								 <h5>Data to Customize</h5>
								 <p>This settings allows us to use your information to customize Swipe for you.</p>
							 </div>
								  <label class="switch">
										 <input type="checkbox">
										   <span class="slider round"></span>
								 </label>
							 </div>
						 </div>
					 </div>
				 </div>
				 <div class="category">
					 <a href="logout.php" class="title collapsed">
						 <i class="material-icons md-30 online">power_settings_new</i>
							 <div class="data">
								 <h5>Power Off</h5>
									 <p>Log out of your account</p>
							 </div>
									 <i class="material-icons">keyboard_arrow_right</i>
												</a>
								 </div>	
							 </div>
						 </div>
					 </div>
				 </div>
			</div>
		 </div>
	 </div>
				
		 <div  class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
		   <div class="modal-dialog modal-dialog-centered" role="document">
			 <div class="requests" <?php echo $mode10;  ?>>
				 <div class="title" <?php echo $mode9;  ?>>
					 <h1>Add your friends</h1>
						 <button type="button" class="btn" data-dismiss="modal" aria-label="Close"><i class="material-icons">close</i></button>
				 </div>
				 <div class="content">
					   <div class="form-group">
							 <label for="user">Username:</label>
							 <input id="add_user" type="text" class="form-control"placeholder="Add recipient..." required>
						 </div>
							 <div class="form-group">
							   <label for="welcome">Message:</label>
								 <textarea 
								 class="text-control massge" placeholder="Send your welcome message"></textarea>
							   </div>
							  <div id="text_sm"> 
                                 
							  </div>
							   <button id="send_massge" type="submit" class="btn button w-100">Send Friend Request</button>
							</div>
						</div>
					</div>
                 </div>

		  <div class="main">
			<div class="tab-content" id="nav-tabContent">
			<div class="babble tab-pane fade active show" id="list-chat" role="tabpanel" aria-labelledby="list-chat-list">
            <div class="chat" id="chat1">
           <div id="text">
           	<div <?php echo $mode6;?> class="chat" id="chat1">
           		<img src="empty.png" class="img-fluid" alt="Responsive image">
			</div>
           </div>
         </div>
        </div>
	  </div>
	 </div>
   </div>
	 </main>
		<script src="dist/js/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script>window.jQuery || document.write('<script src="dist/js/vendor/jquery-slim.min.js"><\/script>')</script>
		<script src="dist/js/vendor/popper.min.js"></script>
		<script src="dist/js/swipe.min.js"></script>
		<script src="dist/js/bootstrap.min.js"></script>
		<script>
			function scrollToBottom(el) { el.scrollTop = el.scrollHeight; }
			scrollToBottom(document.getElementById('content'));
		</script>
	</body>

	<?php
       include 'jquery.php';
	?>
</html>