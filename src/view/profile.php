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

?>


    <button type="button" class="exit" onclick="window.location.href='<?= ROOT ?>/src/controller/logout.php'">Finalizar sessão</button>

    <form action="<?= ROOT ?>/src/controller/update_profile.php" method="post" onsubmit="return callUpdate()" enctype="multipart/form-data" id="profile-form">
        <!-- Tabela para organizar o conteúdo -->
        <table>
            <!-- <tr> representa uma linha da tabela -->
            <tr> 
                <!-- <td> representa uma célula da linha (coluna) -->
                <td colspan=2><h1>Bem vindo(a) <?= $u->getUser() ?></h1></td> 
                <td></td>
                
                <td>
                    <img src="<?= ($u->getPhoto()==null) ? ASSETS."/img/profile/user.png" : $u->getPhoto() ?>" alt="Imagem do perfil" width="100">
                    <br>
                    <input type="file" name="photo" id="photo">
                </td>
            </tr>
            <!-- Linha para subtítulo -->
            <tr>
                <td colspan=4>
                    <h3>Dados pessoais</h3>
                    <hr>
                </td>
            </tr>
            <!-- ///////////////////// -->
            <tr>
                <td>
                    <label for="user">Nome de usuário</label>
                    <br>
                    <input type="text" name="user" id="user" value="<?= $u->getUser() ?>">
                </td>
                <td>
                    <label for="birth">Data de nascimento</label>
                    <br>
                    <input type="date" name="birth" id="birth" value="<?= $u->getBirth() ?>">
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <label for="first-name">Nome</label>
                    <br>
                    <input type="text" name="first-name" id="first-name" value="<?= $u->getFirstName() ?>">
                </td>
                <td>
                    <label for="last-name">Sobrenome</label>
                    <br>
                    <input type="text" name="last-name" id="last-name" value="<?= $u->getLastName() ?>">
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan=4>
                    <label for="desc">Descrição (bio)</label>
                    <br>
                    <textarea name="desc" id="desc" cols="100" rows="3" placeholder="Fale sobre você" maxlength="255"><?= $u->getDesc() ?></textarea>
                </td>
            </tr>
            <!-- Linha para subtítulo -->
            <tr>
                <td colspan=4>
                    <h3>Endereço</h3>
                    <hr>
                </td>
            </tr>
            <!-- ///////////////////// -->
            <tr>
                <td>
                    <label for="cep">Cep</label>
                    <br>
                    <input type="number" name="cep" id="cep" value="<?= $u->getCep() ?>">
                </td>
                <td>
                    <label for="address">Endereço</label>
                    <br>
                    <input type="text" name="address" id="address" value="<?= $u->getAddress() ?>">
                </td>
                <td>
                    <label for="number">Número</label>
                    <br>
                    <input type="number" name="number" id="number" value="<?= $u->getNumber() ?>">
                </td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <label for="complement">Complemento</label>
                    <br>
                    <input type="text" name="complement" id="complement" value="<?= $u->getComplement() ?>">
                </td>
                <td>
                    <label for="neighborhood">Bairro</label>
                    <br>
                    <input type="text" name="neighborhood" id="neighborhood" value="<?= $u->getNeighborhood() ?>">
                </td>
                <td>
                    <label for="city">Cidade</label>
                    <br>
                    <input type="text" name="city" id="city" value="<?= $u->getCity() ?>">
                </td>
                <td>
                    <label for="state">Estado</label>
                    <br>

                    <?php
                    //Lançando dado do estado para variável
                    $uf = $u->getState();
                    ?>

                    <select id="state" name="state">

                    <?=
                    //Verificando se existe dados salvos no campo
                    //estado. Caso seja nulo, aparecerá "Selecione"
                        ($uf == null)
                        ? "<option value=''>Selecione</option>"
                        : "<option value='$uf'>$uf</option>"
                    ?>

                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
                        <option value="EX">Estrangeiro</option>
                    </select>
                </td>
            </tr>
            <!-- Subtítulo -->
            <tr>
                <td colspan=4>
                    <h3>Sexo</h3>
                    <hr>
                </td>
            </tr>
            <!-- ///////// -->
            <tr>
                <td>
                    <input type="radio" name="sex" id="male" value="male" <?= ($u->getSex()=="male") ? "checked" : "" ?>>
                    <label for="male">Masculino</label>
                </td>
                <td>
                    <input type="radio" name="sex" id="female" value="female" <?= ($u->getSex()=="female") ? "checked" : "" ?>>
                    <label for="female">Feminino</label>
                </td>
                <td></td>
                <td></td>
            </tr>
            <!-- Subtítulo -->
            <tr>
                <td colspan=4>
                    <h3>Contatos</h3>
                    <hr>
                </td>
            </tr>
            <!-- ///////// -->
            <tr>
                <td>
                    <label for="phone">Telefone</label>
                    <br>
                    <input type="tel" name="phone" id="phone" pattern="[0-9]{2}-[0-9]{9}" value="<?= $u->getPhone() ?>">
                </td>
                <td>
                    <label for="email">Email</label>
                    <br>
                    <input type="email" name="email" id="email" value="<?= $u->getEmail() ?>">
                </td>
                <td colspan=2>
                    <input type="checkbox" name="notify" id="notify" <?= ($u->getNotify()==1) ? "checked" : "" ?>>
                    <label for="notify">Desejo receber notificações</label>
                </td>
            </tr>
            <!-- Linha para subtítulo -->
            <tr>
                <td colspan=4>
                    <h3>Senha</h3>
                    <hr>
                </td>
            </tr>
            <!-- ///////////////////// -->
            <tr>
                <td>
                    <label for="new-pass">Nova senha</label>
                    <br>
                    <input type="password" name="new-pass" id="new-pass" class="show-pass">
                </td>
                <td>
                    <label for="confirm-pass">Cofirmação de senha</label>
                    <br>
                    <input type="password" name="confirm-pass" id="confirm-pass" class="show-pass">
                </td>
                <td id="show-pass"></td>
            </tr>
            <!-- Botões do formulário -->
            <tr>
                <td colspan=4>
                    <br>
                   <input type="submit" value="Salvar" name="submit">
                   <input type="reset" value="Limpar">
                </td>
            </tr>
            <!-- ///////////////////// -->
        </table>
    </form>

    <script>

    function callUpdate() {
        return confirm("Deseja atualizar os dados?");
    }
</script>
<?php
//Importação do rodapé
include $dir."/src/controller/footer.php";
