<?php 
	include 'config.php';
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	if (isset($_REQUEST['login'])) {
	    $username = $_REQUEST['username'];
	    $pass = $_REQUEST['password'];
	    if ($username == "admin@admin.com" && $pass == "admin@123") {
	        session_start();
	        $_SESSION['User']['id'] = "admin";
	        $_SESSION['User']['name'] = "Admin";
	        header("location:index.php");
	        exit();
	    } else {
	        $sql = "SELECT * FROM employee WHERE name='" . $username . "' and pass='" . $pass . "'";

	        $result = $conn->query($sql);
	        $user_detail = mysqli_fetch_assoc($result);
	        $count = $result->num_rows;
	        if ($count == 1) {
	            session_start();
	            $_SESSION['User'] = $user_detail;
	            header("location:index.php");
	        } else {
	            header("location:login.php");
	        }
	    }
	}
	if(isset($_REQUEST['add_medicine'])){
		$Json =array();
		$medicine_name = addslashes($_REQUEST['medicine_name_txt']);
		$medicine_company = addslashes($_REQUEST['medicine_company_name_txt']);
		$medicine_code = addslashes($_REQUEST['medicine_code_txt']);
		$medicine_amount = $_REQUEST['medicine_amount_txt'];
		$medicine_quantity = $_REQUEST['medicine_quantity_txt'];
		$medicine_expiry = $_REQUEST['medicine_expiry_txt'];
		$medicine_discription = addslashes($_REQUEST['medicine_discription_txt']);
		$medicine_amount_cost = $_REQUEST['medicine_amount_cost_txt'];
		$medicine_discount = $_REQUEST['medicine_discount_txt'];
		$medicine_batch_code = addslashes($_REQUEST['medicine_batch_code_txt']);
		$sql ="INSERT INTO `medicine`(`name`,`company_name`,`code`,`batch_code`, `amount`,`amount_cost`,`discount`, `quantity`,`discription`, `expiry`) VALUES ('".$medicine_name."','".$medicine_company."','".$medicine_code."','".$medicine_batch_code."',".$medicine_amount.",".$medicine_amount_cost.",".$medicine_discount.",".$medicine_quantity.",'".$medicine_discription."','".$medicine_expiry."')";
		$result = mysqli_query($conn,$sql);
		if ($result) {
		    $Json['status'] = true;
		    $Json['msg'] = "Scuess Full Inserted";
		}else{
			$Json['status'] = false;
		    $Json['msg'] = "Something went Wrong Plese try again";
		}
		echo json_encode($Json);
	}
	if(isset($_REQUEST['get_edit_medicine'])){
		$Json = array();
		$sql = "select * from medicine where isDelete=0 and id=".$_REQUEST['id'];
		$query = mysqli_query($conn, $sql);
		$Row = mysqli_fetch_array($query);
	 	$Json['name'] = $Row['name'];
	 	$Json['company_name'] = $Row['company_name'];
	 	$Json['amount'] = $Row['amount'];
	 	$Json['code'] = $Row['code'];
	 	$Json['discription'] = $Row['discription'];
	 	$Json['discount'] = $Row['discount'];
	 	$Json['amount_cost'] = $Row['amount_cost'];
	 	$Json['batch_code'] = $Row['batch_code'];
	    echo json_encode($Json);
	    exit;
	}
	if(isset($_REQUEST['edit_medicine'])){
		$Json =array();
		$id = $_REQUEST['edit_id'];
		$medicine_name = addslashes($_REQUEST['edit_medicine_name_txt']);
		$medicine_company = addslashes($_REQUEST['edit_medicine_company_name_txt']);
		$medicine_code = addslashes($_REQUEST['edit_medicine_code_txt']);
		$medicine_amount = $_REQUEST['edit_medicine_amount_txt'];
		$medicine_discription = addslashes($_REQUEST['edit_medicine_discription_txt']);
		$medicine_amount_cost = $_REQUEST['edit_medicine_amount_cost_txt'];
		$medicine_discount = $_REQUEST['edit_medicine_discount_txt'];
		$medicine_batch_code = addslashes($_REQUEST['edit_medicine_batch_code_txt']);
		$sql ="UPDATE `medicine` SET `name`='".$medicine_name."',`company_name`='".$medicine_company."',`discription`='".$medicine_discription."',`code`='".$medicine_code."',`batch_code`='".$medicine_batch_code."',`amount`=".$medicine_amount.",`amount_cost`=".$medicine_amount_cost.",`discount`=".$medicine_discount." WHERE id=".$id;
		$result = mysqli_query($conn,$sql);
		if ($result) {
		    $Json['status'] = true;
		    $Json['msg'] = "Scuess Full Inserted";
		}else{
			$Json['status'] = false;
		    $Json['msg'] = "Something went Wrong Plese try again";
		}
		echo json_encode($Json);
	}
	if(isset($_REQUEST['add_edit_medicine_qunatity'])){
		$Json =array();
		$id = $_REQUEST['edit_qunatity_id'];
		$medicine_quantity = $_REQUEST['medicine_quantity_txt'];
		$sql ="UPDATE `medicine` SET `quantity`=`quantity` + ".$medicine_quantity." WHERE id=".$id;
		$result = mysqli_query($conn,$sql);
		if ($result) {
		    $Json['status'] = true;
		    $Json['msg'] = "Scuess Full Inserted";
		}else{
			$Json['status'] = false;
		    $Json['msg'] = "Something went Wrong Plese try again";
		}
		echo json_encode($Json);
	}
	if(isset($_REQUEST['minus_edit_medicine_qunatity'])){
		$Json =array();
		$id = $_REQUEST['edit_qunatity_id'];
		$medicine_quantity = $_REQUEST['medicine_quantity_txt'];
		$sql ="UPDATE `medicine` SET `quantity`=`quantity` - ".$medicine_quantity." WHERE id=".$id;
		$result = mysqli_query($conn,$sql);
		if ($result) {
		    $Json['status'] = true;
		    $Json['msg'] = "Scuess Full Inserted";
		}else{
			$Json['status'] = false;
		    $Json['msg'] = "Something went Wrong Plese try again";
		}
		echo json_encode($Json);
	}
	if (isset($_REQUEST['get_all_medicine'])) {
	    $Json['aaData'] = array();
	    $sLimit = "";
	    $sql = "select SQL_CALC_FOUND_ROWS * from medicine where isDelete=0 ";
	    if (!empty($_REQUEST['sSearch'])) {
	        $sql .= " AND ( name LIKE '" . $_REQUEST['sSearch'] . "%' ";
	        $sql .= " OR company_name LIKE '" . $_REQUEST['sSearch'] . "%' ";
	        $sql .= " OR code LIKE '" . $_REQUEST['sSearch'] . "%' )";
	    }
	    $sql .= " ORDER BY createdAt DESC ";
	    if (isset($_REQUEST['iDisplayStart']) && $_REQUEST['iDisplayLength'] != '-1') {
	        $sql .= " LIMIT " . $_REQUEST['iDisplayStart'] . ", " . $_REQUEST['iDisplayLength'];
	    }
	    $query = mysqli_query($conn, $sql);
	    $query_total = mysqli_query($conn, "SELECT FOUND_ROWS()");
	    $Json['iTotalDisplayRecords'] = $query_total->fetch_row();
	    $k = 0;
	    $i = $_REQUEST['iDisplayStart'] + 1;
	     while ($Row = mysqli_fetch_array($query)) {
	        $Json['aaData'][$k][] = $Row['name'];
	        $Json['aaData'][$k][] = $Row['amount'];
	        $Json['aaData'][$k][] = $Row['discount'];
	        $sql1 = "select sum(quantity) as total FROM `item` where medcine_id=".$Row['id'];
	        $query1 = mysqli_query($conn, $sql1);
	        $Row1 = mysqli_fetch_assoc($query1);
	        $Json['aaData'][$k][] = $Row['quantity'];
	        if($Row1['total'] == ""){
	        	$Json['aaData'][$k][] = $Row['quantity'];
	        }else if ($Row1['total'] == $Row['quantity']){
	        	$Json['aaData'][$k][] = 0;
	        }else{
	        	$Json['aaData'][$k][] = $Row1['total'];
	        }
	        
	        $Json['aaData'][$k][] = $Row['code'];
	        // $Json['aaData'][$k][] = $Row['batch_code'];
	     	$Json['aaData'][$k][] = '<button data_id = "'.$Row['id'].'" class="edit_medicine btn btn-sm btn-outline b-info text-info"> <i class="fa fa-pencil"></i></button> 
	        <button data_id = "'.$Row['id'].'"  class="edit_quantity btn btn-sm btn-outline b-info text-info"><i class="fa fa-plus"></i> Quantity</button> 
	        <button data_id = "'.$Row['id'].'"  class="minus_edit_quantity btn btn-sm btn-outline b-info text-info"><i class="fa fa-minus"></i> Quantity</button> 
	        <button data_id = "'.$Row['id'].'" class="delete_medicine btn btn-sm btn-outline b-danger text-danger">
              <i class="fa fa-remove"></i>
            </button>';
	        $k++;
	        $i++;
	    }
	    $Json['sEcho'] = $_REQUEST['sEcho'];
	    echo json_encode($Json);
	    exit;
	}
	if(isset($_REQUEST['delete_medicine'])){
		$Json = array();
		$sql = "UPDATE `medicine` SET `isDelete`=1 WHERE id=".$_REQUEST['id'];
		$result = mysqli_query($conn, $sql);
		if ($result) {
		    $Json['status'] = true;
		    $Json['msg'] = "Scuess Full Inserted";
		}else{
			$Json['status'] = false;
		    $Json['msg'] = "Something went Wrong Plese try again";
		}
	    echo json_encode($Json);
	    exit;
	}
	if(isset($_REQUEST['get_all_invoice'])) {
	    $Json['aaData'] = array();
	    $sLimit = "";
	    $sql = "select SQL_CALC_FOUND_ROWS * from customer where isDelete=0 ";
	    if (!empty($_REQUEST['sSearch'])) {
	        $sql .= " AND ( customerName LIKE '" . $_REQUEST['sSearch'] . "%' ";
	        $sql .= " OR customerAddress LIKE '" . $_REQUEST['sSearch'] . "%' ";
	        $sql .= " OR invoice_no LIKE '" . $_REQUEST['sSearch'] . "%' )";
	    }
	    $sql .= " ORDER BY createAt DESC ";
	    if (isset($_REQUEST['iDisplayStart']) && $_REQUEST['iDisplayLength'] != '-1') {
	        $sql .= " LIMIT " . $_REQUEST['iDisplayStart'] . ", " . $_REQUEST['iDisplayLength'];
	    }
	    $query = mysqli_query($conn, $sql);
	    $query_total = mysqli_query($conn, "SELECT FOUND_ROWS()");
	    $Json['iTotalDisplayRecords'] = $query_total->fetch_row();
	    $k = 0;
	    $i = $_REQUEST['iDisplayStart'] + 1;
	    while ($Row = mysqli_fetch_array($query)) {
	        $Json['aaData'][$k][] = $Row['invoice_no'];
	        $Json['aaData'][$k][] = $Row['customerName'];
	        $Json['aaData'][$k][] = $Row['customerAddress'];
	        $Json['aaData'][$k][] = date("d/m/Y", strtotime($Row['date']));
	        $Json['aaData'][$k][] = '<a class="edit_invoce btn btn-sm btn-outline b-info text-info" href="edit_invoice.php?id='.$Row['id'].'" value="' . $Row['id'] . '">Edit</a>
				<a class="print btn btn-sm btn-outline b-info text-info" href="invoice.php?id='.$Row['id'].'"  value="' . $Row['id'] . '" target="_blank">Print</a>';
	        $k++;
	        $i++;
	    }
     	$Json['sEcho'] = $_REQUEST['sEcho'];
	    echo json_encode($Json);
	    exit;
	}
	if(isset($_REQUEST['get_all_invoice_report'])) {
	    $Json['aaData'] = array();
	    $startDate  = $_REQUEST['startDate'];
	    $endDate  = $_REQUEST['endDate'];
	    $sLimit = "";
	    $sql = "select SQL_CALC_FOUND_ROWS * from customer where isDelete=0 and `date` between '".$startDate."' and '".$endDate."'";
	    // if (!empty($_REQUEST['sSearch'])) {
	    //     $sql .= " AND ( customerName LIKE '" . $_REQUEST['sSearch'] . "%' ";
	    //     $sql .= " OR customerAddress LIKE '" . $_REQUEST['sSearch'] . "%' ";
	    //     $sql .= " OR invoice_no LIKE '" . $_REQUEST['sSearch'] . "%' )";
	    // }
	    // $sql .= " ORDER BY createAt DESC ";
	    // if (isset($_REQUEST['iDisplayStart']) && $_REQUEST['iDisplayLength'] != '-1') {
	    //     $sql .= " LIMIT " . $_REQUEST['iDisplayStart'] . ", " . $_REQUEST['iDisplayLength'];
	    // }
	    $query = mysqli_query($conn, $sql);
	    $query_total = mysqli_query($conn, "SELECT FOUND_ROWS()");
	   // $Json['iTotalDisplayRecords'] = $query_total->fetch_row();
	    $k = 0;
	    $msg="";
	   // $i = $_REQUEST['iDisplayStart'] + 1;
	    while ($Row = mysqli_fetch_array($query)) {
	    	$msg .= "<tr>";
	        //$msg .= "<td>" . $i . "</td>";
	        $msg .= "<td>" . $Row['invoice_no'] . "</td>";
	        $msg .= "<td>" . $Row['customerName']."</td>";
	       // $msg .= "<td>" . $Row['customerAddress'] . "</td>";
	        $msg .= "<td>" . $Row['mobile_number'] . "</td>";
	        $msg .= "<td>" . date("d/m/Y", strtotime($Row['date'])) . "</td>";
	        // $msg .= "<td>" . $Row['mobile_number'] . "</td>";
	        $msg .= "<td>" . $Row['total_amount'] . "</td>";
	        // 	$msg .= "<td>" . $Row['main_prob'] . "</td>";
	        //	$msg.="<td>".$Row['sub_prob']."</td>";
	        // 	$msg .= "<td>" . date("d-m-Y", strtotime($Row['return_date'])) . "</td>";
	        $msg .= "</tr>";
        	//$i++;
        	$k++;
	    }
     	//$Json['sEcho'] = $_REQUEST['sEcho'];
     	$Json['data'] = $msg;
		
		$sql1 = "select count(*) as total from customer where isDelete=0 and `date` between '".$startDate."' and '".$endDate."'";
		$result1 = mysqli_query($conn, $sql1);
		$result1 = $result1->fetch_assoc();
		$Json['total'] = $result1['total'];

		$sql2 = "SELECT SUM(total_amount) as amount FROM `customer` WHERE isDelete=0 and `date` between '".$startDate."' and '".$endDate."'";
		$result2 = mysqli_query($conn, $sql2);
		$result2 = $result2->fetch_assoc();
		$Json['amount']= $result2['amount'];

	    echo json_encode($Json);
	    exit;
	}
	if(isset($_REQUEST['add_invoice'])){
	    $Json = array();
		$clientCompanyName = addslashes($_REQUEST['clientCompanyName']);
		$clientAddress= addslashes($_REQUEST['clientAddress']);
		$doctor_name= $_REQUEST['doctor_name'];
		$invoiceDate= $_REQUEST['invoiceDate'];
		$contact_no= $_REQUEST['contact_no'];
		$itemName= $_REQUEST['itemName'];	
		$quantity= $_REQUEST['quantity'];
		$total= $_REQUEST['total'];
		$notes= addslashes($_REQUEST['notes']);
		$discount= $_REQUEST['discount'];
		$totalAftertax= $_REQUEST['totalAftertax'];

		$sql1 = "select * from customer";
		$result1 = mysqli_query($conn, $sql1);
		$num = mysqli_num_rows($result1);

		$id = date('Y') . date('m') . ($num + 1);
		$inv_id = "inv$id";
	 	$sql = "INSERT INTO `customer`(`customerName`,`customerAddress`,`date`,`note`,`mobile_number`,`doctor_name`,`invoice_no`,`total_amount`) VALUES ('".$clientCompanyName."','".$clientAddress."','".$invoiceDate."','".$notes."','".$contact_no."','".$doctor_name."','".$inv_id."',".$totalAftertax.")";
		if ($conn->query($sql) === TRUE) {
		 	$last_id = $conn->insert_id;
		 	for($i = 0;$i<count($itemName); $i++){
		 		//$sql_item = "INSERT INTO `item`(`discription`,`customer_id`, `medcine_id`, `price`, `total`, `quantity`) VALUES ('".$productDis[$i]."','".$last_id."',".$itemName[$i].",'".$price[$i]."','".$total[$i]."','".$quantity[$i]."')";
		 		$sql_item = "INSERT INTO `item`(`customer_id`, `medcine_id`, `total`, `quantity`,`discount`) VALUES (".$last_id.",".$itemName[$i].",".$total[$i].",".$quantity[$i].",".$discount[$i].")";
				$conn->query($sql_item);
		 	}
	        $Json['status'] = "true";
		} else {
	        $Json['status'] = "false";
		}
	    echo json_encode($Json);die;
	}
	if(isset($_REQUEST['edit_invoice'])){
	    $Json = array();
	    $id = $_REQUEST['edit_id'];
	    $sql1 = "select * from customer where id=".$id;
		$clientCompanyName = addslashes($_REQUEST['clientCompanyName']);
		$clientAddress= addslashes($_REQUEST['clientAddress']);
		$doctor_name= $_REQUEST['doctor_name'];
		$invoiceDate= $_REQUEST['invoiceDate'];
		$contact_no= $_REQUEST['contact_no'];
		$itemName= $_REQUEST['itemName'];
		$quantity= $_REQUEST['quantity'];
		$total= $_REQUEST['total'];
		$notes= addslashes($_REQUEST['notes']);
		$discount= $_REQUEST['discount'];
		$totalAftertax= $_REQUEST['totalAftertax'];
		$sql ="UPDATE `customer` SET `customerName`='".$clientCompanyName."',`customerAddress`='".$clientAddress."',`date`='".$invoiceDate."',
		`note`='".$notes."',`mobile_number`='".$contact_no."',`doctor_name`='".$doctor_name."',`total_amount`=".$totalAftertax." WHERE id=".$id;
	 	//echo $totalAftertax;
		//exit();
		if ($conn->query($sql) === TRUE) {
	 		$sql_delete = "DELETE FROM `item` WHERE customer_id=".$id;
	 		if ($conn->query($sql_delete) === TRUE) {
			 	$last_id = $id;
			 	for($i = 0;$i<count($itemName); $i++){
			 		$sql_item = "INSERT INTO `item`(`customer_id`, `medcine_id`, `total`, `quantity`,`discount`) VALUES (".$last_id.",".$itemName[$i].",".$total[$i].",".$quantity[$i].",".$discount[$i].")";
					$conn->query($sql_item);
			 	}
		 	}else{
	 		  	$Json['status'] = false;
		 	}
	        $Json['status'] = true;
		} else {
	        $Json['status'] = false;
		}
	    echo json_encode($Json);die;
	}
	if(isset($_REQUEST['get_price'])){
		$id = $_REQUEST['id'];
		$sql = "select * from medicine where isDelete=0 and id=".$id;
		$results = array();
	 	$query = mysqli_query($conn, $sql);
	 	$Row = mysqli_fetch_array($query);
	 	$sql1 = "select sum(quantity) as total FROM `item` where medcine_id=".$id;
	 	$result1 = mysqli_query($conn,$sql1);
	 	$Row1 = mysqli_fetch_assoc($result1);
	 	$Json['name'] = $Row['name'];
	 	$Json['amount'] = $Row['amount'];
	 	$Json['discription'] = $Row['discription'];
	 	$Json['remaning_quantity'] = $Row['quantity'] - $Row1['total'];
	 	$Json['discount'] = $Row['discount'];
		echo json_encode($Json);
	}
	if(isset($_REQUEST['get_medicine'])){
	 	$Json =array();
		if(isset($_REQUEST['id'])){
			$id=$_REQUEST['id'];
     		$ids = implode(",",$id);
     		$sql = "SELECT * FROM medicine where isDelete=0 and id NOT IN(".$ids.") and `name` LIKE  '%".$_REQUEST['q']."%'";
		}else{
			$sql = "SELECT * FROM medicine where isDelete=0 and `name` LIKE  '%".$_REQUEST['q']."%'";
		}
       	$result = mysqli_query($conn,$sql);
        $k=0;
        while ($Row = mysqli_fetch_assoc($result)) { 
        	// $sql1 = "select sum(quantity) as total FROM `item` where medcine_id=".$Row['id'];
       	 	// 	$result1 = mysqli_query($conn,$sql1);
       	 	// 	$Row1 = mysqli_fetch_assoc($result1);
       	 	// 	if($Row['quantity'] > $Row1['total']){
       	 		$Json['items'][$k]['id'] = $Row['id'];
            	$Json['items'][$k]['name'] = $Row['name'];
       	 	// }
            $k++;
        }
        echo json_encode($Json);
    }
    if(isset($_REQUEST['get_desc'])){
	 	$Json =array();
		if(isset($_REQUEST['id'])){
			$id=$_REQUEST['id'];
     		$ids = implode(",",$id);
     		$sql = "SELECT * FROM medicine where isDelete=0 and id NOT IN(".$ids.") and `discription` LIKE  '%".$_REQUEST['q']."%'";
		}else{
			$sql = "SELECT * FROM medicine where isDelete=0 and `discription` LIKE  '%".$_REQUEST['q']."%'";
		}
       	$result = mysqli_query($conn,$sql);
        $k=0;
        while ($Row = mysqli_fetch_assoc($result)) { 
        	// $sql1 = "select sum(quantity) as total FROM `item` where medcine_id=".$Row['id'];
       	 	// 	$result1 = mysqli_query($conn,$sql1);
       	 	// 	$Row1 = mysqli_fetch_assoc($result1);
       	 	// 	if($Row['quantity'] > $Row1['total']){
       	 		$Json['items'][$k]['id'] = $Row['id'];
            	$Json['items'][$k]['discription'] = $Row['discription'];
       	 	// }
            $k++;
        }
        echo json_encode($Json);
    }
?>