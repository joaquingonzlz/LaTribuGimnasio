import { enviarPeticion as xhr, enviarPeticion } from "./fetch.js";
import { getDatos } from "./formularios.js";
// import M from "./materialize.min.js";

const crearCurso = async(form) => {
	const fd = getDatos(form),
		res = await xhr("create-course.php", fd);
	if (res.error) M.toast({ html: res.error, classes: "red lighten-2" });
	else {
		M.toast({ html: "Curso creado con éxito", classes: "green lighten-2" });
		location.reload();
	}
}
document.addEventListener("DOMContentLoaded", () => {
	const crearCursoForm = document.getElementById("crear-curso"),
		crearUsuarioForm = document.getElementById("crear-usuario"),
		eliminarCursos = document.querySelectorAll("a.modal-trigger[href='#modal1']");

	crearCursoForm.addEventListener('submit', (e) => {
		e.preventDefault();
		if (e.target.reportValidity()) {
			crearCurso(e.target);
		}
	});
	let btnDeleteCourse = document.getElementById("btn-delete-course"),
		titleCourse = document.getElementById("title-course");
	eliminarCursos.forEach(elem => {
		let course = elem;
		while (!course.id.startsWith("course_")) {
			course = course.parentElement;
		}
		console.log(course);
		const nombreCurso = course.getElementsByTagName('p')[0].innerText;
		elem.addEventListener("click", e => {
			bindCourse(course.id, btnDeleteCourse, titleCourse, nombreCurso);
		});
	});
});

const bindCourse = (id, btn, title, nombreCurso) => {
	let idCurso = id.substr(7);
	title.innerHTML = nombreCurso;
	btn.onclick = function(e) {
		e.preventDefault();
		borrar(idCurso, false);
	}
}
const borrar = async(id, usuario = true) => {
	const formData = new FormData(),
		target = usuario ? "delete-user.php" : "delete-course.php";
	formData.append((usuario ? `student` : `course`), (usuario ? id : encodeURIComponent(btoa(id))));
	const res = await enviarPeticion(target, formData, 'POST', true);
	M.toast({
		html: res.error || "Hecho",
		classes: `lighten-2 ${res.error ? "red" : "green"}`
	})
	if (!res.error)
		document.getElementById(`course_${id}`).remove();
}