<?php 
    require_once ("admin/inc/conn.php");
    include("inc/admin_panel.php");
    include("inc/header.php");
?>

 <style>

 	:root{
	--h1-font-family: 'Playfair Display', Georgia, serif;
	--h2-font-family: 'Playfair Display', Georgia, serif;
	--h5-font-family: 'Montserrat', sans-serif;
	--p-font-family: 'Plus Jakarta Sans', sans-serif;
}

 	.about{
	 		position: relative;
			height: 100vh;
			width: 100%;
	 		background-image: linear-gradient(to left, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.8)), url(img/team2.jpg);
	 		background-size: cover;
	 		background-position: bottom center;
			text-align: center;
		}

 	.about-text{ 
 		margin-top: 300px;
 	 	font-size: 50px; 
 	 }

 	 .team{
 	 	display: grid;
 	 	grid-template-columns: repeat(2, 1fr);
		align-items: center;
		gap: 9rem;
 	 }

 	 .team-text h5{
 	 	font-family: var(--h5-font-family);
		font-size: 22px;
		font-weight: 600;
		color: var(--main-color);
		text-transform: uppercase;
		letter-spacing: 6px;
		margin-bottom: 20px;
		text-align: center;
	}

	.team-text h2{
		font-family: var(--h2-font-family);
		text-align: center;
		font-size: var(--h2-font);
		font-weight: 800;
		line-height: 1.2;
		margin-bottom: 25px;
	}

	.team-text p{
		font-family: var(--p-font-family);
		text-align: center;
		justify-content: center;
		font-size: var(--p-font);
		font-weight: 500;
		line-height: 30px;
		color: #ffffffab;
		margin-bottom: 35px;
	}

	.container{
		display: flex;
		justify-content: center;
		height: 100vh;
		align-items: center;
		
	}

	.card-container{
		display: flex;
		justify-items: center;
	}

	.card{
		height: 500px;
		margin: 50px;
		box-shadow: 5px 5px 20px #ffa343;
		overflow: hidden;
	}

	img{
		height: 500px;
		width: 350px;
		border-radius: 3px;
	}

	.intro{
		height: 70px;
		width: 350px;
		padding: 6px;
		box-sizing: border-box;
		position: relative;
		bottom: 240px;
		
		color: white;
	}

	.h1{
		font-family: var(--h1-font-family);
		font-size: 60px;
	}

	.heading{
		font-family: var(--h1-font-family);
		margin-top: 150px;
		margin-left: 20px;
		font-size: 40px;
	}

	.team-member-info{
		font-size: 20px;
		margin-left: 20px;
		visibility: hidden;
		opacity: 0;
		font-family: var(--p-font-family);
	}

	span{
		font-weight: bold;
	}

	.card:hover{
		cursor: pointer;
	}

	.card:hover .intro{
		height: 300px;
		bottom: 250px;
		background: #ffa343;
	}

	.card:hover .team-member-info{
		opacity: 1;
		visibility: visible;
	}


 </style>
 

	<section class="about">
		<div class="about-text">
			
			<h1 class="h1">About Us</h1>
			
		</div>		
	</section>

	<section class="team <?php echo $isAdmin ? 'admin-edit-container' : ''; ?>">
        <?php if ($isAdmin): ?>
            <a href="admin/about_table.php" class="btn-edit">Change About</a>
        <?php endif; ?>
		<div class="team-vid">
			<video  autoplay muted width="110%" height="150%">
			  <source src="img/vid.mp4" type="video/mp4">
			 	Your browser does not support the video tag.
			</video>
		</div>

		<div class="team-text"> 

			<?php 
			$query = "SELECT * FROM about";
            $run = mysqli_query($conn, $query);

			if ($row = mysqli_fetch_array( $run)) {
					$h5  = $row["h5"];
					$h2  = $row["h2"];
					$para  = $row["para"];
					
				?>

			<h5><?php echo $h5 ?></h5> 
			<h2><?php echo $h2 ?></h2> 
			<p><?php echo $para ?> </p> 
		<?php } ?>
		</div>
	 </section>

<!-- Team Members Container -->
	
	<section class="container">
		<div class="card-container">
			<?php 

					$query = "SELECT * FROM about";
                    $run = mysqli_query($conn, $query);

					 while($row = mysqli_fetch_array( $run))
                    {
                    	$img	= $row['img'];
                        $head1 = $row['head1'];
                        $paragraph  = $row['paragraph'];
                   
              ?>
			<div class="card">
				<img src="<?php echo $img; ?>" alt="team-member">
				<div class="intro">
					<h1 class="heading"><span><?php echo $head1 ?></span></h1>
					<p class="team-member-info" style="margin-top: -200px;"><?php echo $paragraph ?></p>
				</div>
			</div>
			<?php } ?>
		</div>
	</section>

<?php 
	include ("inc/footer.php");
 ?>