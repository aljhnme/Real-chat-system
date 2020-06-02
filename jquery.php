<script src="https://code.jquery.com/jquery-1.9.1.min.js">
</script>
<script type="text/javascript">
 $(document).ready(function (){
   $(document).on('click','.register',function(){
         
          var password=$("#password").val();
          var passwordc=$("#passwordc").val();
          var username=$("#username").val();
          var action ="reister";

        $.ajax({
           url:"insert_val.php",
           type:"post",
           data:{username:username,password:password,passwordc:passwordc,action:action},
           success:function(data)
           {
           	  $(".mass").html(data);
           }
        });
      });
    $(document).on('click','.login',function(){

          var password=$("#password").val();
          var username=$("#username").val();
          var action ="login";
          var remember_me=$('#remember').is(':checked');

          $.ajax({
           url:"insert_val.php",
           type:"post",
           data:{username:username,password:password,action:action
            ,remember_me:remember_me},
           success:function(data)
           {
              if (data.replace('good', "") !== data)
              {
               window.location.replace('index.php');
              }else{
              $(".tsl").html(data);
              }
           }
      });
   });

   $('#save_editor').click(function(){
          var last_name=$('#last_name').val();
          var first_name=$('#first_name').val();
          var username=$('#username').val();
          var Location=$('#Location').val();
          var password=$('#password').val();
          var action="editor_data";
          $.ajax({ 
           url:"insert_val.php",
           type:"post",
           data:{last_name:last_name,first_name:first_name
            ,Location:Location,password:password,username:username,action:action},
           success:function(data)
           {
             $("#massage").html(data);
           }
        });
     });
      $('.massages').click(function(){
        $('#t').html("<h6 style='color:red;cursor:pointer;'>Are you sure you want to delete your account? If you want to delete,click here</6>");
      });
      $('.delete_account').click(function()
      {
        var action="delete_account";
        $.ajax({ 
           url:"insert_val.php",
           type:"post",
           data:{action:action},
           success:function(data)
           {
             if (data.replace('delete_yes',"") !== data)
             { 
               window.location.replace('logout.php');
             }
           }
        });
     });


     $(document).on('click','#save_image',function(){
         
        var file=new FormData();
        var image=$("#image")[0].files[0];
        file.append('image',image);

        $.ajax({ 
           url:"insert_editor_user.php",
           type:"post",
           data:file,
           processData:false,
           contentType:false,
           success:function(data)
           {
             $("#massage").html(data);
           }
        });
     });
     
     setInterval(function() {
          fetch_Status();
      },5000);

      function fetch_Status(){
       $.ajax({ 
           url:"status.php",
           success:function(data)
           {

           }
        });
      }
      fetch_user_all();
      function fetch_user_all()
      {
           $.ajax({ 
           url:"fetch_user_all.php",
           success:function(data)
           {
              $("#user_all").html(data);
           }
        });
      } 
      $(document).on('click','#status',function()
      {
             
        var type_status=$(this).attr('data-id');
         $.ajax({ 
           url:"fetch_user_all.php",
           type:"post",
           data:{type_status:type_status},
           success:function(data)
           {
              $("#user_all").html(data);
           }
        });
     });
      $(document).on('click','#send_massge',function(){

           var add_user=$("#add_user").val();
           var massge=$(".massge").val();
        $.ajax({ 
           url:"insert_chat.php",
           type:"post",
           data:{add_user:add_user,massge:massge},
           success:function(data)
           {
             $('#text_sm').html(data);
           }
        });
      });

    $(document).on('click','#click_chat_user',function(){

         var action="fetch_massge_user";
         var user_chat=$(this).attr('user-chat');
         $.ajax({ 
           url:"insert_val.php",
           type:"post",
           data:{action:action,user_chat:user_chat},
           success:function(data)
           {
             $('#text').html(data);
           }
        });
    });

    $(document).on('click','.send',function(){

           var fd=new FormData();

           var imge_chat=$("#imge_chat")[0].files[0];
           fd.append('imge_chat',imge_chat);

           var add_user=$(this).attr('id');
           fd.append('add_user',add_user);

           var massge=$("#text_chat").val();
           fd.append('massge',massge);

           var user_chat=$(this).attr('user-chat');
           var action="fetch_massge_live";
 
       $.ajax({ 
            url:"insert_chat.php",
            type:"post",
            data:fd,
            processData:false,
            contentType:false,
            success:function(data)
            { 

              fetch_user_mssge_read();
              $.ajax({ 
                 url:"insert_val.php",
                 type:"post",
                 data:{action:action,user_chat:user_chat},
                 success:function(data)
                 {  
                    $('#massges').html(data);
                    $('#text_chat').reset[0]
                 }
              });
            }
        });
     });

   $(document).on('click','.delete_massg',function(){
        
       var user_chat_delete=$(this).attr('id');
       var action='delete_massges';
        $.ajax({ 
           url:"insert_val.php",
           type:"post",
           data:{action:action,user_chat_delete:user_chat_delete},
           success:function(data)
           {  
             $('#massges').html(data);
           }
        });
     });

 $(document).on('click','.Acceptance_user',function(){
        
       var Acceptance_user_chat=$(this).attr('id');
       var action='Acceptance_user_chat';
        $.ajax({ 
           url:"insert_val.php",
           type:"post",
           data:{action:action,Acceptance_user_chat:Acceptance_user_chat},
           success:function(data)
           {  
             $('#massges').html('<h5 style="text-align: center;color:blue;">The message has been approved</h5>');
           }
        });
     });

   $(document).on('click','.read',function(){
       
       var not_id=$(this).attr('not-id');
       var action='massge_read';
        $.ajax({ 
           url:"insert_val.php",
           type:"post",
           data:{action:action,not_id:not_id},
           success:function(data)
           {  
              fetch_user_mssge_read();
           }
        });

   });

   $(document).on('click','.block_user',function(){

        var user_id_clock=$(this).attr('id');
        var action="block_user";
        $.ajax({ 
           url:"insert_val.php",
           type:"post",
           data:{action:action,user_id_clock:user_id_clock},
           success:function(data)
           {  
             $('#massges').html('');
           }
        });
     });

      $('#defaultUnchecked').change(function() {
        if ($('#defaultUnchecked').is(':checked')) {
         var action='night_mode';
         $.ajax({ 
            url:"insert_val.php",
            type:"post",
            data:{action:action},
            success:function(data)
            {  
              window.location.replace('index.php');
            }
        });
       }else{
         var action='Cancel_night_mode';
         $.ajax({ 
            url:"insert_val.php",
            type:"post",
            data:{action:action},
            success:function(data)
            {  
             window.location.replace('index.php');
            }
        });
      }
    });

    $(document).on('click','#click_delete',function(){
            
      if ($('.delete_chat_all').is(":checked"))
       {
         var action='delete_chat_all';
         $.ajax({ 
            url:"insert_val.php",
            type:"post",
            data:{action:action},
            success:function(data)
            {  
              $('#massges').html('');
              fetch_user_mssge_read();  
            }
        });
      }

      if ($('.delete_chat').is(":checked"))
       {
         var action='delete_chat';
         $.ajax({ 
            url:"insert_val.php",
            type:"post",
            data:{action:action},
            success:function(data)
            {  
              $('#massges').html('');
              fetch_user_mssge_read(); 
            }
        });
      }
   });

$("input:checkbox").on('click', function() {

  var $box = $(this);
  if ($box.is(":checked")) {
    
    var group = "input:checkbox[name='" + $box.attr("name") + "']";
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});
   });    

 function showimguser(objFileInput) {
    if (objFileInput.files[0]) {
        var fileReader = new FileReader();
        fileReader.onload = function (e) {
           $("#imge_new_user").html('<img src="'+e.target.result+'"class="avatar-xl" alt="image"  />');   
         }
    fileReader.readAsDataURL(objFileInput.files[0]);
      }
      $("#save_image").show();
     }  

      function showimgchat(objFileInput) {
    if (objFileInput.files[0]) {
        var fileReader = new FileReader();
        fileReader.onload = function (e) {
           $("#show_live_imgchat").html('<img src="'+e.target.result+'" style="width:300px;"  />');   
         }
    fileReader.readAsDataURL(objFileInput.files[0]);
      }
     }  

      fetch_user_mssge_read();
      function fetch_user_mssge_read()
      {
      
      var action='fetch_user_mssge_read';
      $.ajax({ 
           url:"insert_val.php",
           type:"post",
           data:{action:action},
           success:function(data)
           {  
            $('#fetch_user_mssge_read').html(data);
           }
        });
      }
$(document).on('click','.version', function() {

    var type=$(this).attr('data-type');
    $('#massget').html('<p class="text-light bg-dark">We will add this feature in the next version ..'+type+'..</p>');

});

</script>