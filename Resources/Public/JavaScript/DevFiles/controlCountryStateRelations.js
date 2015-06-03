/**
 * Created by S3b0 on 28/04/15.
 */

(function($) {
	var states = [];
	var selector = $('#state-selector #state');
	var mandatory = $('#state-selector .text-danger');

	/**
	 * Write option contents to Array
	 */
	$('#state-selector #state option').each(function() {
		if ( $(this).val() ) {
			states.push({
				'label': $(this).html(),
				'value': $(this).val(),
				'country': $(this).data('country')
			});
		}
	});

	/**
	 * Initializes the 'Control-Country-State-Relation'
	 */
	function initCCSR() {
		mandatory.hide();
		selector.html('');
		selector.attr('disabled', 'disabled');
	}

	/**
	 * Initialize ParsleyJS
	 */
	function initParsley() {
		$('#app-lib-register-download').parsley();
	}

	/**
	 * Bind onchange function to country selector
	 */
	$('#country-selector #country').on('change', function() {
		var value = $(this).val();

		initCCSR();
		/**
		 * Walk through states to fetch and append those available to state selector, if any
		 */
		$.each(states, function() {
			if ( this.country == value ) {
				selector.append('<option value="' + this.value + '">' + this.label + '</option>');
			}
		});
		/**
		 * If any states available, make state selector required and bind empty value option to make validation work
		 */
		if ( $('#state-selector #state option').length ) {
			mandatory.show();
			selector.prepend('<option value="" selected="selected"></option>');
			selector.attr('required', 'required');
			selector.attr('data-parsley-required', 'true');
			selector.removeAttr('disabled');
		} else {
			selector.prepend('<option value="0" selected="selected"></option>');
			selector.removeAttr('required');
			selector.removeAttr('data-parsley-required');
		}
		initParsley();
	});

	initCCSR();
	initParsley();
})(jQuery);