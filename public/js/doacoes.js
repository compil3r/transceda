var p = document.getElementById("valor"),
res1 = document.getElementById("resultado")

if(res1) {
	p.addEventListener("input", function () {
		res1.innerHTML = "R$" + p.value;
	}, false);
}

function editarComentario(id) {
	$("#comentario_"+id).hide();
	$("#editar_"+id).show();

	console.log(id);
}