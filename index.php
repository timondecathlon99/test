<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 13.04.2018
 * Time: 10:25
 */
<? include_once(__DIR__ . '/global_pass.php');?>
<? include_once(__DIR__ . '/classes/autoload.php');?>
<!DOCTYPE html>
<head>
    <title>Тестовый проект</title>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
    <meta name='description' content=''>
    <meta name='keywords' content=''>
    <link rel='icon' href='<?=$domain?>'>
    <link rel="stylesheet" type="text/css" href="https://ironlinks.ru/project/css/style.css">
</head>
<body>
<div class='container'>
    <header class='header'>
    </header>
    <main class='inner_container'>
        <div class='wall box'>
            <div class='send_form box'>
                <form  action='sender.php' method='POST'>
                    <input name='title' type='text' placeholder='Представьтесь'></input>
                    <input name='email' type='email' placeholder='Ваш E-mail'></input>
                    <textarea name='description' placeholder='Введите сообщение...'></textarea><br>
                    <button>Отправить</button>
                </form>
            </div>
            <div class='comments box'>

                <?
                $all_items_sql = $pdo->prepare("SELECT * FROM comments ORDER BY publ_time DESC");
                $all_items_sql->execute();
                $items_num = $all_items_sql->rowCount();
                $page_amount =  ceil($items_num/3);
                if(isset($_GET['page'])){
                    $page_num = $_GET['page'];
                    $from_num = ($_GET['page']-1)*3;
                }else{
                    $from_num = 0;
                    $page_num = 1;
                }

                //$items_sql = $pdo->prepare("SELECT * FROM comments ORDER BY publ_time DESC");
                $items_sql = $pdo->prepare("SELECT * FROM comments ORDER BY publ_time DESC LIMIT $from_num, 3");
                $items_sql->execute();
                if($items_sql->rowCount() > 0){
                    while($item = $items_sql->fetch()){
                        $comment = new Comment($item['id'],$pdo);
                        $author = new Member($comment->author(),$pdo)?>
                        <div class='comment box'>
                            <div class='comment_header'>
                                <div class='author_photo'>
                                    <img src='data:image/png;base64,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'/>
                                </div>
                                <div class='comment_details'>
                                    <div class='comment_author'>
                                        <?=$author->name()?>
                                    </div>
                                    <div class='comment_time'>
                                        <?=$comment->publ_time()?>
                                    </div>
                                </div>
                            </div>
                            <div class='comment_body box'>
                                <?=$comment->description()?>
                            </div>
                        </div>
                    <?}
                }
                ?>
            </div>
            <!--ПАГИНАЦИЯ-->
            <?
            if($items_num > 0){   ?>
                <div class='pagination box'>
                    <?if($page_num > 1) {?>
                        <div class='prev_page'>
                            <? if(isset($_GET['page'])){?>
                                <a href='<?=$domain?>?page=<?=$page_num - 1?>'>← Назад</a>
                            <? }?>
                        </div>
                    <? }?>
                    <div class='pages'>
                        <ul>
                            <?if($page_num == ''){$curr_page = 1;}else{$curr_page = $page_num;};
                            for($page_count = $curr_page - 2; $page_count <= $page_amount && $page_count < $curr_page + 3 ; $page_count++){
                                if($page_count >0 && $page_count <= $page_amount) {	?>
                                    <li class='<?=($curr_page == $page_count)? 'curr_page' : ''?>'><a href='<?=$domain?>?page=<?=$page_count?>'><?=$page_count?></a></li>
                                <?}
                            } ?>
                        </ul>
                    </div>
                    <? if($curr_page < $page_amount){  ?>
                        <div class='next_page'>
                            <a href='<?=$domain?>?page=<?=$page_num + 1?>'>Вперед →</a>
                        </div>
                    <? }?>
                </div>
            <? } ?>
            <!--ПАГИНАЦИЯ-->
        </div>
    </main>
    <footer class='footer'>
    </footer>
</div>
</body>
</html>