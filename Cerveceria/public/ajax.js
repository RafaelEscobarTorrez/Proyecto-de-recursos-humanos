function verProduction(abrir) {
    var ajax = new XMLHttpRequest();
    ajax.open("get", abrir, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            document.querySelector('#content').innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-Type", "text/html; charset=utf-8");
    ajax.send();
}

function verIngredientes() {
    var ajax = new XMLHttpRequest();
    var id_receta = document.querySelector('#receta_id').value;
    var litros_producidos = document.querySelector('#litros_producidos').value;
    var fecha_inicio = document.querySelector('#fecha_inicio').value;

    ajax.open("GET", `calculate.php?id_receta=${id_receta}&quantity=${litros_producidos}&fecha_inicio=${fecha_inicio}`, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            document.querySelector('#calculos').innerHTML = ajax.responseText;
        }
    }
    ajax.send();
}

function verIngredientesAD() {
    var ajax = new XMLHttpRequest();
    var id_receta = document.querySelector('#receta_id').value;
    var litros_producidos = document.querySelector('#litros_producidos').value;
    var fecha_inicio = document.querySelector('#fecha_inicio').value;

    ajax.open("GET", `calculate.php?id_receta=${id_receta}&quantity=${litros_producidos}&fecha_inicio=${fecha_inicio}`, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            document.querySelector('#content').innerHTML = ajax.responseText;
        }
    }
    ajax.send();
}

function formEditar(id) {
    var ajax = new XMLHttpRequest(); //crea el objeto ajax
    ajax.open("GET", `edit_ingredient.php?id=${id}`, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            document.querySelector('#content').innerHTML = ajax.responseText;
        }
    }
    ajax.send();

}
function eliminar(id) {
    var ajax = new XMLHttpRequest(); //crea el objeto ajax
    ajax.open("GET", `delete_ingredient.php?id=${id}`, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            document.querySelector('#content').innerHTML = ajax.responseText;
        }
    }
    ajax.send();
}
