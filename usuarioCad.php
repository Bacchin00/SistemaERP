<?php
	require_once("verifica.php");

	$data=$_REQUEST;

	include_once("config.php");

	$conexao = db_connect();

	extract($data);
	
	if( $op != "I" )
	{
		$sql = "select usuCodigo, usuMail, usuSenha, usuNome, usuDatecad, usuStatus, usutipo
				from usuario
				where usuCodigo = :codigo ";

		$comando = $conexao->prepare($sql);

		$comando->bindParam(':codigo', $codigo);

		$comando->execute();

		$dados = $comando->fetch(PDO::FETCH_OBJ);
	}
?>

<?php include_once("cabec.php"); ?>

	<p>&nbsp;</p>

	<h2 align="center"><?php echo $lng['dadosusuario']; ?></h2>

	
	<form class="form-inline row justify-content-center col-lg-12" action="usuarioGrava.php" method="post">
		<input type="hidden" name="edtCodigo" value="<?php if( $op != "I" ) { echo $dados->usuCodigo; } else { echo "0"; } ?>" />
		<input type="hidden" name="op" value="<?php echo $op; ?>" />
		
		<div class="form-group col-sm-12 col-lg-10">
			<div class="control-label col-sm-11">
				<p class="help-block" align="right"><h11>*</h11> <?php echo $lng['campoObrigatorio']; ?> </p>
			</div>
		</div>
		
		<div class="form-group row my-2">
			<label for="edtMail" class="col-sm-2 col-form-label text-end"><?php echo $lng['email']; ?>: &nbsp;<h11>*</h11>&nbsp;</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="edtMail" name="edtMail" placeholder="<?php echo $lng['emailDoUsuario']; ?>" value="<?php if( $op != "I" ) { echo $dados->usumail; } ?>" <?php if( $op == "C" ) echo "readonly" ?>>
			</div>
	  	</div>	
		
		<div class="form-group row my-2">
			<label for="edtSenha" class="col-sm-2 col-form-label text-end"><?php echo $lng['senha']; ?> &nbsp;<h11>*</h11>&nbsp;</label>
			<div class="col-sm-7">
				<input type="password" class="form-control" id="edtSenha" name="edtSenha" placeholder="<?php echo $lng['senhaDoUsuario']; ?>" value="<?php if( $op != "I" ) { echo '********'; } ?>" <?php if( $op != "I" ) echo "readonly" ?>>
			</div>
	  	</div>
		
		<div class="form-group row my-2">
			<label for="edtNome" class="col-sm-2 col-form-label text-end"><?php echo $lng['nomeusuario']; ?> &nbsp;<h11>*</h11>&nbsp;</label>
			<div class="col-sm-7">
				<input type="text" class="form-control" id="edtNome" name="edtNome" placeholder="<?php echo $lng['nomeusuario']; ?>" value="<?php if( $op != "I" ) { echo $dados->usunome; } ?>" <?php if( $op == "C" ) echo "readonly" ?>>
			</div>
	  	</div>
		
		<div class="form-group row my-2">
			<label class="col-sm-2 col-form-label text-end"><?php echo $lng['datacad']; ?> &nbsp;</label>
			<label class="col-sm-7 col-form-label text-start"><?php if( $op != "I" ) { echo $dados->usudatecad; } else { echo '---'; } ?></label>
	  	</div>
		
		<div class="form-group row my-2">
			<label for="edtStatus" class="col-sm-2 col-form-label text-end"><?php echo $lng['status']; ?> &nbsp;<h11>*</h11>&nbsp;</label>
			<div class="col-sm-7">
				<select required="" id="edtStatus" name="edtStatus" class="form-control col-md-8" <?php if( $op == "C" ) echo "disabled" ?> >
					<option value="A" <?php if( $op != "I" && $dados->usustatus == "A" ) { echo "selected"; } ?>><?php echo $lng['ativo']; ?></option>
					<option value="I" <?php if( $op != "I" && $dados->usustatus == "I" ) { echo "selected"; } ?>><?php echo $lng['inativo']; ?></option>
				</select>
			</div>
	  	</div>
		
		<div class="form-group row my-2">
			<label for="edtTipo" class="col-sm-2 col-form-label text-end"><?php echo $lng['tipo']; ?> &nbsp;<h11>*</h11>&nbsp;</label>
			<div class="col-sm-7">
				<select required="" id="edtTipo" name="edtTipo" class="form-control col-md-8" <?php if( $op == "C" ) echo "disabled" ?> >
					<option value="M" <?php if( $op != "I" && $dados->usutipo == "M" ) { echo "selected"; } ?>><?php echo $lng['master']; ?></option>
					<option value="A" <?php if( $op != "I" && $dados->usutipo == "A" ) { echo "selected"; } ?>><?php echo $lng['admin']; ?></option>
					<option value="O" <?php if( $op != "I" && $dados->usutipo == "O" ) { echo "selected"; } ?>><?php echo $lng['operador']; ?></option>
				</select>
			</div>
	  	</div>
		
		<div class="col-md-12 my-3" >
			<div class="form-group col-md-11">
				<label class="col-md-6">&nbsp;</label>
				<button type="button" class="btn btn-dark col-md-2" onClick="window.open('usuario.php', '_self')"><?php echo $lng['sair']; ?></button>
				<label class="col-md-1">&nbsp;</label>
				<button type="submit" class="btn btn-dark col-md-2" <?php if( $op == "C" ) echo "disabled" ?> ><?php echo $lng['salvar']; ?></button>
			</div>
		</div>
	</form>

	<p>&nbsp;</p>

	

<?php include_once("rodape.php"); ?>