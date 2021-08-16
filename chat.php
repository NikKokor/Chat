<html lang="EN">
<head>
    <meta charset="UTF-8">
    <title>Chat</title>
</head>
<body>
<?php

$login = $_GET['login'];
$password = $_GET['password'];
$text = $_GET['text'];

$data = json_decode(file_get_contents('Data.json'));
$num_user = 0;

for ($i = 0; $i < sizeof($data->usersData); $i++) {
    if($data->usersData[$i]->login === $login) {
        $num_user = $i;
        break;
    }
}

if(($data->usersData[$num_user]->login === $login) && ($data->usersData[$num_user]->password === $password))
    if ($text != null) {
        $date = date('Y-m-d H:i:s');
        $messenger = array('login' => $login, 'mess' => $text, 'date' => $date);
        array_push($data->messages, $messenger);
        file_put_contents('Data.json', json_encode($data));
    } else {
        echo "Нет текста сообщения"  . "<br>";
    }
else {
    echo "Неверный пароль или логин"  . "<br>";
}

$data = json_decode(file_get_contents("Data.json"));

for ($i = 0; $i < sizeof($data->messages); $i++) {
    echo "----------------------------" . "<br>";
    echo $data->messages[$i]->login . "<br>";
    echo $data->messages[$i]->mess . "<br>";
    echo $data->messages[$i]->date . "<br>";
}
?>
</body>
</html>