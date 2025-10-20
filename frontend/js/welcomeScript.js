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
    document.getElementById('postButton').addEventListener('click', function () {
  const input = document.getElementById('newPostInput');
  const content = input.value.trim();

  if (content === '') return;

  const postContainer = document.getElementById('feedContainer');

  const newPost = document.createElement('div');
  newPost.className = 'post';
  newPost.innerHTML = `
    <div class="post-header">
      <span class="post-user">&#128100; You</span>
      <span class="post-time">Just now</span>
    </div>
    <div class="post-content">${content}</div>
  `;

  postContainer.prepend(newPost);
  input.value = '';
});
