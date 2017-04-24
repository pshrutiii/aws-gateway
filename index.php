<!DOCTYPE html>
<?php echo "hello PHP"?>
<html>
<head>
<title>Starbucks Page</title>
</head>
<body>

<h1>Testing page</h1>
<p>Trial paragraph</p>
 
<form method="post" action="" name="contact_form" id="contact_form" >
<div class="row">
			<div class="label"><span style="color:#F00;">*</span>Name: </div>
			<div class="input-row" ><input name="your_name" id="your_name" type="text" class="textbox" autocomplete="off"><span id="your_nameErr" class="error" ></span></div>
		</div>
 
<div class="row">
			<div class="label"><span style="color:#F00;">*</span>Email: </div>
			<div class="input-row" ><input name="your_email" id="your_email" type="text" class="textbox" autocomplete="off"><span id="your_emailErr" class="error" ></span></div>
 
		</div>
 
<div class="row">
			<div class="label"></div>
			<div class="dummy-container" ><input type="submit" name="sub" value="Send" > <span class="loading"></span> </div>
		</div>
 
<!--Form final confirmation of form submission-->
<div class="output"></div>
 
</form>


</body>
</html>