module.exports={

  success ( notitext) {
    return $.Notification.autoHideNotify('success', 'bottom-right', '', notitext);
  },

  info ( notitext) {
    return $.Notification.autoHideNotify('info', 'bottom-right', '', notitext);
  },

  error ( notitext) {
    return $.Notification.autoHideNotify('error', 'bottom-right', '', notitext);
  },

  warning ( notitext) {
    return $.Notification.autoHideNotify('warning', 'bottom-right', '', notitext);
  },
}