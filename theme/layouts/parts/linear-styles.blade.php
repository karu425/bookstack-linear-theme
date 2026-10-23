<style id="linear-documentation-theme">
/* BookStack Linear Theme · Swiss typography, native system fonts, no external assets.
   Reading styles stay out of editors, exports, and administrative settings. */
body {
    --font-body: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif;
    --font-heading: var(--font-body);
    --font-code: "SFMono-Regular", Consolas, "Liberation Mono", Menlo, monospace;
    --bl-canvas: #ffffff;
    --bl-surface: #ffffff;
    --bl-ink: #202126;
    --bl-muted: #646872;
    --bl-line: #e7e8ec;
    --bl-subtle: #f6f7f9;
    --color-primary: #515fbe;
    --color-primary-light: #eef0ff;
    --color-link: #4654ad;
    font-family: var(--font-body);
    color: var(--bl-ink);
    background: var(--bl-canvas);
    -webkit-font-smoothing: antialiased;
}
html.dark-mode body {
    --bl-canvas: #0d0e10;
    --bl-surface: #131416;
    --bl-ink: #eeeef0;
    --bl-muted: #a0a3ad;
    --bl-line: #292b31;
    --bl-subtle: #1a1c20;
    --color-primary: #a3adff;
    --color-primary-light: #232943;
    --color-link: #a3adff;
}
/* One quiet navigation bar; retain the native menus and search behaviour. */
#header {
    /* BookStack's primary-background utility uses !important. */
    background: var(--bl-surface) !important;
    color: var(--bl-ink);
    border-bottom: 1px solid var(--bl-line);
    box-shadow: none;
    min-height: 68px;
    column-gap: 24px;
}
#header .logo-text {
    color: var(--bl-ink);
    font-size: 15px;
    font-weight: 650;
    line-height: 1.35;
    letter-spacing: -0.035em;
}
#header .logo { max-width: 100%; }
#header .links a, #header .user-name, #header .mobile-menu-toggle {
    color: var(--bl-ink);
    font-size: 14px;
}
#header .mobile-menu-toggle { border-color: var(--bl-line); fill: currentColor; }
#header .logo:hover, #header .links a:hover, #header .user-name:hover {
    background: var(--bl-subtle);
    color: var(--bl-ink);
}
#header .search-box input {
    background: var(--bl-subtle);
    border: 1px solid var(--bl-line);
    color: var(--bl-ink);
    border-radius: 6px;
    font-size: 14px;
}
#header .search-box input::placeholder { color: var(--bl-muted); opacity: 1; }
#header #header-search-box-button { color: var(--bl-muted); opacity: 1; }
#header .search-box input:focus { border-color: var(--color-link); }
#header .header-links { background-color: var(--bl-surface); }
#header a:focus-visible, #header button:focus-visible {
    outline: 2px solid var(--color-link);
    outline-offset: 3px;
}
/* Cards follow the same grid and thin rules as the document itself. */
.card, .grid-card {
    background-color: var(--bl-surface);
    border: 1px solid var(--bl-line);
    border-radius: 6px;
    box-shadow: none;
}
.grid-card:hover { border-color: var(--color-link); box-shadow: none; }
.card-title {
    color: var(--bl-ink);
    font-size: 15px;
    font-weight: 600;
    letter-spacing: -0.015em;
}
.grid-card h2 { font-size: 21px; font-weight: 600; letter-spacing: -0.025em; }
.grid-card p { font-size: 14px; line-height: 1.6; }
/* Let BookStack keep its responsive columns, mobile tabs, and sidebars. */
.tri-layout-middle-contents { max-width: 940px; margin-inline: auto; }
.tri-layout-middle-contents > main.content-wrap.card {
    padding: 40px clamp(20px, 4vw, 64px) 56px;
}
.tri-layout-left-contents, .tri-layout-right-contents { font-size: 13px; line-height: 1.55; }
.tri-layout-left-contents > *, .tri-layout-right-contents > * { opacity: 1; }
.tri-layout-left-contents h5, .tri-layout-right-contents h5 {
    font-size: 11px;
    font-weight: 650;
    letter-spacing: 0.085em;
    text-transform: uppercase;
    color: var(--bl-muted);
}
.breadcrumbs { font-size: 12px; opacity: 1; color: var(--bl-muted); }
.tri-layout-mobile-tabs { box-shadow: none; border-color: var(--bl-line); }
/* Scope document geometry to reading views, never a contenteditable area. */
.page-content:not(.editor) {
    max-width: 760px;
    font-size: 16px;
    line-height: 1.7;
    letter-spacing: -0.008em;
    color: var(--bl-ink);
}
.page-content:not(.editor) :is(h1, h2, h3, h4, h5, h6) {
    font-family: var(--font-heading);
    font-weight: 650;
    line-height: 1.25;
    color: var(--bl-ink);
    scroll-margin-top: 24px;
}
.page-content:not(.editor) h1 {
    font-size: clamp(30px, 3vw, 40px);
    letter-spacing: -0.045em;
    margin: 8px 0 28px;
}
.page-content:not(.editor) h2 {
    font-size: 26px;
    letter-spacing: -0.035em;
    margin: 48px 0 18px;
    padding-bottom: 12px;
    border-bottom: 1px solid var(--bl-line);
}
.page-content:not(.editor) h3 { font-size: 20px; letter-spacing: -0.025em; margin: 32px 0 14px; }
.page-content:not(.editor) h4 { font-size: 17px; margin: 24px 0 12px; }
.page-content:not(.editor) p { margin: 0 0 20px; }
.page-content:not(.editor) :is(ul, ol) { margin-block: 12px 24px; }
.page-content:not(.editor) li { margin-block: 6px; }
.page-content:not(.editor) li :is(p, ul, ol) { margin-block: 8px; }
.page-content:not(.editor) a { text-underline-offset: 3px; text-decoration-thickness: 1px; }
.page-content:not(.editor) :is(code, pre, kbd, .cm-editor) {
    font-family: var(--font-code);
    font-size: 13px;
    letter-spacing: 0;
    line-height: 1.65;
}
.page-content:not(.editor) :not(pre) > code {
    background: var(--bl-subtle);
    color: var(--bl-ink);
    border: 1px solid var(--bl-line);
    border-radius: 4px;
    padding: 2px 5px;
    overflow-wrap: anywhere;
}
.page-content:not(.editor) :is(pre, .cm-editor) {
    border: 1px solid var(--bl-line);
    border-radius: 6px;
    background: var(--bl-subtle);
    margin-block: 24px;
    max-width: 100%;
}
.page-content:not(.editor) pre { padding: 18px 20px; overflow-x: auto; }
.page-content:not(.editor) pre code { background: none; color: inherit; padding: 0; border: 0; }
.page-content:not(.editor) .cm-scroller { font-family: var(--font-code); line-height: 1.65; }
.page-content:not(.editor) .cm-content { padding-block: 14px; }
.page-content:not(.editor) blockquote {
    border-inline-start: 2px solid var(--color-link);
    padding-inline-start: 20px;
    color: var(--bl-muted);
    font-style: normal;
}
.page-content:not(.editor) .callout { border-radius: 4px; font-size: 15px; line-height: 1.65; }
.page-content:not(.editor) .callout.info {
    background: var(--color-primary-light);
    border-color: var(--color-link);
    color: var(--bl-ink);
}
.page-content:not(.editor) table {
    font-size: 14px;
    line-height: 1.55;
    border-color: var(--bl-line);
}
.page-content:not(.editor) :is(th, td) { padding: 12px 14px; border-color: var(--bl-line); }
.page-content:not(.editor) th { background: var(--bl-subtle); font-weight: 600; }
.page-content:not(.editor) hr { border: 0; border-top: 1px solid var(--bl-line); margin-block: 36px; }
@media (max-width: 1000px) {
    #header { min-height: 60px; }
    #header .logo-text { font-size: 16px; }
}
@media (max-width: 600px) {
    #header { padding-inline: 16px; }
    #header .logo-text { font-size: 14px; letter-spacing: -0.025em; }
    .tri-layout-middle-contents > main.content-wrap.card { padding: 24px 18px 36px; }
    .page-content:not(.editor) h2 { font-size: 23px; margin-top: 36px; }
    .page-content:not(.editor) :is(th, td) { padding: 8px; font-size: 13px; }
}
@media print {
    body { background: #fff; color: #000; }
    .tri-layout-middle-contents > main.content-wrap.card { padding: 0; border: 0; }
    .page-content:not(.editor) { max-width: none; color: #000; }
    .page-content:not(.editor) :is(h1, h2, h3, h4, h5, h6) { color: #000; }
}
</style>
