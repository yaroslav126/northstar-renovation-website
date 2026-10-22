const { chromium } = require('playwright');
const path = require('path');

const pages = [
  { name: 'services', url: 'http://127.0.0.1:8080/services/' },
  { name: 'portfolio', url: 'http://127.0.0.1:8080/portfolio/' },
  { name: 'about', url: 'http://127.0.0.1:8080/about/' },
  { name: 'contact', url: 'http://127.0.0.1:8080/contact/' },
  { name: 'blog', url: 'http://127.0.0.1:8080/blog/' },
  { name: 'faq', url: 'http://127.0.0.1:8080/faq/' },
  { name: 'home-mobile', url: 'http://127.0.0.1:8080/', viewport: { width: 375, height: 812 } },
  { name: 'portfolio-mobile', url: 'http://127.0.0.1:8080/portfolio/', viewport: { width: 375, height: 812 } },
  { name: 'about-mobile', url: 'http://127.0.0.1:8080/about/', viewport: { width: 375, height: 812 } },
];

(async () => {
  const browser = await chromium.launch({ executablePath: '/home/rslv/.cache/ms-playwright/chromium-1243/chrome-linux64/chrome' });
  for (const p of pages) {
    const context = await browser.newContext({ viewport: p.viewport || { width: 1366, height: 768 } });
    const page = await context.newPage();
    await page.goto(p.url, { waitUntil: 'networkidle' });
    await page.evaluate(async () => {
      await new Promise((resolve) => {
        let totalHeight = 0;
        const distance = 400;
        const timer = setInterval(() => {
          const scrollHeight = document.body.scrollHeight;
          window.scrollBy(0, distance);
          totalHeight += distance;
          if (totalHeight >= scrollHeight) {
            clearInterval(timer);
            window.scrollTo(0, 0);
            resolve();
          }
        }, 80);
      });
    });
    await page.waitForTimeout(600);
    const filename = path.join(__dirname, 'screenshots', p.name + '-scrolled.png');
    await page.screenshot({ path: filename, fullPage: true });
    await context.close();
    console.log('Saved', p.name);
  }
  await browser.close();
})();
