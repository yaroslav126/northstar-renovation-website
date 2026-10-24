/**
 * Northstar Renovation — Main Client JavaScript
 *
 * Provides accessible mobile navigation, client-side portfolio filtering,
 * accessible accordion toggling, smooth scrolling, and AJAX contact form submission.
 */

(function () {
	'use strict';

	document.addEventListener('DOMContentLoaded', function () {
		initHeaderScroll();
		initMobileMenu();
		initPortfolioFilter();
		initFaqAccordions();
		initContactForm();
	});



	/**
	 * 1. Header scroll elevation effect.
	 */
	function initHeaderScroll() {
		var header = document.querySelector('.ns-site-header');
		if (!header) return;

		function checkScroll() {
			if (window.scrollY > 20) {
				header.classList.add('is-scrolled');
			} else {
				header.classList.remove('is-scrolled');
			}
		}

		window.addEventListener('scroll', checkScroll, { passive: true });
		checkScroll();
	}

	/**
	 * 2. Accessible Mobile Navigation Menu.
	 */
	function initMobileMenu() {
		var toggleBtn   = document.querySelector('.ns-menu-toggle');
		var navMenu     = document.querySelector('.ns-primary-nav');
		var drawerClose = document.querySelector('.ns-drawer-close');
		var toggleLabel = toggleBtn ? toggleBtn.querySelector('.ns-menu-toggle-label') : null;
		if (!toggleBtn || !navMenu) return;

		function openMenu() {
			toggleBtn.setAttribute('aria-expanded', 'true');
			toggleBtn.setAttribute('aria-label', 'Close navigation menu');
			toggleBtn.classList.add('is-active');
			navMenu.classList.add('is-open');
			document.body.classList.add('ns-menu-locked');
			if (toggleLabel) toggleLabel.textContent = 'Close';
			var firstLink = navMenu.querySelector('a, button');
			if (firstLink) firstLink.focus();
		}

		function closeMenu() {
			toggleBtn.setAttribute('aria-expanded', 'false');
			toggleBtn.setAttribute('aria-label', 'Open navigation menu');
			toggleBtn.classList.remove('is-active');
			navMenu.classList.remove('is-open');
			document.body.classList.remove('ns-menu-locked');
			if (toggleLabel) toggleLabel.textContent = 'Menu';
		}

		toggleBtn.addEventListener('click', function (e) {
			e.preventDefault();
			var isExpanded = toggleBtn.getAttribute('aria-expanded') === 'true';
			if (isExpanded) {
				closeMenu();
				toggleBtn.focus();
			} else {
				openMenu();
			}
		});

		if (drawerClose) {
			drawerClose.addEventListener('click', function (e) {
				e.preventDefault();
				closeMenu();
				toggleBtn.focus();
			});
		}

		// Close drawer when any navigation link inside is clicked
		var drawerLinks = navMenu.querySelectorAll('a');
		drawerLinks.forEach(function (link) {
			link.addEventListener('click', function () {
				if (navMenu.classList.contains('is-open')) {
					closeMenu();
				}
			});
		});

		// Close menu on Escape key
		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape' && navMenu.classList.contains('is-open')) {
				closeMenu();
				toggleBtn.focus();
			}
		});

		// Automatically close menu when expanding to desktop viewport
		window.addEventListener('resize', function () {
			if (window.innerWidth > 768 && navMenu.classList.contains('is-open')) {
				closeMenu();
			}
		});
	}


	/**
	 * 3. Client-Side Portfolio Category Filtering.
	 */
	function initPortfolioFilter() {
		var filterButtons = document.querySelectorAll('.ns-filter-btn');
		var projectCards  = document.querySelectorAll('.ns-project-item');
		if (!filterButtons.length || !projectCards.length) return;

		filterButtons.forEach(function (button) {
			button.addEventListener('click', function () {
				var targetCategory = this.getAttribute('data-filter');

				// Update active state and ARIA attributes
				filterButtons.forEach(function (btn) {
					btn.classList.remove('is-active');
					btn.setAttribute('aria-selected', 'false');
				});
				this.classList.add('is-active');
				this.setAttribute('aria-selected', 'true');

				// Filter cards
				projectCards.forEach(function (card) {
					var cardCategory = card.getAttribute('data-category');
					if (targetCategory === 'all' || cardCategory === targetCategory) {
						card.style.display = '';
						card.removeAttribute('aria-hidden');
					} else {
						card.style.display = 'none';
						card.setAttribute('aria-hidden', 'true');
					}
				});
			});
		});

		// Keyboard navigation for tablist
		var tabList = document.querySelector('.ns-portfolio-filter');
		if (tabList) {
			tabList.addEventListener('keydown', function (e) {
				var tabs = Array.from(filterButtons);
				var activeIndex = tabs.indexOf(document.activeElement);
				if (activeIndex === -1) return;

				if (e.key === 'ArrowRight' || e.key === 'ArrowDown') {
					e.preventDefault();
					var nextIndex = (activeIndex + 1) % tabs.length;
					tabs[nextIndex].focus();
					tabs[nextIndex].click();
				} else if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') {
					e.preventDefault();
					var prevIndex = (activeIndex - 1 + tabs.length) % tabs.length;
					tabs[prevIndex].focus();
					tabs[prevIndex].click();
				}
			});
		}
	}

	/**
	 * 4. Accessible FAQ Accordions.
	 */
	function initFaqAccordions() {
		var headers = document.querySelectorAll('.ns-accordion-header');
		headers.forEach(function (header) {
			header.addEventListener('click', function () {
				var isExpanded = this.getAttribute('aria-expanded') === 'true';
				var targetId   = this.getAttribute('aria-controls');
				var targetBody = document.getElementById(targetId);

				this.setAttribute('aria-expanded', !isExpanded);
				if (targetBody) {
					targetBody.hidden = isExpanded;
				}
			});
		});
	}

	/**
	 * 5. Interactive & AJAX Contact Form Submission.
	 */
	function initContactForm() {
		var form = document.querySelector('#ns-consultation-form');
		var feedbackArea = document.querySelector('#contact-feedback');
		if (!form || !feedbackArea) return;

		form.addEventListener('submit', function (e) {
			// Client-side quick check
			var nameInput  = form.querySelector('[name="full_name"]');
			var emailInput = form.querySelector('[name="email"]');
			var scopeInput = form.querySelector('[name="project_scope"]');
			var termsInput = form.querySelector('[name="privacy_consent"]');

			if (!nameInput.value.trim() || !emailInput.value.trim() || !termsInput.checked) {
				return; // Allow native HTML5 validation bubbles to display
			}

			if (window.NorthstarData && window.NorthstarData.ajaxUrl) {
				e.preventDefault();

				var submitBtn = form.querySelector('button[type="submit"]');
				var origBtnText = submitBtn.textContent;
				submitBtn.disabled = true;
				submitBtn.textContent = NorthstarData.i18n.sending || 'Sending request...';

				var formData = new FormData(form);
				formData.append('action', 'northstar_submit_quote');

				fetch(NorthstarData.ajaxUrl, {
					method: 'POST',
					body: formData,
					headers: {
						'X-Requested-With': 'XMLHttpRequest'
					}
				})
				.then(function (response) {
					return response.json();
				})
				.then(function (res) {
					submitBtn.disabled = false;
					submitBtn.textContent = origBtnText;

					if (res.success) {
						feedbackArea.innerHTML = '<div class="ns-form-alert success" role="alert"><p>' + (res.data.message || NorthstarData.i18n.successMessage) + '</p></div>';
						form.reset();
						feedbackArea.scrollIntoView({ behavior: 'smooth', block: 'center' });
					} else {
						var errorMsg = NorthstarData.i18n.errorMessage;
						if (res.data && res.data.errors) {
							errorMsg = Object.values(res.data.errors).join(' ');
						}
						feedbackArea.innerHTML = '<div class="ns-form-alert error" role="alert"><p>' + errorMsg + '</p></div>';
						feedbackArea.scrollIntoView({ behavior: 'smooth', block: 'center' });
					}
				})
				.catch(function () {
					submitBtn.disabled = false;
					submitBtn.textContent = origBtnText;
					feedbackArea.innerHTML = '<div class="ns-form-alert error" role="alert"><p>' + NorthstarData.i18n.networkError + '</p></div>';
					feedbackArea.scrollIntoView({ behavior: 'smooth', block: 'center' });
				});
			}
		});
	}
})();


