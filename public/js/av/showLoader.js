const showLoader = (state = false) => {
  const loader = document.getElementById("av_loader");

	if (!!state) {
		loader.style.display = "block";
	} else {
		loader.style.display = "none";
	}
};

// showLoader(true);

// setTimeout(() => {
// 	showLoader(false);
// }, 2000);
