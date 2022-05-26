<?php 
session_start();
ob_start();
include_once './conexao.php'; 
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Login - ACS Log</title>
  </head>
  <body>
   
  <div class="container">
        <h1 class="text-center mt-5">Login</h1>
        <?php
          // echo password_hash(654321, PASSWORD_DEFAULT);
        ?>
        <?php 
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            // var_dump($dados);

            if(!empty($dados['SendLogin'])){
              // var_dump($dados);
              $query_usuario =  "SELECT id, usuario, senha_usuario 
                FROM	users
                WHERE usuario = :usuario  
                LIMIT 1";
                // o :usuario substitui o comando '".$dados['usuario']."' 
                $result_usuario = $conn -> prepare($query_usuario);
                $result_usuario->bindParam(':usuario', $dados['usuario'], PDO::PARAM_STR);
                $result_usuario->execute();

                if(($result_usuario) AND ($result_usuario->rowCount() != 0)){
                    $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
                    // var_dump($row_usuario);
                    if(password_verify($dados['senha_usuario'], $row_usuario['senha_usuario'])){
                      $_SESSION['id'] = $row_usuario['id'];
                      $_SESSION['usuario'] = $row_usuario['usuario'];
                      header("Location: dashboard.php");
                    } else {
                      $_SESSION['msg'] = "<p style='color: red;'>Erro, usuário ou senha inválida</p>";
                    }
                } else {
                  $_SESSION['msg'] = "<p style='color: red;'>Erro, usuário ou senha inválida</p>";
                }               

            }

            if(isset($_SESSION['msg'])){
              echo $_SESSION['msg'];
              unset($_SESSION['msg']);

            }
            
        ?>
        <form class="form-group" method="POST" action="">
            <label for="">Usuário</label>
            <input class="form-control" type="text" name="usuario" value="<?php if(isset($dados['usuario']))
            {echo $dados['usuario']; }?>" placeholder="Digite o usuário">

            <label for="">Senha</label>
            <input class="form-control" type="password" name="senha_usuario" value="<?php if(isset($dados['senha_usuario']))
            {echo $dados['senha_usuario']; }?>" placeholder="Digite a senha">

            <input class="btn btn-primary mt-3" type="submit" value="Acessar" name="SendLogin">
        </form>
    </div>



    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>
