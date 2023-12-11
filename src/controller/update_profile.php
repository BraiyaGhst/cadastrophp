<?php
$a = explode("\\", __DIR__);
$dir = "/{$a[1]}/{$a[2]}/{$a[3]}";

//Importação do cabeçalho
include $dir."/src/controller/header.php";

//Importação dos arquivos que contém as classes User e Database
include MODEL . "/user.php";
include MODEL . "/database.php";

//Importando arquivo que verifica se a sessão está "desligada".
//Caso esteja, redireciona o usuário para a página de login
include CONTROLLER . "/session_off.php";

session_reset();

//Lançando dados da $_SESSION para uma variável
//simples, apenas para facilitar nossa vida
$u = $_SESSION["user"];
//var_dump( $u );

//Analisar se realmente é um arquivo de imagem ()
if($_FILES["photo"]["name"] != "") {
    //Recebimento da foto de perfil (arquivo)
    $target_dir = $dir."/assets/img/profile/";
    $file_name = basename($_FILES["photo"]["name"]);
    $target_file = $target_dir . $file_name;
    $target_database = ROOT."/assets/img/profile/".$file_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if($check !== false) {
        echo "Arquivo enviado é uma imagem - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "Arquivo enviado NÃO É uma imagem.";
        $uploadOk = 0;
    }

    //Verifica se o arquivo já existe
    if (file_exists($target_file)) {
        echo "Desculpe, o arquivo já existe.";
        $uploadOk = 0;
    }

    //Verifica tamanho do arquivo
    if ($_FILES["photo"]["size"] > 2100000) {
        echo "Arquivo muito grande! (Limite 2MB).";
        $uploadOk = 0;
    }

    // Permitir apenas alguns formatos
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Desculpe, somente aceitamos arquivos JPG, JPEG, PNG & GIF.";
    $uploadOk = 0;
    } 

    //Se cair em algum daqueles filtros, não realiza upload
    if ($uploadOk == 0) {
        echo "Desculpe, seu arquivo não foi salvo.";
    //Senão, realiza.
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            echo "O arquivo ". htmlspecialchars( basename( $_FILES["photo"]["name"])). " foi salvo com sucesso!";
        } else {
            echo "Desculpe, houve algum erro no download. Tente novamente mais tarde.";
        }
    }
} else {
    $target_database = null;
}

////////////////////////////////////////////////////////////////////
//Iniciando a query SQL
$query = "UPDATE users SET ";

//Recebendo os demais dados do formulário
//e compondo a query
if( !empty($_POST["user"]) ) {
    $query .= "user_name='{$_POST['user']}'";
} 

if( !empty($_POST["birth"]) ) {
    $query .= ",user_birth='{$_POST['birth']}'";
} 

if( !empty($_POST["first-name"]) ) {
    $query .= ",user_first_name='{$_POST["first-name"]}'";
} 

if( !empty($_POST["last-name"]) ) {
    $query .= ",user_last_name='{$_POST["last-name"]}'";
}

if( !empty($_POST["desc"]) ) {
    $query .= ",user_desc='{$_POST["desc"]}'";
}

if( !empty($_POST["cep"]) ) {
    $query .= ",user_cep='{$_POST["cep"]}'";
}

if( !empty($_POST["address"]) ) {
    $query .= ",user_address='{$_POST["address"]}'";
}

if( !empty($_POST["number"]) ) {
    $query .= ",user_number='{$_POST["number"]}'";
}

if( !empty($_POST["complement"]) ) {
    $query .= ",user_complement='{$_POST["complement"]}'";
}

if( !empty($_POST["neighborhood"]) ) {
    $query .= ",user_neighborhood='{$_POST["neighborhood"]}'";
}

if( !empty($_POST["city"]) ) {
    $query .= ",user_city='{$_POST["city"]}'";
}

if( !empty($_POST["state"]) ) {
    $query .= ",user_state='{$_POST["state"]}'";
}

if( !empty($_POST["sex"]) ) {
    $query .= ",user_sex='{$_POST["sex"]}'";
}

if( !empty($_POST["phone"]) ) {
    $query .= ",user_phone='{$_POST["phone"]}'";
}

if( !empty($_POST["email"]) ) {
    $query .= ",user_email='{$_POST["email"]}'";
}

if( !empty($_POST["notify"]) ) {
    $query .= ",user_notify='{$_POST["notify"]}'";
}

if( !empty($_POST["new-pass"]) ) {
    $query .= ",user_new_pass='{$_POST["sex"]}'";
}

if( $_FILES["photo"]["name"] != "" ) {
    $query .= ",user_photo='$target_database'";
}

    //Pegando o cod do usuário
    $cod = $u->getCod();

    //Opções adicionais da query
    $opt = " WHERE user_cod = '$cod'";
    //var_dump($query . $opt);

    //Instanciando a classe Database
    $db = new Database();

    //Fazendo uso do método update da classe
    $db->update($query . $opt);

    echo "<p>Atualizando dados...</p>";

    //Atualizando dados na sessão
    $_SESSION["user"]->updateObject($cod);

    //var_dump( $_SESSION["user"] );

    //Redirecionando para a página de perfil
    header("Refresh: 2; url=".ROOT);

//Importando o rodapé
include $dir."/src/controller/footer.php";
