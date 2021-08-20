
$(document).ready(() =>
{
    $('#btn-dni').click(function()
    {
        $(this).css('background', '#9552a2');

        $('.textbox-dni').show();
        $('.textbox-dni').focus();
    });

    // $('.textbox-dni').blur(function()
    // {
    //     $('#btn-dni').css('background', '#883399');
    //     $('.textbox-dni').hide();
    // })

    $('#form-cargar-datos-dni').submit(function(e)
    {
        var codigo = $('#textbox-codigo').val();

        array_dni = codigo.split("@"); 

        console.log(array_dni)

        $('#nombre-apellido').val(array_dni.length(0));
        e.preventDefault();
    })

    $("#buscar-empresa").keyup(function()
    {
        $('#container-empresas').show();
        let buscar = $(this).val();
        let ancho = $(this).width();
        $('#container-empresas').width(ancho + 73);

        $.post('partials/buscar-empresas.php', {buscar}, function (data)
        {
            if(data == '[]')
            {
            }
            else
            {
                let empresas = JSON.parse(data);
                let plantilla = '';
                
                empresas.forEach(empresa =>
                {
                    plantilla += 
                    `
                    <button type="button" class="btn-nombre-empresa" filaId="${empresa.id}">${empresa.nombre}</button> 
                    `                           
                });
                $('#container-empresas').html(plantilla);
            }
        }); 
    });

    $(document).on('click','.btn-nombre-empresa', function(e)
    {
        let nombre = $(this).html();
        $("#buscar-empresa").val(nombre);
        $('#container-empresas').hide();
        e.preventDefault();
    })

    // SUBIR IMAGEN

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
});