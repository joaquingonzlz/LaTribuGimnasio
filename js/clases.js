import { enviarPeticion } from "./fetch.js";
import { getDatos } from "./formularios.js";
import { mostrarMensaje } from "./mensajes.js";

document.addEventListener("DOMContentLoaded", (e) => {
	document.getElementById("form-create-class").addEventListener("submit", (e) => {
		e.preventDefault();
		createClass(e.target);
	});
})

/** @param {HTMLFormElement} form */
const createClass = async form => {
	const fd = getDatos(form);
	const res = await enviarPeticion("create-class.php", fd);
	await mostrarMensaje(
		res.error || "¡Agregaste una clase a este curso!",
		() => location.reload(), !!res.error
	);
}