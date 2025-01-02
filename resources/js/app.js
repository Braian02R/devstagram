import { drop } from 'lodash';
import './bootstrap';
import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Sube o arrastra aquí tu imagen",
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar Archivo",
    maxFiles: 1,
    uploadMultiple: false,

    init: function() {
        //alert("dropzone creado"); //alerta para cuando se crea dropzone
        if(document.querySelector('[name="imagen"]').value.trim()) {
            const imagenPublicada = {};
            imagenPublicada.size = 1234;
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call(this, imagenPublicada); //muestra datos de la imagen como si hubiese sido subida, cuando ocurre un error al ingresar los datos
            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`); // muestra la minuatura de la imagen,  cuando ocurre un error al ingresar los datos

            imagenPublicada.previewElement.classList.add('dz-succes', 'dz-complete');
        }
    }
});


// dropzone.on('sending', function(file, xhr, formData){
//     //console.log(file);
//     //console.log(formData);

// });

dropzone.on('success', function(file, response){
    //console.log(response.imagen);
    document.querySelector('[name="imagen"]').value = response.imagen;
});

// dropzone.on('error', function(file, message){
//     //console.log(message);
// });

dropzone.on('removedfile', function(){
    //console.log('Archivo Eliminado');
    document.querySelector('[name="imagen"]').value = "";
});