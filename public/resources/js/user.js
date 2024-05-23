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

document.addEventListener('DOMContentLoaded', function() {

  const modals = document.querySelectorAll('.modals');
  const openModal1Button = document.getElementById('openModal1');
  const closeButtons = document.querySelectorAll('.closes');

  const openModal = (modalId) => {
    const modal = document.getElementById(modalId);
    modal.style.display = 'block';
  };

  const closeModal = (modal) => {
    modal.style.display = 'none';

    const form = modal.querySelector('form');
    if (form) {
      form.reset();
    }

    const imageElements = modal.querySelectorAll('img[data-preview]');
    imageElements.forEach((img) => {
      img.src = img.dataset.originalSrc || '';
    });
  };

  openModal1Button.addEventListener('click', () => openModal('modal1'));

  closeButtons.forEach((button) => {
    button.addEventListener('click', (event) => {
      event.stopPropagation();
      modals.forEach((modal) => closeModal(modal));
    });
  });

  const form1 = document.getElementById('form1');
  const submitButton1 = document.getElementById('submit1');


  const handleSubmit = (form, modal) => {
    // [...]
    form.reset();
    closeModal(modal);
  };

  submitButton1.addEventListener('click', () =>
    handleSubmit(form1, document.getElementById('modal1'))
  );
});

document.addEventListener('DOMContentLoaded', function() {
  const contentsDiv = document.querySelector('.contents');
  const contentText = contentsDiv.textContent.trim();

  if (contentText === '') {
    const messageElement = document.createElement('div');
    messageElement.classList.add('no-content-message');
    messageElement.innerHTML = `
      <img class="img_noContent" src="/resources/img/user.svg" alt="Anna Smith" />
      <p>Share with the world, who you are!</p>
    `;
    contentsDiv.appendChild(messageElement);
  }

  const postsSectionEl = document.getElementById('postsSection');
  const mediaSectionEl = document.getElementById('mediaSection');
  const commentsSectionEl = document.getElementById('commentsSection');
  const postsSec = document.querySelector('#section-post');
  const mediaSec = document.querySelector('#section-media');
  const commentsSec = document.querySelector('#section-comments');

document.addEventListener('DOMContentLoaded', function() {
  showSection(postsSectionEl, postsSec);
});

postsSec.addEventListener('click', () => {
  showSection(postsSectionEl, postsSec);
  hideSection(mediaSectionEl, mediaSec);
  hideSection(commentsSectionEl, commentsSec);
});

mediaSec.addEventListener('click', () => {
  hideSection(postsSectionEl, postsSec);
  showSection(mediaSectionEl, mediaSec);
  hideSection(commentsSectionEl, commentsSec);
});

commentsSec.addEventListener('click', () => {
  hideSection(postsSectionEl, postsSec);
  hideSection(mediaSectionEl, mediaSec);
  showSection(commentsSectionEl, commentsSec);
});

function showSection(section) {
  section.style.display = 'block';
}

function hideSection(section) {
  section.style.display = 'none';
}
});

document.addEventListener('DOMContentLoaded', function() {
  const imageProfile = document.getElementById('changeImageProfile');
  const fileProfile = document.getElementById('fileProfile');
  const profileImage = document.getElementById('profileImage');

  const handleImageChange = (fileInput, imageElement) => {
    const file = fileInput.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = (e) => {
        imageElement.src = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  };

  imageProfile.addEventListener('click', () => fileProfile.click());
  fileProfile.addEventListener('change', () =>
    handleImageChange(fileProfile, profileImage)
  );
});