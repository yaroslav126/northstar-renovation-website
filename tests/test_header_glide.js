const { chromium } = require('/home/rslv/.cache/codex-runtimes/codex-primary-runtime/dependencies/node/node_modules/playwright');
const path = require('path');

const CHROMIUM_PATH = '/home/rslv/.cache/ms-playwright/chromium-1243/chrome-linux64/chrome';
const BASE_URL = 'http://127.0.0.1:8080';
const SCREENSHOT_DIR = path.resolve(__dirname, 'screenshots');

async function testHeaderGlideAndFooter() {
  const browser = await chromium.launch({
    executablePath: CHROMIUM_PATH,
    headless: true,
    args: ['--no-sandbox', '--disable-setuid-sandbox', '--disable-dev-shm-usage']
  });

  const page = await browser.newPage({
    viewport: { width: 1440, height: 900 }
  });

  console.log('1. Loading home page...');
  await page.goto(BASE_URL, { waitUntil: 'networkidle' });

  // Initial state check
  const leftTabsInitial = await page.$$eval('#ns-tabs-left .ns-nav-link', els => els.map(e => e.textContent.trim()));
  const rightTabsInitial = await page.$$eval('#ns-tabs-right .ns-nav-link', els => els.map(e => e.textContent.trim()));
  const centerBrand = await page.$eval('.ns-brand-center', el => el.textContent.trim());

  console.log('Initial Left tabs:', leftTabsInitial);
  console.log('Center brand:', centerBrand);
  console.log('Initial Right tabs:', rightTabsInitial);

  await page.screenshot({ path: path.join(SCREENSHOT_DIR, '01_header_initial.png') });

  // Check footer full length and no logo mark
  const footerBrandMark = await page.$('.ns-site-footer .ns-brand-mark');
  console.log('Footer brand mark exists?', footerBrandMark !== null ? 'YES (FAIL)' : 'NO (PASS)');
  const footerWidth = await page.$eval('.ns-site-footer .ns-container-full', el => {
    const style = window.getComputedStyle(el);
    const rect = el.getBoundingClientRect();
    return { maxWidth: style.maxWidth, width: rect.width };
  });
  console.log('Footer container dimensions:', footerWidth);
  await page.screenshot({ path: path.join(SCREENSHOT_DIR, '02_footer_full_width.png') });

  // Test 1: Click "About" (index 3 in right list)
  // Right tabs initially: Services (1), Portfolio (2), About (3), Insights (4), FAQ (5), Contact (6)
  // Clicking "About" should animate and move Services, Portfolio, About to the left side!
  console.log('\n2. Clicking "About" tab on the right side...');
  const aboutLink = await page.locator('#ns-tabs-right [data-tab-index="3"] a');
  await aboutLink.click();

  // Wait for navigation or animation
  await page.waitForTimeout(1000);

  const leftTabsAfterAbout = await page.$$eval('#ns-tabs-left .ns-nav-link', els => els.map(e => e.textContent.trim()));
  const rightTabsAfterAbout = await page.$$eval('#ns-tabs-right .ns-nav-link', els => els.map(e => e.textContent.trim()));
  console.log('After clicking About - Left tabs:', leftTabsAfterAbout);
  console.log('After clicking About - Right tabs:', rightTabsAfterAbout);
  await page.screenshot({ path: path.join(SCREENSHOT_DIR, '03_header_after_about.png') });

  // Test 2: Reverse glide - Click "Services" (now on the left side)
  // Left tabs now: Home, Services, Portfolio, About
  // Right tabs now: Insights, FAQ, Contact
  // Clicking "Services" should move Portfolio and About back to the right side!
  console.log('\n3. Clicking "Services" tab on the left side (reverse transition)...');
  const servicesLink = await page.locator('#ns-tabs-left [data-tab-index="1"] a');
  await servicesLink.click();

  await page.waitForTimeout(1000);

  const leftTabsAfterServices = await page.$$eval('#ns-tabs-left .ns-nav-link', els => els.map(e => e.textContent.trim()));
  const rightTabsAfterServices = await page.$$eval('#ns-tabs-right .ns-nav-link', els => els.map(e => e.textContent.trim()));
  console.log('After clicking Services - Left tabs:', leftTabsAfterServices);
  console.log('After clicking Services - Right tabs:', rightTabsAfterServices);
  await page.screenshot({ path: path.join(SCREENSHOT_DIR, '04_header_after_services_reverse.png') });

  // Test 3: Click Center Brand ("Northstar Renovation") - should reset to initial state (Home on left, all others on right)
  console.log('\n4. Clicking Center Brand...');
  const centerBrandLink = await page.locator('.ns-brand-center');
  await centerBrandLink.click();

  await page.waitForTimeout(600);

  const leftTabsAfterBrand = await page.$$eval('#ns-tabs-left .ns-nav-link', els => els.map(e => e.textContent.trim()));
  const rightTabsAfterBrand = await page.$$eval('#ns-tabs-right .ns-nav-link', els => els.map(e => e.textContent.trim()));
  console.log('After clicking Brand - Left tabs:', leftTabsAfterBrand);
  console.log('After clicking Brand - Right tabs:', rightTabsAfterBrand);
  await page.screenshot({ path: path.join(SCREENSHOT_DIR, '05_header_after_brand_reset.png') });

  await browser.close();
  console.log('\nAll interactive checks completed successfully!');
}

testHeaderGlideAndFooter().catch(err => {
  console.error('Test failed:', err);
  process.exit(1);
});
