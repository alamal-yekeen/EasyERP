/* ─────────────────────────────────────────────────────────────
   FINAQ Shell — layout.js
   ───────────────────────────────────────────────────────────── */
(function () {
  'use strict';

  /* ── Sidebar toggle + persistence ─────────────────────────── */
  var root = document.documentElement;
  var sidebarToggle = document.getElementById('sidebarToggle');
  var sidebarCollapse = document.getElementById('sidebarCollapse');

  function applySidebar(state) {
    root.setAttribute('data-sidebar', state);
    localStorage.setItem('finaq.sidebar', state);
    if (sidebarToggle) sidebarToggle.setAttribute('aria-expanded', String(state === 'maximized'));
  }

  function toggleSidebar() {
    var cur = root.getAttribute('data-sidebar');
    if (cur === 'maximized') applySidebar('minimized');
    else applySidebar('maximized');
  }

  sidebarToggle && sidebarToggle.addEventListener('click', toggleSidebar);
  sidebarCollapse && sidebarCollapse.addEventListener('click', toggleSidebar);

  /* ── Theme toggle + persistence ──────────────────────────── */
  var themeToggle = document.getElementById('themeToggle');

  function applyTheme(mode) {
    root.setAttribute('data-theme', mode);
    localStorage.setItem('finaq.theme', mode);
  }

  themeToggle && themeToggle.addEventListener('click', function () {
    var cur = root.getAttribute('data-theme');
    applyTheme(cur === 'dark' ? 'light' : 'dark');
  });

  /* ── Dropdowns (mutually exclusive, close on outside / Esc) ─ */
  var dropdowns = Array.from(document.querySelectorAll('.dropdown'));

  function closeAllDropdowns(except) {
    dropdowns.forEach(function (d) {
      if (d === except) return;
      d.classList.remove('open');
      var btn = d.querySelector('[aria-haspopup="true"]');
      if (btn) btn.setAttribute('aria-expanded', 'false');
    });
  }

  dropdowns.forEach(function (d) {
    var btn = d.querySelector('[aria-haspopup="true"]');
    if (!btn) return;
    btn.addEventListener('click', function (e) {
      e.stopPropagation();
      var willOpen = !d.classList.contains('open');
      closeAllDropdowns(d);
      d.classList.toggle('open', willOpen);
      btn.setAttribute('aria-expanded', String(willOpen));
    });
  });

  document.addEventListener('click', function () { closeAllDropdowns(null); });
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') closeAllDropdowns(null);
  });

  /* ── Live clock ──────────────────────────────────────────── */
  var dateEl = document.getElementById('clockDate');
  var timeEl = document.getElementById('clockTime');
  var lastDate = '';

  function tickClock() {
    var now = new Date();
    var dateStr = now.toLocaleDateString('en-US', {
      weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
    });
    var timeStr = now.toLocaleTimeString('en-US', {
      hour: 'numeric', minute: '2-digit', second: '2-digit', hour12: true
    });
    if (dateEl && dateStr !== lastDate) { dateEl.textContent = dateStr; lastDate = dateStr; }
    if (timeEl) timeEl.textContent = timeStr;
  }
  tickClock();
  setInterval(tickClock, 1000);

  /* ── Module dropdowns (sidebar) ──────────────────────────── */
  var modules = Array.from(document.querySelectorAll('.nav-module'));
  modules.forEach(function (m) {
    var head = m.querySelector('.module-head');
    if (!head) return;
    head.addEventListener('click', function () {
      var isOpen = m.classList.contains('open');
      // Exclusive: close others (optional — remove to allow multiple open)
      // modules.forEach(function (o) { if (o !== m) o.classList.remove('open'); });
      m.classList.toggle('open', !isOpen);
      head.setAttribute('aria-expanded', String(!isOpen));
    });
  });

  /* ── Route loader ────────────────────────────────────────── */
  var content = document.getElementById('content');
  var progress = document.getElementById('routeProgress');
  var skeleton = document.getElementById('contentSkeleton');
  var loadedSheets = new Set();
  var currentRoute = null;

  function startProgress() {
    if (!progress) return;
    progress.classList.add('active');
    progress.style.width = '20%';
    requestAnimationFrame(function () { progress.style.width = '70%'; });
  }
  function endProgress() {
    if (!progress) return;
    progress.style.width = '100%';
    setTimeout(function () {
      progress.style.width = '0%';
      progress.classList.remove('active');
    }, 220);
  }

  function setActiveNav(route) {
    document.querySelectorAll('.nav-item.active, .nav-child.active').forEach(function (el) {
      el.classList.remove('active');
      el.removeAttribute('aria-current');
    });
    var target = document.querySelector(
      '[data-route="' + route + '"]'
    );
    if (target) {
      target.classList.add('active');
      target.setAttribute('aria-current', 'page');
      // Ensure parent module is open if it's a child
      var module = target.closest('.nav-module');
      if (module) {
        module.classList.add('open');
        var head = module.querySelector('.module-head');
        if (head) head.setAttribute('aria-expanded', 'true');
      }
    }
  }

  function updateBreadcrumb(route, explicitTitle) {
    var crumbNav = document.querySelector('.breadcrumb');
    if (!crumbNav) return;
    var title = explicitTitle || (function () {
      var el = document.querySelector('[data-route="' + route + '"]');
      return el ? (el.dataset.title || el.textContent.trim()) : 'Page';
    })();
    var parent = 'Home';
    var active = document.querySelector('[data-route="' + route + '"]');
    if (active && active.closest('.nav-module')) {
      var mod = active.closest('.nav-module').querySelector('.nav-label');
      if (mod) parent = mod.textContent.trim();
    }
    crumbNav.innerHTML =
      '<span class="crumb">' + parent + '</span>' +
      '<i class="fas fa-chevron-right crumb-sep"></i>' +
      '<span class="crumb current">' + title + '</span>';
    document.title = title + ' — FINAQ';
  }

  function extractAndRunScripts(container) {
    container.querySelectorAll('script').forEach(function (oldScript) {
      var newScript = document.createElement('script');
      for (var i = 0; i < oldScript.attributes.length; i++) {
        var a = oldScript.attributes[i];
        newScript.setAttribute(a.name, a.value);
      }
      newScript.text = oldScript.textContent;
      oldScript.parentNode.replaceChild(newScript, oldScript);
    });
  }

  function injectStyles(doc) {
    doc.querySelectorAll('link[rel="stylesheet"]').forEach(function (link) {
      var href = link.getAttribute('href');
      if (!href) return;
      var abs = new URL(href, link.baseURI).href;
      if (loadedSheets.has(abs)) return;
      loadedSheets.add(abs);
      var l = document.createElement('link');
      l.rel = 'stylesheet';
      l.href = href;
      document.head.appendChild(l);
    });
    doc.querySelectorAll('style').forEach(function (styleEl) {
      var s = document.createElement('style');
      s.textContent = styleEl.textContent;
      document.head.appendChild(s);
    });
  }

  async function loadRoute(route, opts) {
    opts = opts || {};
    if (!route) return;

    // Prevent redundant reload
    if (!opts.force && route === currentRoute) return;

    startProgress();
    var slowTimer = setTimeout(function () {
      if (skeleton && !opts.initial) skeleton.classList.add('visible');
    }, 200);

    try {
      var res = await fetch(route, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        credentials: 'same-origin'
      });
      if (!res.ok) throw new Error('HTTP ' + res.status);
      var html = await res.text();

      // If the server sent a full document (e.g. login redirect), extract <body>
      var doc = new DOMParser().parseFromString(html, 'text/html');
      var bodyContent = doc.body ? doc.body : doc.documentElement;

      injectStyles(doc);

      // Replace content (fade)
      content.style.opacity = '0';
      await new Promise(function (r) { setTimeout(r, 120); });
      content.innerHTML = bodyContent.innerHTML;
      content.style.opacity = '1';
      content.scrollTop = 0;

      extractAndRunScripts(content);

      currentRoute = route;
      setActiveNav(route);
      updateBreadcrumb(route, opts.title);

      // If sidebar is minimized, on mobile close it after nav
      if (window.matchMedia('(max-width: 768px)').matches) {
        root.removeAttribute('data-sidebar');
        root.setAttribute('data-sidebar', 'minimized');
      }
    } catch (err) {
      console.error('[loadRoute]', err);
      content.innerHTML =
        '<div style="text-align:center;padding:60px 20px;">' +
          '<i class="fas fa-triangle-exclamation" style="font-size:42px;color:var(--warning);opacity:.7"></i>' +
          '<h2 style="margin:16px 0 8px;">Could not load page</h2>' +
          '<p style="color:var(--text-muted);margin:0 0 20px;">' + err.message + '</p>' +
          '<button onclick="window.FINAQ.loadRoute(\'' + route + '\',{force:true})" ' +
          'style="padding:10px 20px;border:0;border-radius:8px;background:var(--primary);color:#fff;cursor:pointer;font-weight:600;">Retry</button>' +
        '</div>';
    } finally {
      clearTimeout(slowTimer);
      if (skeleton) skeleton.classList.remove('visible');
      endProgress();
    }
  }

  /* ── Route click delegation ──────────────────────────────── */
  document.addEventListener('click', function (e) {
    var link = e.target.closest('[data-route]');
    if (!link) return;
    // Ignore if it's the brand link — allow default (navigates to /easy/)
    if (link.classList.contains('brand')) return;
    e.preventDefault();
    var route = link.dataset.route;
    var title = link.dataset.title || (link.querySelector('.nav-label') || link).textContent.trim();
    loadRoute(route, { title: title });
  });

  /* ── Public API ──────────────────────────────────────────── */
  window.FINAQ = {
    loadRoute: loadRoute,
    toggleSidebar: toggleSidebar,
    applySidebar: applySidebar,
    applyTheme: applyTheme
  };
})();