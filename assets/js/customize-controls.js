( function( api ) {

    // Extends our custom "" section.
    api.sectionConstructor['ts-demo-importer'] = api.Section.extend( {

        // No events for this type of section.
        attachEvents: function () {},

        // Always make the section active.
        isContextuallyActive: function () {
            return true;
        }
    } );
    jQuery(document).ready(function()
	{
    	jQuery('#customize-theme-controls #ts-img-container li img').click(function()
    	{
        	jQuery('#customize-theme-controls #ts-img-container li img').removeClass('ts-radio-img-selected');
        	jQuery(this).addClass('ts-radio-img-selected');
    	});
	});

    

} )( wp.customize );