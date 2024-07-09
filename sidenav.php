<?php 
$memberinfo=getMemberInfo();
$usergroup=$memberinfo['group'];
switch ($usergroup) {
	case 'students':
		# code...
  echo'
  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Personal TT">
  <a class="nav-link" href="personal_time_table_view.php">
  <i class="fa fa-fw fa-folder"></i>
  <span class="nav-link-text">Personal Time Table</span>
  </a>
  </li>
  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Student Details">
  <a class="nav-link" href="student_details_view.php">
  <i class="fa fa-fw fa-user"></i>
  <span class="nav-link-text">Student Details</span>
  </a>
  </li>
  ';
  break;
  case 'Class reps':
			# code...
  echo'<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Class TTs">
  <a class="nav-link" href="class_time_table_view.php">
  <i class="fa fa-fw fa-file"></i>
  <span class="nav-link-text">Class TTs</span>
  </a>
  </li>
  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Exam TTs">
  <a class="nav-link" href="exam_time_table_view.php">
  <i class="fa fa-fw fa-book"></i>
  <span class="nav-link-text">Exam TTs</span>
  </a>
  </li>
  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Exam TTs">
  <a class="nav-link" href="notices_view.php">
  <i class="fa fa-fw fa-whatsapp"></i>
  <span class="nav-link-text">Notices</span>
  </a>
  </li>
  ';
  break;

  default:
		# code...
  echo '<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Schools">
  <a class="nav-link" href="schools_view.php">
  <i class="fa fa-fw fa-building"></i>
  <span class="nav-link-text">Schools</span>
  </a>
  </li>
  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Departments">
  <a class="nav-link" href="departments_view.php">
  <i class="fa fa-fw fa-pie-chart"></i>
  <span class="nav-link-text">Departments</span>
  </a>
  </li>
  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Students">
  <a class="nav-link" href="student_details_view.php">
  <i class="fa fa-fw fa-users"></i>
  <span class="nav-link-text">Students</span>
  </a>
  </li>
  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Class TTs">
  <a class="nav-link" href="class_time_table_view.php">
  <i class="fa fa-fw fa-file"></i>
  <span class="nav-link-text">Class TTs</span>
  </a>
  </li>
  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Exam TTs">
  <a class="nav-link" href="exam_time_table_view.php">
  <i class="fa fa-fw fa-book"></i>
  <span class="nav-link-text">Exam TTs</span>
  </a>
  </li>
  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Notices">
  <a class="nav-link" href="notices_view.php">
  <i class="fa fa-fw fa-whatsapp"></i>
  <span class="nav-link-text">Notices</span>
  </a>
  </li>';
  break;
}


?>