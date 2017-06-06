/* Меню  */
if (screen.width >= '768') {
var Element = function(node){
  var doc = $(document),
      fixed = false,
      anchor = node.find('.menu-anchor'),
      content = node.find('.content-menu');
  
  var onScroll = function(e){
    var docTop = doc.scrollTop(),
        anchorTop = anchor.offset().top;
    
    console.log('scroll', docTop, anchorTop);
    if(docTop > anchorTop){
      if(!fixed){
        anchor.height(content.outerHeight());
        content.addClass('fixed');        
        fixed = true;

      }
    }  else   {
      if(fixed){
        anchor.height(0);
        content.removeClass('fixed'); 
        fixed = false;
      }
    }
  };
  
  $(window).on('scroll', onScroll);
};

var demo = new Element($('#menu'));
};

/* Мобильное меню */

(function($){
$(function(){
$(".mobile-btn").click(function() {
if ($(".menu").hasClass("active")) {
$(".menu").removeClass("active");
}
else {
$(".menu").addClass("active");
}
});
});
})(jQuery); 

/* Поиск */

(function($){
$(function(){
$(".search-btn").click(function() {
if ($(".search").hasClass("active")) {
$(".search").removeClass("active");
}
else {
$(".search").addClass("active");
}
if ($(".search-btn").hasClass("input-on")){
$(".search-btn").removeClass("input-on");
}
else{
$(".search-btn").addClass("input-on");
}
});


});
})(jQuery); 





