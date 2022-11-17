'use strict';

document.addEventListener('DOMContentLoaded', function () {
	/* ===============================================================
		CUSTOM SELECT [CHOICES.JS]
	=============================================================== */
	const selectPicker = document.querySelectorAll('.choices');
	if (selectPicker.length > 0) {
		function injectClassess(x) {
			let pickerCustomClass = x.dataset.customclass;
			let pickerSevClasses = pickerCustomClass.split(' ');
			x.parentElement.classList.add.apply(x.parentElement.classList, pickerSevClasses);
		}

		selectPicker.forEach((el) => {
			const customSelect = new Choices(el, {
				placeholder: true,
				searchEnabled: false,
				itemSelectText: '',
				callbackOnInit: () => injectClassess(el),
			});
		});
	}

	/* ===============================================================
		PRODUCT DETAIL SLIDER
	=============================================================== */
	var toolGalleryThumbs = new Swiper('.tool-gallery-slider-thumbs', {
		slidesPerView: 5,
		spaceBetween: 15,
	});

	var toolGallerySlider = new Swiper('.tool-gallery-slider', {
		slidesPerView: 1,
		spaceBetween: 0,
		thumbs: {
			swiper: toolGalleryThumbs,
		},
	});

	/* ===============================================================
		GLIGHTBOX
	=============================================================== */
	const lightbox = GLightbox({
		touchNavigation: true,
	});

	/* ===============================================================
		TOOLTIPS
	=============================================================== */
	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[rel="tooltip"]'));
	var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
		return new bootstrap.Tooltip(tooltipTriggerEl);
	});
});
