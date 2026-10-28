<?php 
    require_once ("admin/inc/conn.php");
    include("inc/admin_panel.php");
    include("inc/header.php");
?>
<style>
    /* Custom spacing for index sections if needed */
</style>



	<!-- Home Section Design -->
	<section class="home <?php echo $isAdmin ? 'admin-edit-container' : ''; ?>">
        <?php if ($isAdmin): ?>
            <a href="admin/home.php" class="btn-edit"><i class="ri-edit-line"></i> Change Home</a>
        <?php endif; ?>
		<div class="home-text">

			 <?php
                    $h5 = $h1 = $para = $btn = "";
                    $query = "SELECT * FROM home LIMIT 1";
                    $run = mysqli_query($conn, $query);
                    
                    if($row = mysqli_fetch_array( $run))
                    {
                        $h5  = $row['h5'];
                        $h1  = $row['h1'];
                        $para  = $row['para'];
                        $btn  = $row['btn'];
                    }
              ?>

			<h5><?php echo $h5; ?></h5>
			<h1><?php echo $h1; ?></h1>
			<p><?php echo $para; ?></p>
			<a href="#" class="btn"><?php echo $btn; ?></a>
		</div>		
	</section>

	<!-- Feature Section Design -->
	<section class="feature <?php echo $isAdmin ? 'admin-edit-container' : ''; ?>">
        <?php if ($isAdmin): ?>
            <a href="admin/feature.php" class="btn-edit"><i class="ri-edit-line"></i> Change Features</a>
        <?php endif; ?>
		<div class="feature-content">

			 <?php
                    $query = "SELECT * FROM feature";
                    $run = mysqli_query($conn, $query);

                    
                    while($row = mysqli_fetch_array( $run))
                    {
                        
                       $img  = $row["img"];
                        $h4  = $row["h4"];
                 
			echo"<div class='row'>";
			echo"<div class='row-img'>
					<img src='$img'>
				 </div>
				 	<h4>$h4</h4>
				 </div>";
			 }
            ?>
		</div>
	</section>

	<!-- Holiday Section Design -->
	<section class="holiday <?php echo $isAdmin ? 'admin-edit-container' : ''; ?>">
        <?php if ($isAdmin): ?>
            <a href="admin/holiday.php" class="btn-edit"><i class="ri-edit-line"></i> Change Holiday</a>
        <?php endif; ?>
			
			<?php
                    $img = $h5 = $h2 = $para = $btn = "";
                    $query = "SELECT * FROM holiday LIMIT 1";
                    $run = mysqli_query($conn, $query);

                    if($row = mysqli_fetch_array( $run))
                    {
                       $img  = $row["img"];
                       $h5  = $row["h5"];
                       $h2  = $row["h2"];
                       $para  = $row["para"];
                       $btn  = $row["btn"];
                    }

                    if($h2 != "") {
                   	   echo "<div class='holiday-img'><img src='$img'></div>";
						echo"<div class='holiday-text'>
							 <h5>$h5</h5>
							 <h2>$h2</h2>
							 <p>$para</p>
							 <a href='#' class='btn open-booking-modal' data-tour='" . htmlspecialchars($h2) . "'>$btn</a></div>";
                    }
            ?>

	</section>

	<!-- Tour Section Design -->
	<section class="tour <?php echo $isAdmin ? 'admin-edit-container' : ''; ?>">
        <?php if ($isAdmin): ?>
            <a href="admin/tour.php" class="btn-edit"><i class="ri-edit-line"></i> Change Tour</a>
        <?php endif; ?>
		<div class="center-text">
			<?php 
			$query_h2 = "SELECT h2 FROM tour LIMIT 1";
            $run_h2 = mysqli_query($conn, $query_h2);

			if ($row_h2 = mysqli_fetch_array($run_h2)) {
				echo "<h2>" . htmlspecialchars($row_h2["h2"]) . "</h2>";
			}
			?>
		</div>
		<div class="tour-content">
		<?php 

			$query = "SELECT * FROM tour";
            $run = mysqli_query($conn, $query);

			while ($row = mysqli_fetch_array( $run)) {
					   
					   
					   $img  = $row["img"];
                       $h6  = $row["h6"];
                       $h4  = $row["h4"];
                       $btn  = $row["btn"];

			?>
		
			<div class="box">
				<img src="<?php echo htmlspecialchars($img); ?>">
				<h6><?php echo htmlspecialchars($h6); ?></h6>
				<h4><?php echo htmlspecialchars($h4); ?></h4>
				<a href="#" class="tour-book-btn open-booking-modal" data-tour="<?php echo htmlspecialchars($h4); ?>">
					<i class="ri-calendar-check-line"></i> <?php echo !empty($btn) ? htmlspecialchars($btn) : 'Book Now'; ?>
				</a>
			 </div>
			 <?php 

			}
		  ?>
		</div>

		<div class="center-btn">
			<a href="#" class="btn open-booking-modal" data-tour="Featured Destinations Group Package"><?php echo !empty($btn) ? htmlspecialchars($btn) : 'Book Tour'; ?></a>
		</div>
	</section>

	<!-- culture Section Design -->
	<section class="culture <?php echo $isAdmin ? 'admin-edit-container' : ''; ?>">
        <?php if ($isAdmin): ?>
            <a href="admin/culture.php" class="btn-edit"><i class="ri-edit-line"></i> Change Culture</a>
        <?php endif; ?>
		<div class="culture-text">
			<?php 
                    $h5 = $h2 = $para = $btn = $img = "";
                    $query = "SELECT * FROM culture LIMIT 1";
                    $run = mysqli_query($conn, $query);

                    if ($row = mysqli_fetch_array( $run)) {
                        $h5  = $row["h5"];
                        $h2  = $row["h2"];
                        $para = $row["para"];
                        $btn  = $row["btn"];
                        $img  = $row["img"];
                    }   
			?>
			<h5><?php echo $h5 ?></h5>
			<h2><?php echo $h2 ?></h2>
			<p><?php echo $para ?></p>
			<a href="#" class="btn"><?php echo $btn ?></a>
		</div>

		<div class="culture-img">
			<img src="<?php echo $img ?>">
		</div>

	</section>

	
	<?php 
	include ("inc/booking_modal.php");
	include ("inc/footer.php");
 ?>