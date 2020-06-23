/**@callback MessageCallback():void */
/**
 * Muestra un mensaje en pantalla y ejecuta una función si el mensaje es de éxito.
 * @param {string} msj El mensaje que se mostrará en el pop-up
 * @param {function():void} cb Funcion que se ejecutará al cerrar el pop-up, si no hay error
 * @param {boolean} error Dice si el mensaje es de error o de éxito
 */
export const mostrarMensaje = async(msj, cb, error = false) => {
	M.toast({
		html: msj,
		classes: `lighten-2 ${
			error ? "red" : "green"
		}`
	});
	if (!error)
		setTimeout(() => {
			cb();
		}, 1000);
}