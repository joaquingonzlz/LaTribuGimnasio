import { enviarPeticion } from "./fetch.js";
import { getDatos } from "./formularios.js";
import { mostrarMensaje } from "./mensajes.js";

document.addEventListener("DOMContentLoaded", (e) => {
	document.getElementById("form-create-class").addEventListener("submit", (e) => {
		e.preventDefault();
		createClass(e.target);
	});
	document.getElementById("form-edit-course").addEventListener("submit", e => {
		e.preventDefault();
		editCourse(e.target);
	})
	const moveUser = e => {
		let nombre = e.target.nextElementSibling.innerText,
			dni = e.target.id,
			row = e.target.parentElement;
		while (!row.classList.contains("row")) row = row.parentElement;
		addParticipant(dni, nombre, listaParticipantes);
		row.remove();
		listaParticipantes.querySelector(`#${dni} i`).onclick = moveParticipant;
	}
	const moveParticipant = e => {
		let participant = e.target;
		while (!participant.hasAttribute('data-user')) participant = participant.parentElement;
		let dni = participant.id,
			nombre = participant.getAttribute('data-user'),
			row = participant.parentElement;
		while (!row.classList.contains('row')) row = row.parentElement;
		remParticipant(dni, nombre, listaUsuarios);
		row.remove();
		listaUsuarios.querySelector(`input#${dni}`).onchange = moveUser;
	}
	const listaUsuarios = document.getElementById("list-usuarios"),
		listaParticipantes = document.getElementById("list-participantes"),
		userCBs = document.querySelectorAll("input[type=checkbox]"),
		partDls = document.getElementsByName("delete-participant");
	for (let cb of userCBs) {
		cb.onchange = moveUser;
	}
	for (let part of partDls) {
		part.onclick = moveParticipant;
	}
	document.getElementById("confirmar-participantes")
		.addEventListener('click', e => enviarParticipantes(e, listaParticipantes));

	let btnEditarClases = document.querySelectorAll('a.modal-trigger');
	for (const btn of btnEditarClases) {
		let clase = btn.parentElement;
		while (!clase.classList.contains("row")) clase = clase.parentElement;
		if (btn.getAttribute('href') == "#editarcurso") {
			btn.addEventListener('click', e => {
				getClassInfo(clase.id.substr('6'));
			})
		} else {
			btn.addEventListener('click', e => {
				deleteClass(btn.getAttribute('data-class'), btn.getAttribute('data-title'));
			});
		}
	}
	document.getElementById('form-edit-class').addEventListener('submit', async e => {
		e.preventDefault();
		const _fd = getDatos(e.target),
			res = await enviarPeticion("update-class.php", _fd);
		mostrarMensaje(res.error || "Actualizaste la clase!", () => location.reload(), !!res.error);
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

/**
 * @param {string} dni
 * @param {string} nombre
 * @param {HTMLDivElement} participants
 * */
const addParticipant = (dni, nombre, participants) => {
	participants.appendChild(parseHTML(`<div class="row fila">
		<div class="col s10"><p style="line-height: 50px; text-align:center">
			${nombre}
		</p></div>
		<div id="${dni}" data-user="${nombre}" class="col s2" style="display: flex; justify-content: center; align-items: center">
			<i style="cursor:pointer;" name="delete-participant" class="material-icons teal-text text-lighten-1">delete</i> 
		</div>
	</div>`));
}

/**
 * @param {number} dni
 * @param {string} nombre
 * @param {HTMLDivElement} users
 * */
const remParticipant = (dni, nombre, users) => {
	users.appendChild(parseHTML(`<div class="row" style="margin: 0;">
		<p>
			<label>
				<input id="${dni}" type="checkbox" style="position: static">
				<span>${nombre}</span>
			</label>
		</p>
	</div>`));
}

/**@param {MouseEvent} e
 * @param {HTMLDivElement} participants
 */
const enviarParticipantes = (e, participants) => {
	e.preventDefault();
	const fd = new FormData();
	fd.append('course', location.search.split("=")[1]);
	let items = participants.querySelectorAll("div[data-user]");
	console.log(participants, items);
	items.forEach((item, pos) => {
		console.log(item);
		fd.append(`part_${pos}`, item.id.substr(1));
	});
	enviarPeticion("create-participants.php", fd);
}

const parseHTML = str => {
	const tmp = document.implementation.createHTMLDocument()
	tmp.body.innerHTML = str
	return tmp.body.children[0];
}

const editCourse = async form => {
	const fd = getDatos(form),
		res = await enviarPeticion("update-course.php", fd);
	mostrarMensaje(res.error || "Información actualizada correctamente", null, !!res.error);
}

const getClassInfo = async _class => {
	let fd = new FormData();
	fd.append('class', _class);
	const courseInfo = await enviarPeticion("get-class-info.php", fd),
		classForm = document.getElementById('form-edit-class');
	classForm.class.value = _class;
	classForm.title.value = courseInfo.titulo;
	classForm.video.value = `https://www.youtube.com/watch?v=${courseInfo.video}`;
	classForm.date.value = courseInfo.fecha;
	classForm.title.labels[0].classList.add('active');
	classForm.video.labels[0].classList.add('active');
	classForm.date.labels[0].classList.add('active');
}

const deleteClass = id => {
	document.getElementById('eliminarcurso')
		.querySelector('a.modal-close')
		.onclick = async e => {
			e.preventDefault();
			const fd = new FormData();
			fd.append('class', id);
			const res = await enviarPeticion('delete-class.php', fd);
			mostrarMensaje(
				res.error || 'Eliminaste la clase', () => location.reload(), !!res.error
			);
		}
}