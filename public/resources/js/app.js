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
  }
}

String.prototype.rtrim = function(char) {
  return this.replace(new RegExp(char + '+$'), '');
}

String.prototype.ltrim = function(char) {
  return this.replace(new RegExp('^' + char + '+'), '');
}

app.uri = app.get_uri();
app.params = app.get_params();
