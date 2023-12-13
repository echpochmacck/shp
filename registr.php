<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="" method="POST" class="registr">
    введите имя <br>
    <input name="name" > 
    <br>
        введите логин <br>
    <input name="login" >  
      <br>
      введите пароль
      <br>
      <input name="password" >  
      <br>
      введите email
      <br>
      <input name="email"> <br>
      подтвердите  пароль
      <br>
      <input name="password2">
      <br>
      <input type="submit">
    </form>
    <?php
    // $str=file_get_contents('tovars.json');
    // $ads=json_decode($str,1);
    $userr=file_get_contents('users.json');
    $Arruserr=json_decode($userr,1);
    // $str = json_encode($ads);
    // file_put_contents('tovars.json', $str);
    if(!empty($_POST)){
    if(isset($_POST['password']) && isset($_POST['password2'])){
         if($_POST['password']==$_POST['password2']){
        echo "регистрация успешна";
        ?>
        <style>
            .registr{
                display: none;
            }
        </style>
        <br>
        <a href="shop.php"> добро пожаловать в  магазинг товаров </a>
        <?php
    }else{
        echo "пароль повторен не верно ";
    }
}
    // var_dump($Arruserr);
    $Arruserr[]=['name'=>$_POST['name'],"login"=>$_POST['login'],"password"=>$_POST['password'],"email"=>$_POST['email'],"role"=>'user'];
    $userr=json_encode($Arruserr);
    file_put_contents('users.json',$userr);
    }
    

    ?>


</body>
</html>