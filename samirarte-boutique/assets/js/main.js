(function () {
	'use strict';

	document.documentElement.classList.add('sam-js-ready');

	document.addEventListener('DOMContentLoaded', function () {
		var mobileMenuToggle = document.querySelector('.sam-mobile-menu-toggle');
		var mobileMenu = document.getElementById('sam-mobile-menu');
		var intro = document.querySelector('.sam-opening-intro');
		var stageVideos;
		var activeVideo;
		var nextVideo;
		var backdropVideo;
		var soundButton;
		var isTransitioning = false;
		var holdTimeout = null;
		var transitionTimeout = null;
		var fallbackTimeout = null;
		var soundEnabled = false;
		var audioFadeFrames = new WeakMap();
		var CROSSFADE_DURATION = 3000;
		var HOLD_END_DURATION = 2000;
		var AUDIO_FADE_DURATION = 650;
		var themeUrl;
		var desktopVideoSrc;
		var mobileVideoSrc;
		var selectedVideoSrc;
		var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
		var giftModal = document.querySelector('.sam-opening-gift-modal');
		var giftModalCard = giftModal ? giftModal.querySelector('.sam-opening-gift-modal__card') : null;
		var giftModalTitle = giftModal ? giftModal.querySelector('.sam-opening-gift-modal__title') : null;
		var giftModalCta = giftModal ? giftModal.querySelector('.sam-opening-gift-modal__cta') : null;
		var giftModalCloseItems = giftModal ? Array.prototype.slice.call(giftModal.querySelectorAll('[data-sam-gift-modal-close]')) : [];
		var giftModalTimer = null;
		var giftModalOpen = false;
		var giftModalPreviousFocus = null;
		var giftModalForced = /(?:\?|&)giftmodal=1(?:&|$)/.test(window.location.search);
		var giftModalNoCache = /(?:\?|&)nocache=1(?:&|$)/.test(window.location.search);
		var giftModalDebug = /(?:\?|&)debugmodal=1(?:&|$)/.test(window.location.search);
		var accountRegisterLinks = Array.prototype.slice.call(document.querySelectorAll('[data-sam-account-register]'));

		function setMobileMenu(open) {
			if (!mobileMenuToggle || !mobileMenu) {
				return;
			}

			mobileMenuToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
			mobileMenuToggle.classList.toggle('is-active', open);
			mobileMenu.classList.toggle('is-open', open);
			mobileMenu.hidden = !open;
			document.body.classList.toggle('sam-mobile-menu-open', open);

			var label = mobileMenuToggle.querySelector('.screen-reader-text');
			if (label) {
				label.textContent = open ? 'Cerrar menú' : 'Abrir menú';
			}
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

		accountRegisterLinks.forEach(function (link) {
			link.addEventListener('click', focusAccountRegistration);
		});

		function logGiftModal(message) {
			if (!giftModalDebug || !window.console || !window.console.log) {
				return;
			}

			window.console.log('[Samirarte] Gift modal ' + message);
		}

		function logGiftModalValue(label, value) {
			if (!giftModalDebug || !window.console || !window.console.log) {
				return;
			}

			window.console.log('[Samirarte] ' + label, value);
		}

		logGiftModal('init');

		function canUseSessionStorage() {
			try {
				window.sessionStorage.setItem('sam_storage_test', '1');
				window.sessionStorage.removeItem('sam_storage_test');
				return true;
			} catch (error) {
				return false;
			}
		}

		function hasSeenGiftModal() {
			if (giftModalForced || giftModalNoCache) {
				return false;
			}

			if (!canUseSessionStorage()) {
				return false;
			}

			return '1' === window.sessionStorage.getItem('sam_gift_modal_seen');
		}

		function markGiftModalSeen() {
			if (!canUseSessionStorage()) {
				return;
			}

			window.sessionStorage.setItem('sam_gift_modal_seen', '1');
		}

		function shouldUseGiftModal() {
			return !!giftModal;
		}

		function introIsActive() {
			var introStyles;
			var visible;

			if (!intro) {
				return false;
			}

			introStyles = window.getComputedStyle(intro);
			visible = 'hidden' !== introStyles.visibility &&
				'none' !== introStyles.display &&
				parseFloat(introStyles.opacity || '0') > 0.05;

			return document.body.classList.contains('sam-intro-active') && visible;
		}

		function autoCheckGiftModal() {
			logGiftModal('auto check');
			logGiftModalValue('intro active:', introIsActive());
			logGiftModalValue('has seen:', hasSeenGiftModal());

			if (!giftModalOpen && (!introIsActive() || giftModalForced || giftModalNoCache) && !hasSeenGiftModal()) {
				openGiftModal();
			}
		}

		function openGiftModal() {
			var focusTarget;

			if (!giftModal) {
				logGiftModal('skipped: no-modal');
				return;
			}

			if (!shouldUseGiftModal()) {
				logGiftModal('skipped: unavailable');
				return;
			}

			if (giftModalOpen) {
				logGiftModal('skipped: already-open');
				return;
			}

			if (hasSeenGiftModal()) {
				logGiftModal('skipped: session-seen');
				return;
			}

			if (introIsActive() && !giftModalForced && !giftModalNoCache) {
				logGiftModal('skipped: intro-active');
				scheduleGiftModal(900);
				return;
			}

			giftModalPreviousFocus = document.activeElement;
			giftModal.classList.toggle('is-forced', giftModalForced);
			giftModal.hidden = false;
			giftModal.classList.remove('is-hidden');
			document.body.classList.add('sam-gift-modal-open');
			giftModalOpen = true;
			logGiftModal('shown');

			focusTarget = giftModalCta || giftModalTitle || giftModalCard;

			if (focusTarget && focusTarget.focus) {
				window.setTimeout(function () {
					focusTarget.focus();
				}, 30);
			}
		}

		function closeGiftModal() {
			if (!giftModal || !giftModalOpen) {
				return;
			}

			markGiftModalSeen();
			giftModal.classList.add('is-hidden');
			giftModal.classList.remove('is-forced');
			document.body.classList.remove('sam-gift-modal-open');
			giftModalOpen = false;

			window.setTimeout(function () {
				if (giftModal.classList.contains('is-hidden')) {
					giftModal.hidden = true;
				}
			}, 240);

			if (giftModalPreviousFocus && giftModalPreviousFocus.focus) {
				giftModalPreviousFocus.focus();
			}
		}

		function scheduleGiftModal(delay) {
			if (!giftModal) {
				logGiftModal('skipped: no-modal');
				return;
			}

			if (!shouldUseGiftModal()) {
				logGiftModal('skipped: unavailable');
				return;
			}

			if (hasSeenGiftModal()) {
				logGiftModal('skipped: session-seen');
				return;
			}

			if (giftModalTimer) {
				window.clearTimeout(giftModalTimer);
			}

			giftModalTimer = window.setTimeout(openGiftModal, delay);
		}

		function markGiftModalSeenAndUnlock() {
			markGiftModalSeen();
			document.body.classList.remove('sam-gift-modal-open');
		}

		function bindGiftModalClose(item) {
			var pointerHandled = false;

			item.addEventListener('pointerup', function (event) {
				pointerHandled = true;
				event.preventDefault();
				closeGiftModal();
			});

			item.addEventListener('touchend', function (event) {
				pointerHandled = true;
				event.preventDefault();
				closeGiftModal();
			}, { passive: false });

			item.addEventListener('click', function () {
				if (pointerHandled) {
					pointerHandled = false;
					return;
				}

				closeGiftModal();
			});
		}

		function handleGiftModalPageShow(event) {
			logGiftModalValue('pageshow persisted:', !!(event && event.persisted));

			if (intro && intro.classList.contains('is-hidden')) {
				document.body.classList.remove('sam-intro-active');
			}

			if (giftModalOpen && (giftModal.hidden || giftModal.classList.contains('is-hidden'))) {
				giftModalOpen = false;
				document.body.classList.remove('sam-gift-modal-open');
			}

			window.setTimeout(autoCheckGiftModal, event && event.persisted ? 150 : 500);
		}

		function dispatchIntroClosedEvent() {
			var event;

			if ('function' === typeof window.CustomEvent) {
				document.dispatchEvent(new CustomEvent('sam:introClosed'));
				return;
			}

			event = document.createEvent('CustomEvent');
			event.initCustomEvent('sam:introClosed', false, false, null);
			document.dispatchEvent(event);
		}

		if (giftModal) {
			giftModalCloseItems.forEach(function (item) {
				bindGiftModalClose(item);
			});

			if (giftModalCta) {
				giftModalCta.addEventListener('click', markGiftModalSeenAndUnlock);
			}

			document.addEventListener('sam:introClosed', function () {
				scheduleGiftModal(1000);
			});

			document.addEventListener('keydown', function (event) {
				if ('Escape' === event.key && giftModalOpen) {
					closeGiftModal();
				}
			});

			window.setTimeout(autoCheckGiftModal, 3000);
			window.setTimeout(autoCheckGiftModal, 7000);
			window.addEventListener('load', function () {
				window.setTimeout(autoCheckGiftModal, 250);
			});
			window.addEventListener('pageshow', handleGiftModalPageShow);
		}

		if (!intro) {
			scheduleGiftModal(2000);
			return;
		}

		stageVideos = Array.prototype.slice.call(intro.querySelectorAll('.sam-opening-intro__stage .sam-opening-intro__video'));
		backdropVideo = intro.querySelector('.sam-opening-intro__backdrop video');
		soundButton = intro.querySelector('.sam-opening-intro__sound');

		if (stageVideos.length < 2) {
			scheduleGiftModal(2000);
			return;
		}

		activeVideo = stageVideos[0];
		nextVideo = stageVideos[1];
		themeUrl = intro.dataset.themeUrl || '';
		desktopVideoSrc = themeUrl + '/assets/video/intro-samirarte-apertura.mp4';
		mobileVideoSrc = themeUrl + '/assets/video/intro-samirarte-apertura-movil-9x16.mp4';
		selectedVideoSrc = window.matchMedia && window.matchMedia('(max-width: 768px)').matches ? mobileVideoSrc : desktopVideoSrc;

		function clearTimers() {
			if (holdTimeout) {
				window.clearTimeout(holdTimeout);
				holdTimeout = null;
			}

			if (transitionTimeout) {
				window.clearTimeout(transitionTimeout);
				transitionTimeout = null;
			}

			if (fallbackTimeout) {
				window.clearTimeout(fallbackTimeout);
				fallbackTimeout = null;
			}
		}

		function prepareVideo(video) {
			if (!video) {
				return;
			}

			video.muted = true;
			video.volume = 0;
			video.playsInline = true;
			video.loop = false;
		}

		function setVideoSource(video, src) {
			var source;

			if (!video || !src) {
				return;
			}

			source = video.querySelector('source');

			if (source) {
				source.src = src;
				video.load();
				return;
			}

			video.src = src;
			video.load();
		}

		function applySelectedSources(src) {
			stageVideos.forEach(function (video) {
				setVideoSource(video, src);
			});
			setVideoSource(backdropVideo, src);
		}

		function updateSoundButton() {
			if (!soundButton) {
				return;
			}

			if (soundEnabled) {
				soundButton.textContent = 'Silenciar';
				soundButton.setAttribute('aria-pressed', 'true');
				soundButton.setAttribute('aria-label', 'Silenciar sonido del vídeo');
				soundButton.classList.add('is-sound-on');
				intro.classList.add('is-sound-on');
				intro.classList.remove('is-sound-blocked');
			} else {
				soundButton.textContent = 'Activar sonido';
				soundButton.setAttribute('aria-pressed', 'false');
				soundButton.setAttribute('aria-label', 'Activar sonido del vídeo');
				soundButton.classList.remove('is-sound-on');
				intro.classList.remove('is-sound-on', 'is-sound-blocked');
			}
		}

		function cancelAudioFade(video) {
			var frameId;

			if (!video) {
				return;
			}

			frameId = audioFadeFrames.get(video);

			if (frameId) {
				window.cancelAnimationFrame(frameId);
				audioFadeFrames.delete(video);
			}
		}

		function fadeVolume(video, from, to, duration, onComplete) {
			var startTime = null;

			if (!video) {
				return;
			}

			cancelAudioFade(video);
			video.volume = from;

			function step(timestamp) {
				var progress;
				var eased;

				if (null === startTime) {
					startTime = timestamp;
				}

				progress = Math.min((timestamp - startTime) / duration, 1);
				eased = progress * (2 - progress);
				video.volume = from + (to - from) * eased;

				if (progress < 1) {
					audioFadeFrames.set(video, window.requestAnimationFrame(step));
					return;
				}

				video.volume = to;
				audioFadeFrames.delete(video);

				if (onComplete) {
					onComplete();
				}
			}

			audioFadeFrames.set(video, window.requestAnimationFrame(step));
		}

		function playSafely(video) {
			var attempt;

			if (!video) {
				return null;
			}

			attempt = video.play();

			if (attempt && attempt.catch) {
				attempt.catch(function () {
					video.muted = true;
					video.volume = 0;
					video.play().catch(function () {});
				});
			}

			return attempt;
		}

		function clearFallbackTimerOnPlay() {
			if (fallbackTimeout) {
				window.clearTimeout(fallbackTimeout);
				fallbackTimeout = null;
			}
		}

		function resetVideo(video) {
			if (!video) {
				return;
			}

			try {
				video.currentTime = 0;
			} catch (error) {
				video.addEventListener('loadedmetadata', function () {
					video.currentTime = 0;
				}, { once: true });
			}
		}

		function closeIntro() {
			clearTimers();
			isTransitioning = false;
			soundEnabled = false;
			intro.classList.add('is-hidden');
			intro.classList.remove('is-sound-on', 'is-sound-blocked');
			document.body.classList.remove('sam-intro-active');

			stageVideos.forEach(function (video) {
				cancelAudioFade(video);
				video.muted = true;
				video.volume = 0;
				video.pause();
			});

			if (backdropVideo) {
				cancelAudioFade(backdropVideo);
				backdropVideo.muted = true;
				backdropVideo.volume = 0;
				backdropVideo.pause();
			}

			updateSoundButton();
			dispatchIntroClosedEvent();
		}

		function syncAudioForTransition() {
			nextVideo.muted = true;
			nextVideo.volume = 0;
		}

		function restoreActiveAudio() {
			if (soundEnabled) {
				activeVideo.muted = false;
				fadeVolume(activeVideo, 0, 1, AUDIO_FADE_DURATION);
			} else {
				activeVideo.muted = true;
				activeVideo.volume = 0;
			}
		}

		function swapVideos() {
			var previous = activeVideo;

			activeVideo = nextVideo;
			nextVideo = previous;
			cancelAudioFade(nextVideo);
			nextVideo.muted = true;
			nextVideo.volume = 0;
			nextVideo.pause();
			nextVideo.classList.remove('is-active');
			resetVideo(nextVideo);
			isTransitioning = false;
			restoreActiveAudio();
		}

		function beginCrossfade() {
			isTransitioning = true;
			resetVideo(nextVideo);
			resetVideo(backdropVideo);
			syncAudioForTransition();
			playSafely(nextVideo);
			playSafely(backdropVideo);

			nextVideo.offsetHeight;
			nextVideo.classList.add('is-active');
			activeVideo.classList.remove('is-active');

			transitionTimeout = window.setTimeout(swapVideos, CROSSFADE_DURATION);
		}

		function restartWithTransition(video) {
			if (video !== activeVideo || isTransitioning) {
				return;
			}

			activeVideo.pause();

			holdTimeout = window.setTimeout(beginCrossfade, HOLD_END_DURATION);
		}

		function activateSound() {
			var attempt;

			soundEnabled = true;
			cancelAudioFade(nextVideo);
			nextVideo.muted = true;
			nextVideo.volume = 0;
			activeVideo.muted = false;
			activeVideo.volume = 0;
			nextVideo.muted = true;
			nextVideo.volume = 0;
			attempt = activeVideo.play();

			if (attempt && attempt.then) {
				attempt.then(function () {
					updateSoundButton();
					fadeVolume(activeVideo, activeVideo.volume, 1, AUDIO_FADE_DURATION);
				}).catch(function () {
					soundEnabled = false;
					activeVideo.muted = true;
					activeVideo.volume = 0;
					intro.classList.add('is-sound-blocked');
					intro.classList.remove('is-sound-on');

					if (soundButton) {
						soundButton.textContent = 'Toca para activar sonido';
						soundButton.setAttribute('aria-pressed', 'false');
						soundButton.setAttribute('aria-label', 'Activar sonido del vídeo');
						soundButton.classList.remove('is-sound-on');
					}
				});
			}
		}

		function deactivateSound() {
			soundEnabled = false;
			intro.classList.remove('is-sound-on', 'is-sound-blocked');
			updateSoundButton();
			cancelAudioFade(nextVideo);
			nextVideo.muted = true;
			nextVideo.volume = 0;

			if (activeVideo.muted) {
				activeVideo.volume = 0;
				return;
			}

			fadeVolume(activeVideo, activeVideo.volume, 0, AUDIO_FADE_DURATION, function () {
				activeVideo.muted = true;
				activeVideo.volume = 0;
			});
		}

		function toggleSound(event) {
			event.preventDefault();
			event.stopPropagation();

			if (!soundEnabled) {
				activateSound();
				return;
			}

			deactivateSound();
		}

		function startIntro() {
			applySelectedSources(selectedVideoSrc);
			prepareVideo(activeVideo);
			prepareVideo(nextVideo);
			prepareVideo(backdropVideo);

			if (reduceMotion) {
				closeIntro();
				return;
			}

			resetVideo(activeVideo);
			resetVideo(nextVideo);
			activeVideo.classList.add('is-active');
			nextVideo.classList.remove('is-active');
			document.body.classList.add('sam-intro-active');
			intro.classList.remove('is-hidden', 'is-sound-on', 'is-sound-blocked');
			updateSoundButton();

			playSafely(activeVideo);
			playSafely(backdropVideo);

			fallbackTimeout = window.setTimeout(function () {
				if (activeVideo.paused && !intro.classList.contains('is-hidden')) {
					if (selectedVideoSrc !== desktopVideoSrc) {
						selectedVideoSrc = desktopVideoSrc;
						applySelectedSources(selectedVideoSrc);
						resetVideo(activeVideo);
						resetVideo(nextVideo);
						playSafely(activeVideo);
						playSafely(backdropVideo);
						return;
					}

					closeIntro();
				}
			}, 1400);
		}

		stageVideos.forEach(function (video) {
			video.addEventListener('playing', clearFallbackTimerOnPlay);

			video.addEventListener('ended', function () {
				restartWithTransition(video);
			});

			video.addEventListener('error', function () {
				window.setTimeout(function () {
					if (selectedVideoSrc !== desktopVideoSrc) {
						selectedVideoSrc = desktopVideoSrc;
						applySelectedSources(selectedVideoSrc);
						resetVideo(activeVideo);
						resetVideo(nextVideo);
						playSafely(activeVideo);
						playSafely(backdropVideo);
						return;
					}

					closeIntro();
				}, 1000);
			});
		});

		if (backdropVideo) {
			backdropVideo.addEventListener('ended', function () {
				resetVideo(backdropVideo);
				playSafely(backdropVideo);
			});
		}

		intro.addEventListener('click', function (event) {
			if (event.target.closest && event.target.closest('.sam-opening-intro__sound')) {
				return;
			}

			closeIntro();
		});

		intro.addEventListener('touchend', function (event) {
			if (event.target.closest && event.target.closest('.sam-opening-intro__sound')) {
				return;
			}

			event.preventDefault();
			closeIntro();
		}, { passive: false });

		document.addEventListener('keydown', function (event) {
			if ('Escape' === event.key && !intro.classList.contains('is-hidden')) {
				closeIntro();
			}
		});

		if (soundButton) {
			soundButton.addEventListener('click', toggleSound);
		}

		startIntro();
	});
}());
