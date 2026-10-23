# Deploy with an AI coding assistant

Give an assistant access to this repository and an **already authorized**
BookStack environment, then paste the prompt below. Replace placeholders locally.
Keep passwords, private keys, application keys, database dumps, and real site
content outside the prompt and outside this repository.

```text
Install the BookStack Linear Theme from this repository into my existing BookStack.

Environment (replace these placeholders):
- Deployment type: NATIVE or LINUXSERVER_DOCKER
- BookStack version: YOUR_VERSION
- Application/Compose directory: /PATH/TO/APPLICATION
- Host-side themes directory: /PATH/TO/THEMES
- Application service name, if Docker: YOUR_APP_SERVICE
- Private theme-backup directory outside the web root: /PATH/TO/THEME_BACKUPS
- Wiki URL for browser verification: https://wiki.example.com
- SSH connection, if needed: YOUR_ALREADY_CONFIGURED_SSH_HOST

Read README.md, docs/DEPLOYMENT.md, and scripts/install.py first.
Inspect the actual version, paths, active APP_THEME, persistent mounts, and how
configuration reaches the application. Do not print a whole .env file or resolved
Compose configuration. Check only the specific non-secret settings needed.

Before editing, preserve the previous APP_THEME value and back up existing theme
files outside the web root. Review customizations in the current theme: this
package selects a separate theme and does not automatically merge overrides.
Keep any required existing behavior; explain a specific conflict if there is one.

Run scripts/install.py for the confirmed themes path. Never overwrite an existing
linear directory without --update and a separate --backup-dir. Check the file
owner and permissions against the application user; never use chmod 777.

Set APP_THEME=linear in the effective, persistent configuration. Clear compiled
views with the correct artisan path for this deployment. If a Compose environment
change requires recreation, recreate only the application service with --no-deps;
do not pull or upgrade images, restart the database, or change unrelated services.

Do not reset APP_KEY, credentials, accounts, permissions, content, or database
settings. Do not create public access, a tunnel, a new deployment, or a new domain.
Do not copy real site screenshots or environment files into this repository.

Verify the login page and, using an authorized browser session, the homepage,
permission-filtered directory, a long article, search, editor controls, mobile
navigation, and light/dark modes. Confirm no horizontal overflow and that the
background remains continuous below the first viewport. Check reduced-motion
behavior if the environment supports testing it; report the testing limit if not.

If the theme breaks rendering, restore the previous APP_THEME and prior files,
then clear views again. Finish with what changed, what you verified, the previous
APP_THEME value, the private backup location, and exact rollback steps. Do not
claim that a static preview verifies a live installation.
```

An assistant still needs your existing access method and any approvals required
by your environment. This prompt supplies a workflow, not credentials or access.
