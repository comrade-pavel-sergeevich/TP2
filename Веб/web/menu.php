
<div class="menu" style="padding:0;margin:0;height:80px;">
<div class="downskoe-menu" style="margin-left:20px; width: 97.5%;"><ul class="food menu" style="justify-content: flex-start;"><li class="menu-item">Сырники</li><li class="menu-item"></li></ul></div>
</div>

<div style="height:80%;width: 97%;border-radius:6px;display:flex;flex-direction:row;justify-content: space-between;margin-left: 20px;margin-right: 25px;margin-top: 70px;padding-bottom:40px">
<div style="position: fixed;width: 20%;border-radius:6px;background-color:#222121;display:flex;flex-direction:column;min-height: 55%;"><p style="color: #ebb572;margin-left: -100px;">Страна Производитель:</p>
    <div style="display:flex;flex-direction:column">
        <input type="radio" id="contactChoice1"
               name="contact" style="margin-left: -180px">
        <label for="contactChoice1" style="color: #ebb572; margin-left: 70px;margin-top: -16px; margin-bottom: 20px;">Россия</label>
        <input type="radio" id="contactChoice2"
               name="contact" style="margin-left: -180px">
        <label for="contactChoice2"style="color: #ebb572; margin-left: 70px;margin-top: -16px;margin-bottom: 20px">Беларусь</label>
        <input type="radio" id="contactChoice3"
               name="contact" style="margin-left: -180px">
        <label for="contactChoice3"style="color: #ebb572; margin-left: 70px;margin-top: -16px;margin-bottom: 20px">Казахстан</label>
    </div>
    <p style="color: #ebb572;margin-left: -230px;">Цена:</p>
    <div class="slidecontainer">
        <input type="range" min="1" max="100" value="50" class="slider" id="myRange">
      </div>
    <div style="display:flex;flex-direction:row; margin-top: 100px;">
        <button class = "button_menu" style="margin-left:20px ;">Применить</button>
        <button class = "button_menu" style="margin-left: 55px">Очистить</button>

    </div>
