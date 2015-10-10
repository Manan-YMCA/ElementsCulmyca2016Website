jQuery(document).ready(function($) {
	$('.the_tile').poshytip({
		className: 'tip-twitter',
		showTimeout: 0,
		hideTimeout: 0,
		alignTo: 'target',
		alignX: 'center',
		offsetY: 5,
		fade: true,
		slide: false,
		showAniDuration: 300,
		hideAniDuration: 300,
		allowTipHover: false
	});
});