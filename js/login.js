import { enviarPeticion as xhr } from "./fetch.js";
import { getDatos } from "./formularios.js";
import { mostrarMensaje } from "./mensajes.js";

const sendLoginInfo = async() => {
	const loginForm = document.getElementById("login-form"),
		fd = getDatos(loginForm);
	const res = await xhr("login.php", fd);
	await mostrarMensaje(res.error, () => { location.href = '/' }, true);
}

document.addEventListener("DOMContentLoaded", (evt) => {
	let form = document.getElementById("login-form");
	form.addEventListener("submit", e => {
		e.preventDefault();
		if (e.target.reportValidity())
			sendLoginInfo();
	})

	setTimeout(function() {
		var pass = document.forms[0].elements[1],
			bg = pass.computedStyleMap().get("background-color");
		//Cuando el navegador autocompleta este campo, le pone un color
		if (bg.toString() != "rgba(0, 0, 0, 0)")
			pass.labels[0].classList.add("active");
	}, 10);
})