/**@typedef {Object} Respuesta
 * @property {string|boolean} error
 * @property {string?} sqlstate
 */
/**
 * Envía una petición al Servidor y retorna un objeto JSON con la respuesta
 * @param {string} target Archivo que recibirá la petición HTTP
 * @param {FormData} payload Cuerpo de la petición
 * @param {string} [method = POST] Método HTTP de la petición
 * @returns {Promise<Respuesta>} un objeto JSON con el error y el sqlstate
 */
export const enviarPeticion = async(target, payload, method = "POST") => {
	const req = await fetch(`/api/php/${target}`, {
		method,
		body: payload,
	});
	return (await req.json());
}