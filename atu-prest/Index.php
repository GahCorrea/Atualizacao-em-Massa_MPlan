<?php
session_start();
ob_start();

include_once "Conexao.php";
include_once "Funcoes.php";
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./CSS/Index.css">
	<link rel="shortcut icon" href="./Image/favicon.ico" type="image/x-icon">
	<title>Login Amhemed</title>
</head>

<body>

	<?php
	if (!validaToken()) {
		$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

		if (!empty($dados['sendLogin'])) {
			$query_user = "select usucod, usunome, status, email from tblusu where usunome = :usunome limit 1";

			$result_user = $dbcon->prepare($query_user);

			$result_user->bindParam(':usunome', $dados['usunome']);

			$result_user->execute();

			if (($result_user) and ($result_user->rowCount() != 0)) {
				$row_user = $result_user->fetch(PDO::FETCH_ASSOC);

				$crp = hash('sha1', $dados['senha']);

				if ($crp == $row_user['email']) {
					$header = [
						'alg' => 'HS256',
						'typ' => 'JWT'
					];

					$header = json_encode($header);

					$header = base64_encode($header);

					$duracao = time() + (12 * 60 * 60);

					$payload = [
						'exp' => $duracao,
						'id' => $row_user['usucod'],
						'nome' => $row_user['usunome'],
						'status' => $row_user['status']
					];

					$payload = json_encode($payload);

					$payload = base64_encode($payload);

					$key = "DGBU85S46H9M5W4X6OD7";

					$signature = hash_hmac('sha256', "$header.$payload", $key, true);

					$signature = base64_encode($signature);

					setcookie('token', "$header.$payload.$signature", (time() + (12 * 60 * 60)));

					header("Location: Home.php");
				} else {
					$_SESSION['msg'] = "<h1 style='color: #f00;'> ERRO: Usuário ou Senha Inválido(a)!</h1>";
				}
			} else {
				$_SESSION['msg'] = "<h1 style='color: #f00;'> ERRO: Usuário ou Senha Inválido(a)!</h1>";
			}
		}

		if (isset($_SESSION['msg'])) {
			echo $_SESSION['msg'];
			unset($_SESSIO['msg']);
		}
	} else {
		header("Location: Home.php");
	}

	?>

	<div class="container">
		<div class="login">
			<img class="logo" src="./Image/logo.png" alt="Logo">
			<h1>Login</h1>
			<form method="POST" action="">

				<?php
				$usunome = "";
				if (isset($dados['usunome'])) {
					$usunome = $dados['usunome'];
				}
				?>
				<label>Usuário: </label>
				<input type="text" name="usunome" placeholder="Digite o usuário" value="<?php echo $usunome; ?>"><br><br>

				<?php
				$senha = "";
				if (isset($dados['senha'])) {
					$senha = $dados['senha'];
				}
				?>
				<label>Senha: </label>
				<input type="password" name="senha" placeholder="Digite a senha" value="<?php echo $senha; ?>"><br><br>

				<input type="submit" name="sendLogin" value="Acessar"><br><br>

			</form>
		</div>
	</div>
</body>

</html>