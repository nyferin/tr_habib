<?php

session_start();

if (isset($_SESSION["s_role"])) {
    header("Location: ../Controller/controller-session.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <form action="../Controller/controller-login.php" method="post">
        <table>
            <tr>
                <label for="">
                    <td>
                        Nomor Induk
                    </td>
                    <td>
                        <input type="text" name="txtni" id="" required>
                    </td>
                </label>
            </tr>
            <tr>
                <label for="">
                    <td>
                        Password
                    </td>
                    <td>
                        <input type="password" name="txtpassword" id="" required>
                    </td>
                </label>
            </tr>
            <?php
            if (isset($_SESSION["s_user"]) and $_SESSION["s_user"] == "invalid") {
                ?>
                <tr>
                    <td></td>
                    <td>
                        <i style="color:red;">username atau password anda salah</i>
                    </td>
                </tr>
                <?php
                session_unset();
            }
            ?>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Login">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>