/** Obtiene un objeto FormData que representa los datos del formulario
 * @param {HTMLFormElement} form El formulario a ser analizado.
 * @returns {FormData} un objeto FormData o undefined si el formulario no es válido
 */
export const getDatos = (form) => {
	if (form.reportValidity()) {
		const formData = new FormData();
		for (const element of form) {
			const nombre = element.getAttribute('name') || element.id;
			if (element.checkValidity() && nombre) {
				if (element.classList.contains("datepicker")) {
					let date = element.M_Datepicker.date;
					if (!date) continue;
					formData.append(nombre, date.toLocaleDateString("fr-CA", {
						year: "numeric",
						month: "2-digit",
						day: "2-digit",
					}));
				} else {
					if (element.type === 'submit') continue;
					if (element.type === 'checkbox') {
						formData.append(nombre, +(element.checked));
					} else if (element.value.length > 0) {
						formData.append(nombre, element.value);
					}
				}
			}
		}
		return formData;
	}
}