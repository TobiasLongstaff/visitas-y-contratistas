$(document).ready(() =>
{
    const fecha = new Date();

    $('#nuevo-contratista').click(function(e)
    {
        $(this).addClass('prevision-select');
        $('#ingresar-contratista').removeClass('prevision-select');
        $('#opcion-ingresar').css('display', 'none');
        $('#opcion-nuevo').css('display', 'flex');
        e.preventDefault();
    })

    $('#ingresar-contratista').click(function(e)
    {
        $(this).addClass('prevision-select');
        $('#nuevo-contratista').removeClass('prevision-select');
        $('#opcion-nuevo').css('display', 'none');
        $('#opcion-ingresar').css('display', 'flex');
        obtener_contratistas_ingresados()
        e.preventDefault();
    })

    $('#btn-buscar-qr').click(function()
    {
        $(this).css('background', '#9552a2');

        $('#textbox-codigo-qr').show();
        $('#textbox-codigo-qr').focus();
    });

    $('#form-buscar-por-qr').submit(function(e)
    {
        e.preventDefault();
        var codigo_qr = ''
        codigo_qr = $('#textbox-codigo-qr').val();
        array_qr = codigo_qr.split("@"); 
        if(codigo_qr != '')
        {
            const tipo = 'qr'
            let filtro = array_qr[0];
            console.log(filtro);
            obtener_contratistas_ingresados(filtro, tipo)
        }
        $('#textbox-codigo-qr').val('');
        $('#textbox-codigo-qr').hide();
        $('#btn-buscar-qr').css('background', 'var(--azul)');
    })

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
                    $('#fecha-art').val(usuario.fecha_art);  
                    $('.image-upload-wrap').hide();
                    $('.file-upload-image').attr('src', usuario.imagen);  
                    $('.file-upload-content').show(); 
                    $('#imagen-perfil').val(usuario.imagen);
                    
                    $('.imagen-upload-art').hide();
                    $('.file-upload-image-art').attr('src', usuario.imagen_art);  
                    $('.file-upload-content-art').show(); 
                    $('#imagen-art').val(usuario.imagen_art);

                    var fecha_art = usuario.fecha_art;

                    let day = fecha.getDate()
                    let month = fecha.getMonth() + 1
                    let year = fecha.getFullYear()

                    if(month < 10)
                    {
                        var fecha_actual = `${year}-0${month}-${day}`
                    }
                    else
                    {
                        var fecha_actual = `${year}-${month}-${day}`
                    }

                    if(fecha_actual <= fecha_art)
                    {
                        $('.validar-art').css('background-color', 'var(--verde)');
                    }
                    else
                    {
                        $('.validar-art').css('background-color', 'var(--rojo)');
                    }
                }
            });
        }
    })

    $('#form-ingreso-de-contratistas').submit(function(e) 
    {
        const postData =
        {
            nombre_apellido: $('#nombre-apellido').val(),
            dni: $('#dni').val(),
            fecha_de_nacimiento: $('#fecha-de-nacimiento').val(),
            empresa: $('#buscar-empresa').val(),
            temperatura: $('#temperatura').val(),
            sector_habilitado: $('#sector-habilitado').val(),
            vehiculo_modelo: $('#vehiculo-modelo').val(),
            patente: $('#patente').val(),
            // registra_fichada: $('#registra-fichada').val(),
            fecha_hora: $('#fecha-hora').val(),
            observacion: $('#observacion').val(),
            fecha_de_salida: $('#fecha-de-salida').val(),
            fecha_art: $('#fecha-art').val(),
            imagen_perfil: $('#imagen-perfil').val(),
            imagen_art: $('#imagen-art').val(),
        };

        $.post('partials/agregar-contratista.php', postData, function (data)
        {
            let response = data.substr(0, 6) 
            if(response == 'error0')
            {
                Swal.fire(
                    'Error',
                    'Este trabajador ya se encuentra activo',
                    'error'
                )
            }
            else
            {
                const form = document.getElementById("form-ingreso-de-contratistas");
                $('.file-upload-content-art').hide();
                $('.imagen-upload-art').show();
                $('.file-upload-content').hide();
                $('.image-upload-wrap').show();
                form.reset();
                $('#id-ingreso-contratista').val(data);
                $('#overlay').addClass("active");
                $('#popup').addClass("active");  
            }
        }); 
        e.preventDefault();
    })

    $('#btn-ticket').click(function ()
    {
        var id_ingreso = $('#id-ingreso-contratista').val();
        window.open('imprimir-ticket.php?id='+id_ingreso);
    });

    $('#btn-tarjeta').click(function ()
    {
        var id_ingreso = $('#id-ingreso-contratista').val();
        window.open('imprimir-tarjeta.php?id='+id_ingreso);
    });

    $('#btn-estado-salud').click(function ()
    {
        var id_ingreso = $('#id-ingreso-contratista').val();
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
        const form = document.getElementById("form-ingreso-de-contratistas");
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

    $(document).on('click', '.btn-ingresar-contratista', function(e) 
    {
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('filaid');
        $.post('partials/ingresar-contratista.php', {id}, function ()
        {
            obtener_contratistas_ingresados()
        })

        e.preventDefault();
    })

    $(document).on('click', '.btn-re-inprimir-trajeta', function()
    {
        let element = $(this)[0].parentElement.parentElement;
        let id_ingreso = $(element).attr('filaid');
        window.open('imprimir-tarjeta.php?id='+id_ingreso);
    })

    $('#form-filtrar-dni').submit(function(e) 
    {
        e.preventDefault();
        const tipo = 'dni';
        let filtro = $('#buscar-nombres').val()
        obtener_contratistas_ingresados(filtro, tipo)
    })

    function obtener_contratistas_ingresados(filtro, tipo)
    {
        $.ajax(
        {
            url: 'partials/obtener-contratistas-ingresados.php',
            type: 'POST',
            data: {filtro, tipo},
            success: function (response)
            {
                let plantilla = '';
                if(response == '[]')
                {
                    plantilla += 
                    `
                    <div colspan="3">
                        <span>No se encontraron contratistas habilitados</span>
                    </div>
                    `
                }
                else
                {
                    let sectores = JSON.parse(response);
                    
                    sectores.forEach(historial =>
                    {
                        plantilla += 
                        `
                        <tr filaId="${historial.id}">
                            <td class="td-primer-fila-controles">
                                <button class="btn-editar btn-ingresar-contratista">
                                    <i class="uil uil-user-check"></i>
                                </button>
                                <button class="btn-eliminar btn-re-inprimir-trajeta">
                                    <i class="uil uil-postcard"></i>
                                </button>
                            </td>
                            <td>${historial.nombre}</td>
                            <td>${historial.dni}</td>
                            <td>${historial.empresa}</td>
                            <td>${historial.sector_habilitado}</td>
                            <td>${historial.visita}</td>
                            <td>${historial.fecha_hora}</td>
                            <td>${historial.fecha_salida}</td>
                        </tr>  
                        `                           
                    });                    
                }
                $('#container-contratistas-ingresados').html(plantilla);
            }
        });
    }
});