
<?php

	session_start();

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
    
	if (isset($_COOKIE["booking_id"])&&isset($_COOKIE["customer_id"])){
		$book_id = $_COOKIE["booking_id"];
		$cus_id= $_COOKIE["customer_id"];
		

	}
	
	 //$cus_id= $_SESSION['cus'];
	 //$book_id= $_SESSION['book'];
	
	if (isset($_POST["bookingid"]) && isset($_POST["last_name"])){
		$book_id = $_POST["bookingid"];
		
		$_SESSION['book']=$_POST["bookingid"];
		$sql = sprintf("SELECT customer_id from booking where booking_id =%d AND last_name='%s';",$book_id,mysqli_real_escape_string($conn,$_POST["last_name"]));
		$result = mysqli_query($conn, $sql);
	
	    if($result!=true || mysqli_num_rows($result) == 0){
		//die("Could Not Query the database & Ambigious Please Try Again");
		$host = $_SERVER["HTTP_HOST"];
        $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
        header("Location: http://$host$path/index.php?error=2");
        exit;
	    }
	

	    if( mysqli_num_rows($result) == 1){
	    
	   $row = mysqli_fetch_array($result);	
       $cus_id=$row['customer_id'];
	   
	   setcookie("booking_id",$book_id, time() + 7200);
	   
	   setcookie("customer_id",$cus_id, time() + 7200);
		}	
	}
	//$book_id= $_SESSION['book'];
	$sql = sprintf("SELECT * from booking where booking_id =%d;",$book_id);
	$result = mysqli_query($conn, $sql);
	
	if($result!=true && mysqli_num_rows($result) == 1){
		die("Could Not Query the database & Ambigious Please Try Again");
	}
	

	
	$row = mysqli_fetch_array($result);	
    $guests=$row['no_of_guest'];
    $checkin=$row['checkin'];
    $checkout=$row['checkout'];
    $price=$row['price_paid'];
    $type=$row['room_type'];     
	$cus_id=$row['customer_id'];
	
	$sql = sprintf("SELECT * from customer where customer_id =%d;",$cus_id);
	$result = mysqli_query($conn, $sql);
	
	if($result!=true && mysqli_num_rows($result) == 1){
		die("Could Not Query the database & Ambigious Please Try Again");
	}
	

	
	$row = mysqli_fetch_array($result);	
    $first_name=$row['first_name'];
    $last_name=$row['last_name'];
    $email=$row['email'];
    $contact=$row['contact_no'];
    $id_type=$row['id_type'];
    $id_no=$row['id_number'];    
	
	
	
?>



<!DOCTYPE html>
<html lang="en">
<style>
div button {
   float: left;
   margin: 0;
}
</style>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Monte Carlo</title>
<!--
Holiday Template
http://www.templatemo.com/tm-475-holiday
-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700' rel='stylesheet' type='text/css'>
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet">  
  <link href="css/flexslider.css" rel="stylesheet">
  <link href="css/templatemo-style.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

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
							<li><a href="about.html#details">About</a></li>
							<li><a href="index.php#facilities">">Facilities</a></li>
							<li><a href="contact.php">Contact</a></li>
							
						</ul>
					</nav>		
	  			</div>				
  			</div>
  		</div>	  	
  	</div>
	
	<section class="tm-white-bg section-padding-bottom">
	</br> </br> 
	<div class="container" >
    <div class="row">
        <div class="col-xs-10">
            <div class="panel panel-primary" style="bgcolor:yellow">
                <!-- Default panel contents -->
                <div class="panel-heading"  >
                    <h2 class="panel-title"style="bgcolor:yellow">
                        Your Booking Summary for Booking ID : <?php echo htmlspecialchars($book_id); ?>
                    </h2>
                </div>
                <div class="panel-body">
                    <h2>
                        <b> NAME : <b><?php echo htmlspecialchars($first_name)." ".htmlspecialchars($last_name); ?>
                    </h2>
                </div>
                    <ul class="list-group">
                    
                    <li class="list-group-item">
                    
					
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody style="font-size:140%" >
                            <tr>
                                <td><b> EMAIL : <b></td>
                                <td><?php echo htmlspecialchars($email); ?></td>
                                
                            </tr>
                            <tr>
                                <td>CONTACT :</td>
                                <td><?php echo htmlspecialchars($contact); ?></td>
                            </tr>
						      <tr>
                                <td><b> ID    : <b></td>
                                <td><?php echo htmlspecialchars($id_type); ?></td>
                                
                            </tr>
                            <tr>
                                <td> ID NUMBER :</td>
                                <td><?php echo htmlspecialchars($id_no); ?></td>
                            </tr>
							  <tr>
                                <td><b> CHECK IN : <b></td>
                                <td><?php echo htmlspecialchars($checkin); ?></td>
                                
                            </tr>
                            <tr>
                                <td>CHECK OUT:</td>
                                <td><?php echo htmlspecialchars($checkout); ?></td>
                            </tr>
							  <tr>
                                <td><b>  GUESTS : <b></td>
                                <td><?php echo htmlspecialchars($guests); ?></td>
                                
                            </tr>
                            <tr>
                                <td>TYPE : </td>
                                <td><?php echo htmlspecialchars($type); ?></td>
                            </tr>
							  <tr>
                                <td><b> PRICE PAID : <b></td>
                                <td><?php echo htmlspecialchars($price); ?></td>
                                
                            </tr>
                            
                        </tbody>
                    </table>
                    </li>
                </ul>
            </div>
        </div>
    </div>
	                  <div class="form-group">
					  
					     <form action="modify.php" method="post">
							<div > 
							<button type="submit" name='modify' value="<?php echo htmlspecialchars($cus_id); ?>"   class="tm-banner-link">MODIFY DETIALS</button>	
							</div>
						</form>
                         <form onsubmit="return confirm('Do you really want to cancel the booking?');" action="cancel.php" method="post" >   
							<div > 
							<button type="submit" name='cancel' value="<?php echo htmlspecialchars($book_id); ?>"   class="tm-banner-link">CANCEL BOOKING</button>	
							</div>
						</form>
                     
							<div > 
							<a href="exittomain.php" class="tm-banner-link">RETURN TO HOME</a>
							
						    </div>	
						</div>
</div>
	
	
	</section >
	
	
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
 </body>
 </html>