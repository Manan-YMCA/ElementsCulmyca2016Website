<?php
ob_start();
session_start();
/*require_once 'logcheck-admin.php';
$log = new LoggedIn();
$log->logincheck();*/
require_once 'includes/DbConnector.php';
require_once 'includes/FormActionValidator.php';
require_once 'includes/FileUploader.php';
$db = new DbConnector();
$fav = new FormActionValidator();
include('includes/common_functions.php');
include('includes/global.php');
require 'includes/Zebra_Image.php';
require 'includes/constants.php';

if(isset($_POST['patient_save'])&&$_POST['patient_save']=='Save') {
	$fav->postDataExist('admission');
	$fav->postDataExist('name');
	$fav->postDataExist('email');
	$fav->postDataExist('age');
	$fav->postDataExist('gender');
	if(!$fav->foundErrors()) {
		$admission = $fav->preventInjuctionPost('admission');
		$check_sql = "select * from patient ";
		$where = " where admission_no = '$admission'";
		$order = NULL;		
		$check = $db->select($check_sql, $where, $order);		
		$count = $db->countResult();		
		if($count>0) {
			$_SESSION['warning'] = "Admission number exists";
			header('location:patient.php');
		}else {		
			$patient_name = $fav->preventInjuctionPost('name');
			$email = $fav->preventInjuctionPost('email');
			$age = $fav->preventInjuctionPost('age');
			$gender = $fav->preventInjuctionPost('gender');
			$address = $fav->preventInjuctionPost('address');
			$mobile = $fav->preventInjuctionPost('mobile');
			$fee = $fav->preventInjuctionPost('fee');
			
			$path = 'uploads/profile/';		
			$valid_formats = array(".jpg",".jpeg", ".png", ".gif", ".bmp");
			$name = $_FILES['fileToUpload']['name'];
			$size = $_FILES['fileToUpload']['size'];	
			if(strlen($name)){
				preg_match('/\.[^\.]+$/i',$name,$ext);
				if(in_array(strtolower($ext[0]),$valid_formats)){
					if($size<(2097152)){
						$actual_image_name = time().substr(str_replace(" ", "_", $patient_name), 5).$ext[0];
						$tmp = $_FILES['fileToUpload']['tmp_name'];
						if(move_uploaded_file($tmp, $path.$actual_image_name)){
							list($w,$h) = getimagesize($path.$actual_image_name);
							$widthval = $w;
							$heightval = $h;
							$destination = $path.$actual_image_name;
							//copy( $destination , $destination);									
							resizewithquality($destination,$destination,200,150);
							list($w,$h) = getimagesize($path.$actual_image_name);
							
							$table = 'patient';
							$info = array(
								'admission_no'=>$admission, 
								'name'=>$patient_name, 
								'address'=>$address, 
								'mobile'=>$mobile, 
								'email'=>$email, 
								'age'=>$age, 
								'gender'=>$gender, 
								'image'=>$actual_image_name, 
								'date_created'=>date('Y-m-d H:i:s'),
								'date_updated'=>''
							);
							if(!empty($fee))
								$info['fee'] = date('Y-m-d H:i:s');
							$id = insert($info, $table);
							if($id) {
								$_SESSION['success'] = "Details added successfully";
								header('location:patient.php');
							}else {
								$_SESSION['error'] = "Error occured while adding";
								header('location:patient.php');
							}
						}else{
							$_SESSION['error'] = "Image upload failed";
							header('location:patient.php');
						}
					}else{
						$_SESSION['error'] = "File size cannot exceed 2mb";
						header('location:patient.php');
					}
				}else{
					$_SESSION['error'] = "Invalid file format..";
					header('location:patient.php');
				}
			}else{
				$_SESSION['error'] = "Please select image..";
				header('location:patient.php');
			}
		}
	}else {
		$_SESSION['error'] = "Fill up all the mandatory fields";
		header('location:patient.php');
	}
}elseif(isset($_GET['patient_edit_id'])) {
	//require 'popup.php';
	$editid = $_GET['patient_edit_id'];
	$query = "select * from patient ";
	$where = "where  id=".$editid;
	$order = NULL;
	$db->select($query, $where, $order);
	$count = $db->countResult();
	if($count == 1){
		$result = $db->fetchData();
?>
		<div class="mediaWrapper row-fluid">
			<form id="edit_patient" class="stdform" method="post" enctype="multipart/form-data" action="pravega_action.php">
            	<input type="hidden" class="input-xlarge" name="id" value="<?= $result[0]['id'] ?>" />
                <div class="par control-group">
                    <label class="control-label" for="admission">Admission no.</label>
                    <div class="controls"><input type="text" name="admission" id="admission" class="input-xlarge" value="<?= $result[0]['admission_no'] ?>" /></div>
                </div>
                <div class="par control-group">
                    <label class="control-label" for="name">Name</label>
                    <div class="controls"><input type="text" name="name" id="name" class="input-xlarge" value="<?= $result[0]['name'] ?>" /></div>
                </div>									
                <div class="par control-group">
                    <label class="control-label" for="email">Email</label>
                    <div class="controls"><input type="text" name="email" id="email" class="input-xlarge" value="<?= $result[0]['email'] ?>" /></div>
                </div>							
                <div class="par control-group">
                    <label class="control-label" for="mobile">Mobile</label>
                    <div class="controls"><input type="text" name="mobile" id="mobile" class="input-xlarge" value="<?= $result[0]['mobile'] ?>" /></div>
                </div>
                <div class="par control-group">
                    <label class="control-label">Existing Image</label>
            		<img src="uploads/profile/<?= $result[0]['image'] ?>" alt="" class="imgpreview img-polaroid" />
               	</div>
                <div class="par control-group">
                    <label class="control-label" for="photo">Photo</label>				
                    <div class="controls"><input type="file" class="uniform-file" name="fileToUpload" /></div>
                </div>			
                <div class="par control-group">
                    <label class="control-label" for="age">Age</label>
                    <div class="controls"><input type="text" name="age" id="age" class="input-xlarge" value="<?= $result[0]['age'] ?>" /></div>
                </div>								
                <div class="par control-group">
                    <label class="control-label" for="gender">Gender</label>
                    <div class="controls">
                        <select name="gender" id="gender" class="input-xlarge select_list">
                            <option value="">Select</option>
                            <option value="1" <?php echo($result[0]['gender'] == 1) ? 'selected':''; ?>>Male</option>
                            <option value="2" <?php echo($result[0]['gender'] == 2) ? 'selected':''; ?>>Female</option>
                        </select>
                    </div>
                </div>				
                <div class="par control-group">
                    <label class="control-label" for="address">Address</label>
                    <div class="controls"><textarea cols="80" rows="5" name="address" class="input-xlarge" id="address"><?= $result[0]['address'] ?></textarea></div> 
                </div>
                                        
                <p class="stdformbutton">
                    <input type="submit" class="btn btn-primary button_save" id="patient_update" name="patient_update" value="Update">
                </p>
            </form>
		</div>
<?php 
	}
	//require 'popup_footer.php';
}elseif(isset($_POST['patient_update']) && $_POST['patient_update']=='Update') {
	$fav->postDataExist('id');
	$fav->postDataExist('admission');
	$fav->postDataExist('name');
	$fav->postDataExist('email');
	$fav->postDataExist('age');
	$fav->postDataExist('gender');
	if(!$fav->foundErrors()) {
		$id = $fav->preventInjuctionPost('id');
		$admission = $fav->preventInjuctionPost('admission');
		$patient_name = $fav->preventInjuctionPost('name');
		$email = $fav->preventInjuctionPost('email');
		$age = $fav->preventInjuctionPost('age');
		$gender = $fav->preventInjuctionPost('gender');
		$address = $fav->preventInjuctionPost('address');
		$mobile = $fav->preventInjuctionPost('mobile');
		$fee = $fav->preventInjuctionPost('fee');
		
		$check_sql = "select * from patient ";
		$where = " where admission_no = '$admission' and id!=$id";
		$order = NULL;		
		$check = $db->select($check_sql, $where, $order);		
		$count = $db->countResult();
		
		if($count>0) {
			$_SESSION['warning'] = "Admission number exists";
			header('location:patient.php');
		}else {		
			$path = 'uploads/profile/';		
			$valid_formats = array(".jpg",".jpeg", ".png", ".gif", ".bmp");
			$name = $_FILES['fileToUpload']['name'];
			$size = $_FILES['fileToUpload']['size'];
			if(strlen($name)){
				preg_match('/\.[^\.]+$/i',$name,$ext);
				if(in_array(strtolower($ext[0]),$valid_formats)){
					if($size<(2097152)){
						$actual_image_name = time().substr(str_replace(" ", "_", $patient_name), 5).$ext[0];
						$tmp = $_FILES['fileToUpload']['tmp_name'];
						if(move_uploaded_file($tmp, $path.$actual_image_name)){
							list($w,$h) = getimagesize($path.$actual_image_name);
							$widthval = $w;
							$heightval = $h;
							$destination = $path.$actual_image_name;							
							resizewithquality($destination,$destination,200,150);
							list($w,$h) = getimagesize($path.$actual_image_name);
						}else{
							$_SESSION['error'] = "Image upload failed";
							header('location:patient.php');
						}
					}else{
						$_SESSION['error'] = "File size cannot exceed 2mb";
						header('location:patient.php');
					}
				}else{
					$_SESSION['error'] = "Invalid file format";
					header('location:patient.php');
				}
			}	
			$update_db = array(
				'admission_no'=>$admission, 
				'name'=>$patient_name, 
				'address'=>$address, 
				'mobile'=>$mobile, 
				'email'=>$email, 
				'age'=>$age, 
				'gender'=>$gender,
				'date_updated'=>date('Y-m-d H:i:s')
			);
			if(!empty($fee))
				$update_db['fee'] = date('Y-m-d H:i:s');
			if(!empty($actual_image_name))
				$update_db['image'] = $actual_image_name;
			$res = $db->update('patient', $update_db, array('id'=>'id= '.$id));
			if($res) {
				$_SESSION['success'] = "Details updated successfully";
				header('location:patient.php');
			}else {
				$_SESSION['error'] = "Error occured while updating";
				header('location:patient.php');
			}
		}
	}else {
		$_SESSION['error'] = "Fill up all the mandatory fields";
		header('location:patient.php');
	}
}elseif(isset($_GET['patient_delete_id'])) {
	$fav->getDataExist('patient_delete_id');
	if(!$fav->foundErrors()) {
		$id = $fav->preventInjuctionGet('patient_delete_id');
		$trans_del = $db->delete("patient", "id=".$id);				
				
		if($trans_del) {
			$_SESSION['success'] = "Patient profile deleted successfully";
			header('location:patient.php');
		}
		else {
			$_SESSION['error'] = "Error occured while deleting";
			header('location:patient.php');
		} 
	}
}elseif(isset($_GET['student_view_id'])) {
	$editid = $_GET['student_view_id'];
	$query = "select * from student ";
	$where = "where  id=".$editid;
	$order = NULL;
	$db->select($query, $where, $order);
	$count = $db->countResult();
	if($count == 1){
		$result = $db->fetchData();
?> 
		<div class="mediaWrapper row-fluid">
            <table class="table table-bordered">
                <colgroup>
                    <col class="con0" />
                    <col class="con1" />
                    <col class="con0" />
                    <col class="con1" />
                    <col class="con0" />
                </colgroup>
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td><?= $result[0]['name'] ?></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td><?= $result[0]['username'] ?></td>
                    </tr>
                    <tr>
                        <td>Ambassador ID</td>
                        <td><?= $result[0]['ambassador'] ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?= $result[0]['email'] ?></td>
                    </tr>
                    <tr>
                        <td>Mobile</td>
                        <td><?= $result[0]['mobile'] ?></td>
                    </tr>
                    <tr>
                        <td>College</td>
                        <td><?= $result[0]['college'] ?></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td><?= $result[0]['city'] ?></td>
                    </tr>
                    <tr>
                        <td>DOB</td>
                        <td><?= $result[0]['dob'] ?></td>
                    </tr>
                    <tr>
                        <td>know about Pravega</td>
                        <td>
                        	<?= $result[0]['pravega']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Verification</td>
                        <td>
                        	<?= !empty($result[0]['verification']) ? 'Yes' : 'No'; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
		</div>
<?php
	}else{
		echo "No record found!!!";
	}
}elseif(isset($_GET['ambassador_view_id'])) {
	$editid = $_GET['ambassador_view_id'];
	$query = "select * from ambassador ";
	$where = "where  id=".$editid;
	$order = NULL;
	$db->select($query, $where, $order);
	$count = $db->countResult();
	if($count == 1){
		$result = $db->fetchData();
?> 
		<div class="mediaWrapper row-fluid">
            <table class="table table-bordered">
                <colgroup>
                    <col class="con0" />
                    <col class="con1" />
                    <col class="con0" />
                    <col class="con1" />
                    <col class="con0" />
                </colgroup>
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td><?= $result[0]['name'] ?></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td><?= $result[0]['username'] ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?= $result[0]['email'] ?></td>
                    </tr>
                    <tr>
                        <td>Mobile</td>
                        <td><?= $result[0]['mobile'] ?></td>
                    </tr>
                    <tr>
                        <td>College</td>
                        <td><?= $result[0]['college'] ?></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td><?= $result[0]['city'] ?></td>
                    </tr>
                    <tr>
                        <td>DOB</td>
                        <td><?= $result[0]['dob'] ?></td>
                    </tr>
                    <tr>
                        <td>know about Pravega</td>
                        <td>
                        	<?= $result[0]['pravega']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Verification</td>
                        <td>
                        	<?= !empty($result[0]['verification']) ? 'Yes' : 'No'; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
		</div>
<?php
	}else{
		echo "No record found!!!";
	}
}elseif(isset($_POST['doctor_save']) && $_POST['doctor_save']=='Save') {
	$fav->postDataExist('name');
	$fav->postDataExist('mobile');
	$fav->postDataExist('username');
	$fav->postDataExist('password');
	$fav->postDataExist('cpassword');
	if(!$fav->foundErrors()) {	
		require_once 'includes/functions.php';
		$functions = new GlobalFunctions();
		$doctor_name = $fav->preventInjuctionPost('name');
		$email = $fav->preventInjuctionPost('email');
		$mobile = $fav->preventInjuctionPost('mobile');
		$phone = $fav->preventInjuctionPost('phone');
		$department = $fav->preventInjuctionPost('department');
		$specialization = $fav->preventInjuctionPost('specialization');
		$qualificattion = $fav->preventInjuctionPost('qualificattion');
		$address = $fav->preventInjuctionPost('address');
		$username = $fav->preventInjuctionPost('username');
		$password = $fav->preventInjuctionPost('password');
		$cpassword = $fav->preventInjuctionPost('cpassword');
		$status = $fav->preventInjuctionPost('status');
		$type = $fav->preventInjuctionPost('type');
		
		if (!empty($email) && !preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
			$_SESSION['warning'] = "Invalid email format";
			header('location:doctor.php'); 
		}elseif($password != $cpassword) {
			$_SESSION['warning'] = "Password doesn't match";
			header('location:doctor.php'); 
		}
		$query = "select * from doctor ";
		$where = " where username = '$username'";
		$order = NULL;
		$db->select($query, $where, $order);
		$count = $db->countResult();
		if($count > 0){
			$_SESSION['warning'] = "Username already exists";
			header('location:doctor.php');
		}else{		
			$password = $functions->generate_password($password);
			$res = $db->insert('doctor', array('', $doctor_name, $email, $mobile, $phone, $address, $department, $specialization, $qualificattion, $username, $password, $status, $type, '', date('Y-m-d H:i:s')));
			if($res) {
				$_SESSION['success'] = "Details added successfully";
				header('location:doctor.php');
			}else {
				$_SESSION['error'] = "Error occured while adding";
				header('location:doctor.php');
			}
		}
	}else {
		$_SESSION['error'] = "Fill up all the mandatory fields";
		header('location:doctor.php');
	}
}elseif(isset($_GET['doctor_edit_id'])) {
	$editid = $_GET['doctor_edit_id'];
	$query = "select * from doctor ";
	$where = "where  id=".$editid;
	$order = NULL;
	$db->select($query, $where, $order);
	$count = $db->countResult();
	if($count == 1){
		$result = $db->fetchData();

?>
		<div class="mediaWrapper row-fluid">
			<form id="edit_doctor" class="stdform" method="post" enctype="multipart/form-data" action="pravega_action.php">
            	<input type="hidden" class="input-xlarge" name="id" value="<?= $result[0]['id'] ?>" />
            	<input type="hidden" class="input-xlarge" name="type" value="1" />
                <div class="par control-group">
                    <label class="control-label" for="name">Name</label>
                    <div class="controls"><input type="text" name="name" id="name" class="input-xlarge" value="<?= $result[0]['name'] ?>" /></div>
                </div>									
                <div class="par control-group">
                    <label class="control-label" for="email">Email</label>
                    <div class="controls"><input type="text" name="email" id="email" class="input-xlarge" value="<?= $result[0]['email'] ?>" /></div>
                </div>							
                <div class="par control-group">
                    <label class="control-label" for="mobile">Mobile</label>
                    <div class="controls"><input type="text" name="mobile" id="mobile" class="input-xlarge" value="<?= $result[0]['mobile'] ?>" /></div>
                </div>				
                <div class="par control-group">
                    <label class="control-label" for="mobile">Phone</label>
                    <div class="controls"><input type="text" name="phone" id="phone" class="input-xlarge" value="<?= $result[0]['phone'] ?>" /></div>
                </div>
                <div class="par control-group">
                    <label class="control-label" for="age">Department</label>
                    <div class="controls"><input type="text" name="department" id="department" class="input-xlarge" value="<?= $result[0]['department'] ?>" /></div>
                </div>
                <div class="par control-group">
                    <label class="control-label" for="age">Specialization</label>
                    <div class="controls"><input type="text" name="specialization" id="specialization" class="input-xlarge" value="<?= $result[0]['specialization'] ?>" /></div>
                </div>
                <div class="par control-group">
                    <label class="control-label" for="age">Qualificattion</label>
                    <div class="controls"><input type="text" name="qualificattion" id="qualificattion" class="input-xlarge" value="<?= $result[0]['qualificattion'] ?>" /></div>
                </div>
                <div class="par control-group">
                    <label class="control-label" for="username">Username</label>
                    <div class="controls"><input type="text" name="username" id="username" class="input-xlarge" value="<?= $result[0]['username'] ?>" /></div>
                </div>
                <div class="par control-group">
                    <label class="control-label" for="status">Status</label>
                    <div class="controls">
                        <select name="status" id="status" class="input-xlarge select_list">
                            <option value="" selected="selected">Select</option>
                            <option value="1" <?php echo($result[0]['status'] == 1) ? 'selected':''; ?>>Active</option>
                            <option value="0" <?php echo($result[0]['status'] == 0) ? 'selected':''; ?>>Inactive</option>
                        </select>
                    </div>
                </div>	
                <div class="par control-group">
                    <label class="control-label" for="address">Address</label>
                    <div class="controls"><textarea cols="80" rows="5" name="address" class="input-xlarge" id="address"><?= $result[0]['address'] ?></textarea></div> 
                </div>
                                        
                <p class="stdformbutton">
                    <input type="submit" class="btn btn-primary button_save" id="doctor_update" name="doctor_update" value="Update">
                </p>
            </form>
		</div>
<?php 
	}
	//require 'popup.php';
}elseif(isset($_GET['doctor_view_id'])) {
	$editid = $_GET['doctor_view_id'];
	$query = "select * from doctor ";
	$where = "where  id=".$editid;
	$order = NULL;
	$db->select($query, $where, $order);
	$count = $db->countResult();
	if($count == 1){
		$result = $db->fetchData();
		$img = $result[0]['image'];
		if(!empty($img))
			$image = "<img src='uploads/profile/$img' />";
?> 
		<div class="mediaWrapper row-fluid">
            <table class="table table-bordered">
                <colgroup>
                    <col class="con0" />
                    <col class="con1" />
                    <col class="con0" />
                    <col class="con1" />
                    <col class="con0" />
                </colgroup>
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td><?= $result[0]['name'] ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?= $result[0]['email'] ?></td>
                    </tr>
                    <tr>
                        <td>Mobile</td>
                        <td><?= $result[0]['mobile'] ?></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td><?= $result[0]['phone'] ?></td>
                    </tr>
                    <tr>
                        <td>Department</td>
                        <td><?= $result[0]['department'] ?></td>
                    </tr>
                    <tr>
                        <td>Specialization</td>
                        <td><?= $result[0]['specialization'] ?></td>
                    </tr>
                    <tr>
                        <td>Qualificattion</td>
                        <td><?= $result[0]['qualificattion'] ?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>
                        	<?= ($result[0]['status'] == 1) ? 'Active' : 'Inactive' ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><?= $result[0]['address'] ?></td>
                    </tr>
                </tbody>
            </table>
		</div>
<?php
	}else{
		echo "No record found!!!";
	}
}elseif(isset($_POST['doctor_update']) && $_POST['doctor_update']=='Update') {
	$fav->postDataExist('id');
	$fav->postDataExist('name');
	$fav->postDataExist('mobile');
	$fav->postDataExist('username');
	if(!$fav->foundErrors()) {	
		$id = $fav->preventInjuctionPost('id');
		$doctor_name = $fav->preventInjuctionPost('name');
		$email = $fav->preventInjuctionPost('email');
		$mobile = $fav->preventInjuctionPost('mobile');
		$phone = $fav->preventInjuctionPost('phone');
		$department = $fav->preventInjuctionPost('department');
		$specialization = $fav->preventInjuctionPost('specialization');
		$qualificattion = $fav->preventInjuctionPost('qualificattion');
		$address = $fav->preventInjuctionPost('address');
		$username = $fav->preventInjuctionPost('username');
		$status = $fav->preventInjuctionPost('status');
		$type = $fav->preventInjuctionPost('type');
		
		if (!empty($email) && !preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
			$_SESSION['warning'] = "Invalid email format";
			header('location:doctor.php');
			return;
		}
		$query = "select * from doctor ";
		$where = " where username = '$username' and id != $id";
		$order = NULL;
		$db->select($query, $where, $order);
		$count = $db->countResult();
		if($count > 0){
			$_SESSION['warning'] = "Username already exists";
			header('location:doctor.php');
			return;
		}else{		
			$update_db = array( 
				'name'=>$doctor_name, 
				'email'=>$email, 
				'mobile'=>$mobile, 
				'phone'=>$phone, 
				'address'=>$address, 
				'department'=>$department,
				'specialization'=>$specialization,
				'qualificattion'=>$qualificattion,
				'username'=>$username,
				'status'=>$status,
				'type'=>$type,
				'date_updated'=>date('Y-m-d H:i:s')
			);
			$res = $db->update('doctor', $update_db, array('id'=>'id= '.$id));
			if($res) {
				$_SESSION['success'] = "Details updated successfully";
				header('location:doctor.php');
			}else {
				$_SESSION['error'] = "Error occured while updating";
				header('location:doctor.php');
			}
		}
	}else {
		$_SESSION['error'] = "Fill up all the mandatory fields";
		header('location:doctor.php');
	}
}elseif(isset($_GET['doctor_delete_id'])) {
	$fav->getDataExist('doctor_delete_id');
	if(!$fav->foundErrors()) {
		$id = $fav->preventInjuctionGet('doctor_delete_id');
		$trans_del = $db->delete("doctor", "id=".$id);				
				
		if($trans_del) {
			$_SESSION['success'] = "Doctor profile deleted successfully";
			header('location:doctor.php');
		}
		else {
			$_SESSION['error'] = "Error occured while deleting";
			header('location:doctor.php');
		} 
	}
}elseif(isset($_POST['staff_save']) && $_POST['staff_save']=='Save') {
	$fav->postDataExist('name');
	$fav->postDataExist('mobile');
	$fav->postDataExist('username');
	$fav->postDataExist('password');
	$fav->postDataExist('cpassword');
	if(!$fav->foundErrors()) {	
		require_once 'includes/functions.php';
		$functions = new GlobalFunctions();
		$doctor_name = $fav->preventInjuctionPost('name');
		$email = $fav->preventInjuctionPost('email');
		$mobile = $fav->preventInjuctionPost('mobile');
		$phone = $fav->preventInjuctionPost('phone');
		$department = $fav->preventInjuctionPost('department');
		$specialization = $fav->preventInjuctionPost('specialization');
		$qualificattion = $fav->preventInjuctionPost('qualificattion');
		$address = $fav->preventInjuctionPost('address');
		$username = $fav->preventInjuctionPost('username');
		$password = $fav->preventInjuctionPost('password');
		$cpassword = $fav->preventInjuctionPost('cpassword');
		$status = $fav->preventInjuctionPost('status');
		$type = $fav->preventInjuctionPost('type');
		
		if (!empty($email) && !preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
			$_SESSION['warning'] = "Invalid email format";
			header('location:staff.php'); 
		}elseif($password != $cpassword) {
			$_SESSION['warning'] = "Password doesn't match";
			header('location:staff.php'); 
		}
		$query = "select * from doctor ";
		$where = " where username = '$username'";
		$order = NULL;
		$db->select($query, $where, $order);
		$count = $db->countResult();
		if($count > 0){
			$_SESSION['warning'] = "Username already exists";
			header('location:staff.php');
		}else{		
			$password = $functions->generate_password($password);
			$res = $db->insert('doctor', array('', $doctor_name, $email, $mobile, $phone, $address, $department, $specialization, $qualificattion, $username, $password, $status, $type, '', date('Y-m-d H:i:s')));
			if($res) {
				$_SESSION['success'] = "Details added successfully";
				header('location:staff.php');
			}else {
				$_SESSION['error'] = "Error occured while adding";
				header('location:staff.php');
			}
		}
	}else {
		$_SESSION['error'] = "Fill up all the mandatory fields";
		header('location:staff.php');
	}
}elseif(isset($_GET['staff_edit_id'])) {
	$editid = $_GET['staff_edit_id'];
	$query = "select * from doctor ";
	$where = "where  id=".$editid;
	$order = NULL;
	$db->select($query, $where, $order);
	$count = $db->countResult();
	if($count == 1){
		$result = $db->fetchData();

?>
		<div class="mediaWrapper row-fluid">
			<form id="edit_doctor" class="stdform" method="post" enctype="multipart/form-data" action="pravega_action.php">
            	<input type="hidden" class="input-xlarge" name="id" value="<?= $result[0]['id'] ?>" />
            	<input type="hidden" class="input-xlarge" name="type" value="2" />
                <div class="par control-group">
                    <label class="control-label" for="name">Name</label>
                    <div class="controls"><input type="text" name="name" id="name" class="input-xlarge" value="<?= $result[0]['name'] ?>" /></div>
                </div>									
                <div class="par control-group">
                    <label class="control-label" for="email">Email</label>
                    <div class="controls"><input type="text" name="email" id="email" class="input-xlarge" value="<?= $result[0]['email'] ?>" /></div>
                </div>							
                <div class="par control-group">
                    <label class="control-label" for="mobile">Mobile</label>
                    <div class="controls"><input type="text" name="mobile" id="mobile" class="input-xlarge" value="<?= $result[0]['mobile'] ?>" /></div>
                </div>				
                <div class="par control-group">
                    <label class="control-label" for="mobile">Phone</label>
                    <div class="controls"><input type="text" name="phone" id="phone" class="input-xlarge" value="<?= $result[0]['phone'] ?>" /></div>
                </div>
                <div class="par control-group">
                    <label class="control-label" for="username">Username</label>
                    <div class="controls"><input type="text" name="username" id="username" class="input-xlarge" value="<?= $result[0]['username'] ?>" /></div>
                </div>
                <div class="par control-group">
                    <label class="control-label" for="status">Status</label>
                    <div class="controls">
                        <select name="status" id="status" class="input-xlarge select_list">
                            <option value="" selected="selected">Select</option>
                            <option value="1" <?php echo($result[0]['status'] == 1) ? 'selected':''; ?>>Active</option>
                            <option value="0" <?php echo($result[0]['status'] == 0) ? 'selected':''; ?>>Inactive</option>
                        </select>
                    </div>
                </div>	
                <div class="par control-group">
                    <label class="control-label" for="address">Address</label>
                    <div class="controls"><textarea cols="80" rows="5" name="address" class="input-xlarge" id="address"><?= $result[0]['address'] ?></textarea></div> 
                </div>
                                        
                <p class="stdformbutton">
                    <input type="submit" class="btn btn-primary button_save" id="staff_update" name="staff_update" value="Update">
                </p>
            </form>
		</div>
<?php 
	}
	//require 'popup.php';
}elseif(isset($_GET['staff_view_id'])) {
	$editid = $_GET['staff_view_id'];
	$query = "select * from doctor ";
	$where = "where  id=".$editid;
	$order = NULL;
	$db->select($query, $where, $order);
	$count = $db->countResult();
	if($count == 1){
		$result = $db->fetchData();
		$img = $result[0]['image'];
		if(!empty($img))
			$image = "<img src='uploads/profile/$img' />";
?> 
		<div class="mediaWrapper row-fluid">
            <table class="table table-bordered">
                <colgroup>
                    <col class="con0" />
                    <col class="con1" />
                    <col class="con0" />
                    <col class="con1" />
                    <col class="con0" />
                </colgroup>
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td><?= $result[0]['name'] ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?= $result[0]['email'] ?></td>
                    </tr>
                    <tr>
                        <td>Mobile</td>
                        <td><?= $result[0]['mobile'] ?></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td><?= $result[0]['phone'] ?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>
                        	<?= ($result[0]['status'] == 1) ? 'Active' : 'Inactive' ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><?= $result[0]['address'] ?></td>
                    </tr>
                </tbody>
            </table>
		</div>
<?php
	}else{
		echo "No record found!!!";
	}
}elseif(isset($_POST['staff_update']) && $_POST['staff_update']=='Update') {
	$fav->postDataExist('id');
	$fav->postDataExist('name');
	$fav->postDataExist('mobile');
	$fav->postDataExist('username');
	if(!$fav->foundErrors()) {	
		$id = $fav->preventInjuctionPost('id');
		$doctor_name = $fav->preventInjuctionPost('name');
		$email = $fav->preventInjuctionPost('email');
		$mobile = $fav->preventInjuctionPost('mobile');
		$phone = $fav->preventInjuctionPost('phone');
		$department = $fav->preventInjuctionPost('department');
		$specialization = $fav->preventInjuctionPost('specialization');
		$qualificattion = $fav->preventInjuctionPost('qualificattion');
		$address = $fav->preventInjuctionPost('address');
		$username = $fav->preventInjuctionPost('username');
		$status = $fav->preventInjuctionPost('status');
		$type = $fav->preventInjuctionPost('type');
		
		if (!empty($email) && !preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
			$_SESSION['warning'] = "Invalid email format";
			header('location:staff.php');
			return;
		}
		$query = "select * from doctor ";
		$where = " where username = '$username' and id != $id";
		$order = NULL;
		$db->select($query, $where, $order);
		$count = $db->countResult();
		if($count > 0){
			$_SESSION['warning'] = "Username already exists";
			header('location:staff.php');
			return;
		}else{		
			$update_db = array( 
				'name'=>$doctor_name, 
				'email'=>$email, 
				'mobile'=>$mobile, 
				'phone'=>$phone, 
				'address'=>$address, 
				'department'=>$department,
				'specialization'=>$specialization,
				'qualificattion'=>$qualificattion,
				'username'=>$username,
				'status'=>$status,
				'type'=>$type,
				'date_updated'=>date('Y-m-d H:i:s')
			);
			$res = $db->update('doctor', $update_db, array('id'=>'id= '.$id));
			if($res) {
				$_SESSION['success'] = "Details updated successfully";
				header('location:staff.php');
			}else {
				$_SESSION['error'] = "Error occured while updating";
				header('location:staff.php');
			}
		}
	}else {
		$_SESSION['error'] = "Fill up all the mandatory fields";
		header('location:staff.php');
	}
}elseif(isset($_GET['staff_delete_id'])) {
	$fav->getDataExist('staff_delete_id');
	if(!$fav->foundErrors()) {
		$id = $fav->preventInjuctionGet('staff_delete_id');
		$trans_del = $db->delete("doctor", "id=".$id);				
				
		if($trans_del) {
			$_SESSION['success'] = "Staff profile deleted successfully";
			header('location:staff.php');
		}
		else {
			$_SESSION['error'] = "Error occured while deleting";
			header('location:staff.php');
		} 
	}
}elseif(isset($_POST['case_save'])&&$_POST['case_save']=='Save') {
	$fav->postDataExist('doctor');
	$fav->postDataExist('patient');
	/*$fav->postDataExist('diseas');*/
	if(!$fav->foundErrors()) {
	    $doctor = $fav->preventInjuctionPost('doctor');
		$patient = $fav->preventInjuctionPost('patient');
		$diseas = $fav->preventInjuctionPost('diseas');
		$comments = $fav->preventInjuctionPost('comments');
		$prescription = $fav->preventInjuctionPost('prescription');
		$fee = $fav->preventInjuctionPost('fee');
		
		$check_sql = "select * from patient ";
		$where = " where admission_no = '$patient'";
		$order = NULL;		
		$check = $db->select($check_sql, $where, $order);		
		$count = $db->countResult();		
		if($count == 1) {				
			$uploader = new FileUploader();
			$attachment1 = $patient.'_1'.date("YmdHis") ;
			$att1 = $uploader->FunctionFileUploader('attachment1', $attachment1, 'uploads/records/');
			$attachment1 = $uploader->file_name;
			if(empty($attachment1))
				$attachment1 = "";
				
			$attachment2 = $patient.'_2'.date("YmdHis") ;
			$att2 = $uploader->FunctionFileUploader('attachment2', $attachment2, 'uploads/records/');
			$attachment2 = $uploader->file_name;
			if(empty($attachment2))
				$attachment2 = "";
			
			$res =$db->insert('records', array('', $doctor, $patient, $diseas, $comments, $prescription, $attachment1, $attachment2, $fee, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')));  
			if($res) {
				$_SESSION['success'] = "The records added successfully";
				header('location:case_record.php');
			}else {
				$_SESSION['error'] = "Error occured while adding";
				header('location:case_record.php');
			}
		}else{
			$_SESSION['error'] = "Patient doesn't exists";
			header('location:case_record.php');
		}
	}else {
		$_SESSION['error'] = "Fill up all the mandatory fields";
		header('location:doctor.php');
	}
}elseif(isset($_GET['case_edit_id'])) {
	$editid = $_GET['case_edit_id'];
	$query = "select r.*, d.name as doc_name, p.name as patient_name from records r left join doctor d on r.docid_ref = d.id left join patient p on r.patient_admission = p.admission_no";
    $where = " where r.id = ".$editid;	
	$order = NULL;
	$db->select($query, $where, $order);
	$count=$db->countResult();
	if($count == 1){
		$result = $db->fetchData();
		$user_id= $_SESSION['user_id'];
		$file1 = $result[0]['attachment1'];
		$file2 = $result[0]['attachment2'];
		$check_file1 = explode(".", $result[0]['attachment1']);
		$check_file2 = explode(".", $result[0]['attachment2']);
		$img_val = array('jpg', 'png', 'jpeg', 'gif');
		
		if(in_array($img_val, $check_file1))
			$attachment1 = "<img src='uploads/records/$file1' />";
		else
			$attachment1 = "<a href='uploads/records/$file1' target='_blank'>Existing Attachment1</a>";
			
		if(in_array($img_val, $check_file2))
			$attachment2 = "<img src='uploads/records/$file2' />";
		else
			$attachment2 = "<a href='uploads/records/$file2' target='_blank'>Existing Attachment2</a>";
?>        
		<div class="mediaWrapper row-fluid">
            <form id="edit_case" class="stdform" method="post" enctype="multipart/form-data" action="pravega_action.php">
            	<input type="hidden" name="id" id="id" class="input-xlarge" value="<?= $result[0]['id'] ?>" />
            	<input type="hidden" name="history" id="history" class="input-xlarge" value="<?= (isset($_GET['history'])) ? 'history' : '' ?>" />
                <div class="par control-group">
                    <label class="control-label" for="admission">Doctor</label>
                    <div class="controls">
                        <select name="doctor" id="doctor" class="input-xlarge select_list">
                            <option value="" selected="selected">Select</option>
                            <?php getDoctor($result[0]['docid_ref']); ?>
                        </select>
                    </div>
                </div>
                <div class="par control-group">
                    <label class="control-label" for="name">Patient Admission No.</label>
                    <div class="controls"><input type="text" name="patient" id="patient" class="input-xlarge" value="<?= $result[0]['patient_admission'] ?>" /></div>
                </div>									
                <div class="par control-group">
                    <label class="control-label" for="email">Diseas</label>
                    <div class="controls"><textarea cols="80" rows="5" name="diseas" class="input-xlarge" id="diseas"><?= $result[0]['diseas'] ?></textarea></div>
                </div>							
                <div class="par control-group">
                    <label class="control-label" for="mobile">Comments (if any)</label>
                    <div class="controls"><textarea cols="80" rows="5" name="comments" class="input-xlarge" id="comments"><?= $result[0]['comments'] ?></textarea></div>
                </div>							
                <div class="par control-group">
                    <label class="control-label" for="mobile">Prescription</label>
                    <div class="controls"><textarea cols="80" rows="5" name="prescription" class="input-xlarge" id="prescription"><?= $result[0]['prescription'] ?></textarea></div>
                </div>	
                <div class="par control-group">
                    <label class="control-label" for="photo">Attachment1 (if any)</label>				
                    <div class="controls"><input type="file" class="uniform-file" name="attachment1" /> <?= !empty($file1) ? $attachment1 : '' ?></div>
                </div>			
                <div class="par control-group">
                    <label class="control-label" for="age">Attachment2 (if any)</label>
                    <div class="controls"><input type="file" class="uniform-file" name="attachment2" /> <?= !empty($file2) ? $attachment2 : '' ?></div>
                </div>									
                <div class="par control-group">
                    <label class="control-label" for="gender">Consulting Fee</label>
                    <div class="controls">
                        <select name="fee" id="fee" class="input-xlarge select_list">
                            <option value="">Select</option>
                            <option value="1" <?php echo($result[0]['fee'] == 1) ? 'selected':''; ?>>Paid</option>
                            <option value="0" <?php echo($result[0]['fee'] == 0) ? 'selected':''; ?>>Unpaid</option>
                        </select>
                    </div>
                </div>
                <p class="stdformbutton">
                    <input type="submit" class="btn btn-primary button_save" name="case_update" value="Update">
                </p>
            </form>
		</div>
<?php }else{
		echo "No record found!!!";
	}
	//require 'popup.php';
}elseif(isset($_GET['case_view_id'])) {
	$editid = $_GET['case_view_id'];
	$query = "select r.*, d.name as doc_name, p.name as patient_name from records r left join doctor d on r.docid_ref = d.id left join patient p on r.patient_admission = p.admission_no";
    $where = " where r.id = ".$editid;	
	$order = NULL;
	$db->select($query, $where, $order);
	$count=$db->countResult();
	if($count == 1){
		$result = $db->fetchData();
		$user_id= $_SESSION['user_id'];
		$file1 = $result[0]['attachment1'];
		$file2 = $result[0]['attachment2'];
		$check_file1 = explode(".", $result[0]['attachment1']);
		$check_file2 = explode(".", $result[0]['attachment2']);
		$img_val = array('jpg', 'png', 'jpeg', 'gif');
		
		if(in_array($img_val, $check_file1))
			$attachment1 = "<img src='uploads/records/$file1' />";
		else
			$attachment1 = "<a href='uploads/records/$file1' target='_blank'>Existing Attachment1</a>";
			
		if(in_array($img_val, $check_file2))
			$attachment2 = "<img src='uploads/records/$file2' />";
		else
			$attachment2 = "<a href='uploads/records/$file2' target='_blank'>Existing Attachment2</a>";
?> 
		<div class="mediaWrapper row-fluid">
            <table class="table table-bordered">
                <colgroup>
                    <col class="con0" />
                    <col class="con1" />
                    <col class="con0" />
                    <col class="con1" />
                    <col class="con0" />
                </colgroup>
                <tbody>
                    <tr>
                        <td>Doctor</td>
                        <td><?= $result[0]['doc_name'] ?></td>
                    </tr>
                    <tr>
                        <td>Patient</td>
                        <td><?= $result[0]['patient_name'] ?></td>
                    </tr>
                    <tr>
                        <td>Admission no.</td>
                        <td><?= $result[0]['patient_admission'] ?></td>
                    </tr>
                    <tr>
                        <td>Diseas</td>
                        <td><?= $result[0]['diseas'] ?></td>
                    </tr>
                    <tr>
                        <td>Comments</td>
                        <td><?= $result[0]['comments'] ?></td>
                    </tr>
                    <tr>
                        <td>Prescription</td>
                        <td><?= $result[0]['prescription'] ?></td>
                    </tr>
                    <tr>
                        <td>Attachment1</td>
                        <td><?= !empty($file1) ? $attachment1 : '' ?></td>
                    </tr>
                    <tr>
                        <td>Attachment2</td>
                        <td><?= !empty($file2) ? $attachment2 : '' ?></td>
                    </tr>
                    <tr>
                        <td>Consulting Fee</td>
                        <td>
                        	<?= ($result[0]['fee'] == 1)? 'Paid' : 'Unpaid'; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
		</div>
<?php
	}else{
		echo "No record found!!!";
	}
}elseif(isset($_POST['case_update'])&&$_POST['case_update']=='Update') {
	$fav->postDataExist('doctor');
	$fav->postDataExist('patient');
	/*$fav->postDataExist('diseas');*/
	if(!$fav->foundErrors()) {
	    $id = $fav->preventInjuctionPost('id');
	    $doctor = $fav->preventInjuctionPost('doctor');
		$patient = $fav->preventInjuctionPost('patient');
		$diseas = $fav->preventInjuctionPost('diseas');
		$comments = $fav->preventInjuctionPost('comments');
		$prescription = $fav->preventInjuctionPost('prescription');
		$fee = $fav->preventInjuctionPost('fee');
		$history = $fav->preventInjuctionPost('history');
		$url = !empty($history) ? 'patient_history.php?admission='.$patient : 'case_record.php';
		
		$check_sql = "select * from patient ";
		$where = " where admission_no = '$patient'";
		$order = NULL;		
		$check = $db->select($check_sql, $where, $order);		
		$count = $db->countResult();		
		if($count == 1) {				
			$uploader = new FileUploader();
			$attachment1 = $patient.'_1'.date("YmdHis") ;
			$att1 = $uploader->FunctionFileUploader('attachment1', $attachment1, 'uploads/records/');
			$attachment1 = $uploader->file_name;
			if(empty($attachment1))
				$attachment1 = "";
				
			$attachment2 = $patient.'_2'.date("YmdHis") ;
			$att2 = $uploader->FunctionFileUploader('attachment2', $attachment2, 'uploads/records/');
			$attachment2 = $uploader->file_name;
			if(empty($attachment2))
				$attachment2 = "";
			
			$update_db = array( 
				'docid_ref'=>$doctor, 
				'patient_admission'=>$patient, 
				'diseas'=>$diseas, 
				'comments'=>$comments, 
				'prescription'=>$prescription,
				'fee'=>$fee,
				'date_updated'=>date('Y-m-d H:i:s')
			);
			if(!empty($attachment1))
				$update_db['attachment1'] = $attachment1;
			if(!empty($attachment2))
				$update_db['attachment2'] = $attachment2;
				
			$res = $db->update('records', $update_db, array('id'=>'id= '.$id));
			if($res) {
				$_SESSION['success'] = "The records updated successfully";
				header('location:'.$url);
			}else {
				$_SESSION['error'] = "Error occured while updating";
				header('location:'.$url);
			}
		}else{
			$_SESSION['error'] = "Patient doesn't exists";
			header('location:'.$url);
		}
	}else {
		$_SESSION['error'] = "Fill up all the mandatory fields";
		header('location:'.$url);
	}
}elseif(isset($_GET['case_delete_id'])) {
	$fav->getDataExist('case_delete_id');
	if(!$fav->foundErrors()) {
		$id = $fav->preventInjuctionGet('case_delete_id');
		$trans_del = $db->delete("records", "id=".$id);
		$url = (isset($_GET['history']) && !empty($_GET['history'])) ? 'patient_history.php?admission='.$_GET['history'] : 'case_record.php';
		if($trans_del) {
			/*$check_sql = "select * from medicine ";
			$where = " where caseid_ref = '$id'";
			$order = NULL;		
			$check = $db->select($check_sql, $where, $order);		
			$count = $db->countResult();		
			if($count>0) {
				$result = $db->fetchData();
				$no=0;
				for ($x = 0; $x < count($result); $x++){
					$get_quantity = $result[$x]['quantity'];
					$get_product_id = $result[$x]['productid_ref'];
					$res = mysql_query("update products set stock_count = stock_count+'$get_quantity' where id='$get_product_id'") or die(mysql_error()); 
				}
			}*/
			$trans_del = $db->delete("medicine", "caseid_ref=".$id);
			if($trans_del) {
				$_SESSION['success'] = "Records deleted successfully";
				header('location:'.$url);
			}
			else {
				$_SESSION['error'] = "Error occured while deleting";
				header('location:'.$url);
			} 
		}
	}
}elseif(isset($_GET['case_medicine_id'])) {
	$editid = $_GET['case_medicine_id'];
	
	$check_sql="select * from records ";
	$where = " where id = '$editid'";
	$order = NULL;		
	$check=$db->select($check_sql, $where, $order);		
	$count=$db->countResult();
	$result = $db->fetchData();
	$patient_admission = $result[0]['patient_admission'];
	
	$check_sql="select m.*,p.name,p.stock_count,p.stock_type,p.rack from medicine m left join products p on m.productid_ref = p.id ";
	$where = " where m.caseid_ref = '$editid'";
	$order = NULL;		
	$check=$db->select($check_sql, $where, $order);		
	$count=$db->countResult();
	$total = 0;
	$stock_type = unserialize(stock_type); 
	?>
        <div class="mediaWrapper row-fluid" style="height:600px;">
            <form id="edit_case" class="stdform" method="post" enctype="multipart/form-data" action="pravega_action.php">
            	<input type="hidden" name="case_id" id="case_id" class="input-xlarge" value="<?= $editid ?>" />
            	<input type="hidden" name="patient_admission" id="patient_admission" class="input-xlarge" value="<?= $patient_admission ?>" />
            	<input type="hidden" name="history" id="history" class="input-xlarge" value="<?= (isset($_GET['history'])) ? 'history' : '' ?>" />
                <table class="table table-bordered" id="order_edit_add">
                    <colgroup>
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                    </colgroup>
                    <tbody>
                        <tr>
                            <th width="270">Product</th>
                            <th>Availability</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        <?php
							if($count >= 1){
								$result = $db->fetchData();
								$product_no = 1;
								for ($x = 0; $x < count($result); $x++){
									$total = $total + $result[$x]['price'];
									$stock_count = $result[$x]['stock_count'];
									$stock_value = $stock_type[$result[$x]['stock_type']];
						?>
                            <tr id="product_item_<?= $product_no ?>">
                                <td>
                                    <select id="select_<?= $product_no ?>" product_val="<?= $product_no ?>" name="order_id[]" data-placeholder="Select product" style="width:254px" id="" class="chzn-select get_products" tabindex="2">
                                        <option value=""></option> 
                                        <?php getProducts($result[$x]['productid_ref'], $stock_type) ?>
                                    </select>
                                    <!--<input type="hidden" name="order_id[]" id="select_<?= $product_no ?>" class="input-mini" value="<?= $result[$x]['productid_ref'] ?>" />-->
                                </td>
                                <td>
                                	<span id="available_<?= $product_no ?>">
                                    	Stock Availability - <?= $stock_count.' '.$stock_value ?><br />
                                        Product Rack - <?= $result[$x]['rack'] ?>
                                    </span>
                                </td>
                                <td><input type="text" name="quantity[]" id="quantity_<?= $product_no ?>" class="input-mini" value="<?= $result[$x]['quantity'] ?>" /></td>
                                <td><input type="text" name="price[]" product_id_val="<?= $product_no ?>" id="price_<?= $product_no ?>" class="input-mini get_price" value="<?= $result[$x]['price'] ?>" /></td>
                                <td><a href="javascript:void(0)" product_id="<?= $product_no ?>" row_id="product_item_<?= $product_no ?>" class="admin_product_remove">Remove</a></td>
                            </tr>
                        <?php $product_no++; }}else{ ?>
                            <tr id="product_item_1">
                                <td>
                                    <select id="select_1" product_val="1" data-placeholder="Select product" name="order_id[]" style="width:254px" id="" class="chzn-select get_products" tabindex="2">
                                        <option value=""></option> 
                                        <?php getProducts('', $stock_type) ?>
                                    </select>
                                </td>
                                <td><span id="available_1"></td>
                                <td><input type="text" name="quantity[]" id="quantity_1" class="input-mini" /></td>
                                <td><input type="text" name="price[]" product_id_val="1" id="price_1" class="input-mini get_price" /></td>
                                <td></td>
                            </tr>
                        <?php } ?>
              		</tbody>
              	</table>
                <table class="table table-bordered">  
                	<tbody>    
                        <tr>
                        	<td width="270">
                            <input type="hidden" class="order_edit" id="new_product_id" name="new_product_id" value="1000" />
                            <input type="button" class="btn btn-primary button_save" name="medicine_add" id="medicine_add" value="Add Medicine"></td>
                    		<td width="82"><input type="submit" class="btn btn-primary button_save" name="medicine_update" value="Update"></td>
                    		<td><strong>Total - </strong><span class="total_price"><?= $total ?></span></td>
                        </tr>
                    </tbody>
            	</table>
            </form>
		</div>
<?php
	//require 'popup.php';
}elseif(isset($_POST['next_product_id'])) {
	$next_medicine_id = $_POST['next_product_id'];
	$stock_type = unserialize(stock_type); 
?>
	<tr id="product_item_<?= $next_medicine_id ?>">
		<td>
            <select id="select_<?= $next_medicine_id ?>" product_val="<?= $next_medicine_id ?>" data-placeholder="Select product" name="order_id[]" style="width:254px" class="chzn-select get_products" tabindex="2">
                <option value=""></option> 
                <?php getProducts('', $stock_type) ?>
            </select>
		</td>
		<td><span id="available_<?= $next_medicine_id ?>"></span></td>
		<td><input type="text" product_id_val="<?= $next_medicine_id ?>" id="quantity_<?= $next_medicine_id ?>" name="quantity[]" class="input-mini" /></td>
		<td><input type="text" product_id_val="<?= $next_medicine_id ?>" id="price_<?= $next_medicine_id ?>" name="price[]" class="input-mini get_price" /></td>
		<td><a href="javascript:void(0)" product_id="<?= $next_medicine_id ?>" row_id="product_item_<?= $next_medicine_id ?>" class="admin_product_remove">Remove</a></td>
	</tr>
<?php
}elseif(isset($_POST['medicine_update']) && $_POST['medicine_update']=='Update') {
	$fav->postDataExist('case_id');
	if(!$fav->foundErrors()) {
		$case_id = $fav->preventInjuctionPost('case_id');
		$patient_admission = $fav->preventInjuctionPost('patient_admission');
		$date = date('Y-m-d H:i:s');
		$order_total = !empty($order_total) ? $order_total : 0;
		$order_id = $_POST['order_id'];
		$history = $fav->preventInjuctionPost('history');
		$url = !empty($history) ? 'patient_history.php?admission='.$patient_admission : 'case_record.php';
		if(!empty($order_id)){
			$quantity = $_POST['quantity'];
			$price = $_POST['price'];
			
			$check_sql = "select * from medicine ";
			$where = " where caseid_ref = '$case_id'";
			$order = NULL;		
			$check = $db->select($check_sql, $where, $order);		
			$count = $db->countResult();		
			if($count>0) {
				$result = $db->fetchData();
				$no=0;
				for ($x = 0; $x < count($result); $x++){
					$get_quantity = $result[$x]['quantity'];
					$get_product_id = $result[$x]['productid_ref'];
					$res = mysql_query("update products set stock_count = stock_count+'$get_quantity' where id='$get_product_id'") or die(mysql_error()); 
				}
			}
			
			$trans_del = $db->delete("medicine", "caseid_ref=".$case_id);
			if($trans_del) { 
				$table = 'medicine';
				$info = array( 
					'caseid_ref'=>$case_id,
					'patient_admission'=>$patient_admission, 
					'date_created'=>date('Y-m-d H:i:s'),
					'date_updated'=>date('Y-m-d H:i:s')
				);
				for($i = 0; $i < count($order_id); $i++){
					$info['productid_ref'] = $order_id[$i];
					$info['quantity'] = $quantity[$i];
					$info['price'] = $price[$i];
					$new_quantity = $quantity[$i];
					$new_product = $order_id[$i];
					$res = mysql_query("update products set stock_count = stock_count-'$new_quantity' where id='$new_product'") or die(mysql_error());
					$id = insert($info, $table);
				}			
				if($id) {
					$_SESSION['success'] = "Medicine details updated successfully";
					header('location:'.$url);
				}else {
					$_SESSION['error'] = "Error occured while updating medicine details";
					header('location:'.$url);
				}
			}else{
				$_SESSION['error'] = "Error occured while updating medicine details";
				header('location:'.$url);
			}
		}else{
			$_SESSION['error'] = "Error occured while updating medicine details";
			header('location:'.$url);
		}
	}else {
		$_SESSION['error'] = "Case ID is missing";
		header('location:'.$url);
	}
}elseif(isset($_GET['case_vmedicine_id'])) {
	$editid = $_GET['case_vmedicine_id'];
	
	$check_sql = "select * from records ";
	$where = " where id = '$editid'";
	$order = NULL;		
	$check = $db->select($check_sql, $where, $order);		
	$count = $db->countResult();
	$result = $db->fetchData();
	$patient_admission = $result[0]['patient_admission'];
	
	$check_sql = "select m.*, p.name from medicine m left join products p on  m.productid_ref = p.id";
	$where = " where caseid_ref = '$editid'";
	$order = NULL;		
	$check = $db->select($check_sql, $where, $order);		
	$count = $db->countResult();
	$total = 0;
	?>
        <div class="mediaWrapper row-fluid" style="height:600px;">
                <table class="table table-bordered" id="order_edit_add">
                    <colgroup>
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                    </colgroup>
                    <tbody>
                        <tr>
                            <th width="270">Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                        <?php
							if($count >= 1){
								$result = $db->fetchData();
								$product_no = 1;
								for ($x = 0; $x < count($result); $x++){
									$total = $total + $result[$x]['price'];
						?>
                            <tr>
                                <td><?= $result[$x]['name'] ?></td>
                                <td><?= $result[$x]['quantity'] ?></td>
                                <td><?= $result[$x]['price'] ?></td>
                            </tr>
                        <?php $product_no++; } ?>
                            <tr>
                                <td colspan="2" style="text-align:right"><strong>Total</strong></td>
                                <td><strong><?= $total ?></strong></td>
                            </tr>
                        <?php }else{ ?>
                            <tr>
                                <td colspan="3">No records found</td>
                            </tr>
                        <?php } ?>
              		</tbody>
              	</table>
		</div>
<?php
	//require 'popup.php';
}elseif(isset($_POST['product_save'])&&$_POST['product_save']=='Save') {
	$fav->postDataExist('name');
	$fav->postDataExist('stock_count');
	$fav->postDataExist('stock_type');
	$fav->postDataExist('min_count');
	$fav->postDataExist('price');
	if(!$fav->foundErrors()) {
		$name = $fav->preventInjuctionPost('name');
		$check_sql = "select * from products ";
		$where = " where name = '$name'";
		$order = NULL;		
		$check = $db->select($check_sql, $where, $order);		
		$count = $db->countResult();		
		if($count>0) {
			$_SESSION['warning'] = "Product name exists";
			header('location:products.php');
		}else {
			$stock_count = $fav->preventInjuctionPost('stock_count');
			$stock_type = $fav->preventInjuctionPost('stock_type');
			$min_count = $fav->preventInjuctionPost('min_count');
			$price = $fav->preventInjuctionPost('price');
			$status = $fav->preventInjuctionPost('status');
			$rack = $fav->preventInjuctionPost('rack');
			$table = 'products';
			$info = array( 
				'name'=>$name, 
				'stock_type'=>$stock_type, 
				'stock_count'=>$stock_count, 
				'min_count'=>$min_count, 
				'price'=>$price, 
				'rack'=>$rack,
				'status'=>$status,
				'date_created'=>date('Y-m-d H:i:s'),
				'date_updated'=>''
			);
			$id = insert($info, $table);
			if($id) {
				$_SESSION['success'] = "Details added successfully";
				header('location:products.php');
			}else {
				$_SESSION['error'] = "Error occured while adding";
				header('location:products.php');
			}
		}
	}else {
		$_SESSION['error'] = "Fill up all the mandatory fields";
		header('location:patient.php');
	}
}elseif(isset($_GET['product_edit_id'])) {
	$stock_type = unserialize(stock_type);
	$editid = $_GET['product_edit_id'];
	$query = "select * from products ";
	$where = "where  id=".$editid;
	$order = NULL;
	$db->select($query, $where, $order);
	$count = $db->countResult();
	if($count == 1){
		$result = $db->fetchData();
?>
		<div class="mediaWrapper row-fluid">
			<form id="edit_products" class="stdform" method="post" enctype="multipart/form-data" action="pravega_action.php">
            	<input type="hidden" class="input-xlarge" name="id" value="<?= $result[0]['id'] ?>" />
                <div class="par control-group">
                    <label class="control-label" for="admission">Name</label>
                    <div class="controls"><input type="text" name="name" id="name" class="input-xlarge" value="<?= $result[0]['name'] ?>" /></div>
                </div>									
                <div class="par control-group">
                    <label class="control-label" for="status">Stock Type</label>
                    <div class="controls">
                        <select name="stock_type" id="stock_type" class="input-xlarge select_list">
                            <option value="">Select</option>
							<?php
                                foreach($stock_type as $value => $stock){
                            ?>
                                <option value="<?= $value ?>" <?php echo($result[0]['stock_type'] == $value) ? 'selected':''; ?>><?= $stock ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>						
                <div class="par control-group">
                    <label class="control-label" for="email">Stock Count</label>
                    <div class="controls"><input type="text" name="stock_count" id="stock_count" class="input-xlarge" value="<?= $result[0]['stock_count'] ?>" /></div>
                </div>							
                <div class="par control-group">
                    <label class="control-label" for="mobile">Min Stock Count</label>
                    <div class="controls"><input type="text" name="min_count" id="min_count" class="input-xlarge" value="<?= $result[0]['min_count'] ?>" /></div>
                </div>	
                <div class="par control-group">
                    <label class="control-label" for="photo">Price</label>				
                    <div class="controls"><input type="text" name="price" id="price" class="input-xlarge" value="<?= $result[0]['price'] ?>" /></div>
                </div>	
                <div class="par control-group">
                    <label class="control-label" for="rack">Rack</label>				
                    <div class="controls"><input type="text" name="rack" id="rack" class="input-xlarge" value="<?= $result[0]['rack'] ?>" /></div>
                </div>							
                <div class="par control-group">
                    <label class="control-label" for="status">Status</label>
                    <div class="controls">
                        <select name="status" id="status" class="input-xlarge select_list">
                            <option value="">Select</option>
                            <option value="1" <?php echo($result[0]['status'] == 1) ? 'selected':''; ?>>Active</option>
                            <option value="0" <?php echo($result[0]['status'] == 0) ? 'selected':''; ?>>Inactive</option>
                        </select>
                    </div>
                </div>
                                        
                <p class="stdformbutton">
                    <input type="submit" class="btn btn-primary button_save" name="product_update" value="Update">
                </p>
            </form>
		</div>
<?php 
	}
	//require 'popup.php';
}elseif(isset($_GET['product_view_id'])) {
	$editid = $_GET['product_view_id'];
	$query = "select * from products";
    $where = " where id = ".$editid;	
	$order = NULL;
	$db->select($query, $where, $order);
	$count=$db->countResult();
	$stock_type = unserialize(stock_type);
	if($count == 1){
		$result = $db->fetchData();
		$stock = $result[0]['stock_type'];
?> 
		<div class="mediaWrapper row-fluid">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td><?= $result[0]['name'] ?></td>
                    </tr>
                    <tr>
                        <td>Stock Type</td>
                        <td><?= $stock_type[$stock] ?></td>
                    </tr>
                    <tr>
                        <td>Stock Count</td>
                        <td><?= $result[0]['stock_count'] ?></td>
                    </tr>
                    <tr>
                        <td>Min Stock Count</td>
                        <td><?= $result[0]['min_count'] ?></td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td><?= $result[0]['price'] ?></td>
                    </tr>
                    <tr>
                        <td>Rack</td>
                        <td><?= $result[0]['rack'] ?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td><?= ($result[0]['status'] == 1) ? 'Active' : 'Inactive' ?></td>
                    </tr>
                </tbody>
            </table>
		</div>
<?php
	}else{
		echo "No record found!!!";
	}
}elseif(isset($_POST['product_update']) && $_POST['product_update']=='Update') {
	$fav->postDataExist('id');
	$fav->postDataExist('name');
	$fav->postDataExist('stock_count');
	$fav->postDataExist('stock_type');
	$fav->postDataExist('min_count');
	$fav->postDataExist('price');
	if(!$fav->foundErrors()) {
		$id = $fav->preventInjuctionPost('id');
		$name = $fav->preventInjuctionPost('name');
		$check_sql = "select * from products ";
		$where = " where name = '$name' and id!=$id";
		$order = NULL;		
		$check = $db->select($check_sql, $where, $order);		
		$count = $db->countResult();		
		if($count>0) {
			$_SESSION['warning'] = "Product name exists";
			header('location:products.php');
		}else {
			$stock_count = $fav->preventInjuctionPost('stock_count');
			$stock_type = $fav->preventInjuctionPost('stock_type');
			$min_count = $fav->preventInjuctionPost('min_count');
			$price = $fav->preventInjuctionPost('price');
			$status = $fav->preventInjuctionPost('status');
			$rack = $fav->preventInjuctionPost('rack');
			$update_db = array( 
				'name'=>$name, 
				'stock_type'=>$stock_type, 
				'stock_count'=>$stock_count, 
				'min_count'=>$min_count, 
				'rack'=>$rack,
				'price'=>$price, 
				'status'=>$status,
				'date_updated'=>date('Y-m-d H:i:s')
			);
			$res = $db->update('products', $update_db, array('id'=>'id= '.$id));
			if($res) {
				$_SESSION['success'] = "Details updated successfully";
				header('location:products.php');
			}else {
				$_SESSION['error'] = "Error occured while updating";
				header('location:products.php');
			}
		}
	}else {
		$_SESSION['error'] = "Fill up all the mandatory fields";
		header('location:products.php');
	}
}elseif(isset($_GET['product_delete_id'])) {
	$fav->getDataExist('product_delete_id');
	if(!$fav->foundErrors()) {
		$id = $fav->preventInjuctionGet('product_delete_id');
		$trans_del = $db->delete("products", "id=".$id);				
				
		if($trans_del) {
			$_SESSION['success'] = "Product deleted successfully";
			header('location:products.php');
		}
		else {
			$_SESSION['error'] = "Error occured while deleting";
			header('location:products.php');
		} 
	}
}elseif(isset($_GET['password'])) {
?>
	<div class="mediaWrapper row-fluid">
		<form id="password_edit" class="stdform" method="post" enctype="multipart/form-data" action="pravega_action.php">
			<input type="hidden" class="input-xlarge" name="id" value="<?= $_SESSION['user_id'] ?>" />
			<div class="par control-group">
				<label class="control-label" for="admission">Current Password</label>
				<div class="controls"><input type="password" class="input-xlarge" name="current_pass" id="current_pass" /></div>
			</div>									
			<div class="par control-group">
				<label class="control-label" for="status">Password</label>
				<div class="controls"><input type="password" class="input-xlarge" name="password" id="password" /></div>
			</div>						
			<div class="par control-group">
				<label class="control-label" for="email">Confirm Password</label>
				<div class="controls"><input type="password" class="input-xlarge" name="cpassword" id="cpassword" /></div>
			</div>
									
			<p class="stdformbutton">
				<input type="submit" class="btn btn-primary button_save" name="password_update" value="Update">
                <button class="btn btn-primary" type="reset">Cancel</button>
			</p>
		</form>
	</div>
<?php
	//require 'popup.php';
}elseif(isset($_POST['password_update']) && $_POST['password_update']=='Update') {
	$fav->postDataExist('id');
	$fav->postDataExist('current_pass');
	$fav->postDataExist('password');
	$fav->postDataExist('cpassword');
	if(!$fav->foundErrors()) {
		$id = $fav->preventInjuctionPost('id');
		$current_password = $fav->preventInjuctionPost('current_pass');
		$password = $fav->preventInjuctionPost('password');
		$cpassword = $fav->preventInjuctionPost('cpassword');
		if($password != $cpassword) {
			$_SESSION['warning'] = "Password doesn't match";
			header('location:dashboard.php');
		}
		require_once 'includes/functions.php';
		$functions = new GlobalFunctions();
		$current_password = $functions->generate_password($current_password);
		$password = $functions->generate_password($password);
		$check_sql="select * from admin ";
		$where =" where password = '$current_password' and id='$id'";
		$order = NULL;
		$check=$db->select($check_sql, $where, $order);		
		$count=$db->countResult();
		if($count == 1) {
			$res =$db->update('admin',array('password'=>$password),array('id'=>'id= '.$id)); 					
			if($res) {
				$_SESSION['success'] = "Your password has been updated successfully";
				header('location:dashboard.php');
			}else {
				$_SESSION['error'] = "Error occured while updating";
				header('location:dashboard.php');
			}
		}else {
			$_SESSION['error'] = "Current Password provided is wrong";
			header('location:dashboard.php');
		}
	}else{
		$_SESSION['error'] = "Fill up the mandatory fields";
		header('location:dashboard.php');
	}
}elseif(isset($_POST['get_login']) && $_POST['get_login']=='LOGIN') {
	$fav->postDataExist('username');
	$fav->postDataExist('password');
	if(!$fav->foundErrors()) {
		require_once 'includes/functions.php';
		$functions = new GlobalFunctions();
		$username = $fav->preventInjuctionPost('username');
		$password = $fav->preventInjuctionPost('password');
		$password = $functions->generate_password($password);
		$check_sql = "select * from admin ";
		$where = " where username='$username' and password='$password'";
		$order = NULL;		
		$check = $db->select($check_sql, $where, $order);
		$count = $db->countResult();
		if($count == 1) {
			$result = $db->fetchData();
			$_SESSION['user'] = $result[0]['username'];
			$_SESSION['username'] = $result[0]['username'];
			$_SESSION['user_id'] = $result[0]['id'];
			$_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
			
			$_SESSION['success'] = "You are successfully logged in";
			header('location:dashboard.php');
		}else {
			$_SESSION['error'] = "Either Username / Password is incorrect";
			header('location:index.php');
		}
	}else {
		$_SESSION['error'] = "Fill up the mandatory fields";
		header('location:index.php');
	}
}elseif(isset($_POST['permission_save'])&&$_POST['permission_save']=='Save') {
	$fav->postDataExist('permission');
	$fav->postDataExist('staff');
	if(!$fav->foundErrors()) {
		$staff = $fav->preventInjuctionPost('staff');
		$permission = $_POST['permission'];
		$permissions = implode(',', $permission);
		$check_sql = "select * from permissions ";
		$where = " where empid_ref = '$staff'";
		$order = NULL;		
		$check = $db->select($check_sql, $where, $order);		
		$count = $db->countResult();		
		if($count > 0) {
			$_SESSION['warning'] = "Staff permissions already added";
			header('location:permissions.php');
		}else {
			$table = 'permissions';
			$info = array( 
				'empid_ref'=>$staff, 
				'permissions'=>$permissions,
				'date_updated'=>date('Y-m-d H:i:s')
			);
			$id = insert($info, $table);
			if($id) {
				$_SESSION['success'] = "Pemissions added successfully";
				header('location:permissions.php');
			}else {
				$_SESSION['error'] = "Error occured while adding";
				header('location:permissions.php');
			}
		}
	}else {
		$_SESSION['error'] = "Fill up all the mandatory fields";
		header('location:permissions.php');
	}
}elseif(isset($_GET['permission_edit_id'])) {
	$permissions = unserialize(permissions);
	$editid = $_GET['permission_edit_id'];
	$query = "select p.*, d.name from permissions p left join doctor d on p.empid_ref = d.id ";
	$where = "where p.id = ".$editid;
	$order = NULL;
	$db->select($query, $where, $order);
	$count = $db->countResult();
	if($count == 1){
		$result = $db->fetchData();
		$get_permissions = $result[0]['permissions'];
		$get_permissions = explode(",", $get_permissions);
?>
		<div class="mediaWrapper row-fluid">
            <form id="add_permission" class="stdform" method="post" enctype="multipart/form-data" action="pravega_action.php">
				<input type="hidden" class="input-xlarge" name="id" value="<?= $result[0]['id'] ?>" />
                <div class="par control-group">
                    <label class="control-label" for="staff"></label>
                    <div class="controls">Name : <strong><?= $result[0]['name'] ?></strong></div>
                </div>
                <table class="table table-bordered">
                    <colgroup>
                        <col class="con0" style="align: center; width: 4%" />
                        <col class="con1" />
                        <col class="con0" />
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="head0 nosort">No.</th>
                            <th class="head1">Role</th>
                            <th class="head0">Permissions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $permissions = unserialize(permissions);
                        $count = 1;
                        foreach($permissions as $id => $permission){
                    ?>
                        <tr>
                            <td class="center"><?= $count ?></td>
                            <td class="center"><?= $permission ?></td>
                            <td class="aligncenter"><span class="center">
                            	<input type="checkbox" name="permission[]" value="<?= $id ?>" <?= (in_array($id, $get_permissions)) ? 'checked' : '' ?> />
                            </span></td>
                        </tr>
                    <?php $count++; } ?>
                        <tr>
                            <td class="center" colspan="3"><input type="submit" class="btn btn-primary button_save" name="permission_update" value="Update"></td>
                        </tr>
                    </tbody>
                </table>
            </form>
<?php 
	}else {
		echo "No result found !!!";
	} 
	//require 'popup.php';
}elseif(isset($_POST['permission_update'])&&$_POST['permission_update']=='Update') {
	$fav->postDataExist('id');
	$fav->postDataExist('permission');
	if(!$fav->foundErrors()) {
		$id = $fav->preventInjuctionPost('id');
		$permission = $_POST['permission'];
		$permissions = implode(',', $permission);
		$update_db = array( 
			'permissions'=>$permissions,
			'date_updated'=>date('Y-m-d H:i:s')
		);
		$res = $db->update('permissions', $update_db, array('id'=>'id= '.$id));
		if($res){
			$_SESSION['success'] = "Pemissions updated successfully";
			header('location:permissions.php');
		}else{
			$_SESSION['error'] = "Error occured while updating";
			header('location:permissions.php');
		}
	}else {
		$_SESSION['error'] = "Fill up all the mandatory fields";
		header('location:permissions.php');
	}
}elseif(isset($_GET['permission_delete_id'])) {
	$fav->getDataExist('permission_delete_id');
	if(!$fav->foundErrors()) {
		$id = $fav->preventInjuctionGet('permission_delete_id');
		$trans_del = $db->delete("permissions", "id=".$id);				
				
		if($trans_del) {
			$_SESSION['success'] = "Permissions deleted successfully";
			header('location:permissions.php');
		}
		else {
			$_SESSION['error'] = "Error occured while deleting";
			header('location:permissions.php');
		} 
	}
}elseif(isset($_GET['event_delete_id'])) {
	$fav->getDataExist('event_delete_id');
	if(!$fav->foundErrors()) {
		$remove_event = $_GET['event_delete_id'];
		$events = unserialize(events);
		if(!isset($events[$remove_event])) {
			$_SESSION['warning'] = "Event doesn't exists";
			header('location:single_events.php');
		}
		
		$trans_del=$db->delete("participants", "id=".$remove_event);
		if($trans_del) {
			$_SESSION['success'] = "Event removed successfully";
			header('location:single_events.php');
		}else {
			$_SESSION['error'] = "Error occured while deleting";
			header('location:single_events.php');
		} 
	}else{
		$_SESSION['error'] = "Error occured while deleting";
		header('location:single_events.php');
	}
}elseif(isset($_GET['group_event_delete_id'])) {
	$fav->getDataExist('group_event_delete_id');
	if(!$fav->foundErrors()) {
		$remove_event = $_GET['group_event_delete_id'];
		$events = unserialize(group_events);
		if(!isset($events[$remove_event])) {
			$_SESSION['warning'] = "Event doesn't exists";
			header('location:group_events.php');
		}
		
		$trans_del=$db->delete("participants", "id=".$remove_event);
		if($trans_del) {
			$_SESSION['success'] = "Event removed successfully";
			header('location:group_events.php');
		}else {
			$_SESSION['error'] = "Error occured while deleting";
			header('location:group_events.php');
		} 
	}else{
		$_SESSION['error'] = "Error occured while deleting";
		header('location:group_events.php');
	}
}
ob_end_flush();
?>
   