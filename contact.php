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

	.contact-container{
 		position: relative;
		height: 60vh;
		min-height: 420px;
		width: 100%;
 		background-image: linear-gradient(to left, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.8)), url(img/contact.jpg);
 		background-size: cover;
 		background-position: center;
		text-align: center;
		display: flex;
		align-items: center;
		justify-content: center;
		flex-direction: column;
		padding: 0 20px;
	}

	.contact-container .h1{
 	 	font-size: 3.5rem;
		font-family: var(--h1-font-family);
		color: var(--text-color);
		margin-bottom: 10px;
	}

	.contact-container p{
		color: rgba(255, 255, 255, 0.8);
		font-size: 1.1rem;
		max-width: 600px;
	}

 	.contact-info-grid{
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
		gap: 2rem;
		margin-bottom: 50px;
	}

	.contact-box{
		display: flex;
		flex-direction: column;
		background: rgba(255, 255, 255, 0.04);
		border: 1px solid rgba(255, 255, 255, 0.1);
		border-radius: 16px;
		padding: 28px 24px;
		transition: all 0.3s ease;
	}

	.contact-box:hover{
		transform: translateY(-5px);
		border-color: var(--main-color);
		background: rgba(255, 163, 67, 0.06);
	}

	.contact-box h3{
		font-size: 20px;
		font-weight: 600;
		margin-bottom: 12px;
		color: var(--main-color);
		font-family: var(--h5-font-family);
		display: flex;
		align-items: center;
		gap: 10px;
	}

	.contact-box span{
		color: rgba(255, 255, 255, 0.8);
		font-size: 15px;
		line-height: 1.6;
		word-break: break-word;
	}

	/* Inquiry Form Section */
	.inquiry-section-wrapper{
		display: grid;
		grid-template-columns: 1fr 1.3fr;
		gap: 3.5rem;
		align-items: flex-start;
		background: rgba(20, 24, 38, 0.6);
		border: 1px solid rgba(255, 255, 255, 0.08);
		border-radius: 24px;
		padding: 45px 40px;
		backdrop-filter: blur(20px);
		box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
	}

	@media (max-width: 900px){
		.inquiry-section-wrapper{
			grid-template-columns: 1fr;
			padding: 30px 20px;
		}
	}

	.inquiry-intro h2{
		font-family: var(--h2-font-family);
		font-size: 2.4rem;
		margin-bottom: 18px;
		line-height: 1.25;
	}

	.inquiry-intro p{
		color: rgba(255, 255, 255, 0.7);
		line-height: 1.7;
		margin-bottom: 25px;
		font-size: 15px;
	}

	.support-highlights{
		list-style: none;
		padding: 0;
		margin: 0 0 25px 0;
	}

	.support-highlights li{
		display: flex;
		align-items: center;
		gap: 12px;
		margin-bottom: 12px;
		font-size: 14.5px;
		color: rgba(255, 255, 255, 0.85);
	}

	.support-highlights li i{
		color: var(--main-color);
		font-size: 18px;
	}

	/* Form Inputs */
	.custom-form-group{
		margin-bottom: 20px;
	}

	.custom-form-group label{
		display: block;
		font-size: 13.5px;
		font-weight: 600;
		margin-bottom: 8px;
		color: rgba(255, 255, 255, 0.85);
		font-family: var(--h5-font-family);
		text-transform: uppercase;
		letter-spacing: 0.5px;
	}

	.custom-form-input, .custom-form-select, .custom-form-textarea{
		width: 100%;
		padding: 14px 18px;
		background: rgba(255, 255, 255, 0.05);
		border: 1px solid rgba(255, 255, 255, 0.15);
		border-radius: 10px;
		color: #fff;
		font-family: var(--p-font-family);
		font-size: 15px;
		transition: all 0.3s ease;
		outline: none;
	}

	.custom-form-input:focus, .custom-form-select:focus, .custom-form-textarea:focus{
		border-color: var(--main-color);
		background: rgba(255, 255, 255, 0.09);
		box-shadow: 0 0 12px rgba(255, 163, 67, 0.25);
	}

	.custom-form-select option{
		background: #111522;
		color: #fff;
	}

	.custom-form-row{
		display: grid;
		grid-template-columns: 1fr 1fr;
		gap: 16px;
	}

	@media (max-width: 600px){
		.custom-form-row{
			grid-template-columns: 1fr;
		}
	}

	.submit-inquiry-btn{
		width: 100%;
		padding: 16px;
		background: var(--main-color);
		color: #111;
		font-weight: 700;
		font-family: var(--h5-font-family);
		border-radius: 10px;
		border: 2px solid var(--main-color);
		font-size: 16px;
		cursor: pointer;
		display: flex;
		align-items: center;
		justify-content: center;
		gap: 10px;
		transition: all 0.35s ease;
	}

	.submit-inquiry-btn:hover{
		background: transparent;
		color: #fff;
		border-color: #fff;
		transform: translateY(-2px);
	}

	.inquiry-alert{
		display: none;
		padding: 14px 20px;
		border-radius: 10px;
		margin-bottom: 20px;
		font-size: 14.5px;
	}

	.inquiry-alert.success{
		display: flex;
		align-items: center;
		gap: 10px;
		background: rgba(46, 204, 113, 0.15);
		border: 1px solid rgba(46, 204, 113, 0.4);
		color: #2ecc71;
	}

	.inquiry-alert.error{
		display: flex;
		align-items: center;
		gap: 10px;
		background: rgba(231, 76, 60, 0.15);
		border: 1px solid rgba(231, 76, 60, 0.4);
		color: #e74c3c;
	}
