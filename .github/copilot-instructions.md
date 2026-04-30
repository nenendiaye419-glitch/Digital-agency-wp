# AI Coding Agent Instructions for Digital-agency-wp

## Project Overview
**Digital-agency-wp** is a WordPress 6.7+ installation built for digital agencies using Elementor page builder and Astra theme. The site emphasizes client services, multilingual support, and SEO optimization.

## Architecture Overview

### Core Components
- **Framework**: WordPress 6.7 (check `wp-config.php` for DB settings: `agency` database, `wp_` prefix)
- **Theme**: Astra with Elementor visual editor integration
- **Page Builder**: Elementor (extensive plugin at `wp-content/plugins/elementor/`)
- **Security**: Solid Security (Better WP Security) with file editing disabled via `DISALLOW_FILE_EDIT`

### Active Plugins (Key Custom & Purpose-Built)
| Plugin | Purpose | Location |
|--------|---------|----------|
| **LatePoint 5.2.10** | Appointment scheduling (models/controllers/views in `lib/`) | `wp-content/plugins/latepoint/` |
| **SureRank 1.6.5** | Lightweight SEO toolkit with post analysis | `wp-content/plugins/surerank/` |
| **TranslatePress** | Multilingual content management | `wp-content/plugins/translatepress-multilingual/` |
| **Gtranslate** | Language switching (complements TranslatePress) | `wp-content/plugins/gtranslate/` |
| **Akismet** | Spam filtering | `wp-content/plugins/akismet/` |
| **Ultimate Addons for Gutenberg** | Additional blocks for block editor | `wp-content/plugins/ultimate-addons-for-gutenberg/` |
| **Astra Sites** | Pre-built page templates | `wp-content/plugins/astra-sites/` |

## Plugin Development Patterns

### LatePoint (Appointment Scheduling)
**Architecture**: MVC pattern with clear separation
- **File structure**: `lib/` contains models, controllers, helpers, views
- **Key directories**: `config/`, `helpers/` (OsSettingsHelper, OsDatabaseHelper), `controllers/`, `models/`, `views/`
- **Database versioning**: Maintains both `$version` (5.2.10) and `$db_version` (2.3.0) for migrations
- **Database checks**: Runs `OsDatabaseHelper::check_db_version()` on plugin init
- **Settings**: Global settings via `new OsSettingsHelper()` stored in `$GLOBALS['latepoint_settings']`
- **Pattern**: Main class `LatePoint` in plugin root file with constructor calling `define_constants()`, `includes()`, `init_hooks()`

### SureRank (SEO)
**Architecture**: Namespaced PHP with modular components
- **Initialization**: Constants defined in `constants.php`, then loader (PSR-4 namespace `SureRank\`) in `loader.php`
- **Key pattern**: Separate concerns into `Inc\Admin\`, `Inc\Frontend\`, `Inc\API\`, `Inc\Analyzer\`, `Inc\BatchProcess\`
- **Post metadata**: Uses custom meta keys (`_surerank_seo_last_updated`, `surerank_seo_checks`, `surerank_taxonomy_updated_at`)
- **Settings storage**: Options-based via `SURERANK_SETTINGS` constant key
- **Admin features**: Includes SEO bar, popup analysis, bulk edit/actions, dashboard widget
- **Frontend**: Meta tag injection, canonical tags, open graph (Facebook), Twitter card support

## Data Flows & Integration Points

### Multilingual Workflow
1. **TranslatePress** handles core translation UI and storage
2. **Gtranslate** adds language switcher for frontend navigation
3. Custom content must use WordPress translation hooks (see TranslatePress docs for custom post type support)

### SEO Pipeline (SureRank)
- Post content changes → `PostAnalyzer` runs checks → stores in `surerank_seo_checks` post meta
- Checks last updated timestamp stored in `_surerank_seo_last_updated`
- Taxonomy pages analyzed separately via `TermAnalyzer`
- Batch processing available for bulk site analysis

### Scheduling Integration (LatePoint)
- Services and availability defined in LatePoint data models
- Public-facing booking form: requires theme integration via shortcode or widget
- Staff/employee management within LatePoint admin
- Email notifications via `mailers/` directory

## Critical Developer Workflows

### Local Development
- **Setup**: XAMPP environment (MySQL localhost, no password for root)
- **Database**: `agency` database with `wp_` prefix
- **Debug mode**: Currently OFF (`WP_DEBUG = false` in `wp-config.php`) — enable for development
- **File editing**: DISABLED via Solid Security (`DISALLOW_FILE_EDIT`) — edit via FTP/SFTP only

### Database Maintenance
- LatePoint plugin checks DB schema on every plugin load
- Run `OsDatabaseHelper::check_db_version()` manually if DB issues occur after updates
- Always backup before plugin version updates (version tracking in plugin headers)

### Custom Plugin Development
**Follow existing patterns**:
1. Define plugin constants in header or dedicated `constants.php`
2. Use namespacing for non-core plugins (see SureRank pattern)
3. Store settings via WordPress options API or post/term meta
4. Implement database version checking if adding custom tables
5. Register hooks early in `init` action for compatibility

## Conventions & Project-Specific Patterns

### Naming Conventions
- Database table prefix: `wp_`
- Post meta keys: Use plugin prefix (e.g., `_surerank_seo_last_updated`, `latepoint_*`)
- Option keys: Plugin-namespaced constant (e.g., `SURERANK_SETTINGS`)
- CSS/JS handles: Follow Elementor patterns (asset-based handles)

### Security Considerations
- File editor disabled — all code changes via external editor
- Solid Security encryption key in `wp-config.php` (don't share)
- Database user has no password (local only) — add in production
- API endpoints: SureRank exposes via `Inc\API\Api_Init` — check CORS if cross-origin requests needed

### Theme Customization
- Astra theme: Customizer integration via WP Settings API
- Elementor blocks: Custom blocks added via Ultimate Addons for Gutenberg
- Don't edit theme files directly; use child theme or theme hooks
- Page templates in Astra Sites plugin (`wp-content/plugins/astra-sites/`)

## Key File References
- [wp-config.php](../wp-config.php) — Database and WordPress constants
- [wp-content/plugins/latepoint/latepoint.php](../wp-content/plugins/latepoint/latepoint.php) — Appointment scheduling main class
- [wp-content/plugins/surerank/loader.php](../wp-content/plugins/surerank/loader.php) — SEO plugin initialization with all services
- [wp-content/plugins/surerank/constants.php](../wp-content/plugins/surerank/constants.php) — SEO metadata key definitions
- [wp-content/themes/astra/](../wp-content/themes/astra/) — Active theme (avoid direct edits)
- [wp-content/themes/hello-elementor/](../wp-content/themes/hello-elementor/) — Elementor theme base

## Common Tasks & Solution Patterns

| Task | Pattern |
|------|---------|
| Add new SEO metadata to posts | Use SureRank's `PostAnalyzer` class or add meta via `surerank_seo_checks` key |
| Create appointment type | Use LatePoint admin interface; data stored in LatePoint custom tables |
| Add translation strings | Use `__()` or `_e()` with text domain `latepoint` or `surerank` |
| Customize admin UI | Hook into `admin_menu` or `admin_enqueue_scripts` early (before plugin renders) |
| Debug plugin issues | Enable `WP_DEBUG` and check `wp-content/debug.log` |

---

**Last Updated**: April 30, 2026  
**Database**: `agency` | **WordPress**: 6.7+ | **PHP**: 7.4+
