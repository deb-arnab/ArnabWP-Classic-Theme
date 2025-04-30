jQuery(document).ready(function($) {
	console.log("Tabs JS loaded");

	$('.arnabwp-tab-nav li').on('click', function() {
		const $tab = $(this);
		const value = $tab.data('tab');
		const $control = $tab.closest('.arnabwp-tab-control');

		console.log("Tab clicked:", value);

		$control.find('li').removeClass('active');
		$tab.addClass('active');

		$control.find('input[type="hidden"]').val(value).trigger('change');
	});
});