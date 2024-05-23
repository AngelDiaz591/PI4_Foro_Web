const user = {
  routes: {
    follow: '/users/follow',
    unfollow: '/users/unfollow',
  },
  
  containers: {
    followers: $('#followers-container'),
    following: $('#following-container'),
  },

  follow: function (e, form) {
    e.preventDefault();
    e.stopPropagation();

    let data = new FormData(form);
    let params = new URLSearchParams(data);

    fetch(this.routes.follow, {
      method: 'POST',
      body: params,
    }).then(response => response.json())
    .then(result => {
      if (result.status) {
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: result.message,
          onClose: () => window.location.reload()
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.reload();
          }
        });
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: result.message
        })
      }
    })
  },

  unfollow: function (e, form) {
    e.preventDefault();
    e.stopPropagation();

    let data = new FormData(form);
    let params = new URLSearchParams(data);

    fetch(this.routes.unfollow, {
      method: 'POST',
      body: params,
    }).then(response => response.json())
    .then(result => {
      if (result.status) {
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: result.message,
          onClose: () => window.location.reload(),
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.reload();
          }
        });
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: result.message
        })
      }
    })
  },

  followers: function (e) {
    e.preventDefault();
    let container = this.containers.followers;
    let id = app.params.id;

    let params = new URLSearchParams();
    params.append('id', id);

    fetch('/users/followers', {
      method: 'POST',
      body: params,
    }).then(response => response.json())
    .then(result => {
      if (result.status) {
        container.html(this.setFollowsList(result.data));
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: result.message
        })
      }
    }).catch(err => console.error(err));
  },

  following: function (e) {
    e.preventDefault();
    let container = this.containers.following;
    let id = app.params.id;

    let params = new URLSearchParams();
    params.append('id', id);

    fetch('/users/following', {
      method: 'POST',
      body: params,
    }).then(response => response.json())
    .then(result => {
      if (result.status) {
        container.html(this.setFollowsList(result.data));
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: result.message
        })
      }
    }).catch(err => console.error(err));
  },

  setFollowsList: function (users) {
    let list = `
      <div>
        <h1>Users</h1>
        <ul>
    `;

    if (users.length > 0) {
      for (let user of users) {
        list += `
          <li>
            <h3>${user.username}</h3>
            <a href="/users/show/id:${user.id}">View Profile</a>
          </li>
        `;
      }
    } else {
      list += `
        <li>
          <h2>No users found</h2>
        </li>
      `;
    }

    list += `
        </ul>
      </div>
    `;

    return list;
  }
}

document.addEventListener('DOMContentLoaded', () => {
  // Manejo de modales
  const modals = document.querySelectorAll('.modals');
  const openModal1Button = document.getElementById('openModal1');
  const closeButtons = document.querySelectorAll('.closes');

  const openModal = (modalId) => {
    document.getElementById(modalId).style.display = 'block';
  };

  const closeModal = (modal) => {
    modal.style.display = 'none';
    modal.querySelector('form')?.reset();
    modal.querySelectorAll('img[data-preview]').forEach(img => {
      img.src = img.dataset.originalSrc || '';
    });
  };

  openModal1Button.addEventListener('click', () => openModal('modal1'));
  closeButtons.forEach(button => {
    button.addEventListener('click', event => {
      event.stopPropagation();
      modals.forEach(closeModal);
    });
  });

  // Envío de formularios
  const handleSubmit = (form, modal) => {
    // [...] (aquí iría la lógica de envío)
    form.reset();
    closeModal(modal);
  };

  document.getElementById('submit1')?.addEventListener('click', () =>
    handleSubmit(document.getElementById('form1'), document.getElementById('modal1'))
  );

  // Contenido vacío
  const contentsDiv = document.querySelector('.contents');
  if (!contentsDiv.textContent.trim()) {
    const messageElement = document.createElement('div');
    messageElement.classList.add('no-content-message');
    messageElement.innerHTML = `
      <img class="img_noContent" src="/resources/img/user.svg" alt="Anna Smith" />
      <p>Share with the world, who you are!</p>
    `;
    contentsDiv.appendChild(messageElement);
  }

  // Manejo de secciones
  const sections = {
    postsSection: document.getElementById('postsSection'),
    mediaSection: document.getElementById('mediaSection'),
    commentsSection: document.getElementById('commentsSection'),
  };

  const sectionLinks = {
    postsSec: document.querySelector('#section-post'),
    mediaSec: document.querySelector('#section-media'),
    commentsSec: document.querySelector('#section-comments'),
  };

  const removeActiveClass = () => {
    Object.values(sectionLinks).forEach(link => link.classList.remove('active'));
  };

  const showSection = (section, menuItem) => {
    section.style.display = 'block';
    menuItem.classList.add('active');
  };

  const hideSection = (section, menuItem) => {
    section.style.display = 'none';
    menuItem.classList.remove('active');
  };

  const handleSectionClick = (showSection, hideSection1, hideSection2) => {
    removeActiveClass();
    showSection(sections[showSection], sectionLinks[showSection]);
    hideSection(sections[hideSection1], sectionLinks[hideSection1]);
    hideSection(sections[hideSection2], sectionLinks[hideSection2]);
  };

  showSection(sections.postsSection, sectionLinks.postsSec);
  sectionLinks.postsSec.addEventListener('click', () =>
    handleSectionClick('postsSection', 'mediaSection', 'commentsSection')
  );
  sectionLinks.mediaSec.addEventListener('click', () =>
    handleSectionClick('mediaSection', 'postsSection', 'commentsSection')
  );
  sectionLinks.commentsSec.addEventListener('click', () =>
    handleSectionClick('commentsSection', 'postsSection', 'mediaSection')
  );
});


document.addEventListener('DOMContentLoaded', function() {
  const imageProfile = document.getElementById('changeImageProfile');
  const imagePortail = document.getElementById('changeImagePortail');

  const fileProfile = document.getElementById('fileProfile');
  const filePortail = document.getElementById('filePortail');
  
  const profileImage = document.getElementById('profileImage');
  const portailImage = document.getElementById('portailImage');

  const handleImageChange = (fileInput, imageElement) => {
    const file = fileInput.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = (e) => {
        const originalSrc = imageElement.src;
        imageElement.dataset.originalSrc = originalSrc;
        imageElement.src = e.target.result;
        imageElement.setAttribute('data-preview', '');
      };
      reader.readAsDataURL(file);
    }
  };

  imageProfile.addEventListener('click', () => fileProfile.click());
  imagePortail.addEventListener('click', () => filePortail.click());
  fileProfile.addEventListener('change', () =>
    handleImageChange(fileProfile, profileImage)
  );
  filePortail.addEventListener('change', () =>
    handleImageChange(filePortail, portailImage)
  );
});