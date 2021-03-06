var TNF = (function () {
  var clientIpAddress;
  var userId;
  var likePhotoUrl;
  var unlikePhotoUrl;

  function init() {
    addSessionMessagesClickListeners();
    addLikePhotoClickListeners();
    getClientIpAddress();

    // Initialize entries masonry
    $('.entries-list').masonry({
      // set itemSelector so .grid-sizer is not used in layout
      itemSelector: '.grid-item',
      // use element for option
      columnWidth: '.grid-sizer',
      percentPosition: true
    });

    // Get the urls to like and unlike photos
    userId = $('meta[name="user-id"]').attr('content');
    likePhotoUrl = $('meta[name="like-photo-url"]').attr('content');
    unlikePhotoUrl = $('meta[name="unlike-photo-url"]').attr('content');
  }

  /* Send a post request */
  function sendPostRequest(url, data, type, button) {
    $.ajaxSetup({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    $.post(url, data, function(response) {
      switch (type) {
        case 'liked-photo':
          handlePhotoLiked(response, button);
          break;
        case 'unliked-photo':
          handlePhotoUnliked(response, button);
          break;
        case 'deleted-photo':
          handlePhotoDeleted(response, button);
          break;
        case 'disqualified-user':
          handleUserDisqualified(response, button);
          break;
      }
    })
    .fail(function(response) {
      console.log(response);
    });
  }

  /* Show a notification (Session message) */
  function showNotification(type, message) {
    var hMessage = '<div class="notification ' + type + '"><div class="container">'
      +'<p>' + message + ' <span class="btn-close">X</span></p>'
      + '</div></div>';

    $('#notifications').prepend(hMessage);
    addNotificationClickListener();
  }

  /* Add onClick listeners to all session messages */
  function addSessionMessagesClickListeners() {
    var notifications = $('.notification');

    notifications.off('click').click(function () {
      var notification = $(this);
      notification.fadeOut(300);
      setTimeout(function () {
        notification.remove();
      }, 300);
    });

    setTimeout(function () {
      notifications.fadeOut(300);
      setTimeout(function () {
        notifications.remove();
      }, 300);
    }, 3000);

    if ($('#notifications').children().length > 3) {
      var notification = $('#notifications .notification:last-child');
      notification.fadeOut(300);
      setTimeout(function () {
        notification.remove();
      }, 300);
    }
  }

  /* Add onClick listener to latest added notification */
  function addNotificationClickListener() {
    var notification = $('#notifications .notification:first-child');
    notification.off('click').click(function () {
      var notification = $(this);
      notification.fadeOut(300);
      setTimeout(function () {
        notification.remove();
      }, 300);
    });

    setTimeout(function () {
      notification.fadeOut(300);
      setTimeout(function () {
        notification.remove();
      }, 300);
    }, 3000);

    if ($('#notifications').children().length > 3) {
      var notification = $('#notifications .notification:last-child');
      notification.fadeOut(300);
      setTimeout(function () {
        notification.remove();
      }, 300);
    }
  }

  /* Add onClick listeners to all like buttons on the photos */
  function addLikePhotoClickListeners() {
    $('.entry .like').off('click').on('click', function () {
      if (!userId) {
        showNotification('error', 'You have to be logged in to like a photo.');
        return false;
      }
      toggleLikePhoto(this);
      disableLikeButton(this);
    });
  }

  /* Add onClick listener to one like button */
  function addLikePhotoClickListener(button) {
    button.off('click').on('click', function () {
      if (!userId) {
        showNotification('error', 'You have to be logged in to like a photo.');
        return false;
      }
      toggleLikePhoto(this);
      disableLikeButton(this);
    });
  }

  /* Add onClick listeners to delete photo buttons */
  function addDeletePhotoClickListeners() {
    $('.delete-photo-button').on('click', function (e) {
      e.preventDefault();
      var $btn = $(this);
      var deletePhotoUrl = $btn.data('delete-photo-url');
      sendPostRequest(deletePhotoUrl, [], 'deleted-photo', $btn);
    });
  }

  /* Add onClick listeners to disqualify user buttons */
  function addDisqualifyUserClickListeners() {
    $('.disqualify-user-button').on('click', function (e) {
      e.preventDefault();
      var $btn = $(this);
      var disqualifyUserUrl = $btn.data('disqualify-user-url');
      sendPostRequest(disqualifyUserUrl, [], 'disqualified-user', $btn);
    });
  }

  /* Get the clients IP address */
  function getClientIpAddress() {
    $.getJSON("https://jsonip.com/?callback=?", function (data) {
      clientIpAddress = data.ip;
    });
  }

  /* Handle like or unlike photo */
  function toggleLikePhoto(el) {
    var $likeBtn = $(el);
    var data = {
      'user-id': userId,
      'photo-id': $likeBtn.data('photo-id'),
      'ip-address': clientIpAddress
    };

    if ($likeBtn.hasClass('liked')) {
      sendPostRequest(unlikePhotoUrl, data, 'unliked-photo', $likeBtn);
      $likeBtn.removeClass('liked');
    } else {
      sendPostRequest(likePhotoUrl, data, 'liked-photo', $likeBtn);
      $likeBtn.addClass('liked');
    }
  }

  /* Disable like photo button */
  function disableLikeButton(el) {
    var $likeBtn = $(el);
    $likeBtn.off('click');
  }

  /* Update stuff after photo is liked */
  function handlePhotoLiked(response, button) {
    addLikePhotoClickListener(button);
    var $likes = button.parent().find('.likes');
    var likes = $likes.text().split(' ')[0];

    likes++;
    if (likes == 1) {
      $likes.text(likes + ' Like');
    } else {
      $likes.text(likes + ' Likes');
    }
  }

  /* Update stuff after photo is unliked */
  function handlePhotoUnliked(response, button) {
    addLikePhotoClickListener(button);
    var $likes = button.parent().find('.likes');
    var likes = $likes.text().split(' ')[0];

    likes--;
    if (likes == 1) {
      $likes.text(likes + ' Like');
    } else {
      $likes.text(likes + ' Likes');
    }
  }

  /* Update stuff after a photo is deleted */
  function handlePhotoDeleted(response, button) {
    showNotification(response.type, response.messages[0]);
  }

  /* Update stuff after a user is disqualified */
  function handleUserDisqualified(response, button) {
    showNotification(response.type, response.messages[0]);
  }


  init();

  return {
    addDeletePhotoClickListeners: addDeletePhotoClickListeners,
    addDisqualifyUserClickListeners: addDisqualifyUserClickListeners
  }
})();