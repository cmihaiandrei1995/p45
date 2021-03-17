var myMainSwiper = undefined;
var myNoiOferteSwiper = undefined;
var myCircuitSwiper = undefined;
var myConsultantiSwiper = undefined;
var myItemsItemSwiper = undefined;
var myItemMainSwiper = undefined;
var myItemThumbsSwiper = undefined;
var myAirplaneSwiper = undefined;

function resizeWidth() {
  var existingWidth = $(document).data('resize-width');
  var newWidth = $(document).width();
  if (existingWidth != newWidth) {
    check_resize();
    $(document).data('resize-width', newWidth);
  };
};

$( window ).resize(resizeWidth);

$(function() {
  $(document).data('resize-width', $(document).width());

  check_resize();

  swiper_sliders_init();

  ie10_viewport_bug_hack();

  main_filters();
  main_filters_select2();

  filters_select2();

  chartere_list_filters();

  chartere_item_filters();

  circuite_list_filters();

  circuite_item_filters();

  t_individual_list_filters();

  t_individual_item_filters();

  t_intern_list_filters();

  t_intern_item_filters();

  //IE object-fit css rull hack
  objectFitImages('img.object-fit');

  aside_price_slider();

  item_tabs();

  cart();

  puntea__zoom__image();

  bilete();

  $('[data-toggle="tooltip"]').tooltip();

  $('body').tooltip({
      selector: '[data-toggle="tooltip"]'
  });

  $(".datepicker").datepicker({
  	  minDate: "+1d",
      //changeMonth: true,
      numberOfMonths: 1,
      dateFormat: 'dd.mm.yy',
      firstDay: 1,
  });

  //enable link click
  $('.navbar-desktop .dropdown-toggle').addClass('disabled');
  //show dropdown on hover
  $('.navbar-desktop .dropdown').hover(function() {
    $(this).toggleClass('open', true);
  },
  function() {
    $(this).toggleClass('open', false);
  });

  //countdown clock
  $('.clock_counter').each(function(){
  	$days = parseInt($(this).find('.days').html());
  	$hours = parseInt($(this).find('.hours').html());
  	$minutes = parseInt($(this).find('.minutes').html());
  	$seconds = parseInt($(this).find('.seconds').html());

  	var deadline = new Date(Date.parse(new Date()) + $days * 24 * 60 * 60 * 1000 + $hours * 60 * 60 * 1000 + $minutes * 60 * 1000 + $seconds * 1000);
    initializeClock($(this), deadline);
  });

  //keep the dropdown when a link is clicked until page refresh
  $('.navbar-nav-paralela45 li.dropdown ul.dropdown-menu > li > a').on('click', function(e){
    e.stopPropagation();
  });


  //rating stars
  $('.testimonial span.stars').stars();
  $('.testimonial-rating span.stars').stars();

});

function check_resize() {
  swiper_sliders_destroy();
  swiper_sliders_init();

  if($(window).width()<992) {
    $('.aside-filters__sub').attr('data-toggle','collapse');
    $('.aside-filters__sub').attr('aria-expanded', 'false');
    $('.aside-filters__sub').toggleClass('collapsed',true);
    $('.aside-filters__item .collapse').toggleClass('in',false);
  }
  else {
    $('.aside-filters__sub').attr('data-toggle','');
    $('.aside-filters__sub').attr('aria-expanded', 'true');
    $('.aside-filters__sub').toggleClass('collapsed',false);
    $('.aside-filters__item .collapse').toggleClass('in',true);
  }

  if($(window).width()>767) {
    //show dropdown on hover
    $('.user-loggedin .dropdown-toggle').addClass('disabled');
    $('.user-loggedin').hover(function() {
      $(this).toggleClass('open', true);
    },
    function() {
      $(this).toggleClass('open', false);
    });
  }
  else {
    //show dropdown on click
    $('.user-loggedin .dropdown-toggle').removeClass('disabled');
    $('.user-loggedin').off( "mouseenter mouseleave" )
  }

  var item_480_btn = $('#item__480__btn');
  var item_480_block = $('#item__480__block');
  var item_480_height = item_480_block.height();

  if($(window).width()<=480) {
    item_480_btn.css({
      'position' : 'absolute',
      'bottom' : -item_480_height - 80,
      'left' : '15px',
      'right' : '15px',
      'width' : 'auto',
    });

    item_480_block.css('margin-bottom','70px');
  }
  else {
    item_480_btn.css({
      'position' : 'relative',
      'bottom' : 'auto',
      'left' : 'auto',
      'right' : 'auto',
      'width' : '100%',
    });

    item_480_block.css('margin-bottom','auto');
  }
}

function swiper_sliders_init() {
    // slidere noi
    var swiper = new Swiper('.swiper-top-destinations', {
          slidesPerView: 4,
          spaceBetween: 30,
          // slidesPerGroup: 4,
          breakpoints: {
            1199: {
                slidesPerView: 3,
              spaceBetween: 40,
            },
            768: {
              slidesPerView: 2,
              spaceBetween: 20,
            },
            480: {
              slidesPerView: 1,
              spaceBetween: 10,
            }
        },
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
    });

    var swiper = new Swiper('.swiper-container-about-renew', {
          slidesPerView: 3,
          spaceBetween: 10,
          breakpoints: {
            1199: {
                slidesPerView: 3,
            },
            768: {
              slidesPerView: 2,
            },
            480: {
              slidesPerView: 1,
            }
        },
        nextButton: '.about-renew-swiper-wrapper .swiper-button-next',
        prevButton: '.about-renew-swiper-wrapper .swiper-button-prev',
    });

    var swiper = new Swiper('.swiper-container-about-gallery-renew', {
          slidesPerView: 1,
          spaceBetween: 10,
          nextButton: '.about-gallery-renew-swiper-wrapper .swiper-button-next',
          prevButton: '.about-gallery-renew-swiper-wrapper .swiper-button-prev',
    });

    var swiper = new Swiper('.swiper-container-experiences', {
        loop: true,
        paginationClickable: true,
        nextButton: '.swiper-container-experiences-wrapper .swiper-button-next',
        prevButton: '.swiper-container-experiences-wrapper .swiper-button-prev',
        autoplay: '7000',
        pagination: '.swiper-container-experiences .swiper-pagination'
    });
    // end slidere noi

  var myMainSwiper = new Swiper ('.swiper-container.swiper-main', {
    loop: true,
    paginationClickable: true,
    nextButton: '.swiper-button-next',
    prevButton: '.swiper-button-prev',
    autoplay: '7000'
  });

  var myAirplaneSwiper = new Swiper ('.swiper-container.swiper-airplane', {
    slidesPerView: 6,
    loop: true,
    autoplay: 4000,
    autoplayDisableOnInteraction: false,
    centeredSlides: false,
    breakpoints: {
      1199: {
        slidesPerView: 5,
      },
      991: {
        slidesPerView: 4,
      },
      640: {
        slidesPerView: 3,
      },
      480: {
        slidesPerView: 2,
      },
      400: {
        slidesPerView: 1,
      },
    }
  });

  var myNoiOferteSwiper = new Swiper ('.swiper-noi-oferte > .swiper-container', {
    slidesPerView: 3,
    loop: true,
    spaceBetween: 30,
    autoplay: 4000,
    paginationClickable: true,
    nextButton: '.swiper-noi-oferte > .swiper-button-next',
    prevButton: '.swiper-noi-oferte > .swiper-button-prev',
    breakpoints: {
      767: {
        slidesPerView: 2,
        spaceBetween: 30,
      },
      640: {
        slidesPerView: 1,
        spaceBetween: 0,
      },
    }
  });

  var myNoiOferteSwiper = new Swiper ('.swiper-oferte-recomandate > .swiper-container', {
    slidesPerView: 4,
    loop: true,
    spaceBetween: 30,
    autoplay: 4000,
    paginationClickable: true,
    nextButton: '.swiper-noi-oferte > .swiper-button-next',
    prevButton: '.swiper-noi-oferte > .swiper-button-prev',
    breakpoints: {
        1199: {
          slidesPerView: 3,
          spaceBetween: 30,
        },
        991: {
          slidesPerView: 2,
          spaceBetween: 30,
        },
      580: {
        slidesPerView: 1,
        spaceBetween: 0,
      },
    }
  });


  var myCircuitSwiper = '';
  $('.swiper-container.swiper-circuit').each(function(){
     myCircuitSwiper = new Swiper($(this), {
        slidesPerView: 1,
        pagination: $(this).find('.swiper-pagination'),
        nextButton: $(this).find('.swiper-button-next'),
        prevButton: $(this).find('.swiper-button-prev'),
        paginationClickable: true,
    	autoplay: 10000,
    	 preloadImages: false,
          lazyLoading: true,
     });
  });



  var myConsultantiSwiper = new Swiper ('.swiper-container.swiper-consultanti', {
    loop: true,
    pagination: '.swiper-pagination',
    paginationClickable: true,
  });

  // var myItemsItemSwiper = new Swiper ('.swiper-container.swiper-items__item', {
    // loop: true,
    // nextButton: '.swiper-button-next',
    // prevButton: '.swiper-button-prev',
    // paginationClickable: true,
  // });

  $('.swiper-container.swiper-items__item').each(function(){
    new Swiper($(this), {

        paginationClickable: $(this).find('.swiper-pagination'),
        nextButton: $(this).find('.swiper-button-next'),
        prevButton: $(this).find('.swiper-button-prev'),
        preloadImages: false,
        lazyLoading: true,
        //loop: true
    });
	});
}

function initAgenciesMap( obj, items) {
	var map = new google.maps.Map(document.getElementById(obj), {
		mapTypeControl: false,
		streetViewControl: false,
        //zoom: 13,
		//scrollwheel: false,
		zoom: items.length <= 1 ? 11 : '',
		////center: {lat: x, lng: y},
		styles: [{
	        featureType: "poi",
	        elementType: "labels",
	        stylers: [
	              { visibility: "off" }
	        ]
	    }]
	});

	var markers = [];
	var bounds = new google.maps.LatLngBounds();

	for (var i = 0; i < items.length; i++) {
		var item = items[i];

		var marker = new google.maps.Marker({
			map: map,
			draggable: false,
			//animation: google.maps.Animation.DROP,
			position: {lat: item[1] , lng: item[2]},
			title: item[0],
			icon: item[3],
		});
		//console.log(items.length);

		bounds.extend(marker.position);

		var contentString = '';
			if(item[6] != ''){
				contentString += '<div style="float:left; margin-right:10px"><a href="' + item[5] + '"><img src="' + item[6] + '" style="max-height: 140px; max-width: 140px; width: auto;"></a></div>';
			}

			contentString +=
		 		'<a href="' + item[5] + '" style="font-size:14px;"><b>' + item[0] + '</b></a><br>' +
		 		'<p style="margin: 5px 0 0 0">' +
		 			item[4] +
		 			'<a href="' + item[5] + '" title="' + item[0] + '">Detalii</a>' +
		 		'</p>';

      	bindInfoWindow(marker, map, infoWindow, contentString);

      	markers.push(marker);

	}

	map.fitBounds(bounds);

    var listener = google.maps.event.addListener(map, "idle", function() {
        if (map.getZoom() > 15) map.setZoom(15);
        google.maps.event.removeListener(listener);
    });
    /*
	google.maps.event.addListenerOnce(map, 'bounds_changed', function(event) {
		if (this.getZoom() > 13) {
            this.setZoom(13);
		}
	});
    */
	//var markerCluster = new MarkerClusterer(map, markers, {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
}


function initMap(x, y, title, url, img) {

	var myLatLng = {lat: x, lng: y};

    var map = new google.maps.Map(document.getElementById('map_modal'), {
		mapTypeControl: false,
		streetViewControl: false,
      	zoom: 15,
      	center: myLatLng
    });

    var marker = new google.maps.Marker({
      position: myLatLng,
      map: map,
      title: title
    });

    var contentString = '';
	if(img != ''){
		contentString += '<div style="float:left; margin-right:10px"><a href="' + url + '"><img src="' + img + '" style="max-height: 140px; max-width: 140px; width: auto;"></a></div>';
	}

	contentString +=
 		'<a href="' + url + '" style="font-size:14px;"><b>' + title + '</b></a><br>' +
 		'<p style="margin: 5px 0 0 0"><a href="' + url + '" title="' + title + '">Detalii</a>' +
 		'</p>';

	 	bindInfoWindow(marker, map, infoWindow, contentString);
}

function bindInfoWindow(marker, map, infowindow, description) {
    marker.addListener('click', function() {

        infoWindow.setContent(description);
        infoWindow.open(map, this);

        $('.route-container .route a').each(function() {

  	 		if($(this).text() == $('.map-pin-desc .title').text() ){
  	 			$('.route').removeClass('red');
  	 			$(this).closest('.route').addClass('red');
  	 		}

  	 	});

  	 	if($('#style-4').length){
		    $('#style-4').animate({
		        scrollTop: $('.red').position().top
		    }, 1000);
	    }

    });

    marker.addListener('closeclick', function() {
    	//console.log('ceva');
		$('.route').removeClass('red');
    });

}

var infoWindow = new google.maps.InfoWindow({
    content: "",
    maxWidth: 450
});

function swiper_item(elem, small) {
  var noSlides = elem;
  var noSlidesPerView = noSlides;

  var myItemMainSwiper = new Swiper('.swiper-container.swiper-item__main', {
      nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        spaceBetween: 10,
        loop:true,
        loopedSlides: $(".swiper-container.swiper-item__main .swiper-slide").length,
  });

  //small is false, used in main pages
  if(small !== true) {
    if(noSlides > 7) noSlidesPerView = 7;

    if($(window).width()>=768 && $(window).width()<992) {
      $('.swiper-item__thumbs > .swiper-container').css('width', noSlidesPerView * 93.5); //img width 88.5px, spaceBetween 5px
    }
    else if($(window).width()>=992 && $(window).width()<1200) {
      $('.swiper-item__thumbs > .swiper-container').css('width', noSlidesPerView * 90.5); //img width 85.5px, spaceBetween 5px
    }
    else if($(window).width()>=1200) {
      $('.swiper-item__thumbs > .swiper-container').css('width', noSlidesPerView * 112); //img width 107px, spaceBetween 5px
    }
  }
  //small is true, used on contact-agentie.php page
  else {
    if(noSlides > 4) noSlidesPerView = 4;

    if($(window).width()>=768 && $(window).width()<992) {
      $('.swiper-item__thumbs > .swiper-container').css('width', noSlidesPerView * 86.5); //img width 81.5px, spaceBetween 5px
    }
    else if($(window).width()>=992 && $(window).width()<1200) {
      $('.swiper-item__thumbs > .swiper-container').css('width', noSlidesPerView * 83.5); //img width 78.5px, spaceBetween 5px
    }
    else if($(window).width()>=1200) {
      $('.swiper-item__thumbs > .swiper-container').css('width', noSlidesPerView * 102.5); //img width 97.5px, spaceBetween 5px
    }
  }

  var myItemThumbsSwiper = new Swiper('.swiper-item__thumbs .swiper-container', {
      	spaceBetween: 10,
        touchRatio: 0.2,
        slideToClickedSlide: true,
        nextButton: '.swiper-item__thumbs .swiper-button-next',
        prevButton: '.swiper-item__thumbs .swiper-button-prev',
        centeredSlides: true,
        slidesPerView: 7,
        loop:true,
        loopedSlides: $(".swiper-item__thumbs  .swiper-container .swiper-slide").length,
  });
  myItemMainSwiper.params.control = myItemThumbsSwiper;
  myItemThumbsSwiper.params.control = myItemMainSwiper;
}

function swiper_sliders_destroy() {
  if (typeof myNoiOferteSwiper !== 'undefined' && myNoiOferteSwiper.container.length) {
    myNoiOferteSwiper.destroy(true,true);
  }
}

function ie10_viewport_bug_hack() {
  /*!
   * IE10 viewport hack for Surface/desktop Windows 8 bug
   * Copyright 2014-2015 Twitter, Inc.
   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
   */

  // See the Getting Started docs for more information:
  // http://getbootstrap.com/getting-started/#support-ie10-width
  (function () {
    'use strict';

    if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
      var msViewportStyle = document.createElement('style')
      msViewportStyle.appendChild(
        document.createTextNode(
          '@-ms-viewport{width:auto!important}'
        )
      )
      document.querySelector('head').appendChild(msViewportStyle)
    }

  })();
}

function main_filters() {
	var txt = $('#dropdown-main-filters-mobile li.active a').html();
	$('#main-filters__btn').html('<span class="main-filters__btn__text">'+txt+'</span> <span class="main-filters__btn__sprite"><i class="sprite sprite-panel-down position-center"></i></span>');

  $('#dropdown-main-filters-mobile > li > a').click(function(){
    var text = $(this).html();
    var target = $(this).attr('href');

    $('#main-filters__btn + .dropdown-menu > li').toggleClass('active',false);
    $(this).parent().siblings().removeClass('active');
    $('#main-filters__btn').html('<span class="main-filters__btn__text">'+text+'</span> <span class="main-filters__btn__sprite"><i class="sprite sprite-panel-down position-center"></i></span>');

    $('#main-tabs > li').toggleClass('active',false);
    $('#main-tabs > li > a[href="'+target+'"]').parent().toggleClass('active',true);
  });

  $('#main-tabs > li > a').click(function(){
    var text = $(this).html();
    var target = $(this).attr('href');

    $('#dropdown-main-filters-mobile > li').toggleClass('active',false);
    $('#dropdown-main-filters-mobile > li > a[href="'+target+'"]').parent().toggleClass('active',true);
    $('#dropdown-main-filters-mobile > li > a[href="'+target+'"]').parent().siblings.removeClass('active');
    $('#main-filters__btn').html('<span class="main-filters__btn__text">'+text+'</span> <span class="main-filters__btn__sprite"><i class="sprite sprite-panel-down position-center"></i></span>');
  });



}

