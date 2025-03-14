const $pagina = document;
$main = $pagina.querySelector("main");

const getPHP = (options) => {
    let { url, success, error } = options;
    const xhr = new XMLHttpRequest();

    xhr.addEventListener("readystatechange", e => {
        if (xhr.readyState!== 4) return;

        if (xhr.status >= 200 && xhr.status < 300) {
            let html = xhr.responseText;
            success(html);
        } else {
            let message = xhr.statusText || "Hay un error";
            error(`Error ${xhr.status}: ${message}`);
        }
    });

    xhr.open("GET", url);
    xhr.setRequestHeader("Content-type", "text/html; charset=utf-8");
    xhr.send();
}

document.addEventListener("DOMContentLoaded", e => {
    getPHP({
        url: "inicio.php",
        success:(html) => $main.innerHTML = html,
        error:(err) => $main.innerHTML = `<h1>${err}</h1>`
    });
});

document.addEventListener("click", e=> {
    if(e.target.matches(".navbar-nav li a:not(.text-primary)")) {
        e.preventDefault();
        getPHP({
            url: e.target.href,
            success:(html) => $main.innerHTML = html,
            error:(err) => $main.innerHTML = `<h1>${err}</h1>`
        });

        const navbarCollapse = document.querySelector(".navbar-collapse");
        if (navbarCollapse) {
            const bsCollapse = new bootstrap.Collapse(navbarCollapse, {
                toggle: false
            });
            bsCollapse.hide();
        }
    }
});


/*
const $cerrarNav = $pagina.querySelector(" .navbar-collapse");
const sinPlantilla = ["login.html"]; // Defectuoso


const plantillaIndex = async (options) => {
    let { url, success, error } = options;

    try {
        const respuesta = await fetch(url, {
            method: 'GET',
            headers: {
                "Content-type": "text/html; charset=utf-8"
            }
        });
        if (respuesta.ok) {
            const html = await respuesta.text();
            success(html);
        } else {
            const mensaje = respuesta.statusText || "Ocurrió un error al cargarse";
            error(`Error ${respuesta.status}: ${mensaje}`);
        }
    } catch (err) {
        error(`Érror: ${err.message}`);
    }
}

$pagina.addEventListener("DOMContentLoaded", eventoNav => {
    let ultimaPagina = localStorage.getItem("ultimaPagina");

    let urlRecargar = ultimaPagina ? ultimaPagina : "inicio.php"; //Sin ninguna cargada lelva al inicio

    plantillaIndex({
        url: urlRecargar,
        success: (html) => { $main.innerHTML = html; },
        error: (e) => { $main.innerHTML = `<b>${e}</b>`; }

    });
});

$pagina.addEventListener("click", eventoNav => {
    if (eventoNav.target.matches("li a")) {
        eventoNav.preventDefault();
        let ruta = eventoNav.target.getAttribute("href");

        localStorage.setItem("ultimaPagina", ruta);

        // Defectuoso
        const esconderNavFoo = sinPlantilla.some(page => ruta.endsWith(page));

        if (esconderNavFoo) {
            document.querySelector("header").style.display = "none";
            document.querySelector("footer").style.display = "none";
        } else {
            document.querySelector("header").style.display = "block";
            document.querySelector("footer").style.display = "block";
        }

        // 

        plantillaIndex({
            url: eventoNav.target.href,
            success: (html) => {
                $main.innerHTML = html;
                if ($cerrarNav.classList.contains("show")) {
                    $cerrarNav.classList.remove("show");
                }
            },
            error: (e) => { $main.innerHTML = `<b>${e}</b>`; }

        });
    }
});
*/