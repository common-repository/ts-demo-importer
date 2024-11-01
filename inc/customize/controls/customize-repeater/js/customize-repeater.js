jQuery( document ).ready(function($) {
	"use strict";

	/**
	 * Sortable Repeater Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */

	// Update the values for all our input fields and initialise the sortable repeater
	$('.sortable_repeater_control').each(function() {
		// If there is an existing customizer value, populate our rows
		// var defaultValuesArray = $(this).find('.customize-control-sortable-repeater').val().split(',');
		// multiadvnce

		if (themeshopy_custom_controls_customscripts_obj.theme_text_domain == 'multi-advance') {
			var defaultValuesArray = new Array("our-records","about-us","our-skills","our-services","banner","our-projects","features","team","hire-us","pricing-plan","quote-banner","consult-us","additional-services","testimonials","our-brands","skills-showcase","latest-news","contact-map","content-area");
		} else if (themeshopy_custom_controls_customscripts_obj.theme_text_domain == 'advance-marketing-agency') {
			var defaultValuesArray = new Array("about-us","our-skills","our-services","banner","our-projects","personalized-support","best-services-offered","our-brands","skills-showcase","upcoming-events","latest-news","contact-map","content-area");
		} else if (themeshopy_custom_controls_customscripts_obj.theme_text_domain == 'advance-consultancy') {
			var defaultValuesArray = new Array("about-us","our-skills","our-services","banner","our-projects","personalized-support","best-services-offered","our-brands","skills-showcase","pricing-plan","testimonials","contact-map","content-area","latest-news","interested-banner");
		} else if (themeshopy_custom_controls_customscripts_obj.theme_text_domain == 'advance-training-academy') {
			var defaultValuesArray = new Array("our-services","about-us","personalized-support","course-programs","all-program","founder","annual-meetup","upcoming-events","video","latest-news");
		}



		var numRepeaterItems = defaultValuesArray.length;

		if(numRepeaterItems > 0) {
			// Add the first item to our existing input field
			$(this).find('.repeater-input').val(defaultValuesArray[0]);
			// Create a new row for each new value
			if(numRepeaterItems > 1) {
				var i;
				for (i = 1; i < numRepeaterItems; ++i) {
					skyrocketAppendRow($(this), defaultValuesArray[i]);
				}
			}
		}
	});
	// Make our Repeater fields sortable
	$(this).find('.sortable').sortable({
		update: function(event, ui) {
			skyrocketGetAllInputs($(this).parent());
		}
	});
	// Remove item starting from it's parent element
	$('.sortable').on('click', '.customize-control-sortable-repeater-delete', function(event) {
		event.preventDefault();
		var numItems = $(this).parent().parent().find('.repeater').length;

		if(numItems > 1) {
			$(this).parent().slideUp('fast', function() {
				var parentContainer = $(this).parent().parent();
				$(this).remove();
				skyrocketGetAllInputs(parentContainer);
			})
		}
		else {
			$(this).parent().find('.repeater-input').val('');
			skyrocketGetAllInputs($(this).parent().parent().parent());
		}
	});
	// Add new item
	$('.customize-control-sortable-repeater-add').click(function(event) {
		event.preventDefault();
		skyrocketAppendRow($(this).parent());
		skyrocketGetAllInputs($(this).parent());
	});
	// Refresh our hidden field if any fields change
	$('.sortable').change(function() {
		skyrocketGetAllInputs($(this).parent());
	})
	// Append a new row to our list of elements
	function skyrocketAppendRow($element, defaultValue = '') {
		var newRow = '<div class="repeater" style="display:none"><input type="text" value="' + defaultValue + '" class="repeater-input" placeholder="" disabled="disabled" /><span class="dashicons dashicons-sort"></span></div>';

		$element.find('.sortable').append(newRow);
		$element.find('.sortable').find('.repeater:last').slideDown('slow', function(){
			$(this).find('input').focus();
		});
	}
	// Get the values from the repeater input fields and add to our hidden field
	function skyrocketGetAllInputs($element) {
		var inputValues = $element.find('.repeater-input').map(function() {
			return $(this).val();
		}).toArray();
		// Add all the values from our repeater fields to the hidden field (which is the one that actually gets saved)
		$element.find('.customize-control-sortable-repeater').val(inputValues);
		// Important! Make sure to trigger change event so Customizer knows it has to save the field
		$element.find('.customize-control-sortable-repeater').trigger('change');
	}
});
