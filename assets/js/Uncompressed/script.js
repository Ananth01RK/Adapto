"use strict";

$(window).on("load",function(){

    $(".loader-backdrop").fadeOut();

    if($(".modal").length){
        $(".modal").each(function(){
            var currentModal=$(this);

            if((currentModal.attr("data-open-onload"))=="true"){    // Checks Each Modal
                setTimeout(function(){
                    currentModal.modal();
                }, currentModal.attr("data-open-delay")); 
            }
        });
    }
});


/*************************************/
/*********** Function Calls **********/
/*************************************/

$(document).ready(function(){

    /* Auto Select Current Menu Item */

    if($(".navbar-nav").length){
        currentMenuItem();
    }

    /*  Mobile Menu toggle */

    if($(".has-menu").length){
        mobileMenuToggle();
    }

    /*  Sticky Nav */

    if($(".sticky-nav").length){
        var thisHeader = $(".sticky-nav").parents("header");
        stickyNav(thisHeader);
    }

    /*  Background Parallax */

    if($(".parallax").length && $(window).width() > 960){
        backgroundParallax();
    }

    /*  News Slider */

    if($(".news-slider").length){
        $(".news-slider").each(function(){
            newsSlider(this);
        });
    }

    /*  Testimonials Style 1 */

    if($(".testimonial-1").length){
        $(".testimonial-1").each(function(){
            testimonialSlider1(this);
        })
    }

    /*  Department Slider */

    if($(".department-slider").length){
        $(".department-slider").each(function(){
            departmentSlider(this);
        });
    }

    /*  Flexible Slider */

    if($(".flexible-slider").length){
        $(".flexible-slider").each(function(){
            flexibleSlider(this);
        });
    }

    /*  Circle Progress Bar */

    if($(".circle").length){
        $(".circle").each(function(){
            $(this).appear(function() {
                circleProgressBar(this);
            });
        });
    }    

    /*  Date Selector */

    if($(".date-select").length){
        dateSelect();
    }

    /*  Fixed Appointment Form */

    if($("#fixed-appointment").length){
        fixedAppointment();
    }

    /*  Countdown Timer */

    if($(".timer").length){
        $(".timer").each(function(){
            countdownTimer(this);
        });
    }

    /*  Counters */

    if($(".fact-count").length){
        $(".fact-count").each(function(){
            $(this).appear(function() {
                countToNumber(this);
            });
        });
    }

    /*  Back To Top */

    if($("#back").length){
        backToTop();
    }

    /*  Slider Revolution 1 */

    if($("#slider-1").length){
        sliderRevolution1();
    }

    /*  Slider Revolution 2 */

    if($("#slider-2").length){
        sliderRevolution2();
    }

    /*  Youtube Video */

    if($(".youtube-video").length){    
        $(".youtube-video").each(function(){
            youtubeVideo(this);
        });        
    }

    /*  Pretty Photo */

    if($("a[data-gal^='prettyPhoto']").length){
        prettyPhotoGallery();
    }

    /*  Contact Page Form */

    if($("#main-contact-form").length){
        formSubmit();
    }

    /*  Footer News */

    if($("footer .tweets").length){    
        $("footer .tweets").each(function(){
            footerTweets(this);
        });        
    }

    /*  Google Map */

    if($(".gmap").length){

        $(".gmap").each(function(){

            var lat=$(this).attr("data-lat");            // Latitude of the place to be marked

            var long=$(this).attr("data-long");          // Longitude of the place to be marked

            var infoWin=$(this).attr("data-info-win");   // Content to be shown in Info Window on Marker

            googleMapStyle(lat, long, infoWin, this);    // Call to Google Map Styler  
        });
    }

});

/*************************************/
/******** Function Definitions *******/
/*************************************/

function currentMenuItem(){

    var currentUrl = $(location).attr("href");          // Gets current location of the browser

    $(".navbar-nav .menu-items a").each(function(){      // Traverse each <a> in the menu
        var checkThisUrl = $(this).attr("href");
        if((splitUrl(checkThisUrl)) == splitUrl(currentUrl)){       //Check if this <a> matches with the browser location
            $(this).closest(".nav-item").addClass("active");
        }
    });

    function splitUrl(thisUrl){         // Takes URL path and returns only the web page name
        thisUrl=thisUrl.toString();
        var urlSplit = thisUrl.split("/");
        var thisPage = urlSplit[urlSplit.length-1];
        return thisPage;
    }
}

