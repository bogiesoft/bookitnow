
<ul id="countries">
	<?php 
		foreach ($countries['country'] as $country)
		{
			echo '<li style="list">
					<input type="checkbox" id="country_'.$country['@attributes']['id'].'" name="country[]" value='.$country['@attributes']['id'].' onchange="country(this)"/>
					<label for="country_'.$country['@attributes']['id'].'">'.$country['@attributes']['name'].'</label>
				</li><ul id="sub_'.$country['@attributes']['id'].'"></ul>';
		}
	?>
</ul>

<<script type="text/javascript">
	function country(e)
	{	
		var t= $(e).val(); 	
		$.post('admin/readMappingsFun',{com_id:t,pos:'country'},function(result){
			//console.log(result);
			$('#sub_'+t).html(result);			
		},'html');
	}
	function checkMe(e)
	{
		alert($(e).val());
	}
</script>
<style>
li{
list-style-type : none;
}
li label {
cursor:pointer;
}
</style>
