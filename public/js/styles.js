let vh = {
  showNotification: function(from, align, type, message) {
    // type = ['', 'info', 'danger', 'success', 'warning', 'rose', 'primary'];

    $.notify({
      icon: "add_alert",
      message: message
      // message: "Welcome to <b>Material Dashboard Pro</b> - a beautiful admin panel for every web developer."

    }, {
      type: type,
      timer: 3000,
      placement: {
        from: from,
        align: align
      }
    });
  }
}