</div>
<div style="height:100%;width: 100%;border-radius:6px;display:flex;flex-direction:column;padding-left: 23%;">
<div style="height: 100%;width: 100%;border-radius:6px;display:flex;flex-direction: row;flex-wrap: wrap;height:fit-content">
    <?php
    include_once("includes/dbpdoconnection.inc.php");
    require_once("includes/function.inc.php");
    $data=getmenu($pdo);
    //echo $data;
    for($i=1; $i<=30; $i++){
            //foreach ($data as &$value) {
            $value=$data[rand(0,2)];
            echo(
            <<<A
            <div class="menu_izdeliya">
            <img src="$value[product_image_url]"
             style="width:321px; height:201px;border-radius: 10px;">
            <button style="border-radius: 7px;margin-left: 240px;margin-top: -50px;cursor: pointer;background: transparent;"onclick="Add($value[product_id])"><img src="https://cdn-icons-png.flaticon.com/512/1374/1374128.png" width="40" ></button>
            <div style="border: 2px solid black;border-radius: 5px;border-style: dotted">
                <p class = "menu_text"> $value[description]</p>  
                <div style="display: flex; flex-direction: row;justify-content: space-between;">
                <p class = "price"> $value[price] руб. </p>
                <p class = "price"> $value[weight] гр </p>
                </div>
            </div>
            </div>
            A
        );};
   // }
    ?>    

    <!-- <div class="menu_izdeliya">
        <img src="https://prostokvashino.ru/upload/iblock/d28/d28e1b22ab38bfcce66f54a1a80e7526.jpg"
        width=301px height=201px style="border-radius: 10px;">
        <button style="border-radius: 7px;margin-left: 240px;margin-top: -50px;cursor: pointer;background: transparent;"><img src="https://cdn-icons-png.flaticon.com/512/1374/1374128.png" width="40" ></button>
        <div style="border: 2px solid black;border-radius: 5px;border-style: dotted">
            <p class = "menu_text"> Сырники с клюквенным вареньем и сметаной</p>  
            <div style="display: flex; flex-direction: row;justify-content: space-between;">
            <p class = "price"> 300 руб. </p>
            <p class = "price"> 300 гр </p>
            </div>
        </div>
    </div><div class="menu_izdeliya">
        <img src="https://prostokvashino.ru/upload/iblock/d28/d28e1b22ab38bfcce66f54a1a80e7526.jpg"
        width=301px height=201px style="border-radius: 10px;">
        <button style="border-radius: 7px;margin-left: 240px;margin-top: -50px;cursor: pointer;background: transparent;"><img src="https://cdn-icons-png.flaticon.com/512/1374/1374128.png" width="40" ></button>
        <div style="border: 2px solid black;border-radius: 5px;border-style: dotted">
            <p class = "menu_text"> Сырники с клюквенным вареньем и сметаной</p>  
            <div style="display: flex; flex-direction: row;justify-content: space-between;">
            <p class = "price"> 300 руб. </p>
            <p class = "price"> 300 гр </p>
            </div>
        </div>
    </div><div class="menu_izdeliya">
        <img src="https://prostokvashino.ru/upload/iblock/d28/d28e1b22ab38bfcce66f54a1a80e7526.jpg"
        width=301px height=201px style="border-radius: 10px;">
        <button style="border-radius: 7px;margin-left: 240px;margin-top: -50px;cursor: pointer;background: transparent;"><img src="https://cdn-icons-png.flaticon.com/512/1374/1374128.png" width="40" ></button>
        <div style="border: 2px solid black;border-radius: 5px;border-style: dotted">
            <p class = "menu_text"> Сырники с клюквенным вареньем и сметаной</p>  
            <div style="display: flex; flex-direction: row;justify-content: space-between;">
            <p class = "price"> 300 руб. </p>
            <p class = "price"> 300 гр </p>
            </div>
        </div>
    </div><div class="menu_izdeliya">
        <img src="https://prostokvashino.ru/upload/iblock/d28/d28e1b22ab38bfcce66f54a1a80e7526.jpg"
        width=301px height=201px style="border-radius: 10px;">
        <button style="border-radius: 7px;margin-left: 240px;margin-top: -50px;cursor: pointer;background: transparent;"><img src="https://cdn-icons-png.flaticon.com/512/1374/1374128.png" width="40" ></button>
        <div style="border: 2px solid black;border-radius: 5px;border-style: dotted">
            <p class = "menu_text"> Сырники с клюквенным вареньем и сметаной</p>  
            <div style="display: flex; flex-direction: row;justify-content: space-between;">
            <p class = "price"> 300 руб. </p>
            <p class = "price"> 300 гр </p>
            </div>
        </div>
    </div><div class="menu_izdeliya">
        <img src="https://prostokvashino.ru/upload/iblock/d28/d28e1b22ab38bfcce66f54a1a80e7526.jpg"
        width=301px height=201px style="border-radius: 10px;">
        <button style="border-radius: 7px;margin-left: 240px;margin-top: -50px;cursor: pointer;background: transparent;"><img src="https://cdn-icons-png.flaticon.com/512/1374/1374128.png" width="40" ></button>
        <div style="border: 2px solid black;border-radius: 5px;border-style: dotted">
            <p class = "menu_text"> Сырники с клюквенным вареньем и сметаной</p>  
            <div style="display: flex; flex-direction: row;justify-content: space-between;">
            <p class = "price"> 300 руб. </p>
            <p class = "price"> 300 гр </p>
            </div>
        </div>
    </div><div class="menu_izdeliya">
        <img src="https://prostokvashino.ru/upload/iblock/d28/d28e1b22ab38bfcce66f54a1a80e7526.jpg"
        width=301px height=201px style="border-radius: 10px;">
        <button style="border-radius: 7px;margin-left: 240px;margin-top: -50px;cursor: pointer;background: transparent;"><img src="https://cdn-icons-png.flaticon.com/512/1374/1374128.png" width="40" ></button>
        <div style="border: 2px solid black;border-radius: 5px;border-style: dotted">
            <p class = "menu_text"> Сырники с клюквенным вареньем и сметаной</p>  
            <div style="display: flex; flex-direction: row;justify-content: space-between;">
            <p class = "price"> 300 руб. </p>
            <p class = "price"> 300 гр </p>
            </div>
        </div>
    </div> -->
    
    
</div>
<div style="height: 15%;width: 100%;border-radius:6px; background-color:#222121;display:flex;flex-direction: column;"><p  text-align="left" style="color: #ebb572;"> Информация об изделии</p></div>
</div>
<footer></footer>	

