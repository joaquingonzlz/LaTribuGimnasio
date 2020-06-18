const moverSidebar = (e) => {
	let sidebar = document.getElementById("sidebar-clases"),
		tab = document.getElementById("test-swipe-4");
	if (window.innerWidth < 993 && tab.childElementCount <= 0) {
		//Llevar el contenido del curso a las pestañas
		tab.innerHTML = sidebar.innerHTML;
		sidebar.innerHTML = '';
	} else if (sidebar.childElementCount <= 0 && window.innerWidth >= 993) {
		//Llevar el contenido del curso al sidebar
		sidebar.innerHTML = tab.innerHTML;
		tab.innerHTML = '';
		if (tab.classList.contains("active")) {
			document.getElementById("tab-descripcion").click();
		}
	}
}
const ultimoVisto = (clase) => {
	let fd = "uv=" + clase;
	// enviarPeticion("")
}
const selectClase = (e) => {
	const video = e.target.id;
	document.getElementById("iframe-clase").src = "https://www.youtube.com/embed/" + video;
	ultimoVisto(video);
}

window.addEventListener("resize", moverSidebar);
document.addEventListener("DOMContentLoaded", (e) => {
	moverSidebar(e);
})