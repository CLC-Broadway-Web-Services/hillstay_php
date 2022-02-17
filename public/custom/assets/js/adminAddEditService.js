var serviceImageBlock = $('#serviceImageBlock');

function previewServiceImage(event) {
    var currentFile = event.files[0];
    console.log(currentFile)
    var imageData = URL.createObjectURL(currentFile);
    var imageSrc = '<img src="' + imageData + '">';
    serviceImageBlock.html(imageSrc);
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