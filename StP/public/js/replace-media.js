(function ($) {
  'use strict';
  function hideGallery() {
    $('.media-router > a:first-child').click()
    $('.media-router > a:last-child').hide()
  }
  function replaceMediaOpener(toReplace) {
    var frame, data
    if (typeof frame !== 'undefined') {
      requestAnimationFrame(hideGallery);
      frame.open()
      return
    }
    frame = wp.media.frames.stpauls_replace = wp.media({
      title: 'Upload Media to Replace',
      mode: 'upload',
      button: {
        text: 'Replace'
      },
      menu:    false,
      toolbar: false,
      router:  false,
      multiple: false
    })
    frame.on('select', function() {
      console.log('test')
      var attachment = frame.state().get('selection').first().toJSON();
      $.ajax({
        url: ajaxurl,
        method: 'POST',
        data: {
          action: 'stpaulsacademy_replace_attachment',
          security: stp_admin_replace_media.nonce,
          replace_with: attachment.id,
          current_id: toReplace
        },
        success: function (resp) {
          window.location.reload();
        },
        error: function () {
          window.location.reload();
        }
      })
    })

    frame.on('close', function () {
      $('.media-router > a:last-child').show();
    })
    // open the modal
    requestAnimationFrame(hideGallery);
    frame.open()
  }
  function main() {
    $('body').on('click', '.stpauls_replace_media', function (ev) {
      ev.preventDefault();
      var toReplace = $(this).data("replace-attachment");
      // Stop propagation to prevent thickbox from activating.
      ev.stopPropagation();
      replaceMediaOpener(toReplace)
    });
  }
  requestAnimationFrame(main);
})(jQuery)