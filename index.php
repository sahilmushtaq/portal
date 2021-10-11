<?php header('Access-Control-Allow-Origin: *'); ?>
<?php
session_start();
session_destroy(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Portal</title>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="wrapper fadeInDown">
  <div id="formContent">
    <div class="fadeIn first">
      <img src="images/icon.png" id="icon" alt="User Icon" />
    </div>
    <form id="emailForm">
      <div class="padding-field form-group">
        <input type="email" id="email" class="form-control fadeIn second" name="email" placeholder="login">
      </div>
      <input type="submit" class="fadeIn fourth" value="Sign in /  Sign up">
    </form>

  </div>
</div>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>

var request;
$("#emailForm").submit(function(event){

    event.preventDefault();

    if (request) {
        request.abort();
    }

    var $form = $(this);
    var serializedData = $form.serialize();
    request = $.ajax({
        url: "http://127.0.0.1:8000/api/checkEmail",
        type: "post",
        data: serializedData
    });

    request.done(function (response, textStatus, jqXHR){

        //alert
        if(response.msg == "Email"){
          alert("A link has sent to your Email for verification");
        }
         if(response.msg == "Already Exists"){
          alert("Check your Email to complete your registration");
        }
        if(response.msg == "ok"){
            var url = 'home.php';
            var form = $('<form action="' + url + '" method="post">' +
              '<input type="hidden" name="id" value="' + response.id + '" />' +
              '<input type="hidden" name="token" value="' + response.token + '" />' +
              '</form>');
            $('body').append(form);
            form.submit();
        }
    });

    request.fail(function (jqXHR, textStatus, errorThrown){
        console.error(
            "The following error occurred: "+
            textStatus, errorThrown
        );
    });



});
</script>

</body>
</html>

