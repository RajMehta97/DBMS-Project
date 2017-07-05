
<?php
   

    // enable sessions
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
  
	// Cancel Algoritm
	  if (isset($_POST["cancel"])){
		  
		 $book_id=$_POST["cancel"];
		
		$sql = "SELECT booking_id, last_name FROM booking WHERE booking_id={$_POST["cancel"]}";
	                 $result = mysqli_query($conn, $sql);
					 

						if (mysqli_num_rows($result) == 1) {
							
							$row = mysqli_fetch_array($result);	
							$last_name=$row['last_name'];
							// sql to delete a record
							$sql = "DELETE FROM booking WHERE booking_id={$_POST["cancel"]}";

							if (mysqli_query($conn, $sql)) {
								
								$error=0;
									//echo "Booking cancelled successfully";
							} else {
							$error_msg = "Error Cancelling Booking: " . mysqli_error($conn);
							$error=1;
							}
						}
						else {
							//echo "Booking Not Found";
							$error=1;
							
						}
						
	  }
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
							<li><a href="index.php#facilities">Facilities</a></li>
							<li><a href="contact.php">Contact</a></li>
							
						</ul>
					</nav>		
	  			</div>				
  			</div>
  		</div>	  	
  	</div>
	
	<section class="tm-white-bg section-padding-bottom">

	 <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,500,400italic,700,500italic' rel='stylesheet' type='text/css'>
     <link href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css" rel='styesheet'>

	 <div class="container">
     <div class="col-md-3">
     </div>
						<div class="col-md-6">
							<!-- START PANEL -->
							<div class="panel panel-default" style="margin-top: 50px">
								<div class="panel-heading ui-draggable-handle">
 									<h3 class="panel-title">Booking #'<?php echo htmlspecialchars($book_id);?>' Cancelled</h3>
								</div>
								<div class="panel-body" style="font-family: ubuntu">

										<div class="block">
											<form class="form-horizontal" role="form">
												<div class="panel-body panel-body-pricing">
												<?php if($error==0) { ?>
													<h2>Booking canceled successfully</h2>
													<hr>
													<table style="width: 100%">
														<tbody>
                                                        <tr>
        											    <h3>Dear <?php echo htmlspecialchars($last_name) ?> , We have cancelled your booking.</h3>
													    </tr>
                                                        <tr>
                                                        <br>
    														
                                                            
														</tr>
														</tbody>
													</table>
												<?php }
												      else { ?>
													  <h2>Booking cancellation unsuccessful</h2>
													<hr>
													<table style="width: 100%">
														<tbody>
                                                        <tr>
        											    <h3> We could not cancelled your booking.</h3>
													    </tr>
                                                        <tr>
                                                        <br>
    														
                                                            
														</tr>
														</tbody>
													</table>
													  <?php } ?>
												</div>
											</form>
                                            <div style="text-align: center">
										</div>
                                        </div>
                                </div>
							</div>
						</div>
						
	</div>
	<div align="center">
						<div > 
							<a href="exittomain.php" class="tm-banner-link">RETURN TO HOME</a>
							
						</div>	
						</div>
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
 </body>
 </html>