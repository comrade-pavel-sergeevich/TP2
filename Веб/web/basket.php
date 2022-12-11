<div style = "margin-left: 5px; width:95%; ">
		<h4 style = "font-size: 30px;margin-top:25px;margin-bottom:20px">Корзина</h4>
	
		<input type="submit" name="submit" value="Очистить корзину" style = "border-radius: 10px; width: 200px; background-color: #ebb572" />
	
	</div>

	<div style = "display:flex;flex-direction:column; width: 95%">
		<div style = "display:flex;flex-direction:row;">
			<p style = "margin-left: 370px">
			Цена за 1 шт.
			</p>
			<p style = "margin-left: 120px">
			Количество
			</p>
			<p style = "margin-left: 100px">
			Итого
			</p>
		</div>
	
	</div>
    <div style="display:flex;flex-direction:row; width:95%; min-height: 350px">
	<div style = "height: 100%; width: 70%">
	<?php
    include_once("includes/dbpdoconnection.inc.php");
    require_once("includes/function.inc.php");
    $data=getmenu($pdo);
    for($i=0; $i<=2; $i++){
            $value=$data[$i];
            echo(
            <<<A
            <div class = product style="display:flex;flex-direction:row;margin-top: 50px">
            <img src="$value[product_image_url]" style = "margin-left: 20px;width:150px; height:110px">
            <p style = "margin-top: 0px; margin-left: 30px; width: 70px">$value[description]</p>
            <p style = "margin-left: 130px">$value[price] руб.</p>
            <input type = "number" style = "width: 60px; margin-left: 160px; height: 40px" min = "0" onchange="Chan_count(this.value,$value[price])"/>
            <p style = "margin-left: 110px" id="sum"></p>
            <input type="submit" name="submit" value="Удалить" style = "border-radius: 10px; width: 200px; background-color: #ebb572; margin-left: 60px" />
            </div>
            A
        );};
    ?>
    </div>
		
		<div class="bg-dark text-center text-white" style = " border-radius: 25px; margin-left: 110px; height: 150px; width: 20%; border: 5px double black;">
				<p style="font-size: 32px; color:#ebb572;font-family:Arial;text-align: center;"> Итого:
				<input type="submit" name="submit" value="Оплатить" style = "margin-left: 60 px; margin-top: 50px; border-radius: 10px; width: 75%; background-color: #ebb572" />
		</p></div>
	
		
		
		
	</div>