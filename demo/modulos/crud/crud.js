
function limpiarFormulario()
{
	$('input[type=text]').val("");
}

function eliminarUsuario(sID)
{
	$.post("modulos/crud/jxeliminarUsuario.php", { ID: sID })
    .done(function() 
    {   
		showContenido('modulos/crud/vwListarUsuarios.php');
    });  
}


function guardarRegistro()
{
	$("#spSuccess").hide();
	$("#dvErrorCaptura").hide();
	var result  = validaForm();

	var sNombre = $("#txtNombre").val();
	var sEmail =  $("#txtEmail").val();
	var sTelefono =  $("#txtTelefono").val();

	if (result == 0){
		$.post("modulos/crud/jxGuardarUsuario.php", { Nombre: sNombre, Email: sEmail, Telefono: sTelefono })
		.done(function() 
		{   
			limpiarFormulario();
			$("#spSuccess").fadeIn();
		});
	}else{
		$("#dvErrorCaptura").fadeIn();
	}
}

function actualizarRegistro(regID){
	$("#spSuccess").hide();
	$("#dvErrorCaptura").hide();
	var result  = validaForm();

	var sNombre = $("#txtNombre").val();
	var sEmail =  $("#txtEmail").val();
	var sTelefono =  $("#txtTelefono").val();

	if (result == 0){
		$.post("modulos/crud/jxActualizarUsuario.php", { ID: regID, Nombre: sNombre, Email: sEmail, Telefono: sTelefono })
		.done(function() 
		{   
			showContenido('modulos/crud/vwListarUsuarios.php');
		});
	}else{
		$("#dvErrorCaptura").fadeIn();
	}
}



function validaForm()
{
	let res = 0;

	$('input[type=text]').each(function(){
		$(this).removeClass("border-danger");

		if(!$(this).val()){
			$(this).addClass("border-danger");
			res = 1;
		}
	});

	return res;
}

function showEditUser(idUs){
	$.post("modulos/crud/vwEditarRegistro.php", { ID: idUs })
    .done(function(data) 
    {   
		$("#dvModalBody").html(data);
    });  
}