const app = {
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
      return [];
    }
    
    return uri.ltrim('/').rtrim('/').split('/').slice(2);
  },

  check_input: function(input) {
    if (input.validity.valueMissing) {
      return {status: 400, message: 'Missing required fields'};
    }

    if (input.validity.badInput) {
      return {status: 400, message: 'Invalid input'};
    }

    if (input.validity.patternMismatch) {
      return {status: 400, message: 'Invalid format'};
    }

    if (input.validity.typeMismatch) {
      return {status: 400, message: 'Invalid type'};
    }

    if (input.validity.valid) {
      return {status: 200, message: 'OK'};
    }
    
    return {status: 500, message: 'Unknown error'};
  },

  check_form: function(form) {
    const inputs_type = "input, textarea, select";
    const form_inputs = $(form).find(inputs_type).filter('[required]');

    let err = false;
    form_inputs.each((_, input) => {
      const {status, message} = this.check_input(input);
      if (status !== 200) {
        errors.show_msg({status, message});
        err = true;
      }
    });

    return !err;
  }
}

String.prototype.rtrim = function(char) {
  return this.replace(new RegExp(char + '+$'), '');
}

String.prototype.ltrim = function(char) {
  return this.replace(new RegExp('^' + char + '+'), '');
}
