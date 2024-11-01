var Tdi_Whizzie = (function($) {
  var t;
  var current_step = '';
  var step_pointer = '';

  // callbacks from form button clicks.
  var callbacks = {
    do_next_step: function(btn) {
      do_next_step(btn);
    },

    install_themes: function(btn) {
      var themes = new ThemeManager();
      themes.init(btn);
    },

    install_plugins: function(btn) {
      var plugins = new PluginManager();
      plugins.init(btn);
    },

    install_widgets: function(btn) {
      var widgets = new WidgetManager();
      widgets.init(btn);
    },

    install_content: function(btn) {
      var content = new ContentManager();
      content.init(btn);
    }
  };

  function window_loaded() {
    // Get all steps and find the biggest
    // Set all steps to same height
    var maxHeight = 0;

    $('.whizzie-menu li.step').each(function(index) {
      $(this).attr('data-height', $(this).innerHeight());
      if ($(this).innerHeight() > maxHeight) {
        maxHeight = $(this).innerHeight();
      }
    });

    $('.whizzie-menu li .detail').each(function(index) {
      $(this).attr('data-height', $(this).innerHeight());
      $(this).addClass('scale-down');
    });


    $('.whizzie-menu li.step').css('height', '100%');
    $('.whizzie-menu li.step:first-child').addClass('active-step');
    $('.whizzie-nav li:first-child').addClass('active-step');

    $('.whizzie-wrap').addClass('loaded');

    // init button clicks:
    $('.do-it').on('click', function(e) {
      e.preventDefault();
      step_pointer = $(this).data('step');
      current_step = $('.step-' + $(this).data('step'));
      $('.whizzie-wrap').addClass('spinning');
      if ($(this).data('callback') && typeof callbacks[$(this).data('callback')] != 'undefined') {
        // we have to process a callback before continue with form submission
        callbacks[$(this).data('callback')](this);
        return false;
      } else {
        loading_content();
        window.location.href = ts_demo_importer_whizzie_params.admin_url + 'admin.php?page=ibtana-visual-editor-templates';
        return true;
      }
    });

    $('.button-upload').on('click', function(e) {
      e.preventDefault();
      renderMediaUploader();
    });

    $('.theme-presets a').on('click', function(e) {
      e.preventDefault();
      var $ul = $(this).parents('ul').first();
      $ul.find('.current').removeClass('current');
      var $li = $(this).parents('li').first();
      $li.addClass('current');
      var newcolor = $(this).data('style');
      $('#new_style').val(newcolor);
      return false;
    });
    $('.more-info').on('click', function(e) {
      e.preventDefault();
      var parent = $(this).parent().parent();
      parent.toggleClass('show-detail');
      if (parent.hasClass('show-detail')) {
        var detail = parent.find('.detail');
        parent.animate({
            height: parent.data('height') + detail.data('height')
          },
          500,
          function() {
            detail.toggleClass('scale-down');
          }).css('overflow', 'visible');;
      } else {
        parent.animate({
            height: maxHeight
          },
          500,
          function() {
            detail = parent.find('.detail');
            detail.toggleClass('scale-down');
          }).css('overflow', 'visible');
      }
    });

    function get_tsdi_activation_status( callback ) {
      jQuery.post( ts_demo_importer_whizzie_params.ajaxurl , {
        action:							'tsdi_activation_status'
      }, function( tsdi_response ) {

        if ( tsdi_response.status == true ) {
          callback( true );
        }
      });
    }

    $( '#tsdi-license-form' ).on( 'submit', function(e) {
      e.preventDefault();
      var tsdi_license_key = jQuery('#tsdi_license_key_input').val().trim();
      if ( !tsdi_license_key ) {
        alert( 'Please enter license key!' );
        return;
      }
      jQuery('.plugin_activation_spinner').show();
      jQuery( '#tsdi_license_key_input, #tsdi-license-form button' ).attr( 'disabled', true );
      var tsdi_data = {
        action: 'activate_tsdi_license',
        add_on_key: tsdi_license_key,
				security:		ts_demo_importer_whizzie_params.wpnonce
      };

      jQuery.post( ts_demo_importer_whizzie_params.ajaxurl, tsdi_data, function( tsdi_response ) {

        if( tsdi_response.status == true ) {
          get_tsdi_activation_status( function( status ) {
            if ( true === status ) {
              jQuery.post( ts_demo_importer_whizzie_params.ajaxurl , {
                action:     'tsdi_install_plugin_hook',
        				security:   ts_demo_importer_whizzie_params.wpnonce
              }, function( tsdi_response_plugin_hook ) {

                alert( tsdi_response.msg );
                jQuery('.plugin_activation_spinner').hide();
                jQuery( '#tsdi-license-form button' ).text( 'Activated' );
                $( '#tsdi-license-form .tsdi-addon-license-key-buttons-wrap' ).append(
                  `<button type="reset" name="tsdi_change_key">Change Key</button>`
                );

                location.href = ts_demo_importer_whizzie_params.admin_url + "themes.php?page=ts-demoimporter-license";
              });
            }
          } );
        } else {
          jQuery('.plugin_activation_spinner').hide();
          alert( tsdi_response.msg );
          jQuery( '#tsdi_license_key_input, #tsdi-license-form button' ).attr( 'disabled', false );
        }
      });
    });

    $( '#tsdi-license-form' ).on( 'click', '[name="tsdi_change_key"]', function() {
      $('#tsdi_license_key_input').val('');
      $('#tsdi_license_key_input').prop( 'disabled', false );
      $( '#tsdi-license-form button[type="submit"]' ).text( "Activate" );
      $( '#tsdi-license-form button[type="submit"]' ).prop( 'disabled', false );
      $( this ).remove();
    });

    get_tsdi_activation_status( function( status ) {
    });
  }

  function loading_content() {

  }


  function do_next_step(btn) {
    current_step.removeClass('active-step');
    $('.nav-step-' + step_pointer).removeClass('active-step');
    current_step.addClass('done-step');
    $('.nav-step-' + step_pointer).addClass('done-step');
    current_step.fadeOut(500, function() {
      current_step = current_step.next();
      step_pointer = current_step.data('step');
      current_step.fadeIn();
      current_step.addClass('active-step');
      $('.nav-step-' + step_pointer).addClass('active-step');
      $('.whizzie-wrap').removeClass('spinning');
    });
  }


  function ThemeManager() {

    var complete;
    var items_completed = 0;
    var current_item = '';
    var $current_node;
    var current_item_hash = '';

    function ajax_callback(response) {

      if (typeof response == 'object' && typeof response.message != 'undefined') {
        $current_node.find('span').text(response.message);
        if (typeof response.url != 'undefined') {
          // we have an ajax url action to perform.

          if (response.hash == current_item_hash) {
            $current_node.find('span').text("failed");
            find_next();
          } else {
            current_item_hash = response.hash;

            if (response.message == "Installing Plugin") {
              jQuery.get(response.url, function(response2) {
                process_current();
                $current_node.find('span').text(response.message + ts_demo_importer_whizzie_params.verify_text);
              }).fail(ajax_callback);
            } else {
              jQuery.get(response.url, function(response2) {
                process_current();
                $current_node.find('span').text(response.message + ts_demo_importer_whizzie_params.verify_text);
              }).fail(ajax_callback);
            }

          }

        } else if (typeof response.done != 'undefined') {
          // finished processing this plugin, move onto next
          find_next();
        } else {
          // error processing this plugin
          find_next();
        }
      } else {
        // error - try again with next plugin
        $current_node.find('span').text("ajax error");
        find_next();
      }
    }


    function process_current() {
      if (current_item) {
        // query our ajax handler to get the ajax to send to TGM
        // if we don't get a reply we can assume everything worked and continue onto the next one.
        jQuery.post(ts_demo_importer_whizzie_params.ajaxurl, {
          action: 'ts_demo_importer_setup_themes',
          wpnonce: ts_demo_importer_whizzie_params.wpnonce,
          slug: current_item
        }, ajax_callback).fail(ajax_callback);

      }
    }

    function find_next(slug) {
      var do_next = false;
      if ($current_node) {
        if (!$current_node.data('done_item')) {
          items_completed++;
          $current_node.data('done_item', 1);
        }
        $current_node.find('.spinner').css('visibility', 'hidden');
      }
      var $li = $('.ts-demo-importer-do-themes li[data-slug="'+slug+'"]');

      $li.each(function() {
        if (current_item == '' || do_next) {
          current_item = $(this).data('slug');
          $current_node = $(this);
          process_current();
          do_next = false;
        } else if ($(this).data('slug') == current_item) {
          do_next = true;
        }
      });
      if (items_completed >= $li.length) {
        // finished all themes!
        complete();
      }
    }

    return {
      init: function(btn) {
        $('.envato-wizard-plugins').addClass('installing');
        complete = function() {
          do_next_step();
        };
        find_next($(btn).attr('data-slug'));
      }
    }

  }


  function PluginManager() {

    var complete;
    var items_completed = 0;
    var current_item = '';
    var $current_node;
    var current_item_hash = '';

    function ajax_callback(response) {
      if (typeof response == 'object' && typeof response.message != 'undefined') {
        $current_node.find('span').text(response.message);
        if (typeof response.url != 'undefined') {
          // we have an ajax url action to perform.

          if (response.hash == current_item_hash) {
            $current_node.find('span').text("failed");
            find_next();
          } else {
            current_item_hash = response.hash;
            jQuery.post(response.url, response, function(response2) {
              process_current();
              $current_node.find('span').text(response.message + ts_demo_importer_whizzie_params.verify_text);
            }).fail(ajax_callback);
          }

        } else if (typeof response.done != 'undefined') {
          // finished processing this plugin, move onto next
          find_next();
        } else {
          // error processing this plugin
          find_next();
        }
      } else {
        // error - try again with next plugin
        $current_node.find('span').text("ajax error");
        find_next();
      }
    }

    function process_current() {
      if (current_item) {
        // query our ajax handler to get the ajax to send to TGM
        // if we don't get a reply we can assume everything worked and continue onto the next one.
        jQuery.post(ts_demo_importer_whizzie_params.ajaxurl, {
          action: 'ts_demo_importer_setup_plugins',
          wpnonce: ts_demo_importer_whizzie_params.wpnonce,
          slug: current_item
        }, ajax_callback).fail(ajax_callback);
      }
    }

    function find_next() {
      var do_next = false;
      if ($current_node) {
        if (!$current_node.data('done_item')) {
          items_completed++;
          $current_node.data('done_item', 1);
        }
        $current_node.find('.spinner').css('visibility', 'hidden');
      }
      var $li = $('.whizzie-do-plugins li');
      $li.each(function() {
        if (current_item == '' || do_next) {
          current_item = $(this).data('slug');
          $current_node = $(this);
          process_current();
          do_next = false;
        } else if ($(this).data('slug') == current_item) {
          do_next = true;
        }
      });
      if (items_completed >= $li.length) {
        // finished all plugins!
        complete();
      }
    }

    return {
      init: function(btn) {
        $('.envato-wizard-plugins').addClass('installing');
        complete = function() {
          do_next_step();
          // window.location.href=btn.href;
          // window.location.href = "http://localhost/catapult_themes/whizzie/wp-admin/themes.php?page=whizzie";
        };
        find_next();
      }
    }
  }

  function WidgetManager() {
    function import_widgets() {
      jQuery.post(
        ts_demo_importer_whizzie_params.ajaxurl, {
          action: 'setup_widgets',
          wpnonce: ts_demo_importer_whizzie_params.wpnonce
        },
        complete
      );
    }

    return {
      init: function(btn) {
        complete = function() {
          do_next_step();
        }
        import_widgets();
      }
    }
  }

  function ContentManager() {

    var complete;
    var items_completed = 0;
    var current_item = '';
    var $current_node;
    var current_item_hash = '';

    function ajax_callback(response) {
      if (typeof response == 'object' && typeof response.message != 'undefined') {
        $current_node.find('span').text(response.message);
        if (typeof response.url != 'undefined') {
          // we have an ajax url action to perform.
          if (response.hash == current_item_hash) {
            $current_node.find('span').text("failed");
            find_next();
          } else {
            current_item_hash = response.hash;
            jQuery.post(response.url, response, ajax_callback).fail(ajax_callback); // recuurrssionnnnn
          }
        } else if (typeof response.done != 'undefined') {
          // finished processing this plugin, move onto next
          find_next();
        } else {
          // error processing this plugin
          find_next();
        }
      } else {
        // error - try again with next plugin
        $current_node.find('span').text("ajax error");
        find_next();
      }
    }

    function process_current() {
      if (current_item) {

        var $check = $current_node.find('input:checkbox');
        if ($check.is(':checked')) {
          // process htis one!
          jQuery.post(ts_demo_importer_whizzie_params.ajaxurl, {
            action: 'envato_setup_content',
            wpnonce: ts_demo_importer_whizzie_params.wpnonce,
            content: current_item
          }, ajax_callback).fail(ajax_callback);
        } else {
          $current_node.find('span').text("Skipping");
          setTimeout(find_next, 300);
        }
      }
    }


    return {
      init: function(btn) {
        $('.envato-setup-pages').addClass('installing');
        $('.envato-setup-pages').find('input').prop("disabled", true);
        complete = function() {
          loading_content();
          window.location.href = btn.href;
        };
        find_next();
      }
    }
  }

  /**
   * Callback function for the 'click' event of the 'Set Footer Image'
   * anchor in its meta box.
   *
   * Displays the media uploader for selecting an image.
   *
   * @since 0.1.0
   */
  function renderMediaUploader() {
    'use strict';

    var file_frame, attachment;

    if (undefined !== file_frame) {
      file_frame.open();
      return;
    }

    file_frame = wp.media.frames.file_frame = wp.media({
      title: 'Upload Logo', //jQuery( this ).data( 'uploader_title' ),
      button: {
        text: 'Select Logo' //jQuery( this ).data( 'uploader_button_text' )
      },
      multiple: false // Set to true to allow multiple files to be selected
    });

    // When an image is selected, run a callback.
    file_frame.on('select', function() {
      // We set multiple to false so only get one image from the uploader
      attachment = file_frame.state().get('selection').first().toJSON();

      jQuery('.site-logo').attr('src', attachment.url);
      jQuery('#new_logo_id').val(attachment.id);
      // Do something with attachment.id and/or attachment.url here
    });
    // Now display the actual file_frame
    file_frame.open();

  }

  return {
    init: function() {
      t = this;
      $(window_loaded);
    },
    callback: function(func) {
      console.log(func);
      console.log(this);
    }
  }

})(jQuery);

