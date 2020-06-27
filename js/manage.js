import { enviarPeticion } from "./fetch.js";
import { getDatos } from "./formularios.js";
import { mostrarMensaje } from "./mensajes.js";
// import M from "./materialize.min.js";

const createCourse = async(form) => {
	const fd = getDatos(form),
		res = await enviarPeticion("create-course.php", fd);
	await mostrarMensaje(res.error || "Curso creado exitosamente", () => location.reload(), !!res.error);
}
document.addEventListener("DOMContentLoaded", () => {
	const crearCursoForm = document.getElementById("crear-curso"),
		crearUsuarioForm = document.getElementById("crear-usuario"),
		eliminarCursos = document.querySelectorAll("a.modal-trigger[href='#modal1']"),
		eliminarUsuarios = document.querySelectorAll("a.modal-trigger[href='#modal2']");

	crearCursoForm.addEventListener('submit', (e) => {
		e.preventDefault();
		if (e.target.reportValidity()) {
			createCourse(e.target);
		}
	});
	let btnDeleteCourse = document.getElementById("btn-delete-course"),
		titleCourse = document.getElementById("title-course");
	eliminarCursos.forEach(elem => {
		let course = elem;
		while (!course.id.startsWith("course_")) {
			course = course.parentElement;
		}
		const nombreCurso = course.getElementsByTagName('p')[0].innerText;
		elem.addEventListener("click", e => {
			bindCourse(course.id, btnDeleteCourse, titleCourse, nombreCurso);
		});
	});
	crearUsuarioForm.addEventListener("submit", e => {
		e.preventDefault();
		if (e.target.reportValidity()) {
			createUser(e.target);
		}
	});
	let btnDeleteUser = document.getElementById("btn-delete-user"),
		titleUser = document.getElementById("title-user");
	eliminarUsuarios.forEach(elem => {
		let user = elem;
		while (!user.id.startsWith("user_")) {
			user = user.parentElement;
		}
		const nombreUsuario = user.getElementsByTagName("p")[2].innerText;
		elem.addEventListener("click", e => {
			e.preventDefault();
			bindUser(user.id, btnDeleteUser, titleUser, nombreUsuario);
		})
	});
});

const bindCourse = (rowId, modalBtn, modalTitle, nombreCurso) => {
	let idCurso = rowId.substr(7);
	modalTitle.innerHTML = nombreCurso;
	modalBtn.onclick = function(e) {
		e.preventDefault();
		remove(idCurso, false);
	}
}
const remove = async(id, usuario = true) => {
	const fd = new FormData(),
		target = usuario ? "delete-user.php" : "delete-course.php";
	fd.append((usuario ? `student` : `course`), (usuario ? id : encodeURIComponent(btoa(id))));
	const res = await enviarPeticion(target, fd);
	M.toast({
		html: res.error || "Hecho",
		classes: `lighten-2 ${res.error ? "red" : "green"}`
	})
	if (!res.error)
		document.getElementById(
			usuario ?
			`user_${id}` :
			`course_${id}`
		).remove();
}
const createUser = async form => {
	const fd = getDatos(form),
		res = enviarPeticion("create-user.php", fd);
	console.log(res);
	await mostrarMensaje(res.error || `Agregaste correctamente a ${fd.get('firstname')}`, () => location.reload(), !!res.error);
}

const bindUser = (rowId, modalBtn, modalTitle, nombreUsuario) => {
	let dni = rowId.substr(5);
	modalTitle.innerHTML = nombreUsuario;
	modalBtn.onclick = function(e) {
		e.preventDefault();
		remove(dni);
	}
}