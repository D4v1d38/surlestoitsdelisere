
$(document).ready(function(){
    $('.slider').slick({
        accessibility:true,
        arrows:false,
        autoplay: true,
        dots:true,
        fade: true,
        cssEase: 'linear'

    });
  });
          

//   $(document).ready(function(){
//     $('.list-historic').slick({
//         infinite:true,
//         arrows:false,
//         autoplay: false,
//         dots:true,
//         cssEase: 'linear',
//         slidesToShow: 2,
//         slidesToScroll: 1

//     });
//   });


  $('.list-historic').slick({
    dots: true,
    infinite: true,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 3,
    draggable:true,
    arrows:false,
    autoplay:false,
    responsive: [
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });