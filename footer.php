<div id="back-top">
	<i class="fa fa-fw fa-arrow-circle-up"></i>
</div>
<script src="admin/js/jquery.min.js"></script>
<script src="admin/js/jquery-ui.js"></script>
<script src="admin/js/bootstrap.min.js"></script>
<script src="admin/js/adminlte.min.js"></script>
<script src="admin/js/dashboard.js"></script>
<script src="admin/js/function.js"></script>
<script src="admin/ckeditor/ckeditor.js"></script>
<script>
	$(window).scroll(function() {
		if ($(this).scrollTop()) {
			$('#back-top').fadeIn();
		} else {
			$('#back-top').fadeOut();
		}
	});

	$("#back-top").click(function() {
		$("html, body").animate({scrollTop: 0}, 1000);
	});
</script>
</body>
</html>
