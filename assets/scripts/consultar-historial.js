$(document).ready(() =>
{
    let limite = 20
    let tipo = ''
    let dni = ''
    let fecha = ''

    obtener_historial() 

    $('#btn-volver').click(function()
    {
        window.location.replace('/');
    })

    $('#form-filtrar-historial').submit(function(e)
    {
        e.preventDefault()
        tipo = $('#selectlist-filtrar').val()
        dni = $('#buscar-nombres').val()
        fecha = $('#fecha-filtro').val()
        obtener_historial() 
    });

    $(document).on('click', '.btn-mostrar-historial',function() 
    {
        console.log('click');
        let element = $(this)[0].parentElement.parentElement;
        let id_habilitacion = $(element).attr('filaid');
        let elemento_tr = $('.tr-historial-'+id_habilitacion)

        if($('.btn-mostrar-historial').is(":checked"))
        {
            elemento_tr.css('display','table-row');
            elemento_tr.removeClass('animate__animated animate__fadeOutUp animate__faster');
            elemento_tr.addClass('animate__animated animate__fadeInDown animate__faster'); 
            $('.btn-mas-'+id_habilitacion).removeClass('fa-angle-right').addClass('fa-angle-down');
        }
        else
        {
            elemento_tr.removeClass('animate__animated animate__fadeInDown animate__faster'); 
            elemento_tr.addClass('animate__animated animate__fadeOutUp animate__faster'); 
            elemento_tr.one('animationend', () => {
                elemento_tr.css('display','none'); 
            }); 
            $('.btn-mas-'+id_habilitacion).removeClass('fa-angle-down').addClass('fa-angle-right');
        }
    }); 

    $('#imprimir-historial').click(function()
    {
        $('#overlay').addClass("active");
        $('#popup').addClass("active");  
    });

    $('#btn-cerrar-popup').click(function()
    {
        $('#overlay').removeClass("active");
        $('#popup').removeClass("active");
    });

    $('#form-imprimir-historial').submit(function(e)
    {
        e.preventDefault();
        let fecha_desde = $('#fecha-desde').val()
        let fecha_hasta = $('#fecha-hasta').val()
        window.open('imprimir-ingreso-y-egreso.php?desde='+fecha_desde+'&hasta='+fecha_hasta);
    });

    $('#cargar-mas-filas').click(function()
    {
        limite = limite+20
        obtener_historial()
    })

    function obtener_historial()
    {
        $.ajax(
        {
            url: 'partials/obtener-historial.php',
            type: 'POST',
            data: { tipo, dni, fecha, limite },
            beforeSend: function()
            {
                $('.container-carga').css('display', 'flex');
            },
            success: function (response)
            {
                $('.container-carga').css('display', 'none');
                let sectores = JSON.parse(response);
                let plantilla = '';

                sectores.forEach(historial =>
                {
                    plantilla += 
                    `
                    <tr filaId="${historial.id}">
                        <td class="td-primer-fila">
                            <button class="btn-general btn-desplegable">
                                <i class="fas fa-angle-right btn-mas-${historial.id}"></i>
                            </button><br/>
                            <input type="checkbox" class="checkbox-desplegar btn-mostrar-historial">
                        </td>
                        <td>${historial.id}</td>
                        <td>${historial.nombre}</td>
                        <td>${historial.dni}</td>
                        <td>${historial.empresa}</td>
                        <td>${historial.sector_habilitado}</td>
                        <td>${historial.visita}</td>
                        <td>${historial.fecha_hora}</td>
                    </tr>  
                    <tr filaid="28" class="tr-historial tr-historial-${historial.id}">
                        <td colspan="9">
                            <div class="container-card-tabla">
                                <div>
                                    <h2 class="text-card">Mas Informacion</h2>
                                    <div class="container-info-card">
                                        <div>
                                            <label>Id: ${historial.id}</label><br>
                                            <label>Nombre apellido: ${historial.nombre}</label><br>
                                            <label>DNI: ${historial.dni}</label><br>
                                            <label>Empresa: ${historial.empresa}</label><br>
                                            <label>Sector habilitado: ${historial.sector_habilitado}</label><br>
                                            <label>Visita a:${historial.visita}</label><br>
                                            <label>Fecha de nacimiento: ${historial.fecha_de_nacimiento}</label><br>
                                            <label>Ingreso: ${historial.ingreso}</label>
                                        </div>
                                        <div>
                                            <label>Temperatura: ${historial.temperatura}</label><br>
                                            <label>Modelo de vehiculo: ${historial.vehiculo_modelo}</label><br>
                                            <label>Patente: ${historial.patente}</label><br>
                                            <label>Observacion: ${historial.observacion}</label><br>
                                            <label>Fecha y hora: ${historial.fecha_hora}</label><br>
                                            <label>Fecha de fin atencion: ${historial.fecha_salida}</label><br>
                                            <label>Movimiento: ${historial.tipo}</label>
                                        </div>
                                        <div class="container-img-card">
                                            <img class="img-card-tabla" src="${historial.imagen}">
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </td>
                    </tr>
                    `                           
                });
                $('#container-historial').html(plantilla);
            }
        });
    }
})