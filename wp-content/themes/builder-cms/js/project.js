(function ($) {

  /**
  *	CAMBIANDO EL PLACEHOLDER DEL INPUT DEL AUTOCOMPLETADOR DE SER NECESARIO (activarlo cuando se use)
  *	=======================================================================================================
  **/
  //$("#flex_idx_single_autocomplete_input").attr('placeholder','Begin your search here');

  /**
  *	BOTON PARA VIAJAR A LA SIGUIENTE SECCION
  *	=======================================================================================================
  *	Ejemplo: <button class="ms-next-step" data-step="#seccion-2">View next section</button>
  **/
  var $btnNextSection = $(".ms-next-step");
  if ($btnNextSection.length) {
    $btnNextSection.click(function () {
      //Se calcula la altura en la que se encuentra el elmeneto y se realiza un resta para una mejor posicion
      var $nextSectionPosition = ($($(this).attr('data-step')).offset().top) - 80;
      //Se realiza la animacion del scroll hacia la posicion calculada
      $('html, body').animate({ scrollTop: $nextSectionPosition }, 800);
    });
  }

  /**
  *	BOTON PARA REALIZAR EL SCROLL HACIA ARRIBA
  *	=======================================================================================================
  *	Ejemplo: <button id="page-scroll-up">Up</button>
  **/
  var $btnScrollUp = $('#page-scroll-up');

  //Consultamos la posicion del boton para visualizarlo o no
  $(window).scroll(function () {
    if ($(window).scrollTop() > 300) {
      $btnScrollUp.addClass('show');
    } else {
      $btnScrollUp.removeClass('show');
    }
  });

  //Accion de scroll hacia la parte superior del site
  $btnScrollUp.on('click', function (e) {
    e.preventDefault();
    $('html, body').animate({ scrollTop: 0 }, '300');
  });

  /**
  *	GENERANDO SLIDER DE TESTIMONILES
  *	=======================================================================================================
  **/
  var $testimonialSlider = $("#testimonial-slider");
  if ($testimonialSlider.length) {
    $testimonialSlider.greatSlider({
      type: 'swipe',
      navSpeed: 1000,
      lazyLoad: true,
      nav: false,
      bullets: true,
      items: 1,
      autoDestroy: true,
      autoHeight: true,
      startPosition: 1,
      layout: {
        bulletDefaultStyles: false,
        wrapperBulletsClass: 'clidxboost-gs-wrapper-bullets',
        resizeClass: 'ms-resize',
        arrowPrevContent: 'Prev',
        arrowNextContent: 'Next',
      },
      onInited: function () {
        bulletSlider($testimonialSlider);
      },
      onResized: function () {
        bulletSlider($testimonialSlider);
      }
    });
  }

  /**
  *	GENERANDO SLIDER DE AREAS
  *	=======================================================================================================
  **/
  var $condoAreaSlider = $("#ms-condo-slider");
  if ($condoAreaSlider.length) {
    $condoAreaSlider.greatSlider({
      type: 'swipe',
      navSpeed: 1000,
      lazyLoad: true,
      nav: false,
      bullets: true,
      items: 1,
      autoDestroy: true,
      layout: {
        bulletDefaultStyles: false,
        wrapperBulletsClass: 'clidxboost-gs-wrapper-bullets',
        resizeClass: 'ms-resize',
        arrowPrevContent: 'Prev',
        arrowNextContent: 'Next',
      },
      breakPoints: {
        768: {
          items: 2,
          nav: true,
          bullets: false
        },
        991: {
          items: 3
        },
        1024: {
          items: 4
        }
      },
      onInited: function () {
        bulletSlider($condoAreaSlider);
      },
      onResized: function () {
        bulletSlider($condoAreaSlider);
        imageSlider($condoAreaSlider);
      }
    });
  }

  /**
  *	ACTIVANDO EL FORMATO #2 PARA EL HEADER DE SER NECESARIO
  *	=======================================================================================================
  * Agregamos una clase "headerColor" al header cuando hacemos scroll y superamos
  * la altura en que se encuntra el mismo, mediante esta clase podemos dar otro formato
  * al header de ser necesario
  * ------------------------------------------------------------------------------
  * ms-float-header: Clase que debemos incluir en el header
  * headerColor: Clase que activa el nuevo formato
  **/
  loadHeaderColor(".ms-float-header");
  function loadHeaderColor(element) {
    var headerTransparent = $(element);
    if (headerTransparent.length) {
      if ($("body").hasClass("ms-float-header")) {
        var headerHeight = $("#header").outerHeight();
        $(window).scroll(function () {
          if ($(window).scrollTop() > headerHeight) {
            headerTransparent.addClass('headerColor');
          } else {
            headerTransparent.removeClass('headerColor');
          }
        });
      }
    }
  }

  /**
  *	ACTIVANDO ACORDEON
  *	=======================================================================================================
  *	accordion: Clase que activa la funcionalidad de acordeon
  * active: Clase que funciona con interruptor del acordeon
  **/
  var acc = document.getElementsByClassName("accordion");
  var i;
  for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function () {
      this.classList.toggle("active");
    });
  }

  /**
  *	CARGA POR DEMANDA DEL SITE
  *	=======================================================================================================
  *	Mediante este JS podemos realizar la carga por demanda de los diferentes elementos que se
  * presentan en el site (images/videos/animaciones/mapas)
  * active: Clase que funciona con interruptor del acordeon
  * --------------------------------------------------------
  * ms-animate: Clase que siempre debe estar presente para iniciar la referencia, adicionalmente
  * la seccion que contenga esta clase debe ir acompañada de un id, ejemplo:
  * <section class="ms-animate" id="welcome"></section>
  * los elementos que cargan por demanda deben de tener los siguientes atributos:
  * data-img: atributo que contener la url del elemento final a cargar (imagen,video,etc)
  * data-real-type: tipo de elemento a cargar podemos tener imagen,video,youtube,
  *	data-title: titulo que acompaña a los videos ejemplo <video title="Casas en miami">
  *	mapa(acompañado de data-lat y data-lng) y agentVideo el cual es espeacial
  * Ejemplo:
  * <section class="ms-animate" id="welcome">
  *		<img data-img="urldelaimagen" data-type="image" src="urldeimagentemporal">
  *		<div class="wrap-video" data-img="urldevideo" data-type="video" data-title="Casas en miami"></div>
  *		<div id="googleMap" data-real-type="mapa" data-img="googleMap" data-lat="43.542194" data-lng="-5.676875"></div>
  *	</section>
  **/
  function chekSectionAnimate() {
    var elementSection = $('.ms-animate');
    if (elementSection.length) {
      elementSection.each(function (e) {
        var sectionId = $("#" + $(this).attr('id'));
        if (is_in_view(sectionId)) {
          var item = 0, el = $(this);
          sectionId.addClass('ms-loaded-animate');
          sectionId.find('[data-img]').each(function (e) {
            if ($(this).attr('data-real-type') == "image") {
              if (is_in_view($(this))) {
                $(this).attr('src', $(this).attr('data-img')).on('load', function () {
                  $(this).removeAttr('data-img').addClass('ms-loaded');
                });
                item++;
              }

            } else if ($(this).attr('data-real-type') == "agentVideo") {
              if (is_in_view($(this))) {

                let videoWrapper = 'player';
                if ($(this).attr('data-video-wrapper')) {
                  videoWrapper = $(this).attr('data-video-wrapper');
                }

                $(this).html(`<div id="${videoWrapper}"></div>`);
                let videoUrl = $(this).attr('data-img');
                let videoTitle = $(this).attr('data-title');
                let videoAutoplay = $(this).attr('data-video-autoplay');
                let videoMute = $(this).attr('data-video-mute');

                // console.log(videoAutoplay);

                if (videoUrl !== undefined) {
                  let videoStr = videoUrl.toString();

                  let { id, service } = getVideoId(videoStr);

                  if (service == 'youtube') {
                    let autoplay = '1', mute = '1';
                    let playerVideo = ',e.target.playVideo()';
                    if (!videoAutoplay || videoAutoplay == 'false') {
                      autoplay = '0';
                      playerVideo = '';
                    }

                    if (!videoMute || videoMute == 'false') {
                      mute = '0';
                    }

                    if ($(this).attr('data-video-wrapper')) {
                      var $srcVideo = `https://www.youtube.com/embed/${id}?autoplay=${videoAutoplay};rel=0&showinfo=0&mute=${videoMute}`;
                      $(this).html(`<iframe allow="autoplay; encrypted-media" src="${$srcVideo}" title="${videoTitle}" frameborder="0" allowfullscreen></iframe>`);
                    } else {
                      $("body").append(`<script>var tag=document.createElement("script");tag.src="https://www.youtube.com/iframe_api";var player,firstScriptTag=document.getElementsByTagName("script")[0];function onYouTubeIframeAPIReady(){player=new YT.Player("${videoWrapper}",{width:"100%",videoId:"${id}",host:"${window.location.protocol}//www.youtube.com",playerVars:{autoplay:${autoplay},playsinline:1,loop:1,rel:0,showinfo:0,origin:'${window.location.origin}'},events:{onReady:onPlayerReady,onStateChange:onPlayerStateChange}})}function onPlayerReady(e){e.target.mute()${playerVideo}}function onPlayerStateChange(e){e.data==YT.PlayerState.ENDED&&(player.seekTo(0),player.playVideo())}function stopVideo(){player.stopVideo()}firstScriptTag.parentNode.insertBefore(tag,firstScriptTag);</script>`);
                    }
                  } else if (service == 'vimeo') {
                    let autoplay = '1', mute = '1';
                    if (!videoAutoplay || videoAutoplay == 'false') {
                      autoplay = '0';
                    }
                    if (!videoMute || videoMute == 'false') {
                      mute = '0';
                    }
                    $(this).html(`<iframe allow="autoplay; encrypted-media" src="https://player.vimeo.com/video/${id}?autoplay=${autoplay}&amp;muted=1&loop=1" frameborder="0" allowfullscreen title="${videoTitle}"></iframe>`);
                  } else {
                    let autoplay = 'autoplay', mute = 'muted';
                    if (!videoAutoplay || videoAutoplay == 'false') {
                      autoplay = '';
                    }

                    if (!videoMute || videoMute == 'false') {
                      mute = '';
                    }
                    // $(this).html(`<video src="${videoUrl}" title="${videoTitle}" tab-index="-1" preload="none" ${autoplay} controls loop muted playsinline>`);
                    $(this).html(`<video src="${videoUrl}" ${mute} ${autoplay} controls loop></video>`)
                  }
                }

                $(this).removeAttr('data-img');
                el.addClass('ms-loaded-animate').removeClass('ms-animate');
                item++;
              }

            } else if ($(this).attr('data-real-type') == "video") {
              if (is_in_view($(this))) {
                var videoId = $(this).attr('id');
                var urlVideo = $(this).attr('data-img');
                var titleVideo = $(this).attr('data-title');
                $(this).html('<video id="idx-video-' + videoId + '" src="' + urlVideo + '" title="' + titleVideo + '" preload="none" loop muted playsinline></video>');
                $(this).removeAttr('data-img');
                setTimeout(function () {
                  $('#idx-video-' + videoId)[0].play();
                }, 1000);
                item++;
              }
            } else if ($(this).attr('data-real-type') == "youtube") {
              if (is_in_view($(this))) {
                var urlVideo = $(this).attr('data-img');
                var titleVideo = $(this).attr('data-title');
                $(this).html("<iframe allowfullscreen='' src='" + urlVideo + "' title='" + titleVideo + "' frameborder='0' allowfullscreen></iframe>");
                $(this).removeAttr('data-img');
                item++;
              }
            } else if ($(this).attr('data-real-type') == "mapa") {
              if (is_in_view($(this))) {
                var mapa = $(this).attr('data-img');
                var lat = $(this).attr('data-lat');
                var lng = $(this).attr('data-lng');

                if (mapa !== undefined && lat !== undefined && lng !== undefined) {

                  var myLatLng = {
                    lat: parseFloat(lat),
                    lng: parseFloat(lng)
                  };

                  var newMap = new google.maps.Map(document.getElementById(mapa), {
                    zoom: 16,
                    center: myLatLng,
                    mapTypeControl: false,
                    fullscreenControl: false
                  });

                  var marker = new google.maps.Marker({
                    position: myLatLng,
                    map: newMap
                  });

                  $(this).removeAttr('data-img');
                }
                item++;
              }
            }
          });
          if (item == sectionId.find('[data-img]').size()) {
            el.addClass('ms-loaded-animate').removeClass('ms-animate');
          }
        }
      });
    }
  }

  function is_in_view(elem) {
    var docViewTop = 0;
    var docViewBottom = 0;
    var elemTop = 0;
    var elemBottom = 0;
    docViewTop = $(window).scrollTop();
    docViewBottom = docViewTop + $(window).height();
    elemTop = $(elem).offset().top;
    elemBottom = elemTop + $(elem).height();
    return ((elemBottom > docViewTop) && (elemTop < docViewBottom));
  }

  $(window).load(function () { chekSectionAnimate(); });
  $(window).scroll(function () { chekSectionAnimate(); });

  /**
  *	ACTIVANDO EL FORMULARIO DEL FOOTER COMO MODAL
  *	=======================================================================================================
  * activamos una clase en el contenedor del formulario para presentarlo como modal
  * ms-show-form: clase que activa el modo modal del formulario
  **/
  $(document).on('click', '.ms-show-form', function (e) {
    e.preventDefault();
    $('body').addClass('ms-active-form');
  });
  // Boton que cierra el modal
  $(document).on('click', '.ms-close-modal', function () {
    $('body').removeClass('ms-active-form');
  });
  $(document).on('click', '.ms-active-form .sweet-alert button.confirm', function () {
    $('body').removeClass('ms-active-form');
  });

  /**
  *	ACTIVANDO EL MODAL CON VIDEO
  *	=======================================================================================================
  * creaIframeVideo es una funcion que genera el video a mostrar (Vimeo, youtube o html)
  * vd-play: clase de referencia para activar la accion del modal
  * data-video: atributo que contiene la url absoluta del video a mostrar
  * data-title: titulo que acompaña al video
  * Ejemplo: <button class="vd-play" data-video="urldevideo" title="Casas en miami"></button>
  **/
  $(document).on('click', '.vd-play', function () {

    var $iframeVideo = creaIframeVideo($(this));
    if ($iframeVideo) {
      $("body").append('<div class="video-inside"><div class="iframe">' + $iframeVideo + '</div><button class="close-vi" aria-label="Close"><span class="op-icon-close">x</span></button><div class="bg-close"></div></div>');
      setTimeout(function () {
        $("body").find('.video-inside').addClass('ms-show-video');
      }, 500)
    }
  });
  //Boton que cierra el modal
  $(document).on('click', '.close-vi, .bg-close', function () {
    var $elParent = $(this).parent();
    $("body").find('.video-inside').removeClass('ms-show-video');
    setTimeout(function () {
      $elParent.remove();
    }, 1200)
  });

  /**
  *	FUNCION PARA GENERAR LOS VIDEOS
  *	=======================================================================================================
  * creaIframeVideo es una funcion que genera el video a mostrar (Vimeo, youtube o html)
  **/
  var $document = $(document);
  function creaIframeVideo(elBoton) {

    var $urlVideo = elBoton.attr('data-video');
    var $titleVideo = elBoton.attr('data-video');
    if ($urlVideo !== undefined) {
      var $urlVideo = $urlVideo.toString();
      if ($urlVideo.indexOf('youtube') !== -1) {
        var et = $urlVideo.lastIndexOf('&')
        if (et !== -1) {
          $urlVideo = $urlVideo.substring(0, et)
        }
        var embed = $urlVideo.indexOf('embed');
        if (embed !== -1) {
          $urlVideo = 'https://www.youtube.com/watch?v=' + $urlVideo.substring(embed + 6, embed + 17);
        }
        var $srcVideo = 'https://www.youtube.com/embed/' + $urlVideo.substring($urlVideo.length - 11, $urlVideo.length) + '?autoplay=1;rel=0&showinfo=0';
        return '<iframe allow="autoplay; encrypted-media" src="' + $srcVideo + '" title="' + $titleVideo + '" frameborder="0" allowfullscreen></iframe>';

      } else if ($urlVideo.indexOf('vimeo') !== -1) {
        var $srcVideo = 'https://player.vimeo.com/video/' + $urlVideo.substring(($urlVideo.indexOf('.com') + 5), $urlVideo.length).replace('/', '');
        return '<iframe allow="autoplay; encrypted-media" src="' + $srcVideo + '?autoplay=1" title="' + $titleVideo + '" frameborder="0" allowfullscreen></iframe>';
      } else {
        return '<video src="' + $urlVideo + '" title="' + $titleVideo + '" autoplay playsinline>';
      }
    }
  }

  /**
  *	ANIMACION DEL TEXTO EN EL HOME PAGE (TIPO CARRUSEL)
  *	=======================================================================================================
  **/
  var wrapQuotes = $("#ms-change-text");
  if (wrapQuotes.length) {
    var quotes = $(".quotes");
    var quoteIndex = -1;
    showNextQuote();
  }

  function showNextQuote() {
    ++quoteIndex;
    $(".quotes").removeClass("active active_span");
    quotes.eq(quoteIndex % quotes.length)
      .addClass("active")
      .fadeIn(300, function () {
        $(this).addClass("active_span")
      })
      .delay(4000)
      .fadeOut(900, showNextQuote);
  }

  /**
  *	ASIGNACION DE TEXTO EN LOS BULLETS
  *	=======================================================================================================
  **/
  function bulletSlider(element) {
    var $a = 0;
    var $bulletBtn = element.find(".gs-bullet");
    if ($bulletBtn.length) {
      $bulletBtn.each(function () {
        $a += 1;
        var $newText = "View Slide " + $a;
        $(this).attr("aria-label", $newText);
      });
    }
  }

  /**
  *	REASIGNACION DE LA IMAGEN EN LOS SLIDERS QUE CARGAN POR DEMANDA
  *	=======================================================================================================
  * este codigo soluciona el error que se genera al realizar un redimensionamiento del site y hacia que las imagenes se oculten en el slider que carga por demanda
  **/
  function imageSlider(element) {
    var $temporalImage = element.find("img");
    if ($temporalImage.length) {
      $temporalImage.each(function () {
        var urlIamge = $(this).attr("data-img");
        $(this).attr("src", urlIamge);
        $(this).removeClass();
      });
    }
  }

}(jQuery));
