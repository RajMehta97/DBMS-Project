<?php
	session_start();
    $servername = "localhost";
	$username = "root";
	$password = "";
	$db="hrs";
	/*if(empty($_POST["checkin"]) || empty($_POST['checkout']) || empty($_POST['no_of_rooms']) || empty($_POST['no_of_infants']) || empty($_POST['no_of_guests']) || empty($_POST['type'])){
		header('Location: ../holiday/index.php');
	}*/
	// Create connection
	$conn = mysqli_connect($servername, $username, $password);

	// Check connection
	if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
	}
	
	
	
	// select database
    if (mysqli_select_db( $conn, $db) === false)
        die("Could not select database");
    
	 if (isset($_POST["type"]) && isset($_POST["checkin"])&& isset($_POST["checkout"])&& isset($_POST["no_of_guests"])&& isset($_POST["no_of_infants"])){
		
		$sql=sprintf("INSERT into enquiry(checkin,checkout,no_of_guests,room_type) values ('%s','%s','%d','%s');",
		             mysqli_real_escape_string($conn,$_POST["checkin"]),
					 mysqli_real_escape_string($conn,$_POST["checkout"]),
					 mysqli_real_escape_string($conn,$_POST["no_of_guests"]+$_POST["no_of_infants"]),
					 mysqli_real_escape_string($conn,$_POST["type"]));
		 
		$result = mysqli_query($conn,$sql);
		
	    if ($result === false)
            die("Could not query database"); 
		
		$checkin=date_create($_POST["checkin"]);
		$checkout=date_create($_POST["checkout"]);
		$days=date_diff($checkin,$checkout);
		
		if($days->format("%R%a")<0){
			$host = $_SERVER["HTTP_HOST"];
            $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
            header("Location: http://$host/$path/index.php?error=1");
            exit;
		}
		
		//echo "NO of DAYS".$days->format("%R%a");
	 }
	 
	 
  
?>

<!DOCTYPE html>
<html lang="en">
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
  					<a href="#" class="tm-site-name">Monte Carlo</a>	
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
	<section class="tm-banner">

