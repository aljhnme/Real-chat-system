<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.1/themes/base/jquery-ui.css" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.1/jquery-ui.min.js"></script>
<title>Sandbox</title>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<style type="text/css" media="screen">
    .error-notification {
        background-color:#AE0000;
        color:White;
        display:none;
        cursor:pointer;
        padding:15px;
        padding-top: 0;
        position:absolute;
        z-index:1;
        font-size: 100%;
    }

    .error-notification h2 {
        font-family:Trebuchet MS,Helvetica,sans-serif;
        font-size:140%;
        font-weight:bold;
        margin-bottom:7px;
    }
</style>
</head>
<body>
<input type="button" class="showme" value="Show me the Dialog!"><br><br><br><br>

<script>
    $('.showme').click(function () {
        $('.error-notification').remove();
        var $err = $('<div>').addClass('error-notification')
        .html('<h2>Paolo is awesome</h2>(click on this box to close)')
         .css('left', $(this).position().left);
        $(this).after($err);
        $err.fadeIn('fast');
    });
    $('.error-notification').live('click', function () {
        $(this).fadeOut('fast', function () { $(this).remove(); });
    });

</script>