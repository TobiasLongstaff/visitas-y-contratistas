$(document).ready(() =>
{
    const imagePreview = document.getElementById('imagen-perfil');
    const imageUploader = document.getElementById('btn-subir-imagen-sistema');
    const imageUploadbar = document.getElementById('img-upload-bar'); 

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

function readURL(input) 
{
    if (input.files && input.files[0]) 
    {
        var reader = new FileReader();

        reader.onload = function(e) 
        {
            $('.image-upload-wrap').hide(); 
            $('.file-upload-image').attr('src', e.target.result);
            $('.file-upload-content').show();   
            $('.image-title').html(input.files[0].name);
        };
        reader.readAsDataURL(input.files[0]);
    } 
    else 
    {
        removeUpload();
    }
}

function removeUpload() 
{
    // $('.file-upload-input').replaceWith($('.file-upload-input').clone());
    $('.file-upload-content').hide();
    $('.image-upload-wrap').show();
}

$('.image-upload-wrap').bind('dragover', function () 
{
    $('.image-upload-wrap').addClass('image-dropping');
});

$('.image-upload-wrap').bind('dragleave', function () 
{
    $('.image-upload-wrap').removeClass('image-dropping');
});
