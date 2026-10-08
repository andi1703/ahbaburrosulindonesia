# Quran Static Site

This folder is the source for the GitHub Pages Quran-only site. The Pages artifact contains only static files; it does not publish the CodeIgniter PHP application or its configuration.

## Local preview

```sh
bash scripts/build-quran-pages.sh dist/quran-pages
```

Serve `dist/quran-pages` with any static web server. The site uses hash routes such as `#surah/2/124` and loads its local JSON and LPMQ font from relative paths.

## GitHub Pages

1. Push or merge this branch into `main`, or run **Deploy Quran Pages** from the Actions tab with **Run workflow**.
2. In repository **Settings → Pages**, set the source to **GitHub Actions**.
3. The workflow publishes the generated static Quran site. It never publishes PHP source files.

The Quran text and Indonesian translation are from the Kemenag dataset mirrored at [ianoit/Al-Quran-JSON-Indonesia-Kemenag](https://github.com/ianoit/Al-Quran-JSON-Indonesia-Kemenag), with the bundled LPMQ font.
