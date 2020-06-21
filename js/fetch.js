export const enviarPeticion = async(target, payload, method = "POST") => {
	const req = await fetch(`/api/php/${target}`, {
		method,
		body: payload,
	});
	return await req.json();
}