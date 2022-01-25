<?php

if (!empty($_POST)) {

    if (isset($_POST['email']) && isset($_POST['password'])) {

        if ($main->isAuth()) {
            exit( json_encode(array ("result" => false, "text" => "Сначала стоит выйти из аккаунта.") ) );
        } else {
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {
                $errors[] = array("field" => "email", "text" => "Email имеет некорректный формат.");
            } else {
                if (!$main->findUserByEmail($_POST['email'])) {
                    $errors[] = array("field" => "email", "text" => "Такой аккаунт не найден");
                } else {
                    if ($main->authorize($_POST['email'], $_POST['password'])) {
                        exit( json_encode( array("result" => true, "url" => "/sites/") ) );
                    } else {
                        $errors[] = array("field" => "email", "text" => "Такой аккаунт не найден.");
                    }
                }
            }
            if (count($errors) > 0) {
                exit( json_encode( array("result" => false, "errors" => $errors) ) );
            }
        }

    } elseif (isset($_POST['email']) && isset($_POST['remind'])) {

        if ($main->isAuth()) {
            exit( json_encode(array ("result" => false, "text" => "Сначала стоит выйти из аккаунта.") ) );
        } else {
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {
                $errors[] = array("field" => "email", "text" => "Email имеет некорректный формат.");
            } else {
                if (!$main->findUserByEmail($_POST['email'])) {
                    $errors[] = array("field" => "email", "text" => "Такой аккаунт не найден");
                } else {
                    if ($main->sendNewPass($_POST['email'])) {
                        exit( json_encode( array("result" => true, "url" => "/remind/?sended=true") ) );
                    } else {
                        $errors[] = array("field" => "email", "text" => "Такой аккаунт не найден.");

                    }
                }
            }
            if (count($errors) > 0) {
                exit( json_encode( array("result" => false, "errors" => $errors) ) );
            }
        }

    }

}

?>