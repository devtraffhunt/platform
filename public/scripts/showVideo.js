const buttonsClose = document.querySelectorAll(".up_video_close_global");
const buttonsShow = document.querySelectorAll(".up_video_show_global");
const blockVideo = document.getElementById("up_video_container");

buttonsClose.forEach(el =>
	el.addEventListener("click", () => {
		blockVideo.style.display = "none";
	}),
);
buttonsShow.forEach(el =>
	el.addEventListener("click", () => {
		blockVideo.style.display = "flex";
	}),
);
