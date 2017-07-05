
<?php
	session_start();
    if(isset($_POST['last_id']))
    $last_id = $_POST['last_id'];		 
   
    $servername = "localhost";
	$username = "root";
	$password = "";
	$db="hrs";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password);

	// Check connection
	if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
	}

	// select database
    if (mysqli_select_db( $conn, $db) === false)
        die("Could not select database");
    
   
    $sql = sprintf("SELECT * FROM enquiry where temp_id=%d;",$last_id);
	$result = mysqli_query($conn, $sql);
	
	if($result!=true && mysqli_num_rows($result) == 1){
		die("Could Not Query the database & Ambigious Please Try Again");
	}
	
	while($row = mysqli_fetch_array($result)){	
    $temp_id=$row['temp_id'];
    $checkin=$row['checkin'];
    $checkout=$row['checkout'];
    $guests=$row['no_of_guests'];
    $type=$row['room_type'];     
	}
	
	
	
   $checkin1=date_create($checkin);
   $checkout1=date_create($checkout);
   $days=date_diff($checkin1,$checkout1);
   
   if($days->format("%R%a")<0){
	   die ("Invalid Check IN and Check out dates");
   }
	
?>
<?php

   
	
    if (isset($_POST["first_name"]) && isset($_POST["last_name"]) && isset($_POST["email"]) && isset($_POST["contact"]) && isset($_POST["id_type"]) && isset($_POST["id_no"])){
  
     //echo $last_id."OKAY NOW WHAT";
          
    $sql = sprintf("SELECT * FROM enquiry where temp_id=%d;",$last_id);
	$result = mysqli_query($conn, $sql);
	
	if($result!=true && mysqli_num_rows($result) == 1){
		die("Could Not Query the database & Ambigious Please Try Again");
	}
	
	while($row = mysqli_fetch_array($result)){	
    $temp_id=$row['temp_id'];
    $checkin=$row['checkin'];
    $checkout=$row['checkout'];
    $guests=$row['no_of_guests'];
    $type=$row['room_type'];     

	}
	echo "HELLO".$type.$guests.$checkin.$checkout;
	
	echo $days->format("%R%a")."NO.Of DAYS";

	// echo $checkin.$checkout;
	
	$sql="DELETE from enquiry WHERE temp_id='$last_id';";
	$result = mysqli_query($conn, $sql);
	if($result!=true ){
		die("Could Not Delete Query the database ");
	}
	
	
	
		$sql=sprintf("INSERT into customer(first_name,last_name,email,contact_no,id_type,id_number) values ('%s','%s','%s','%s','%s','%s');",
		             mysqli_real_escape_string($conn,$_POST["first_name"]),
					 mysqli_real_escape_string($conn,$_POST["last_name"]),
					 mysqli_real_escape_string($conn,$_POST["email"]),
					 mysqli_real_escape_string($conn,$_POST["contact"]),
					 mysqli_real_escape_string($conn,$_POST["id_type"]),
					 mysqli_real_escape_string($conn,$_POST["id_no"]));
		 
		$result = mysqli_query($conn,$sql);
		
		if ($result === false)
            die("Could not query database");
		
		
		
		$last_cus_id = mysqli_insert_id($conn);
		setcookie("customer_id",$last_cus_id, time() + 7200);
		
		echo "HELLO".$last_cus_id.$type.$_POST["last_name"].$guests.$checkin.$checkout;
		
		$sql=sprintf("SELECT price from room WHERE room_type='%s';",$type);
						$r1 = mysqli_query($conn,$sql);
						if ($r1 === false)
							die("Could not query database"); 
		
						$row = mysqli_fetch_array($r1);	
						$p=$row['price'];
						
						echo "THER IS THE ISSUE".$days->format("%R%a");
						$price=$row['price']*$days->format("%R%a");
						
			echo "HELLO".$last_cus_id.$type.$_POST["last_name"].$guests.$checkin.$checkout.$price;
		$sql=sprintf("INSERT into booking(customer_id,last_name,no_of_guest,checkin,checkout,room_type,price_paid) values ('%d','%s','%d','%s','%s','%s','%d');",
		             $last_cus_id,
					 mysqli_real_escape_string($conn,$_POST["last_name"]),
					 $guests,
					 $checkin,
					 $checkout,
					 $type,
					 $price);
					 
		 
		$result = mysqli_query($conn,$sql);
		
		
		
					 
		if ($result === false)
            die("Could not query database2");
		
		
		
		$last_book_id = mysqli_insert_id($conn);
		setcookie("booking_id",$last_book_id, time() + 7200);
       
		
		    $host = $_SERVER["HTTP_HOST"];
            $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
            header("Location: http://$host$path/confirmed.php");
            exit;
        
		
	}
	
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Monte Carlo</title>

  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700' rel='stylesheet' type='text/css'>
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet">  
  <link href="css/flexslider.css" rel="stylesheet">
  <link href="css/templatemo-style.css" rel="stylesheet">


  </head>
  <body class="tm-gray-bg">
  	<!-- Header -->
  	<div class="tm-header">
  		<div class="container">
  			<div class="row">
  				<div class="col-lg-5 col-md-4 col-sm-3 tm-site-name-container">
  					<a href="index.php" class="tm-site-name">Monte Carlo</a>	
  				</div>
	  			<div class="col-lg-7 col-md-8 col-sm-9">
	  				<div class="mobile-menu-icon">
		              <i class="fa fa-bars"></i>
		            </div>
	  				<nav class="tm-nav">
						<ul>
							<li><a href="index.php" class="active">Home</a></li>
							<li><a href="about.html">About</a></li>
							<li><a href="index.php">Facilities</a></li>
							<li><a href="contact.php">Contact</a></li>
							
						</ul>
					</nav>		
	  			</div>				
  			</div>
  		</div>	  	
  	</div>
	
	
	<!-- white bg -->
	<section class="tm-white-bg section-padding-bottom">
	  <section class="panel">
	  
	        <div align="center" >
                <h4  class="panel-heading">
                    <b> Guest Details </b>
                </h4>
			</div>
			
