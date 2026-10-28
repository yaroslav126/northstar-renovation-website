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
		initSplitNavigation();
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

				function renderFeedback(type, text) {
					while (feedbackArea.firstChild) {
						feedbackArea.removeChild(feedbackArea.firstChild);
					}
					var alertBox = document.createElement('div');
					alertBox.className = 'ns-form-alert ' + type;
					alertBox.setAttribute('role', 'alert');
					var p = document.createElement('p');
					p.textContent = text;
					alertBox.appendChild(p);
					feedbackArea.appendChild(alertBox);
					feedbackArea.scrollIntoView({ behavior: 'smooth', block: 'center' });
				}

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
						renderFeedback('success', (res.data && res.data.message) ? res.data.message : NorthstarData.i18n.successMessage);
						form.reset();
					} else {
						var errorMsg = NorthstarData.i18n.errorMessage;
						if (res.data && res.data.errors) {
							errorMsg = Object.values(res.data.errors).join(' ');
						}
						renderFeedback('error', errorMsg);
					}
				})
				.catch(function () {
					submitBtn.disabled = false;
					submitBtn.textContent = origBtnText;
					renderFeedback('error', NorthstarData.i18n.networkError);
				});
			}
		});
	}

	/**
	 * 6. Dynamic Split Navigation with Smooth Glide Across Center Logo
	 */
	function initSplitNavigation() {
		var leftList = document.getElementById('ns-tabs-left');
		var rightList = document.getElementById('ns-tabs-right');
		if (!leftList || !rightList) return;

		var allTabLinks = document.querySelectorAll('.ns-tab-item a.ns-nav-link');
		var centerLogo = document.querySelector('.ns-brand-center');
		var isAnimating = false;

		function getTabIndex(item) {
			return parseInt(item.getAttribute('data-tab-index') || '0', 10);
		}

		function sortList(list) {
			var items = Array.from(list.children);
			items.sort(function (a, b) {
				return getTabIndex(a) - getTabIndex(b);
			});
			items.forEach(function (item) {
				list.appendChild(item);
			});
		}

		function migrateTabs(targetIdx, targetHref) {
			if (isAnimating) return;

			// On mobile drawer viewport, navigate directly
			if (window.innerWidth <= 900) {
				if (targetHref && targetHref !== window.location.href) {
					window.location.href = targetHref;
				}
				return;
			}

			var allItems = Array.from(document.querySelectorAll('.ns-tab-item'));
			if (!allItems.length) return;

			isAnimating = true;

			// Preload target URL in parallel
			if (targetHref && targetHref !== window.location.href) {
				try {
					fetch(targetHref, { credentials: 'same-origin' }).catch(function () {});
				} catch (err) {}
			}

			// 1. FIRST: Capture initial positions
			var firstRects = new Map();
			allItems.forEach(function (item) {
				firstRects.set(item, item.getBoundingClientRect());
			});

			// 2. REORDER: Distribute items left or right based on targetIdx
			allItems.forEach(function (item) {
				var idx = getTabIndex(item);
				if (idx <= targetIdx) {
					leftList.appendChild(item);
				} else {
					rightList.appendChild(item);
				}
			});

			// Maintain identical left-to-right order in both lists
			sortList(leftList);
			sortList(rightList);

			// Update active tab class
			allItems.forEach(function (item) {
				var link = item.querySelector('.ns-nav-link');
				var idx = getTabIndex(item);
				if (link) {
					if (idx === targetIdx) {
						link.classList.add('is-current');
						link.setAttribute('aria-current', 'page');
					} else {
						link.classList.remove('is-current');
						link.removeAttribute('aria-current');
					}
				}
			});

			// 3. LAST: Capture destination positions
			var lastRects = new Map();
			allItems.forEach(function (item) {
				lastRects.set(item, item.getBoundingClientRect());
			});

			// 4. INVERT: Set delta transforms
			var movedItems = [];
			allItems.forEach(function (item) {
				var first = firstRects.get(item);
				var last = lastRects.get(item);
				if (!first || !last) return;

				var deltaX = first.left - last.left;
				var deltaY = first.top - last.top;

				if (Math.abs(deltaX) > 1 || Math.abs(deltaY) > 1) {
					item.style.transition = 'none';
					item.style.transform = 'translate(' + deltaX + 'px, ' + deltaY + 'px)';
					item.style.zIndex = '25';
					movedItems.push(item);
				}
			});

			// 5. PLAY: Animate smoothly to new positions
			requestAnimationFrame(function () {
				requestAnimationFrame(function () {
					movedItems.forEach(function (item) {
						item.style.transition = 'transform 0.42s cubic-bezier(0.22, 1, 0.36, 1)';
						item.style.transform = '';
					});
				});
			});

			// Cleanup and proceed to destination
			setTimeout(function () {
				movedItems.forEach(function (item) {
					item.style.transition = '';
					item.style.transform = '';
					item.style.zIndex = '';
				});
				isAnimating = false;

				if (targetHref && targetHref !== window.location.href) {
					window.location.href = targetHref;
				}
			}, 440);
		}

		allTabLinks.forEach(function (link) {
			link.addEventListener('click', function (e) {
				var item = link.closest('.ns-tab-item');
				if (!item) return;

				var targetIdx = getTabIndex(item);
				var href = link.getAttribute('href');

				// Check if already on this page
				var currentPath = window.location.pathname.replace(/\/$/, '') || '/';
				var targetPath = '';
				try {
					targetPath = new URL(href, window.location.origin).pathname.replace(/\/$/, '') || '/';
				} catch (err) {
					targetPath = href;
				}

				if (currentPath === targetPath) {
					e.preventDefault();
					migrateTabs(targetIdx, null);
					return;
				}

				e.preventDefault();
				migrateTabs(targetIdx, href);
			});
		});

		// Clicking center logo moves tabs back to initial (Home on left, rest on right)
		if (centerLogo) {
			centerLogo.addEventListener('click', function (e) {
				var homeHref = centerLogo.getAttribute('href');
				var currentPath = window.location.pathname.replace(/\/$/, '') || '/';
				if (currentPath === '' || currentPath === '/') {
					e.preventDefault();
					migrateTabs(0, null);
					return;
				}
				e.preventDefault();
				migrateTabs(0, homeHref);
			});
		}
	}
})();


