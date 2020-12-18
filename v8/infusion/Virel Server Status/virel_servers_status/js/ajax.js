function vote(id, type) {
	var votes = $("#serv" + id + "-layer").get(0);
	$("#serv" + id + "-button").html('<img src="images/loader.gif" />');
	$.get("includes/ajax2.php", { ajax: "vote", id: id, type: type},
	function(data){
	
		var old_rate = votes.innerHTML;
		if(data=='thanks')
		{
			var new_rate = votes.innerHTML;
            if (type == 'up') 
			{
				new_rate++;
			}
           if(!new_rate) new_rate = '0';
			$("#serv" + id + "-layer").html(new_rate+' <i class="icon-ok"></i>');
			$("#serv" + id + "-button").html('');
			$.jGrowl("Úspešne ste hlasovaly pre server!");
		}
		else if(data=='already')
		{
			$("#serv" + id + "-layer").html(old_rate+' <i class="icon-remove"></i>');
			$("#serv" + id + "-button").html('');
			$.jGrowl("Už ste hlasoval pre tento server dnes. Skúste to zajtra!");
			
		}
		else if(data=='already2')
		{
			$("#serv" + id + "-layer").html(old_rate+' <i class="icon-remove"></i>');
			$("#serv" + id + "-button").html('');
			$.jGrowl("Obmedziť hlasovanie dosiahnutý v tomto serveri, skúste to neskôr!");
			
		}
		else
		{	
			$("#serv" + id + "-layer").html(old_rate+' <i class="icon-remove"></i>');
			$("#serv" + id + "-button").html('');
			$.jGrowl("Neznáma chyba!");
		}
	});
}