function main_filters_select2() {
  $('#chartere-tara').select2({
    placeholder: "- Alege tara -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#chartere-destinatia').select2({
    placeholder: "- Alege destinatia -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#chartere-oras-plecare').select2({
    placeholder: "- Alege orasul -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#circuite-continent').select2({
    placeholder: "- Alege continentul -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#circuite-tara').select2({
    placeholder: "- Alege tara -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#circuite-luna-plecare').select2({
    placeholder: "- Alege luna de plecare -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#t-individual-tara').select2({
    placeholder: "- Alege tara -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#t-individual-destinatia').select2({
    placeholder: "- Alege destinatia -",
	minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#t-individual-oras').select2({
    placeholder: "- Alege statiunea -",
	minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#t-intern-tara').select2({
    placeholder: "- Alege tara -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#t-intern-programul').select2({
    placeholder: "- Alege programul -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#t-intern-statiunea').select2({
    placeholder: "- Alege statiunea -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#croaziere-destinatie').select2({
    placeholder: "- Alege destinatia -",
    language: "ro",
  });

  $('#croaziere-port').select2({
    placeholder: "- Alege portul de imbarcare -",
    language: "ro",
  });

  $('#croaziere-luna').select2({
    placeholder: "- Alege luna de plecare -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#croaziere-nopti').select2({
    placeholder: "- Alege numarul de nopti -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#bilete-tara').select2({
    placeholder: "- Alege tara -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#bilete-destinatia').select2({
    placeholder: "- Alege destinatia -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#bilete-oras-plecare').select2({
    placeholder: "- Alege orasul -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });
}

function filters_select2() {
  $('#aside-chartere-tara').select2({
    placeholder: "- Alege tara -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#aside-chartere-destinatia').select2({
    placeholder: "- Alege destinatia -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#aside-chartere-plecare-din').select2({
    placeholder: "- Alege orasul -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#aside-chartere-durata').select2({
    placeholder: "- Alege durata -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#aside-circuite-tara').select2({
    placeholder: "- Alege tara -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#aside-circuite-continent').select2({
    placeholder: "- Alege continentul -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#aside-circuite-plecare-din').select2({
    placeholder: "- Alege orasul -",
    minimumResultsForSearch: Infinity,
    language: "ro",

  });

  $('#aside-circuite-plecare-luna').select2({
    placeholder: "- Alege luna de plecare -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#item-chartere-durata').select2({
    placeholder: "- Alege durata -",
    language: "ro",
    minimumResultsForSearch: Infinity,
  });

  $('#item-chartere-data-plecare').select2({
    placeholder: "- Alege data -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#item-circuite-data-plecare').select2({
    placeholder: "- Alege data -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#aside-t-individual-tara').select2({
    placeholder: "- Alege tara -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#aside-t-individual-destinatia').select2({
    placeholder: "- Alege destinatia -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#aside-t-individual-oras').select2({
    placeholder: "- Alege statiunea -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#aside-t-intern-programul').select2({
    placeholder: "- Alege programul -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#aside-t-intern-statiunea').select2({
    placeholder: "- Alege statiunea -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#aside-croaziere-destinatie').select2({
    placeholder: "- Alege destinatia -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#aside-croaziere-linia').select2({
    placeholder: "- Alege linia de croaziera -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#aside-croaziere-vasul').select2({
    placeholder: "- Alege vasul de croaziera -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#aside-croaziere-portul').select2({
    placeholder: "- Alege portul de imbarcare -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#aside-croaziere-categorie').select2({
    placeholder: "- Alege categorie -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#aside-croaziere-luna').select2({
    placeholder: "- Alege luna de plecare -",
    minimumResultsForSearch: Infinity,
    language: "ro",
  });

  $('#item__info__puntea__select').select2({
     placeholder: "- Alege o punte -",
     minimumResultsForSearch: Infinity,
     language: "ro",
   });

   $('#weather-month').select2({
     minimumResultsForSearch: Infinity,
     language: "ro",
   });

   $('#payment_in_rate_banci').select2({
     minimumResultsForSearch: Infinity,
     language: "ro",
   });

  //generic init select2 for select with .select__s2 class
  $('.select__s2').select2({
    language: "ro",
    minimumResultsForSearch: Infinity,
    placeholder: $(this).attr('data-placeholder')
  });
}

function getTimeRemaining(endtime) {
  var t = Date.parse(endtime) - Date.parse(new Date());
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

function initializeClock(clock, endtime) {
  var daysSpan = clock.find('.days');
  var hoursSpan = clock.find('.hours');
  var minutesSpan = clock.find('.minutes');
  var secondsSpan = clock.find('.seconds');

  function updateClock() {
    var t = getTimeRemaining(endtime);

    daysSpan.html(('0' + t.days).slice(-2));
    hoursSpan.html(('0' + t.hours).slice(-2));
    minutesSpan.html(('0' + t.minutes).slice(-2));
    secondsSpan.html(('0' + t.seconds).slice(-2));

    if (t.total <= 0) {
      clearInterval(timeinterval);
    }
  }

  updateClock();
  var timeinterval = setInterval(updateClock, 1000);
}

function aside_price_slider() {
  //https://jqueryui.com/slider/#range
  //http://codepen.io/ignaty/pen/EruAe
  $("#slider-range-filter").slider({
    range: true,
    min: parseFloat($('#slider-data-filter').data('min')),
    max: parseFloat($('#slider-data-filter').data('max')),
    values: [$("#slider-data-filter").data('min-set'), $("#slider-data-filter").data('max-set')],
    slide: function(event, ui) {
      $('.ui-slider-handle:eq(0) .price-range-min').html(ui.values[ 0 ] + ' €');
      $('.ui-slider-handle:eq(1) .price-range-max').html(ui.values[ 1 ] + ' €');
      $('.price-range-both').html('<i>' + ui.values[ 0 ] + ' € - </i>' + ui.values[ 1 ] + ' €');

      if ( ui.values[0] == ui.values[1] ) {
        $('.price-range-both i').css('display', 'none');
      } else {
        $('.price-range-both i').css('display', 'inline');
      }

      if (collision($('.price-range-min'), $('.price-range-max')) == true) {
        $('.price-range-min, .price-range-max').css('opacity', '0');
        $('.price-range-both').css('display', 'block');
      } else {
        $('.price-range-min, .price-range-max').css('opacity', '1');
        $('.price-range-both').css('display', 'none');
      }
      resize_colors();
    },
    stop: function(event, ui) {
    	location.href = $_price_filter_link + ui.values[0] + '-' + ui.values[1];
    }
  });

  $('#slider-range-filter .ui-slider-range').append('<span class="price-range-both value"><i>' + $('#slider-range-filter').slider('values', 0 ) + ' - </i>' + $('#slider-range-filter').slider('values', 1 ) + ' €</span>');
  $('#slider-range-filter .ui-slider-handle:eq(0)').append('<span class="price-range-min value">' + $('#slider-range-filter').slider('values', 0 ) + ' €</span>');
  $('#slider-range-filter .ui-slider-handle:eq(1)').append('<span class="price-range-max value">' + $('#slider-range-filter').slider('values', 1 ) + ' €</span>');

  function collision($div1, $div2) {
    var x1 = $div1.parent();
    var w1 = parseInt(x1.css('left'));console.log(w1);
    var r1 = w1 + 55;
    var x2 = $div2.parent();
    var w2 = parseInt(x2.css('left'));console.log(w2);
    var r2 = w2 + 55;
    if (r1 < w2 || w1 > r2) return false;
    return true;
  }

  resize_colors();
  function resize_colors() {
    //you start at 0
    var cur_pos = 0;
    $(".ui-slider-handle").each(function (i) {
      //for each handle you check position and set width of corresponding color div
      $('.color-region').eq(i).css('width', $(this).position().left - cur_pos)
      //update cur_pos to calculate next color width
      cur_pos = $(this).position().left;
    })
  }
}

function chartere_list_filters() {
  $("#aside-chartere-camere").on('select2:select select2:unselect', function(e) {
    var no_cam = $(this).val();

    if(no_cam == 2) {
      $('.aside-filters__cam2').show();
      $('.aside-filters__cam3').hide();
    }
    else if(no_cam == 3) {
      $('.aside-filters__cam2').show();
      $('.aside-filters__cam3').show();
    }
    else {
      $('.aside-filters__cam1').show();
      $('.aside-filters__cam2').hide();
      $('.aside-filters__cam3').hide();
    }
  });

  $("#aside-chartere-copii1").on('select2:select select2:unselect', function(e) {
    var no_copii1 = $(this).val();

    if(no_copii1 == 1) {
      $('.aside-filters__cam1 label:nth-of-type(n+3)').show();
      $('.aside-filters__cam1 label:nth-of-type(n+4)').hide();
    }
    else if(no_copii1 == 2) {
      $('.aside-filters__cam1 label:nth-of-type(n+3)').show();
      $('.aside-filters__cam1 label:nth-of-type(n+5)').hide();
    }
    else if(no_copii1 == 3) {
      $('.aside-filters__cam1 label:nth-of-type(n+3)').show();
    }
    else {
      $('.aside-filters__cam1 label:nth-of-type(n+3)').hide();
    }
  });

  $("#aside-chartere-copii2").on('select2:select select2:unselect', function(e) {
    var no_copii2 = $(this).val();

    if(no_copii2 == 1) {
      $('.aside-filters__cam2 label:nth-of-type(n+3)').show();
      $('.aside-filters__cam2 label:nth-of-type(n+4)').hide();
    }
    else if(no_copii2 == 2) {
      $('.aside-filters__cam2 label:nth-of-type(n+3)').show();
      $('.aside-filters__cam2 label:nth-of-type(n+5)').hide();
    }
    else if(no_copii2 == 3) {
      $('.aside-filters__cam2 label:nth-of-type(n+3)').show();
    }
    else {
      $('.aside-filters__cam2 label:nth-of-type(n+3)').hide();
    }
  });

  $("#aside-chartere-copii3").on('select2:select select2:unselect', function(e) {
    var no_copii3 = $(this).val();

    if(no_copii3 == 1) {
      $('.aside-filters__cam3 label:nth-of-type(n+3)').show();
      $('.aside-filters__cam3 label:nth-of-type(n+4)').hide();
    }
    else if(no_copii3 == 2) {
      $('.aside-filters__cam3 label:nth-of-type(n+3)').show();
      $('.aside-filters__cam3 label:nth-of-type(n+5)').hide();
    }
    else if(no_copii3 == 3) {
      $('.aside-filters__cam3 label:nth-of-type(n+3)').show();
    }
    else {
      $('.aside-filters__cam3 label:nth-of-type(n+3)').hide();
    }
  });
}

function chartere_item_filters() {
  $("#item-chartere-camere").on('select2:select select2:unselect', function(e) {
    var no_cam = $(this).val();

    if(no_cam == 2) {
      $('.item-filters__cam2').show();
      $('.item-filters__cam3').hide();
    }
    else if(no_cam == 3) {
      $('.item-filters__cam2').show();
      $('.item-filters__cam3').show();
    }
    else {
      $('.item-filters__cam1').show();
      $('.item-filters__cam2').hide();
      $('.item-filters__cam3').hide();
    }
  });

  $("#item-chartere-copii1").on('select2:select select2:unselect', function(e) {
    var no_copii1 = $(this).val();

    if(no_copii1 == 1) {
      $('.item-filters__cam1 label:nth-of-type(n+3)').show();
      $('.item-filters__cam1 label:nth-of-type(n+4)').hide();
    }
    else if(no_copii1 == 2) {
      $('.item-filters__cam1 label:nth-of-type(n+3)').show();
      $('.item-filters__cam1 label:nth-of-type(n+5)').hide();
    }
    else if(no_copii1 == 3) {
      $('.item-filters__cam1 label:nth-of-type(n+3)').show();
    }
    else {
      $('.item-filters__cam1 label:nth-of-type(n+3)').hide();
    }
  });

  $("#item-chartere-copii2").on('select2:select select2:unselect', function(e) {
    var no_copii2 = $(this).val();

    if(no_copii2 == 1) {
      $('.item-filters__cam2 label:nth-of-type(n+3)').show();
      $('.item-filters__cam2 label:nth-of-type(n+4)').hide();
    }
    else if(no_copii2 == 2) {
      $('.item-filters__cam2 label:nth-of-type(n+3)').show();
      $('.item-filters__cam2 label:nth-of-type(n+5)').hide();
    }
    else if(no_copii2 == 3) {
      $('.item-filters__cam2 label:nth-of-type(n+3)').show();
    }
    else {
      $('.item-filters__cam2 label:nth-of-type(n+3)').hide();
    }
  });

  $("#item-chartere-copii3").on('select2:select select2:unselect', function(e) {
    var no_copii3 = $(this).val();

    if(no_copii3 == 1) {
      $('.item-filters__cam3 label:nth-of-type(n+3)').show();
      $('.item-filters__cam3 label:nth-of-type(n+4)').hide();
    }
    else if(no_copii3 == 2) {
      $('.item-filters__cam3 label:nth-of-type(n+3)').show();
      $('.item-filters__cam3 label:nth-of-type(n+5)').hide();
    }
    else if(no_copii3 == 3) {
      $('.item-filters__cam3 label:nth-of-type(n+3)').show();
    }
    else {
      $('.item-filters__cam3 label:nth-of-type(n+3)').hide();
    }
  });


  $("#chartere-camere").on('select2:select select2:unselect', function(e) {
    var no_cam = $(this).val();

    if(no_cam == 2) {
      $('#chartere .item-filters__cam2').show();
      $('#chartere .item-filters__cam3').hide();
    }
    else if(no_cam == 3) {
      $('#chartere .item-filters__cam2').show();
      $('#chartere .item-filters__cam3').show();
    }
    else {
      $('#chartere .item-filters__cam1').show();
      $('#chartere .item-filters__cam2').hide();
      $('#chartere .item-filters__cam3').hide();
    }
  });

  $("#chartere-copii1").on('select2:select select2:unselect', function(e) {
    var no_copii1 = $(this).val();

    if(no_copii1 == 1) {
      $('#chartere .item-filters__cam1 label.children_age:eq(0)').show();
      $('#chartere .item-filters__cam1 label.children_age:eq(1)').hide();
      $('#chartere .item-filters__cam1 label.children_age:eq(2)').hide();
    }
    else if(no_copii1 == 2) {
      $('#chartere .item-filters__cam1 label.children_age:eq(0)').show();
      $('#chartere .item-filters__cam1 label.children_age:eq(1)').show();
      $('#chartere .item-filters__cam1 label.children_age:eq(2)').hide();
    }
    else if(no_copii1 == 3) {
      $('#chartere .item-filters__cam1 label.children_age:eq(0)').show();
      $('#chartere .item-filters__cam1 label.children_age:eq(1)').show();
      $('#chartere .item-filters__cam1 label.children_age:eq(2)').show();
    }
    else {
      $('#chartere .item-filters__cam1 label.children_age').hide();
    }
  });

  $("#chartere-copii2").on('select2:select select2:unselect', function(e) {
    var no_copii2 = $(this).val();

    if(no_copii2 == 1) {
      $('#chartere .item-filters__cam2 label.children_age:eq(0)').show();
      $('#chartere .item-filters__cam2 label.children_age:eq(1)').hide();
      $('#chartere .item-filters__cam2 label.children_age:eq(2)').hide();
    }
    else if(no_copii2 == 2) {
      $('#chartere .item-filters__cam2 label.children_age:eq(0)').show();
      $('#chartere .item-filters__cam2 label.children_age:eq(1)').show();
      $('#chartere .item-filters__cam2 label.children_age:eq(2)').hide();
    }
    else if(no_copii2 == 3) {
      $('#chartere .item-filters__cam2 label.children_age:eq(0)').show();
      $('#chartere .item-filters__cam2 label.children_age:eq(1)').show();
      $('#chartere .item-filters__cam2 label.children_age:eq(2)').show();
    }
    else {
      $('#chartere .item-filters__cam2 label.children_age').hide();
    }
  });

  $("#chartere-copii3").on('select2:select select2:unselect', function(e) {
    var no_copii3 = $(this).val();

    if(no_copii3 == 1) {
      $('#chartere .item-filters__cam3 label.children_age:eq(0)').show();
      $('#chartere .item-filters__cam3 label.children_age:eq(1)').hide();
      $('#chartere .item-filters__cam3 label.children_age:eq(2)').hide();
    }
    else if(no_copii3 == 2) {
      $('#chartere .item-filters__cam3 label.children_age:eq(0)').show();
      $('#chartere .item-filters__cam3 label.children_age:eq(1)').show();
      $('#chartere .item-filters__cam3 label.children_age:eq(2)').hide();
    }
    else if(no_copii3 == 3) {
      $('#chartere .item-filters__cam3 label.children_age:eq(0)').show();
      $('#chartere .item-filters__cam3 label.children_age:eq(1)').show();
      $('#chartere .item-filters__cam3 label.children_age:eq(2)').show();
    }
    else {
      $('#chartere .item-filters__cam3 label.children_age').hide();
    }
  });


  $('#chartere-check-in, #chartere-check-out').on('focus', function(){
  	if($('#chartere-tara option:selected').val() == '' ){
    	$(this).parent().find('span.error').html('Alege mai intai tara');
    	return false;
    }else if($('#chartere-destinatia option:selected').val() == '' ){
    	$(this).parent().find('span.error').html('Alege mai intai destinatia');
    	return false;
    }else if($('#chartere-oras-plecare option:selected').val() == '' ){
    	$(this).parent().find('span.error').html('Alege mai intai orasul de plecare');
    	return false;
    }else{
    	$(this).parent().find('span.error').html('');
    }
  });

  $('#chartere-tara, #chartere-destinatia').change(function(){
  	$('#chartere-check-in, #chartere-check-out').datepicker("destroy");
  });

  $('#aside-chartere-check-in, #aside-chartere-check-out').on('focus', function(){
  	if($('#aside-chartere-tara option:selected').val() == '' ){
    	$(this).parent().find('span.error').html('Alege mai intai tara');
    	return false;
    }else if($('#aside-chartere-destinatia option:selected').val() == '' ){
    	$(this).parent().find('span.error').html('Alege mai intai destinatia');
    	return false;
    }else if($('#aside-chartere-plecare-din option:selected').val() == '' ){
    	$(this).parent().find('span.error').html('Alege mai intai orasul de plecare');
    	return false;
    }else{
    	$(this).parent().find('span.error').html('');
    }
  });

  $('#aside-chartere-tara, #aside-chartere-destinatia').change(function(){
  	$('#aside-chartere-check-in, #aside-chartere-check-out').datepicker("destroy");
  });

  var $dates_from = [];
  var $dates_to = [];

    $('#chartere-oras-plecare').on('change', function(){

	  	//$('#chartere-check-in, #chartere-check-out').parent().find('span.error').html('');
	  	if(!hasCheckIn){
	  		$('#chartere-check-in, #chartere-check-out').val('');
	  	}

	  	country = $('#chartere-tara').find('option:selected').val();
	    city_to = $('#chartere-destinatia').find('option:selected').val();
	    city_from = $('#chartere-oras-plecare').find('option:selected').val();

	    // ajax si redirect
	    $.ajax({
			url: $_base + 'ajax/search/charter.php',
			data: {type: 'dates', country: country, city_to: city_to, city_from: city_from},
			dataType: 'json',
			success: function(data) {
				$dates_from = data.dates_from;
				$dates_to = data.dates_to;

				tmp = $dates_from[0].split('-');
				new_date = tmp[2] + "." + tmp[1] + "." + tmp[0];

				$("#chartere-check-in").datepicker('destroy');
                $("#chartere-check-in").datepicker({
				    minDate: "+1d",
				    changeMonth: true,
				    numberOfMonths: 1,
				    dateFormat: 'dd.mm.yy',
				    firstDay: 1,
					beforeShowDay: availableDays,
					minDate: new_date,
				    onSelect: trigerNextCalendarMinDateRestricted
				 });

				 $("#chartere-check-out").datepicker('destroy');
                 $("#chartere-check-out").datepicker({
				    changeMonth: true,
				    dateFormat: 'dd.mm.yy',
				    firstDay: 1,
				    disabled: true,
				    numberOfMonths: 1
				 });

				 if($("#chartere-check-in").val() != ""){
			    	//$('#chartere-check-in .ui-datepicker-current-day').trigger('click');
			    	$("#chartere-check-out").datepicker("option", "disabled", false);

					trigerNextCalendarMinDateRestricted($("#chartere-check-in").val());
			     }
			}
		});

		hasCheckIn = false;

    });




    $('#aside-chartere-plecare-din').on('change', function(){

	  	//$('#aside-chartere-check-in, #aside-chartere-check-out').parent().find('span.error').html('');
	  	//$('#aside-chartere-check-in, #aside-chartere-check-out').val('');

	  	country = $('#aside-chartere-tara').find('option:selected').val();
	    city_to = $('#aside-chartere-destinatia').find('option:selected').val();
	    city_from = $('#aside-chartere-plecare-din').find('option:selected').val();

	    // ajax si redirect
	    $.ajax({
			url: $_base + 'ajax/search/charter.php',
			data: {type: 'dates', country: country, city_to: city_to, city_from: city_from},
			dataType: 'json',
			success: function(data) {
				$dates_from = data.dates_from;
				$dates_to = data.dates_to;

				tmp = $dates_from[0].split('-');
				new_date = tmp[2] + "." + tmp[1] + "." + tmp[0];

                $("#aside-chartere-check-in").datepicker('destroy');
				$("#aside-chartere-check-in").datepicker({
				    minDate: "+1d",
				    changeMonth: true,
				    numberOfMonths: 1,
				    dateFormat: 'dd.mm.yy',
				    firstDay: 1,
					beforeShowDay: availableDays,
					minDate: new_date,
				    onSelect: trigerNextCalendarMinDateRestrictedSide
				 });

                 $("#aside-chartere-check-out").datepicker('destroy');
				 $("#aside-chartere-check-out").datepicker({
				    changeMonth: true,
				    dateFormat: 'dd.mm.yy',
				    firstDay: 1,
				    disabled: true,
				    numberOfMonths: 1
				 });

				 if($("#aside-chartere-check-in").val() != ""){
			    	//$('#aside-chartere-check-in .ui-datepicker-current-day').trigger('click');
			    	$("#aside-chartere-check-out").datepicker("option", "disabled", false);
			     }
			}
		});

    }).trigger('change');


	function availableDays(date) {
		dmy = date.getFullYear() + "-" + ('0' + (date.getMonth()+1)).slice(-2) + "-" + ('0' + date.getDate()).slice(-2);

		//console.log(dmy+' : '+($.inArray(dmy, $dates_from)));
		if ($.inArray(dmy, $dates_from) != -1) {
	    	return [true, "","Available"];
	  	} else {
	    	return [false,"","unAvailable"];
	  	}
	}

	function availableDaysReturn(date) {
		dmy = date.getFullYear() + "-" + ('0' + (date.getMonth()+1)).slice(-2) + "-" + ('0' + date.getDate()).slice(-2);

		tmp = selectedChekinDate.split('.');
		new_dmy = tmp[2] + "-" + tmp[1] + "-" + tmp[0];

		//console.log(dmy+' : '+($.inArray(dmy, $dates_to[new_dmy])));
		if ($.inArray(dmy, $dates_to[new_dmy]) != -1) {
	    	return [true, "","Available"];
	  	} else {
	    	return [false,"","unAvailable"];
	  	}
	}

	function trigerNextCalendarMinDateRestricted(selectedDate){
		$("#chartere-check-out").datepicker("option", "disabled", false);
		$('#chartere-check-out').val('');

    	selectedChekinDate = selectedDate;

    	tmp = selectedChekinDate.split('.');
		new_dmy = tmp[2] + "-" + tmp[1] + "-" + tmp[0];

		selectedChekoutDate = $dates_to[new_dmy];

		tmp = selectedChekoutDate[0].split('-');
		new_date = tmp[2] + "." + tmp[1] + "." + tmp[0];

    	$('#chartere-check-out').datepicker("option", "minDate", new_date);
    	$('#chartere-check-out').datepicker("option", "beforeShowDay", availableDaysReturn);
    }

    function trigerNextCalendarMinDateRestrictedSide(selectedDate){
		$("#aside-chartere-check-out").datepicker("option", "disabled", false);
		$('#aside-chartere-check-out').val('');

    	selectedChekinDate = selectedDate;

    	tmp = selectedChekinDate.split('.');
		new_dmy = tmp[2] + "-" + tmp[1] + "-" + tmp[0];

		selectedChekoutDate = $dates_to[new_dmy];

		tmp = selectedChekoutDate[0].split('-');
		new_date = tmp[2] + "." + tmp[1] + "." + tmp[0];

    	$('#aside-chartere-check-out').datepicker("option", "minDate", new_date);
    	$('#aside-chartere-check-out').datepicker("option", "beforeShowDay", availableDaysReturn);
    }
}

function circuite_list_filters() {
  $("#aside-circuite-copii").on('select2:select select2:unselect', function(e) {
    var no_copii1 = $(this).val();

    if(no_copii1 == 1) {
      $('.aside-filters__cam1 label:nth-of-type(n+3)').show();
      $('.aside-filters__cam1 label:nth-of-type(n+4)').hide();
    }
    else if(no_copii1 == 2) {
      $('.aside-filters__cam1 label:nth-of-type(n+3)').show();
      $('.aside-filters__cam1 label:nth-of-type(n+5)').hide();
    }
    else if(no_copii1 == 3) {
      $('.aside-filters__cam1 label:nth-of-type(n+3)').show();
    }
    else {
      $('.aside-filters__cam1 label:nth-of-type(n+3)').hide();
    }
  });
}

function circuite_item_filters() {
  $("#item-circuite-camere").on('select2:select select2:unselect', function(e) {
    var no_cam = $(this).val();

    if(no_cam == 2) {
      $('.item-filters__cam2').show();
      $('.item-filters__cam3').hide();
    }
    else if(no_cam == 3) {
      $('.item-filters__cam2').show();
      $('.item-filters__cam3').show();
    }
    else {
      $('.item-filters__cam1').show();
      $('.item-filters__cam2').hide();
      $('.item-filters__cam3').hide();
    }
  });

  $("#item-circuite-copii1").on('select2:select select2:unselect', function(e) {
    var no_copii1 = $(this).val();

    if(no_copii1 == 1) {
      $('.item-filters__cam1 label:nth-of-type(n+3)').show();
      $('.item-filters__cam1 label:nth-of-type(n+4)').hide();
    }
    else if(no_copii1 == 2) {
      $('.item-filters__cam1 label:nth-of-type(n+3)').show();
      $('.item-filters__cam1 label:nth-of-type(n+5)').hide();
    }
    else if(no_copii1 == 3) {
      $('.item-filters__cam1 label:nth-of-type(n+3)').show();
    }
    else {
      $('.item-filters__cam1 label:nth-of-type(n+3)').hide();
    }
  });

  $("#item-circuite-copii2").on('select2:select select2:unselect', function(e) {
    var no_copii2 = $(this).val();

    if(no_copii2 == 1) {
      $('.item-filters__cam2 label:nth-of-type(n+3)').show();
      $('.item-filters__cam2 label:nth-of-type(n+4)').hide();
    }
    else if(no_copii2 == 2) {
      $('.item-filters__cam2 label:nth-of-type(n+3)').show();
      $('.item-filters__cam2 label:nth-of-type(n+5)').hide();
    }
    else if(no_copii2 == 3) {
      $('.item-filters__cam2 label:nth-of-type(n+3)').show();
    }
    else {
      $('.item-filters__cam2 label:nth-of-type(n+3)').hide();
    }
  });

  $("#item-circuite-copii3").on('select2:select select2:unselect', function(e) {
    var no_copii3 = $(this).val();

    if(no_copii3 == 1) {
      $('.item-filters__cam3 label:nth-of-type(n+3)').show();
      $('.item-filters__cam3 label:nth-of-type(n+4)').hide();
    }
    else if(no_copii3 == 2) {
      $('.item-filters__cam3 label:nth-of-type(n+3)').show();
      $('.item-filters__cam3 label:nth-of-type(n+5)').hide();
    }
    else if(no_copii3 == 3) {
      $('.item-filters__cam3 label:nth-of-type(n+3)').show();
    }
    else {
      $('.item-filters__cam3 label:nth-of-type(n+3)').hide();
    }
  });


  /*
	$('.room_type select').change(function(){

		$room_val = $(this).val();
		$room_logic = $_room_types[$room_val];

		$parent = $(this).parent().parent().parent();

		$adult_select = $parent.find('.adult_nr select');
		$id_adult_select = $adult_select.attr('id');
		$child_select = $parent.find('.child_nr select');

		$adult_select.parent().show();

		if($room_logic.max_children == 0){
			$parent.find('.child_nr').hide();
			$parent.find('.child_age').hide();
		}else{
			$parent.find('.child_nr').show();
			if($child_select.val() > 0){
				$parent.find('.child_age').show();
			}
		}

		data = [];
		for(i=$room_logic.min_adults; i<=$room_logic.max_adults; i++){
			data.push({ id: i, text: i});
		}

		$('#'+$id_adult_select).select2('destroy').find('option').remove().end().select2({data: data, minimumResultsForSearch: Infinity});

	});
	*/

	/*
	$('.adult_nr select').change(function(){

		$parent = $(this).parent().parent().parent();

		$child_select = $parent.find('.child_nr select');

		if($(this).val() == 3){
			$parent.find('.child_nr').hide();
			$parent.find('.child_age').hide();
		}else{
			$parent.find('.child_nr').show();
			if($child_select.val() > 0){
				$parent.find('.child_age').show();
			}
		}

	});
	*/

	$("#circuite-camere").on('select2:select select2:unselect', function(e) {
	    var no_cam = $(this).val();

	    if(no_cam == 2) {
	      $('.item-filters__cam2').show();
	      $('.item-filters__cam3').hide();
	    }
	    else if(no_cam == 3) {
	      $('.item-filters__cam2').show();
	      $('.item-filters__cam3').show();
	    }
	    else {
	      $('.item-filters__cam1').show();
	      $('.item-filters__cam2').hide();
	      $('.item-filters__cam3').hide();
	    }
	});

	$('.adult_nr select').change(function(){

		$parent = $(this).parent().parent().parent().parent().parent();

		$child_select = $parent.find('.child_nr select');

		if($(this).val() == ""){
			$parent.find('.child_nr').hide();
			$parent.find('.child_age').hide();
		}else if($(this).val() == 3){
			$parent.find('.child_nr').hide();
			$parent.find('.child_age').hide();
		}else{
			$parent.find('.child_nr').show();
			if($child_select.val() > 0){
				$parent.find('.child_age').show();
			}
		}

		if($(this).val() == ""){
			$parent.find('.room_type').hide();
		}else{
			$parent.find('.room_type').show();
		}

		remove_add_room_types($(this).val(), $child_select.val(), $parent);

	});

	$('.child_nr select').change(function(){

		$parent = $(this).parent().parent().parent().parent().parent();

		$adult_select = $parent.find('.adult_nr select');

		if($(this).val() > 0){
			$parent.find('.child_age').show();
		}else{
			$parent.find('.child_age').hide();
		}

		remove_add_room_types($adult_select.val(), $(this).val(), $parent);

	});




}


function remove_add_room_types(adult, child, parent){
	var data;

	if(adult == 1 && (child == 0 || child == "" || child == "-")){
		data = [
			{ id: 0, text: "Single" },
			{ id: 2, text: "Dubla partaj" }
		];
	}

	if(adult == 1 && child == 1){
		data = [
			{ id: 2, text: "Dubla" }
		];
	}

	if(adult == 2 && (child == 0 || child == "" || child == "-")){
		data = [
			{ id: 1, text: "Dubla" }
		];
	}

	if(adult == 2 && child == 1){
		data = [
			{ id: 1, text: "Dubla" }
		];
	}

	if(adult == 3){// && (child == 0 || child == "" || child == "-")){
		data = [
			{ id: 3, text: "Tripla / Dubla cu pat suplimentar" },
		];
	}

	parent.find('.room_type select').select2('destroy').find('option').remove().end().select2({data: data, minimumResultsForSearch: Infinity, placeholder: "- Tip camera -"});
}



function t_individual_list_filters() {
  var dateFormat = "dd.mm.yy",
  from = $( "#aside-t-individual-check-in" )
        .datepicker({
          minDate: "+1d",
          //changeMonth: true,
          numberOfMonths: 1,
          dateFormat: 'dd.mm.yy',
          firstDay: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate_t_individual_list( this ) );
        }),
  to = $( "#aside-t-individual-check-out" ).datepicker({
          minDate: "+1d",
          //changeMonth: true,
          numberOfMonths: 1,
          dateFormat: 'dd.mm.yy',
          firstDay: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate_t_individual_list( this ) );
      });

  function getDate_t_individual_list( element ) {
    var date;
    try {
      date = $.datepicker.parseDate( dateFormat, element.value );
    } catch( error ) {
      date = null;
    }
    return date;
  }

  $("#aside-t-individual-camere").on('select2:select select2:unselect', function(e) {
    var no_cam = $(this).val();

    if(no_cam == 2) {
      $('.aside-filters__cam2').show();
      $('.aside-filters__cam3').hide();
    }
    else if(no_cam == 3) {
      $('.aside-filters__cam2').show();
      $('.aside-filters__cam3').show();
    }
    else {
      $('.aside-filters__cam1').show();
      $('.aside-filters__cam2').hide();
      $('.aside-filters__cam3').hide();
    }
  });

  $("#aside-t-individual-copii1").on('select2:select select2:unselect', function(e) {
    var no_copii1 = $(this).val();

    if(no_copii1 == 1) {
      $('.aside-filters__cam1 label:nth-of-type(n+3)').show();
      $('.aside-filters__cam1 label:nth-of-type(n+4)').hide();
    }
    else if(no_copii1 == 2) {
      $('.aside-filters__cam1 label:nth-of-type(n+3)').show();
      $('.aside-filters__cam1 label:nth-of-type(n+5)').hide();
    }
    else if(no_copii1 == 3) {
      $('.aside-filters__cam1 label:nth-of-type(n+3)').show();
    }
    else {
      $('.aside-filters__cam1 label:nth-of-type(n+3)').hide();
    }
  });

  $("#aside-t-individual-copii2").on('select2:select select2:unselect', function(e) {
    var no_copii2 = $(this).val();

    if(no_copii2 == 1) {
      $('.aside-filters__cam2 label:nth-of-type(n+3)').show();
      $('.aside-filters__cam2 label:nth-of-type(n+4)').hide();
    }
    else if(no_copii2 == 2) {
      $('.aside-filters__cam2 label:nth-of-type(n+3)').show();
      $('.aside-filters__cam2 label:nth-of-type(n+5)').hide();
    }
    else if(no_copii2 == 3) {
      $('.aside-filters__cam2 label:nth-of-type(n+3)').show();
    }
    else {
      $('.aside-filters__cam2 label:nth-of-type(n+3)').hide();
    }
  });

  $("#aside-t-individual-copii3").on('select2:select select2:unselect', function(e) {
    var no_copii3 = $(this).val();

    if(no_copii3 == 1) {
      $('.aside-filters__cam3 label:nth-of-type(n+3)').show();
      $('.aside-filters__cam3 label:nth-of-type(n+4)').hide();
    }
    else if(no_copii3 == 2) {
      $('.aside-filters__cam3 label:nth-of-type(n+3)').show();
      $('.aside-filters__cam3 label:nth-of-type(n+5)').hide();
    }
    else if(no_copii3 == 3) {
      $('.aside-filters__cam3 label:nth-of-type(n+3)').show();
    }
    else {
      $('.aside-filters__cam3 label:nth-of-type(n+3)').hide();
    }
  });
}

function t_individual_item_filters() {
  from = $( "#item-t-individual-check-in" )
        .datepicker({
          minDate: "+1d",
          //changeMonth: true,
          numberOfMonths: 1,
          dateFormat: 'dd.mm.yy',
          firstDay: 1,
          onSelect: trigerNextCalendarMinDate
        }),
  to = $( "#item-t-individual-check-out" ).datepicker({
  		minDate: "+1d",
        //changeMonth: true,
        dateFormat: 'dd.mm.yy',
        firstDay: 1,
        numberOfMonths: 1
      });

	function trigerNextCalendarMinDate(selectedDate){
    	var date2 = $('#item-t-individual-check-in').datepicker('getDate');
    	date2.setDate(date2.getDate()+1);

    	$('#item-t-individual-check-out').datepicker("option", "minDate", date2);
    }


  from = $( "#t-individual-check-in" )
        .datepicker({
          minDate: "+1d",
          //changeMonth: true,
          numberOfMonths: 1,
          dateFormat: 'dd.mm.yy',
          firstDay: 1,
          onSelect: trigerNextCalendarMinDate2
        }),
  to = $( "#t-individual-check-out" ).datepicker({
  		minDate: "+1d",
        //changeMonth: true,
        dateFormat: 'dd.mm.yy',
        firstDay: 1,
        numberOfMonths: 1
      });

	function trigerNextCalendarMinDate2(selectedDate){
    	var date2 = $('#t-individual-check-in').datepicker('getDate');
    	date2.setDate(date2.getDate()+1);

    	$('#t-individual-check-out').datepicker("option", "minDate", date2);
    }


  $("#item-t-individual-camere").on('select2:select select2:unselect', function(e) {
    var no_cam = $(this).val();

    if(no_cam == 2) {
      $('.item-filters__cam2').show();
      $('.item-filters__cam3').hide();
    }
    else if(no_cam == 3) {
      $('.item-filters__cam2').show();
      $('.item-filters__cam3').show();
    }
    else {
      $('.item-filters__cam1').show();
      $('.item-filters__cam2').hide();
      $('.item-filters__cam3').hide();
    }
  });

  $("#item-t-individual-copii1").on('select2:select select2:unselect', function(e) {
    var no_copii1 = $(this).val();

    if(no_copii1 == 1) {
      $('.item-filters__cam1 label:nth-of-type(n+3)').show();
      $('.item-filters__cam1 label:nth-of-type(n+4)').hide();
    }
    else if(no_copii1 == 2) {
      $('.item-filters__cam1 label:nth-of-type(n+3)').show();
      $('.item-filters__cam1 label:nth-of-type(n+5)').hide();
    }
    else if(no_copii1 == 3) {
      $('.item-filters__cam1 label:nth-of-type(n+3)').show();
    }
    else {
      $('.item-filters__cam1 label:nth-of-type(n+3)').hide();
    }
  });

  $("#item-t-individual-copii2").on('select2:select select2:unselect', function(e) {
    var no_copii2 = $(this).val();

    if(no_copii2 == 1) {
      $('.item-filters__cam2 label:nth-of-type(n+3)').show();
      $('.item-filters__cam2 label:nth-of-type(n+4)').hide();
    }
    else if(no_copii2 == 2) {
      $('.item-filters__cam2 label:nth-of-type(n+3)').show();
      $('.item-filters__cam2 label:nth-of-type(n+5)').hide();
    }
    else if(no_copii2 == 3) {
      $('.item-filters__cam2 label:nth-of-type(n+3)').show();
    }
    else {
      $('.item-filters__cam2 label:nth-of-type(n+3)').hide();
    }
  });

  $("#item-t-individual-copii3").on('select2:select select2:unselect', function(e) {
    var no_copii3 = $(this).val();

    if(no_copii3 == 1) {
      $('.item-filters__cam3 label:nth-of-type(n+3)').show();
      $('.item-filters__cam3 label:nth-of-type(n+4)').hide();
    }
    else if(no_copii3 == 2) {
      $('.item-filters__cam3 label:nth-of-type(n+3)').show();
      $('.item-filters__cam3 label:nth-of-type(n+5)').hide();
    }
    else if(no_copii3 == 3) {
      $('.item-filters__cam3 label:nth-of-type(n+3)').show();
    }
    else {
      $('.item-filters__cam3 label:nth-of-type(n+3)').hide();
    }
  });


  $("#t-individual-camere").on('select2:select select2:unselect', function(e) {
    var no_cam = $(this).val();

    if(no_cam == 2) {
      $('#turism-individual .item-filters__cam2').show();
      $('#turism-individual .item-filters__cam3').hide();
    }
    else if(no_cam == 3) {
      $('#turism-individual .item-filters__cam2').show();
      $('#turism-individual .item-filters__cam3').show();
    }
    else {
      $('#turism-individual .item-filters__cam1').show();
      $('#turism-individual .item-filters__cam2').hide();
      $('#turism-individual .item-filters__cam3').hide();
    }
  });

  $("#t-individual-copii1").on('select2:select select2:unselect', function(e) {
    var no_copii1 = $(this).val();

    if(no_copii1 == 1) {
      $('#turism-individual .item-filters__cam1 label.children_age:eq(0)').show();
      $('#turism-individual .item-filters__cam1 label.children_age:eq(1)').hide();
      $('#turism-individual .item-filters__cam1 label.children_age:eq(2)').hide();
    }
    else if(no_copii1 == 2) {
      $('#turism-individual .item-filters__cam1 label.children_age:eq(0)').show();
      $('#turism-individual .item-filters__cam1 label.children_age:eq(1)').show();
      $('#turism-individual .item-filters__cam1 label.children_age:eq(2)').hide();
    }
    else if(no_copii1 == 3) {
      $('#turism-individual .item-filters__cam1 label.children_age:eq(0)').show();
      $('#turism-individual .item-filters__cam1 label.children_age:eq(1)').show();
      $('#turism-individual .item-filters__cam1 label.children_age:eq(2)').show();
    }
    else {
      $('#turism-individual .item-filters__cam1 label.children_age').hide();
    }
  });

  $("#t-individual-copii2").on('select2:select select2:unselect', function(e) {
    var no_copii2 = $(this).val();

    if(no_copii2 == 1) {
      $('#turism-individual .item-filters__cam2 label.children_age:eq(0)').show();
      $('#turism-individual .item-filters__cam2 label.children_age:eq(1)').hide();
      $('#turism-individual .item-filters__cam2 label.children_age:eq(2)').hide();
    }
    else if(no_copii2 == 2) {
      $('#turism-individual .item-filters__cam2 label.children_age:eq(0)').show();
      $('#turism-individual .item-filters__cam2 label.children_age:eq(1)').show();
      $('#turism-individual .item-filters__cam2 label.children_age:eq(2)').hide();
    }
    else if(no_copii2 == 3) {
      $('#turism-individual .item-filters__cam2 label.children_age:eq(0)').show();
      $('#turism-individual .item-filters__cam2 label.children_age:eq(1)').show();
      $('#turism-individual .item-filters__cam2 label.children_age:eq(2)').show();
    }
    else {
      $('#turism-individual .item-filters__cam2 label.children_age').hide();
    }
  });

  $("#t-individual-copii3").on('select2:select select2:unselect', function(e) {
    var no_copii3 = $(this).val();

    if(no_copii3 == 1) {
      $('#turism-individual .item-filters__cam3 label.children_age:eq(0)').show();
      $('#turism-individual .item-filters__cam3 label.children_age:eq(1)').hide();
      $('#turism-individual .item-filters__cam3 label.children_age:eq(2)').hide();
    }
    else if(no_copii3 == 2) {
      $('#turism-individual .item-filters__cam3 label.children_age:eq(0)').show();
      $('#turism-individual .item-filters__cam3 label.children_age:eq(1)').show();
      $('#turism-individual .item-filters__cam3 label.children_age:eq(2)').hide();
    }
    else if(no_copii3 == 3) {
      $('#turism-individual .item-filters__cam3 label.children_age:eq(0)').show();
      $('#turism-individual .item-filters__cam3 label.children_age:eq(1)').show();
      $('#turism-individual .item-filters__cam3 label.children_age:eq(2)').show();
    }
    else {
      $('#turism-individual .item-filters__cam3 label.children_age').hide();
    }
  });
}

function t_intern_list_filters() {
  var dateFormat = "dd.mm.yy",
  from = $( "#aside-t-intern-check-in" )
        .datepicker({
          minDate: "+1d",
          //changeMonth: true,
          numberOfMonths: 1,
          dateFormat: 'dd.mm.yy',
          firstDay: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate_t_intern_list( this ) );
        }),
  to = $( "#aside-t-intern-check-out" ).datepicker({
          minDate: "+1d",
          //changeMonth: true,
          numberOfMonths: 1,
          dateFormat: 'dd.mm.yy',
          firstDay: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate_t_intern_list( this ) );
      });

  function getDate_t_intern_list( element ) {
    var date;
    try {
      date = $.datepicker.parseDate( dateFormat, element.value );
    } catch( error ) {
      date = null;
    }
    return date;
  }

  $("#aside-t-intern-camere").on('select2:select select2:unselect', function(e) {
    var no_cam = $(this).val();

    if(no_cam == 2) {
      $('.aside-filters__cam2').show();
      $('.aside-filters__cam3').hide();
    }
    else if(no_cam == 3) {
      $('.aside-filters__cam2').show();
      $('.aside-filters__cam3').show();
    }
    else {
      $('.aside-filters__cam1').show();
      $('.aside-filters__cam2').hide();
      $('.aside-filters__cam3').hide();
    }
  });

  $("#aside-t-intern-copii1").on('select2:select select2:unselect', function(e) {
    var no_copii1 = $(this).val();

    if(no_copii1 == 1) {
      $('.aside-filters__cam1 label:nth-of-type(n+3)').show();
      $('.aside-filters__cam1 label:nth-of-type(n+4)').hide();
    }
    else if(no_copii1 == 2) {
      $('.aside-filters__cam1 label:nth-of-type(n+3)').show();
      $('.aside-filters__cam1 label:nth-of-type(n+5)').hide();
    }
    else if(no_copii1 == 3) {
      $('.aside-filters__cam1 label:nth-of-type(n+3)').show();
    }
    else {
      $('.aside-filters__cam1 label:nth-of-type(n+3)').hide();
    }
  });

  $("#aside-t-intern-copii2").on('select2:select select2:unselect', function(e) {
    var no_copii2 = $(this).val();

    if(no_copii2 == 1) {
      $('.aside-filters__cam2 label:nth-of-type(n+3)').show();
      $('.aside-filters__cam2 label:nth-of-type(n+4)').hide();
    }
    else if(no_copii2 == 2) {
      $('.aside-filters__cam2 label:nth-of-type(n+3)').show();
      $('.aside-filters__cam2 label:nth-of-type(n+5)').hide();
    }
    else if(no_copii2 == 3) {
      $('.aside-filters__cam2 label:nth-of-type(n+3)').show();
    }
    else {
      $('.aside-filters__cam2 label:nth-of-type(n+3)').hide();
    }
  });

  $("#aside-t-intern-copii3").on('select2:select select2:unselect', function(e) {
    var no_copii3 = $(this).val();

    if(no_copii3 == 1) {
      $('.aside-filters__cam3 label:nth-of-type(n+3)').show();
      $('.aside-filters__cam3 label:nth-of-type(n+4)').hide();
    }
    else if(no_copii3 == 2) {
      $('.aside-filters__cam3 label:nth-of-type(n+3)').show();
      $('.aside-filters__cam3 label:nth-of-type(n+5)').hide();
    }
    else if(no_copii3 == 3) {
      $('.aside-filters__cam3 label:nth-of-type(n+3)').show();
    }
    else {
      $('.aside-filters__cam3 label:nth-of-type(n+3)').hide();
    }
  });
}

