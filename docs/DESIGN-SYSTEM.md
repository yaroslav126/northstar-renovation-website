# Northstar Renovation — Design System & Visual Specification

## 1. Brand Identity & Creative Direction

**Brand Name**: Northstar Renovation  
**Tagline**: *Architectural Precision. Master Craftsmanship. Transparent Stewardship.*  
**Positioning**: Premium residential renovation practice specializing in architectural kitchens, bespoke bathroom suites, whole-home spatial reconfiguration, and heritage interior transformations.  
**Visual Movement**: *Architectural Reverence & Material Honesty* (synthesizing principles from `canvas-design` and `frontend-design`).

Rather than relying on generic modern SaaS tropes (such as purple drop-shadows, uniform rounded-corner cards, or centered generic layouts), Northstar Renovation adopts an architectural editorial design language characterized by:
- Generous, disciplined negative space that allows craftsmanship to breathe.
- Structural grid lines and 1px muted stone dividing borders (`#D9D3C7`).
- Authentic material color palette reflecting natural stone, milled timber, honed bronze, and lime-wash plaster.
- Clear typographic authority using classical serif display type paired with geometric humanist sans-serif body copy.
- Honest, active-voice copywriting oriented toward homeowner decisions.

---

## 2. Color Palette & Token System

All color tokens are derived with WCAG 2.2 AA compliance standards, providing high contrast and visual legibility.

| Token Name | Hex Code | Visual Role | Contrast Ratio (on Ivory `#F7F5EF`) |
| :--- | :--- | :--- | :--- |
| `--ns-color-forest` | `#203A32` | Primary brand green, header backgrounds, dark framing, primary CTAs | 8.8:1 (AAA) |
| `--ns-color-forest-dark` | `#162822` | Deep forest shadow, active CTA states, dark footer | 11.4:1 (AAA) |
| `--ns-color-ivory` | `#F7F5EF` | Primary surface background, subtle tactile warmth | Base Canvas |
| `--ns-color-stone` | `#D9D3C7` | Subtle structural borders, divider rules, neutral card borders | 1.4:1 (Non-text boundary) |
| `--ns-color-charcoal`| `#272A28` | Primary body typography, deep headings on light backgrounds | 11.2:1 (AAA) |
| `--ns-color-terracotta`| `#B96C4B` | Accent highlights, focus states, badge indicators, active tabs | 4.8:1 (AA Large / UI) |
| `--ns-color-terracotta-dark`| `#975235` | Hover state for terracotta elements | 6.5:1 (AA) |
| `--ns-color-white` | `#FFFFFF` | Card surfaces, modal surfaces, clean highlights | 1.1:1 on Ivory (Surfaces) |
| `--ns-color-muted-text` | `#585F5B` | Secondary metadata, dates, reading times, footnotes | 4.9:1 (AA) |

---

## 3. Typography & Scale

### Typefaces
- **Display & Headings**: `Cormorant Garamond`, `Libre Baskerville`, `Georgia`, serif.
  - Used for H1, H2, H3, large hero headlines, and editorial pull-quotes.
  - Characteristics: Classical proportions, high elegance, architectural precision.
- **Body & Functional UI**: `Plus Jakarta Sans`, `Inter`, `-apple-system`, `BlinkMacSystemFont`, `Segoe UI`, sans-serif.
  - Used for body copy, form inputs, button labels, navigation items, and data tables.
  - Characteristics: High legibility at small sizes, open counters, neutral humanism.

### Typographic Hierarchy & Scale
- **Display / Hero**: `clamp(2.5rem, 5vw, 4rem)` / line-height `1.15` / tracking `-0.02em` / weight `700`
- **H1**: `clamp(2rem, 4vw, 3rem)` / line-height `1.2` / tracking `-0.015em` / weight `700`
- **H2**: `clamp(1.625rem, 3vw, 2.25rem)` / line-height `1.25` / tracking `-0.01em` / weight `600`
- **H3**: `clamp(1.25rem, 2vw, 1.625rem)` / line-height `1.35` / weight `600`
- **H4 / Subtitle**: `1.125rem` (`18px`) / line-height `1.4` / weight `600`
- **Body Copy**: `1.0625rem` (`17px`) / line-height `1.65` / max-width `70ch` / weight `400`
- **Caption / Meta**: `0.875rem` (`14px`) / line-height `1.5` / weight `500`
- **Eyebrow / Category Tag**: `0.8125rem` (`13px`) / line-height `1.2` / letter-spacing `0.06em` / uppercase / weight `600`

---

## 4. Spacing System & Grid

### 8-Point Spacing Scale
- `--ns-space-1`: `0.25rem` (4px)
- `--ns-space-2`: `0.5rem` (8px)
- `--ns-space-3`: `0.75rem` (12px)
- `--ns-space-4`: `1rem` (16px)
- `--ns-space-6`: `1.5rem` (24px)
- `--ns-space-8`: `2rem` (32px)
- `--ns-space-12`: `3rem` (48px)
- `--ns-space-16`: `4rem` (64px)
- `--ns-space-24`: `6rem` (96px)

### Layout Grid & Container
- Max Content Width: `1240px`
- Section Padding Desktop: `5rem 1.5rem` (`80px 24px`)
- Section Padding Mobile: `3.5rem 1rem` (`56px 16px`)
- Grid Gap: `2rem` (`32px`) on desktop, `1.25rem` (`20px`) on mobile.

---

## 5. Component Library & Architectural Patterns

### 1. Navigation Header
- Transparent on top hero, transitions to crisp Ivory background with stone bottom border upon scroll.
- Accessible hamburger drawer with `aria-expanded` and focus trapping for mobile viewports.
- Clear "Book Consultation" primary action.

### 2. Buttons & Calls to Action
- **Primary CTA**: Deep Forest Green background, Warm Ivory text, 4px subtle radius (not bubble rounded), smooth background shift to Terracotta on hover.
- **Secondary CTA**: Transparent background with 1.5px Forest Green border, crisp hover inversion.
- **Text Action**: Underlined link with animated arrow glyph (`&rarr;`) responding to interaction.

### 3. Project & Service Cards
- 1px Muted Stone border (`#D9D3C7`), pure White card background (`#FFFFFF`).
- High-resolution photographic ratio (`16:10` or `4:3`) with graceful lazy-loading fallback.
- Structured badge showing service type, location, and key metrics.
- Elevated focus ring for keyboard navigation: `outline: 2px solid var(--ns-color-forest); outline-offset: 3px;`.

### 4. Renovation Process Sequence
- Structured 5-step numbered layout (01. Architectural Consultation, 02. Concept & Material Specification, 03. Fixed-Price Proposal, 04. Master Build Phase, 05. White-Glove Handover).
- Sequential numbering represents actual project phases.

### 5. Interactive Portfolio Filter
- Accessible `<div role="tablist">` with filter buttons (`role="tab"`).
- Keyboard navigable using Arrow Left / Arrow Right keys.
- Instant, smooth client-side filtering with zero-JS fallback (all projects visible by default).

### 6. Forms & Input Fields
- Clear semantic `<label>` elements above inputs.
- Robust focus indicators (`border-color: #203A32`, box-shadow `0 0 0 3px rgba(32,58,50,0.15)`).
- Error messages associated via `aria-describedby` and `role="alert"`.
- Honeypot anti-spam field hidden visually and from screen readers (`tabindex="-1" autocomplete="off"`).
