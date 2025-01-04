<?php

use app\classes\TwigGlobal;

TwigGlobal::set('logged_in', $_SESSION['is_logged_in'] ?? ''); //se existe guarda ela senão vai guardar uma string vazia
TwigGlobal::set('user', $_SESSION['user_logged_data'] ?? '');