<?php
/**
 * Created by PhpStorm.
 * User: drawnowl
 * Date: 17/08/2017
 * Time: 15:25
 */

if(isset($_POST['submit'])) {
    echo $_POST['login'] . ' ' . $_POST['password'];
}