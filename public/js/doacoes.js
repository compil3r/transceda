var p = document.getElementById("valor"),
res1 = document.getElementById("resultado")

if(res1) {
	p.addEventListener("input", function () {
		res1.innerHTML = "R$" + p.value;
	}, false);
}