function t_intern_item_filters() {
  var dateFormat = "dd.mm.yy",
  from = $( "#item-t-intern-check-in" )
        .datepicker({
          minDate: "+1d",
          //changeMonth: true,
          numberOfMonths: 1,
          dateFormat: 'dd.mm.yy',
          firstDay: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate_t_intern_item( this ) );
        }),
  to = $( "#item-t-intern-check-out" ).datepicker({
          minDate: "+1d",
          //changeMonth: true,
          numberOfMonths: 1,
          dateFormat: 'dd.mm.yy',
          firstDay: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate_t_intern_item( this ) );
      });

  function getDate_t_intern_item( element ) {
    var date;
    try {
      date = $.datepicker.parseDate( dateFormat, element.value );
    } catch( error ) {
      date = null;
    }
    return date;
  }

  from = $( "#t-intern-check-in" )
        .datepicker({
          minDate: "+1d",
          //changeMonth: true,
          numberOfMonths: 1,
          dateFormat: 'dd.mm.yy',
          firstDay: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate_t_intern_item2( this ) );
        }),
  to = $( "#t-intern-check-out" ).datepicker({
          minDate: "+1d",
          //changeMonth: true,
          numberOfMonths: 1,
          dateFormat: 'dd.mm.yy',
          firstDay: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate_t_intern_item2( this ) );
      });

  function getDate_t_intern_item2( element ) {
    var date;
    try {
      date = $.datepicker.parseDate( dateFormat, element.value );
    } catch( error ) {
      date = null;
    }
    return date;
  }

  $("#item-t-intern-camere").on('select2:select select2:unselect', function(e) {
    var no_cam = $(this).val();

    if(no_cam == 2) {
      $('.item-filters__cam2').show();
      $('.item-filters__cam3').hide();
    }
    else if(no_cam == 3) {
      $('.item-filters__cam2').show();
      $('.item-filters__cam3').show();
    }
    else {
      $('.item-filters__cam1').show();
      $('.item-filters__cam2').hide();
      $('.item-filters__cam3').hide();
    }
  });

  $("#item-t-intern-copii1").on('select2:select select2:unselect', function(e) {
    var no_copii1 = $(this).val();

    if(no_copii1 == 1) {
      $('.item-filters__cam1 label:nth-of-type(n+3)').show();
      $('.item-filters__cam1 label:nth-of-type(n+4)').hide();
    }
    else if(no_copii1 == 2) {
      $('.item-filters__cam1 label:nth-of-type(n+3)').show();
      $('.item-filters__cam1 label:nth-of-type(n+5)').hide();
    }
    else if(no_copii1 == 3) {
      $('.item-filters__cam1 label:nth-of-type(n+3)').show();
    }
    else {
      $('.item-filters__cam1 label:nth-of-type(n+3)').hide();
    }
  });

  $("#item-t-intern-copii2").on('select2:select select2:unselect', function(e) {
    var no_copii2 = $(this).val();

    if(no_copii2 == 1) {
      $('.item-filters__cam2 label:nth-of-type(n+3)').show();
      $('.item-filters__cam2 label:nth-of-type(n+4)').hide();
    }
    else if(no_copii2 == 2) {
      $('.item-filters__cam2 label:nth-of-type(n+3)').show();
      $('.item-filters__cam2 label:nth-of-type(n+5)').hide();
    }
    else if(no_copii2 == 3) {
      $('.item-filters__cam2 label:nth-of-type(n+3)').show();
    }
    else {
      $('.item-filters__cam2 label:nth-of-type(n+3)').hide();
    }
  });

  $("#item-t-intern-copii3").on('select2:select select2:unselect', function(e) {
    var no_copii3 = $(this).val();

    if(no_copii3 == 1) {
      $('.item-filters__cam3 label:nth-of-type(n+3)').show();
      $('.item-filters__cam3 label:nth-of-type(n+4)').hide();
    }
    else if(no_copii3 == 2) {
      $('.item-filters__cam3 label:nth-of-type(n+3)').show();
      $('.item-filters__cam3 label:nth-of-type(n+5)').hide();
    }
    else if(no_copii3 == 3) {
      $('.item-filters__cam3 label:nth-of-type(n+3)').show();
    }
    else {
      $('.item-filters__cam3 label:nth-of-type(n+3)').hide();
    }
  });


  $("#t-intern-camere").on('select2:select select2:unselect', function(e) {
    var no_cam = $(this).val();

    if(no_cam == 2) {
      $('#turism-intern .item-filters__cam2').show();
      $('#turism-intern .item-filters__cam3').hide();
    }
    else if(no_cam == 3) {
      $('#turism-intern .item-filters__cam2').show();
      $('#turism-intern .item-filters__cam3').show();
    }
    else {
      $('#turism-intern .item-filters__cam1').show();
      $('#turism-intern .item-filters__cam2').hide();
      $('#turism-intern .item-filters__cam3').hide();
    }
  });

  $("#t-intern-copii1").on('select2:select select2:unselect', function(e) {
    var no_copii1 = $(this).val();

    if(no_copii1 == 1) {
      $('#turism-intern .item-filters__cam1 label.children_age:eq(0)').show();
      $('#turism-intern .item-filters__cam1 label.children_age:eq(1)').hide();
      $('#turism-intern .item-filters__cam1 label.children_age:eq(2)').hide();
    }
    else if(no_copii1 == 2) {
      $('#turism-intern .item-filters__cam1 label.children_age:eq(0)').show();
      $('#turism-intern .item-filters__cam1 label.children_age:eq(1)').show();
      $('#turism-intern .item-filters__cam1 label.children_age:eq(2)').hide();
    }
    else if(no_copii1 == 3) {
      $('#turism-intern .item-filters__cam1 label.children_age:eq(0)').show();
      $('#turism-intern .item-filters__cam1 label.children_age:eq(1)').show();
      $('#turism-intern .item-filters__cam1 label.children_age:eq(2)').show();
    }
    else {
      $('#turism-intern .item-filters__cam1 label.children_age').hide();
    }
  });

  $("#t-intern-copii2").on('select2:select select2:unselect', function(e) {
    var no_copii2 = $(this).val();

    if(no_copii2 == 1) {
      $('#turism-intern .item-filters__cam2 label.children_age:eq(0)').show();
      $('#turism-intern .item-filters__cam2 label.children_age:eq(1)').hide();
      $('#turism-intern .item-filters__cam2 label.children_age:eq(2)').hide();
    }
    else if(no_copii2 == 2) {
      $('#turism-intern .item-filters__cam2 label.children_age:eq(0)').show();
      $('#turism-intern .item-filters__cam2 label.children_age:eq(1)').show();
      $('#turism-intern .item-filters__cam2 label.children_age:eq(2)').hide();
    }
    else if(no_copii2 == 3) {
      $('#turism-intern .item-filters__cam2 label.children_age:eq(0)').show();
      $('#turism-intern .item-filters__cam2 label.children_age:eq(1)').show();
      $('#turism-intern .item-filters__cam2 label.children_age:eq(2)').show();
    }
    else {
      $('#turism-intern .item-filters__cam2 label.children_age').hide();
    }
  });

  $("#t-intern-copii3").on('select2:select select2:unselect', function(e) {
    var no_copii3 = $(this).val();

    if(no_copii3 == 1) {
      $('#turism-intern .item-filters__cam3 label.children_age:eq(0)').show();
      $('#turism-intern .item-filters__cam3 label.children_age:eq(1)').hide();
      $('#turism-intern .item-filters__cam3 label.children_age:eq(2)').hide();
    }
    else if(no_copii3 == 2) {
      $('#turism-intern .item-filters__cam3 label.children_age:eq(0)').show();
      $('#turism-intern .item-filters__cam3 label.children_age:eq(1)').show();
      $('#turism-intern .item-filters__cam3 label.children_age:eq(2)').hide();
    }
    else if(no_copii3 == 3) {
      $('#turism-intern .item-filters__cam3 label.children_age:eq(0)').show();
      $('#turism-intern .item-filters__cam3 label.children_age:eq(1)').show();
      $('#turism-intern .item-filters__cam3 label.children_age:eq(2)').show();
    }
    else {
      $('#turism-intern .item-filters__cam3 label.children_age').hide();
    }
  });

}

