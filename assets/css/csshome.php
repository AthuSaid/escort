<?php
echo 
	'<style>
	.style-'.$this->retRecords[0]['person'].' {
	    background: url('.SIS_URL.'images/persons/'.$this->retRecords[0]['person'].'/'.$this->retRecords[0]['cover'].') no-repeat top center; height:649px;
	}
	</style>';
?>