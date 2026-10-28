<?php 
    require_once ("admin/inc/conn.php");
    include("inc/admin_panel.php");
    include ("inc/header.php");
?>

<style>

	:root{
	--h1-font-family: 'Playfair Display', Georgia, serif;
	--h2-font-family: 'Playfair Display', Georgia, serif;
	--h5-font-family: 'Montserrat', sans-serif;
	--p-font-family: 'Plus Jakarta Sans', sans-serif;
}
	.service{
	 		position: relative;
			height: 100vh;
			width: 100%;
	 		background-image: linear-gradient(to left, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.8)), url(img/service1.jpg);
	 		background-size: cover;
	 		background-position:  center;
			text-align: center;
		}

 	.service-text{ 
 		margin-top: 300px;
 	 	font-size: 50px; 
 	 	font-family: var(--h1-font-family);
 	 }

 	 .service-heading{
 	 	color: #ffa343;
 	 	text-align: center;
 	 	font-size: 45px;
 	 }

 	 .service-info{
 	 	text-align: center;
 	 	justify-content: space-evenly;
 	 	font-size: 20px;
 	 }

 	 .container{
		display: flex;
		justify-content: center;
		align-items: center;
		
	}

	.service-container{
		display: flex;
		justify-items: center;
	}

	.card{
		height: 400px;
		width: 400px;
		margin: 50px;
		border-color: #ffa343;
		border-top-style: solid;
		border-bottom-style: solid;
		border-width: 8px;
		overflow: hidden;
	}

	img{
		height: 400px;
		width: 400px;
		border-radius: 3px;
		opacity: 0.5;
	}

	.service-intro{
		height: 70px;
		width: 350px;
		padding: 6px;
		box-sizing: border-box;
		position: relative;
		bottom: 240px;
		color: white;
	}

	.service-title{
		margin-top: 150px;
		margin-left: 20px;
		font-size: 40px;
		
	}

	.service-desc{
		font-size: 20px;
		margin-left: 20px;
		
		opacity: 0;
	}

	.title{
		font-size: 30px;
	}


	.card:hover{
		cursor: pointer;
	}

	.card:hover .service-intro{
		height: 100px;
		width: 400px;
		bottom: 450px;
		
	}


	.card:hover .service-desc{
		visibility: visible;
		opacity: 1;
		
	}
	


</style>

	<section class="service">
		<div class="service-text">
			
			<h1 class="h1">Services</h1>
			
		</div>		
	</section>

	<section class="<?php echo $isAdmin ? 'admin-edit-container' : ''; ?>">
        <?php if ($isAdmin): ?>
            <a href="admin/service_table.php" class="btn-edit">Change Service Info</a>
        <?php endif; ?>
		<div>
			<?php 

					$query = "SELECT * FROM service";
                    $run = mysqli_query($conn, $query);

					if($row = mysqli_fetch_array( $run))
                    {
                    	
                        $service_heading = $row['service_heading'];
                        $service_info  = $row['service_info'];
                   
              ?>
			<h1 class="service-heading"><?php echo $service_heading; ?></h1>
		</div><br>
		<div>
			<p class="service-info"><?php echo $service_info; ?></p>
				<?php } ?>

		</div>
	</section>


	<section class="<?php echo $isAdmin ? 'admin-edit-container' : ''; ?>">
        <?php if ($isAdmin): ?>
            <a href="admin/service_table.php" class="btn-edit">Change Services</a>
        <?php endif; ?>
		<?php 
					
					$qu = "SELECT * FROM service";
                    $run = mysqli_query($conn, $qu);

			 		if($row = mysqli_fetch_array( $run))
	                    {
	                    	
	                        $img = $row['img'];
	                        $title  = $row['title'];
	                        $service_desc  = $row['service_desc'];
	                   
	            
		 		 ?>
		<div class="container">	
			<div class="service-container">
				<?php 
					
					$q = "SELECT * FROM service";
                    $run = mysqli_query($conn, $q);

			 		 while($row = mysqli_fetch_array( $run))
	                    {
	                    	
	                        $img = $row['img'];
	                        $title  = $row['title'];
	                        $service_desc  = $row['service_desc'];
	                   
	            
		 		 ?>
				<div class="card">
					<img src="<?php echo $img; ?>" alt="services">
					<div class="service-intro">
						<h1 class="service-title"><span class="title"><?php echo $title; ?></span></h1>
						<p class="service-desc"><?php echo $service_desc; ?> </p>
					</div>
				</div>
				<?php 
			
			} ?>		
			</div>
		
		</div>

<?php } ?>

	</section>


 <?php 
	include ("inc/footer.php");
 ?>