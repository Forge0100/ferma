function engineInit(){
	var gid = document.getElementById("donate");
	var toprates = document.getElementById("toprates");
	var sms = document.getElementById("sms");
	var IE='\v'=='v';
	if ($("#donate")){
		$("#donate").html('');
		if (IE){
			$("#donate").append("<p align=left style='margin-left:20px;'>Ваш браузер не поддерживается.<br>Поддерживаемые браузеры:<br><b> - Mozilla Firefox<br> - Opera<br> - Google Chrome</b></p>");
		} else {
			$("#donate").append(
				'<center>' +
				'<p>' +
				'<table>' +
				'<tr><td>Кол-во Gold Einhasad:</td><td><select name="amount" style="width:220px" id="donate-amount">' +
					'<option value=1>1</option>' +
					'<option value=2>2</option>' +
					'<option value=3>3</option>' +
					'<option value=4>4</option>' +
					'<option value=5>5</option>' +
					'<option value=10>10</option>' +
					'<option value=15>15</option>' +
					'<option value=20>20</option>' +
					'<option value=25>25</option>' +
					'<option value=30>30</option>' +
					'<option value=35>35</option>' +
					'<option value=40>40</option>' +
					'<option value=45>45</option>' +
					'<option value=50>50</option>' +
					'<option value=60>60</option>' +
					'<option value=70>70</option>' +
					'<option value=80>80</option>' +
					'<option value=90>90</option>' +
					'<option value=100>100</option>' +
				'</select></td></tr>' +
				'<tr><td>Имя персонажа:</td><td><input name="char_name" type="text" value="" style="width:216px" id="donate-name" /></td></tr>' +
				'<tr><td>Оплата через</td><td><span id="pay">Подключение...</span>' +
				'</td></tr>' +
				'</table>' +
				'<a href="#" onclick="donate(1);return false;">' +
				'<div id="donate-btn">Оплатить</div>' +
				'</a></p></center>'
			)
			currency();
		}
	}
	if ($("#sms")){
		$("#sms").html('');
		$("#sms").append(
			'<center>' +
			'<p>' +
			'<table>' +
			'<tr><td>Кол-во Gold Einhasad:</td><td><select name="amount_sms" style="width:220px" id="sms-amount">' +
				'<option value=1>1</option>' +
				'<option value=2>2</option>' +
				'<option value=3>3</option>' +
				'<option value=4>4</option>' +
				'<option value=5>5</option>' +
				'<option value=6>6</option>' +
				'<option value=7>7</option>' +
				'<option value=8>8</option>' +
				'<option value=9>9</option>' +
				'<option value=10>10</option>' +
				'<option value=15>15</option>' +
			'</select></td></tr>' +
			'<tr><td>Имя персонажа:</td><td><input name="char_name_sms" type="text" value="" style="width:216px" id="sms-name" /></td></tr>' +
			'</td></tr>' +
			'</table>' +
			'<a href="#" onclick="donate(3);return false;">' +
			'<div id="sms-btn">Оплатить</div>' +
			'</a></p></center>'
			)
	}
	if ($("#interkassa")){
		$("#interkassa").html('');
		if (IE){
			$("#interkassa").append("<p align=left style='margin-left:20px;'>Ваш браузер не поддерживается.<br>Поддерживаемые браузеры:<br><b> - Mozilla Firefox<br> - Opera<br> - Google Chrome</b></p>");
		} else {
			$("#interkassa").append(
				'<center>' +
				'<p>' +
				'<table>' +
				'<tr><td>Кол-во Gold Einhasad:</td><td><select name="amount_ik" style="width:220px" id="ik-amount">' +
					'<option value=1>1</option>' +
					'<option value=2>2</option>' +
					'<option value=3>3</option>' +
					'<option value=4>4</option>' +
					'<option value=5>5</option>' +
					'<option value=10>10</option>' +
					'<option value=15>15</option>' +
					'<option value=20>20</option>' +
					'<option value=25>25</option>' +
					'<option value=30>30</option>' +
					'<option value=35>35</option>' +
					'<option value=40>40</option>' +
					'<option value=45>45</option>' +
					'<option value=50>50</option>' +
					'<option value=60>60</option>' +
					'<option value=70>70</option>' +
					'<option value=80>80</option>' +
					'<option value=90>90</option>' +
					'<option value=100>100</option>' +
				'</select></td></tr>' +
				'<tr><td>Имя персонажа:</td><td><input name="char_name_ik" type="text" value="" style="width:216px" id="ik-name" /></td></tr>' +
				'</td></tr>' +
				'</table>' +
				'<a href="#" onclick="donate(2);return false;">' +
				'<div id="ik-btn">Оплатить</div>' +
				'</a></p></center>'
			)
		}
	}
}