/* Слайдер */
(function($) {

  'use strict';

  /**
   * Helpers methods
   */

  function supportCSS3(prop) {
    var prefix = ['-webkit-', '-moz-', ''];
    var root = document.documentElement;

    function camelCase(str) {
      return str.replace(/\-([a-z])/gi, function(match, $1) {
        return $1.toUpperCase();
      });
    }
    for (var i = prefix.length - 1; i >= 0; i--) {
      var css3prop = camelCase(prefix[i] + prop);
      if (css3prop in root.style) {
        return css3prop;
      }
    }
    return false;
  }

  function transitionEnd() {
    var transitions = {
      'transition': 'transitionend',
      'WebkitTransition': 'webkitTransitionEnd',
      'MozTransition': 'mozTransitionEnd'
    };
    var root = document.documentElement;
    for (var name in transitions) {
      if (root.style[name] !== undefined) {
        return transitions[name];
      }
    }
    return false;
  }

  function support3d() {
    if (!window.getComputedStyle) {
      return false;
    }
    var el = document.createElement('div'),
      has3d,
      transform = supportCSS3('transform');

    document.body.insertBefore(el, null);

    el.style[transform] = 'translate3d(1px,1px,1px)';
    has3d = getComputedStyle(el)[transform];

    document.body.removeChild(el);

    return (has3d !== undefined && has3d.length > 0 && has3d !== "none");
  }

  var Touch = {
    hasTouch: !!(("ontouchstart" in window) || window.DocumentTouch && document instanceof DocumentTouch),
    event: function() {
      return {
        start: (this.hasTouch) ? 'touchstart' : 'mousedown',
        move: (this.hasTouch) ? 'touchmove' : 'mousemove',
        end: (this.hasTouch) ? 'touchend' : 'mouseup',
        leave: (this.hasTouch) ? 'touchleave' : 'mouseout'
      };
    }
  };

  function debounce(func, wait, immediate) {
    var timeout;
    return function() {
      var context = this,
        args = arguments;
      var later = function() {
        timeout = null;
        if (!immediate) func.apply(context, args);
      };
      var callNow = immediate && !timeout;
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
      if (callNow) func.apply(context, args);
    };
  }

  var ikSlider = function(el, options) {

    var settings = $.extend({
      touch: true,
      infinite: false,
      autoPlay: true,
      pauseOnHover: true,
      delay: 10000,
      responsive: true,
      controls: true,
      arrows: true,
      caption: true,
      speed: 300,
      cssEase: 'ease-out'
    }, options || {});

    var $container = el;
    var $slider = $container.find('.slider');
    var $arrows = $container.find('.slider__switch');
    var $caption = $slider.find('.slider__caption');
    var $slide = $slider.find('.slider__item');
    var sliderStyle = $slider.get(0).style;
    var slideLen = $slide.length;
    var slideWidth = $container.outerWidth();
    var sliderWidth = slideLen * slideWidth;
    var current = 0;
    var offset = 0;
    var busy = false;
    var touchFlag = false;
    var $controlPanel;
    var $navControl;
    var timer;

    var transformProperty = supportCSS3('transform');
    var transitionProperty = supportCSS3('transition');
    var has3d = support3d();

    function init() {

      // Calculate dimensions
      _dimmensions();

      if (settings.responsive) {
        $(window).on('resize.ikSlider', debounce(_responsive, 50));
      }

      // If caption false, hide caption
      !settings.caption && $caption.attr('disabled', true);

      // Create nav controls
      settings.controls && _controls();

      if (settings.touch) {
        // if the image img tag set attribute graggable false
        $slide.find('img').attr('draggable', false);
        // Binding touch events
        _touchEnable();
      }

      if (settings.autoPlay) {
        _autoPlay();
        if (settings.pauseOnHover) {
          $container.on('mouseenter.ikSlider', function() {
            clearInterval(timer);
          });
          $container.on('mouseleave.ikSlider', _autoPlay);
        }
      }

      if (settings.arrows) {

        // if infinite setting false hide arrows
        !settings.infinite && _stopinfinite('prev');

        $arrows.on('click.ikSlider', function(e) {
          e.preventDefault();
          if (this.getAttribute('data-ikslider-dir') === 'next') {
            show(current + 1);
          } else {
            show(current - 1);
          }
        });
      } else {
        $arrows.attr('disabled', true);
      }
    }

    function _controls() {
      $controlPanel = $('<div/>', {
          'class': 'slider-nav'
        })
        .appendTo($container);

      var links = [];

      for (var i = 0; slideLen > i; i++) {
        var act = (current === i) ? 'is-active' : '';
        links.push('<a class="slider-nav__control ' + act + '" data-ikslider-control="' + i + '"></a>');
      }
      $controlPanel.html(links.join(''));
      $navControl = $controlPanel.find('.slider-nav__control');
      $controlPanel.on('click.ikSlider', '.slider-nav__control', function(e) {
        e.preventDefault();
        if ($(this).hasClass('is-active')) return;
        show(parseInt(this.getAttribute('data-ikslider-control'), 10));
      });
    }

    function _touchEnable() {
      $slider.addClass('has-touch');
      var touchX;
      var touchY;
      var delta;
      var target;

      $slider.on(Touch.event().start + '.ikSlider', function(e) {
        if (touchFlag || busy) return;

        var touch;
        if (e.originalEvent.targetTouches) {
          target = e.originalEvent.targetTouches[0].target;
          touch = e.originalEvent.targetTouches[0];
        } else {
          touch = e.originalEvent;
          e.preventDefault();
        }

        delta = 0;
        touchX = touch.pageX || touch.clientX;
        touchY = touch.pageY || touch.clientY;
        touchFlag = true;

      });
      $slider.on(Touch.event().move + '.ikSlider', function(e) {
        if (!touchFlag) return;

        var touch;
        if (e.originalEvent.targetTouches) {
          if (e.originalEvent.targetTouches.length > 1 || target !== e.originalEvent.targetTouches[0].target) {
            return;
          }
          touch = e.originalEvent.targetTouches[0];
        } else {
          e.preventDefault();
          touch = e.originalEvent;
        }

        var currentX = touch.pageX || touch.clientX;
        var currentY = touch.pageY || touch.clientY;

        if (Math.abs(touchX - currentX) >= Math.abs(touchY - currentY)) {
          delta = touchX - currentX;
          _move(parseInt(offset, 10) - delta);
        }
      });
      $slider.on(Touch.event().end + '.ikSlider', function(e) {
        if (!touchFlag) return;
        var swipeTo = delta < 0 ? current - 1 : current + 1;

        if (Math.abs(delta) < 50 || (!settings.infinite && (swipeTo > slideLen - 1 || swipeTo < 0))) {
          touchFlag = false;
          _move(offset, true);
          return;
        }
        touchFlag = false;
        target = null;
        show(swipeTo);
      });
      $slider.on(Touch.event().leave + '.ikSlider', function() {
        if (touchFlag) {
          _move(offset, true);
          touchFlag = false;
        }
      });
    }

    function show(slide) {
      if (busy) return;
      if (slide === current) return;
      current = (slide > slideLen - 1) ? 0 : slide;
      if (slide < 0) {
        current = slideLen - 1;
      }

      if (!settings.infinite) {

        $arrows.attr('disabled', false);
        if (slide === slideLen - 1) {
          _stopinfinite('next');
        }

        if (current === 0) {
          _stopinfinite('prev');
        }

      }

      offset = -(slideWidth * (current));

      if (settings.controls) {
        $navControl.removeClass('is-active')
          .eq(current)
          .addClass('is-active');
      }
      busy = true;
      _move(offset, true);
    }

    function _move(value, hasAnimate) {

      if (transitionProperty && transformProperty) {

        (hasAnimate) ?
        sliderStyle[transitionProperty] = transformProperty + ' ' + settings.speed + 'ms ' + settings.cssEase: sliderStyle[transitionProperty] = "none";

        (has3d) ?
        sliderStyle[transformProperty] = 'translate3d(' + value + 'px, 0, 0)': sliderStyle[transformProperty] = 'translateX(' + value + 'px)';

        if (hasAnimate) {
          $slider.one(transitionEnd(), function(e) {
            busy = false;
          });
        } else {
          busy = false;
        }
      } else {
        if (hasAnimate) {
          $slider.animate({
            'margin-left': value
          }, settings.speed, 'linear', function() {
            busy = false;
          });
        } else {
          $slider.css('margin-left', value);
          busy = false;
        }

      }
    }

    function _autoPlay() {
      if (timer) clearInterval(timer);
      timer = setInterval(function() {
        if (!touchFlag) {
          show(current + 1);
        }
      }, settings.delay);
    }

    function _stopinfinite(direction) {
      $container.find('.slider__switch--' + direction).attr('disabled', true);
    }

    function _dimmensions() {

      var scrollWidth = window.innerWidth - document.documentElement.clientWidth || 0;
      slideWidth = $container.outerWidth() + scrollWidth;

      sliderWidth = slideLen * slideWidth;
      $slide.css('width', slideWidth);
      sliderStyle['width'] = sliderWidth + 'px';
    }

    function _responsive() {

      if (timer) clearInterval(timer);
      _dimmensions();

      offset = -(slideWidth * current);
      _move(offset);

      _autoPlay();
    }

    function destroy() {
      sliderStyle['width'] = '';
      sliderStyle[transformProperty] = '';
      sliderStyle[transitionProperty] = '';
      $slide.css('width', '');
      if (settings.autoPlay) {
        if (timer) clearInterval(timer);
        $container.off('mouseenter.ikSlider');
        $container.off('mouseleave.ikSlider');
      }
      if (settings.arrows) {
        $arrows.off('click.ikSlider');
        $arrows.attr('disabled', false);
      }
      if (settings.controls) {
        $controlPanel.off('click.ikSlider').remove();
      }

      $caption.attr('disabled', false);

      if (settings.touch) {
        $slider
          .removeClass('has-touch')
          .off(Touch.event().start + '.ikSlider')
          .off(Touch.event().move + '.ikSlider')
          .off(Touch.event().end + '.ikSlider')
          .off(Touch.event().leave + '.ikSlider');
        touchFlag = false;
      }
      if (settings.responsive) {
        $(window).off('resize.ikSlider');
      }
      $container.removeData('ikSlider');
      $container = null;
      $slider = null;
      $arrows = null;
      $caption = null;
      $slide = null;
      $controlPanel = null;
      $navControl = null;
      sliderStyle = null;
      slideLen = null;
      slideWidth = null;
      sliderWidth = null;
      current = null;
      offset = null;
      busy = null;
      timer = null;
      has3d = null;
      busy = false;
      transformProperty = null;
      transitionProperty = null;
    }

    /**
     * @return {methods} [Public slider methods API]
     */
    return {
      init: init,
      show: show,
      destroy: destroy
    };

  };

  $.fn.ikSlider = function(opt) {
    var _this = this;
    this.each(function() {
      var $this = $(this);
      var slider = $this.data('ikSlider');
      var options = typeof opt === 'object' && opt;
      if (!slider && /destroy/.test(opt)) return;
      if (!slider) {
        slider = new ikSlider($this, options);
        $this.data('ikSlider', slider);
        slider.init();
      }
      if (typeof opt === 'string' || typeof opt === 'number' && opt !== 'init') {
        if (typeof opt === 'number') {
          _this = slider.show(opt - 1);
        } else {
          try {
            _this = slider[opt]();
          } catch (e) {
            window.console && console.log('Error:: ikSlider has no method: ' + opt);
          }
        }
      }
      return _this;
    });
  };

})(jQuery);

$('.slider-container').ikSlider({
  speed: 500
});