const errors = {
  container: $('#error-container'),

  set_msg: function(err) {
    html = `
      <div class="error-container">
        <p class="error-code">Error: ${err.status}</p>
        ${err.message}
      </div>
    `;
    this.container.html(html);
  },

  clear_msg: function() {
    this.container.html('');
  },

  show_msg: async function(err, time = 5000) {
    this.set_msg(err);
    await app.sleep(time);
    this.clear_msg();
  }
}
