const $pagina = document;
const $main = $pagina.querySelector("main");
const $cerrarNav = $pagina.querySelector(" .navbar-collapse");


const plantillaAdmin = async (options) => {
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


$pagina.addEventListener("click", eventoNav => {
    if (eventoNav.target.matches("li a")) {
        eventoNav.preventDefault();

        plantillaAdmin({
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