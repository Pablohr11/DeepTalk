function init() {
    document.getElementById("inpu").addEventListener('keydown', function() {
        var filtro = document.getElementById("inpu").value;
        $.ajax({
            url: 'ajaxUsers.php',
            method: 'GET',
            data: {
                filter: filtro
            },
            dataType: 'json',
            success: function(mensajesFaltantes) {
                var select = document.getElementById("selector");
                select.innerHTML = "";
                for (var mensaje of mensajesFaltantes) {
                    console.log(mensaje);
                    var newLine = document.createElement("option");
                    newLine.setAttribute("value", mensaje[0]);
                    select.appendChild(newLine);
                    
                }

            },
            error: function(error) {
                console.error(error);
            }
        });
    });
}