(function () {

  function init() {
    addSessionMessagesClickListeners();

    // Initialize entries masonry
    $('.entries-list').masonry({
      // set itemSelector so .grid-sizer is not used in layout
      itemSelector: '.grid-item',
      // use element for option
      columnWidth: '.grid-sizer',
      percentPosition: true
    });
  }

  /* Add onClick listeners to all session messages */
  function addSessionMessagesClickListeners() {
    $('.notification').off('click').click(function () {
      var notification = $(this);
      notification.fadeOut(300);
      setTimeout(function () {
        notification.remove();
      }, 300);
    });

    if ($('#notifications').children().length > 3) {
      var notification = $('#notifications .notification:last-child');
      notification.fadeOut(300);
      setTimeout(function () {
        notification.remove();
      }, 300);
    }
  }

  init();
})();