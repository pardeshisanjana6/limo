// (function ($) {

//   "use strict";
  
//   $(document).ready(function () {
    
//     // product single page
//     var thumb_slider = new Swiper(".product-thumbnail-slider", {
//       autoplay: true,
//       loop: true,
//       spaceBetween: 8,
//       slidesPerView: 4,
//       freeMode: true,
//       watchSlidesProgress: true,
//     });
    
//     var large_slider = new Swiper(".product-large-slider", {
//       autoplay: true,
//       loop: true,
//       spaceBetween: 10,
//       effect: 'fade',
//       thumbs: {
//         swiper: thumb_slider,
//       },
//     });

    

//     //switch javascript

//     const switchInput = document.getElementById('flexSwitchCheckChecked');
//     const contentElements = document.querySelectorAll('.content');
//     const monthlyLabel = document.getElementById('monthly-label');
//     const yearlyLabel = document.getElementById('yearly-label');


//     yearlyLabel.classList.add('label-color'); // Set initial accent color to yearly label


//     switchInput.addEventListener('change', function () {
//       if (this.checked) {
//         yearlyLabel.classList.add('label-color'); // Add color to label
//         monthlyLabel.classList.remove('label-color'); // Remove color from label
//       } else {
//         monthlyLabel.classList.add('label-color'); // Add color to label
//         yearlyLabel.classList.remove('label-color'); // Remove color from label
//       }
//     });

//     contentElements.forEach(function (element) {
//       if (element.classList.contains('yearly')) {
//         element.style.display = 'block';
//       } else {
//         element.style.display = 'none';
//       }
//     });     // Set the price initial state


//     switchInput.addEventListener('change', function () {
//       if (this.checked) {

//         contentElements.forEach(function (element) {
//           if (element.classList.contains('yearly')) {
//             element.style.display = 'block';
//           } else {
//             element.style.display = 'none';
//           }
//         });
//       } else {

//         contentElements.forEach(function (element) {
//           if (element.classList.contains('monthly')) {
//             element.style.display = 'block';
//           } else {
//             element.style.display = 'none';
//           }
//         });
//       }
//     });    // Add event listener to the switch input







  



//     //date picker
//     $("#datepicker1, #datepicker2").datepicker({
//       autoclose: true,
//       todayHighlight: true,
//     }).datepicker('update', new Date());



//     // Animate on Scroll
//     AOS.init({
//       duration: 1000,
//       once: true,
//     })

//     window.addEventListener("load", (event) => {
//       //isotope
//       $('.isotope-container').isotope({
//         // options
//         itemSelector: '.item',
//         layoutMode: 'masonry',
//       });

//       // Initialize Isotope
//       var $container = $('.isotope-container').isotope({
//         // options
//         itemSelector: '.item',
//         layoutMode: 'masonry',
//       });

//       $(document).ready(function () {
//         //active button
//         $('.filter-button').click(function () {
//           $('.filter-button').removeClass('active');
//           $(this).addClass('active');
//         });
//       });

//       // Filter items on button click
//       $('.filter-button').click(function () {
//         var filterValue = $(this).attr('data-filter');
//         if (filterValue === '*') {
//           // Show all items
//           $container.isotope({ filter: '*' });
//         } else {
//           // Show filtered items
//           $container.isotope({ filter: filterValue });
//         }
//       });




//   });


// })(jQuery);


