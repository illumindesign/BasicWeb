<?php
/** BasicWeb - A procedural framework for basic websites
 * Bobby @ IlluminDesign made this
 *
 * post.php - POST Processor
 *
 * February 2018
 */
if (!defined('aI')) { header('Location: /', true, 301); exit; }

//verify_origin();

if (isset($_POST) && sizeof($_POST) > 0)
{
    $post = array();
    $act = $_SERVER['REQUEST_URI'];
    foreach ($_POST as $f => $v)  $post[$f] = $v;

    # LOG IN TO YOUR ACCOUNT =====--------------------------------------------------------------------------------------
    if ($act == '/login')
    {
        $sql = $pdo_connection->prepare("SELECT
            `id`,
            `cname`,
            `type`,
            `fname`,
            `lname`,
            `email`,
            COUNT(*) AS `exists`
        FROM `users` WHERE `email` = :email AND `password` = :pass LIMIT 1");
        $sql->execute(array(
            ':email' => $post['email'],
            ':pass'  => password_encode($post['password'])
        ));
        $user = $sql->fetchObject();

        if ($user->exists == 1) {
            # Set SESSION Vars =====-----
            $_SESSION[sPre.'_user']['loggedin'] = true;
            $_SESSION[sPre.'_user']['id']       = $user->id;
            $_SESSION[sPre.'_user']['type']     = $user->type;
            if ($user->cname != '' && ($user->type == 'groupscoop' || $user->type == 'grouppoop'))
                $_SESSION[sPre.'_user']['name']     = $user->cname;
            else
                $_SESSION[sPre.'_user']['name']     = $user->fname.' '.$user->lname;
            $_SESSION[sPre.'_user']['email']    = $user->email;

            header("Location: /my-account");
            exit;
        } else {
            set_error('Please check your login credentials.');
        }
    }

    # RECOVER YOUR PASSWORD =====---------------------------------------------------------------------------------------
    elseif ($act == '/recover')
    {
        set_error('I have not done this page yet...');
    }

    # SIGN UP TO BECOME A POOPER SCOOPER =====--------------------------------------------------------------------------
    elseif ($act == '/be-a-scooper')
    {
        if ($post['tos'] != 'agreed') {
            set_error('You cannot create an account without agreeing to the terms.');
        } elseif ($post['pass'] != $post['passC']) {
            set_error('The passwords you specified do not match');
        } else {
            $sql = $pdo_connection->prepare("SELECT COUNT(*) AS `exists` FROM `users` WHERE `email`=? LIMIT 1");
            $sql->execute(array($post['email']));
            $result = $sql->fetchObject();

            if ($result->exists == 1) {
                set_error('There is already an account registered under '.$post['email']);
            } else {
                try {
                    $new_scooper = $pdo_connection->prepare("INSERT INTO  `users` (
                        `type`,
                        `cname`,
                        `fname`,
                        `lname`,
                        `email`,
                        `password`,
                        `created_at`
                    ) VALUES (
                        :type,
                        :cname,
                        :fname,
                        :lname,
                        :email,
                        :password,
                        NOW()
                    );");

                    $new_scooper->execute(array(
                        ':type'     => $post['scooperType'],
                        ':cname'    => $post['cname'],
                        ':fname'    => $post['fname'],
                        ':lname'    => $post['lname'],
                        ':email'    => $post['email'],
                        ':password' => password_encode($post['pass']),
                    ));

                    $_SESSION[sPre.'_user']['loggedin'] = true;
                    $_SESSION[sPre.'_user']['id']       = $pdo_connection->lastInsertId();
                    $_SESSION[sPre.'_user']['type']     = $post['scooperType'];
                    if ($post['scooperType'] == 'groupscoop')
                        $_SESSION[sPre.'_user']['name']     = $post['cname'];
                    else
                        $_SESSION[sPre.'_user']['name']     = $post['fname'].' '.$post['lname'];
                    $_SESSION[sPre.'_user']['email']    = $post['email'];
                    //$_SESSION[sPre.'_user']             = '';

                    header("Location: /my-account");
                    exit;

                } catch (PDOException $E) {
                    set_error('Internal error: '.$E->getMessage());
                }
            }
        }
    }

    # SIGN UP TO BECOME A PATRON =====----------------------------------------------------------------------------------
    elseif ($act == '/signup')
    {
        if ($post['tos'] != 'agreed') {
            set_error('You cannot create an account without agreeing to the terms.');
        } elseif ($post['pass'] != $post['passC']) {
            set_error('The passwords you specified do not match');
        } else {
            $sql = $pdo_connection->prepare("SELECT COUNT(*) AS `exists` FROM `users` WHERE `email`=? LIMIT 1");
            $sql->execute(array($post['email']));
            $result = $sql->fetchObject();

            if ($result->exists == 1) {
                set_error('There is already an account registered under '.$post['email']);
            } else {
                try {
                    $new_scooper = $pdo_connection->prepare("INSERT INTO  `users` (
                        `type`,
                        `cname`,
                        `fname`,
                        `lname`,
                        `email`,
                        `password`,
                        `created_at`
                    ) VALUES (
                        :type,
                        :cname,
                        :fname,
                        :lname,
                        :email,
                        :password,
                        NOW()
                    );");

                    $new_scooper->execute(array(
                        ':type'     => $post['pooperType'],
                        ':cname'    => $post['cname'],
                        ':fname'    => $post['fname'],
                        ':lname'    => $post['lname'],
                        ':email'    => $post['email'],
                        ':password' => password_encode($post['pass']),
                    ));

                    $_SESSION[sPre.'_user']['loggedin'] = true;
                    $_SESSION[sPre.'_user']['id']       = $pdo_connection->lastInsertId();
                    $_SESSION[sPre.'_user']['type']     = $post['pooperType'];
                    if ($post['pooperType'] == 'grouppoop')
                        $_SESSION[sPre.'_user']['name']     = $post['cname'];
                    else
                        $_SESSION[sPre.'_user']['name']     = $post['fname'].' '.$post['lname'];
                    $_SESSION[sPre.'_user']['email']    = $post['email'];
                    //$_SESSION[sPre.'_user']             = '';

                    header("Location: /my-account");
                    exit;

                } catch (PDOException $E) {
                    set_error('Internal error: '.$E->getMessage());
                }
            }
        }
    }
    else
    {
        set_error('I havent gotten to this form yet..');
    }
}