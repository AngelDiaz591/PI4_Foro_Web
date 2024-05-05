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
          text: result.message
        })
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
          text: result.message
        })
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
        container.html(this.setList(result.data));
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
        container.html(this.setList(result.data));
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: result.message
        })
      }
    }).catch(err => console.error(err));
  },

  setList: function (users) {
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
  },

  setFollowForm: function () {

  }
}
