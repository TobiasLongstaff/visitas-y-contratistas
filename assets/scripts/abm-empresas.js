$(document).ready(() =>
{
    var edit_empresa = false;
    obtener_empresas();

    $('#btn-volver').click(function()
    {
        window.location.replace('/');
    })

    $("#form-agregar-empresa").submit(function(e)
    {
        const postData =
        {
            nombre: $('#nombre-empresa').val(),
            id: $('#id-empresa').val()
        };

        let url = edit_empresa === false ? 'partials/agregar-empresa.php' : 'partials/editar-empresa.php';

        $.post(url, postData, function (data)
        {
            if(data == "1")
            {
                Swal.fire(
                    '¡Operación realizada exitosamente!',
                    '',
                    'success'
                )
                const form = document.getElementById("form-agregar-empresa");
                form.reset();
                edit_empresa = false;7
                $('#btn-agregar-nueva-empresa').val('Agregar');
                $('#btn-agregar-nueva-empresa').css('background-color', 'var(--azul)')
                obtener_empresas()
            }
            else
            {
                console.log(data);
            }
        }); 
        e.preventDefault();   
    });

    $(document).on('click', '.eliminar-empresa', function(e)
    {
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('filaid');

        Swal.fire(
        {
            title: '¿Queres eliminar esta empresa?',
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
                $.post('partials/eliminar-empresa.php', {id}, function()
                {
                    Swal.fire(
                        '¡Empresa eliminarda exitosamente!',
                        '',
                        'success'
                    )
                    obtener_empresas();
                });       
            }
        });
        e.preventDefault();
    })

    $(document).on('click', '.editar-empresa', function(e)
    {
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('filaid');

        $.post('partials/obtener-datos-empresa-editar.php', {id}, function(data)
        {
            const empresa = JSON.parse(data);
            $('#nombre-empresa').val(empresa.nombre);
        })

        $('#btn-agregar-nueva-empresa').val('Editar');
        $('#btn-agregar-nueva-empresa').css('background-color', '#15a95b')
        edit_empresa = true;
        $('#id-empresa').val(id);
        e.preventDefault();
    })

    function obtener_empresas()
    {
        $.ajax(
        {
            url: 'partials/obtener-empresas.php',
            type: 'GET',
            success: function (response)
            {
                let empresas = JSON.parse(response);
                let plantilla = '';
                
                empresas.forEach(empresa =>
                {
                    plantilla += 
                    `
                    <tr filaId="${empresa.id}">
                        <td class="td-controles">
                            <button class="btn-editar editar-empresa"><i class="uil uil-edit-alt"></i></button>
                        </td>
                        <td class="td-controles">
                            <button class="btn-eliminar eliminar-empresa"><i class="uil uil-trash-alt"></i></button>
                        </td>
                        <td>${empresa.id}</td>
                        <td>${empresa.nombre}</td>
                    </tr>  
                    `                           
                });
                $('#container-empresa').html(plantilla);
            }
        });
    }

})