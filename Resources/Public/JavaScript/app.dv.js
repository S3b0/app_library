/**
 * Created by S3b0 on 26/06/15.
 */

jQuery.fn.extend({
	slideRightShow: function() {
		return this.each(function() {
			$(this).show('slide', {direction: 'right'}, 1000);
		});
	},
	slideLeftHide: function() {
		return this.each(function() {
			$(this).hide('slide', {direction: 'left'}, 1000);
		});
	},
	slideRightHide: function() {
		return this.each(function() {
			$(this).hide('slide', {direction: 'right'}, 1000);
		});
	},
	slideLeftShow: function() {
		return this.each(function() {
			$(this).show('slide', {direction: 'left'}, 1000);
		});
	}
});

! function($) {
	var owl = $('#app-lib-owl-carousel'),
		cards = $('.app-lib-app-qv-card'),
		prevButton = $('.app-lib-owl-nav-prv'),
		nextButton = $('.app-lib-owl-nav-nxt');
	owl.owlCarousel({dots: false, lazyLoad: true, margin: 10, video: true});
	prevButton.on('click', function() { owl.trigger('prev.owl.carousel') });
	nextButton.on('click', function() { owl.trigger('next.owl.carousel') });

	toggleNavigation();
	owl.on('translated.owl.carousel', function() { toggleNavigation() });

	function toggleNavigation() {
		console.log(prevButton);
		// Only 1 Page
		if(owl.find('.owl-item').last().hasClass('active') && owl.find('.owl-item').first().hasClass('active')) {
			$('.app-lib-owl-nav-nxt:visible').slideRightHide();
			$('.app-lib-owl-nav-prv:visible').slideLeftHide();
		} else if(owl.find('.owl-item').last().hasClass('active')){
			$('.app-lib-owl-nav-nxt:visible').slideRightHide();
			$('.app-lib-owl-nav-prv:hidden').slideRightShow();
		} else if(owl.find('.owl-item').first().hasClass('active')) {
			$('.app-lib-owl-nav-nxt:hidden').slideLeftShow();
			$('.app-lib-owl-nav-prv:visible').slideLeftHide();
		} else {
			$('.app-lib-owl-nav-nxt:hidden').slideLeftShow();
			$('.app-lib-owl-nav-prv:hidden').slideRightShow();
		}
	}

	cards.on('mouseover', function() {
		$('.app-lib-app-qv-card-overlay').stop(true, false).slideUp(100);
		$(this).children('.app-lib-app-qv-card-overlay').first().stop(true, false).slideDown(100);
	});
	cards.on('mouseout', function() {
		$('.app-lib-app-qv-card-overlay').stop(true, false).slideUp(100);
	});
	/*
	 $('a.expand-all').on('click', function() { $($(this).data('collapsible') + ':not(".in")').collapse('show'); });
	 $('a.collapse-all').on('click', function() { $($(this).data('collapsible') + '.in').collapse('hide'); });
	 */
}(jQuery);