import { enviarPeticion } from "./fetch.js";
import { mostrarMensaje } from "./mensajes.js";
import { getDatos } from "./formularios.js";

document.addEventListener("DOMContentLoaded", (e) => {
	document.querySelectorAll('form').forEach(form => {
		form.addEventListener("submit", e => {
			e.preventDefault();
			if (e.target.reportValidity())
				cambiarDatosUsuario(e.target);
		});
	});
});

const cambiarDatosUsuario = async(form) => {
	const fd = getDatos(form),
		res = await enviarPeticion("update-user.php", fd),
		cb = form.id ? null : () => { location.href = '/logout.php' },
		msg = form.id ? 'Datos actualizados' : 'Contraseña actualizada, debes volver a ingresar';
	mostrarMensaje(res.error || msg, cb, !!res.error);
}