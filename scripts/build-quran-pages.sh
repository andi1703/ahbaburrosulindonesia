#!/usr/bin/env bash
set -euo pipefail

repo_root="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
output_dir="${1:-$repo_root/dist/quran-pages}"

mkdir -p "$output_dir/data" "$output_dir/assets/fonts"
cp "$repo_root/static/quran/index.html" "$output_dir/index.html"
cp "$repo_root/static/quran/app.css" "$output_dir/app.css"
cp "$repo_root/static/quran/app.js" "$output_dir/app.js"
cp "$repo_root/application/data/quran_index.json" "$output_dir/data/quran_index.json"
cp "$repo_root/application/data/quran_kemenag.json" "$output_dir/data/quran_kemenag.json"
cp "$repo_root/assets/frontend/fonts/LPMQ.ttf" "$output_dir/assets/fonts/LPMQ.ttf"
touch "$output_dir/.nojekyll"

printf 'Static Quran site built at %s\n' "$output_dir"
