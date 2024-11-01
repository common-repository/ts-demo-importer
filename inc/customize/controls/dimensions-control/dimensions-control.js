( function( api ) {
// Dimenstion Control
    api.controlConstructor['dimensions'] = api.Control.extend({
        ready: function () {
            var control = this;
            control.container.on('change keyup paste', '.bmp-dimension-desktop_top', function () {
                control.settings['desktop_top'].set(jQuery(this).val());
            });
            control.container.on('change keyup paste', '.bmp-dimension-desktop_right', function () {
                control.settings['desktop_right'].set(jQuery(this).val());
            });
            control.container.on('change keyup paste', '.bmp-dimension-desktop_bottom', function () {
                control.settings['desktop_bottom'].set(jQuery(this).val());
            });
            control.container.on('change keyup paste', '.bmp-dimension-desktop_left', function () {
                control.settings['desktop_left'].set(jQuery(this).val());
            });
            control.container.on('change keyup paste', '.bmp-dimension-tablet_top', function () {
                control.settings['tablet_top'].set(jQuery(this).val());
            });
            control.container.on('change keyup paste', '.bmp-dimension-tablet_right', function () {
                control.settings['tablet_right'].set(jQuery(this).val());
            });
            control.container.on('change keyup paste', '.bmp-dimension-tablet_bottom', function () {
                control.settings['tablet_bottom'].set(jQuery(this).val());
            });
            control.container.on('change keyup paste', '.bmp-dimension-tablet_left', function () {
                control.settings['tablet_left'].set(jQuery(this).val());
            });
            control.container.on('change keyup paste', '.bmp-dimension-mobile_top', function () {
                control.settings['mobile_top'].set(jQuery(this).val());
            });
            control.container.on('change keyup paste', '.bmp-dimension-mobile_right', function () {
                control.settings['mobile_right'].set(jQuery(this).val());
            });
            control.container.on('change keyup paste', '.bmp-dimension-mobile_bottom', function () {
                control.settings['mobile_bottom'].set(jQuery(this).val());
            });
            control.container.on('change keyup paste', '.bmp-dimension-mobile_left', function () {
                control.settings['mobile_left'].set(jQuery(this).val());
            });
        }
    });
} )( wp.customize );