<script>
function validateForm() {
		var x = document.forms["myForm"]["fname"].value;
			if (x == null || x == "") {
				alert("Name must be filled out");
				return false;
			}
		}
function phonenumber(inputtxt)  
{  
  var phoneno = /^\d{10}$/;  
  if(inputtxt.value.match(phoneno))  
  {  
      return true;  
  }  
  else  
  {  
     alert("Not a valid Phone Number");  
     return false;  
  }  
  }  
function myFunction() {
    var inpObj = document.getElementById("number");
    if (inpObj.checkValidity() == false) {
        document.getElementById("demo").innerHTML = inpObj.validationMessage;
    } else {
        document.getElementById("demo").innerHTML = "Input OK";
    }
}
</script>
                <div style="padding-right:15%" class="panel-body">
                    <form action="confirmDetails.php" class="form-horizontal tasi-form" method="post">
                        
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label" >First Name</label>
                            <div class="col-sm-10">
                                <input type="text" id="name" name="first_name" class="form-control" required >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label" >Last Name</label>
                            <div class="col-sm-10">
                                <input type="text" id="surname" name="last_name" class="form-control" required >
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label" >Email</label>
                            <div class="col-sm-10">
                               <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label" >Contact Number</label>
                            <div class="col-sm-10">
                               <input type="text" id="number"  name="contact" maxlength="10" pattern="\d{10}" class="form-control" required >
							   <p id="demo"></p>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">ID Type</label>
                            <div class="col-sm-10">
                               <select name="id_type" "class="form-control" placeholder="Select ID" required />
										<option value="aadharcard">Aadhar Card</option>
										<option value="passport">Passport</option>
										<option value="pancard">Pan Card</option>
								</select> 
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">ID Number</label>
                            <div class="col-sm-10">
                               <input type="text" id="id_no" name="id_no" class="form-control" required>
                            </div>
                        </div><div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Room Type</label>
                            <div class="col-sm-10">
                               <select name="type" class="form-control" disabled>
									<option value="<?php echo htmlspecialchars($type); ?>" ><?php echo htmlspecialchars($type); ?></option>
								</select> 
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Check In</label>
                            <div class="col-sm-10">
                               <div class='input-group date' id='datetimepicker1'>
									<input type='text' name="checkin" value="<?php echo htmlspecialchars($checkin); ?>" class="form-control" placeholder=<?php echo htmlspecialchars($checkin); ?> disabled />
										<span class="input-group-addon">
										<span class="fa fa-calendar"></span>
										</span> 
								</div>
                        </div>
						</div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Check Out</label>
							<div class="col-sm-10">
                            <div class='input-group date' id='datetimepicker1'>
								<input type='text' name="checkout" value="<?php echo htmlspecialchars($checkout); ?>" class="form-control" placeholder=<?php echo htmlspecialchars($checkout); ?> disabled />
									<span class="input-group-addon">
									<span class="fa fa-calendar"></span>
									</span> 
							</div>
							</div>
                        </div>
						
						<div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Number of  Guests</label>
							<div class="col-sm-10">
                            <div class="col-xs-12 form-group has-error">
								<select name="no_of_guests" class="form-control" disabled>
									<option value="<?php echo htmlspecialchars($guests); ?>" ><?php echo htmlspecialchars($guests); ?>  </option>
								</select>
							</div>
                        </div>
						</div>
						
			
						<?php 
						//echo "HELLO".$checkin.$checkout;
						
						//echo "NO of DAYS".$days->format("%R%a");
						
						$sql=sprintf("SELECT price from room WHERE room_type='%s';",$type);
						$result = mysqli_query($conn,$sql);
						if ($result === false)
							die("Could not query database"); 
		
						$row = mysqli_fetch_array($result);	
						$price=$row['price']*$days->format("%R%a");
						//$price=$row['price'];
						
						//echo $price."WHY NO PRINT HERE";
						?>
						
						<div class="form-group">
							<div align="right"> 
							<button type="submit" name='last_id' value="<?php echo htmlspecialchars($last_id); ?>" onclick="phonenumber('contact')"  class="tm-banner-link">Pay Rs <?php echo htmlspecialchars($price); ?> & Continue</button>	
							</div>
                        </div>
						</div>
                    </fieldset>
                    </form>
                </div>
			</fieldset>
            </section>

	</section>
	<footer class="tm-black-bg">
		<div class="container">
			<div class="row">
			<p class="tm-copyright-text">Copyright &copy; 2016 Monte Carlo Resort, Bali
                </p>	
			</div>
		</div>		
	</footer>
	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>      		<!-- jQuery -->
  	<script type="text/javascript" src="js/moment.js"></script>							<!-- moment.js -->
	<script type="text/javascript" src="js/bootstrap.min.js"></script>					<!-- bootstrap js -->
	<script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>	<!-- bootstrap date time picker js, http://eonasdan.github.io/bootstrap-datetimepicker/ -->
	<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
