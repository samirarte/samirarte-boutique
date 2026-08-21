(function () {
	'use strict';

	document.documentElement.classList.add('sam-js-ready');

	document.addEventListener('DOMContentLoaded', function () {
		var mobileMenuToggle = document.querySelector('.sam-mobile-menu-toggle');
		var mobileMenu = document.getElementById('sam-mobile-menu');
		var accountRegisterLinks = Array.prototype.slice.call(document.querySelectorAll('[data-sam-account-register]'));

		function setMobileMenu(open) {
			var label;

			if (!mobileMenuToggle || !mobileMenu) {
				return;
			}

			mobileMenuToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
			mobileMenuToggle.classList.toggle('is-active', open);
			mobileMenu.classList.toggle('is-open', open);
			mobileMenu.hidden = !open;
			document.body.classList.toggle('sam-mobile-menu-open', open);

			label = mobileMenuToggle.querySelector('.screen-reader-text');
			if (label) {
				label.textContent = open ? 'Cerrar menú' : 'Abrir menú';
			}
		}

		function focusAccountRegistration(event) {
			var registrationCard = document.getElementById('registro');

			if (!registrationCard) {
				return;
			}

			event.preventDefault();
			registrationCard.scrollIntoView({
				behavior: 'smooth',
				block: 'start'
			});

			window.setTimeout(function () {
				var firstInput = registrationCard.querySelector('input:not([type="hidden"])');
				var focusTarget = firstInput || registrationCard;

				try {
					focusTarget.focus({ preventScroll: true });
				} catch (error) {
					focusTarget.focus();
				}

				if (window.history && window.history.replaceState) {
					window.history.replaceState(null, '', '#registro');
				}
			}, 450);
		}

		if (mobileMenuToggle && mobileMenu) {
			mobileMenuToggle.addEventListener('click', function () {
				setMobileMenu('true' !== mobileMenuToggle.getAttribute('aria-expanded'));
			});

			mobileMenu.addEventListener('click', function (event) {
				if (event.target.closest('a')) {
					setMobileMenu(false);
				}
			});

			document.addEventListener('keydown', function (event) {
				if ('Escape' === event.key && 'true' === mobileMenuToggle.getAttribute('aria-expanded')) {
					setMobileMenu(false);
					mobileMenuToggle.focus();
				}
			});

			window.addEventListener('resize', function () {
				if (window.innerWidth > 768) {
					setMobileMenu(false);
				}
			});
		}

		accountRegisterLinks.forEach(function (link) {
			link.addEventListener('click', focusAccountRegistration);
		});
	});
}());
