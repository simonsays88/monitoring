/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function readURL(input, preview) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            preview.attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#initial_photoFront").change(function () {
    readURL(this, $('#preview_photoFront'));
});
$("#initial_photoSide").change(function () {
    readURL(this, $('#preview_photoSide'));
});
$("#initial_photoBack").change(function () {
    readURL(this, $('#preview_photoBack'));
});

$("#result_photoFront").change(function () {
    readURL(this, $('#preview_photoFront'));
});
$("#result_photoSide").change(function () {
    readURL(this, $('#preview_photoSide'));
});
$("#result_photoBack").change(function () {
    readURL(this, $('#preview_photoBack'));
});

$(".fancybox").fancybox();