function currency(){
	$.ajax({
		url: 'http://elhazard.in/engine/smsdonate.php?act=GetCurrencies',
		data: ({}),
		dataType:'xml',
		success: function (xml){
			$("#pay").html('<select id="payment_method" name="payment_method"></select>');
			$(xml).find('Group').each(function(){
				opt = $(this).attr("Code");
				desc = $(this).attr("Description");
				$("#payment_method").append('<optgroup label="' + desc + '" id=' + opt + '></optgroup>');
				$(this).find('Currency').each(function(){
					lbl = $(this).attr("Label");
					item = $(this).attr("Name");
					sel = '';
					if (lbl=='WMRM')
						sel = 'selected ';
					$('#' + opt).append('<option ' + sel + 'value="' + lbl + '">' + item + '</option>');
				});
			})
		}
	})
}

function donate(partner){
	var name = document.getElementById("donate-name").value;
	var ik_name = document.getElementById("ik-name").value;
	var sms_name = document.getElementById("sms-name").value;
	if (name == '' && ik_name == '' && sms_name == '') {
		alert("Не указано имя персонажа");
	} else {
		if(partner==1){
			var amount = document.getElementById("donate-amount").value;
			var curr = document.getElementById("payment_method").value;
			var curr_index = document.getElementById("payment_method").selectedIndex;
			var curr_desc = document.getElementById("payment_method").options[curr_index].text;
			$.ajax({
				type: 'POST',
				url: 'http://elhazard.in/engine/smsdonate.php?act=rb_accept',
				cache: false,
				data: ({amount: amount, char_name: name, in_curr: curr}),
				dataType: 'html',
				success: function (html){
					$("#donate").html(
						"Имя персонажа: <b>" + name + "</b><br>" +
						"Количество: <b>" + amount + " Gold Einhasad</b><br>" +
						"Способ оплаты: <b>" + curr_desc + "</b></br>"
					)
					$("#donate").append(html);
				}
			})
		} else if (partner==2) {
			var ik_amount = document.getElementById("ik-amount").value;
			$.ajax({
				type: 'POST',
				url: 'http://elhazard.in/engine/smsdonate.php?act=ik_accept',
				cache: false,
				data: ({amount: ik_amount, char_name: ik_name}),
				dataType: 'html',
				success: function (html){
					$("#interkassa").html(
						"Имя персонажа: <b>" + ik_name + "</b><br>" +
						"Количество: <b>" + ik_amount + " Gold Einhasad</b><br>"
					)
					$("#interkassa").append(html);
				}
			})
		} else if (partner==3) {
			var sms_amount = document.getElementById("sms-amount").value;
			$.ajax({
				type: 'POST',
				url: 'http://elhazard.in/engine/smsdonate.php?act=sms_accept',
				cache: false,
				data: ({amount: sms_amount, char_name: sms_name}),
				dataType: 'html',
				success: function (html){
					$("#sms").html(
						"Имя персонажа: <b>" + sms_name + "</b><br>" +
						"Количество: <b>" + sms_amount + " Gold Einhasad</b><br>"
					)
					$("#sms").append(html);
				}
			})
		}
	}
}
