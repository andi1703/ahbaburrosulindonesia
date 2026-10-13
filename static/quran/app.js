(function () {
	"use strict";

	var app = document.getElementById("app");
	var indexData = null;
	var versesData = null;
	var surahs = [];
	var juzs = [];
	var currentMode = "surah";
	var alphabetical = false;

	function escapeHtml(value) {
		return String(value).replace(/[&<>"']/g, function (character) {
			return {
				"&": "&amp;",
				"<": "&lt;",
				">": "&gt;",
				'"': "&quot;",
				"'": "&#039;",
			}[character];
		});
	}

	function loadData() {
		return Promise.all([
			fetch("./data/quran_index.json").then(function (response) {
				if (!response.ok) throw new Error("Gagal memuat indeks surah.");
				return response.json();
			}),
			fetch("./data/quran_kemenag.json").then(function (response) {
				if (!response.ok) throw new Error("Gagal memuat teks Quran Kemenag.");
				return response.json();
			}),
		])
			.then(function (data) {
				indexData = data[0];
				versesData = data[1];
				surahs = indexData.surahs.map(function (row) {
					return {
						id: Number(row[0]),
						name: row[1],
						translation: row[2],
						arabic: row[3],
						verses: Number(row[4]),
						revelationOrder: Number(row[5]),
					};
				});
				buildJuzIndex();
				app.setAttribute("aria-busy", "false");
				renderRoute();
			})
			.catch(function (error) {
				app.setAttribute("aria-busy", "false");
				app.innerHTML =
					'<section class="error-state"><strong>Data Quran tidak dapat dimuat.</strong>' +
					escapeHtml(error.message) +
					"</section>";
			});
	}

	function buildJuzIndex() {
		var byNumber = {};
		versesData.forEach(function (verse) {
			var number = Number(verse.juz);
			if (!byNumber[number]) {
				var surah = surahs[Number(verse.surah) - 1];
				byNumber[number] = {
					number: number,
					surahNumber: Number(verse.surah),
					surahName: surah ? surah.name : "",
					verse: Number(verse.verse),
					verses: 0,
				};
			}
			byNumber[number].verses += 1;
		});
		juzs = Object.keys(byNumber)
			.map(function (number) {
				return byNumber[number];
			})
			.sort(function (left, right) {
				return left.number - right.number;
			});
	}

	function renderRoute() {
		var route = window.location.hash.replace(/^#\/?/, "").split("/");
		if (route[0] === "surah" && route[1]) {
			renderReader("surah", Number(route[1]), Number(route[2]) || null);
		} else if (route[0] === "juz" && route[1]) {
			renderReader("juz", Number(route[1]), null);
		} else {
			renderCatalog();
		}
	}

	function renderCatalog() {
		currentMode = "surah";
		alphabetical = false;
		document.title = "Al-Qur'an — Ahbaburrosul";
		app.innerHTML =
			'<section class="quran-hero"><div class="quran-hero-inner">' +
			'<div class="identity"><span class="identity-mark" aria-hidden="true">۞</span><div>' +
			'<p class="eyebrow">Bacaan, doa, wirid, dan sholawat</p><h1 class="page-title">Al-Qur\'an</h1>' +
			'<p class="page-subtitle">Jelajahi 114 surah dan 30 juz dengan teks Kemenag.</p></div></div>' +
			'<div class="search-wrap"><label class="visually-hidden" for="quran-search">Cari surah atau juz</label>' +
			'<div class="search-box"><span class="search-glyph" aria-hidden="true"></span>' +
			'<input id="quran-search" type="search" autocomplete="off" placeholder="Nama atau nomor surah, mis. Yasin atau 2:124"></div>' +
			'<p class="search-hint">Cari nama, nomor surah, atau nomor ayat.</p></div></div></section>' +
			'<section class="browser" aria-label="Daftar surah dan juz"><div class="toolbar">' +
			'<div class="tabs" role="tablist" aria-label="Jenis daftar Al-Qur\'an">' +
			'<button class="tab" type="button" role="tab" aria-selected="true" data-mode="surah">Surah</button>' +
			'<button class="tab" type="button" role="tab" aria-selected="false" data-mode="juz">Juz</button>' +
			'<button class="tab" type="button" role="tab" aria-selected="false" data-mode="revelation">Urutan Turun</button></div>' +
			'<button class="sort-button" type="button" data-sort aria-pressed="false">A–Z⌄</button></div>' +
			'<p class="results-meta" aria-live="polite"><span data-count>114</span> <span data-count-label>surah</span></p>' +
			'<div class="card-grid" role="tabpanel" data-grid="surah">' +
			renderCards("surah") +
			"</div>" +
			'<div class="card-grid" role="tabpanel" data-grid="juz" hidden>' +
			renderCards("juz") +
			"</div>" +
			'<div class="empty-state" data-empty hidden>Tidak ada surah atau juz yang cocok.</div></section>';
		updateCatalog();
	}

	function renderCards(type) {
		var items = type === "juz" ? juzs : surahs;
		return items
			.map(function (item) {
				var isJuz = type === "juz";
				var number = isJuz ? item.number : item.id;
				var name = isJuz ? "Juz " + item.number : item.name;
				var secondary = isJuz
					? "Surah " +
						item.surahName +
						" · Ayat " +
						item.verse +
						" · " +
						item.verses +
						" ayat"
					: item.translation + " · " + item.verses + " ayat";
				var arabic = isJuz ? "الجزء " + item.number : item.arabic;
				var searchable = isJuz
					? "juz " + item.number + " " + item.surahName
					: [item.id, item.name, item.translation, item.arabic].join(" ");
				var href = isJuz ? "#juz/" + item.number : "#surah/" + item.id;
				var revelation = isJuz
					? ""
					: ' data-revelation="' + item.revelationOrder + '"';
				return (
					'<a class="surah-card" data-card data-number="' +
					number +
					'" data-name="' +
					escapeHtml(name.toLocaleLowerCase("id")) +
					'" data-search="' +
					escapeHtml(searchable.toLocaleLowerCase("id")) +
					'"' +
					revelation +
					' href="' +
					href +
					'">' +
					'<span class="card-number">' +
					number +
					'</span><span class="card-copy">' +
					'<span class="card-title">' +
					escapeHtml(name) +
					'</span><span class="card-subtitle">' +
					escapeHtml(secondary) +
					'</span></span><span class="card-arabic" lang="ar" dir="rtl">' +
					escapeHtml(arabic) +
					"</span></a>"
				);
			})
			.join("");
	}

	function updateCatalog() {
		var searchInput = app.querySelector("#quran-search");
		if (!searchInput) return;
		var query = searchInput.value.trim().toLocaleLowerCase("id");
		var numeric = query.match(/^(\d+)(?::\d+)?$/);
		var surahGrid = app.querySelector('[data-grid="surah"]');
		var juzGrid = app.querySelector('[data-grid="juz"]');
		var isJuz = currentMode === "juz";
		var grid = isJuz ? juzGrid : surahGrid;
		var cards = Array.prototype.slice.call(
			grid.querySelectorAll("[data-card]"),
		);

		surahGrid.hidden = isJuz;
		juzGrid.hidden = !isJuz;
		var sortButton = app.querySelector("[data-sort]");
		sortButton.disabled = isJuz;
		if (!isJuz) {
			cards
				.sort(function (left, right) {
					if (currentMode === "revelation") {
						return (
							Number(left.dataset.revelation) - Number(right.dataset.revelation)
						);
					}
					if (alphabetical) {
						return left.dataset.name
							.replace(/[^a-z0-9]/g, "")
							.localeCompare(
								right.dataset.name.replace(/[^a-z0-9]/g, ""),
								"id",
							);
					}
					return Number(left.dataset.number) - Number(right.dataset.number);
				})
				.forEach(function (card) {
					grid.appendChild(card);
				});
		}

		var count = 0;
		cards.forEach(function (card) {
			var match =
				!query ||
				(numeric
					? card.dataset.number === String(Number(numeric[1]))
					: card.dataset.search.indexOf(query) !== -1);
			card.hidden = !match;
			if (match) count += 1;
		});
		app.querySelector("[data-count]").textContent = String(count);
		app.querySelector("[data-count-label]").textContent = isJuz
			? "juz"
			: "surah";
		app.querySelector("[data-empty]").hidden = count > 0;
		app.querySelector("[data-sort]").textContent = alphabetical
			? "Nomor⌄"
			: "A–Z⌄";
		app
			.querySelector("[data-sort]")
			.setAttribute("aria-pressed", alphabetical ? "true" : "false");
	}

	function renderReader(type, number, targetVerse) {
		var isJuz = type === "juz";
		var selectedSurah = !isJuz ? surahs[number - 1] : null;
		var selectedJuz = isJuz ? juzs[number - 1] : null;
		if ((!isJuz && !selectedSurah) || (isJuz && !selectedJuz)) {
			window.location.hash = "";
			return;
		}

		var selectedVerses = versesData.filter(function (verse) {
			return isJuz
				? Number(verse.juz) === number
				: Number(verse.surah) === number;
		});
		var title = isJuz ? "Juz " + number : selectedSurah.name;
		var arabicTitle = isJuz ? "الجزء " + number : selectedSurah.arabic;
		var subtitle = isJuz
			? "Mulai Surah " +
				selectedJuz.surahName +
				" ayat " +
				selectedJuz.verse +
				" · " +
				selectedVerses.length +
				" ayat"
			: selectedSurah.translation + " · " + selectedVerses.length + " ayat";
		var previousHref = isJuz
			? number > 1
				? "#juz/" + (number - 1)
				: ""
			: number > 1
				? "#surah/" + (number - 1)
				: "";
		var nextHref = isJuz
			? number < 30
				? "#juz/" + (number + 1)
				: ""
			: number < 114
				? "#surah/" + (number + 1)
				: "";

		document.title = title + " — Ahbaburrosul";
		var lastSurah = 0;
		var verseMarkup = selectedVerses
			.map(function (verse) {
				var surahInfo = surahs[Number(verse.surah) - 1];
				var divider = "";
				if (isJuz && lastSurah !== Number(verse.surah)) {
					divider =
						'<div class="verse-divider"><h2>' +
						escapeHtml(surahInfo.name) +
						'</h2><a href="#surah/' +
						verse.surah +
						'">Buka surah</a></div>';
					lastSurah = Number(verse.surah);
				}
				var verseId = "verse-" + verse.surah + "-" + verse.verse;
				return (
					divider +
					'<article class="verse-card" id="' +
					verseId +
					'" data-verse-card>' +
					'<div class="verse-head"><span class="verse-number">' +
					verse.verse +
					"</span>" +
					'<button class="copy-button" type="button" data-copy-verse>Salin</button></div>' +
					'<p class="verse-arabic" lang="ar" dir="rtl">' +
					escapeHtml(verse.arabic) +
					"</p>" +
					'<p class="verse-translation">' +
					escapeHtml(verse.translation) +
					"</p></article>"
				);
			})
			.join("");

		app.innerHTML =
			'<section class="reader"><a class="back-link" href="#">← Daftar Al-Qur\'an</a>' +
			'<header class="reader-heading"><div class="reader-heading-row"><div><h1 class="reader-title">' +
			escapeHtml(title) +
			'</h1><span class="reader-arabic-title" lang="ar" dir="rtl">' +
			escapeHtml(arabicTitle) +
			'</span><p class="reader-subtitle">' +
			escapeHtml(subtitle) +
			'</p></div><button class="copy-button" type="button" data-copy-all>Salin semua</button></div>' +
			'<p class="copy-status" role="status" aria-live="polite" data-copy-status></p></header>' +
			renderReaderNav(previousHref, nextHref) +
			'<section class="verse-section" aria-label="Ayat">' +
			verseMarkup +
			"</section>" +
			renderReaderNav(previousHref, nextHref) +
			"</section>";

		if (targetVerse) {
			window.requestAnimationFrame(function () {
				var target = document.getElementById(
					"verse-" + number + "-" + targetVerse,
				);
				if (target)
					target.scrollIntoView({ behavior: "smooth", block: "start" });
			});
		} else {
			window.scrollTo(0, 0);
		}
	}

	function renderReaderNav(previousHref, nextHref) {
		return (
			'<nav class="reader-nav" aria-label="Navigasi bacaan">' +
			(previousHref
				? '<a href="' + previousHref + '">← Sebelumnya</a>'
				: "<span></span>") +
			(nextHref ? '<a href="' + nextHref + '">Selanjutnya →</a>' : "") +
			"</nav>"
		);
	}

	function handleClick(event) {
		var tab = event.target.closest("[data-mode]");
		if (tab) {
			currentMode = tab.dataset.mode;
			alphabetical = false;
			app.querySelectorAll("[data-mode]").forEach(function (item) {
				item.setAttribute("aria-selected", item === tab ? "true" : "false");
			});
			updateCatalog();
			return;
		}

		var sortButton = event.target.closest("[data-sort]");
		if (sortButton) {
			if (currentMode !== "surah") {
				currentMode = "surah";
				app.querySelectorAll("[data-mode]").forEach(function (item) {
					item.setAttribute(
						"aria-selected",
						item.dataset.mode === "surah" ? "true" : "false",
					);
				});
			}
			alphabetical = !alphabetical;
			updateCatalog();
			return;
		}

		var card = event.target.closest("[data-card]");
		if (card) {
			var searchInput = app.querySelector("#quran-search");
			var verseSearch =
				searchInput && searchInput.value.trim().match(/^(\d+):(\d+)$/);
			if (
				verseSearch &&
				currentMode === "surah" &&
				Number(verseSearch[1]) === Number(card.dataset.number)
			) {
				event.preventDefault();
				window.location.hash =
					"surah/" + Number(verseSearch[1]) + "/" + Number(verseSearch[2]);
			}
			return;
		}

		var copyButton = event.target.closest("[data-copy-verse]");
		if (copyButton) {
			var verseCard = copyButton.closest("[data-verse-card]");
			copyText(
				verseCard.querySelector(".verse-arabic").textContent.trim() +
					"\n" +
					verseCard.querySelector(".verse-translation").textContent.trim(),
			);
			return;
		}

		if (event.target.closest("[data-copy-all]")) {
			var allText = Array.prototype.slice
				.call(app.querySelectorAll("[data-verse-card]"))
				.map(function (cardItem) {
					return (
						cardItem.querySelector(".verse-arabic").textContent.trim() +
						"\n" +
						cardItem.querySelector(".verse-translation").textContent.trim()
					);
				})
				.join("\n\n");
			copyText(allText);
		}
	}

	function copyText(text) {
		var status = app.querySelector("[data-copy-status]");
		if (!navigator.clipboard) {
			status.textContent = "Clipboard tidak tersedia di browser ini.";
			return;
		}
		navigator.clipboard
			.writeText(text)
			.then(function () {
				status.textContent = "Bacaan disalin.";
			})
			.catch(function () {
				status.textContent = "Bacaan tidak dapat disalin.";
			});
	}

	app.addEventListener("click", handleClick);
	app.addEventListener("input", function (event) {
		if (event.target.matches("#quran-search")) updateCatalog();
	});
	window.addEventListener("hashchange", renderRoute);
	loadData();
})();
