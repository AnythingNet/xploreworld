$(function () {

  $('#createarea').hide();

  var show_upload_status = function(status, status_text) {

      var status_color = '';

      $('.upload-heading-text')
        .hide()
        .empty()
        .append(status_text)
        .fadeIn('fast');

      $('#upload-area').removeClass('panel-default panel-info panel-danger');

      if (status == 'fileselected') {

        status_color = 'panel-default';

      } else if (status == 'sent') {

        status_color = 'panel-info';

      } else if (status == 'error') {

        status_color = 'panel-danger';

      }

      $('#upload-area').addClass(status_color);

  }

  var newupload_option = {
    dataType: 'json',
    sequentialUploads: true,
    autoUpload: false,
    add: function(e, data) {

      if ($('#upload-area').hasClass('panel-danger')) {

        show_upload_status('fileselected', 'Upload an image.');

      }

      $('#file-name-waiting').text(data.files[0].name);
      $('#createarea').fadeIn('slow');

      $('#btn-upload').unbind('click').bind('click', function(){
        data.submit();
      });  

      console.log(data.files);

    },
    submit: function(e, data) {

      console.log('submit');
      console.log(data.files);

    },
    send: function(e, data) {

      console.log('send');
      console.log(data);
      show_upload_status('sent', 'Uploading...');

    },
    start: function(e, data) {

      console.log('start');
      console.log(data);

    },
    done: function(e, data) {

      console.log('done');
      console.log(data.result.error);

      if (data.result.status == 'success') {

        location.reload();

      } else if (data.result.status == 'error') {

        show_upload_status('error', data.result.message + ' Please upload again.');

      }

    },
    always: function(e, data) {

      console.log('always');
      console.log(data);

    },
    fail: function(e, data) {

      console.log('fail');
      console.log(data);

    }
  };

  $('#fileupload').fileupload(newupload_option);

});

