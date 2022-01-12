if ($('.tinymce')) {
    tinymce.init({
        selector: '.tinymce',
        branding: false,
        init_instance_callback: function (editor) {
            editor.on("Change", function (e) {
                tinyMCE.triggerSave();
            });
        }
    });
}
function tinymceValidation() {
  var content = tinymce.get('description').getContent();
  if (content === "" || content === null) {
    $("#descriptionError").html("<span>Please enter description before continue.</span>");
    return false;
  } else {
    $("#descriptionError").html("");
    return true;
  }
}