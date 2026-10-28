		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
	<script>
		// Auto-dismiss alert after 4 seconds
		setTimeout(function() {
			let alertEl = document.querySelector('.alert');
			if (alertEl) {
				let bsAlert = new bootstrap.Alert(alertEl);
				bsAlert.close();
			}
		}, 4000);
	</script>
</body>
</html>