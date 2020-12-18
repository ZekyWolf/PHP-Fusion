function checkConnection(){$('#connection_notice').html('<p><i class="fa fa-spinner fa-spin fa-lg"></i> Server je kontrolován...</p>');$('#connection_status').show();$.get("includes/ajax.php",{ajax:"checkServerConnection",type:$('#type').val(),port:$('#port').val(),q_port:$('#q_port').val(),ip:$('#ip').val()},function(data){if(data=='good'){notice='<div class="greensuccess"><i class="fa fa-check"></i> Server úspešne vyskúšaný</div>';alertify.success("<center><i class='fa fa-bell faa-burst animated fa-2x'></i><br /> Pripojenie k serveru je úspešné</center>");var serverchecked=document.getElementById('serverchecked');serverchecked.value=1;}
else if(data=='error1')
{alertify.error("<center><i class='rederror'></i><br /> Vyplnte pole IP a PORT</center>");notice='<div class="cervene"><i class="fa fa-exclamation-circle"></i> Chyba 1: Vyplňte polia IP, Port a vyberte Hru</div>';}
else if(data=='error2')
{alertify.error("<center><i class='rederror'></i><br /> Nedá sa pripojiť na server. Skontrolujte, či je zadaná správne IP / PORT</center>");notice='<div class="alert alert-warning"><i class="fa fa-exclamation-circle"></i> Chyba 2: Nedá sa pripojiť k serveru, skontrolujte IP a PORT</div>';}
else
{alertify.error("<center><i class='rederror'></i><br /> Nedá sa pripojiť na server. Skontrolujte, či je zadaná správne IP / PORT</center>");notice='<div class="alert alert-warning"><i class="fa fa-exclamation-circle"></i> Chyba 3: '+data+'</div>';}
$('#connection_state').val(data);$('#connection_notice').html(notice);});}
