document.addEventListener("DOMContentLoaded", function () {
    const mainContent = document.querySelector('main.content');
    const sidebar = document.querySelector('#sidebar');

    // 1. Función AJAX mejorada
    const getPHP = (url, success, error) => {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", url);
        xhr.setRequestHeader("Content-type", "text/html; charset=utf-8");

        xhr.onload = () => {
            if (xhr.status >= 200 && xhr.status < 300) {
                success(xhr.responseText);
            } else {
                error(`Error ${xhr.status}: ${xhr.statusText}`);
            }
        };

        xhr.onerror = () => error("Error de conexión");
        xhr.send();
    };

    // 2. Cargar contenido en el main (sin cambiar la URL)
    const loadContent = (url) => {
        getPHP(
            url,
            (html) => {
                mainContent.innerHTML = html; // Cargar el contenido en el main
            },
            (err) => {
                mainContent.innerHTML = `
                    <div class="alert alert-danger m-4">
                        <h4>Error al cargar la página</h4>
                        <p>${err}</p>
                    </div>
                `;
            }
        );
    };

    // 3. Manejador de clics en el sidebar
    const handleSidebarClick = (e) => {
        const link = e.target.closest('a.sidebar-link');

        if (link) {
            e.preventDefault(); // Evitar la navegación predeterminada
            const targetUrl = link.getAttribute('href');

            // Cargar solo si es una ruta interna
            if (isInternalLink(targetUrl)) {
                loadContent(targetUrl); // Cargar el contenido en el main
                setActiveLink(link); // Resaltar el enlace activo
            } else {
                window.location.href = targetUrl; // Navegar normalmente si es externo
            }
        }
    };

    // 4. Funciones auxiliares
    const isInternalLink = (url) => {
        const parser = document.createElement('a');
        parser.href = url;
        return parser.hostname === window.location.hostname;
    };

    const setActiveLink = (activeLink) => {
        document.querySelectorAll('.sidebar-link').forEach((link) => {
            link.parentElement.classList.remove('active'); // Quitar clase activa de todos
        });
        activeLink.parentElement.classList.add('active'); // Resaltar el enlace activo
    };

    // 5. Configuración de eventos
    sidebar.addEventListener('click', handleSidebarClick);

    // Carga inicial
    const initialUrl = window.location.pathname;
    loadContent(initialUrl.includes('admin') ? 'perfil.php' : initialUrl);
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