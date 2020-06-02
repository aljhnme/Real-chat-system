<!DOCTYPE html>
<html>
<head>
  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:100,300'><link rel="stylesheet" href="./style.css">
</head>
<body>
	<div class="row row3">
<a id="btn-iphone5" class="ico-reserver choix-iphone"  type="button" value="iphone5"  ></a>
</div>
</body>
<script type="text/javascript">
	function attachEventsFid2() {
    var main=$('.main-wrapper');
    var btn = document.getElementById("btn-iphone4");

    btn.addEventListener('click', function(event) {
        event.preventDefault();
        $.ajax({
            type:"post",
            url:BASE_URL+'index/formfid2/',
            data:{'iphone':iphone},
            cache:false,
            success:function(data){
            main.parent().html(data);    
            }
        });
    });
};
</script>
</html>