#!/usr/bin/env python3
"""Generate offline component previews from the actual theme styles; no live data."""
from pathlib import Path
import re

ROOT = Path(__file__).resolve().parents[1]


def styles(name):
    source = (ROOT / 'theme/layouts/parts' / name).read_text()
    return re.sub(r'^<style[^>]*>|</style>\s*$', '', source.strip())


def main():
    css = styles('linear-styles.blade.php')
    interface = styles('linear-interface.blade.php')
    brand = '''<span class="bl-brand-mark" aria-hidden="true"><svg viewBox="0 0 32 32" width="32" height="32" fill="none"><path d="M8 7h11l6 6v12H14l-6-6V7Z" stroke="currentColor" stroke-width="1.4"/><path d="M8 7l17 18M19 7v12H8M14 25V13h11" stroke="currentColor" stroke-width="1.1"/><circle cx="19" cy="19" r="2" fill="currentColor"/></svg></span>'''
    sidebar = '''<nav class="bl-library-directory" aria-label="Library directory"><h5>Library</h5>
<div class="bl-directory-group"><a class="bl-directory-shelf" href="index.html">Guides</a><ul><li><a href="article.html">Getting started</a></li><li><a href="article.html">Contributor handbook</a></li></ul></div>
<div class="bl-directory-group"><a class="bl-directory-shelf" href="index.html">Projects</a><ul><li><a href="article.html">Example Project</a></li><li><a href="article.html">Sample Integration</a></li></ul></div>
<div class="bl-directory-group"><a class="bl-directory-shelf" href="index.html">Reference</a><ul><li><a href="article.html">Component catalog</a></li><li><a href="article.html">Page templates</a></li></ul></div></nav>'''
    home = '''<main class="content-wrap card"><div class="preview-list-heading"><h1 class="list-heading">Shelves</h1><span class="preview-muted">Name ↑</span></div><div class="grid third">'''
    for label, description, icon in [
        ('Guides', 'Shared instructions and team knowledge.', '⌘'),
        ('Projects', 'Project documentation, implementation, and experiments.', '◇'),
        ('Reference', 'Reusable specifications, notes, and templates.', '▤'),
    ]:
        home += f'''<a class="grid-card" href="article.html"><div class="featured-image-container-wrap"><div class="featured-image-container"></div><span class="preview-card-symbol" aria-hidden="true">{icon}</span></div><div class="grid-card-content"><h2>{label}</h2><p>{description}</p></div><div class="grid-card-footer"><p>Example shelf</p><p>Placeholder content</p></div></a>'''
    home += '''</div><div class="preview-help"><span class="preview-label">PREVIEW NOTES</span><h2>Content stays in BookStack.</h2><p>The theme changes presentation. Your own shelves, books, permissions, and page content remain managed by BookStack.</p><a href="article.html">Inspect article typography →</a></div></main>'''
    article = '''<div class="breadcrumbs">Projects / Example Project / Overview</div><main class="content-wrap card"><div class="page-content"><div dir="auto"><h1 id="bkmrk-page-title">Example Project</h1><p>A placeholder document for reviewing typography, hierarchy, code, and tables.</p><p class="callout info">Illustrative content only. This preview does not connect to a wiki or perform editing actions.</p><h2 id="implementation">Implementation</h2><p>Keep implementation guides readable and link supporting references. Inline configuration such as <code>example.yaml</code> stays distinct from prose.</p><h3>Reproduce the setup</h3><pre><code>python example.py --config example.yaml\n# Store the exact configuration with each result.</code></pre><h2 id="experiments">Experiments</h2><p>Record the question, procedure, source version, and observations together. Explicitly identify unverified assumptions.</p><table><thead><tr><th>Reference</th><th>Purpose</th></tr></thead><tbody><tr><td>Implementation guide</td><td>Setup, dependencies, and operation</td></tr><tr><td>Experiment record</td><td>Procedure, evidence, and results</td></tr></tbody></table><details><summary>Example expandable note</summary><p>This uses native HTML details and the theme’s short entrance effect.</p></details><h2>References and notes</h2><blockquote>Keep sources linked and distinguish observations from interpretation.</blockquote><p>This extra section makes the document extend below the initial viewport, so you can inspect background continuity while scrolling.</p></div></div></main><div id="sibling-navigation" class="grid half"><div><a href="index.html">← Library</a></div><div><a href="#implementation">Implementation ↑</a></div></div>'''
    for dark in [False, True]:
        for is_article in [False, True]:
            filename = ('article' if is_article else 'index') + ('-dark' if dark else '') + '.html'
            # Keep the simple dark homepage URL readable.
            if dark and not is_article:
                filename = 'dark.html'
            light_url = 'article.html' if is_article else 'index.html'
            dark_url = 'article-dark.html' if is_article else 'dark.html'
            page = f'''<!doctype html><html lang="en"{' class="dark-mode"' if dark else ''}><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>BookStack Linear Theme — sample preview</title><link rel="stylesheet" href="base.css"><style id="linear-documentation-theme">{css}</style><style id="linear-interface">{interface}</style></head><body class="tri-layout"><div class="preview-note">Static component preview · Fictional sample content</div><header id="header" class="grid"><div><a class="logo bl-logo" href="{'dark.html' if dark else 'index.html'}">{brand}<span class="logo-text">Your Knowledge Base</span></a></div><div class="search-box"><input readonly aria-label="Search (preview only)" placeholder="Search documentation"></div><nav class="header-links"><div class="links"><a href="{'dark.html' if dark else 'index.html'}">Library</a><a href="{'article-dark.html' if dark else 'article.html'}">Article</a><a href="{light_url if dark else dark_url}">{'Light' if dark else 'Dark'} mode</a></div></nav></header><div class="tri-layout-container"><div class="tri-layout-sides"><div class="tri-layout-sides-content"><div class="tri-layout-left"><aside class="tri-layout-left-contents">{sidebar}</aside></div></div></div><div class="tri-layout-middle"><div class="tri-layout-middle-contents">{article if is_article else home}</div></div></div></body></html>'''
            if dark:
                page = page.replace('href="index.html"', 'href="dark.html"').replace('href="article.html"', 'href="article-dark.html"')
                # Preserve the mode switch to the light counterpart.
                page = page.replace(f'href="{dark_url}">Light mode', f'href="{light_url}">Light mode')
            (ROOT / 'preview' / filename).write_text(page)
    print('Built four offline previews from theme CSS and fictional fixtures.')


if __name__ == '__main__':
    main()