function mobileMenuToggle(){
    if($(window).width() < 992){
        $(".has-menu > a").click(function(e){
            e.preventDefault();
            $(this).parent().toggleClass("open-menu");
        });
    }
}

function stickyNav(thisHeader){
    var headerHeight = $(thisHeader).height();
    window.addEventListener('scroll', function(e){
        var distanceY = window.pageYOffset || document.documentElement.scrollTop,
        shrinkOn = 400,         // Stick to Top after scrolling 400px
        stickyNav = $(".sticky-nav");
        if (distanceY > shrinkOn) {
            $(thisHeader).css({"height" : headerHeight+"px"});
            stickyNav.addClass("stick");
        } else {
            if (stickyNav.hasClass("stick")) {
                stickyNav.removeClass("stick");
            }
        }
    });
}

function backgroundParallax(){

    var $fwindow = $(window);
    var scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    $fwindow.on('scroll resize', function() {
        scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    }); 

    $('[data-type="content"]').each(function (index, e) {
        var $contentObj = $(this);
        var fgOffset = parseInt($contentObj.offset().top);
        var yPos;
        var speed = ($contentObj.data('speed') || 1 );

        $fwindow.on('scroll resize', function (){
            yPos = fgOffset - scrollTop / speed; 

            $contentObj.css('top', yPos);
        });
    });

    $(".parallax").each(function(){
        var $backgroundObj = $(this);
        var bgOffset = parseInt($backgroundObj.offset().top);
        var yPos;
        var coords;
        var speed = ($backgroundObj.data('speed') || 0 );

        $fwindow.on('scroll resize', function() {
            yPos = - ((scrollTop - bgOffset) / speed); 
            coords = '50% '+ yPos + 'px';

            $backgroundObj.css({ backgroundPosition: coords });
        }); 
    }); 

    $fwindow.trigger('scroll');
}

function newsSlider(thisNewsSlider){

    var newsSliderVar= $(thisNewsSlider).find(".slider-items");

    newsSliderVar.slick({
        arrows: true,
        slidesToShow: 1,
        dots: true,
        focusOnSelect: true,
        appendArrows: $(thisNewsSlider).find(".slider-arrows"),
        appendDots: $(thisNewsSlider).find(".slider-dots"),
        prevArrow: $(thisNewsSlider).find(".icon-prev"),
        nextArrow: $(thisNewsSlider).find(".icon-next")
    });
}

function testimonialSlider1(thisTestimonialSlider){

    var testimonialSlider1Var = $(thisTestimonialSlider).find('.slider-items');
    var testimonialSlider1NavVar = $(thisTestimonialSlider).find('.slider-nav');

    testimonialSlider1Var.slick({
        arrows: false,
        dots: false,
        autoplay: true,
        focusOnSelect: false,
        slidesToShow: 1,
        asNavFor: testimonialSlider1NavVar
    });

    testimonialSlider1NavVar.slick({
        arrows: true,
        slidesToShow: 3,
        asNavFor: testimonialSlider1Var,
        dots: false,
        centerMode: true,
        centerPadding: 20,
        focusOnSelect: true,
        prevArrow: '<div class="icon-prev"><i class="ion-arrow-back-sharp"></i></div>',
        nextArrow: '<div class="icon-next"><i class="ion-arrow-forward-sharp"></i></div>',
        appendArrows: testimonialSlider1NavVar,
        responsive: [
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1
            }
        }]
    });
}

function departmentSlider(thisDepartmentSlider){

    var departmentSliderVar= $(thisDepartmentSlider).find('.slider-items');

    departmentSliderVar.slick({
        arrows: $(thisDepartmentSlider).data("arrows"),
        dots: $(thisDepartmentSlider).data("dots"),
        slidesToShow: $(thisDepartmentSlider).data("items"),
        loop: "true",
        autoplay: "true",
        autoplayTimeout: "3000",
        autoplaySpeed: "3500",
        smartSpeed: "3500",
        prevArrow: $(thisDepartmentSlider).find(".icon-prev"),
        nextArrow: $(thisDepartmentSlider).find(".icon-next"),
        appendArrows: $(thisDepartmentSlider).find(".slider-arrows"),
        appendDots: $(thisDepartmentSlider).find(".slider-dots"),
        responsive: [
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 2
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        }]
    });
}