(function($) {

  "use strict";

      // init Chocolat light box
      var initChocolat = function () {
        Chocolat(document.querySelectorAll('.image-link'), {
          imageSize: 'contain',
          loop: true,
        })
      }

      // init jarallax parallax
  var initJarallax = function () {
    jarallax(document.querySelectorAll(".jarallax"));

    jarallax(document.querySelectorAll(".jarallax-img"), {
      keepImg: true,
    });
  }
//search pop

var searchPopup = function () {
// open search box
$('#header').on('click', '.search-button', function (e) {
  $('.search-popup').toggleClass('is-visible');
});

$('#header').on('click', '.btn-close-search', function (e) {
  $('.search-popup').toggleClass('is-visible');
});

$(".search-popup-trigger").on("click", function (b) {
  b.preventDefault();
  $(".search-popup").addClass("is-visible"),
    setTimeout(function () {
      $(".search-popup").find("#search-popup").focus()
    }, 350)
}),
  $(".search-popup").on("click", function (b) {
    ($(b.target).is(".search-popup-close") || $(b.target).is(".search-popup-close svg") || $(b.target).is(".search-popup-close path") || $(b.target).is(".search-popup")) && (b.preventDefault(),
      $(this).removeClass("is-visible"))
  }),
  $(document).keyup(function (b) {
    "27" === b.which && $(".search-popup").removeClass("is-visible")
  })
}

  $(document).ready(function() {  
    
    initJarallax();
    // product single page
    var thumb_slider = new Swiper(".product-thumbnail-slider", {
      autoplay: true,
      loop: true,
      spaceBetween: 8,
      slidesPerView: 4,
      freeMode: true,
      watchSlidesProgress: true,
    });

    var large_slider = new Swiper(".product-large-slider", {
      autoplay: true,
      loop: true,
      spaceBetween: 10,
      effect: 'fade',
      thumbs: {
        swiper: thumb_slider,
      },
    });
    
// switch javascript
const switchInput = document.getElementById('flexSwitchCheckChecked');
const contentElements = document.querySelectorAll('.content');
const monthlyLabel = document.getElementById('monthly-label');
const yearlyLabel = document.getElementById('yearly-label');

// Only proceed with switch-related logic if the main switch input exists
if (switchInput) {

    // Set initial accent color to yearly label, only if yearlyLabel exists
    if (yearlyLabel) {
        yearlyLabel.classList.add('label-color');
    }

    switchInput.addEventListener('change', function () {
        if (this.checked) {
            if (yearlyLabel) { // Check if yearlyLabel exists before adding/removing class
                yearlyLabel.classList.add('label-color');
            }
            if (monthlyLabel) { // Check if monthlyLabel exists before adding/removing class
                monthlyLabel.classList.remove('label-color');
            }
        } else {
            if (monthlyLabel) { // Check if monthlyLabel exists before adding/removing class
                monthlyLabel.classList.add('label-color');
            }
            if (yearlyLabel) { // Check if yearlyLabel exists before adding/removing class
                yearlyLabel.classList.remove('label-color');
            }
        }
    });

    // Set the price initial state (display yearly content by default if present)
    contentElements.forEach(function (element) {
        if (element.classList.contains('yearly')) {
            element.style.display = 'block';
        } else {
            element.style.display = 'none';
        }
    });

    // Add event listener to the switch input for content display
    switchInput.addEventListener('change', function () {
        if (this.checked) {
            contentElements.forEach(function (element) {
                if (element.classList.contains('yearly')) {
                    element.style.display = 'block';
                } else {
                    element.style.display = 'none';
                }
            });
        } else {
            contentElements.forEach(function (element) {
                if (element.classList.contains('monthly')) {
                    element.style.display = 'block';
                } else {
                    element.style.display = 'none';
                }
            });
        }
    });
}

//date picker
$(document).ready(function() {
    $("#datepicker1 input").datepicker({
        autoclose: true,
        todayHighlight: true,
        orientation: "bottom"
    });

    $("#datepicker2 input").datepicker({
        autoclose: true,
        todayHighlight: true,
        orientation: "bottom"
    });

    // You can remove this line if it is causing issues with the datepicker initialization
    // .datepicker('update', new Date());

    // JavaScript function to handle guest search
    window.handleGuestSearch = function(event) {
        event.preventDefault();
        
        var pickupDate = document.getElementById('pick-up-date-input').value;
        var dropoffDate = document.getElementById('return-date-input').value;
        
        var loginUrl = "{{ route('login') }}";
        if (pickupDate && dropoffDate) {
            loginUrl += '?pickup_date=' + pickupDate + '&dropoff_date=' + dropoffDate;
        }

        window.location.href = loginUrl;
    }
});



// Animate on Scroll
AOS.init({
  duration: 1000,
  once: true,
})

    window.addEventListener("load", (event) => {
      //isotope
      $('.isotope-container').isotope({
        // options
        itemSelector: '.item',
        layoutMode: 'masonry',
      });



      // Initialize Isotope
      var $container = $('.isotope-container').isotope({
        // options
        itemSelector: '.item',
        layoutMode: 'masonry',
      });

      initChocolat();
      searchPopup();

      $(document).ready(function () {
        //active button
        $('.filter-button').click(function () {
          $('.filter-button').removeClass('active');
          $(this).addClass('active');
        });
      });

      // Filter items on button click
      $('.filter-button').click(function () {
        var filterValue = $(this).attr('data-filter');
        if (filterValue === '*') {
          // Show all items
          $container.isotope({ filter: '*' });
        } else {
          // Show filtered items
          $container.isotope({ filter: filterValue });
        }
      });

    });

    


  }); // End of a document

  

})(jQuery);

