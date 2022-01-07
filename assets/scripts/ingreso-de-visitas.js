
$(document).ready(() =>
{

    $('#dni').keyup(function()
    {
        var dni = $(this).val();
        if(dni != '')
        {
            $.post('partials/buscar-trabajadores.php', {dni}, function (data)
            {
                if(data !== '')
                {
                    const usuario = JSON.parse(data);
                    $('#nombre-apellido').val(usuario.nombre);
                    $('#fecha-de-nacimiento').val(usuario.fecha_de_nacimiento);
                    $('#buscar-empresa').val(usuario.empresa);    
                    $('.image-upload-wrap').hide();
                    $('.file-upload-image').attr('src', usuario.imagen);  
                    $('.file-upload-content').show(); 
                    $('#imagen-perfil').val(usuario.imagen);                
                }
            });
        }
    })

    $('#form-ingreso-de-visitas').submit(function(e) 
    {
        const postData =
        {
            nombre_apellido: $('#nombre-apellido').val(),
            dni: $('#dni').val(),
            fecha_de_nacimiento: $('#fecha-de-nacimiento').val(),
            empresa: $('#buscar-empresa').val(),
            temperatura: $('#temperatura').val(),
            sector_habilitado: $('#sector-habilitado').val(),
            visita_a: $('#visita-a').val(),
            vehiculo_modelo: $('#vehiculo-modelo').val(),
            patente: $('#patente').val(),
            // registra_fichada: $('#registra-fichada').val(),
            fecha_hora: $('#fecha-hora').val(),
            observacion: $('#observacion').val(),
            imagen_perfil: $('#imagen-perfil').val(),
        };

        $.post('partials/agregar-visita.php', postData, function (data)
        {
            console.log(data);
            const form = document.getElementById("form-ingreso-de-visitas");
            $('.file-upload-content').hide();
            $('.image-upload-wrap').show();
            form.reset();
            $('#id-ingreso-visita').val(data);
            $('#overlay').addClass("active");
            $('#popup').addClass("active");  
        }); 
        e.preventDefault();
    })

    $('#btn-ticket').click(function ()
    {
        var id_ingreso = $('#id-ingreso-visita').val();
        window.open('imprimir-ticket.php?id='+id_ingreso);
    });

    $('#btn-tarjeta').click(function ()
    {
        var id_ingreso = $('#id-ingreso-visita').val();
        window.open('imprimir-tarjeta.php?id='+id_ingreso);
    });

    $('#btn-estado-salud').click(function ()
    {
        var id_ingreso = $('#id-ingreso-visita').val();
        window.open('imprimir-estado-de-salud.php?id='+id_ingreso);
    });

    $('#btn-cerrar-popup').click(function()
    {
        $('#overlay').removeClass("active");
        $('#popup').removeClass("active");
    });

    $('#btn-dni').click(function()
    {
        $(this).css('background', '#9552a2');

        $('.textbox-dni').show();
        $('.textbox-dni').focus();
    });

    $('#btn-cancelar').click(function()
    {
        const form = document.getElementById("form-ingreso-de-visitas");
        form.reset();
    });

    $('#form-cargar-datos-dni').submit(function(e)
    {
        e.preventDefault();
        var codigo = $('#textbox-codigo').val();
        array_dni = codigo.split("@"); 
        $('#nombre-apellido').val(array_dni[2]+' '+array_dni[1]);
        $('#dni').val(array_dni[4]);
        var fecha_de_nacimiento = array_dni[6];
        fecha_de_nacimiento = fecha_de_nacimiento.split("/");
        var fecha_de_nacimiento_final = fecha_de_nacimiento[2]+'-'+fecha_de_nacimiento[1]+'-'+fecha_de_nacimiento[0];
        $('#fecha-de-nacimiento').val(fecha_de_nacimiento_final);
        $('.textbox-dni').val('');
        $('.textbox-dni').hide();
        $('.btn-dni').css('background', '#883399');
        Swal.fire(
            '¡Los campos se completaron exitosamente!',
            '',
            'success'
        )
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