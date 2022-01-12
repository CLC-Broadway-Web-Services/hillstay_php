var totalImages = 0;
var listing_id_step_9 = $('#listing_id').val();

let galleryImagesToChoose = [];
let galleryImagesToDelete = [];
const image_files = document.getElementById('image_files');
const listing_gallery = document.getElementById('listing_gallery');

function galleryFiles() {
    var images = image_files.files;
    console.log(images);
    for (i = 0; i < images.length; i++) {
        galleryImagesToChoose.push(images[i]);
        insertImageToView(images[i], i);
        // console.log(galleryImagesToChoose)
    }
}
function insertImageToView(image, index) {

    console.log(image);
    var IMG = document.createElement("img");
    var reader = new FileReader();
    reader.onload = function () {
        IMG.setAttribute('src', reader.result);
        IMG.setAttribute('width', 'auto');
    };
    reader.readAsDataURL(image);

    var DIV1 = document.createElement('div');
    DIV1.classList.add('gallery_image_block');
    DIV1.setAttribute('id', 'image_block_x' + (i + 1));

    var HR = document.createElement('hr');

    var DIV2 = document.createElement("div");
    DIV2.classList.add('inputsDiv');
    DIV2.classList.add('mt-3');

    var INPUTCAPTION = document.createElement("INPUT");
    INPUTCAPTION.setAttribute("type", "text");
    INPUTCAPTION.classList.add('mb-0');
    INPUTCAPTION.setAttribute("name", "caption[" + i + "]");
    INPUTCAPTION.setAttribute("placeholder", "image captions here");

    var DIV3 = document.createElement("div");
    DIV3.classList.add('checkboxes');
    DIV3.classList.add('in-row');

    var INPUTCOVER = document.createElement("INPUT");
    INPUTCOVER.setAttribute("type", "radio");
    INPUTCOVER.classList.add('captionsCheckbox');
    INPUTCOVER.setAttribute("name", "cover");
    INPUTCOVER.setAttribute("id", "checkbox" + [i]);
    INPUTCOVER.value = i;

    var LABEL = document.createElement("LABEL");
    LABEL.setAttribute("for", "checkbox" + [i]);
    LABEL.innerHTML = "for Cover image";

    var DELETE = document.createElement("i");
    DELETE.classList.add('im');
    DELETE.classList.add('im-icon-Close');
    DELETE.style.float = "right";
    DELETE.style.fontSize = "x-large";
    DELETE.setAttribute('onclick', 'deleteGalleryImage("' + index + '")');

    DIV3.appendChild(INPUTCOVER);
    DIV3.appendChild(LABEL);
    DIV3.appendChild(DELETE);
    DIV2.appendChild(INPUTCAPTION);
    DIV2.appendChild(DIV3);
    DIV1.appendChild(IMG);
    DIV1.appendChild(HR);
    DIV1.appendChild(DIV2);

    listing_gallery.appendChild(DIV1);
    console.log(galleryImagesToChoose);
}

function deleteGalleryImage(index) {
    var numberIndex = parseInt(index);
    galleryImagesToChoose.splice(numberIndex, 1);
    // image_files.splice(numberIndex, 1);
    var getIndex = 'image_block_x' + (parseInt(index) + 1);
    console.log(getIndex);
    document.getElementById(getIndex).remove();
}