function item_tabs() {
  $('#item-tabs__btn + .dropdown-menu > li > a').click(function(){
    var text = $(this).text();
    var target = $(this).attr('href');

    $('#item-tabs__btn + .dropdown-menu > li').toggleClass('active',false);
    $('#item-tabs__btn + .dropdown-backdrop + .dropdown-menu > li').toggleClass('active',false);
    $('#item-tabs__btn').html('<span class="item-tabs__btn__text">'+text+'</span> <span class="item-tabs__btn__sprite"><i class="sprite sprite-panel-down position-center"></i></span>');

    $('#nav-tabs > li').toggleClass('active',false);
    $('#nav-tabs > li > a[href="'+target+'"]').parent().toggleClass('active',true);
  });

  $('#nav-tabs > li > a').click(function(){
    var text = $(this).text();
    var target = $(this).attr('href');

    $('#item-tabs__btn + .dropdown-menu > li').toggleClass('active',false);
    $('#item-tabs__btn + .dropdown-menu > li > a[href="'+target+'"]').parent().toggleClass('active',true);
    $('#item-tabs__btn + .dropdown-backdrop + .dropdown-menu > li').toggleClass('active',false);
    $('#item-tabs__btn + .dropdown-backdrop + .dropdown-menu > li > a[href="'+target+'"]').parent().toggleClass('active',true);
    $('#item-tabs__btn').html('<span class="item-tabs__btn__text">'+text+'</span> <span class="item-tabs__btn__sprite"><i class="sprite sprite-panel-down position-center"></i></span>');
  });
}

