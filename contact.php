
<?php

require_once(__DIR__.'/vendor/autoload.php');

use \Mailjet\Resources;

    define ('API_USER', 'f813effa912396495a620dea331afa99');
    define ('API_LOGIN', '9b38541dbe8959342178f6a17359f699');

    $mj = new \Mailjet\Client(API_USER, API_LOGIN,true,['version' => 'v3.1']);

    if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])) {

        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);

        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $body = [
                'Messages' => [
                    [
                        'From' => [
                            'Email' => "ghislain.knittel@gmail.com",
                            'Name' => "Ghislain"
                        ],
                        'To' => [
                            [
                                'Email' => "ghislain.knittel@gmail.com",
                                'Name' => "Ghislain1"
                            ]
                        ],
                        'Subject' => "Demande de renseignement",
                        'TextPart' => "$email, $message",
                    ]
                ]
            ];
            $response = $mj->post(Resources::$Email, ['body' => $body]);
            $response->success();
            echo "Email envoyé avec succes";
        }else {
            echo "Email non valide";
        }

    }else {
        header('Location:index.php');
        die();
    }
    
