const getDatos = () => {
	const user = document.getElementById('username').value,
		password = document.getElementById('password').value;
	return { user, password };
}

const sendLoginInfo = async() => {
	let fd = new FormData(),
		input = getDatos();
	fd.append('user', input.user);
	fd.append('password', input.password);
	const req = await fetch('/api/php/login.php', {
		method: 'POST',
		body: fd,
		mode: 'cors'
	});
	const res = await req.json();
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