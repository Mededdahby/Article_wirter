<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <title>Users</title>
    <link rel="stylesheet" href="public/css/i_style.css">
</head>
<body>
    <?php
        session_start();
        if(!isset($_SESSION['user'])){
            echo "<script>location.href = \"login.php\"</script>";
        }
        $fp=fopen("users.json","a+");
        $content = fread($fp,filesize("users.json"));
        $decoded=json_decode($content);
    ?>
        <nav>
        <span><div class="user"> Username :<?php echo $_SESSION['user']?></div></span>
        <a href="login.php?logout=1"><i class="fa-solid fa-circle-xmark">Logout</i></a>
        </nav>

        <div class="container">
            <?php
                foreach ($decoded as $obj) {
                    echo "
                    <div class=\"item\">
                    <a href=\"user.php?id={$obj->id}\"><img src=\"public/images/{$obj->id}.png\"></a>
                        <div>Name : {$obj->username}</div>
                        <div>Score : {$obj->score}</div>
                        <div class=\"del\"> <a href=\"usersList.php?id={$obj->id}\"><i class=\"fa-solid fa-trash\"></i></a> </div>
                    </div>
                    ";
                }

                if(isset($_GET['id'])){
                    // $art=fopen("articles.json","a+");
                    // $art_cont = fread($art,filesize("articles.json"));
                    // $at_decoded=json_decode($art_cont);
                    $i = 0;
                foreach($decoded as $us){
                if($us->id==$_GET['id'] ){
                array_splice($decoded,$i,1);
                }
                $i++;
                }
                $encoded = json_encode($decoded);
                $fp=fopen("users.json","w+");
                fwrite($fp,$encoded);
                fclose($fp);
                echo "<script>location.href = \"usersList.php\"</script>";
            }
            ?>
        </div>
</body>
</html>