tinymce.init({
  selector: "textarea#package_details",
  width: "100%",
  height: 300,
  plugins: [
    "image imagetools advlist autolink link lists charmap print preview hr anchor pagebreak",
    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
    "table emoticons template paste",
  ],
  toolbar:
    "undo redo | link image | styleselect | bold italic | alignleft aligncenter alignright alignjustify | " +
    "bullist numlist outdent indent | print preview media fullpage | " +
    "forecolor backcolor emoticons",
  menubar: "favs file edit view insert format tools table",
  automatic_uploads: true,
  file_picker_types: "image",
  file_picker_callback: function (cb, value, meta) {
    var input = document.createElement("input");
    input.setAttribute("type", "file");
    input.setAttribute("accept", "image/*");

    /*
          Note: In modern browsers input[type="file"] is functional without
          even adding it to the DOM, but that might not be the case in some older
          or quirky browsers like IE, so you might want to add it to the DOM
          just in case, and visually hide it. And do not forget do remove it
          once you do not need it anymore.
        */

    input.onchange = function () {
      var file = this.files[0];

      var reader = new FileReader();
      reader.onload = function () {
        /*
                  Note: Now we need to register the blob in TinyMCEs image blob
                  registry. In the next release this part hopefully won't be
                  necessary, as we are looking to handle it internally.
                */
        var id = "blobid" + new Date().getTime();
        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
        var base64 = reader.result.split(",")[1];
        var blobInfo = blobCache.create(id, file, base64);
        blobCache.add(blobInfo);

        /* call the callback and populate the Title field with the file name */
        cb(blobInfo.blobUri(), { title: file.name });
      };
      reader.readAsDataURL(file);
    };

    input.click();
  },
  init_instance_callback: function (editor) {
    // update validation status on change`
    editor.on("Change", function (e) {
      tinyMCE.triggerSave();
    });
  },
});
