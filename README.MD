# Sports Odds Table

Show sports odds data from a public API in a simple table, with a few filters to allow easier odds preview.

## Requirements

- [PHP](https://secure.php.net/manual/en/install.php) 7.4+
- [WordPress](https://wordpress.org/) 5.6+
- [Node.js](http://nodejs.org/) 12+

## How to use
### Installation

1. Clone plugin from git to wp-content/plugins directory:

```bash
git clone git@github.com:yuriipavlov/sports-odds-table.git && cd sports-odds-table
```

2. Setup node dependencies:

```bash
npm i
```

3. Run build command

```bash
npm run build
```

4. Activate plugin in wp-admin

5. Add Odds API Key to plugin settings page ([Get Key](https://the-odds-api.com/#get-access))

6. Add Gutenberg block 'Sports Odds Table' to post or page

### NPM commands

- Build minified assets for production:

```bash
npm run build
```

- Start watcher for development:

```bash
npm run start
```

- It helps to enforce coding style guidelines for your files (JavaScript, YAML) by formatting source code in a consistent way:

```bash
npm run format
```

- Helps enforce coding style guidelines for your style files:

```bash
npm run lint:css
```

- Helps enforce coding style guidelines for your JavaScript and TypeScript files:

```bash
npm run lint:js
```

- Updates the WordPress packages used in the project to their latest version:

```bash
npm run packages-update
```
