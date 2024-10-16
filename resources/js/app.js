import '../css/app.css';

import Dropzone from "dropzone";
import Swiper from 'swiper';

const form = document.getElementById('form-create');
const button = document.getElementById('submit-create');
const togglePassword = document.getElementById('togglePassword');
const password = document.getElementById('password');


Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone", {
    url: '/image',
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


