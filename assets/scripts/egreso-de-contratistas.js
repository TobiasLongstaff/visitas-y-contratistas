$(document).ready(() =>
{
    $('#codigo-contratista').keyup(function()
    {
        var codigo = $(this).val();
        array_codigo = codigo.split("@"); 
        var id = array_codigo[0];
        if(id != '')
        {
            console.log(id);

            $('#id-trabajador').val(id);

            $.post('partials/buscar-contratista.php', {id}, function (data)
            {
                $('#container-info-contratistas').css('opacity', '1');
                let sectores = JSON.parse(data);
                let plantilla = '';
                $('#codigo-contratista').val('') ;
                
                sectores.forEach(historial =>
                {
                    plantilla += 
                    `
                    <div>
                        <label>Id: ${historial.id}</label><br>
                        <label>Nombre apellido: ${historial.nombre}</label><br>
                        <label>DNI: ${historial.dni}</label><br>
                        <label>Empresa: ${historial.empresa}</label><br>
                        <label>Sector habilitado: ${historial.sector_habilitado}</label><br>
                        <div class="container-img-card">
                            <img class="img-card-tabla" src="${historial.imagen}">
                        </div>
                    </div>
                    <div>
                        <label>Visita a: ${historial.visita}</label><br>
                        <label>Fecha de nacimiento: ${historial.fecha_de_nacimiento}</label><br>
                        <label>Ingreso: ${historial.ingreso}</label>
                        <label>Temperatura: ${historial.temperatura}</label><br>
                        <label>Modelo de vehiculo: ${historial.vehiculo_modelo}</label><br>
                        <label>Patente: ${historial.patente}</label><br>
                        <label>Observacion: ${historial.observacion}</label><br>
                        <label>Fecha y hora: ${historial.fecha_hora}</label><br>
                    </div>
                    `
                });
                $('#container-info-contratistas').html(plantilla);
            });
        }
    });

    $('#buscar-nombres').keyup(function()
    {
        var nombre = $(this).val();
        $('#container-nombres').show();
        let ancho = $(this).width();
        $('#container-nombres').width(ancho + 73);
        
        $.post('partials/buscar-nombres-contratista.php', {nombre}, function (data)
        {
            let nombres = JSON.parse(data);
            let plantilla = '';

            if(data == '[]')
            {
            }
            else
            {
                nombres.forEach(nombre =>
                {
                    plantilla += 
                    `
                    <button type="button" class="btn-nombre-trabajador" filaId="${nombre.id}">${nombre.nombre}</button> 
                    `                           
                });                
            }

            $('#container-nombres').html(plantilla);
        });
    })

    $('#form-egreso-de-contratista').submit(function(e)
    {
        var id = $('#id-trabajador').val();
        console.log(id)
        $.post('partials/terminar-contratista.php', {id}, function (data)
        {
            if(data == '1')
            {
                Swal.fire(
                    '¡Usuario egresado correctamente!',
                    '',
                    'success'
                )
                $('#container-info-contratistas').css('opacity', '0');
                $('#buscar-nombres').val('');
            }
        });
        e.preventDefault();
    });

    $(document).on('click','.btn-nombre-trabajador', function(e)
    {
        $('#container-info-contratistas').css('opacity', '1');
        let nombre = $(this).html();
        $('#buscar-nombres').val(nombre);
        $('#container-nombres').hide();

        let element = $(this)[0];
        let id = $(element).attr('filaid');

        $('#id-trabajador').val(id);

        $.post('partials/buscar-ingreso.php', {id}, function (data)
        {
            let sectores = JSON.parse(data);
            let plantilla = '';
            console.log(data);
            
            sectores.forEach(historial =>
            {
                plantilla += 
                `
                <div>
                    <label>Id: ${historial.id}</label><br>
                    <label>Nombre apellido: ${historial.nombre}</label><br>
                    <label>DNI: ${historial.dni}</label><br>
                    <label>Empresa: ${historial.empresa}</label><br>
                    <label>Sector habilitado: ${historial.sector_habilitado}</label><br>
                    <div class="container-img-card">
                        <img class="img-card-tabla" src="${historial.imagen}">
                    </div>
                </div>
                <div>
                    <label>Visita a: ${historial.visita}</label><br>
                    <label>Fecha de nacimiento: ${historial.fecha_de_nacimiento}</label><br>
                    <label>Ingreso: ${historial.ingreso}</label>
                    <label>Temperatura: ${historial.temperatura}</label><br>
                    <label>Modelo de vehiculo: ${historial.vehiculo_modelo}</label><br>
                    <label>Patente: ${historial.patente}</label><br>
                    <label>Observacion: ${historial.observacion}</label><br>
                    <label>Fecha y hora: ${historial.fecha_hora}</label><br>
                    <label>Usuario: ${historial.usuario}</label>
                </div>
                `
            });
            $('#container-info-contratistas').html(plantilla);
        });
        e.preventDefault();
    })
})