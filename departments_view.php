<?php
// This script and data application were generated by AppGini 5.72
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/departments.php");
	include("$currDir/departments_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('departments');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "departments";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`departments`.`id`" => "id",
		"`departments`.`name`" => "name",
		"IF(    CHAR_LENGTH(`schools1`.`name`), CONCAT_WS('',   `schools1`.`name`), '') /* School */" => "school"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`departments`.`id`',
		2 => 2,
		3 => '`schools1`.`name`'
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`departments`.`id`" => "id",
		"`departments`.`name`" => "name",
		"IF(    CHAR_LENGTH(`schools1`.`name`), CONCAT_WS('',   `schools1`.`name`), '') /* School */" => "school"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`departments`.`id`" => "ID",
		"`departments`.`name`" => "Name",
		"IF(    CHAR_LENGTH(`schools1`.`name`), CONCAT_WS('',   `schools1`.`name`), '') /* School */" => "School"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`departments`.`id`" => "id",
		"`departments`.`name`" => "name",
		"IF(    CHAR_LENGTH(`schools1`.`name`), CONCAT_WS('',   `schools1`.`name`), '') /* School */" => "school"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'school' => 'School');

	$x->QueryFrom = "`departments` LEFT JOIN `schools` as schools1 ON `schools1`.`id`=`departments`.`school` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm[2]==0 ? 1 : 0);
	$x->AllowDelete = $perm[4];
	$x->AllowMassDelete = true;
	$x->AllowInsert = $perm[1];
	$x->AllowUpdate = $perm[3];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 0;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = 0;
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 100;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation["quick search"];
	$x->ScriptFileName = "departments_view.php";
	$x->RedirectAfterInsert = "departments_view.php?SelectedID=#ID#";
	$x->TableTitle = "Departments";
	$x->TableIcon = "resources/table_icons/chart_organisation.png";
	$x->PrimaryKey = "`departments`.`id`";

	$x->ColWidth   = array(  150, 150);
	$x->ColCaption = array("Name", "School");
	$x->ColFieldName = array('name', 'school');
	$x->ColNumber  = array(2, 3);

	// template paths below are based on the app main directory
	$x->Template = 'templates/departments_templateTV.html';
	$x->SelectedTemplate = 'templates/departments_templateTVS.html';
	$x->TemplateDV = 'templates/departments_templateDV.html';
	$x->TemplateDVP = 'templates/departments_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `departments`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='departments' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `departments`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='departments' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`departments`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: departments_init
	$render=TRUE;
	if(function_exists('departments_init')){
		$args=array();
		$render=departments_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: departments_header
	$headerCode='';
	if(function_exists('departments_header')){
		$args=array();
		$headerCode=departments_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: departments_footer
	$footerCode='';
	if(function_exists('departments_footer')){
		$args=array();
		$footerCode=departments_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>