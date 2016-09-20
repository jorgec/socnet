<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $page_title;?> :: SocNet</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/design.css">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<header>
			<nav class="navbar navbar-default" role="navigation" id="main-nav">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#">
							SocNet
							<?php if( isset( $_SESSION['username']) )echo $_SESSION['username'];?>
						</a>

					</div>
			
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse navbar-ex1-collapse">

						
						<ul class="nav navbar-nav navbar-right">
							<li><a href="<?php echo site_url('home');?>">Home</a></li>
							<li><a href="<?php echo site_url('home/friends');?>">Friends</a></li>

							<li>
								<form class="navbar-form" method="get" action="<?php echo site_url('home/search');?>">
									<input type="text" name="s" id="s" class="form-control" placeholder="Search..." required="required" value="<?php echo isset($_GET['s']) ? $_GET['s'] : '';?>">
									<button type="submit" class="btn btn-default">Submit</button>
								</form>
							</li>

							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Actions <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<?php if( $this->users_model->is_logged_in() ):?>
										<li><a href="<?php echo site_url('user/logout');?>">Logout</a></li>
									<?php else: ?>
										<li><a href="<?php echo site_url('user/login');?>">Login</a></li>
									<?php endif;?>
								</ul>
							</li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div>
			</nav>

		</header>