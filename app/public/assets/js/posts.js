const posts = {
  routes: {
    home: '/',
    posts: '/post/get_all/',
    show: '/post/show/',
    post: '/post/get_by_id/',
    new: '/post/new/',
    create: '/post/create/',
    edit: '/post/edit/',
    patch: '/post/update/',
    destroy: '/post/destroy/',
  },

  load_posts: function() {
    const container = $('#posts-container');
    let html = '';

    fetch(this.routes.posts)
      .then(response => response.json())
      .then(posts => {
        for (let post of posts) {
          html += this.construct_card(post);
        };
        container.html(html);
      }).catch(err => console.error('Error fetching posts'));
  },

  load_post: function() {
    const container = $('#post-container');
    const id = app.get_params()[0];
    let html = '';

    fetch(this.routes.post + id)
      .then(response => response.json())
      .then(post => {
        html = this.construct_card(post);
        container.html(html);
      }).catch(err => console.error('Error fetching post'));
  },

  load_edit: async function() {
    const form = $('#edit-form');
    const id = app.get_params()[0];

    result = await fetch(this.routes.post + id)
      .then(response => response.json())
      .catch(err => console.error('Error fetching post'));

    $(form).find('input[name="title"]').val(result.title);
    $(form).find('textarea[name="body"]').val(result.body);
  },

  create_post: async (e, form) => {
    e.preventDefault();
    if (!app.check_form(form)) { return; };

    const form_data = new FormData(form);
    const params = new URLSearchParams(form_data);

    let response = await fetch(posts.routes.create, {
      method: 'POST',
      body: params,
      headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
      }
    })
    .then(response => response.json())
    .catch(err => console.error('Error submitting request'));

    if (response.error) {
      errors.show_msg(response);
    } else if (Number.isInteger(response)) {
      window.location.href = `${posts.routes.show}${response}`;
    } else {
      errors.show_msg({status: 500, message: 'Unknown error'});
    }
  },

  update_post: async (e, form) => {
    e.preventDefault();
    if (!app.check_form(form)) { return; };

    const id = app.get_params()[0];
    const form_data = new FormData(form);
    const params = new URLSearchParams(form_data);

    let response = await fetch(posts.routes.patch, {
      method: 'PATCH',
      body: params,
      headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
      }
    })
    .then(response => response.json())
    .catch(err => console.error('Error submitting request', err));

    if (response.error) {
      errors.show_msg(response);
    } else if (response) {
      window.location.href = `${posts.routes.show}${id}`;
    } else {
      errors.show_msg({status: 500, message: 'Unknown error'});
    }
  },

  destroy_post: function(e, form) {
    e.preventDefault();
    
    const form_data = new FormData(form);
    const params = new URLSearchParams(form_data);

    fetch(posts.routes.destroy, {
      method: 'DELETE',
      body: params,
      headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
      }
    })
    .then(response => response.json())
    .then(response => {
      if (response.error) {
        errors.show_msg(response);
      } else if (response) {
        window.location.href = posts.routes.home;
      } else {
        errors.show_msg({status: 500, message: 'Unknown error'});
      }
    }).catch(err => console.error('Error submitting request'));
  },

  construct_card: function(data) {
    return `
      <div class="card">
        <h2>${data.title}</h2>
        <p>${data.body}</p>
        <a href="${posts.routes.show}${data.id}">Show</a>
        <a href="${posts.routes.edit}${data.id}">Edit</a>
        <form onsubmit="posts.destroy_post(event, this)">
          <input type="hidden" name="id" value="${data.id}">
          <button type="submit">Delete</button>
        </form>
      </div>
    `;
  },

  init: () => {
    switch (app.get_uri()) {
      case posts.routes.home:
        console.log('Home');
        posts.load_posts();
        break;
      case posts.routes.show:
        console.log('Show');
        posts.load_post();
        break;
      case posts.routes.new:
        console.log('New');
        break;
      case posts.routes.edit:
        console.log('Edit');
        posts.load_edit();
        break;
      default:
        console.log('404');
        console.log(app.get_uri());
        break;
    }
  },
}

window.onload = () => {
  posts.init();
}

