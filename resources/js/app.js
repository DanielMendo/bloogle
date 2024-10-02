import '../css/app.css';
import Dropzone from "dropzone";
import Swiper from 'swiper';

const form = document.getElementById('form-create');
const button = document.getElementById('submit-create');
const input_cp = document.getElementById('input-cp');
const btn_cp = document.getElementById('btn-copy')
const btn_cancel = document.getElementById('cancelButton')
const btn_submit = document.getElementById('submitButton')
const comment_content = document.getElementById('commentContent')

btn_cp.addEventListener('click', function() {
  input_cp.select();
  document.execCommand('copy');

  const msg_copy = document.getElementById('msg-copy')
  msg_copy.style.display = 'block';
})

btn_cancel.addEventListener('click', function() {
  comment_content.value = '';
})

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

new Swiper('.swiper', {
    // Optional parameters 
    loop: true,
    slidesPerView: 2,
  
    // If we need pagination
    pagination: {
      el: '.swiper-pagination',
    },
  
    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },

  });


 