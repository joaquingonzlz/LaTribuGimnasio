const getDatos = () => {
	const user = document.getElementById('username').value,
		password = document.getElementById('password').value;
	return { user, password };
}

const sendLoginInfo = async() => {
	const req = await fetch('api/php/login.php', {
		method: 'POST',
		headers: {
			"Content-type": "application/json; charset=UTF-8"
		},
		body: JSON.stringify(getDatos())
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

document.addEventListener("DOMContentLoaded", () => {
	document.getElementById("login-form").addEventListener("submit", e => {
		e.preventDefault();
		// console.log(e.target.elements);
		if (e.target.reportValidity())
			sendLoginInfo();
	})
})