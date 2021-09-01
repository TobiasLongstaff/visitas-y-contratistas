$(document).ready(() =>
{
    const imagePreview = document.getElementById('imagen-art');
    const imageUploader = document.getElementById('btn-subir-imagen-art');
    const imageUploadbar = document.getElementById('img-upload-bar-art'); 

    const CLOUDINARY_URL = `https://api.cloudinary.com/v1_1/dvc29rwuo/image/upload`;
    const CLOUDINARY_UPLOAD_PRESET = 'siebycml';

    imageUploader.addEventListener('change', async (e) => {
        const file = e.target.files[0];
        const formData = new FormData();
        formData.append('file', file);
        formData.append('upload_preset', CLOUDINARY_UPLOAD_PRESET);

        // Send to cloudianry
        const res = await axios.post(
            CLOUDINARY_URL,
            formData,
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
                onUploadProgress (e) {
                    let progress = Math.round((e.loaded * 100.0) / e.total);
                    console.log(progress);
                    imageUploadbar.setAttribute('value', progress);
                }
            }
        );
        console.log(res);
        imagePreview.value = res.data.secure_url;
        // document.getElementById('imagen-perfil').value = res.data.secure_url;
    });    
});

function readURL_art(input) 
{
    if (input.files && input.files[0]) 
    {
        var reader = new FileReader();

        reader.onload = function(e) 
        {
            $('.imagen-upload-art').hide(); 
            $('.file-upload-image-art').attr('src', e.target.result);
            $('.file-upload-content-art').show();   
            $('.image-title-art').html(input.files[0].name);
        };
        reader.readAsDataURL(input.files[0]);
    } 
    else 
    {
        removeUpload_art();
    }
}

function removeUpload_art() 
{
    // $('.file-upload-input').replaceWith($('.file-upload-input').clone());
    $('.file-upload-content-art').hide();
    $('.imagen-upload-art').show();
}

$('.imagen-upload-art').bind('dragover', function () 
{
    $('.imagen-upload-art').addClass('image-dropping');
});

$('.imagen-upload-art').bind('dragleave', function () 
{
    $('.imagen-upload-art').removeClass('image-dropping');
});