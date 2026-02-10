const av_tost = document.getElementById("av_tost");
const av_tost_close = document.getElementById("av_tost_close");
const av_cashCoeff = document.getElementById("av_cashCoeff");
const av_cashUsd = document.getElementById("av_cashUsd");

const avCloseTost = () => {
	av_tost.classList.add("av_tost_close");

	setTimeout(() => {
		av_tost.classList.remove("av_tost_show");
		av_tost.classList.remove("av_tost_close");
		av_cashCoeff.textContent = "";
		av_cashUsd.textContent = "";
	}, 500);
};

const avShowTost = (coeff = "", usd = "") => {
	av_cashCoeff.textContent = `${coeff}x`;
	av_cashUsd.textContent = usd;
	av_tost.classList.add("av_tost_show");

	setTimeout(() => {
		avCloseTost();
	}, 3000);
};

av_tost_close.addEventListener("click", avCloseTost);


/*setTimeout(() => {
  avShowTost(100, 100);
}, 1000)*/
// avShowTost(100, 100);
// avCloseTost(); видалення тоста
