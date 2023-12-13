


<?php
// session_set_cookie_params(0);
session_start();
$_SESSION['avto']=0;
?>

<style>
    .tovform{
        display: none
    }
</style>
<?php
if(($_SESSION['avtor']) == true) {
    if(!empty($_GET['session'])){
        $_SESSION['avtor']=false;
        $_SESSION['role']='noth';
        $_SESSION['name']='пока отсутствует';
        $_GET['session']='';
       
    }
    if($_SESSION['role']=='admin'){
        ?>
        <style>
                    .auto{
                        display: none;
                         }
                   .link {
                        display: contents
                    }
                    .tovform{
                        display: contents;
                    }
                </style>
        <?php
    }elseif($_SESSION['role']=='user'){
        ?>
        <style>
                   .link22 {
                        display: contents
                    }
                </style>

<?php
    }
} else{
    ?>

    <style>
        .auto{
            display:contents
        }
    </style>
    <?php
}
?>


<?php

class Tovar {
    protected $name;
    protected $description;
    protected $category;
    protected $price;
    protected $imageUrl;
    protected $stock;
    protected $offer;
  
    public function __construct($name, $description, $category, $price, $imageUrl, $stock, $offer) {
      $this->name = $name;
      $this->description = $description;
      $this->category = $category;
      $this->price = $price;
      $this->imageUrl = $imageUrl;
      $this->stock = $stock;
      $this->offer = $offer;
     
}

function getCategory(){

    return $this->category;

}

public function printTovar(){

    echo '<div class="box">';
    echo $this->name;
    echo '<br>';

    echo 'Описание:'. $this->description;
    echo '<br>';

    echo 'Категория:'. $this->category;
    echo '<br>';

    echo 'цена: ' .$this->price;
    echo '<br>';

    echo " <br> <img src='" . $this->imageUrl . "' width='200px' height='200px'>";
    echo '<br>';

    if ($this->stock > 0){
        echo 'есть в наличи в количестве:' .$this->stock;
    } else {
        echo 'нет в наличии';
    }
    
    echo "</div>";
}
}


$str=file_get_contents('tovars.json');
$ads=json_decode($str,1);
$objAds=[];
if (isset($_GET['index'])) {
    unset($ads[$_GET['index']]);
    $ads = array_values($ads);
}



foreach($ads as $mads){
    $objAds[]= new Tovar ($mads['name'],$mads['description'],$mads['category'],$mads['price'],$mads['imageUrl'],$mads['stock'],$mads['offer']);


}

if(!empty($_POST['name'])){
    
        if (!empty($_POST['category2'])) {
            $category = $_POST['category2'];
        } else $category = $_POST['category'];

    $objAds[]= new Tovar($_POST['name'], $_POST['description'],$category,$_POST['price'], $_POST['imageUrl'],$_POST['stock'],$_POST['offer']);

    $ads[]=['name'=>$_POST['name'],'description'=>$_POST['description'],'category'=>$category,'price'=>$_POST['price'],'imageUrl'=>$_POST['imageUrl'],'stock'=>$_POST['stock'],'offer'=>$_POST['offer']];

 }



$objCat=[];
foreach($objAds as $adis){
    if( in_array($adis->getCategory(), $objCat)==false){
        $objCat[]=$adis->getCategory();
}
}




// подклчение юзера
$userr=file_get_contents('users.json');
$Arruserr=json_decode($userr,1);


?>
<!-- ФОРМА ДЛЯ АВТОРИЗАЦИИ -->

<?php
// var_dump($Arruserr);
echo "<br>";
if (!empty($_POST['login'])) {
    // $a='нет такого логина или пароля ';
    foreach($Arruserr as $elem){
        $b=0;
        $login=$elem['login'];
        $password=$elem['password'];
        $role=$elem['role'];
        $name=$elem['name'];
        if ($_POST['login'] == $login && $_POST['password'] == $password) { 
            $b+=1;
            $_SESSION['role']=$role;
            $_SESSION['avtor']=true;
            $_SESSION['name']=$name;
            echo "твоя роль $role и тебя зовут $name ";
            echo "<br>";
            ?>
           <style> .auto{
            display: none;
            }
            </style>
            <?php
            if($role=='admin'){
                ?>
                <style>
                    .auto{
                        display: none;
                         }
                   .link {
                        display: contents
                    }
                    .tovform{
                        display: contents;
                    }
                </style>
                <?php
                break;
            }
            
            if($role=='user'){
                ?>
                <style>
                   .link22 {
                        display: contents
                    }
                </style>
                <?php
            }
            
            break;
        } 
        if($b==0){
            ?>

            <style>
                a{
                    display: none;
                }
            </style>
            <?php
        }
    }
        
       

    }