function cart() {
  $('label[for="invoice_type_pf"]').on('click', function(){
    //$('#factura-pjuridica').attr('checked', false);
    $('.f-companie').toggleClass('hidden',true);
    $('.f-persoana').toggleClass('hidden',false);

    $('#contract-pf-link').show();
    $('#contract-pj-link').hide();
  });

  $('label[for="invoice_type_pj"]').on('click', function(){
    //$('#factura-pfizica').attr('checked', false);
    $('.f-companie').toggleClass('hidden',false);
    $('.f-persoana').toggleClass('hidden',true);

    $('#contract-pf-link').hide();
    $('#contract-pj-link').show();
  });

  $('label[for="pay_amount_full"]').on('click', function(){
    $('#scadente').toggleClass('hidden', true);
  });
  $('label[for="pay_amount_advance"]').on('click', function(){
    $('#scadente').toggleClass('hidden', false);
  });

  $('input[name="payment"]').on('change', function(){
  	// if($(this).val() == "cash" || $(this).val() == "voucher"){
  	// 	$('#agencies').removeClass('hidden');
  	// }else{
  	// 	$('#agencies').addClass('hidden');
  	// }

    if($(this).val() == "cash" || $(this).val() == "voucher"){
        if($('#select_agencies').val() == 21749){
            $('#select_agencies').val('').trigger('change');
            $('#id_agency').val('').trigger('change');
        }
    }

  	if($(this).val() != "rate"){
  		$('#payment_in_rate_banci').val('').trigger('change');
  	}
  });

  $('input[name="pay_currency"]').on('change', function(){
  	if($(this).val() == "ron"){
  		$('.payment-rate').removeClass('hidden');
  	}else{
  		$('.payment-rate').addClass('hidden');
  		$('input[name="payment"][value="euplatesc"]').attr('checked', true);
  	}
  });

  if($(window).width()>=992) {
    $('#sticky_item').stick_in_parent();
    $('.fixedElement ul li:nth-child(2)').click(function(){
    	setTimeout(function(){
    		$('#sticky_item_bfiasi').stick_in_parent();
    	}, 200);

    })

    $('.fixedElement ul li:nth-child(3)').click(function(){
    	setTimeout(function(){
    		$('#sticky_item_bfcluj-napoca').stick_in_parent();
    	}, 200);

    })

    $('.fixedElement ul li:nth-child(4)').click(function(){
    	setTimeout(function(){
    		$('#sticky_item_bftimisoara').stick_in_parent();
    	}, 200);

    })
    $('#sticky_item_bfbucuresti').stick_in_parent();




 //    $(window).scroll(function(e){
	// 	  var $el = $('.fixedElement');
	// 	  var isPositionFixed = ($el.css('position') == 'fixed');
	// 	  if ($(this).scrollTop() > 400 && !isPositionFixed){
	// 	    $('.fixedElement').css({'position': 'fixed', 'top': '0px'});
	// 	    $('.fixedElement').addClass('on-air');
	// 	  }
	// 	  if ($(this).scrollTop() < 400 && isPositionFixed)
	// 	  {
	// 	    $('.fixedElement').css({'position': 'static', 'top': '0px'});
	// 	    $('.fixedElement').removeClass('on-air');
	// 	  }

	// 	  $('.on-air').css('width', $('.fixedElement').parent().width()+'px');

	// });

  }
}

function puntea__zoom__image() {
  $(".zoom-image").ezPlus({
    responsive : true,
    scrollZoom : false,
    zoomType: 'lens',
    lensShape: 'round',
    lensSize: 200,
    respond: [{
      range: '100-767',
      enabled: false,
      showLens: false
    }]
  });
}

function bilete() {
  var dateFormat = "dd.mm.yy",
  from = $( "#bilete-rezervare-data-plecare" )
        .datepicker({
          minDate: "+1d",
          //changeMonth: true,
          numberOfMonths: 1,
          dateFormat: 'dd.mm.yy',
          firstDay: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate_t_intern_list( this ) );
        }),
  to = $( "#bilete-rezervare-data-intoarcere" ).datepicker({
          minDate: "+1d",
          //changeMonth: true,
          numberOfMonths: 1,
          dateFormat: 'dd.mm.yy',
          firstDay: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate_t_intern_list( this ) );
      });

  function getDate_t_intern_list( element ) {
    var date;
    try {
      date = $.datepicker.parseDate( dateFormat, element.value );
    } catch( error ) {
      date = null;
    }
    return date;
  }
}


