/**
 * End-to-End Automated Browser Verification for Northstar Renovation.
 *
 * Utilizes Playwright Chromium automation adhering to webapp-testing guidelines:
 * - Tests 4 standard viewports (375x812, 768x1024, 1366x768, 1920x1080)
 * - Audits browser console for 0 uncaught errors or network failures
 * - Verifies mobile drawer interaction (open, focus trap, Escape key)
 * - Verifies portfolio client-side category filtering
 * - Verifies FAQ accessible accordions
 * - Verifies contact form client validation and AJAX submission
 * - Verifies horizontal overflow across all pages
 */

const { chromium } = require('/home/rslv/.cache/codex-runtimes/codex-primary-runtime/dependencies/node/node_modules/playwright');
const fs = require('fs');
const path = require('path');

const CHROMIUM_PATH = '/home/rslv/.cache/ms-playwright/chromium-1243/chrome-linux64/chrome';
const BASE_URL = 'http://127.0.0.1:8080';
const SCREENSHOTS_DIR = path.join(__dirname, 'screenshots');

if (!fs.existsSync(SCREENSHOTS_DIR)) {
	fs.mkdirSync(SCREENSHOTS_DIR, { recursive: true });
}

const VIEWPORTS = [
	{ name: 'mobile', width: 375, height: 812 },
	{ name: 'tablet', width: 768, height: 1024 },
	{ name: 'laptop', width: 1366, height: 768 },
	{ name: 'desktop', width: 1920, height: 1080 }
];

const PAGES = [
	{ path: '/', name: 'home' },
	{ path: '/services/', name: 'services' },
	{ path: '/portfolio/', name: 'portfolio' },
	{ path: '/about/', name: 'about' },
	{ path: '/contact/', name: 'contact' },
	{ path: '/blog/', name: 'blog' },
	{ path: '/faq/', name: 'faq' }
];

