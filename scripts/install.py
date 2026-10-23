#!/usr/bin/env python3
"""Install theme files only; never edit application configuration or restart services."""
import argparse
from datetime import datetime, timezone
from pathlib import Path
import shutil
import tempfile


def install(themes_dir, update=False, backup_dir=None):
    themes_dir = Path(themes_dir).expanduser().resolve(strict=True)
    if not themes_dir.is_dir():
        raise ValueError('The themes path must be an existing directory.')
    source = Path(__file__).resolve().parents[1] / 'theme'
    target = themes_dir / 'linear'
    if target.is_symlink():
        raise ValueError('Refusing to replace a symbolic-link theme directory.')
    if target.exists() and not target.is_dir():
        raise ValueError('The linear target exists but is not a directory.')
    previous = None
    if target.exists():
        if not update:
            raise ValueError('linear already exists. Use --update with --backup-dir to replace it.')
        if backup_dir is None:
            raise ValueError('--backup-dir is required for an update. Choose a path outside the web root.')
        backup_dir = Path(backup_dir).expanduser().resolve()
        if backup_dir == themes_dir or themes_dir in backup_dir.parents:
            raise ValueError('The backup directory must be outside the themes directory.')
        backup_dir.mkdir(parents=True, exist_ok=True)
        stamp = datetime.now(timezone.utc).strftime('%Y%m%dT%H%M%S%fZ')
        previous = backup_dir / ('linear-' + stamp)
        shutil.copytree(target, previous)
    staging = Path(tempfile.mkdtemp(prefix='.linear-install-', dir=themes_dir))
    retired = None
    try:
        shutil.copytree(source, staging, dirs_exist_ok=True)
        # Keep the currently installed theme intact until copying finishes.
        if target.exists():
            retired = themes_dir / (staging.name + '-previous')
            target.rename(retired)
        try:
            staging.rename(target)
        except OSError:
            if retired is not None:
                retired.rename(target)
            raise
        if retired is not None:
            shutil.rmtree(retired)  # An independent backup has already been made.
    finally:
        if staging.exists():
            shutil.rmtree(staging)
    return target, previous


def main():
    parser = argparse.ArgumentParser(description=__doc__)
    parser.add_argument('--themes-dir', required=True, help='Existing host-side BookStack themes directory')
    parser.add_argument('--update', action='store_true')
    parser.add_argument('--backup-dir', help='Outside the web root; required when replacing linear')
    args = parser.parse_args()
    try:
        target, previous = install(args.themes_dir, args.update, args.backup_dir)
    except (OSError, ValueError) as error:
        parser.exit(1, f'Installation stopped: {error}\n')
    print(f'Theme files installed at: {target}')
    if previous:
        print(f'Previous theme retained at: {previous}')
    print('Next: set APP_THEME=linear in your effective application configuration,')
    print('then clear BookStack compiled views. See README.md for your deployment type.')
    print('Configuration, credentials, application files, and services were not changed.')


if __name__ == '__main__':
    main()
