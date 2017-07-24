$(document).ready(function(){
  $('.commands form').each(function() {
    $(this).submit(function(event) {
      event.preventDefault();

      const $form = $(this);

      if (!$form.exists()) {
        alert('Le formulaire \'' + formId + '\' n\'existe pas !');
        return;
      }

      $statusWrapper = $('#statusWrapper > p');
      $messageWrapper = $('#messageWrapper > p');
      $dataWrapper = $('#dataWrapper > pre');
      $debugWrapper = $('#debugWrapper > div');

      $statusWrapper.html('');
      $messageWrapper.html('');
      $dataWrapper.html('');
      $debugWrapper.html('');

      $.ajax({
        url      : $form.attr('action'),
        type     : $form.attr('method'),
        data     : $form.serialize(),
        dataType : 'json',
      })
        .done(function(data, status, request) {
          $statusWrapper.html(data.status);
          $messageWrapper.html(data.message);
          $dataWrapper.html(data.data.replace(new RegExp('<', 'g'), '&lt;'));
          $debugWrapper.html(data.debug);
        })
        .fail(function(request, status, error) {
          alert('Error : ' + error);
        })
    });
  });
});

$.fn.exists = function () {
  return this.length !== 0;
}
