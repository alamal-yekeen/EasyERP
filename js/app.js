(function () {
  'use strict';

  // FIX: Global Guard. If app.js is injected twice, ignore the second run.
  if (window.ERP_SCRIPT_LOADED) {
    console.warn("ERP Script already loaded. Ignoring duplicate execution.");
    return;
  }
  window.ERP_SCRIPT_LOADED = true;

  $(document).ready(function () {

    const $html = $(document.documentElement);
    const getSidebar = () => $('#sidebar');

    const $content = $('#content-area');
    const $loaderBar = $('#topLoader');
    const $pageDesc = $('#pageDescription');

    /* =========================================================
       CONFIG
       ========================================================= */
    const CONFIG = {
      accordionMode: true,
      sidebarStateKey: 'erp-sidebar',
      themeKey:        'erp-theme',
    };

    /* =========================================================
       THEME (Light / Dark)
       ========================================================= */
    function applyTheme(theme) {
      $html.attr('data-theme', theme);
      localStorage.setItem(CONFIG.themeKey, theme);
    }
    applyTheme(localStorage.getItem(CONFIG.themeKey) || 'light');

    $(document).on('click', '#themeToggle', function (e) {
      e.preventDefault();
      const next = $html.attr('data-theme') === 'dark' ? 'light' : 'dark';
      applyTheme(next);
    });

    /* =========================================================
       OPEN-MODULE MEMORY (For Minimized Hover)
       ========================================================= */
    let rememberedModule = null;

    function rememberOpenGroup() {
      const $open = $('.nav-group.open').first();
      if ($open.length) {
        rememberedModule = $open.data('module') || $open.index();
      }
    }

    function findGroupByMemory() {
      if (rememberedModule === null) return $();
      let $g = $('.nav-group[data-module="' + rememberedModule + '"]');
      if (!$g.length) $g = $('.nav-group').eq(rememberedModule);
      return $g;
    }

    /* =========================================================
       SIDEBAR STATE (Max / Min)
       ========================================================= */
    function applySidebarState(state) {
        const isMin = state === 'min';
        const $sidebar = getSidebar();

        if (!$sidebar.length) return;

        if (isMin) rememberOpenGroup();
        $sidebar.toggleClass('minimized', isMin);

        if (isMin) {
            $('.nav-group').removeClass('open');
        } else {
            const $g = findGroupByMemory();
            if ($g.length) $g.addClass('open');
            else $('.nav-group.has-active').addClass('open');
        }

        localStorage.setItem(CONFIG.sidebarStateKey, state);
    }

    // Init Sidebar State
    (function initSidebar() {
      const saved = localStorage.getItem(CONFIG.sidebarStateKey) || 'max';
      const $activeGroup = $('.nav-group.has-active').first();
      if ($activeGroup.length) {
        rememberedModule = $activeGroup.data('module') || $activeGroup.index();
      }
      applySidebarState(saved);
    })();

    $(document).on('click', '#sidebarToggle', function (e) {
        e.preventDefault();
        const $sidebar = getSidebar();
        if (!$sidebar.length) return;

        if (window.matchMedia('(max-width: 760px)').matches) {
            $sidebar.toggleClass('mobile-open');
            return;
        }

        const next = $sidebar.hasClass('minimized') ? 'max' : 'min';
        applySidebarState(next);
    });

    /* =========================================================
       HOVER HANDLERS 
       ========================================================= */
    let isHoveringMinimized = false;

    $(document).on('mouseenter', '#sidebar', function () {
      const $sidebar = getSidebar();
      if (!$sidebar.hasClass('minimized')) return;
      
      isHoveringMinimized = true;
      const $g = findGroupByMemory().length
        ? findGroupByMemory()
        : $('.nav-group.has-active').first();
      if ($g.length) $g.addClass('open');
    });

    $(document).on('mouseleave', '#sidebar', function () {
      if (!isHoveringMinimized) return;
      isHoveringMinimized = false;
      rememberOpenGroup();
      $('.nav-group').removeClass('open');
    });

    /* =========================================================
       TOPBAR DROPDOWNS & SIDEBAR MENUS
       ========================================================= */
    $(document).on('click', '[data-dd-toggle]', function (e) {
      e.stopPropagation();
      const $dd = $(this).closest('.dropdown');
      const wasOpen = $dd.hasClass('open');
      $('.dropdown').removeClass('open');
      if (!wasOpen) $dd.addClass('open');
    });
    
    $(document).on('click', function () {
      $('.dropdown').removeClass('open');
    });

    $(document).on('click', '.sidebar-nav .nav-parent', function (e) {
      e.preventDefault();
      const $group = $(this).closest('.nav-group');
      const willOpen = !$group.hasClass('open');

      if (CONFIG.accordionMode && willOpen) {
        $('.nav-group').not($group).removeClass('open');
      }
      $group.toggleClass('open', willOpen);

      if (willOpen) {
        rememberedModule = $group.data('module') || $group.index();
      } else if (rememberedModule === ($group.data('module') || $group.index())) {
        rememberedModule = null;
      }
    });

    /* =========================================================
       LIVE CLOCK
       ========================================================= */
    const MONTHS = ['January','February','March','April','May','June',
                    'July','August','September','October','November','December'];
    const DAYS   = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];

    function pad(n){ return n < 10 ? '0' + n : '' + n; }

    function tick() {
      const now = new Date();
      const dateStr = DAYS[now.getDay()] + ', ' + MONTHS[now.getMonth()] + ' ' + now.getDate() + ', ' + now.getFullYear();
      let hours = now.getHours();
      const ampm = hours >= 12 ? 'PM' : 'AM';
      hours = hours % 12 || 12;
      const timeStr = hours + ':' + pad(now.getMinutes()) + ':' + pad(now.getSeconds()) + ' ' + ampm;

      $('#clockDate').text(dateStr);
      $('#clockTime').text(timeStr);
    }
    tick();
    setInterval(tick, 1000);

    /* =========================================================
       TABS & MODALS
       ========================================================= */
    $(document).on('click', '.tab-btn', function(e) {
      e.preventDefault();
      $('.tab-btn').removeClass('active');
      $('.tab-pane').removeClass('active');
      $(this).addClass('active');
      const target = $(this).data('tab-target');
      $('#' + target).addClass('active');
    });

    $(document).on('click', '[data-modal-target]', function(e) {
      e.preventDefault();
      const target = $(this).data('modal-target');
      $('#' + target).addClass('active');
    });

    $(document).on('click', '[data-modal-close]', function(e) {
      e.preventDefault();
      $(this).closest('.modal-overlay').removeClass('active');
    });
    
    $(document).on('click', '.modal-overlay', function(e) {
      if (e.target === this) {
        $(this).removeClass('active');
      }
    });

    /* =========================================================
       AJAX ROUTING & LOADING
       ========================================================= */
    let loaderInterval = null;

    function startLoader() {
      $loaderBar.addClass('loading').css('width', '10%');
      let progress = 10;
      loaderInterval = setInterval(function() {
        if (progress < 90) {
          progress += Math.random() * 10;
          if (progress > 90) progress = 90;
          $loaderBar.css('width', progress + '%');
        }
      }, 200);
    }

    function finishLoader() {
      clearInterval(loaderInterval);
      $loaderBar.css('width', '100%');
      setTimeout(function() {
        $loaderBar.removeClass('loading');
        setTimeout(() => $loaderBar.css('width', '0%'), 300);
      }, 200);
    }

    $(document).on('click', 'a[data-page]', function (e) {
      e.preventDefault(); 
      
      const $link = $(this);
      const page = $link.data('page');
      const description = $link.data('description') || 'Dashboard';
      
      if ($link.hasClass('active') && $content.find('.page-loader').length > 0) {
        return; 
      }
      
      $('.sidebar-nav .nav-link').removeClass('active');
      $link.addClass('active');
      
      $pageDesc.text(description).removeClass('visible');
      setTimeout(() => $pageDesc.addClass('visible'), 50);

      const $group = $link.closest('.nav-group');
      if ($group.length) {
        $('.nav-group').removeClass('has-active');
        $group.addClass('has-active');
        rememberedModule = $group.data('module') || $group.index();
      }

      const $sidebar = getSidebar();
      if ($sidebar.length) $sidebar.removeClass('mobile-open');

      startLoader();
      $content.html('<div class="page-loader"><i class="fa-solid fa-spinner fa-spin"></i> Loading…</div>');

      // alert(page)
      // FIX: Fetch the fragment via routes.php
      
      $.ajax({
        url: page , 
        dataType: 'html',
        cache: false,
        success: function (html) {
          $content.html(html);
          finishLoader();
          window.scrollTo({ top: 0, behavior: 'smooth' });
        },
        error: function (xhr) {
          finishLoader();
          
          // If session expired (401), redirect to login
          if (xhr.status === 401) {
            window.location.href = 'login';
            return;
          }

          $content.html(
            '<div class="page-error"><i class="fa-solid fa-triangle-exclamation"></i> Could not load page.<br><small>' + xhr.statusText + '</small></div>'
          );
        }
      });
    });

    // Initial Load Guard
    if (!window.ERP_INITIAL_LOADED) {
      window.ERP_INITIAL_LOADED = true;
      if ($content.is(':empty') || $content.find('.page-loader').length > 0) {
        $('a[data-page="dashboard"]').first().trigger('click');
      }
    }

    /* =========================================================
       PUBLIC HELPERS
       ========================================================= */
    window.ERP = {
      setBrandColors: function (primary, secondary) {
        if (primary)   $html[0].style.setProperty('--primary', primary);
        if (secondary) $html[0].style.setProperty('--secondary', secondary);
      }
    };

  }); // End of $(document).ready()
})();