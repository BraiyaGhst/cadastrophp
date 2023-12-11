<?php

//Verificando se existe sessão
if( isset($_SESSION["user"]) ) {
    header("Refresh: 0; url = ".VIEW."/profile.php");
}