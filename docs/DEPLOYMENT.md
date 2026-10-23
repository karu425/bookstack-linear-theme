# Deployment and recovery

This package is a visual theme, not a BookStack distribution. It neither installs
BookStack nor changes its data model. Tested against BookStack **v26.09.2**;
review view-template changes before using it on other releases.

All example paths, hostnames, service names, and repository owners are placeholders.
Replace them before running commands.

## Native installation

1. Identify the actual application directory and current `APP_THEME`. Preserve
   that value and any existing theme overrides. Back up the existing files outside
   the web root; do not commit the application environment file.
2. Copy this repository to the server or clone your own repository there.
3. Install files into the existing `themes` directory:

   ```sh
   python3 scripts/install.py --themes-dir /PATH/TO/BOOKSTACK/themes
   ```

4. Set this single value in the application's effective configuration:

   ```dotenv
   APP_THEME=linear
   ```

5. From the application directory, clear compiled views as the appropriate
   application user. If configuration was cached, refresh it according to your
   existing deployment process:

   ```sh
   php artisan view:clear
   # Only if your deployment uses cached configuration:
   php artisan config:clear
   ```

6. Check ownership/read access against neighboring theme files. No database or
   application restart is normally required for view-only changes.

## LinuxServer.io Docker / Compose

The image's persistent theme path is `/config/www/themes`. Determine which
**host directory** actually backs `/config`; do not install only into a disposable
container filesystem. Other BookStack images may use different paths.

For a host mapping such as `/PATH/TO/CONFIG:/config`, install with:

```sh
python3 scripts/install.py --themes-dir /PATH/TO/CONFIG/www/themes
```

Persist `APP_THEME: linear` in the application service's Compose environment, or
in the environment source your deployment already uses. If changing a value
supplied at container creation, apply it from the existing Compose directory:

```sh
docker compose config --quiet
docker compose up -d --no-deps YOUR_APP_SERVICE
docker compose exec -T YOUR_APP_SERVICE php /app/www/artisan view:clear
```

The first command validates without dumping secret values. Recreate only the app
service; leave the database and unrelated services alone. Do not change image
versions as part of installing this theme. If `APP_THEME` was already active and
you only update the theme files, clearing views is usually enough.

## Update an existing installation

```sh
python3 scripts/install.py \
  --themes-dir /PATH/TO/THEMES \
  --update \
  --backup-dir /PRIVATE/PATH/OUTSIDE/WEBROOT/theme-backups
```

The installer refuses to replace an existing `linear` directory by default. With
`--update`, it makes a full timestamped copy before staging the replacement.
Configuration, application core files, and database contents are never edited by
the installer. If other custom overrides must remain, merge and review them first.

## Verify

- Login renders; view source contains `linear-documentation-theme` and
  `linear-interface`.
- Homepage directory shows only shelves/books the signed-in user can read.
- Long articles have a continuous background; code, tables, anchors, and links work.
- Search, editor controls, profile menus, and mobile Info/Content tabs still work.
- Light/dark modes and reduced-motion preferences behave as expected.
- Check application logs privately if rendering fails; do not paste secret output.

## Roll back

Restore the previous `APP_THEME` value, using the same configuration source that
activated this theme. If you updated an existing `linear` theme, move the current
directory aside and copy the saved complete directory back to `themes/linear`.
Clear compiled views, and refresh cached configuration or recreate only the app
service when your configuration method requires it. Keep the backup until the
restored site is verified. Do not restore a database for a theme-only rollback.

## Upgrade compatibility

BookStack's theme system can override templates, but the overridden templates
are not a stable interface. Compare these upstream views on every application
upgrade: `layouts/parts/custom-head`, `layouts/parts/header-logo`, `home/books`,
and `home/shelves`. The directory additionally uses the permission-filtered
`Bookshelf` query and `visibleBooks` relation from the tested release.

References:

- [BookStack visual themes](https://www.bookstackapp.com/docs/admin/hacking-bookstack/)
- [BookStack font customization](https://www.bookstackapp.com/docs/admin/visual-customisation/)
- [LinuxServer.io BookStack paths](https://docs.linuxserver.io/images/docker-bookstack/)
