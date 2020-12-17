<table border="0" style='text-align:center;' align="" width="100%" summary="" ><tr>
<td <?php if(isset($_GET["page"]) && $_GET["page"]=="skupiny") { echo "class='tbl1'"; }?> width='20%'><a class='odkaz' href='admin.php<?php echo $aidlink;?>&page=skupiny'><?php echo $locale['AS_MENU1']; ?></td>
<td <?php if(isset($_GET["page"]) && $_GET["page"]=="admini") { echo "class='tbl1'"; }?> width='20%'><a class='odkaz' href='admin.php<?php echo $aidlink;?>&page=admini'><?php echo $locale['AS_MENU2']; ?></td>
<td width='20%'><a class='odkaz' href='team.php?skupina=1'><?php echo $locale['AS_MENU3']; ?></td>
<td <?php if(isset($_GET["page"]) && $_GET["page"]=="omodu") { echo "class='tbl1'"; }?> width='20%'><a class='odkaz' href='admin.php<?php echo $aidlink;?>&page=omodu'><?php echo $locale['AS_MENU4']; ?></td>
</tr></table>
<hr /><br />