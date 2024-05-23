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
 // Obtener elementos del DOM
 const modals = document.getElementsByClassName('modals');
 const openModal1Button = document.getElementById('openModal1');
 const openModal2Button = document.getElementById('openModal2');
 const closeButtons = document.getElementsByClassName('closes');

 // Función para abrir un modal
 function openModal(modalId) {
   const modal = document.getElementById(modalId);
   modal.style.display = 'block';
 }

 // Función para cerrar un modal
 function closeModal(modal) {
   modal.style.display = 'none';
 }

 // Agregar event listeners a los botones de apertura
 openModal1Button.addEventListener('click', () => openModal('modal1'));
 openModal2Button.addEventListener('click', () => openModal('modal2'));

 // Agregar event listeners a los botones de cierre
 for (let i = 0; i < closeButtons.length; i++) {
   closeButtons[i].addEventListener('click', () => {
     for (let j = 0; j < modals.length; j++) {
       closeModal(modals[j]);
     }
   });
 }

 // Agregar event listener al envío de formularios
 const form1 = document.getElementById('form1');
 const form2 = document.getElementById('form2');
 const submitButton1 = document.getElementById('submit1');
 const submitButton2 = document.getElementById('submit2');

 submitButton1.addEventListener('click', () => {
   // Aquí puedes agregar la lógica para enviar el formulario 1
   form1.reset();
   closeModal(document.getElementById('modal1'));
 });

 submitButton2.addEventListener('click', () => {
   // Aquí puedes agregar la lógica para enviar el formulario 2
   form2.reset();
   closeModal(document.getElementById('modal2'));
 });

 // Cerrar modal al hacer clic fuera del contenido
 window.addEventListener('click', (event) => {
   for (let i = 0; i < modals.length; i++) {
     if (event.target == modals[i]) {
       closeModal(modals[i]);
     }
   }
 });
});
