const app = {
  uri: {},
  params: {},
  user: {},

  sleep: function(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
  },
  
  get_uri: function() {
    let uri = window.location.pathname;

    if (uri === '/') {
      return '/';
    }

    uri = uri.ltrim('/').rtrim('/').split('/', 2).join('/');

    return `/${uri}/`;
  },

  get_params: function() {
    let uri = window.location.pathname;
    
    if (uri === '/') {
      return uri;
    }
    
    uri = uri.ltrim('/').rtrim('/').split('/').slice(2);

    if (uri.length === 0) {
      return uri;
    }

    uri = uri.map(item => item.split(':'))

    return Object.fromEntries(uri);
  },

  checkSession: function() {
    if (!app.user || !app.user.id) {
      while (true) {
        if (confirm("You need to log in to perform this action.")) {
          break; 
        }
      }
    }
  },
  
  userMenuOpen: function() {
    Swal.fire({
      html: `
        <div class="userMenu-header">
          <img src="/resources/img/user.png" alt="User">
          <div>
            <h4>${app.user.username}</h4>
            <p>${app.user.email}</p>
          </div>
        </div>
        <div class="line"></div>
        <ul class="userMenu-list">
          <li class="userMenu-list-item d-grid">
            <a class="text-start" href="/users/show/id:${app.user.id}">Profile</a>
          </li>
          <li class="userMenu-list-item d-grid">
            <a class="text-start" href="#">Settings</a>
          </li>
          <li class="userMenu-list-item d-grid">
            <a class="text-start" href="#">Languaje</a>
          </li>
          <li class="userMenu-list-item d-grid">
            <a class="text-start" href="#">Help</a>
          </li>
          <li class="userMenu-list-item d-grid">
            <a class="text-start" href="/sessions/destroy">Logout</a>
          </li>
        </ul>
      `,
      showConfirmButton: false,
      customClass: {
        container: 'userMenu',
        popup: 'userMenu-modal',
      },
    });
  },

  userNotificationsOpen: function() {
    Swal.fire({
      html: `
        <div class="userMenu-header">
          <h4>Notifications</h4>
        </div>
        <div class="line"></div>
        <ul class="userMenu-tabs">
          <li class="userMenu-tabs-item" id="unseenNotifications" onclick="app.unseenNotifications()">
            Unseen notifications
          </li>
          <li class="userMenu-tabs-item" id="allNotifications" onclick="app.allNotifications()">
            All notifications
          </li>
        </ul>
        <ul class="userMenu-list">
        </ul>
      `,
      showConfirmButton: false,
      customClass: {
        container: 'userMenu',
        popup: 'userMenu-modal',
      },
      didOpen: this.unseenNotifications,
    });
  },

  unseenNotifications: async function() {
    $('#unseenNotifications').addClass('active');
    $('#allNotifications').removeClass('active');

    let html = `
      <li class="userMenu-list-item spinner-container">
        <span class="spinner spinner-green"></span>
      </li>
    `;

    let container = $('.userMenu-list');
    let id = app.user.id;

    let params = new URLSearchParams();
    params.append('id', id);

    await fetch('/users/notifications', {
      method: 'POST',
      body: params,
    }).then(response => response.json())
    .then(result => {
      html = '';

      if (result.status && result.data.length > 0) {
        let notifications = result.data;

        for (let notification of notifications) {
          html += app.newNotification(notification);
        }

        container.html(html);

        app.markNotificationsAsRead(result.data);
      } else {
        container.html('<li class="userMenu-list-item-centered">Ooh! You don\'t have notifications</li>');
      }
    }).catch(err => console.error(err));

  },

  allNotifications: async function() {
    $('#allNotifications').addClass('active');
    $('#unseenNotifications').removeClass('active');

    let html = `
      <li class="userMenu-list-item spinner-container">
        <span class="spinner spinner-green"></span>
      </li>
    `;

    let container = $('.userMenu-list');
    let id = app.user.id;

    let params = new URLSearchParams();
    params.append('id', id);

    await fetch('/users/all_notifications', {
      method: 'POST',
      body: params,
    }).then(response => response.json())
    .then(result => {
      html = '';

      if (result.status && result.data.length > 0) {
        let notifications = result.data;

        for (let notification of notifications) {
          html += app.newNotification(notification);
        }

        container.html(html);
      } else {
        container.html('<li class="userMenu-list-item-centered">Ooh! You don\'t have notifications</li>');
      }
    }).catch(err => console.error(err));
  },

  newNotification: function(data) {
    let htmlLi = `
      <li class="userMenu-list-item notification">
          <a href="/users/show/id:${data.causer_id}" class="notification-causer col-8">
            <img src="/resources/img/user.png" alt="User">
            <div class="notification-causer-info">
              <h5>${data.username}</h5>
    `;
    
    switch (data.type) {
      case 'post':
        htmlLi += `
              <p>has posted just now</p>
            </div>
          </a>
          <a href="/posts/show/id:${data.id}" class="col-2 notification-event">
        `;
        break;
      case 'follow':
        htmlLi += `
              <p>has followed you</p>
            </div>
          </a>
          <a href="/users/show/id:${data.id}" class="col-2 notification-event">
        `;
        break;
      case 'like':
        htmlLi += `
              <p>has liked your post</p>
            </div>
          </a>
          <a href="/posts/show/id:${data.id}" class="col-2 notification-event">
        `;
        break;
      case 'comment':
        htmlLi += `
              <p>has commented your post</p>
            </div>
          </a>
          <a href="/posts/show/id:${data.id}" class="col-2 notification-event">
        `;
        break;
      case 'reply':
        htmlLi += `
              <p>has replied your comment</p>
            </div>
          </a>
          <a href="/posts/show/id:${data.id}" class="col-2 notification-event">
        `;
        break;
      case 'post_rejected':
        htmlLi += `
              <p>has rejected your post</p>
            </div>
          </a>
          <a href="/posts/show/id:${data.id}" class="col-2 notification-event">
        `;
        break;
      default:
        console.error('Invalid type');
        break;
    }

    htmlLi += `
            <p>Go</p>
            <i class="bi ${data.seen ? 'bi-eye-slash-fill' : 'bi-eye-fill'}"></i>
          </a>
          <span class="col-2 notification-date">
            ${data.created_at}
          </span>
        </div>
      </li>
    `;

    return htmlLi;
  },

  markNotificationsAsRead: function(data) {
    let ids = data.map(item => item.notification_id);
    console.log(ids);
    
    let params = new URLSearchParams();
    ids.forEach(id => params.append('ids[]', id));
    console.log(params);

    fetch('/users/mark_notifications_as_read', {
      method: 'POST',
      body: params,
    }).then(response => response.json())
    .then(result => {
      if (result.status) {
        app.unseenNotificationsCount();
      }
    }).catch(err => console.error(err));
  },

  unseenNotificationsCount: function() {
    let notificationCount =  $('.notifications-count')

    let params = new URLSearchParams();
    params.append('id', app.user.id);

    fetch('/users/notifications_count', {
      method: 'POST',
      body: params,
    })
    .then(response => response.json())
    .then(result => {
      if (result.status && result.data.notifications > 0) {
        let count = result.data.notifications;
        notificationCount.text(count);
      } else {
        notificationCount.css('display', 'none');
      }
    }).catch(err => console.error(err));
  }
};

String.prototype.rtrim = function(char) {
  return this.replace(new RegExp(char + '+$'), '');
}

String.prototype.ltrim = function(char) {
  return this.replace(new RegExp('^' + char + '+'), '');
}

app.uri = app.get_uri();
app.params = app.get_params();

$(function() {
  if (app.user.id) {
    app.unseenNotificationsCount();
  }
})
