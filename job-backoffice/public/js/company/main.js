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
});