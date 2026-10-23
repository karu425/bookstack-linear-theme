#!/usr/bin/env python3
"""Build a ZIP from an explicit public-file allowlist; never include local Git state."""
import hashlib
from pathlib import Path
import zipfile

ROOT = Path(__file__).resolve().parents[1]
FILES = ['README.md', 'LICENSE', 'THIRD_PARTY_NOTICES.md', '.gitignore']
DIRECTORIES = ['theme', 'preview', 'docs', 'scripts', 'tests']


def main():
    files = [ROOT / name for name in FILES]
    for name in DIRECTORIES:
        files.extend(p for p in (ROOT / name).rglob('*')
                     if p.is_file() and not p.is_symlink()
                     and '__pycache__' not in p.parts and p.suffix != '.pyc'
                     and p.name != '.DS_Store')
    output = ROOT / 'dist'
    output.mkdir(exist_ok=True)
    archive = output / 'bookstack-linear-theme.zip'
    with zipfile.ZipFile(archive, 'w', zipfile.ZIP_DEFLATED) as bundle:
        for file in sorted(files):
            bundle.write(file, 'bookstack-linear-theme/' + file.relative_to(ROOT).as_posix())
    digest = hashlib.sha256(archive.read_bytes()).hexdigest()
    (output / (archive.name + '.sha256')).write_text(digest + '  ' + archive.name + '\n')
    print(f'Packaged {len(files)} files: {archive}')
    print(f'SHA-256: {digest}')


if __name__ == '__main__':
    main()