</style>
	
	<section class="contact-container">
		<h1 class="h1">Contact Us</h1>
		<p>Plan your next journey with our travel experts or get in touch for custom bookings.</p>
	</section>

	<section class="contact-content-section <?php echo $isAdmin ? 'admin-edit-container' : ''; ?>" style="padding-top: 50px;">
        <?php if ($isAdmin): ?>
            <a href="admin/contact_table.php" class="btn-edit"><i class="ri-edit-line"></i> Manage Contact Info</a>
        <?php endif; ?>

		<div class="contact-info-grid">
			<?php 
				$query = "SELECT * FROM contact";
				$run = mysqli_query($conn, $query);

				while($row = mysqli_fetch_array($run))
				{
					$h3 = $row['h3'];
					$info = $row['info'];
			?>
			<div class="contact-box">
				<h3><i class="ri-compass-3-line"></i> <?php echo htmlspecialchars($h3); ?></h3>
				<span><?php echo htmlspecialchars($info); ?></span>	
			</div>
			<?php } ?>
		</div>

		<!-- Interactive Inquiry & Message Form -->
		<div class="inquiry-section-wrapper">
			<div class="inquiry-intro">
				<h2>Send Us A <span>Message</span></h2>
				<p>Whether you're inquiring about an exclusive holiday package, customized group itinerary, or need travel assistance, our global travel advisors are here for you.</p>
				
				<ul class="support-highlights">
					<li><i class="ri-check-double-line"></i> Dedicated travel consultant assigned within 24 hours</li>
					<li><i class="ri-shield-check-line"></i> 100% transparent pricing with no hidden charges</li>
					<li><i class="ri-customer-service-2-line"></i> 24/7 on-tour customer support wherever you travel</li>
				</ul>

				<div style="margin-top: 35px; padding: 20px; background: rgba(255,255,255,0.03); border-radius: 12px; border-left: 3px solid var(--main-color);">
					<small style="color: var(--main-color); font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Office Hours</small>
					<p style="margin: 5px 0 0; color: rgba(255,255,255,0.7); font-size: 13.5px;">Monday – Saturday: 9:00 AM – 7:00 PM<br>Sunday: Closed</p>
				</div>
			</div>

			<div class="inquiry-form-container">
				<div id="inquiryAlert" class="inquiry-alert"></div>

				<?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
					<div class="inquiry-alert success" style="display: flex;">
						<i class="ri-checkbox-circle-fill fs-5"></i>
						<span>Thank you! Your message has been sent successfully. We will contact you shortly.</span>
					</div>
				<?php endif; ?>

				<form id="contactInquiryForm" action="submit_inquiry.php" method="POST">
					<input type="hidden" name="type" value="Contact Message">

					<div class="custom-form-row">
						<div class="custom-form-group">
							<label for="name">Your Name *</label>
							<input type="text" id="name" name="name" class="custom-form-input" placeholder="e.g. John Doe" required>
						</div>
						<div class="custom-form-group">
							<label for="email">Email Address *</label>
							<input type="email" id="email" name="email" class="custom-form-input" placeholder="e.g. john@example.com" required>
						</div>
					</div>

					<div class="custom-form-row">
						<div class="custom-form-group">
							<label for="phone">Phone / WhatsApp</label>
							<input type="text" id="phone" name="phone" class="custom-form-input" placeholder="+1 (555) 000-0000">
						</div>
						<div class="custom-form-group">
							<label for="tour_name">Inquiry Topic / Package</label>
							<select id="tour_name" name="tour_name" class="custom-form-select">
								<option value="General Inquiry">General Inquiry</option>
								<option value="Custom Holiday Package">Custom Holiday Package</option>
								<option value="Tour Destination Booking">Tour Destination Booking</option>
								<option value="Corporate / Group Travel">Corporate / Group Travel</option>
							</select>
						</div>
					</div>

					<div class="custom-form-group">
						<label for="message">How Can We Help You? *</label>
						<textarea id="message" name="message" rows="4" class="custom-form-textarea" placeholder="Describe your travel plans, preferred destinations, or questions..." required></textarea>
					</div>

					<button type="submit" id="submitBtn" class="submit-inquiry-btn">
						<i class="ri-send-plane-fill"></i> Send Message
					</button>
				</form>
			</div>
		</div>
	</section>

	<script>
		document.getElementById('contactInquiryForm').addEventListener('submit', function(e) {
			e.preventDefault();
			const form = this;
			const btn = document.getElementById('submitBtn');
			const alertBox = document.getElementById('inquiryAlert');
			const originalBtnHtml = btn.innerHTML;

			btn.disabled = true;
			btn.innerHTML = '<i class="ri-loader-4-line ri-spin"></i> Sending Message...';
			alertBox.style.display = 'none';

			const formData = new FormData(form);
			formData.append('is_ajax', '1');

			fetch('submit_inquiry.php', {
				method: 'POST',
				headers: {
					'X-Requested-With': 'XMLHttpRequest'
				},
				body: formData
			})
			.then(response => response.json())
			.then(data => {
				btn.disabled = false;
				btn.innerHTML = originalBtnHtml;

				if (data.status === 'success') {
					alertBox.className = 'inquiry-alert success';
					alertBox.innerHTML = '<i class="ri-checkbox-circle-fill fs-5"></i> <span>' + data.message + '</span>';
					alertBox.style.display = 'flex';
					form.reset();
				} else {
					alertBox.className = 'inquiry-alert error';
					alertBox.innerHTML = '<i class="ri-error-warning-fill fs-5"></i> <span>' + (data.message || 'An error occurred.') + '</span>';
					alertBox.style.display = 'flex';
				}
			})
			.catch(err => {
				btn.disabled = false;
				btn.innerHTML = originalBtnHtml;
				alertBox.className = 'inquiry-alert error';
				alertBox.innerHTML = '<i class="ri-error-warning-fill fs-5"></i> <span>Unable to send message right now. Please try again.</span>';
				alertBox.style.display = 'flex';
			});
		});
	</script>

<?php 
	include ("inc/footer.php");
?>