<?php
session_start();
class permissionCheck {	
	function permission_check($page_permission, $redirect = '') {
		require_once 'DbConnector.php';
		$db = new DbConnector();
		if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 3) {
			return true;
		}elseif(isset($_SESSION['user_id'])) {
			$user_id = $_SESSION['user_id'];
			$query = "select * from cms_permissions";
			$where = " where empid_ref=$user_id";
			$order = NULL;
			#select
			$db->select($query, $where, $order);
			#count Result
			$count=$db->countResult();
			if($count == 1){
				#fetch result
				$result = $db->fetchData();
				$no=0;
				for ($x = 0; $x < count($result); $x++)
				{
					$no++;
					$permissions = $result[$x]['permissions'];
					$permission = explode(',', $permissions);
					if(in_array($page_permission, $permission)){
						return true;
					}else{
						if(!empty($redirect))
							header('location:index.php');
						else
							return false;
					}
				}
			}else{
				if(!empty($redirect))
					header('location:index.php');
				else
					return false;
			}
		}else{
			if(!empty($redirect))
				header('location:index.php');
			else
				return false;
		}
	}
}
?>
