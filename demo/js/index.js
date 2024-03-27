
function showContenido(url)
{
    $.post(url, function(data) {
		$("#dvContenedorPpal").html(data);
	});
}
