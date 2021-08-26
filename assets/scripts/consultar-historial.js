$(document).ready(() =>
{
    obtener_historial()

    function obtener_historial()
    {
        $.ajax(
        {
            url: 'partials/obtener-historial.php',
            type: 'GET',
            success: function (response)
            {
                let sectores = JSON.parse(response);
                let plantilla = '';
                
                sectores.forEach(historial =>
                {
                    plantilla += 
                    `
                    <tr filaId="${historial.id}">
                        <td class="td-primer-fila">
                            <button class="btn-controles-general btn-agregar">
                                <i class="fas fa-angle-right btn-mas-<?=$id?>"></i>
                            </button><br/>
                            <input type="checkbox" class="checkbox-desplegar btn-mostrar-historial">
                        </td>
                        <td>${historial.id}</td>
                        <td>${historial.nombre}</td>
                        <td>${historial.dni}</td>
                        <td>${historial.empresa}</td>
                        <td>${historial.sector_habilitado}</td>
                        <td>${historial.visita_a}</td>
                        <td>${historial.fecha_hora}</td>
                        <td>${historial.usuario}</td>
                    </tr>  
                    `                           
                });
                $('#container-historial').html(plantilla);
            }
        });
    }
})