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
	const req = await fetch('api/php/login.php', {
		method: 'POST',
		body: fd,
		mode: 'cors'
	});
	const res = await req.json();
	if (res.error) mostrarError(res.error);
	else location.href = '/latribu/';
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
		M.updateTextFields();
	}, 30);
})