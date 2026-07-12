document.addEventListener('DOMContentLoaded', () => {
  const sidebar = document.getElementById('sidebar');
  const header = document.getElementById('header');
  const main = document.getElementById('main-content');
  const toggleBtn = document.getElementById('sidebar-toggle');

  if (toggleBtn) {
    toggleBtn.addEventListener('click', () => {
      if (sidebar) sidebar.classList.toggle('sidebar-collapsed');
      if (header) header.classList.toggle('sidebar-collapsed-width');
      if (main) main.classList.toggle('sidebar-collapsed-padding');
    });
  }
  const trigger = document.getElementById('user-menu-trigger');
  const dropdown = document.getElementById('user-dropdown');

  if (trigger && dropdown) {
    trigger.addEventListener('click', (e) => {
      e.stopPropagation();
      dropdown.classList.toggle('hidden');
    });

    document.addEventListener('click', (e) => {
      if (!dropdown.contains(e.target) && e.target !== trigger) {
        dropdown.classList.add('hidden');
      }
    });
  }
});