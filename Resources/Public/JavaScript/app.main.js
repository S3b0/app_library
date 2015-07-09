/**
 * Created by S3b0 on 14/04/15.
 */

var grid = $('#app-lib-grid'),
	filterOptions = $('.app-lib-filter-options'),
	cards = $('.app-lib-app-qv-card'),
	urlHash = window.location.hash.substring(1),
	hashGroupTranslation = { };

// Set up button clicks
setupFilters = function() {
	var $btns = filterOptions.children();
	$btns.on('click', function() {
		var isActive = $(this).hasClass( 'active' ),
			group = isActive ? 'all' : $(this).data('group');

		if ( !isActive ) {
			// Deactivate all other navItems next to current
			$('.app-lib-filter-options .active').removeClass('active');
			// Filter elements
			grid.shuffle( 'shuffle', group );
		}

		// Activate current navItem
		$(this).addClass('active');
	});

	$btns = null;
};

(function ($) {
	var initialGroup = hashGroupTranslation[urlHash] !== 'undefined' ? hashGroupTranslation[urlHash] : 'all';
	grid.shuffle({
		group: initialGroup,
		itemSelector: '.app-lib-grid-item',
		delimiter: ','
	});

	filterOptions.children().each(function() {
		if ( initialGroup !== 'ALL_ITEMS' ) {
			if ( $(this).hasClass( 'active' ) ) {
				$(this).removeClass( 'active' );
			}
			if ( initialGroup == $(this).data('group') ) {
				$(this).addClass( 'active' );
			}
		}
	});

	setTimeout(function() {
		setupFilters(initialGroup);
	}, 100);

	cards.on('mouseover', function() {
		$('.app-lib-app-qv-card-overlay').stop(true, false).slideUp(100);
		$(this).children('.app-lib-app-qv-card-overlay').first().stop(true, false).slideDown(100);
	});
	cards.on('mouseout', function() {
		$('.app-lib-app-qv-card-overlay').stop(true, false).slideUp(100);
	});

})(jQuery);