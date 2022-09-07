(function($) {
  var $ventana = $(window);
  var $cuerpo = $('body');
  var $htmlcuerpo = $('html, body');
  var $transitionTime = 6500;

  $(document).on('click', '#hamburger', function() {
    $('body').addClass('opened-menu');
  });

  $(document).on('click', '#hamburger-r', function() {
    $('body').toggleClass('opened-menu');
  });

  $(document).on('click', '.r-overlay', function() {
    $('body').removeClass('opened-menu');
  });

  $(document).on('click', '.select-chk', function() {
    var $fullSelect = $(this).attr('data-parent');
    if (!$(this).find('span').hasClass('active')) {
      $(this).find('span').addClass('active');
      if (typeof($fullSelect) != 'undefined') {
        $("#" + $fullSelect).find('.select-chk').each(function() {
          $(this).find('span').addClass('active');
        });
      }
    }else{
      $(this).find('span').removeClass('active');
      if (typeof($fullSelect) != 'undefined') {
        $("#" + $fullSelect).find('.select-chk').each(function() {
          $(this).find('span').removeClass('active');
        });
      }
    }
  });

  /** MENÚ RESPONSIVE **/
  $(document).on('click', '#menu-main-resposnive .menu-item-has-children', function(e) {
    //e.preventDefault();
    var $this = $(this);
    if ($this.find(".sub-menu").hasClass('show')) {
      $this.find(".sub-menu").removeClass('show');
      $this.find(".sub-menu").slideUp(350);
      $this.removeClass('active');
    }else{
      $("#menu-main-resposnive .menu-item-has-children .sub-menu").slideUp(350).removeClass('show');
      $("#menu-main-resposnive .menu-item-has-children").removeClass('active');
      $this.find(".sub-menu").addClass('show');
      $this.find(".sub-menu").slideToggle(350);
      $this.addClass('active');
    }
  });

}(jQuery));