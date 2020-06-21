import { enviarPeticion as xhr } from "./fetch.js";
import { getDatos } from "./formularios.js";

const sendLoginInfo = async() => {
	const loginForm = document.getElementById("login-form"),
		fd = getDatos(loginForm);
	const res = await xhr("login.php", fd);
	if (res.error) mostrarError(res.error);
	else location.href = '/';
}

const mostrarError = (error) => {
	const errbx = document.getElementById('error-msg');
	errbx.classList.add('active');
	errbx.innerText = error;
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