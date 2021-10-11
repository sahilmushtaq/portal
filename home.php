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
	$token = "";
	if($_POST){
		$id = $_POST['id'];
		$token = $_POST['token'];
		$_SESSION['portal'] = $token;
	}
	if($_GET){
		$id = $_GET['id'];
		$token = $_GET['token'];

		$_SESSION['portal'] = $token;
		// print_r($_GET);
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
    // Variable to hold request
var request;

// Bind to the submit event of our form
$("#emailForm").submit(function(event){

    // Prevent default posting of form - put here to work in case of errors
    event.preventDefault();

    // Abort any pending request
    if (request) {
        request.abort();
    }
    // setup some local variables
    var $form = $(this);

    // Let's select and cache all the fields
    // var $inputs = $form.find("input, select, button, textarea");

    // Serialize the data in the form
    var serializedData = $form.serialize();

    // Let's disable the inputs for the duration of the Ajax request.
    // Note: we disable elements AFTER the form data has been serialized.
    // Disabled form elements will not be serialized.
    // $inputs.prop("disabled", true);

    // Fire off the request to /form.php
    request = $.ajax({
        url: "http://127.0.0.1:8000/api/changeEmail",
        type: "post",
        headers: {
	        "Accept":"application/json",
	        "Authorization": "<?php echo $token; ?>"
	    },
        data: serializedData
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){
        // Log a message to the console
        // console.log("Hooray, it worked!");
        console.log(response);
        alert(response);
    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        // Log the error to the console
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

