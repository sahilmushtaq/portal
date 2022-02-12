<?php header('Access-Control-Allow-Origin: *');?>
<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Portal</title>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php 
	$id = "";
	$token = "ss";
	if($_POST){
		$id = $_POST['id'];
		$token = $_POST['token'];
		$_SESSION['portal'] = $token;
	}
	if($_GET){
		$id = $_GET['id'];
		$token = $_GET['token'];

		$_SESSION['portal'] = $token;
	}
	if (!isset($_SESSION['portal'])) {
        echo "This page is not accessible directly";
    }
    else{
?>

<div class="wrapper fadeInDown">

	<div class="padding-field"><a href="index.php" >Logout</a></div>
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="images/icon.png" id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->
    <form id="emailForm">
    	<div class="padding-field form-group">
	        <input type="email" id="email" class="form-control fadeIn second" name="email" placeholder="Change Email">
	      </div>
      <input type="hidden" name="id" value="<?php if ($id) { echo $id; } ?>">
      <input type="hidden" name="token" value="<?php if ($token) { echo $token; } ?>">
      <input type="submit" class="fadeIn fourth" value="Change Email">
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
        url: "http://127.0.0.1:8000/api/changeEmail",
        type: "post",
        headers: {
	        "Accept":"application/json",
	        "Authorization": "<?php echo $token; ?>"
	    },
        data: serializedData
    });

    request.done(function (response, textStatus, jqXHR){
        console.log(response);
        alert(response);
    });

    request.fail(function (jqXHR, textStatus, errorThrown){
        console.error(
            "The following error occurred: "+
            textStatus, errorThrown
        );
    });



});
</script>
<?php 
}

?>
</body>
</html>

