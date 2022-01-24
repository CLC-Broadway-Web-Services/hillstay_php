var serviceImageBlock = $('#serviceImageBlock');


// document.getElementById('post_title').parentElement.append('<span id="post_description-error" class="invalid">T</span>');

function previewServiceImage(event) {
    var currentFile = event.files[0];
    console.log(currentFile)
    var imageData = URL.createObjectURL(currentFile);
    var imageSrc = '<img src="' + imageData + '">';
    serviceImageBlock.html(imageSrc);
}
function validateForm() {
    consoleForm($('#postForm'));
    var element = document.getElementById('post_description');
    var x = element.value;
    console.log('validation trigered');
    if (x == "") {
        var SPAN = document.createElement("span");
        SPAN.classList.add("customInvalid");
        SPAN.setAttribute('id', 'post_description-error');
        SPAN.innerHTML = 'This field is required.';
        element.parentElement.append(SPAN);
        return false;
    }
    return true;
}
// tinymce.init({
//     selector: ".tinymce-basic",
//     setup: function (editor) {
//         editor.on('change', function () {
//             editor.save();
//         });
//     }
// });

tinymce.init({
    selector: "#post_description",
    paste_data_images: true,
    height: 400,
    branding: false,
    plugins: 'print preview importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable charmap quickbars emoticons',
    menubar: 'file edit view insert format tools table',
    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | a11ycheck ltr rtl',
    autosave_ask_before_unload: true,
    autosave_interval: '30s',
    autosave_prefix: '{path}{query}-{id}-',
    autosave_restore_when_empty: false,
    autosave_retention: '2m',
    image_advtab: true,
    importcss_append: true,
    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
    noneditable_noneditable_class: 'mceNonEditable',
    toolbar_mode: 'sliding',
    spellchecker_whitelist: ['Lets Scale Up', 'LetsScaleUp'],
    content_style: '.mymention{ color: gray; }',
    contextmenu: 'link image imagetools table configurepermanentpen',
    a11y_advanced_options: true,
    // skin: useDarkMode ? 'oxide-dark' : 'oxide',
    // content_css: useDarkMode ? 'dark' : 'default',
    skin: 'oxide-dark',

    visualblocks_default_state: true,
    end_container_on_empty_block: true,


    // toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
    // toolbar2: "preview media | forecolor backcolor emoticons | link image | fullscreen",
    image_title: true,
    automatic_uploads: true,
    file_picker_types: 'image',
    file_picker_callback: function (cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');
        input.onchange = function () {
            var file = this.files[0];
            var reader = new FileReader();
            reader.onload = function () {
                var id = 'blobid' + (new Date()).getTime();
                var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                var base64 = reader.result.split(',')[1];
                var blobInfo = blobCache.create(id, file, base64);
                blobCache.add(blobInfo);
                cb(blobInfo.blobUri(), { title: file.name });
            };
            reader.readAsDataURL(file);
        };
        input.click();
    },
    setup: function (editor) {
        editor.on('keydown', function () {
            editor.save();
        });
        editor.on('keyup', function () {
            editor.save();
        });
        editor.on('change', function () {
            editor.save();
        });
    },
});
function consoleForm(form) {
    var fomrData = new FormData(form[0]);
    console.log(Array.from(fomrData));
}
// serviceAddEditForm.submit(function (e) {
//     e.preventDefault();
//     var formData = new FormData(serviceAddEditForm[0]);

//     console.log(Array.from(formData));
//     //get the action-url of the form
//     // //do your own request an handle the results
//     $.ajax({
//         url: actionurl,
//         type: "post",
//         data: formData,
//         processData: false,
//         contentType: false,
//         success: function (data) {
//             console.log(data)
//         },
//     });
// });