function flexibleSlider(thisSlider){

    var sliderVar= $(thisSlider).find('.slider-items');

    sliderVar.slick({
        arrows: $(thisSlider).data("arrows"),
        dots: $(thisSlider).data("dots"),
        slidesToShow: $(thisSlider).data("items"),
        loop: "true",
        autoplay: "true",
        autoplayTimeout: "3000",
        autoplaySpeed: "3500",
        smartSpeed: "3500",
        prevArrow: $(thisSlider).find(".icon-prev"),
        nextArrow: $(thisSlider).find(".icon-next"),
        appendArrows: $(thisSlider).find(".slider-arrows"),
        appendDots: $(thisSlider).find(".slider-dots"),
        responsive: [
        {
            breakpoint: 992,
            settings: {
                slidesToShow: $(thisSlider).data("items-992")
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: $(thisSlider).data("items-768")
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1
            }
        }]
    });
}

function circleProgressBar(thisProgressBar){
    $(thisProgressBar).circleProgress({
        fill: { color: "#427cc5" },
        thickness: "10",
        startAngle: 1.5 * Math.PI,
        size: "125",
        emptyFill: "#eaeaea",
        animation: {duration:1750}
    })
    .on('circle-animation-progress', function(event, progress, stepValue) {
        $(this).find('.progress-value').html(parseInt(100 * stepValue) + '%');
    });
}

function dateSelect(){
    $('.date-select').datepicker({
        showOn: "button",
        buttonImage: "images/datepicker/calendar.svg"
    }
    );
}

function fixedAppointment(){
    $("#open-form").click(function(){
        $(this).toggleClass("open");
        $("#fixed-appointment .form-body").toggle("swing"); 
    });
}

function countdownTimer(thisTimer)
{
    var date=$(thisTimer).attr("data-date");
    $(thisTimer).countdown(date, function(event) {
        $(this).find(".days").html(event.strftime("%D"));              // Days Left
        $(this).find(".hours").html(event.strftime("%H"));             // Hours Left
        $(this).find(".minutes").html(event.strftime("%M"));           // Minutes Left
        $(this).find(".seconds").html(event.strftime("%S"));           // Seconds Left
    });
}

function countToNumber(thisCounter){
    $(thisCounter).countTo();                    
}

function backToTop()
{
    var offset = 250;                          // Offset after which Back To Top button will be visible 
    var duration = 1000;                       // Time duration in which the page scrolls back up.
    
    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > offset) {
            $('#back').addClass("visible");
        } else {
            $('#back').removeClass("visible");
        }
    });

    jQuery('#back').click(function(event) {
        event.preventDefault();
        jQuery('html, body').animate({scrollTop: 0}, duration);
        return false;
    });    
}

function sliderRevolution1()
{
    jQuery("#slider-1").show().revolution({
        sliderType:"standard",
        sliderLayout:"fullwidth",
      delay: 5000,                                       // Delay in Transition from one slide to another in milliseconds
      responsiveLevels: [1200, 992, 768, 480],
      gridwidth: [1110, 990, 700, 390],
      gridheight: [525, 500, 650, 420],
      navigation: {
        arrows:{enable:true}
    },
    lazyLoad:"on",
    parallax:{
        type:"scroll"
    }
});
}

function sliderRevolution2()
{
    jQuery("#slider-2").show().revolution({
        sliderType:"standard",
        sliderLayout:"fullwidth",
      delay: 5000,                                       // Delay in Transition from one slide to another in milliseconds
      responsiveLevels: [1200, 992, 768, 480],
      gridwidth: [1100, 900, 700, 390],
      gridheight: [560, 500, 450, 420],
      navigation: {
        arrows:{enable:true}
    },
    lazyLoad:"on",
    parallax:{
        type:"scroll"
    }
});
}

function youtubeVideo(currentVideo)
{    
    var thumbnail;
    var videoId = $(currentVideo).attr("data-video-id");                                    // Get Video ID from data attributes
    var customThumbnail = $(currentVideo).attr("data-video-thumbnail");

    if(customThumbnail){
        thumbnail = 'url(' + customThumbnail +')';
    }
    else{
        thumbnail = 'url(https://img.youtube.com/vi/'+ videoId + '/sddefault.jpg)';         // Get Thumbail image of the video
    }
    $(currentVideo).css("background-image", thumbnail);                                     // Set thmbnail image as the background
    
    var videoUrl= "https://www.youtube.com/embed/" + videoId + "?autoplay=1&autohide=1";    // Framing Video URL from video ID
    
    $(currentVideo).find(".btn-play").click(function(){                                     // If play button is clicked, load Video within IFrame
        var videoFrame = $('<iframe/>', {
            'frameborder': '0',
            'src': videoUrl,
            'width': "100%",
            'height': "500px"
        });
        $("#video-container").append(videoFrame);                                            // Finally replace the div with IFrame
        $("#modal-video").modal("show");                                                     // Show modal once ready with Video
    });
    
    $("#modal-video").on('hidden.bs.modal', function(){                                      // Delete iFrame after Modal hides
        $(this).find("iframe").remove();
    }); 
}