?>
<div class="auto">
    Пожалуйста авторизируетесь <br>
    <form action="" method="POST">
        введите логин <br>
    <input name="login" >  
      <br>
      введите пароль
      <br>
      <input name="password">
      <br>
      <input type="submit">

    </form>
</div>



    <form action="<?=$_SERVER['SCRIPT_NAME']?>", method="post" class="tovform">
    Введите   имя товара <br>
    <input name="name" required> 
      <br>
    Введите описание  <br>
    <textarea name="description"  cols="30" rows="10"></textarea>
    <br>
    введите категорию <br>
    <select  name="category">
        
    <?php foreach ($objCat as $cat): ?>
        <option value="<?php echo $cat; ?>"><?php echo $cat; ?></option>
        <br>
    <?php endforeach; ?>
  
    </select>
    <br>
    <!-- введите категорию если ее нет 
    <br>
    <input type="text" name='category'> -->

    введите категорию если ее нет  <br>
            <input name="category2"></input> <br> <br>
    <br>
      введите цену 
      <br>
      <input name="price"required type='number'> 
      <br>
      введите адресс картинки  <br>
      <input name="imageUrl"required > 
      <br>
      введите кол-во в наличии   <br>
      <input name="stock" required type="number"> 
      <br>
      введите акции если есть    <br>
      <input name="offer"> 
      <br>
      <br>


    <input type="submit">
    </form>



     
<?php



// $str = json_encode($ads);
// file_put_contents('tovars.json', $str);





//     foreach($objCat as $cats){
//         foreach ($objAds as $key => $tovar){
//         if($cats==$tovar->getCategory()){
//          echo "<h1> $cats </h1>";
//          foreach ($objAds as $key => $tovar){
//         if ($tovar instanceof Tovar) {
//         if($cats==$tovar->getCategory()){ $tovar->printTovar();
//         echo '<br>';
//         echo '<a href="' . $_SERVER['SCRIPT_NAME'] . '?index=' . $key . '">Удалить объект </a> <br>';
//         echo '<br>';
//         echo '<br>';
//     }
// }
// }
//         }
     
//         }
//     }




// foreach ($objAds as $key => $tovar) {
//     foreach($objCat as $cats){
//         if($cats==$tovar->getCategory()){
//     if ($tovar instanceof Tovar) {
//         echo '<h1> $tovar </h1>';
//         $tovar->printTovar();
//         echo '<br>';
//         echo '<a href="' . $_SERVER['SCRIPT_NAME'] . '?index=' . $key . '">Удалить объект </a> <br>';
//         echo '<br>';
//         echo '<br>';
//     }
// }
//     }
// }
foreach($objCat as $cat){
    echo "<h2> $cat</h2>";
    foreach ($objAds as $key => $tovar){
        if ( $cat==$tovar->getCategory()) {
        $tovar->printTovar();
        echo '<br>';
        ?> <a href="<?=$_SERVER['SCRIPT_NAME']?>?index=<?=$key?>" class="link">Удалить объект </a> <br>
            <a href="№" class="link22">УДобавить в избранное </a> <br>
        <?php
        echo '<br>';
        echo '<br>';
    }
    
}
}
$str = json_encode($ads);
file_put_contents('tovars.json', $str);
if($_SESSION['avtor']==1){
    ?>
    <a href="?session='1'" class='exit'>завершить сессию</a>
    <?php
}
?>




<style>
 .box{
    border: 1px solid black;

 }
 a{
    display:none;
 }
 .exit{
    display:contents;
 }
/* .tovform{
    display: none;
} */
 </style>