Tdi_Whizzie.init();

jQuery(document).ready(function() {

  jQuery('#ts-demo-setup-guid .ts-setup-menu').attr("checked", "checked");

  jQuery('#ts-setup-menu').click(function() {
    jQuery('#ts-demo-setup-guid .ts-setup-menu').css("display", "block");
    jQuery('#ts-demo-setup-guid .ts-setup-contact').css("display", "none");
    jQuery('#ts-demo-setup-guid .ts-setup-widget').css("display", "none");
    jQuery('#ts-demo-setup-guid .ts-setup-social-icon').css("display", "none");
  });

  jQuery('#ts-setup-contact').click(function() {
    jQuery('#ts-demo-setup-guid .ts-setup-menu').css("display", "none");
    jQuery('#ts-demo-setup-guid .ts-setup-contact').css("display", "block");
    jQuery('#ts-demo-setup-guid .ts-setup-widget').css("display", "none");
    jQuery('#ts-demo-setup-guid .ts-setup-social-icon').css("display", "none");
  });

  jQuery('#ts-setup-widget').click(function() {
    jQuery('#ts-demo-setup-guid .ts-setup-menu').css("display", "none");
    jQuery('#ts-demo-setup-guid .ts-setup-contact').css("display", "none");
    jQuery('#ts-demo-setup-guid .ts-setup-widget').css("display", "block");
    jQuery('#ts-demo-setup-guid .ts-setup-social-icon').css("display", "none");
  });

  jQuery('#ts-setup-social').click(function() {
    jQuery('#ts-demo-setup-guid .ts-setup-menu').css("display", "none");
    jQuery('#ts-demo-setup-guid .ts-setup-contact').css("display", "none");
    jQuery('#ts-demo-setup-guid .ts-setup-widget').css("display", "none");
    jQuery('#ts-demo-setup-guid .ts-setup-social-icon').css("display", "block");
  });
});