<!--
	<script src="js/froogaloop.js"></script>
	<script src="js/jquery.fitvid.js"></script>
-->
   	<script type="text/javascript" src="js/templatemo-script.js"></script>      		<!-- Templatemo Script -->
	<script>
		// HTML document is loaded. DOM is ready.
		$(function() {

			$('#hotelCarTabs a').click(function (e) {
			  e.preventDefault()
			  $(this).tab('show')
			})

        	$('.date').datetimepicker({
            	format: 'MM/DD/YYYY'
            });
            $('.date-time').datetimepicker();

			// https://css-tricks.com/snippets/jquery/smooth-scrolling/
		  	$('a[href*=#]:not([href=#])').click(function() {
			    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			      var target = $(this.hash);
			      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			      if (target.length) {
			        $('html,body').animate({
			          scrollTop: target.offset().top
			        }, 1000);
			        return false;
			      }
			    }
		  	});
		});
		
		// Load Flexslider when everything is loaded.
		$(window).load(function() {	  		
			// Vimeo API nonsense

/*
			  var player = document.getElementById('player_1');
			  $f(player).addEvent('ready', ready);
			 
			  function addEvent(element, eventName, callback) {
			    if (element.addEventListener) {
			      element.addEventListener(eventName, callback, false)
			    } else {
			      element.attachEvent(eventName, callback, false);
			    }
			  }
			 
			  function ready(player_id) {
			    var froogaloop = $f(player_id);
			    froogaloop.addEvent('play', function(data) {
			      $('.flexslider').flexslider("pause");
			    });
			    froogaloop.addEvent('pause', function(data) {
			      $('.flexslider').flexslider("play");
			    });
			  }
*/

			 
			 
			  // Call fitVid before FlexSlider initializes, so the proper initial height can be retrieved.
/*

			  $(".flexslider")
			    .fitVids()
			    .flexslider({
			      animation: "slide",
			      useCSS: false,
			      animationLoop: false,
			      smoothHeight: true,
			      controlNav: false,
			      before: function(slider){
			        $f(player).api('pause');
			      }
			  });
*/


			  

//	For images only
		    $('.flexslider').flexslider({
			    controlNav: false
		    });


	  	});
	</script>
	
<!-- Placed js at the end of the document so the pages load faster -->
<script src="js2/jquery-1.10.2.min.js"></script>
<script src="js2/jquery-migrate.js"></script>
<script src="js2/bootstrap.min.js"></script>
<script src="js2/modernizr.min.js"></script>

<!--Nice Scroll-->
<script src="js2/jquery.nicescroll.js" type="text/javascript"></script>

<!--right slidebar-->
<script src="js2/slidebars.min.js"></script>

<!--switchery-->
<script src="js2/switchery/switchery.min.js"></script>
<script src="js2/switchery/switchery-init.js"></script>

<!--Sparkline Chart-->
<script src="js2/sparkline/jquery.sparkline.js"></script>
<script src="js2/sparkline/sparkline-init.js"></script>


<!--bootstrap-fileinput-master-->
<script type="text/javascript" src="js2/bootstrap-fileinput-master/js/fileinput.js"></script>
<script type="text/javascript" src="js2/file-input-init.js"></script>

<!--common scripts for all pages-->
<script src="js2/scripts.js"></script>
 </body>
 </html>