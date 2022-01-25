$(document).ready(() =>
{
    var edit_sector = false;
    obtener_sectores();

    $('#btn-volver').click(function()
    {
        window.location.replace('/');
    })

    $("#form-agregar-sector").submit(function(e)
    {
        const postData =
        {
            nombre: $('#nombre-sector').val(),
            color: $('#color-sector').val(),
            id: $('#id-sector').val()
        };

        let url = edit_sector === false ? 'partials/agregar-sector.php' : 'partials/editar-sector.php';

        $.post(url, postData, function (data)
        {
            if(data == "1")
            {
                Swal.fire(
                    '¡Operación realizada exitosamente!',
                    '',
                    'success'
                )
                const form = document.getElementById("form-agregar-sector");
                form.reset();
                edit_sector = false;
                $('#btn-agregar-nuevo-sector').val('Agregar');
                $('#btn-agregar-nuevo-sector').css('background-color', 'var(--azul)')
                obtener_sectores()
            }
            else
            {
                console.log(data);
            }
        }); 
        e.preventDefault();   
    });

    $(document).on('click', '.eliminar-sector', function(e)
    {
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('filaid');

        Swal.fire(
        {
            title: '¿Queres eliminar este sector?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar',
        }).then((result) => 
        {
            if (result.isConfirmed) 
            {
                $.post('partials/eliminar-sector.php', {id}, function()
                {
                    Swal.fire(
                        '¡Sector eliminardo exitosamente!',
                        '',
                        'success'
                    )
                    obtener_sectores();
                });       
            }
        });
        e.preventDefault();
    })

    $(document).on('click', '.editar-sector', function(e)
    {
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('filaid');

        $.post('partials/obtener-datos-sector-editar.php', {id}, function(data)
        {
            const sector = JSON.parse(data);
            $('#nombre-sector').val(sector.nombre);
            $('#color-sector').val(sector.color);
        })

        $('#btn-agregar-nuevo-sector').val('Editar');
        $('#btn-agregar-nuevo-sector').css('background-color', '#15a95b')
        edit_sector = true;
        $('#id-sector').val(id);
        e.preventDefault();
    })

    function obtener_sectores()
    {
        $.ajax(
        {
            url: 'partials/obtener-sectores.php',
            type: 'GET',
            success: function (response)
            {
                let sectores = JSON.parse(response);
                let plantilla = '';
                
                sectores.forEach(sector =>
                {
                    plantilla += 
                    `
                    <tr filaId="${sector.id}">
                        <td class="td-controles">
                            <button class="btn-editar editar-sector"><i class="uil uil-edit-alt"></i></button>
                        </td>
                        <td class="td-controles">
                            <button class="btn-eliminar eliminar-sector"><i class="uil uil-trash-alt"></i></button>
                        </td>
                        <td>${sector.id}</td>
                        <td>${sector.nombre}</td>
                        <td>${sector.color}</td>
                    </tr>  
                    `                           
                });
                $('#container-sectores').html(plantilla);
            }
        });
    }

})