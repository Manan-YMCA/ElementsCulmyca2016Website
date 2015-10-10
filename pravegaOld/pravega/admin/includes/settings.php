<?php
ini_set('memory_limit', -1);
$siteurl = ssl().'ayur/';

function ssl(){
	

	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $domainName = $_SERVER['HTTP_HOST'];
        return $protocol.$domainName.'/';
}

$ssiteurl = "ayur/";
error_reporting(E_ALL ^ E_NOTICE);
$uploadsfolder='../uploads/profile/';
$uploadsfolder_thumb='../uploads/profile/';
$uploadsuser=$uploadsfolder;
$uploadsbagproduct=$uploadsfolder.'product/bags/';
$uploadsdressproduct=$uploadsfolder.'product/dress/';
$uplodscrop=$uploadsfolder.'crop/';
$uplodsfinal=$uploadsfolder.'final/';
$uplodsfinalp=$uploadsfolder.'final_p/';
$uplodsproductblocks=$uploadsfolder.'product_block/';
$uplodsfinalthumb=$uploadsfolder.'final_thumb/';
$border=2;



