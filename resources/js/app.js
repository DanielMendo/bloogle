import '../css/app.css';
import Dropzone from "dropzone";

const form = document.getElementById('form-create');
const button = document.getElementById('submit-create');

Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: 'Sube aquí tu imagen',
    acceptedFiles: ".png, .jpg, .jpeg, .gif, .webp",
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar archivo',
    maxFiles: 1,
    uploadMultiple: false,
});

dropzone.on("success", function(file, response){
    console.log(response.image)

    document.querySelector('#inputImage').value = response.image
})

button.addEventListener('click', function() {
    form.submit()
})