function prettyPhotoGallery()
{
    $("a[data-gal^='prettyPhoto[galleryName]']").prettyPhoto({theme: 'minimal', social_tools: ''});
}

function formSubmit(){
    var options = 
    {
        clearForm : 'false',
        type : 'POST',
        url : 'sendemail.php',            // PHP Script for Form Submission
        cache : 'false',
        resetForm : 'false',
        async : 'true',
        datatype : 'html',
        timeout : 2400000,      
        
        beforeSend:function(){
            var text = "<i class='ion-time-outline'></i>Submitting your message, please wait.";
            $("#status").empty().html(text);
        },
        
        complete: function(xhr, textStatus)
        {
            $("#status").empty().html(xhr.responseText);
        },
        
        error: function(jqXHR, textStatus, errorThrown)
        {
            $("#status").empty().html('Error in application : Please try again.');      
        }               
    };

    $.validator.setDefaults({
        submitHandler: function() {
            $("#main-contact-form").ajaxSubmit(options);
        }
    });

    $("#main-contact-form").validate({

        rules: {
            fname:  {
                required: true,
            },      
            lname:  {
                required: true,
            },      
            email:  {
                required: true,
                email: true,
            },          
            subject: {
                required: true,
            }, 
            message: {
                required: true,
            }
        },

        messages: {
            fname: {
                required: "Please enter your name.",
            },
            lname: {
                required: "Please enter your name.",
            },
            email: {
                required: "Please enter a valid email id.",
            },
            subject: {
                required: "Please enter the message subject.",
            },
            message: {
                required: "Please enter your message.",
            }
        },

        errorPlacement: function() {
            return false;
        }
    });    
}

function footerTweets(thisTweetScroll){
    $(thisTweetScroll).find(".carousel-items").slick({
        arrows: false,
        dots: false,
        autoplay: true,
        verticalSwiping: true,
        focusOnSelect: false,
        vertical : true,
        slidesToShow: 1,
        autoplaySpeed: 2500
    });
}

function googleMapStyle(lat, long, infoWin, currentMap)
{   
    var styles = [
    {
        "featureType": "administrative",
        "elementType": "labels.text.fill",
        "stylers": [
        {
            "color": "#444444"
        }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "all",
        "stylers": [
        {
            "color": "#eaeaea"
        }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "all",
        "stylers": [
        {
            "visibility": "off"
        }
        ]
    },
    {
        "featureType": "road",
        "elementType": "all",
        "stylers": [
        {
            "saturation": -100
        },
        {
            "lightness": 45
        }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "all",
        "stylers": [
        {
            "visibility": "simplified"
        }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "labels.icon",
        "stylers": [
        {
            "visibility": "off"
        }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "all",
        "stylers": [
        {
            "visibility": "off"
        }
        ]
    },
    {
        "featureType": "water",
        "elementType": "all",
        "stylers": [
        {
            "color": "#46bcec"
        },
        {
            "visibility": "on"
        }
        ]
    },
    {
        "featureType": "water",
        "elementType": "geometry.fill",
        "stylers": [
        {
            "color": "#427CC5"
        },
        {
            "saturation": "0"
        },
        {
            "lightness": "0"
        }
        ]
    }
    ];

    var options = {
        mapTypeControlOptions: {
            mapTypeIds: ['Styled']
        },
        center: new google.maps.LatLng(lat, long),
        zoom: 14,
        disableDefaultUI: true, 
        mapTypeId: 'Styled'
    };

    var div = currentMap;

    var map = new google.maps.Map(div, options);

    var styledMapType = new google.maps.StyledMapType(styles, { name: 'Styled' });

    map.mapTypes.set('Styled', styledMapType);

    var marker = new google.maps.Marker({
        map: map,
        icon: 'images/map-flag-pin.png',
        position: new google.maps.LatLng(lat, long)             // Set Marker Position of the place
    });

    marker['infowindow'] = new google.maps.InfoWindow({
        content: infoWin                                        // Set Content of the Info Window of the Marker
    });

    new google.maps.event.addListener(marker, 'mouseover', function() {
        this['infowindow'].open(map, this);                     // On Marker Hover, show Info Window
    });    
}