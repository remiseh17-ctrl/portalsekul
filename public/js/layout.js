// Global layout scripts (Tailwind-based)
(function () {
  // 1) Theme handling with 'dark' class on <html>
  const root = document.documentElement;
  const storageKey = 'theme';
  const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
  const saved = (() => { try { return localStorage.getItem(storageKey); } catch(_) { return null; }})();
  const applyTheme = (mode) => {
    if (mode === 'dark') root.classList.add('dark'); else root.classList.remove('dark');
    try { localStorage.setItem(storageKey, mode); } catch(_) {}
    // Update theme icon
    const icon = document.getElementById('theme-icon');
    if (icon && window.lucide) {
      icon.setAttribute('data-lucide', root.classList.contains('dark') ? 'sun' : 'moon');
      window.lucide.createIcons();
    }
  };
  applyTheme(saved ?? (prefersDark ? 'dark' : 'light'));
  const toggleBtn = document.getElementById('theme-toggle');
  if (toggleBtn) toggleBtn.addEventListener('click', () => {
    applyTheme(root.classList.contains('dark') ? 'light' : 'dark');
  });

  // 2) Sidebar interactions
  const sidebar = document.getElementById('sidebar');
  const backdrop = document.getElementById('backdrop');
  const openBtn = document.getElementById('openSidebar');

  const closeSidebar = () => {
    if (!sidebar) return;
    sidebar.classList.add('-translate-x-full');
    if (backdrop) backdrop.classList.add('hidden');
  };
  const openSidebar = () => {
    if (!sidebar) return;
    sidebar.classList.remove('-translate-x-full');
    if (backdrop) backdrop.classList.remove('hidden');
  };
  if (openBtn) openBtn.addEventListener('click', openSidebar);
  if (backdrop) backdrop.addEventListener('click', closeSidebar);
  // Close on ESC
  document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeSidebar(); });

  // 2a) Collapse sidebar (desktop)
  const collapseBtn = document.getElementById('collapseSidebarBtn');
  const collapseCaret = document.getElementById('collapseCaret');
  const main = document.getElementById('main');
  const collapsedKey = 'sidebar-collapsed-md';
  const setCollapsed = (flag) => {
    if (!sidebar || !main) return;
    // apply width change via inline style
    const wCollapsed = '4.5rem'; // 72px
    const wExpanded  = '16rem';  // 256px
    sidebar.style.width = flag ? wCollapsed : wExpanded;
    main.style.marginLeft = window.matchMedia('(min-width: 768px)').matches ? (flag ? wCollapsed : wExpanded) : '0';

    // hide/show labels when collapsed/expanded (desktop)
    const labels = sidebar.querySelectorAll('.sidebar-label');
    labels.forEach(el => { el.style.display = flag ? 'none' : ''; });

    // rotate caret
    if (collapseCaret) {
      collapseCaret.style.transform = flag ? 'rotate(180deg)' : 'rotate(0deg)';
      collapseCaret.style.transition = 'transform 0.3s ease-in-out';
    }
    // update aria
    if (collapseBtn) collapseBtn.setAttribute('aria-expanded', (!flag).toString());
    // transitions
    sidebar.style.transition = 'width 0.3s ease-in-out';
    main.style.transition = 'margin-left 0.3s ease-in-out';
    try { localStorage.setItem(collapsedKey, flag ? '1' : '0'); } catch(_) {}
  };
  // restore on desktop width
  const restoreCollapsed = () => {
    const savedCollapsed = (() => { try { return localStorage.getItem(collapsedKey) === '1'; } catch(_) { return false; }})();
    // apply only if desktop (md and above)
    if (window.matchMedia('(min-width: 768px)').matches) {
      setCollapsed(savedCollapsed);
    } else {
      // reset to full width on mobile (sidebar is off-canvas)
      if (sidebar) sidebar.style.width = '16rem';
      if (main) main.style.marginLeft = '0';
    }
  };
  restoreCollapsed();
  window.addEventListener('resize', restoreCollapsed);
  if (collapseBtn) collapseBtn.addEventListener('click', () => {
    const current = (() => { try { return localStorage.getItem(collapsedKey) === '1'; } catch(_) { return false; }})();
    setCollapsed(!current);
  });

  // 2b) Mobile dropdowns (menu + profile)
  function setupDropdown(btnId, menuId, caretId) {
    const btn = document.getElementById(btnId);
    const menu = document.getElementById(menuId);
    const caret = caretId ? document.getElementById(caretId) : null;
    if (!btn || !menu) return;

    const show = () => {
      menu.classList.remove('hidden');
      menu.style.opacity = '1';
      menu.style.transform = 'translateY(0)';
      menu.style.transition = 'opacity 0.3s ease-in-out, transform 0.3s ease-in-out';
      btn.setAttribute('aria-expanded', 'true');
      if (caret) caret.style.transform = 'rotate(180deg)';
    };
    const hide = () => {
      menu.style.opacity = '0';
      menu.style.transform = 'translateY(-4px)';
      menu.style.transition = 'opacity 0.3s ease-in-out, transform 0.3s ease-in-out';
      setTimeout(() => menu.classList.add('hidden'), 300);
      btn.setAttribute('aria-expanded', 'false');
      if (caret) caret.style.transform = 'rotate(0deg)';
    };

    let open = false;
    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      open ? hide() : show();
      open = !open;
    });
    document.addEventListener('click', (e) => {
      if (!open) return;
      if (!menu.contains(e.target) && !btn.contains(e.target)) {
        hide();
        open = false;
      }
    });
    // ESC close
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape' && open) { hide(); open = false; }});
  }
  setupDropdown('mobileMenuBtn', 'mobileMenu', 'mobileMenuCaret');
  setupDropdown('desktopProfileBtn', 'desktopProfileMenu');

  // 3) Initialize lucide icons
  if (window.lucide) {
    window.lucide.createIcons();
  } else {
    window.addEventListener('lucide:ready', () => window.lucide.createIcons());
  }

  // 4) Table filter utils (idempotent)
  function tableFilter(inputId, tableId) {
    const input = document.getElementById(inputId);
    const table = document.getElementById(tableId);
    if (!input || !table) return;
    input.addEventListener('keyup', function () {
      const filter = this.value.toLowerCase();
      const rows = table.querySelectorAll('tbody tr');
      rows.forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(filter) ? '' : 'none';
      });
    });
  }
  tableFilter('searchJadwal', 'tableJadwal');
  tableFilter('searchPengumuman', 'tablePengumuman');
})();