$(document).ready(function(){


  var date_flip = new Date(2018, 10, 21);
    var now_flip = new Date();
    var diff_flip = (date_flip.getTime()/1000) - (now_flip.getTime()/1000);

  var clock = new FlipClock($('.your-clock'), diff_flip, {
    clockFace: 'DailyCounter',
    countdown: true,
    showSeconds: true,
    language:'ro-ro',
  });

	$('label[for=want_insurance]').on('click', function(){
		$('.insurance-booking').toggleClass('hidden');
	});
	if($('#want_insurance').is(':checked')){
		$('.insurance-booking').removeClass('hidden');
	}else{
		$('.insurance-booking').addClass('hidden');
	}



    $('label[for=have_voucher]').on('click', function(){
		$('.voucher-booking').toggleClass('hidden');
	});
	if($('#have_voucher').is(':checked')){
		$('.voucher-booking').removeClass('hidden');
	}else{
		$('.voucher-booking').addClass('hidden');
	}




	$('.support .list-unstyled a').click(function(e){
		e.preventDefault();

		var click = $(this);
		click.addClass('active');
		click.parent().siblings().children().removeClass('active');

		$('.col-md-9').each(function(){
			if(click.data('name') == $(this).data('name')){

				$(this).removeClass('hidden');
				$(this).siblings('.col-md-9').addClass('hidden');
			}
		})

		$('.logo-title--full').each(function(){
			if(click.data('name') == $(this).data('name')){

				$(this).removeClass('hidden');
				$(this).siblings('.logo-title--full').addClass('hidden');
			}
		})

	});

    var autoplay = 7000;
    if($('.swiper-container.swiper-item__main').hasClass('with-video')){
        autoplay = false;
    }


    var nextButtonAgency = '';
    var prevButtonAgency = '';

    if($('.agencies-gallery').length){
       nextButtonAgency = '.agencies-gallery .swiper-button-next';
       prevButtonAgency = '.agencies-gallery .swiper-button-prev';
    }

	var gallerySwiper = new Swiper('.swiper-container.swiper-item__main', {
        spaceBetween: 10,
        loop:true,
        loopedSlides: $(".swiper-container.swiper-item__main .swiper-slide").length,
        autoplay: autoplay,
        nextButton: nextButtonAgency,
        prevButton: prevButtonAgency,
        //loopAdditionalSlides: $(".swiper-container.swiper-item__main .swiper-slide").length,
        onSlideChangeStart: function (gallerySwiper) {
            if($('#my-video').length){
                jwplayer().pause();
            }
        },
    });
    var thumbsSwiper = new Swiper('.swiper-item__thumbs  .swiper-container', {
      	spaceBetween: 10,
        touchRatio: 0.2,
        slideToClickedSlide: true,
        paginationClickable: true,
        nextButton: '.swiper-item__thumbs .swiper-button-next',
        prevButton: '.swiper-item__thumbs .swiper-button-prev',
        centeredSlides: true,
        slidesPerView: 7,
        loop:true,
        loopedSlides: $(".swiper-item__thumbs  .swiper-container .swiper-slide").length,
        autoplay: autoplay,
        //loopAdditionalSlides: $(".swiper-item__thumbs  .swiper-container .swiper-slide").length,
        onSlideChangeStart: function (gallerySwiper) {
            if($('#my-video').length){
                jwplayer().pause();
            }
        },
    });
    gallerySwiper.params.control = thumbsSwiper;
    thumbsSwiper.params.control = gallerySwiper;

	$('#item__info__puntea__select').change(function(){
		var opt_id = $(this).val();
		//console.log(opt_id);
		$('.deck-articles').each(function(){
			if($(this).attr('id') == opt_id){
				$(this).removeClass('hidden');
				$(this).siblings('.deck-articles').addClass('hidden');
			}
		})
	})

	$(".lazy").lazyload();
	$(".lazy-punte").lazyload({
		event : "change"
	});

	$(".fancybox").fancybox();

	$('.change-select').on("select2:select", function (e) {
    	$('.change-select').prop('disabled', true);
    	location.href = e.params.data.id;
    });

    $('.change-select').on("select2:unselect", function (e) {
    	$('.change-select').prop('disabled', true);
    	location.href = e.params.data.element.dataset.remove;
    });

    $('.main-filters__btn-cauta').click(function(){
    	$('.main-filters .tab-pane').each(function(){
			if($(this).hasClass('active')){
				//console.log($(this).children('form'));
				$(this).find('form').submit();
			}
    	});
    })

     $('.click-to-link').change(function(){
    	if($(this).is(':checked')){
    		window.location.href = $(this).val();
    	}else{
    		window.location.href = $(this).data('remove');
    	}
    });

    $('.about-section .more-details').click(function(e){
    	e.preventDefault();
    	$(this).siblings('form.job-apply').toggleClass('hidden');
    });








    /*
     * CROAZIERE
     */

    $('#item__info__puntea__select').change(function(){
		$('.lazy-punte').trigger('change');
	})

    // cruise header form submit
    $(document).on('submit', '#croaziere form', function(e) {
	    if($('#croaziere-destinatie option:selected').val() == ''){
	    	$('label[for=croaziere-destinatie] span.error').html('Alege o destinatie');
	    	return false;
	    }else if($('#croaziere-port option:selected').val() == '' ){
	    	$('label[for=croaziere-port] span.error').html('Alege portul de imbarcare');
	    	return false;
	    }else if($('#croaziere-luna option:selected').val() == '' ){
	    	$('label[for=croaziere-luna] span.error').html('Alege luna de plecare');
	    	return false;
	    }
    });

    // cruise header ajax search
	$('.book-form [name="d"]').change(function(){
    	destination = $(this).find('option:selected').val();
    	$('.book-form [name="t"]').prop('disabled', true);
    	$.ajax({
			url: $_base + 'ajax/search/cruise.php',
			data: {type: 'port', destination: destination},
			dataType: 'json',
			success: function(data) {
				$('.book-form [name="p"]').prepend('<option/>');
				$('.book-form [name="p"]').select2('destroy').find('option:not(:first)').remove().end().select2({data: data, language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege portul de imbarcare -"});
				$('.book-form [name="p"]').prop('disabled', false);
				$('.book-form [name="p"]').change(function(){
					port = $(this).find('option:selected').val();
			    	$.ajax({
						url: $_base + 'ajax/search/cruise.php',
						data: {type: 'month', destination: destination, port: port},
						dataType: 'json',
						success: function(data) {
							$('.book-form [name="t"]').prepend('<option/>');
							$('.book-form [name="t"]').select2('destroy').find('option:not(:first)').remove().end().select2({data: data, language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege luna de plecare -"});
							$('.book-form [name="t"]').prop('disabled', false);
						}
					});
				});
			}
		});
    });








    /*
     * TURISM INDIVIDUAL
     */

    // tursim individual header form submit
    $(document).on('submit', '#turism-individual form', function(e) {

        $('#t-individual-check-in').parent().find('span.error').html('');
        $('#t-individual-check-out').parent().find('span.error').html('');

	    if($('#t-individual-tara option:selected').val() == '' ){
	    	$('label[for=t-individual-tara] span.error').html('Alege tara');
	    	return false;
	    }else if($('#t-individual-destinatia option:selected').val() == '' ){
	    	$('label[for=t-individual-destinatia] span.error').html('Alege destinatia');
	    	return false;
	    }

	    advanced = $(this).find('input[name="advanced"]').val();

	    if(advanced == 1){
	    	if($('#t-individual-oras option:selected').val() == '' ){
		    	$('label[for=t-individual-oras] span.error').html('Alege statiunea');
		    	return false;
		    }else if($('#t-individual-check-in').val() == '' ){
                $('#t-individual-check-in').parent().find('span.error').html('Alege data plecare');
                return false;
            }else if($('#t-individual-check-out').val() == '' ){
                $('#t-individual-check-out').parent().find('span.error').html('Alege data retur');
                return false;
            }
	    }

	    country = $('#t-individual-tara').find('option:selected').val();
		destination = $('#t-individual-destinatia').find('option:selected').val();
		city = $('#t-individual-oras').find('option:selected').val();

	    if(advanced != 1){
		    // ajax si redirect
		    $.ajax({
				url: $_base + 'ajax/search/tourism.php',
				data: {type: 'link', country: country, destination: destination, city: city},
				dataType: 'json',
				success: function(data) {
					window.location.href = data.link;
				}
			});

			return false;
		}
    });

    // turism individual header ajax search
	$('#t-individual-tara').change(function(){
    	country = $(this).find('option:selected').val();

    	$('label[for=t-individual-tara] span.error').html('');

    	$('#t-individual-oras').prepend('<option/>');
		$('#t-individual-oras').select2('destroy').find('option:not(:first)').remove().end().select2({data: [], language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege statiunea -"});
		$('#t-individual-oras').prop('disabled', true);

    	$.ajax({
			url: $_base + 'ajax/search/tourism.php',
			data: {type: 'destination', country: country},
			dataType: 'json',
			success: function(data) {
				$('#t-individual-destinatia').prepend('<option/>');
				$('#t-individual-destinatia').select2('destroy').find('option:not(:first)').remove().end().select2({data: data, language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege destinatia -"});
				$('#t-individual-destinatia').prop('disabled', false);

				$('#t-individual-oras').prepend('<option/>');
				$('#t-individual-oras').select2('destroy').find('option:not(:first)').remove().end().select2({data: [],language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege statiunea -"});
				$('#t-individual-oras').prop('disabled', false);

				$('#t-individual-oras').change(function(){
					$('label[for=t-individual-oras] span.error').html('');
				});
			}
		});
    });

    $('#t-individual-destinatia').change(function(){
    	$('label[for=t-individual-destinatia] span.error').html('');
	});

    $('#t-individual-destinatia').change(function(){
    	country = $('#t-individual-tara').find('option:selected').val();
		destination = $(this).find('option:selected').val();
		$('label[for=t-individual-destinatia] span.error').html('');

    	$.ajax({
			url: $_base + 'ajax/search/tourism.php',
			data: {type: 'city', country: country, destination: destination},
			dataType: 'json',
			success: function(data) {
				$('#t-individual-oras').prepend('<option/>');
				$('#t-individual-oras').select2('destroy').find('option:not(:first)').remove().end().select2({data: data, language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege statiunea -"});
				$('#t-individual-oras').prop('disabled', false);

				$('#t-individual-oras').change(function(){
					$('label[for=t-individual-oras] span.error').html('');
				});
			}
		});
	});


    // turism individual sidebar form submit
    $(document).on('submit', '#aside-turism-individual', function(e) {

        $('#aside-t-individual-check-in').parent().find('span.error').html('');
        $('#aside-t-individual-check-out').parent().find('span.error').html('');

	    if($('#aside-t-individual-tara option:selected').val() == '' ){
	    	$('label[for=aside-t-individual-tara] span.error').html('Alege tara');
	    	return false;
	    }else if($('#aside-t-individual-destinatia option:selected').val() == '' ){
	    	$('label[for=aside-t-individual-destinatia] span.error').html('Alege destinatia');
	    	return false;
	    }

    	country = $('#aside-t-individual-tara').find('option:selected').val();
		destination = $('#aside-t-individual-destinatia').find('option:selected').val();
		city = $('#aside-t-individual-oras').find('option:selected').val();

	    advanced = $(this).find('input[name="advanced"]').val();

	    if(advanced == 1){
	    	if($('#aside-t-individual-oras option:selected').val() == '' ){
		    	$('label[for=aside-t-individual-oras] span.error').html('Alege statiunea');
		    	return false;
		    }else if($('#aside-t-individual-check-in').val() == '' ){
                $('#aside-t-individual-check-in').parent().find('span.error').html('Alege data plecare');
                return false;
            }else if($('#aside-t-individual-check-out').val() == '' ){
                $('#aside-t-individual-check-out').parent().find('span.error').html('Alege data retur');
                return false;
            }
	    }

	    if(advanced != 1){
		    // ajax si redirect
		    $.ajax({
				url: $_base + 'ajax/search/tourism.php',
				data: {type: 'link', country: country, destination: destination, city: city},
				dataType: 'json',
				success: function(data) {
					window.location.href = data.link;
				}
			});

			return false;
		}
    });

    // turism individual sidebar ajax search
	$('#aside-t-individual-tara').change(function(){
    	country = $(this).find('option:selected').val();

    	$('label[for=aside-t-individual-tara] span.error').html('');

    	$('#aside-t-individual-oras').prepend('<option/>');
		$('#aside-t-individual-oras').select2('destroy').find('option:not(:first)').remove().end().select2({data: [], language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege statiunea -"});
		$('#aside-t-individual-oras').prop('disabled', true);

    	$.ajax({
			url: $_base + 'ajax/search/tourism.php',
			data: {type: 'destination', country: country},
			dataType: 'json',
			success: function(data) {
				$('#aside-t-individual-destinatia').prepend('<option/>');
				$('#aside-t-individual-destinatia').select2('destroy').find('option:not(:first)').remove().end().select2({data: data, language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege destinatia -"});
				$('#aside-t-individual-destinatia').prop('disabled', false);

				$('#aside-t-individual-oras').prepend('<option/>');
				$('#aside-t-individual-oras').select2('destroy').find('option:not(:first)').remove().end().select2({data: [],language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege statiunea -"});
				$('#aside-t-individual-oras').prop('disabled', false);

				$('#aside-t-individual-oras').change(function(){
					$('label[for=aside-t-individual-oras] span.error').html('');
				});
			}
		});
    });

    $('#aside-t-individual-destinatia').change(function(){
    	$('label[for=aside-t-individual-destinatia] span.error').html('');
	});

    $('#aside-t-individual-destinatia').change(function(){
    	country = $('#aside-t-individual-tara').find('option:selected').val();
		destination = $(this).find('option:selected').val();
		$('label[for=aside-t-individual-destinatia] span.error').html('');

    	$.ajax({
			url: $_base + 'ajax/search/tourism.php',
			data: {type: 'city', country: country, destination: destination},
			dataType: 'json',
			success: function(data) {
				$('#aside-t-individual-oras').prepend('<option/>');
				$('#aside-t-individual-oras').select2('destroy').find('option:not(:first)').remove().end().select2({data: data, language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege statiunea -"});
				$('#aside-t-individual-oras').prop('disabled', false);

				$('#aside-t-individual-oras').change(function(){
					$('label[for=aside-t-individual-oras] span.error').html('');
				});
			}
		});
	});




    /*
     * TURISM INTERN
     */

    // turism intern header form submit
    $(document).on('submit', '#turism-intern form', function(e) {

        $('#t-intern-check-in').parent().find('span.error').html('');
        $('#t-intern-check-out').parent().find('span.error').html('');

	    if($('#t-intern-programul option:selected').val() == '' ){
	    	$('label[for=t-intern-programul] span.error').html('Alege programul');
	    	return false;
	    }

	    advanced = $(this).find('input[name="advanced"]').val();

	    if(advanced == 1){
	    	if($('#t-intern-statiunea option:selected').val() == '' ){
		    	$('label[for=t-intern-statiunea] span.error').html('Alege statiunea');
		    	return false;
		    }else if($('#t-intern-check-in').val() == '' ){
                $('#t-intern-check-in').parent().find('span.error').html('Alege data plecare');
                return false;
            }else if($('#t-intern-check-out').val() == '' ){
                $('#t-intern-check-out').parent().find('span.error').html('Alege data retur');
                return false;
            }
	    }

	    program = $('#t-intern-programul').find('option:selected').val();
	    tag = $('#t-intern-programul').find('option:selected').data('type');
		city = $('#t-intern-statiunea').find('option:selected').val();

	    $(this).find('input[name="location_type"]').val(tag);

	    if(advanced != 1){
		    // ajax si redirect
		    $.ajax({
				url: $_base + 'ajax/search/tourism_intern.php',
				data: {type: 'link', program: program, tag: tag, city: city},
				dataType: 'json',
				success: function(data) {
					window.location.href = data.link;
				}
			});

			return false;
		}

    });

    // turism intern header ajax search
	$('#t-intern-programul').change(function(){
    	program = $(this).find('option:selected').val();
    	tag = $(this).find('option:selected').data('type');

    	$('label[for=t-intern-programul] span.error').html('');

    	$.ajax({
			url: $_base + 'ajax/search/tourism_intern.php',
			data: {type: 'city', program: program, tag: tag},
			dataType: 'json',
			success: function(data) {
				$('#t-intern-statiunea').prepend('<option/>');
				$('#t-intern-statiunea').select2('destroy').find('option:not(:first)').remove().end().select2({data: data, language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege statiunea -"});
				$('#t-intern-statiunea').prop('disabled', false);

				$('#t-intern-statiunea').change(function(){
					$('label[for=t-intern-statiunea] span.error').html('');
				});
			}
		});
    });


    // turism intern sidebar form submit
    $(document).on('submit', '#aside-turism-intern', function(e) {

        $('#aside-t-intern-check-in').parent().find('span.error').html('');
        $('#aside-t-intern-check-out').parent().find('span.error').html('');

	    if($('#aside-t-intern-programul option:selected').val() == '' ){
	    	$('label[for=aside-t-intern-programul] span.error').html('Alege programul');
	    	return false;
	    }

	    advanced = $(this).find('input[name="advanced"]').val();

	    if(advanced == 1){
	    	if($('#aside-t-intern-statiunea option:selected').val() == '' ){
		    	$('label[for=aside-t-intern-statiunea] span.error').html('Alege statiunea');
		    	return false;
		    }else if($('#aside-t-intern-check-in').val() == '' ){
                $('#aside-t-intern-check-in').parent().find('span.error').html('Alege data plecare');
                return false;
            }else if($('#aside-t-intern-check-out').val() == '' ){
                $('#aside-t-intern-check-out').parent().find('span.error').html('Alege data retur');
                return false;
            }
	    }

	    program = $('#aside-t-intern-programul').find('option:selected').val();
	    tag = $('#aside-t-intern-programul').find('option:selected').data('type');
		city = $('#aside-t-intern-statiunea').find('option:selected').val();

	    $(this).find('input[name="location_type"]').val(tag);

	    if(advanced != 1){
		    // ajax si redirect
		    $.ajax({
				url: $_base + 'ajax/search/tourism_intern.php',
				data: {type: 'link', program: program, tag: tag, city: city},
				dataType: 'json',
				success: function(data) {
					window.location.href = data.link;
				}
			});

			return false;
		}
    });

    // turism intern sidebar ajax search
	$('#aside-t-intern-programul').change(function(){
    	program = $(this).find('option:selected').val();
    	tag = $(this).find('option:selected').data('type');

    	$('label[for=aside-t-intern-programul] span.error').html('');

    	$.ajax({
			url: $_base + 'ajax/search/tourism_intern.php',
			data: {type: 'city', program: program, tag: tag},
			dataType: 'json',
			success: function(data) {
				$('#aside-t-intern-statiunea').prepend('<option/>');
				$('#aside-t-intern-statiunea').select2('destroy').find('option:not(:first)').remove().end().select2({data: data, language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege statiunea -"});
				$('#aside-t-intern-statiunea').prop('disabled', false);

				$('#aside-t-intern-statiunea').change(function(){
					$('label[for=aside-t-intern-statiunea] span.error').html('');
				});
			}
		});
    });






    /*
     * CIRCUITE
     */

    // circuite header form submit
    $(document).on('submit', '#circuite form', function(e) {
	    if($('#circuite-continent option:selected').val() == '' && $('#circuite-luna-plecare option:selected').val() == ''){
	    	$('label[for=circuite-tara] span.error').html('Alegeti o tara sau o luna de plecare');
	    	return false;
	    }

	    continent = $('#circuite-continent').find('option:selected').val();
	    country = $('#circuite-tara').find('option:selected').val();
	    month = $('#circuite-luna-plecare').find('option:selected').val();

	    bus = $('#circuite-bus').is(':checked');
    	plane = $('#circuite-airplane').is(':checked');
    	if(plane && !bus){
    		transport = 'plane';
    	}else if(!plane && bus){
    		transport = 'bus';
    	}else{
    		transport = '';
    	}

    	advanced = $(this).find('input[name="advanced"]').val();

	    if(advanced == 1){
	    	if($('#circuite-tara option:selected').val() == ''){
		    	$('label[for=circuite-tara] span.error').html('Alegeti o tara');
		    	return false;
		    }
	    	if($('#circuite-luna-plecare option:selected').val() == ''){
		    	$('label[for=circuite-luna-plecare] span.error').html('Alegeti luna de plecare');
		    	return false;
		    }
	    }

    	if(advanced != 1){
		    // ajax si redirect
		    $.ajax({
				url: $_base + 'ajax/search/circuit.php',
				data: {type: 'link', continent: continent, country: country, month: month, transport: transport},
				dataType: 'json',
				success: function(data) {
					window.location.href = data.link;
				}
			});

		    return false;
	    }
    });

    // circuite header ajax search
	$('#circuite-continent').change(function(){
    	continent = $(this).find('option:selected').val();
    	$('#circuite-tara').prop('disabled', true);

    	bus = $('#circuite-bus').is(':checked');
    	plane = $('#circuite-airplane').is(':checked');

    	if(plane && !bus){
    		transport = 'plane';
    	}else if(!plane && bus){
    		transport = 'bus';
    	}else{
    		transport = '';
    	}

    	$('label[for=circuite-tara] span.error').html('');

    	$.ajax({
			url: $_base + 'ajax/search/circuit.php',
			data: {type: 'country', continent: continent, transport: transport},
			dataType: 'json',
			success: function(data) {
				$('#circuite-tara').prepend('<option/>');
				$('#circuite-tara').select2('destroy').find('option:not(:first)').remove().end().select2({data: data, language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege tara -"});
				$('#circuite-tara').prop('disabled', false);
			}
		});

		$.ajax({
			url: $_base + 'ajax/search/circuit.php',
			data: {type: 'month', continent: continent, transport: transport},
			dataType: 'json',
			success: function(data) {
				$('#circuite-luna-plecare').prepend('<option/>');
				$('#circuite-luna-plecare').select2('destroy').find('option:not(:first)').remove().end().select2({data: data, language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege luna de plecare -"});
				$('#circuite-luna-plecare').prop('disabled', false);
			}
		});
    });

    $('#circuite-tara').change(function(){
		country = $(this).find('option:selected').val();
		$('label[for=circuite-tara] span.error').html('');

    	$.ajax({
			url: $_base + 'ajax/search/circuit.php',
			data: {type: 'month', continent: continent, country: country, transport: transport},
			dataType: 'json',
			success: function(data) {
				$('#circuite-luna-plecare').prepend('<option/>');
				$('#circuite-luna-plecare').select2('destroy').find('option:not(:first)').remove().end().select2({data: data, language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege luna de plecare -"});
				$('#circuite-luna-plecare').prop('disabled', false);
			}
		});
	});

    $('#circuite-luna-plecare').change(function(){
    	$('label[for=circuite-tara] span.error').html('');
    });

    $('#circuite-bus, #circuite-airplane').change(function(){
    	$('label[for=circuite-tara] span.error').html('');

		bus = $('#circuite-bus').is(':checked');
    	plane = $('#circuite-airplane').is(':checked');

    	if(plane && !bus){
    		transport = 'plane';
    	}else if(!plane && bus){
    		transport = 'bus';
    	}else{
    		transport = '';
    	}

    	$('#circuite-tara').prepend('<option/>');
		$('#circuite-tara').select2('destroy').find('option:not(:first)').remove().end().select2({data: [], language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege tara -"});
		$('#circuite-tara').prop('disabled', true);

		$.ajax({
			url: $_base + 'ajax/search/circuit.php',
			data: {type: 'continent', transport: transport},
			dataType: 'json',
			success: function(data) {
				$('#circuite-continent').prepend('<option/>');
				$('#circuite-continent').select2('destroy').find('option:not(:first)').remove().end().select2({data: data, language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege continentul -"});
				$('#circuite-continent').prop('disabled', false);
			}
		});

		$.ajax({
			url: $_base + 'ajax/search/circuit.php',
			data: {type: 'month', transport: transport},
			dataType: 'json',
			success: function(data) {
				$('#circuite-luna-plecare').prepend('<option/>');
				$('#circuite-luna-plecare').select2('destroy').find('option:not(:first)').remove().end().select2({data: data, language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege luna de plecare -"});
				$('#circuite-luna-plecare').prop('disabled', false);
			}
		});
    });

	// circuite sidebar ajax search
	$('#aside-circuite-continent').change(function(){
    	continent = $(this).find('option:selected').val();

    	bus = $('#aside-circuite-bus').is(':checked');
    	plane = $('#aside-circuite-avion').is(':checked');

    	if(plane && !bus){
    		transport = 'plane';
    	}else if(!plane && bus){
    		transport = 'bus';
    	}else{
    		transport = '';
    	}

    	$('#aside-circuite-form span.error').html('');

    	$('#aside-circuite-tara').prepend('<option/>');
		$('#aside-circuite-tara').select2('destroy').find('option:not(:first)').remove().end().select2({data: [], language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege tara -"});
		$('#aside-circuite-tara').prop('disabled', true);

		$('#aside-circuite-plecare-din').prepend('<option/>');
		$('#aside-circuite-plecare-din').select2('destroy').find('option:not(:first)').remove().end().select2({data: [], language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege orasul -"});
		$('#aside-circuite-plecare-din').prop('disabled', true);

		$('#aside-circuite-plecare-luna').prepend('<option/>');
		$('#aside-circuite-plecare-luna').select2('destroy').find('option:not(:first)').remove().end().select2({data: [], language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege luna de plecare -"});
		$('#aside-circuite-plecare-luna').prop('disabled', true);

    	$.ajax({
			url: $_base + 'ajax/search/circuit.php',
			data: {type: 'country', continent: continent, transport: transport},
			dataType: 'json',
			success: function(data) {
				$('#aside-circuite-tara').prepend('<option/>');
				$('#aside-circuite-tara').select2('destroy').find('option:not(:first)').remove().end().select2({data: data, language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege tara -"});
				$('#aside-circuite-tara').prop('disabled', false);
			}
		});
    });

    $('#aside-circuite-tara').change(function(){
    	continent = $(this).find('option:selected').val();

    	bus = $('#aside-circuite-bus').is(':checked');
    	plane = $('#aside-circuite-avion').is(':checked');

    	if(plane && !bus){
    		transport = 'plane';
    	}else if(!plane && bus){
    		transport = 'bus';
    	}else{
    		transport = '';
    	}

		country = $(this).find('option:selected').val();

		$('#aside-circuite-form span.error').html('');

		$('#aside-circuite-plecare-din').prepend('<option/>');
		$('#aside-circuite-plecare-din').select2('destroy').find('option:not(:first)').remove().end().select2({data: [], language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege orasul -"});
		$('#aside-circuite-plecare-din').prop('disabled', true);

		$('#aside-circuite-plecare-luna').prepend('<option/>');
		$('#aside-circuite-plecare-luna').select2('destroy').find('option:not(:first)').remove().end().select2({data: [], language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege luna de plecare -"});
		$('#aside-circuite-plecare-luna').prop('disabled', true);

    	$.ajax({
			url: $_base + 'ajax/search/circuit.php',
			data: {type: 'from', continent: continent, country: country, transport: transport},
			dataType: 'json',
			success: function(data) {
				$('#aside-circuite-plecare-din').prepend('<option/>');
				$('#aside-circuite-plecare-din').select2('destroy').find('option:not(:first)').remove().end().select2({data: data, language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege orasul -"});
				$('#aside-circuite-plecare-din').prop('disabled', false);
			}
		});
	});

	$('#aside-circuite-plecare-din').change(function(){
		continent = $('#aside-circuite-continent').find('option:selected').val();

    	bus = $('#aside-circuite-bus').is(':checked');
    	plane = $('#aside-circuite-avion').is(':checked');

    	if(plane && !bus){
    		transport = 'plane';
    	}else if(!plane && bus){
    		transport = 'bus';
    	}else{
    		transport = '';
    	}

    	country = $('#aside-circuite-tara').find('option:selected').val();

		from = $(this).find('option:selected').val();

		$('#aside-circuite-form span.error').html('');

		$('#aside-circuite-plecare-luna').prepend('<option/>');
		$('#aside-circuite-plecare-luna').select2('destroy').find('option:not(:first)').remove().end().select2({data: [], language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege luna de plecare -"});
		$('#aside-circuite-plecare-luna').prop('disabled', true);

    	$.ajax({
			url: $_base + 'ajax/search/circuit.php',
			data: {type: 'month', continent: continent, country: country, transport: transport, from: from},
			dataType: 'json',
			success: function(data) {
				$('#aside-circuite-plecare-luna').prepend('<option/>');
				$('#aside-circuite-plecare-luna').select2('destroy').find('option:not(:first)').remove().end().select2({data: data, language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege luna de plecare -"});
				$('#aside-circuite-plecare-luna').prop('disabled', false);
			}
		});
	});

    $('#aside-circuite-avion, #aside-circuite-bus').change(function(){
    	$('#aside-circuite-form span.error').html('');

		bus = $('#aside-circuite-bus').is(':checked');
    	plane = $('#aside-circuite-avion').is(':checked');

    	if(plane && !bus){
    		transport = 'plane';
    	}else if(!plane && bus){
    		transport = 'bus';
    	}else{
    		transport = '';
    	}

    	$('#aside-circuite-tara').prepend('<option/>');
		$('#aside-circuite-tara').select2('destroy').find('option:not(:first)').remove().end().select2({data: [], language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege tara -"});
		$('#aside-circuite-tara').prop('disabled', true);

		$('#aside-circuite-plecare-din').prepend('<option/>');
		$('#aside-circuite-plecare-din').select2('destroy').find('option:not(:first)').remove().end().select2({data: [], language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege orasul -"});
		$('#aside-circuite-plecare-din').prop('disabled', true);

		$('#aside-circuite-plecare-luna').prepend('<option/>');
		$('#aside-circuite-plecare-luna').select2('destroy').find('option:not(:first)').remove().end().select2({data: [], language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege luna de plecare -"});
		$('#aside-circuite-plecare-luna').prop('disabled', true);

		$.ajax({
			url: $_base + 'ajax/search/circuit.php',
			data: {type: 'continent', transport: transport},
			dataType: 'json',
			success: function(data) {
				$('#aside-circuite-continent').prepend('<option/>');
				$('#aside-circuite-continent').select2('destroy').find('option:not(:first)').remove().end().select2({data: data, language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege continentul -"});
				$('#aside-circuite-continent').prop('disabled', false);
			}
		});

    });

     // circuite header form submit
    $(document).on('submit', '#aside-circuite-form', function(e) {
	    if($('#aside-circuite-continent option:selected').val() == '' || $('#aside-circuite-tara option:selected').val() == ''){
	    	$('#aside-circuite-form span.error').html('Selectati destinatia.');
	    	return false;
	    }

	    continent = $('#aside-circuite-continent').find('option:selected').val();
	    country = $('#aside-circuite-tara').find('option:selected').val();
	    month = $('#aside-circuite-plecare-luna').find('option:selected').val();
	    from = $('#aside-circuite-plecare-din').find('option:selected').val();

	    bus = $('#aside-circuite-bus').is(':checked');
    	plane = $('#aside-circuite-avion').is(':checked');
    	if(plane && !bus){
    		transport = 'plane';
    	}else if(!plane && bus){
    		transport = 'bus';
    	}else{
    		transport = '';
    	}

	    // ajax si redirect
	    $.ajax({
			url: $_base + 'ajax/search/circuit.php',
			data: {type: 'link', continent: continent, country: country, month: month, from: from, transport: transport},
			dataType: 'json',
			success: function(data) {
				window.location.href = data.link;
			}
		});

	    return false;
    });









    /*
     * CHARTERE
     */

    // header form submit
    $(document).on('submit', '#chartere form', function(e) {

        $('#chartere-check-in').parent().find('span.error').html('');
        $('#chartere-check-out').parent().find('span.error').html('');

	    if($('#chartere-tara option:selected').val() == '' ){
	    	$('label[for=chartere-tara] span.error').html('Alege tara');
	    	return false;
	    }else if($('#chartere-destinatia option:selected').val() == '' ){
	    	$('label[for=chartere-destinatia] span.error').html('Alege destinatia');
	    	return false;
	    }else if($('#chartere-oras-plecare option:selected').val() == '' ){
	    	$('label[for=chartere-oras-plecare] span.error').html('Alege orasul de plecare');
	    	return false;
	    }

	    advanced = $(this).find('input[name="advanced"]').val();

	    country = $('#chartere-tara').find('option:selected').val();
	    city_to = $('#chartere-destinatia').find('option:selected').val();
	    city_from = $('#chartere-oras-plecare').find('option:selected').val();

        if(advanced == 1){
            if($('#chartere-check-in').val() == '' ){
                $('#chartere-check-in').parent().find('span.error').html('Alege data plecare');
                return false;
            }else if($('#chartere-check-out').val() == '' ){
                $('#chartere-check-out').parent().find('span.error').html('Alege data retur');
                return false;
            }
        }

	    if(advanced != 1){
		    // ajax si redirect
		    $.ajax({
				url: $_base + 'ajax/search/charter.php',
				data: {type: 'link', country: country, city_to: city_to, city_from: city_from},
				dataType: 'json',
				success: function(data) {
					window.location.href = data.link;
				}
			});

		    return false;
		}

    });

	// charters header ajax search
	$('#chartere-tara').change(function(){
    	country = $(this).find('option:selected').val();

    	$('label[for=chartere-tara] span.error').html('');

    	$('#chartere-oras-plecare').prepend('<option/>');
		$('#chartere-oras-plecare').select2('destroy').find('option:not(:first)').remove().end().select2({data: [], language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege orasul -"});
		$('#chartere-oras-plecare').prop('disabled', true);

    	$.ajax({
			url: $_base + 'ajax/search/charter.php',
			data: {type: 'city_to', country: country},
			dataType: 'json',
			success: function(data) {
				$('#chartere-destinatia').prepend('<option/>');
				$('#chartere-destinatia').select2('destroy').find('option:not(:first)').remove().end().select2({data: data, language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege destinatia -"});
				$('#chartere-destinatia').prop('disabled', false);
			}
		});
    });

    $('#chartere-destinatia').change(function(){
    	country = $('#chartere-tara').find('option:selected').val();
		city_to = $(this).find('option:selected').val();
		$('label[for=chartere-destinatia] span.error').html('');

    	$.ajax({
			url: $_base + 'ajax/search/charter.php',
			data: {type: 'city_from', country: country, city_to: city_to},
			dataType: 'json',
			success: function(data) {
				$('#chartere-oras-plecare').prepend('<option/>');
				$('#chartere-oras-plecare').select2('destroy').find('option:not(:first)').remove().end().select2({data: data, language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege orasul -"});
				$('#chartere-oras-plecare').prop('disabled', false);

				$('#chartere-oras-plecare').change(function(){
					$('label[for=chartere-oras-plecare] span.error').html('');
				});
			}
		});
	});


    // sidebar form submit
    $(document).on('submit', '#aside-chartere', function(e) {

        $('#aside-chartere-check-in').parent().find('span.error').html('');
        $('#aside-chartere-check-out').parent().find('span.error').html('');

	    if($('#aside-chartere-tara option:selected').val() == '' ){
	    	$('label[for=aside-chartere-tara] span.error').html('Alege tara');
	    	return false;
	    }else if($('#aside-chartere-destinatia option:selected').val() == '' ){
	    	$('label[for=aside-chartere-destinatia] span.error').html('Alege destinatia');
	    	return false;
	    }else if($('#aside-chartere-plecare-din option:selected').val() == '' ){
	    	$('label[for=aside-chartere-plecare-din] span.error').html('Alege orasul de plecare');
	    	return false;
	    }

	   	advanced = $(this).find('input[name="advanced"]').val();

	   	country = $('#aside-chartere-tara').find('option:selected').val();
	    city_to = $('#aside-chartere-destinatia').find('option:selected').val();
	    city_from = $('#aside-chartere-plecare-din').find('option:selected').val();

        if(advanced == 1){
            if($('#aside-chartere-check-in').val() == '' ){
    	    	$('#aside-chartere-check-in').parent().find('span.error').html('Alege data plecare');
    	    	return false;
            }else if($('#aside-chartere-check-out').val() == '' ){
    	    	$('#aside-chartere-check-out').parent().find('span.error').html('Alege data retur');
    	    	return false;
            }
        }

	    if(advanced != 1){
		    // ajax si redirect
		    $.ajax({
				url: $_base + 'ajax/search/charter.php',
				data: {type: 'link', country: country, city_to: city_to, city_from: city_from},
				dataType: 'json',
				success: function(data) {
					window.location.href = data.link;
				}
			});

		    return false;
        }
    });

	// charters sidebar ajax search
	$('#aside-chartere-tara').change(function(){
    	country = $(this).find('option:selected').val();

    	$('label[for=aside-chartere-tara] span.error').html('');

    	$('#aside-chartere-plecare-din').prepend('<option/>');
		$('#aside-chartere-plecare-din').select2('destroy').find('option:not(:first)').remove().end().select2({data: [], language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege orasul -"});
		$('#aside-chartere-plecare-din').prop('disabled', true);

    	$.ajax({
			url: $_base + 'ajax/search/charter.php',
			data: {type: 'city_to', country: country},
			dataType: 'json',
			success: function(data) {
				$('#aside-chartere-destinatia').prepend('<option/>');
				$('#aside-chartere-destinatia').select2('destroy').find('option:not(:first)').remove().end().select2({data: data, language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege destinatia -"});
				$('#aside-chartere-destinatia').prop('disabled', false);
			}
		});
    });

    $('#aside-chartere-destinatia').change(function(){
    	country = $('#aside-chartere-tara').find('option:selected').val();
		city_to = $(this).find('option:selected').val();
		$('label[for=aside-chartere-destinatia] span.error').html('');

    	$.ajax({
			url: $_base + 'ajax/search/charter.php',
			data: {type: 'city_from', country: country, city_to: city_to},
			dataType: 'json',
			success: function(data) {
				$('#aside-chartere-plecare-din').prepend('<option/>');
				$('#aside-chartere-plecare-din').select2('destroy').find('option:not(:first)').remove().end().select2({data: data, language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege orasul -"});
				$('#aside-chartere-plecare-din').prop('disabled', false);

				$('#aside-chartere-plecare-din').change(function(){
					$('label[for=aside-chartere-plecare-din] span.error').html('');
				});
			}
		});
	});






     /*
     * TICKETS
     */

    // header form submit
    $(document).on('submit', '#bilete-avion form', function(e) {

    	if($('#bilete-tara option:selected').val() == '' ){
	    	$('label[for=bilete-tara] span.error').html('Alegeti o tara');
	    	return false;
	    }

	    if( $('#bilete-destinatia option:selected').val() == '' ){
	    	$('label[for=bilete-destinatia] span.error').html('Alegeti o destinatie');
	    	return false;
	    }

	    if( $('#bilete-oras-plecare option:selected').val() == '' ){
	    	$('label[for=bilete-oras-plecare] span.error').html('Alegeti orasul de plecare');
	    	return false;
	    }

	    country = $('#bilete-tara').find('option:selected').val();
	    city = $('#bilete-destinatia').find('option:selected').val();
	    city_from = $('#bilete-oras-plecare').find('option:selected').val();


	    // ajax si redirect
	    $.ajax({
			url: $_base + 'ajax/search/ticket.php',
			data: {type: 'link', country: country, city: city, city_from: city_from},
			dataType: 'json',
			success: function(data) {
				window.location.href = data.link;
			}
		});

	    return false;
    });

    // tickets header ajax search
	$('#bilete-tara').change(function(){
    	country = $(this).find('option:selected').val();
    	$('#bilete-destinatia').prop('disabled', false);
    	$('label[for=bilete-tara] span.error').html('');

    	$('#bilete-oras-plecare').prepend('<option/>');
		$('#bilete-oras-plecare').select2('destroy').find('option:not(:first)').remove().end().select2({data: [], language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege orasul -"});
		$('#bilete-oras-plecare').prop('disabled', true);

    	$.ajax({
			url: $_base + 'ajax/search/ticket.php',
			data: {type: 'city_to', country: country},
			dataType: 'json',
			success: function(data) {
				$('#bilete-destinatia').prepend('<option/>');
				$('#bilete-destinatia').select2('destroy').find('option:not(:first)').remove().end().select2({data: data, language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege destinatia -"});
				$('#bilete-destinatia').prop('disabled', false);
			}
		});
    });

	$('#bilete-destinatia').change(function(){
		country = $('#bilete-tara').find('option:selected').val();
		city_to = $(this).find('option:selected').val();
		$('label[for=bilete-destinatia] span.error').html('');
    	$.ajax({
			url: $_base + 'ajax/search/ticket.php',
			data: {type: 'city_from', country: country, city_to: city_to},
			dataType: 'json',
			success: function(data) {
				$('#bilete-oras-plecare').prepend('<option/>');
				$('#bilete-oras-plecare').select2('destroy').find('option:not(:first)').remove().end().select2({data: data, language: "ro", minimumResultsForSearch: Infinity, placeholder: "- Alege orasul -"});
				$('#bilete-oras-plecare').prop('disabled', false);

				$('#bilete-oras-plecare').change(function(){
					$('label[for=bilete-oras-plecare] span.error').html('');
				});
			}
		});
	});




	/*
	 * SIDE SEARCH
	 */

	$(document).on('submit', '#search-hotel', function(e) {

    	search = $('.input-search-aside').val();

    	if(search != ""){

    		link = location.href;
    		query = link.split('?');

    		if(query[1] != "" && typeof query[1] !== "undefined"){
    			new_link = query[0] + "?";

    			params = query[1].split('&');

    			if(params){
    				found_q = false;
	    			for(i=0; i<params.length; i++){
	    				if(params[i] != ""){
		    				key_val = params[i].split('=');
		    				if(key_val[0] == "q"){
		    					new_link += "&q=" + search;
		    					found_q = true;
		    				}else{
		    					new_link += "&" + params[i];
		    				}
	    				}
	    			}
	    			if(!found_q){
	    				new_link += "&q=" + search;
	    			}
    			}else{
    				new_link = query[0] + "?&q=" + search;
    			}
    		}else{
    			new_link = query[0] + "?&q=" + search;
    		}

    		location.href = new_link;
    	}

    	return false;
    });




	/*
	 * TESTIMONIALE
	 */

	$("body").on( 'click', "#country-testimonials option:first", function(e) {
    	 window.location.href = $_base + 'testimoniale/';
    });

    $("#country-testimonials").change( function(e) {
     	var id = $(this).find('option:selected').val();
     	//return false;
     	if(id == '0'){
        	window.location.href = $_base + 'testimoniale/';
        }else{
        	window.location.href = '?c=' + id;
        }
        $('#all-testimonials').parent().removeClass('hidden');
    });

    $("#all-testimonials").click( function(e) {
       e.preventDefault();
       window.location.href = $_base + 'testimoniale/';
    });


    $("#destination-testimonials").change( function(e) {
       var url = $(this).find('option:selected').val();
       window.location.href = url;
    });

	if($('.grid').length > 0){
	    var m = new Masonry($('.grid').get()[0], {
	        itemSelector: ".guid-client-col"
	    });
	}



	// $('.vd-categories .category .icon').click(function(){
		// $(this).siblings("img").addClass('img-float');
		// $(this).parent().addClass('category-open');
		// $(this).siblings().removeClass('hidden');
		// $(this).closest('.col-md-4').siblings().addClass('hidden');
		// $(this).closest('.col-md-4').addClass('open-div');
		// $(this).addClass('hidden');
	// })

	$('.vd-categories .close-cat').click(function(e){
		e.preventDefault();
		$(this).addClass('hidden');
		$(this).siblings('img').removeClass('img-float');
		$(this).closest('.category').removeClass('category-open');
		$(this).siblings().not("img, .overlay").addClass('hidden');
		$(this).closest('.col-md-4').siblings().removeClass('hidden');
		$(this).closest('.col-md-4').removeClass('open-div');
		$(this).siblings(".icon").removeClass('hidden');
		$('.vacations-form-wrapper').hide();
	})

	$('.vacations-form-wrapper form').submit(function(){
		console.log('ceva');
	});


	$('.agencies-form-wrapper #page-location').val($('.contact-form-wrapper').data('location'));




      $('.btn-blue.wico').click(function(e){
      	e.preventDefault();
      	$('#exampleModalLong').modal('show')
      	var click = $(this);
      	$("#exampleModalLong").on("shown.bs.modal", function () {
      		var x =  click.data('lat');
      		var y =  click.data('long');
      		var title =  click.data('title');
      		var url =  click.data('url');
      		var img =  click.data('img');

    			initMap(x, y, title, url, img);
		});
      })



      $('.show-full-text').on('click', function(e) {
  		e.preventDefault();
  		$(this).parent().find('p').slice(2).slideToggle('slow');
          $(this).parent().find('ul').slideToggle('slow');
          $(this).parent().find('ol').slideToggle('slow');

  		 if ($(this).text() == "Citeste mai mult")
  		       $(this).text("Citeste mai putin")
  		    else
  		       $(this).text("Citeste mai mult");

  	});

  	$('.show-full-text').parent('.full-text-toggle:not(.cr)').each(function(){
      	$items_to_hide = $(this).find('p');
  	    if($items_to_hide.length <= 2){
  	    	$(this).find('.show-full-text').addClass("hidden");
  	    }
     });

     $('.show-full-text').parent('.cr').each(function(){
      	$items_to_hide = $(this).find('p');
  	    if($items_to_hide.length <= 4){
  	    	$(this).find('.show-full-text').addClass("hidden");
  	    }
     });


	$('#city-test').select2({
   		 language: "ro",
  	});

	$('#country-test').select2({
    	language: "ro",
  	});

	$('#country-test').change(function(){
    	country = $(this).find('option:selected').val();
    	//$('#city-test').prop('disabled', true);
    	$.ajax({
			url: $_base + 'ajax/search/city.php',
			data: {type: 'city', country: country},
			dataType: 'json',
			success: function(data) {
				$('#city-test').prepend('<option/>');
				$('#city-test').select2('destroy').find('option:not(:first)').remove().end().select2({data: data, language: "ro", minimumResultsForSearch: Infinity, placeholder: "Alege oras"});
				$('#city-test').prop('disabled', false);
			}
		});
	});

	$('#open-res-form').click(function(e){
		e.preventDefault();
		$('#res-form').toggleClass('hidden');
	})



	$('.item__info__print').click(function(){
		window.print();
	});


	$('.book_now').click(function(e){
		e.preventDefault();
		$('html, body').animate({
        	scrollTop: $("#book_form").offset().top - 150
        }, 'slow');
	});







	// newsletter footer form
	$('.ajax-form').on('submit', function(e){
        e.preventDefault();
        var $this = $(this);
        $.ajax({
            url: $this.attr('action'),
            type: $this.attr('method'),
            dataType: 'json',
            data: $this.serialize()
        }).done(function(res){
            $this.find('.ajax-success, .ajax-error').slideUp();
            if(res.status == 'success') {
                $this.find('.ajax-body').hide();
                $this.find('.ajax-success').html(res.message).slideDown();
            }
            if(res.status == 'error') {
                $this.find('.ajax-error').html(res.message).slideDown();
            }
        });
    });

    $(".swiper-slide .swiper-consultanti__sub").dotdotdot({
		 ellipsis     : '… ',
         watch        : true,
         wrap         : 'letter',
         height       : parseInt( $('.swiper-slide .swiper-consultanti__sub p').css('line-height'), 10) * 4, // this is the number of lines
         lastCharacter: {
         remove: [ ' ', ',', ';', '.', '!', '?' ],
         noEllipsis: []
         },
		 after		: 'a.readmore',
		 callback: dotdotdotCallback
	});

	// $('body').on('click', '.swiper-slide .readmore', function(e){
		// e.preventDefault();
		// $(this).closest('.swiper-consultanti__sub').trigger("destroy");
		// $(this).parent().siblings('.readmore').hide();
	// });


    $(".swiper-consultanti .swiper-slide .swiper-consultanti__sub").on('click', 'a', function (e) {
		e.preventDefault();
        if ($(this).text() == "Vezi mai multe") {
            var div = $(this).closest('.swiper-consultanti .swiper-slide .swiper-consultanti__sub');
            div.trigger('destroy').find('a.readmore').hide();
            div.css('max-height', '');
            $("a.less", div).show();
        } else {
            $(this).closest('.swiper-slide .swiper-consultanti__sub').css("max-height", "100px").dotdotdot({
                after: "a",
                callback: dotdotdotCallback
            });
            $("a.less", div).hide();
        }
    });

    function dotdotdotCallback(isTruncated, originalContent) {
        if (!isTruncated) {
            $("a", this).remove();
        }
    }






	$(".dob.adult").datepicker({
        changeMonth: true,
        changeYear: true,
		numberOfMonths: 1,
		firstDay: 1,
		dateFormat: 'dd.mm.yy',
		maxDate: '-18Y',
	});
	$(".dob.child").datepicker({
        changeMonth: true,
        changeYear: true,
        firstDay: 1,
		numberOfMonths: 1,
		dateFormat: 'dd.mm.yy',
		minDate: '-18Y',
	});

	$('#select_agencies').select2({
	    language: "ro",
	    minimumResultsForSearch: 5,
	    placeholder: $(this).attr('data-placeholder')
	});

	$('#select_agencies').change(function(){
    	city = $(this).find('option:selected').val();
    	//$('#city-test').prop('disabled', true);
    	$.ajax({
			url: $_base + 'ajax/search/agency.php',
			data: {city: city},
			dataType: 'json',
			success: function(data) {
				$('#id_agency').prepend('<option/>');
				$('#id_agency').select2('destroy').find('option:not(:first)').remove().end().select2({data: data, language: "ro", minimumResultsForSearch: Infinity, placeholder: "Alege agentia"});
				$('#id_agency').prop('disabled', false);
			}
		});
	});

	var price_left = parseInt($('#slider-range-filter .ui-slider-handle:first-of-type').css("left"));
	var price_right = parseInt($('#slider-range-filter .ui-slider-handle:nth-of-type(2)').css("left"));


	if((price_right - price_left) < 67){
		var price_diff = (price_right - price_left) / 2;
		if((price_right - price_left) < 30){
			var price_diff = 30;
		}
		$('.price-range-min').css('left', '-'+price_diff+'px');
		$('.price-range-max').css('right', '-'+price_diff+'px');
	}

	 var swiper = new Swiper('.swiper-container.swiper-chartere-head', {
        pagination: '.swiper-container.swiper-chartere-head > .swiper-pagination',
        paginationClickable: true,
        nextButton: '.swiper-container.swiper-chartere-head > .swiper-button-next',
        prevButton: '.swiper-container.swiper-chartere-head > .swiper-button-prev',
        spaceBetween: 0,
        slidesPerView: 2,
         breakpoints: {
            1199: {
                slidesPerView: 1,
            },
       }
    });
    if($(window).width() > 992){
	    $(window).scroll(function(){
	        if ($(window).scrollTop() > 0){
	            $('header.header').addClass('header-sticky');
	            $('main').css('margin-top', ''+ $('header.header').height() +'px');
	        }else if($(window).scrollTop() == 0){
	        	$('header.header').removeClass('header-sticky');
	        	$('main').css('margin-top', '0px');
	        }
	    });
    }


    $('#weather-month').change(function(){
    	$(this).parent().parent().find('.weather').addClass('hidden');
    	$('#weather'+$(this).val()).removeClass('hidden');
    });

	// The function actually applying the offset
	function offsetAnchor() {
	  if (location.hash.length !== 0) {
	    window.scrollTo(window.scrollX, window.scrollY - 100);
	  }
	}

	// Captures click events of all <a> elements with href starting with #
	$(document).on('click', 'a[href^="#"]', function(event) {
	  // Click events are captured before hashchanges. Timeout
	  // causes offsetAnchor to be called after the page jump.
	  window.setTimeout(function() {
	    offsetAnchor();
	  }, 0);
	});

	// Set the offset when entering page with hash present in the url
	window.setTimeout(offsetAnchor, 0);



	$('.home-for-padding .chartere-home .chartere__item__title__text').each(function(){
     	if($(this).height()==19){
	    	$(this).css('line-height', '30px');
	    }
     });

	$.extend({
	  getUrlVars: function(){
	    var vars = [], hash;
	    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
	    for(var i = 0; i < hashes.length; i++)
	    {
	      hash = hashes[i].split('=');
	      vars.push(hash[0]);
	      vars[hash[0]] = hash[1];
	    }
	    return vars;
	  },
	  getUrlVar: function(name){
	    return $.getUrlVars()[name];
	  }
	});

	if ($.getUrlVar("srt") != null) {
	    $('.dropwdown-sortare .sortare').html($('.dropwdown-sortare .dropdown-menu li.active a').text() + '<span class="caret"></span>');
	}





	$('.advanced-click').click(function(e){
		e.preventDefault();
		$(this).parent().hide();
    //@andrei: one more extra .parent() added
		$(this).parent().parent().parent().find('.advanced').removeClass('hidden');
		$(this).parent().parent().find('input[name="advanced"]').val(1);
	});


	$('.see-more-filters').click(function(e){
		e.preventDefault();
		$(this).parent().removeClass('aside-filters__masa_height');
    $(this).parent().css("max-height", "none");
		$(this).hide();
	});



	// var img_height = $('.inner-banner .img-banner__img').height();
	// var tab_height_original = $('.main-filters .tab-content').height();
//
	// $('body').on('click', function (event) {
	  // if (event.target != this) {
	  	// var tab_height = $('.main-filters .tab-content').height();
	  	// var img_height_add = img_height + (tab_height - tab_height_original );
	  	// $('.inner-banner .img-banner__img').css('height', img_height_add+'px');
	    // console.log('You clicked a descendent of #container.');
	  // } else {
	    // console.log('You actually clicked #container itself.');
	  // }
	// });

	var img_banner_src = $('.back-image-form .img-banner__img__wrapper .img-banner__img').attr('src');

	$('.back-image-form .img-banner__img__wrapper .img-banner__img').closest('.col-xs-12').css('background', 'url('+img_banner_src+') no-repeat');
	$('.back-image-form .img-banner__img__wrapper .img-banner__img').closest('.col-xs-12').css('background-size', 'auto');
	$('.back-image-form .img-banner__img__wrapper .img-banner__img').closest('.col-xs-12').css('background-position', '80% 56%');
	$('.back-image-form .img-banner__img__wrapper .img-banner__img').css('display', 'none');


	 $('.bf-page .sidebar .sidebar-group h3 a').click(function(e){
	 	 e.preventDefault();
	 	$('.bf-page .sidebar .sidebar-group h3 a').parent().removeClass('active');
	 	$(this).parent().addClass('active');

	 	var anchor =  $(this).attr('href');
	 	var id_anchor = anchor.substring(1, anchor.length);
	 	$('html,body').animate({
            scrollTop: $("#"+id_anchor).offset().top
        }, 500);

	 });

	 $('.bf-page .sidebar .sidebar-group ul li a').click(function(e){
	 	e.preventDefault();
	 	$('.bf-page .sidebar .sidebar-group h3').removeClass('active');
	 	$(this).closest('ul').siblings('h3').addClass('active');
	 	$('.bf-page .sidebar .sidebar-group ul li a').removeClass('active');
	 	$(this).addClass('active');

	 	var anchor =  $(this).attr('href');
	 	var id_anchor = anchor.substring(1, anchor.length);
	 	$('html,body').animate({
            scrollTop: $("#"+id_anchor).offset().top
        }, 500);

     });

     $(window).on('scroll', function() {
	    $('.anchor-bf').each(function() {
	        if($(window).scrollTop() >= $(this).offset().top -50) {
	            var id = $(this).attr('id');
              //$('.bf-page .sidebar .sidebar-group ul li a ul li a').removeClass('active');
	            //$('.bf-page .sidebar .sidebar-group ul li a').removeClass('active');
	            $('.bf-page .sidebar .sidebar-group ul li a[href="#'+ id +'"]').addClass('active');
	            $('.bf-page .sidebar .sidebar-group ul li a[href="#'+ id +'"]').parent('li').siblings().children('a').removeClass('active');
	            $('.bf-page .sidebar .sidebar-group ul li a[href="#'+ id +'"]').closest('.sidebar-group').siblings().find('a').removeClass('active');

	            $('.bf-page .sidebar .sidebar-group ul li a[href="#'+ id +'"]').closest('ul').siblings('h3').addClass('active');
	            $('.bf-page .sidebar .sidebar-group ul li a[href="#'+ id +'"]').closest('.sidebar-group').siblings().find('h3').removeClass('active');

	            //$('.bf-page .sidebar .sidebar-group h3 a[href="#'+ id +'"]').parent().addClass('active');
	            //$('.bf-page .sidebar .sidebar-group h3 a[href="#'+ id +'"]').parent('.sidebar-group').siblings().children('h3').removeClass('active');
	        }
	    });
	});
  var ii = 0;
  var height_checkbox = 0;
  $('.aside-filters__masa_height').each(function(){
    var $this = $(this);
  	if($this.height() < 282){
  		$this.find($('.see-more-filters')).hide();

  	}else{

      $this.find($('.checkbox')).each(function(){

        if(ii < 13){
          height_checkbox += $(this).height();
        }
        ii++;
      });
      height_checkbox = height_checkbox + 20;
      $this.css('max-height', "" + height_checkbox + "" + "px");
      //$(this).css('max-height', "" + height_checkbox + "" + "px");
    }
  });
});




function saveToWishlist(type, id, city_from){
	$.ajax({
		url: $_base + 'ajax/whishlist.php',
		data: {type: type, id: id, city_from: city_from},
		dataType: 'json'
	});
	$('#whishlist').addClass('saved').find('p').html('Salvat in whishlist');
}






//load game defaults after page load
function loadCharterPriceList(){

    var $price_list = $('#price-swiper');

    if($price_list.length){

        var animateChartItem = function(el){

            if(typeof el != 'undefined') {

                var $elm = $(el);

                $elm.each(function(){
                    var $this = $(this);

                    var $price_column   = $this.find('.price-item-column');
                    var $percentage     = $this.data('percentage');
                    var $month          = $this.data('month');
                    var $day            = $this.data('day');

                    $price_column.animate({
                        'height' : $percentage + '%'
                    }, 1000);

                    $elm.addClass('animated');
                });
            }
        };

        var chartSwiper = new Swiper('.swiper-price-chart', {
            slidesPerView: 'auto',
            freeMode: true,
            observer: true,
            spaceBetween: 15,
            init: false,
            nextButton: $('.sw-price-next'),
            prevButton: $('.sw-price-prev'),
            watchSlidesVisibility: true
        });

        $start_day = $('#item-price-chart-start-day');
        $duration = $('#item-price-chart-vacation-duration');

        $start_day.change(function(){

            $offer_type = $(this).data('offer');

            if($offer_type == 'charter'){
                $_url = $_base + 'ajax/price_chart/charter_price_list.php';
                $data = {
                    'day': $(this).val(),
                    'id_city_from': $(this).data('city-from'),
                    'id_hotel': $(this).data('id-hotel'),
                    'action': 'duration',
                    'type': $(this).data('type'),
                    'location_id': $(this).data('location-id')
                };
            }else if($offer_type == 'hotel'){
                $_url = $_base + 'ajax/price_chart/hotel_price_list.php';
                $data = {
                    'day': $(this).val(),
                    'id_hotel': $(this).data('id-hotel'),
                    'action': 'duration'
                };
            }

            $.ajax({
                url: $_url,
                dataType: 'json',
                processResults: true,

                data: $data,

                success: function(response){

                    $duration.select2('destroy').find('option').remove().end().select2({data: response, minimumResultsForSearch: Infinity, placeholder: "Alege ziua de plecare"});
                    $duration.trigger('change');

                },

                error: function(xhr, status, error){
                    console.log(error);
                },
            });

        });

        $duration.change(function(){

            $offer_type = $start_day.data('offer');

            if($offer_type == 'charter'){
                $_url = $_base + 'ajax/price_chart/charter_price_list.php';
                $data = {
                    'day': $start_day.val(),
                    'duration': $(this).val(),
                    'id_city_from': $start_day.data('city-from'),
                    'id_hotel': $start_day.data('id-hotel'),
                    'action': 'chart',
                    'type': $start_day.data('type'),
                    'location_id': $start_day.data('location-id')
                };
            }else if($offer_type == 'hotel'){
                $_url = $_base + 'ajax/price_chart/hotel_price_list.php';
                $data = {
                    'day': $start_day.val(),
                    'duration': $(this).val(),
                    'id_hotel': $start_day.data('id-hotel'),
                    'action': 'chart'
                };
            }

            $.ajax({

                url: $_url,
                dataType: 'json',
                processResults: true,

                data: $data,

                success: function(response){

                    $('#sw-price-wrapper').css({
                        'background' : 'none'
                    });

                    $price_list.find('.swiper-slide').remove();

                    $.each(response, function() {
                        $.each(this, function(key, val) {
                            $price_list.find('.swiper-wrapper').append(val);
                        });
                    });

                    $('.price-bar-trigger').click(function(){

                        $("#item-t-individual-check-in-restrict").val($(this).data('from')).change();
                        $("#item-t-individual-check-out-restrict").val($(this).data('to'));
                        $("#item-t-individual-check-out-restrict").datepicker("option", "disabled", false);

                        $('html, body').animate({
                        	scrollTop: $("#book_form").offset().top - 150
                        }, 'slow');

                        //$('#calculate').trigger('click');

                    });

                    animateChartItem('.price-item');
                    chartSwiper.update();

                },

                error: function(xhr, status, error){
                    console.log(error);
                },
            });

        });


        $start_day.trigger('change');

    }

}


$(window).on('load', function(){
    loadCharterPriceList();
});


$(document).ready(function(){


    $('#search_string').on('focusin', function(){
        $('.black-over').removeClass('hidden');
        $('body').css('overflow', 'hidden');
    });

    $('.black-over').on('click', function(){
        $(this).addClass('hidden');
        $('body').css('overflow', '');
        $('#autosuggest-wrapper').addClass('hidden');
    });

    $("html, body").on('click', function(e) {
        if ($(e.target).hasClass('quick-link')) {
            location.href = $(e.target).attr('href');
        }
    });


    $('#my-acc-btn').click(function(e){
        e.preventDefault();

        if($('#my-acc-menu').is(":visible")){
            $('#my-acc-menu').hide();
        }else{
            $('#my-acc-menu').show();
        }
    });

    $('body').not('.no-hide-acc-menu').click(function(e){
        if(!$(e.target).hasClass('no-hide-acc-menu')){
            // console.log(e.target);
            $('#my-acc-menu').hide();
        }
    });


    $.widget("custom.catcomplete", $.ui.autocomplete, {
        _renderMenu: function(ul, items) {
            var self = this;
            $.each(items, function(index, item) {
                self._renderItemData(ul, item);
            });
        },
        _renderItem: function(ul, item) {
            return $('<li class="hidden"></li>');
        }
    });

    var accentMap = {
        "ă": "a",
        "â": "a",
        "î": "a",
        "ţ": "t",
        'ț': "t",
        'ş': "s",
        'ș': "s"
    };

    var normalize = function( term ) {
        var ret = "";
        for ( var i = 0; i < term.length; i++ ) {
            ret += accentMap[ term.charAt(i) ] || term.charAt(i);
        }
        return ret;
    };

    var swiperAboutNew1 = new Swiper('.swiper-container-about-new-1', {
      slidesPerView: 4,
      spaceBetween: 20,
      // init: false,
      nextButton: '.swiper-button-next',
		prevButton: '.swiper-button-prev',
      breakpoints: {
        1024: {
          slidesPerView: 4,
          spaceBetween: 40,
        },
        768: {
          slidesPerView: 3,
          spaceBetween: 30,
        },
        640: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        320: {
          slidesPerView: 1,
          spaceBetween: 10,
        }
      }
    });

    var swiperAboutNew1 = new Swiper('.swiper-container-about-new-1', {
      slidesPerView: 4,
      spaceBetween: 20,
      // init: false,
      nextButton: $('.about-swiper-wrapper-1').find('.swiper-button-next'),
		prevButton: $('.about-swiper-wrapper-1').find('.swiper-button-prev'),
      breakpoints: {
        1024: {
          slidesPerView: 4,
          spaceBetween: 40,
        },
        768: {
          slidesPerView: 3,
          spaceBetween: 30,
        },
        640: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        320: {
          slidesPerView: 1,
          spaceBetween: 10,
        }
      }
    });

    var swiperAboutNew2 = new Swiper('.swiper-container-about-new-2', {
      slidesPerView: 4,
      spaceBetween: 20,
      // init: false,
      nextButton: $('.about-swiper-wrapper-2').find('.swiper-button-next'),
		prevButton: $('.about-swiper-wrapper-2').find('.swiper-button-prev'),
      breakpoints: {
        1024: {
          slidesPerView: 4,
          spaceBetween: 40,
        },
        768: {
          slidesPerView: 3,
          spaceBetween: 30,
        },
        640: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        320: {
          slidesPerView: 1,
          spaceBetween: 10,
        }
      }
    });


    $(function(){
        var smartSearchForm = $('#search_form_header');
            smartSearchCache = {};
        $('#search_string')
            .bind("keydown", function(event) {
                if(event.keyCode === $.ui.keyCode.TAB && $(this).data("autocomplete").menu.active) {
                    event.preventDefault();
                }
            })
            .catcomplete({
                delay: 200,
                minLength: 3,
                source: function(request, response) {
                    var matcher = new RegExp( $.ui.autocomplete.escapeRegex( request.term ), "i" );

                    var term = request.term;
                    if(term in smartSearchCache) {
                        response(smartSearchCache[term]);
                        return;
                    }
                    $.getJSON($_base + 'ajax/smart_search.php', request, function(data, status, xhr) {
                        smartSearchCache[term] = data.results;
                        response(data.results);
                    });
                },
                select: function(event, ui) {
                    window.location = ui.item.url;
                },
                search: function(event, ui) {
                },
                response: function(event, ui) {
                    var $autosuggest_wrapper = $('#autosuggest-wrapper');

                    $('#autosuggest-wrapper').find('div.row').html('');
                    $autosuggest_wrapper.removeClass('hidden');

                    var charter_shown = false;
                    var hotel_shown = false;
                    var circuit_shown = false;
                    var cruise_shown = false;

                    $charter_wrapper = $('<div class=""></div>');
                    $charter_header = '';

                    $hotel_wrapper = $('<div class=""></div>');
                    $hotel_header = '';

                    $circuit_wrapper = $('<div class=""></div>');
                    $circuit_header = '';

                    $cruise_wrapper = $('<div class=""></div>');
                    $cruise_header = '';

                    $charter_cols_wrapper = $('<div class="auto-col-wrapper"></div>');
                    $charter_cols = $('<ul class="auto-col col-md-12"></ul>');

                    $hotel_cols_wrapper = $('<div class="auto-col-wrapper"></div>');
                    $hotel_cols = $('<ul class="auto-col col-md-12"></ul>');

                    $circuit_cols_wrapper = $('<div class="auto-col-wrapper"></div>');
                    $circuit_cols = $('<ul class="auto-col col-md-12"></ul>');

                    $cruise_cols_wrapper = $('<div class="auto-col-wrapper"></div>');
                    $cruise_cols = $('<ul class="auto-col col-md-12"></ul>');

                    $.each(ui.content, function(index, item) {

                        if(item.type == "charter"){
                            if(!charter_shown){
                                $charter_header = '<div class="col-md-12"><p>Pachete de vacanta</p></div>';
                                charter_shown = true;
                            }
                            $('<li class="col-sm-6 col-md-4 col-lg-3"></li>')
                                .append("<a href='"+item.url+"' class='quick-link'><span class='img-wrapper'><img src='"+item.img+"'></span><span>"+ item.label + "</span></a>")
                                .appendTo($charter_cols);
                        }

                        if(item.type == "hotel"){
                            if(!hotel_shown){
                                $hotel_header = '<div class="col-md-12"><p>Hoteluri</p></div>';
                                hotel_shown = true;
                            }
                            $('<li class="col-sm-6 col-md-4 col-lg-3"></li>')
                                .append("<a href='"+item.url+"' class='quick-link'><span class='img-wrapper'><img src='"+item.img+"'></span><span>"+ item.label + "</span></a>")
                                .appendTo($hotel_cols);
                        }

                        if(item.type == "circuit"){
                            if(!circuit_shown){
                                $circuit_header = '<div class="col-md-12"><p>Circuite</p></div>';
                                circuit_shown = true;
                            }
                            $('<li class="col-sm-6 col-md-4 col-lg-3"></li>')
                                .append("<a href='"+item.url+"' class='quick-link'><span class='img-wrapper'><img src='"+item.img+"'></span><span>"+ item.label + "</span></a>")
                                .appendTo($circuit_cols);
                        }

                        if(item.type == "cruise"){
                            if(!cruise_shown){
                                $cruise_header = '<div class="col-md-12"><p>Croaziere</p></div>';
                                cruise_shown = true;
                            }
                            $('<li class="col-sm-6 col-md-4 col-lg-3"></li>')
                                .append("<a href='"+item.url+"' class='quick-link'><span class='img-wrapper'><img src='"+item.img+"'></span><span>"+ item.label + "</span></a>")
                                .appendTo($cruise_cols);
                        }

                        if(item.type == "link"){
                            if(item.for == "charter") charter_more_link = item.link;
                            if(item.for == "hotel") hotel_more_link = item.link;
                            if(item.for == "circuit") circuit_more_link = item.link;
                            if(item.for == "cruise") cruise_more_link = item.link;
                        }

                    });

                    if(charter_shown){
                        $autosuggest_wrapper.find('div.row').append($charter_header);
                        $charter_cols.appendTo($charter_cols_wrapper);
                        $('<div class="col-md-12 text-center"></div>')
                            .append("<a href='"+charter_more_link+"' class='autosuggest_more'>Vezi mai multe rezultate »</a>")
                            .appendTo($charter_cols_wrapper);
                        $charter_cols_wrapper.appendTo($charter_wrapper);
                        $charter_wrapper.appendTo($autosuggest_wrapper.find('div.row'));
                    }

                    if(hotel_shown){
                        $autosuggest_wrapper.find('div.row').append($hotel_header);
                        $hotel_cols.appendTo($hotel_cols_wrapper);
                        $('<div class="col-md-12 text-center"></div>')
                            .append("<a href='"+hotel_more_link+"' class='autosuggest_more'>Vezi mai multe rezultate »</a>")
                            .appendTo($hotel_cols_wrapper);
                        $hotel_cols_wrapper.appendTo($hotel_wrapper);
                        $hotel_wrapper.appendTo($autosuggest_wrapper.find('div.row'));
                    }

                    if(circuit_shown){
                        $autosuggest_wrapper.find('div.row').append($circuit_header);
                        $circuit_cols.appendTo($circuit_cols_wrapper);
                        $('<div class="col-md-12 text-center"></div>')
                            .append("<a href='"+circuit_more_link+"' class='autosuggest_more'>Vezi mai multe rezultate »</a>")
                            .appendTo($circuit_cols_wrapper);
                        $circuit_cols_wrapper.appendTo($circuit_wrapper);
                        $circuit_wrapper.appendTo($autosuggest_wrapper.find('div.row'));
                    }

                    if(cruise_shown){
                        $autosuggest_wrapper.find('div.row').append($cruise_header);
                        $cruise_cols.appendTo($cruise_cols_wrapper);
                        $('<div class="col-md-12 text-center"></div>')
                            .append("<a href='"+cruise_more_link+"' class='autosuggest_more'>Vezi mai multe rezultate »</a>")
                            .appendTo($cruise_cols_wrapper);
                        $cruise_cols_wrapper.appendTo($cruise_wrapper);
                        $cruise_wrapper.appendTo($autosuggest_wrapper.find('div.row'));
                    }


                    if(!circuit_shown && !hotel_shown && !cruise_shown && !charter_shown){
                        $autosuggest_wrapper.find('div.row').append('<p class="text-center">Nu am gasit nici un rezultat</p>');
                    }
                }
            });
    });

});


$.fn.stars = function() {
    return $(this).each(function() {
        // Get the value
        var val = parseFloat($(this).attr('data-stars'));
        // Make sure that the value is in 0 - 5 range, multiply to get width
        var size = Math.max(0, (Math.min(5, val))) * 16;
        // Create stars holder
        var $span = $('<span />').width(size);
        // Replace the numerical value with stars
        $(this).html($span);
    });
}
