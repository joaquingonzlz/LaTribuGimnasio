import { enviarPeticion } from "./fetch.js";

document.addEventListener("DOMContentLoaded", e => {
	document.getElementsByName('clear_nt').forEach(elem => {
		elem.addEventListener('click', async e => {
			const fd = new FormData(),
				id = elem.getAttribute('data-course');
			fd.append('course', encodeURIComponent(btoa(id)));
			fd.append('clear_new', 1);
			const res = await enviarPeticion('update-participants.php', fd);
			if (!res.error) {
				let headernew = document.getElementById(`header_not_${id}`),
					sidenew = document.getElementById(`side_not_${id}`),
					ul = sidenew.parentElement,
					ulHeader = headernew.parentElement;
				headernew.previousElementSibling.remove();
				headernew.remove();
				sidenew.remove();
				document.querySelectorAll('.badge.new').forEach(badge => {
					if (ul.childElementCount > 0)
						badge.innerText = ul.childElementCount;
					else {
						badge.remove();
						ulHeader.innerHTML = '';
					}
				})
			}
		})
	})
})