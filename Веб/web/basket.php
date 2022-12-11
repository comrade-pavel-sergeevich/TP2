<div style = "margin-left: 5px; width:95%; ">
		<h4 style = "font-size: 30px;margin-top:25px;margin-bottom:20px">Корзина</h4>
	
		<input type="submit" name="submit" value="Очистить корзину" style = "border-radius: 10px; width: 200px; background-color: #ebb572" />
	
	</div>

		
	<div style="display:flex;flex-direction:column;width: 95%;margin-left: 5%;">
		<div style="display:flex;flex-direction:row;width: 74%;">
		<div style="width:170px;margin-left:20px;"></div>
		<div style="width:calc( 30px + 30%)"></div>
			<p style="margin-left: 15px; margin-right:15px; width:10%">
			Цена за 1 шт.
			</p>
			<p style="margin-left: 15px; margin-right:15px; width:10%">
			Количество
			</p>
			<p style="margin-left: 15px; margin-right:15px; width:10%">
			Итого
			</p>
			<div style="width:calc( 30px + 10%)"></div>
		</div>
	
	</div>
    <div style="display:flex;flex-direction:row; width:95%; min-height: 350px">
	<div style = "height: 100%; width: 80%">
	<?php
    include_once("includes/dbpdoconnection.inc.php");
    require_once("includes/function.inc.php");
    $data=getmenu($pdo);
    for($i=0; $i<=2; $i++){
            $value=$data[$i];
            echo(
            <<<A
            <div class = product style="display:flex;flex-direction:row;margin-bottom: 50px;width:100%;align-items:center">
            <img src="$value[product_image_url]" style = "margin-left: 20px;width:170px; height:120px">
            <p style = "margin-top: 0px; margin-left: 30px; width: 30%; hyphens:auto;margin-bottom:0">$value[description]</p>
            <p style = "margin-left: 30px; width:10%">$value[price] руб.</p>
            <input type = "number" style = "width: 10%; margin-left: 30px; height: 40px" min = "0" onchange="Chan_count(this.value,$value[price],{$value['product_id']})"/>
            <p style = "margin-left: 30px; width:10%;" name="sum" id="sum{$value['product_id']}"></p>
            <input type="submit" name="submit" value="Удалить" style = "border-radius: 10px; width: 10%;height:50px; background-color: #ebb572; margin-left: 30px" />
            </div>
            A
        );};
    ?>
    </div>
		
	<div class="bg-dark text-center text-white" style="border-radius: 25px;margin-left: 30px;height: 200px;width: 20%;border: 5px double black;ALIGN-ITEMS: center;display: flex;flex-direction: column;">
				<p style="font-size: 32px; color:#ebb572;font-family:Arial;text-align: center; margin-bottom:0"> Итого:</p>
				<p style="font-size: 32px; color:#ebb572;font-family:Arial;text-align: center; margin-top:20px;margin-bottom:20px" id="itogo"></p>
				<input type="submit" name="submit" value="Оплатить" style="margin-left: 60 px;/* margin-top: 50px; */border-radius: 10px;width: 75%;background-color: #ebb572">
		</div>

	
		
		
		
	</div>