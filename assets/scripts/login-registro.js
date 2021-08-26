$(document).ready(() =>
{
    $("#form-login").submit(function(e)
    {
        const postData =
        {
            mail: $('#log-mail').val(),
            password: $('#log-pass').val()
        };
        $.post('partials/logeo.php', postData, function (data)
        {
            if(data == "1")
            {
                $(location).attr('href','index.php');
            }
            else
            {
                console.log(data);
                $('#text-alerta').html(data);
                $('.container-card-alerta').css(
                {
                    'background': 'var(--rojo)'
                });
                $('.container-card-alerta').addClass("active");

                setTimeout(ocultar_alerta,5000);
            }
        }); 
        e.preventDefault();   
    });

    $('#form-registrarse').submit(function (e)
    {
        const postData = 
        {
            mail: $('#regis-mail').val(),
            nombre_apellido: $('#regis-user').val(),
            password: $('#regis-pass').val(),
            password_con: $('#regis-pass-veri').val(),
            planta: $('#regis-planta').val()
        };
        $.post('partials/crear-cuenta.php', postData, function (data)
        {    
            console.log(data)      
            if(data == '11')
            {
                $('#text-alerta').html('¡Usuario registrado correctamente!');
                $('.container-card-alerta').css(
                {
                    'background': 'var(--verde)'
                });
                $('.container-card-alerta').addClass("active");

                setTimeout(ocultar_alerta,5000);   
                const form = document.getElementById("form-registrarse");
                form.reset();
            }
            else
            {
                $('#text-alerta').html(data);
                $('.container-card-alerta').css(
                {
                    'background': 'var(--rojo)'
                });
                $('.container-card-alerta').addClass("active");

                setTimeout(ocultar_alerta,5000);          
            }      

        });
        e.preventDefault();
    });

    function ocultar_alerta()
    {
        $('.container-card-alerta').removeClass("active");
    }
})