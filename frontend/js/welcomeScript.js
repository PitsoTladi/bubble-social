const searchIcon = document.getElementById('searchIcon');
const searchBar = document.getElementById('searchBar');
const navbarRight = document.getElementById('navbarRight');
const searchInput = document.getElementById('searchInput');

searchIcon.addEventListener('click', () => {
  const isShown = searchBar.classList.toggle('show');
  
  for (const child of navbarRight.children) {
    if (child !== searchIcon && child !== searchBar) {
      child.style.opacity = isShown ? '0' : '1';
      child.style.pointerEvents = isShown ? 'none' : 'auto';
    }
  }
  if (isShown) {
    searchInput.focus();
  } else {
    searchInput.value = '';
  }
});

