/** Obtiene un objeto FormData que representa los datos del formulario
 * @param form : HTMLFormElement El formulario a ser analizado.
 * @returns un objeto FormData o undefined si el formulario no es válido
 */
export const getDatos = (form) => {
	if (form.reportValidity()) {
		const formData = new FormData();
		for (const element of form) {
			const nombre = element.name || element.id;
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
						if (element.checked) formData.append(element.name || element.id, true);
					} else {
						formData.append(nombre, element.value);
					}
				}
			}
		}
		return formData;
	}
}