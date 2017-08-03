<!doctype html>

<html lang="es">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Zipoints</title>
<meta name="description" content="">

<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<link rel="stylesheet" href="assets/css/bootstrap.css">
<link rel="stylesheet" href="assets/css/jquery.fancybox.css">
<link rel="stylesheet" href="assets/css/login.css">
</head>

<body class='login_body'>
	<div class="wrap">
		<img src="assets/images/logologin.png" alt="">
		<h4></h4>
		<form id="loginform" autocomplete="off" method="post" class="validate" action="ajaxlogin.php">
		<div id="error_msg_usuario" class="alert alert-error"></div>
		<div id="error_msg_password" class="alert alert-error"></div>
		<div id="verificando" class="alert alert-alert"></div>
		<div class="login">
			<div class="email">
				<div class="email-input">
					<div class="control-group">
						<div class="input-prepend">
							<input type="text" id="usuario" name="usuario" placeholder="Usuario">
						</div>
					</div>
				</div>
			</div>
			<div class="pw">
				<div class="pw-input">
					<div class="control-group">
						<div class="input-prepend">
							<input type="password" id="password" name="password" placeholder="Contraseña">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="submit">
			<button class="btn btn-success btn-block">Entrar</button>
			<button class="btn btn-default btn-block m-t-md">Registrarme</button>
		</div>
		</form>
	</div>
<script src="assets/js/jquery.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>
<script src="assets/js/jquery.metadata.js"></script>
<script>
$(document).ready(function()
	{
		$("#error_msg_usuario").hide();
		$("#error_msg_password").hide();
		$("#verificando").hide();
	});

$('#loginform').submit(function(event)
	{
		$("#error_msg_usuario").hide();
		$("#error_msg_password").hide();
		var usuario = $.trim($('#usuario').val()),
			pass = $.trim($('#password').val());
		var error = false;

		if (usuario.length === 0)
		{
			$("#error_msg_usuario").show();
			$("#error_msg_usuario").text("Por favor escribe tu nombre de usuario");
			error = true;
		}
		if (pass.length === 0)
		{
			$("#error_msg_password").show();
			$("#error_msg_password").text("Por favor escribe tu contraseña");
			error = true;
		}
		if (error)
		{
			return false;
		}
		else
		{
			$("#verificando").show();
			$("#verificando").text("Verificando identidad...");
			event.preventDefault();
			$.ajax({
				url: '',
				type: 'POST',
				dataType: 'json',
				data: {
					usuario: usuario,
					pass: pass
				},
				success: function(data)
				{
					if (data.success)
					{
						document.location.href = data.redirect;
					}
					else
					{
						$("#verificando").hide();
						$("#error_msg_usuario").show();
						$("#error_msg_usuario").text("");
						$("#error_msg_usuario").append(data.message);
					}
				},
				error: function()
				{
				
					$("#verificando").hide();
					$("#success_msg_usuario").show();
					$("#Success_msg_usuario").text("");
					$("#success_msg_usuario").append('Redireccionando');
					location.href = "";
					
				}
			});
		}
	});
</script>
</body>
</html>