/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  window.helpers = {};
  window.overlay = {};
  window.overlay.open = function(overlayElem){
    $('.overlay[data-overlay="'+overlayElem+'"]').fadeIn(400,function(){
      $('.overlay[data-overlay="'+overlayElem+'"]').addClass('isVisible');
      $('body').attr('style','overflow: hidden;');
    });
  };
  window.overlay.close = function(overlayElem){
    $('body').attr('style','');
    $('.overlay[data-overlay="'+overlayElem+'"]').fadeOut(400,function(){
      $('.overlay[data-overlay="'+overlayElem+'"]').removeClass('isVisible');
    });
  };

  window.helpers.dropdownBox = {};
  window.helpers.dropdownBox.create = function(select){
    var thisSelect = select;
    var placeholder = thisSelect.attr('placeholder');
    var options = thisSelect.find('option');
    thisSelect.hide();
    $('<div class="select"><span class="fa fa-chevron-down selected">'+placeholder+'</span><ul></ul></div>').insertAfter(thisSelect);
    options.each(function(){
      var thisOption = $(this);
      thisSelect.next($('.select')).find('ul').append('<li><a href="'+thisOption.attr('value')+'">'+thisOption.text()+'</a></li>');
    });
  };
  window.helpers.dropdownBox.close = function(select){
    select.removeClass('open');
  };
  window.helpers.dropdownBox.open = function(select){
    $('body').find('.select.open').removeClass('open');
    select.addClass('open');
  };

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages
        $('#search select').each(function(){
          window.helpers.dropdownBox.create($(this));
        });

        $('body').on('click','.select',function(){
          if($(this).hasClass('open')){
            window.helpers.dropdownBox.close($(this));
          }else{
            window.helpers.dropdownBox.open($(this));
          }
        });

        $('body').on('click','a[data-task][data-overlay]',function(e){
          e.preventDefault();
          var task = $(this).data('task');
          var overlay = $(this).data('overlay');
          if(task === 'open'){
            window.overlay.open(overlay);
          }else if(task === 'close'){
            window.overlay.close(overlay);
          }
        });

        $(document).on('click','.overlay--backdrop',function(e){
          e.preventDefault();
          $('.overlay.isVisible').each(function(){
            window.overlay.close($(this).data('overlay'));
          });
        });

        $(document).keydown(function(e) {
          if(e.which === 27) {
            $('.overlay.isVisible').each(function(){
              window.overlay.close($(this).data('overlay'));
            });
          }
        });

        $('a[href*="#"]:not([href="#"])').click(function() {
          if (location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') && location.hostname === this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
              $('html,body').animate({
                scrollTop: target.offset().top
              }, 1000);
              return false;
            }
          }
        });

        if($('header.banner').length){
          var triggerNav = $('header.banner').outerHeight();
          $(window).scroll(function (event) {
            if($(window).scrollTop() >= triggerNav){
              $('#bar .brand').addClass('show');
            }else{
              $('#bar .brand').removeClass('show');
            }
          });
        }
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
        WebFontConfig = {
          google: {
            families: [
              'Nobile:400,400italic,700,700italic',
              'Montserrat:700,400',
              'Libre+Baskerville:700,400,400italic'
            ]
          }
        };
        (function() {
          var wf = document.createElement('script');
          wf.src = ('https:' === document.location.protocol ? 'https' : 'http') +
          '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
          wf.type = 'text/javascript';
          wf.async = 'true';
          var s = document.getElementsByTagName('script')[0];
          s.parentNode.insertBefore(wf, s);
        })();
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'single': {
      finalize: function() {
        $(window).scroll(function (event) {
          if($(window).scrollTop() >= 10){
            $('article').addClass('modify');
            $('#bar .brand').addClass('show');
          }else if($(window).scrollTop() <= 10){
            $('article').removeClass('modify');
            $('#bar .brand').removeClass('show');
          }
        });
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.