<?php  

        define("EXE", "Executive");
		define("PRE", "Premium");
		define("STD", "Standard");
       	// Show image as per room selected
	     if(isset($_POST["type"])){	
			 
			echo "<div class=\"flexslider flexslider-banner\">
			<ul class=\"slides\">"; 
	        if($_POST["type"]==EXE){
			  echo "<li>    
					<img src=\"img/executive-01.jpg\" alt=\"Image\" />
				</li>
				<li>
					<img src=\"img/executive-02.jpg\" alt=\"Image\" />
				</li>
				<li>
					<img src=\"img/executive-03.jpg\" alt=\"Image\" />
				</li>";
			}
			else if($_POST["type"]==PRE){
			  echo "<li>   
					<img src=\"img/premium-01.jpg\" alt=\"Image\" />	
				</li>
				<li>
					<img src=\"img/premium-02.jpg\" alt=\"Image\" />
				</li>
				<li>
					<img src=\"img/premium-03.jpg\" alt=\"Image\" />
				</li>";
			}
			else if($_POST["type"]==STD){
			  echo "<li>    
					<img src=\"img/standard-01.jpg\" alt=\"Image\" />
				</li>
				<li>
					<img src=\"img/standard-02.jpg\" alt=\"Image\" />
				</li>
				<li>
					<img src=\"img/standard-03.jpg\" alt=\"Image\" />
				</li>";
			}
		 
		 
	 
			echo "</ul>
			</div>";	
	 }
	 
	 ?>
	</section>
	<!-- white bg -->
	<!---Show Details as per room Selected-->
	<section class="tm-white-bg section-padding-bottom">
		<?php if(@$_POST["type"]==EXE){ ?>
			<div class="tpl_leftmaincol">
				<blockquote class="page_quote"> 
				</br> </br>
				<div style = "align:center">
				<h1  > The Executive Suite </h1> </br>
				</div>
	South Goa hotels come no better than the luxurious Alila Suite, a perfect retreat for couples looking forward to spending some quality time together. Choose your mode of relaxation, whether sipping cocktails in the evening out on your private balcony, or enjoying an indulgent bath experience in a bathtub for two overlooking the tropical palm-fringed views at Alila Diwa Goa. Suites are spacious and designed elegantly with a touch of Goan tradition to give the ultimate romantic experience during your stay.</blockquote>
			  <div class="clear"><!-- clear--></div>
			</div>
			
<div class="roomDetails" style="padding-left:40px;">

		<h4><b>Suite Details</b></h4>
<div style="width:725px;" >
	<div style="width:725px;">
		<div style="width:725px;">
			<div style="width:143px; float:left">
				<strong>View</strong></div>
			<div style="width:582px; float:right">
				Views over the infinity pool and paddy fields</div>
			<img alt="Line" height="17" src="http://www.alilahotels.com/images/uploads/line_723px.gif" width="723" /></div>
		<div style="width:143px; float:left">
			<strong>Beds</strong></div>
		<div style="width:582px; float:right">
			One king-size bed</div>
		<img alt="Line" height="17" src="http://www.alilahotels.com/images/uploads/line_723px.gif" width="723" /></div>
	<div style="width:725px;">
		<div style="width:143px; float:left">
			<strong>Bathrooms</strong></div>
		<div style="width:582px; float:right">
			One shower and one bathtub</div>
		<img alt="Line" height="17" src="http://www.alilahotels.com/images/uploads/line_723px.gif" width="723" /></div>
	<div style="width:725px;">
		<div style="width:143px; float:left">
			<strong>Maximum Occupancy</strong></div>
		<div style="width:582px; float:right">
			2 adults</div>
		<img alt="Line" height="17" src="http://www.alilahotels.com/images/uploads/line_723px.gif" width="723" /></div>
	<div style="width:725px;">
		<div style="width:143px; float:left">
			<strong>Size (m2 / sq.ft.)</strong></div>
		<div style="width:582px; float:right">
			88 m2 / 948 sq.ft.</div>
		<img alt="Line" height="17" src="http://www.alilahotels.com/images/uploads/line_723px.gif" width="723" /></div>
	<p>
		&nbsp;</p>
	<h4><b>Suite Features</b></h4>
	<div style="width:725px;">
		<div style="width:300px; float:left; margin-right:25px;">
			<ul>
				<li style="margin-bottom:5px;">
					- Living Room and one bedroom</li>
				<li style="margin-bottom:5px;">
					- 40" LCD TV with satellite channels</li>
				<li style="margin-bottom:5px;">
					- Complimentary Wi-Fi Internet access</li>
				<li style="margin-bottom:5px;">
					- Private terrace or balcony</li>
				<li style="margin-bottom:5px;">
					- MyBar</li>
			</ul>
		</div>
		<div style="width:400px; float:left">
			<ul>
				<li style="margin-bottom:5px;">
					- Electronic safe</li>
				<li style="margin-bottom:5px;">
					- Air conditioning</li>
				<li style="margin-bottom:5px;">
					- Walk-in wardrobe</li>
				<li style="margin-bottom:5px;">
					- Separate work space</li>
				<li style="margin-bottom:5px;">
					- On request: DVD player / iPod &amp; docking station / iron &amp; ironing board</li>
			</ul>
		</div>
	</div>
		<?php } ?>
		<?php if($_POST["type"]== STD){ ?>
			<div class="tpl_leftmaincol">
				<blockquote class="page_quote"> 
				</br> </br>
				<div style = "align:center">
				<h1  > The Standard Suite </h1> </br>
				</div>
	South Goa hotels come no better than the luxurious Standard Suite, a perfect retreat for couples looking forward to spending some quality time together. Choose your mode of relaxation, whether sipping cocktails in the evening out on your private balcony, or enjoying an indulgent bath experience in a bathtub for two overlooking the tropical palm-fringed views at Alila Diwa Goa. Suites are spacious and designed elegantly with a touch of Goan tradition to give the ultimate romantic experience during your stay.
	</blockquote>
				<div class="clear"><!-- clear--></div>
			</div>
			
<div class="roomDetails" style="padding-left:40px;">

		<h4><b>Suite Details</b></h4>
<div style="width:725px;">
	<div style="width:725px;">
		<div style="width:725px;">
			<div style="width:143px; float:left">
				<strong>View</strong></div>
			<div style="width:582px; float:right">
				Views over the infinity pool and paddy fields</div>
			<img alt="Line" height="17" src="http://www.alilahotels.com/images/uploads/line_723px.gif" width="723" /></div>
		<div style="width:143px; float:left">
			<strong>Beds</strong></div>
		<div style="width:582px; float:right">
			One king-size bed</div>
		<img alt="Line" height="17" src="http://www.alilahotels.com/images/uploads/line_723px.gif" width="723" /></div>
	<div style="width:725px;">
		<div style="width:143px; float:left">
			<strong>Bathrooms</strong></div>
		<div style="width:582px; float:right">
			One shower and one bathtub</div>
		<img alt="Line" height="17" src="http://www.alilahotels.com/images/uploads/line_723px.gif" width="723" /></div>
	<div style="width:725px;">
		<div style="width:143px; float:left">
			<strong>Maximum Occupancy</strong></div>
		<div style="width:582px; float:right">
			2 adults</div>
		<img alt="Line" height="17" src="http://www.alilahotels.com/images/uploads/line_723px.gif" width="723" /></div>
	<div style="width:725px;">
		<div style="width:143px; float:left">
			<strong>Size (m2 / sq.ft.)</strong></div>
		<div style="width:582px; float:right">
			88 m2 / 948 sq.ft.</div>
		<img alt="Line" height="17" src="http://www.alilahotels.com/images/uploads/line_723px.gif" width="723" /></div>
	<p>
		&nbsp;</p>
	<h4><b>Suite Features</b></h4>
	<div style="width:725px;">
		<div style="width:300px; float:left; margin-right:25px;">
			<ul>
				<li style="margin-bottom:5px;">
					- Living Room and one bedroom</li>
				<li style="margin-bottom:5px;">
					- 40" LCD TV with satellite channels</li>
				<li style="margin-bottom:5px;">
					- Complimentary Wi-Fi Internet access</li>
				<li style="margin-bottom:5px;">
					- Private terrace or balcony</li>
				<li style="margin-bottom:5px;">
					- MyBar</li>
			</ul>
		</div>
		<div style="width:400px; float:left">
			<ul>
				<li style="margin-bottom:5px;">
					- Electronic safe</li>
				<li style="margin-bottom:5px;">
					- Air conditioning</li>
				<li style="margin-bottom:5px;">
					- Walk-in wardrobe</li>
				<li style="margin-bottom:5px;">
					- Separate work space</li>
				<li style="margin-bottom:5px;">
					- On request: DVD player / iPod &amp; docking station / iron &amp; ironing board</li>
			</ul>
		</div>
	</div>
		<?php } ?>
		<?php  if($_POST["type"]==PRE){ ?>
			<div class="tpl_leftmaincol">
				<blockquote class="page_quote"> 
				</br> </br>
				<div style = "align:center">
				<h1  > The Premium Suite </h1> </br>
				</div>
	Located on the ground level, the Premium Rooms combine interior comforts with refreshing garden views. Each room opens onto an outdoor garden patio where one can sit and relax in peaceful privacy. Perfect for a small family, with an additional daybed and convenient access to the kids&#39; pool and club, this peaceful Majorda resort offers the ideal base for your tropical vacation.
				</blockquote>
				<div class="clear"><!-- clear--></div>
			</div>
			
<div class="roomDetails" style="padding-left:40px;">

		<h4><b>Suite Details</b></h4>
<div    <div style="width:725px;">
	<div style="width:725px;">
		<div style="width:725px;">
			<div style="width:143px; float:left">
				<strong>View</strong></div>
			<div style="width:582px; float:right">
				Garden</div>
			<img alt="Line" height="17" src="http://www.alilahotels.com/images/uploads/line_723px.gif" width="723" /></div>
		<div style="width:143px; float:left">
			<strong>Beds</strong></div>
		<div style="width:582px; float:right">
			One king-size bed or two separate twin beds with an additional child&#39;s bed</div>
		<img alt="Line" height="17" src="http://www.alilahotels.com/images/uploads/line_723px.gif" width="723" /></div>
	<div style="width:725px;">
		<div style="width:143px; float:left">
			<strong>Bathrooms</strong></div>
		<div style="width:582px; float:right">
			One shower and one bathtub</div>
		<img alt="Line" height="17" src="http://www.alilahotels.com/images/uploads/line_723px.gif" width="723" /></div>
	<div style="width:725px;">
		<div style="width:143px; float:left">
			<strong>Maximum Occupancy</strong></div>
		<div style="width:582px; float:right">
			2 adults and 1 child</div>
		<img alt="Line" height="17" src="http://www.alilahotels.com/images/uploads/line_723px.gif" width="723" /></div>
	<div style="width:725px;">
		<div style="width:143px; float:left">
			<strong>Size (m2 / sq.ft.)</strong></div>
		<div style="width:582px; float:right">
			44 m2 / 474 sq.ft.</div>
		<img alt="Line" height="17" src="http://www.alilahotels.com/images/uploads/line_723px.gif" width="723" /></div>
	<p>
		&nbsp;</p>
	<h4><b>Suite Features</b></h4>
	<div style="width:725px;">
		<div style="width:300px; float:left; margin-right:25px;">
			<ul>
				<li style="margin-bottom:5px;">
					- 40&rdquo; LCD TV with satellite channels</li>
				<li style="margin-bottom:5px;">
					- Complimentary Wi-Fi Internet access</li>
				<li style="margin-bottom:5px;">
					- Private terrace or balcony</li>
				<li style="margin-bottom:5px;">
					- MyBar</li>
			</ul>
		</div>
		<div style="width:400px; float:left">
			<ul>
				<li style="margin-bottom:5px;">
					- Electronic safe</li>
				<li style="margin-bottom:5px;">
					- Air conditioning</li>
				<li style="margin-bottom:5px;">
					- Walk-in wardrobe</li>
				<li style="margin-bottom:5px;">
					- Separate work space</li>
				<li style="margin-bottom:5px;">
					- On request: DVD player / iPod &amp; docking station / iron &amp; ironing board</li>
			</ul>
		</div>
	</div>
		<?php } 
		
		 // Get the price and availibilty of the room 
        $last_id = mysqli_insert_id($conn);
		$_SESSION['last_id']=$last_id;
		$sql=sprintf("SELECT price,no_of_rooms from room WHERE room_type='%s';",mysqli_real_escape_string($conn,$_POST["type"]));
		$result = mysqli_query($conn,$sql);
		 if ($result === false)
            die("Could not query database"); 
		
	    $row = mysqli_fetch_array($result);	
		$price=$row['price']*$days->format("%R%a");
		$no_of_rooms=$row['no_of_rooms'];
        
		$query_2='SELECT * FROM `booking` WHERE "'.$_POST["checkin"].'" BETWEEN `checkin` AND `checkout AND `room_type`="'.$_POST["type"].'";';
		$result_2=$conn->query($query_2);
		$no_of_rows=@mysqli_num_rows($result_2);
		//$no_of_rows=15;
		if(($no_of_rooms-$no_of_rows)==0){
		echo'<form action="index.php" method="post">';
		echo'<div align="right"> ';
		echo'<button type="submit" name="last_id" value="'.htmlspecialchars($last_id).'" class="tm-banner-link">ROOM NOT AVAILABLE <br><small>back to home</small></button>	';
		echo'</div>';
		echo'</form>';	
		}
		else{
		echo'<form action="confirmDetails.php" method="post">';
		echo'<div align="right"> ';
		echo'<button type="submit" name="last_id" value="'.htmlspecialchars($last_id).'" class="tm-banner-link">BOOK NOW FOR RS '.$price.'</button>	';
		echo'</div>';
		echo'</form>';
		}
	?>
	
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