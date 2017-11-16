// global utils

$.fn.inlineCountdown = function(options) {
  this.each(function() {
    var $el = $(this);
    var deadline = options.date;

    update();
    $el.animate({ opacity: 1 }, 1000);

    setInterval(update, 1000);

    function update() {
      var frame = getTimeRemaining(deadline);

      ['days', 'hours', 'seconds', 'minutes'].forEach(function(key) {
        $el.find('[data-key="' + key + '"]').text(frame[key]);
      })
    }
  })
}

function iOS() {
  var iDevices = [
    'iPad Simulator',
    'iPhone Simulator',
    'iPod Simulator',
    'iPad',
    'iPhone',
    'iPod'
  ];

  if (!!navigator.platform) {
    while (iDevices.length) {
      if (navigator.platform === iDevices.pop()) {
        return true;
      }
    }
  }

  return false;
}

function getTimeRemaining(endtime) {
  var t = endtime - new Date().getTime();
  var seconds = Math.floor((t / 1000) % 60);
  var minutes = Math.floor((t / 1000 / 60) % 60);
  var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
  var days = Math.floor(t / (1000 * 60 * 60 * 24));

  return {
    'total': t,
    'days': days,
    'hours': hours,
    'minutes': minutes,
    'seconds': seconds
  };
}

function spin($el, to) {
  setTimeout(function() {
    if (+$el.text() != to) {
      $el.text(+$el.text() + 1);
      spin($el, to);
    }
  }, 20)
}

(function() {
  var $docEl = $('html, body'),
    $wrap = $('.content'),
    scrollTop;

  $.lockBody = function() {
    if(window.pageYOffset) {
      scrollTop = window.pageYOffset;

      $wrap.css({
        top: - (scrollTop)
      });
    }

    $docEl.css({
      height: "100%",
      overflow: "hidden"
    });
  }

  $.unlockBody = function() {
    $docEl.css({
      height: "",
      overflow: ""
    });

    $wrap.css({
      top: ''
    });

    window.scrollTo(0, scrollTop);
    window.setTimeout(function () {
      scrollTop = null;
    }, 0);
  }
})();
