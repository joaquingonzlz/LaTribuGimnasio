const moverSidebar = (e) => {
	let sidebar = document.getElementById("sidebar-clases"),
		tab = document.getElementById("test-swipe-4");
	if (window.innerWidth < 993 && tab.childElementCount <= 0) {
		//Llevar el contenido del curso a las pestañas
		tab.appendChild(sidebar.removeChild(sidebar.firstElementChild));
	} else if (sidebar.childElementCount <= 0 && window.innerWidth >= 993) {
		//Llevar el contenido del curso al sidebar
		sidebar.appendChild(tab.removeChild(tab.firstElementChild));
		if (tab.classList.contains("active")) {
			document.getElementById("tab-descripcion").click();
		}
	}
}
const ultimoVisto = (clase) => {
	let fd = "uv=" + clase;
	// enviarPeticion("")
}
window.addEventListener("resize", moverSidebar);
document.addEventListener("DOMContentLoaded", (e) => {
	moverSidebar(e);
	const classSelectors = document.getElementsByName("class-selector"),
		videoPlayer = document.getElementById("video-player");
	for (let cs of classSelectors) {
		cs.addEventListener('click', e => {
			e.preventDefault();
			let video = cs;
			while (!video.getAttribute("data-video")) {
				video = video.parentElement;
				console.log("subiendo");
			}
			console.log(video);
			videoPlayer.src = `https://www.youtube.com/embed/${video.getAttribute("data-video")}`;
			video = video.parentElement.parentElement;
			video.parentElement.getElementsByClassName("seleccionado")[0].classList.remove("seleccionado");
			video.classList.add("seleccionado");
		});
	}
})