<?php 
function checkdetailsStudent(){
	require'conn.php';
	$data=getMemberInfo();
	$group=$data['group'];
	$name=$data['username'];
	if ($group=="students") {
		# code...
		$checkdetails=mysqli_query($con,"SELECT * FROM membership_userrecords WHERE memberID='$name' AND tableName='student_details'");
		$countcheck=mysqli_num_rows($checkdetails);
		if ($countcheck==0) {
			# code...
			echo '<div class="alert alert-primary"><strong>Whats up '.$name.', Welcome to Jisort-your timetable companion.You need to provide your personal details to be able to get personalized content.Simply click <a href="student_details_view.php">HERE</a> to get started</strong></div>';
		}
	}
}
function datacounter($table){
	require'conn.php';
	$result=mysqli_query($con,"SELECT * FROM $table ORDER BY id");
	$count=mysqli_num_rows($result);
	echo $count;
}
function getclassestoday(){
	require'conn.php';
	$today=date('D');
	$user=getLoggedmemberID();
	$getPkValue=mysqli_query($con,"SELECT pkValue AS pk FROM membership_userrecords WHERE memberID='$user' AND tableName='student_details'");
	foreach ($getPkValue as $key => $value0) {
		# code...loop 1
		$storePk=$value0['pk'];
	}
	$getStudentDetails=mysqli_query($con,"SELECT school AS st_school, department AS st_department, year_of_study AS st_yos FROM student_details WHERE id='$storePk'");
	foreach ($getStudentDetails as $key => $value1) {
			# code...loop 2
		$storeSchool=$value1['st_school'];
		$storeDepartment=$value1['st_department'];
		$storeYos=$value1['st_yos'];
	}
	$getclasses=mysqli_query($con,"SELECT * FROM class_time_table WHERE day LIKE '$today%' AND school='$storeSchool' AND department='$storeDepartment' AND year_of_study='$storeYos'");
			#count check here
	$countcheck=mysqli_num_rows($getclasses);
	if ($countcheck==0) {
		# code...
		echo '<div class="alert alert-success text-center">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<b>Wubba lubba dub dub!! No class today!!</b></div>';
	}
	foreach ($getclasses as $key => $value2) {
				# code...loop 3
		echo'<tr>
		<td>'.$value2['unit_code'].'</td>
		<td>'.$value2['time_start'].'</td>
		<td>'.$value2['time_end'].'</td>
		<td>'.$value2['venue'].'</td>
		</tr>';
	}
}
function getnotices(){
	require'conn.php';
	$user=getLoggedmemberID();
	$getPkValue=mysqli_query($con,"SELECT pkValue AS pk FROM membership_userrecords WHERE memberID='$user' AND tableName='student_details'");
	foreach ($getPkValue as $key => $value0) {
		# code...loop 1
		$storePk=$value0['pk'];
	}
	$getStudentDetails=mysqli_query($con,"SELECT school AS st_school, department AS st_department, year_of_study AS st_yos FROM student_details WHERE id='$storePk'");
	foreach ($getStudentDetails as $key => $value1) {
			# code...loop 2
		$storeSchool=$value1['st_school'];
		$storeDepartment=$value1['st_department'];
		$storeYos=$value1['st_yos'];
	}
	#pagination
	$query=mysqli_query($con,"select count(id) from `notices` where school='$storeSchool' and department='$storeDepartment' and year_of_study='$storeYos'");
	$row = mysqli_fetch_row($query);

	$rows = $row[0];
	
	$page_rows = 6;#define number of rows per page

	$last = ceil($rows/$page_rows);

	if($last < 1){
		$last = 1;
	}

	$pagenum = 1;

	if(isset($_GET['pn'])){
		$pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
	}

	if ($pagenum < 1) { 
		$pagenum = 1; 
	} 
	else if ($pagenum > $last) { 
		$pagenum = $last; 
	}
	#set page limit here
	$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
	#pagination
	$bringnotices=mysqli_query($con,"SELECT * FROM notices WHERE school='$storeSchool' AND department='$storeDepartment' AND year_of_study='$storeYos' ORDER BY id DESC $limit");
	#start pagination controls here
	global $paginationCtrls;
	$paginationCtrls = '';

	if($last != 1){
		
		if ($pagenum > 1) {
		//pagination controls
			$previous = $pagenum - 1;
			$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'" class="btn btn-info btn-sm">Previous</a> &nbsp; &nbsp; ';

			for($i = $pagenum-4; $i < $pagenum; $i++){
				if($i > 0){
				//pagination controls
					$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'" class="btn btn-warning btn-sm">'.$i.'</a> &nbsp; ';
				}
			}
		}

		$paginationCtrls .= ''.$pagenum.' &nbsp; ';

		for($i = $pagenum+1; $i <= $last; $i++){
		//pagination controls
			$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'" class="btn btn-success btn-sm">'.$i.'</a> &nbsp; ';
			if($i >= $pagenum+4){
				break;
			}
		}

		if ($pagenum != $last) {
    	//pagination controls
			$next = $pagenum + 1;
			$paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'" class="btn btn-primary btn-sm">Next</a> ';
		}
	}#pagination controls end here
	$countcheck=mysqli_num_rows($bringnotices);
	if ($countcheck==0) {
		# code...
		echo '<div class="alert alert-warning text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><b>You have no notices for now.</b></div>';
	}
	foreach ($bringnotices as $key => $value2) {
		# code...
		$noticeID=$value2['id'];
		$getowner=mysqli_query($con,"SELECT memberID AS owner FROM membership_userrecords WHERE pkValue='$noticeID' AND tableName='notices'");
		foreach ($getowner as $key => $value3) {
			# code...
			$storeowner=$value3['owner'];
		}
		echo '<a class="list-group-item list-group-item-action" href="#">
		<div class="media">
		<div class="media-body">
		<strong><span class="fa fa-user"></span>'.$storeowner.'</strong>-posted a new notice<br>
		<p class="img img-thumbnail">'.$value2['notice'].'</p>
		<div class="text-muted smaller">Date:'.$value2['date'].'</div>
		</div>
		</div>
		</a>';
	}
}
function getmytasks(){
	require'conn.php';
	$today=date('D');
	$user=getLoggedmemberID();
	$getmyposts=mysqli_query($con,"SELECT pkValue AS ids FROM membership_userrecords WHERE memberID='$user' AND tableName='personal_time_table'");
	foreach ($getmyposts as $key => $value0) {
		# code...
		$storeID=$value0['ids'];
	}
	$gettasks=mysqli_query($con,"SELECT * FROM personal_time_table WHERE day LIKE '$today%' AND id='$storeID'");
	$countcheck=mysqli_num_rows($gettasks);
	if ($countcheck==0) {
		# code...show message if no tasks found
		echo '<div class="alert alert-info text-center">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<b>Oopsie whoopsie,You have no tasks today.You can schedule some <a class="btn btn-success btn-sm" href="personal_time_table_view.php">HERE</a></b></b></div>';
	}
	foreach ($gettasks as $key => $value1) {
		# code...
		echo '<tr>
		<td>'.$value1['activity'].'</td>
		<td>'.$value1['time_start'].'</td>
		<td>'.$value1['time_end'].'</td>
		</tr>';
	}
}
function getexams(){
	require'conn.php';
	$today=date('Y-m-d');
	$user=getLoggedmemberID();
	$getPkValue=mysqli_query($con,"SELECT pkValue AS pk FROM membership_userrecords WHERE memberID='$user' AND tableName='student_details'");
	foreach ($getPkValue as $key => $value0) {
		# code...loop 1
		$storePk=$value0['pk'];
	}
	$getStudentDetails=mysqli_query($con,"SELECT school AS st_school, department AS st_department, year_of_study AS st_yos FROM student_details WHERE id='$storePk'");
	foreach ($getStudentDetails as $key => $value1) {
			# code...loop 2
		$storeSchool=$value1['st_school'];
		$storeDepartment=$value1['st_department'];
		$storeYos=$value1['st_yos'];
	}
	$getexams=mysqli_query($con,"SELECT * FROM exam_time_table WHERE date='$today' AND school='$storeSchool' AND department='$storeDepartment' AND year_of_study='$storeYos'");
			#count check here
	$countcheck=mysqli_num_rows($getexams);
	if ($countcheck==0) {
		# code...
		echo '<div class="alert alert-success text-center">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<b>Wubba lubba dub dub!! No exams today!!</b></div>';
	}
	foreach ($getexams as $key => $value2) {
				# code...loop 3
		echo'<tr>
		<td>'.$value2['unit_code'].'</td>
		<td>'.$value2['time_start'].'</td>
		<td>'.$value2['time_end'].'</td>
		<td>'.$value2['venue'].'</td>
		</tr>';
	}
}
function classttlink(){
	require'conn.php';
	$user=getLoggedmemberID();
	$getPkValue=mysqli_query($con,"SELECT pkValue AS pk FROM membership_userrecords WHERE memberID='$user' AND tableName='student_details'");
	foreach ($getPkValue as $key => $value0) {
		# code...loop 1
		$storePk=$value0['pk'];
	}
	$getStudentDetails=mysqli_query($con,"SELECT school AS st_school, department AS st_department, year_of_study AS st_yos FROM student_details WHERE id='$storePk'");
	foreach ($getStudentDetails as $key => $value1) {
			# code...loop 2
		$storeSchool=$value1['st_school'];
		$storeDepartment=$value1['st_department'];
		$storeYos=$value1['st_yos'];
	}
	$getschoolName=mysqli_query($con,"SELECT name sname FROM schools WHERE id='$storeSchool'");
	foreach ($getschoolName as $key => $valueSN) {
		# code...
		$storeSName=$valueSN['sname'];
	}
	$getdepartmentName=mysqli_query($con,"SELECT name AS dname FROM departments WHERE id='$storeDepartment'");
	foreach ($getdepartmentName as $key => $valueDN) {
		# code...
		$storeDName=$valueDN['dname'];
	}
	echo'class_time_table_view.php?SortField=&SortDirection=&FilterAnd%5B1%5D=and&FilterField%5B1%5D=7&FilterOperator%5B1%5D=equal-to&FilterValue%5B1%5D='.$storeSName.'&FilterAnd%5B2%5D=and&FilterField%5B2%5D=8&FilterOperator%5B2%5D=equal-to&FilterValue%5B2%5D='.$storeDName.'&FilterAnd%5B3%5D=and&FilterField%5B3%5D=9&FilterOperator%5B3%5D=equal-to&FilterValue%5B3%5D='.$storeYos.'';
}
function examttlink(){
	require'conn.php';
	$user=getLoggedmemberID();
	$getPkValue=mysqli_query($con,"SELECT pkValue AS pk FROM membership_userrecords WHERE memberID='$user' AND tableName='student_details'");
	foreach ($getPkValue as $key => $value0) {
		# code...loop 1
		$storePk=$value0['pk'];
	}
	$getStudentDetails=mysqli_query($con,"SELECT school AS st_school, department AS st_department, year_of_study AS st_yos FROM student_details WHERE id='$storePk'");
	foreach ($getStudentDetails as $key => $value1) {
			# code...loop 2
		$storeSchool=$value1['st_school'];
		$storeDepartment=$value1['st_department'];
		$storeYos=$value1['st_yos'];
	}
	$getschoolName=mysqli_query($con,"SELECT name sname FROM schools WHERE id='$storeSchool'");
	foreach ($getschoolName as $key => $valueSN) {
		# code...loop 3
		$storeSName=$valueSN['sname'];
	}
	$getdepartmentName=mysqli_query($con,"SELECT name AS dname FROM departments WHERE id='$storeDepartment'");
	foreach ($getdepartmentName as $key => $valueDN) {
		# code... loop 4
		$storeDName=$valueDN['dname'];
	}
	echo'exam_time_table_view.php?SortField=&SortDirection=&FilterAnd%5B1%5D=and&FilterField%5B1%5D=7&FilterOperator%5B1%5D=equal-to&FilterValue%5B1%5D='.$storeSName.'&FilterAnd%5B2%5D=and&FilterField%5B2%5D=8&FilterOperator%5B2%5D=equal-to&FilterValue%5B2%5D='.$storeDName.'&FilterAnd%5B3%5D=and&FilterField%5B3%5D=9&FilterOperator%5B3%5D=equal-to&FilterValue%5B3%5D='.$storeYos.'';
}
?>