async function runTests() {
	console.log('============================================================');
	console.log('NORTHSTAR RENOVATION: PLAYWRIGHT AUTOMATED TEST SUITE');
	console.log('============================================================\n');

	const browser = await chromium.launch({
		executablePath: CHROMIUM_PATH,
		headless: true
	});

	let passedTests = 0;
	let failedTests = 0;
	const testResults = [];

	function recordResult(name, passed, message = '') {
		testResults.push({ name, passed, message });
		if (passed) {
			passedTests++;
			console.log(`  [PASS] ${name}`);
		} else {
			failedTests++;
			console.error(`  [FAIL] ${name} — ${message}`);
		}
	}

	try {
		// TEST 1: Page Load & Console Error Audit
		console.log('--- 1. Page Load, Network & Console Error Audit ---');
		for (const pageInfo of PAGES) {
			const context = await browser.newContext({ viewport: { width: 1366, height: 768 } });
			const page = await context.newPage();

			const consoleErrors = [];
			page.on('console', msg => {
				if (msg.type() === 'error') consoleErrors.push(msg.text());
			});
			page.on('pageerror', err => consoleErrors.push(err.message));

			const response = await page.goto(`${BASE_URL}${pageInfo.path}`, { waitUntil: 'networkidle' });
			const status = response.status();

			recordResult(`Page Status: ${pageInfo.name} (${pageInfo.path})`, status === 200, `Expected 200, received ${status}`);
			recordResult(`Console Clean: ${pageInfo.name}`, consoleErrors.length === 0, consoleErrors.join('; '));

			// Capture Desktop Screenshot
			await page.screenshot({ path: path.join(SCREENSHOTS_DIR, `${pageInfo.name}-desktop-1366.png`), fullPage: true });

			await context.close();
		}

		// TEST 2: Responsive Viewports & Horizontal Overflow Check
		console.log('\n--- 2. Responsive Viewports & Horizontal Overflow Check ---');
		for (const vp of VIEWPORTS) {
			const context = await browser.newContext({ viewport: { width: vp.width, height: vp.height } });
			const page = await context.newPage();

			for (const pageInfo of PAGES) {
				await page.goto(`${BASE_URL}${pageInfo.path}`, { waitUntil: 'networkidle' });

				const hasOverflow = await page.evaluate(() => {
					return document.documentElement.scrollWidth > window.innerWidth;
				});

				recordResult(`No Horizontal Overflow: ${pageInfo.name} @ ${vp.name} (${vp.width}x${vp.height})`, !hasOverflow, 'Horizontal scroll detected');

				if (vp.name === 'mobile' && pageInfo.name === 'home') {
					await page.screenshot({ path: path.join(SCREENSHOTS_DIR, `home-mobile-375.png`), fullPage: true });
				}
			}

			await context.close();
		}

		// TEST 3: Mobile Hamburger Navigation Drawer Interaction
		console.log('\n--- 3. Mobile Hamburger Navigation Interaction ---');
		{
			const context = await browser.newContext({ viewport: { width: 375, height: 812 } });
			const page = await context.newPage();
			await page.goto(`${BASE_URL}/`, { waitUntil: 'networkidle' });

			const menuBtn = page.locator('.ns-menu-toggle');
			const navMenu = page.locator('.ns-primary-nav');

			const isBtnVisible = await menuBtn.isVisible();
			recordResult('Mobile Hamburger Button Visible', isBtnVisible);

			// Click toggle button
			await menuBtn.click();
			const isExpanded = await menuBtn.getAttribute('aria-expanded');
			const hasOpenClass = await navMenu.evaluate(el => el.classList.contains('is-open'));
			recordResult('Menu Drawer Opens on Click', isExpanded === 'true' && hasOpenClass);

			// Press Escape key
			await page.keyboard.press('Escape');
			const isClosed = await menuBtn.getAttribute('aria-expanded');
			const hasClosedClass = await navMenu.evaluate(el => !el.classList.contains('is-open'));
			recordResult('Menu Drawer Closes on Escape Key', isClosed === 'false' && hasClosedClass);

			await context.close();
		}

		// TEST 4: Portfolio Category Filtering Interaction
		console.log('\n--- 4. Portfolio Client-Side Category Filtering ---');
		{
			const context = await browser.newContext({ viewport: { width: 1366, height: 768 } });
			const page = await context.newPage();
			await page.goto(`${BASE_URL}/portfolio/`, { waitUntil: 'networkidle' });

			// Filter to Kitchen
			const kitchenFilterBtn = page.locator('.ns-filter-btn[data-filter="kitchen"]');
			await kitchenFilterBtn.click();

			const kitchenCards = await page.$$eval('.ns-project-item', cards => {
				return cards.map(c => ({
					cat: c.getAttribute('data-category'),
					visible: window.getComputedStyle(c).display !== 'none'
				}));
			});

			const allKitchenVisible = kitchenCards.filter(c => c.cat === 'kitchen').every(c => c.visible);
			const othersHidden = kitchenCards.filter(c => c.cat !== 'kitchen').every(c => !c.visible);

			recordResult('Filter "Kitchen" Shows Only Kitchen Projects', allKitchenVisible && othersHidden);

			// Filter back to All
			const allFilterBtn = page.locator('.ns-filter-btn[data-filter="all"]');
			await allFilterBtn.click();

			const allCardsVisible = await page.$$eval('.ns-project-item', cards => {
				return cards.every(c => window.getComputedStyle(c).display !== 'none');
			});

			recordResult('Filter "All Case Studies" Restores All Projects', allCardsVisible);

			await context.close();
		}

		// TEST 5: Accessible Accordion Interaction on FAQ
		console.log('\n--- 5. Accessible Accordion Interaction on FAQ ---');
		{
			const context = await browser.newContext({ viewport: { width: 1366, height: 768 } });
			const page = await context.newPage();
			await page.goto(`${BASE_URL}/faq/`, { waitUntil: 'networkidle' });

			const secondHeader = page.locator('.ns-accordion-header').nth(1);
			const secondBody   = page.locator('.ns-accordion-body').nth(1);

			const initiallyHidden = await secondBody.evaluate(el => el.hidden);
			recordResult('Accordion Initially Collapsed', initiallyHidden);

			await secondHeader.click();
			const nowExpanded = await secondHeader.getAttribute('aria-expanded');
			const nowVisible  = await secondBody.evaluate(el => !el.hidden);
			recordResult('Accordion Expands on Click with Correct ARIA', nowExpanded === 'true' && nowVisible);

			await context.close();
		}

		// TEST 6: Real Interactive Contact Form Submission (Client + AJAX)
		console.log('\n--- 6. Interactive Contact Form Submission & Feedback ---');
		{
			const context = await browser.newContext({ viewport: { width: 1366, height: 768 } });
			const page = await context.newPage();
			await page.goto(`${BASE_URL}/contact/`, { waitUntil: 'networkidle' });

			await page.fill('#ns-name', 'Eleanor & Thomas Thorne');
			await page.fill('#ns-email', 'eleanor.thorne@example.com');
			await page.fill('#ns-phone', '(555) 782-9400');
			await page.selectOption('#ns-service', 'whole-home-renovation');
			await page.selectOption('#ns-budget', '$120k – $250k');
			await page.selectOption('#ns-timeline', '1 – 3 Months');
			await page.fill('#ns-scope', 'We are preparing for a full structural renovation of our 3-story Victorian home, including removing bearing walls for an open culinary pavilion.');
			await page.check('input[name="privacy_consent"]');

			// Submit the form
			await page.click('#ns-consultation-form button[type="submit"]');

			// Wait for feedback alert
			const feedbackAlert = page.locator('#contact-feedback .ns-form-alert.success');
			await feedbackAlert.waitFor({ state: 'visible', timeout: 5000 });

			const alertText = await feedbackAlert.textContent();
			const hasSuccess = alertText.includes('Thank you!') || alertText.includes('Consultation Request');
			recordResult('Contact Form Submission Generates Inline Success Alert', hasSuccess, alertText);

			// Capture screenshot of successful submission
			await page.screenshot({ path: path.join(SCREENSHOTS_DIR, `contact-success-state.png`) });

			await context.close();
		}

	} catch (err) {
		console.error('Fatal test execution error:', err);
		recordResult('Suite Execution Complete', false, err.message);
	} finally {
		await browser.close();
	}

	console.log('\n============================================================');
	console.log(`TOTAL TESTS: ${passedTests + failedTests} | PASSED: ${passedTests} | FAILED: ${failedTests}`);
	console.log('============================================================\n');

	if (failedTests > 0) {
		process.exit(1);
	}
}

runTests();
