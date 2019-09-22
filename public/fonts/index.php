<!DOCTYPE html>
<html>
<head>
  <?php include 'include/header.php'; ?>
</head>

<body style="background-color:#f1f1f1">
<div class="container-fluid">
    
			<?php include 'include/topbar.php'; ?>
		 	<! end of topbar>

	
			<?php include 'include/menu.php'; ?>
			<! end of nav>

	<div class="row" >
		<div class="col-sm-1"></div>
		<div class="col-sm-10" ; style="margin-top:50px; margin-bottom:50px;">
			<div class="col-sm-3">
				<?php include 'include/sidebar.php'; ?>
			</div><! end of sidebar >

			<div class="col-sm-9"style="background-color:#fff;padding-left:50px; padding-right:50px;padding-top:15px">
				<?php include 'include/content.php'; ?>
			</div><! end of main content >
			
		</div>
		<div class= "col-sm-1"></div>
	</div> <! end of content with spacing>


	
			<?php include 'include/footer.php'; ?>
		 <! of footer>

</div> <! end of container>

</body>

</html>
