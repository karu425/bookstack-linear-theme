<style id="linear-interface">
/* Linear-inspired surfaces; BookStack retains its navigation and permissions. */
body { --bl-ease: cubic-bezier(.22, 1, .36, 1); }
/* BookStack fixes body height to the viewport. Give overflowing documents the
   same root canvas, and use natural body height only in reading layouts. */
html:has(#linear-documentation-theme) { background-color: #fff; }
html.dark-mode:has(#linear-documentation-theme) { background-color: #0d0e10; }
body.tri-layout { height: auto; min-height: 100vh; }
.tri-layout-sides :is(.scroll-away-from-top, .scroll-away-from-bottom)::before,
.tri-layout-sides :is(.scroll-away-from-top, .scroll-away-from-bottom)::after { color: var(--bl-canvas); }
.bl-library-directory { padding-block: 8px; }
.bl-directory-group { margin-block: 0 22px; }
.bl-library-directory a { display: flex; align-items: flex-start; gap: 8px; padding: 7px 8px; border-radius: 6px; font-size: 13px; line-height: 1.5; color: var(--bl-muted); }
.bl-library-directory a:hover { background: var(--bl-subtle); color: var(--bl-ink); text-decoration: none; }
.bl-library-directory a:focus-visible { outline: 2px solid var(--color-link); outline-offset: 2px; }
.bl-library-directory .bl-directory-shelf { font-weight: 600; color: var(--bl-ink); }
.bl-library-directory ul { list-style: none; margin: 4px 0 0 16px; padding: 0 0 0 8px; border-inline-start: 1px solid var(--bl-line); }
.bl-library-directory .svg-icon { flex: 0 0 14px; margin: 3px 0 0; color: var(--color-link); }
html.dark-mode :is(.card, .grid-card),
html.dark-mode .content-wrap.card { background-color: var(--bl-surface); border-color: var(--bl-line); }
#header { min-height: 64px; }
#header .bl-logo { gap: 12px; }
.bl-brand-mark {
    display: inline-flex;
    flex: 0 0 32px;
    color: var(--color-link);
    border: 1px solid var(--bl-line);
    border-radius: 8px;
    background: var(--bl-subtle);
}
#header .bl-logo:hover { background: transparent; }
#header .search-box input { min-height: 36px; border-radius: 8px; }
#header .search-box input:focus { box-shadow: 0 0 0 3px var(--color-primary-light); }
#header .links a { padding-inline: 10px; border-radius: 6px; }
.button { border-radius: 7px; font-weight: 550; }
html.dark-mode .button:not(.outline) { color: #111322; }
:is(.card, .grid-card) { border-radius: 10px; }
.card .card-title { padding: 20px 24px 12px; }
.card .card-footer-link { border-color: var(--bl-line); padding: 14px 24px; }
.grid-card :is(.grid-card-content, .grid-card-footer) { padding: 24px; }
.grid-card :is(h2, h3) { color: var(--bl-ink); }
.grid-card .grid-card-content { border-color: var(--bl-line); }
.grid-card p { color: var(--bl-muted); }
.grid-card .featured-image-container-wrap:not(:has(.featured-image-container[style])) {
    background: var(--bl-subtle) !important;
    color: var(--color-link);
    height: 88px;
    border-bottom: 1px solid var(--bl-line);
}
.grid-card .featured-image-container-wrap:not(:has(.featured-image-container[style])) .featured-image-container { height: 88px; }
.grid-card .featured-image-container-wrap:not(:has(.featured-image-container[style])) > svg { color: var(--color-link); fill: currentColor; }
.tri-layout-middle { padding-top: 24px; }
.tri-layout-middle-contents > main.content-wrap.card { border-radius: 10px; }
.tri-layout-middle-contents > main.content-wrap.card:has(> .page-content) {
    background: var(--bl-canvas);
    border-color: transparent;
    border-radius: 0;
}
.tri-layout-middle-contents > main.content-wrap.card > h1,
h1.list-heading { font-size: 30px; font-weight: 650; letter-spacing: -.04em; line-height: 1.25; }
.tri-layout-left-contents, .tri-layout-right-contents { color: var(--bl-muted); }
.tri-layout-left-contents .entity-list-item,
.tri-layout-right-contents .entity-list-item { border-radius: 6px; font-size: 13px; }
.tri-layout-left-contents .entity-list-item.selected,
.tri-layout-right-contents .entity-list-item.selected {
    background: var(--color-primary-light);
    color: var(--color-link);
    box-shadow: inset 2px 0 var(--color-link);
}
.tri-layout-left-contents :is(.entity-list-item-name, .icon-list-item),
.tri-layout-right-contents :is(.entity-list-item-name, .icon-list-item) { font-size: 13px; }
.tri-layout-left-contents .entity-list-item:not(.selected):hover,
.tri-layout-right-contents .entity-list-item:not(.selected):hover { background: var(--bl-subtle); }
#book-tree .entity-list-item > span:first-child::after { opacity: .08; }
#sibling-navigation { opacity: 1; gap: 16px; padding-inline: 0; }
#sibling-navigation > div > a {
    border: 1px solid var(--bl-line) !important;
    border-radius: 8px;
    padding: 12px 4px;
    background: var(--bl-surface);
}
#sibling-navigation > div > a:hover { border-color: var(--color-link) !important; }
.page-content:not(.editor) :is(pre, .cm-editor) { border-radius: 8px; }
.page-content:not(.editor) :is(h1, h2, h3, h4, h5, h6) { scroll-margin-top: 28px; }
.page-content:not(.editor) h1:not(#bkmrk-page-title) { font-size: 28px; letter-spacing: -.035em; }
.page-content:not(.editor) details { border-color: var(--bl-line); border-radius: 8px; }
.page-content:not(.editor) details > summary {
    background: var(--bl-subtle);
    color: var(--bl-ink);
    cursor: pointer;
    font-size: 14px;
    border-radius: 6px;
}
@media (min-width: 1001px) {
    #header.grid { grid-template-columns: minmax(220px, 1fr) minmax(160px, 240px) auto; }
    .tri-layout-left-contents { border-inline-end: 1px solid var(--bl-line); }
}
@media (min-width: 1001px) and (max-width: 1400px) {
    .tri-layout-container { grid-template-columns: 224px minmax(0, 1fr); column-gap: 24px; }
}
@media (max-width: 600px) {
    #header .bl-logo { gap: 8px; }
    .bl-brand-mark { flex-basis: 26px; }
    .bl-brand-mark svg { width: 26px; height: 26px; }
    #header .logo-text { font-size: 13px; }
}
/* Finite, compositor-friendly movement. Content is visible without animation. */
@keyframes bl-enter {
    from { opacity: .65; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes bl-panel-enter {
    from { opacity: .75; transform: translateY(-4px); }
    to { opacity: 1; transform: translateY(0); }
}
@media (prefers-reduced-motion: no-preference) {
    html { scroll-behavior: smooth; }
    /* Animate leaf panels, not layout containers used by fixed editor tools. */
    .tri-layout-middle-contents > main.content-wrap.card,
    #home-default .card, .container.very-small > .card {
        animation: bl-enter 480ms var(--bl-ease) backwards;
    }
    .grid > .grid-card { animation: bl-enter 460ms var(--bl-ease) backwards; }
    .grid > .grid-card:nth-child(2) { animation-delay: 45ms; }
    .grid > .grid-card:nth-child(3) { animation-delay: 90ms; }
    .grid > .grid-card:nth-child(n+4) { animation-delay: 120ms; }
    :is(.grid-card, #sibling-navigation > div > a) {
        transition: transform 240ms var(--bl-ease), border-color 180ms ease, background-color 180ms ease, box-shadow 240ms ease;
    }
    #header :is(.links a, .user-name, .search-box input),
    .tri-layout-sides :is(.entity-list-item, .icon-list-item),
    .page-content:not(.editor) a, .button {
        transition: color 160ms ease, background-color 160ms ease, border-color 160ms ease, box-shadow 200ms ease;
    }
    .bl-brand-mark { transition: transform 400ms var(--bl-ease); }
    #header .bl-logo:hover .bl-brand-mark { transform: rotate(-5deg); }
    .chapter-child-menu .chapter-contents-list.open,
    .page-content:not(.editor) details[open] > :not(summary),
    #header .header-links.show { animation: bl-panel-enter 220ms var(--bl-ease); }
    @media (hover: hover) and (pointer: fine) {
        .grid-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px -16px var(--color-link); }
        #sibling-navigation > div > a:hover { transform: translateY(-2px); }
    }
}
@media (prefers-reduced-motion: reduce) {
    html { scroll-behavior: auto; }
    #header *, .grid-card, .tri-layout-middle-contents > main,
    #home-default .card, .tri-layout-sides *, #sibling-navigation *, .page-content:not(.editor) *, .button {
        animation: none !important;
        transition: none !important;
    }
}
@media print {
    .grid-card, .tri-layout-middle-contents > main { animation: none !important; transform: none !important; }
}
</style>
