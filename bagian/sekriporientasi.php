<script>
	function toggleDropdownByOrientation() {
		const isPortrait = window.orientation === 0 || window.orientation === 180;
		const hideOnDesktop = document.querySelector('.hide-on-desktop');
		const showOnMobile = document.querySelector('.show-on-mobile');

		if (hideOnDesktop && showOnMobile) {
			if (isPortrait) {
				hideOnDesktop.style.display = 'none';
				showOnMobile.style.display = 'block';
			} else {
				hideOnDesktop.style.display = 'block';
				showOnMobile.style.display = 'none';
			}
		}
	}

	toggleDropdownByOrientation();

	window.addEventListener('orientationchange', function () {
		toggleDropdownByOrientation();
	});
</script>

</body>

</html>