<?php
function getDoctor($select_id = ''){
	$result = mysql_query("SELECT * FROM doctor  where type = 1 and status = 1") or die(mysql_error());
	while($doctor = mysql_fetch_array($result)){
		if($select_id == $doctor['id'])
			$select = "selected";
		else
			$select = "";
		echo '<option value="'.$doctor['id'].'" '.$select.' >'.$doctor['name'].'</option>';
	}
}
function getStaff($select_id = ''){
	$result = mysql_query("SELECT * FROM doctor  where type = 2 and status = 1") or die(mysql_error());
	while($doctor = mysql_fetch_array($result)){
		if($select_id == $doctor['id'])
			$select = "selected";
		else
			$select = "";
		echo '<option value="'.$doctor['id'].'" '.$select.' >'.$doctor['name'].'</option>';
	}
}
function getProducts($select_id = '', $stock_type){
	$result = mysql_query("SELECT * FROM products where status=1") or die(mysql_error());
	while($products = mysql_fetch_array($result)){
		$stock_count = $products['stock_count'];
		$stock_value = $stock_type[$products['stock_type']];
		if($select_id == $products['id'])
			$select = "selected";
		else
			$select = "";
		echo '<option value="'.$products['id'].'" '.$select.' availability="'.$stock_count.' '.$stock_value.'" rack="'.$products['rack'].'">'.$products['name'].'</option>';
	}
}
function getPermissions($empid_ref){
	$result = mysql_query("SELECT * FROM permissions where empid_ref = $empid_ref") or die(mysql_error());
	$permissions = mysql_fetch_array($result);
	$permissions = $permissions['permissions'];
	$permissions = explode(",", $permissions);
	return $permissions;
}
?>