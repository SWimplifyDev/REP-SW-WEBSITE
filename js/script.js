(function ($) {
	'use strict';

	/* ========================================================================= */
	/*	Page Preloader
	/* ========================================================================= */

	$(window).on('load', function () {
		// preloader
		$('.preloader').fadeOut(700);

		// Portfolio Filtering
		var containerEl = document.querySelector('.filtr-container');
		var filterizd;
		if (containerEl) {
			filterizd = $('.filtr-container').filterizr({});
		}
		//Active changer  - portfolio
		$('.portfolio-filter button').on('click', function () {
			$('.portfolio-filter button').removeClass('active');
			$(this).addClass('active');
		});
	});

	/* ========================================================================= */
	/*	Post image slider
	/* ========================================================================= */
	$('#post-thumb, #gallery-post').slick({
		infinite: true,
		arrows: false,
		autoplay: true,
		autoplaySpeed: 4000

	});
	$('#features').slick({
		infinite: true,
		arrows: false,
		autoplay: true,
		autoplaySpeed: 4000
	});


	/* ========================================================================= */
	/*	Magnific popup
	/* =========================================================================  */
	$('.image-popup').magnificPopup({
		type: 'image',
		removalDelay: 160, //delay removal by X to allow out-animation
		callbacks: {
			beforeOpen: function () {
				// just a hack that adds mfp-anim class to markup
				this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
				this.st.mainClass = this.st.el.attr('data-effect');
			}
		},
		closeOnContentClick: true,
		midClick: true,
		fixedContentPos: false,
		fixedBgPos: true
	});


	// counterUp
	function counter() {
		var oTop;
		if ($('.jsCounter').length !== 0) {
			oTop = $('.jsCounter').offset().top - window.innerHeight;
		}
		if ($(window).scrollTop() > oTop) {
			$('.jsCounter').each(function () {
				var $this = $(this),
					countTo = $this.attr('data-count');
				$({
					countNum: $this.text()
				}).animate({
					countNum: countTo
				}, {
					duration: 500,
					easing: 'swing',
					step: function () {
						$this.text(Math.floor(this.countNum));
					},
					complete: function () {
						$this.text(this.countNum);
					}
				});
			});
		}
	}

	$(window).on('scroll', function () {
		counter();
	});



	//   magnific popup video
	$('.popup-video').magnificPopup({
		disableOn: 700,
		type: 'iframe',
		mainClass: 'mfp-zoom-in',
		removalDelay: 160,
		preloader: false,
		fixedContentPos: true
	});

	/* ========================================================================= */
	/*	Testimonial Carousel
	/* =========================================================================  */
	//Init the carousel
	$('#testimonials').slick({
		infinite: true,
		arrows: false,
		autoplay: true,
		autoplaySpeed: 4000
	});


	/* ========================================================================= */
	/*	Smooth Scroll
	/* ========================================================================= */
	$('a.nav-link, .smooth-scroll').click(function (e) {
		if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
			if (target.length) {
				e.preventDefault();
				$('html, body').animate({
					scrollTop: target.offset().top
				}, 1000, function () {
					var $target = $(target);
					$target.focus();
					if ($target.is(':focus')) {
						return false;
					} else {
						$target.attr('tabindex', '-1');
						$target.focus();
					}
				});
			}
		}
	});


})(jQuery);
// End Jquery Function


/* ========================================================================= */
/*	Animated section
/* ========================================================================= */

var wow = new WOW({
	offset: 100, // distance to the element when triggering the animation (default is 0)
	mobile: false // trigger animations on mobile devices (default is true)
});
wow.init();


/* ========================================================================= */
/*	Our Skills Section Popularity Stack Graph
/* ========================================================================= */

document.addEventListener("DOMContentLoaded", function () {
    function generateSkillChart() {
        const currentYear = new Date().getFullYear();
        const years = Array.from({ length: 7 }, (_, i) => currentYear - 6 + i);

        const skillData = {
            labels: years,
            datasets: [
                {
                    label: 'Embedded Systems',
                    data: years.map((y, i) => 20 + i * 15),
                    borderColor: '#00c8ff',
                    backgroundColor: 'rgba(0, 200, 255, 0.2)',
                    borderWidth: 2,
                    fill: true
                },
                {
                    label: 'PCB Design',
                    data: years.map((y, i) => 15 + i * 15),
                    borderColor: '#ff8c00',
                    backgroundColor: 'rgba(255, 140, 0, 0.2)',
                    borderWidth: 2,
                    fill: true
                },
                {
                    label: 'DevOps & CI/CD',
                    data: years.map((y, i) => 10 + i * 15),
                    borderColor: '#4caf50',
                    backgroundColor: 'rgba(76, 175, 80, 0.2)',
                    borderWidth: 2,
                    fill: true
                },
                {
                    label: 'Software Development (Web, Desktop, Mobile)',
                    data: years.map((y, i) => 30 + i * 30),
                    borderColor: '#ff3d67',
                    backgroundColor: 'rgba(255, 61, 103, 0.2)',
                    borderWidth: 2,
                    fill: true
                }
            ]
        };

        const config = {
            type: 'line',
            data: skillData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        grid: { color: '#444' }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: '#444' }
                    }
                },
                animation: {
                    duration: 2000,
                    easing: 'easeInOutQuart'
                },
                plugins: {
                    legend: { labels: { color: '#fff' } }
                }
            }
        };

        new Chart(document.getElementById('skillChart').getContext('2d'), config);
    }

    generateSkillChart();
});