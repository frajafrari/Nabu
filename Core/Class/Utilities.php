<?php

class Utilities
{

	function Utilities(){

	}

	function forms($style,$schema){
?>
	<div class=<?php echo $style ?> >
			<div id="field1"></div>
				<script type="text/javascript" id="field1-script">
					$(function() {
						Alpaca.setDefaultLocale("es_ES");
						$("#field1").alpaca({
							"dataSource":"./../../Json/01_data.json",
							"optionsSource":"./../../Json/01_options.json",
							"schema":<?php print_r(json_encode($schema));?>,
							 "view": "bootstrap-create-horizontal"
						});
					});
				</script>
		</div>
<?php
	}
}
?>


