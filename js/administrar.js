import { enviarPeticion as xhr, enviarPeticion } from "./fetch.js";
import { getDatos } from "./formularios.js";
import M from "./materialize.min.js";

const crearCurso = async(form) => {
	const fd = getDatos(form),
		res = await enviarPeticion("create-course.php", fd);
	if (res.error) M.toast({ html: res.error, classes: "red lighten-2" });
	else M.toast({ html: "Curso creado con éxito", classes: "green lighten-2" });
}
document.addEventListener("DOMContentLoaded", () => {
	const crearCursoForm = document.getElementById("crear-curso"),
		crearUsuarioForm = document.getElementById("crear-usuario");

	crearCursoForm.addEventListener('submit', (e) => {
		e.preventDefault();
		if (e.target.reportValidity()) {
			crearCurso(e.target);
		}
	});
})