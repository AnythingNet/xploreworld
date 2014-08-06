$(function(){

  $('#editor').summernote({
    height: 600,
    toolbar: [
      ['style', ['style']],
      ['font', ['strike']],
      ['fontname', ['fontname']],
      ['fontsize', ['fontsize']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['height', ['height']],
      ['table', ['table']],
      ['insert', ['link']],
      ['view', ['fullscreen', 'codeview']],
      ['help', ['help']]
    ]
  });

});
