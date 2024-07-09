<?php
	// For help on using hooks, please refer to https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks

	function student_details_init(&$options, $memberInfo, &$args){
		global $Translation;
		$Translation['Add New']="Register";
		$Translation['Save New']="Submit";
		if ($memberInfo['group'] == 'students') {
        // Disable filter button
		$options->AllowFilters=0;
        $user=$memberInfo['username'];
		$checkdetails=sqlValue("SELECT COUNT(*) FROM membership_userrecords WHERE memberID='$user' AND tableName='student_details'");
		if ($checkdetails>0) {
			# code...Disable add new button
			$options->AllowInsert=0;
		}
    }
		return TRUE;
	}

	function student_details_header($contentType, $memberInfo, &$args){
		$header='';

		switch($contentType){
			case 'tableview':
				$header='';
				break;

			case 'detailview':
				$header='';
				break;

			case 'tableview+detailview':
				$header='';
				break;

			case 'print-tableview':
				$header='';
				break;

			case 'print-detailview':
				$header='';
				break;

			case 'filters':
				$header='';
				break;
		}

		return $header;
	}

	function student_details_footer($contentType, $memberInfo, &$args){
		$footer='';

		switch($contentType){
			case 'tableview':
				$footer='';
				break;

			case 'detailview':
				$footer='';
				break;

			case 'tableview+detailview':
				$footer='';
				break;

			case 'print-tableview':
				$footer='';
				break;

			case 'print-detailview':
				$footer='';
				break;

			case 'filters':
				$footer='';
				break;
		}

		return $footer;
	}

	function student_details_before_insert(&$data, $memberInfo, &$args){
		$user=$memberInfo['username'];
		$checkdetails=sqlValue("SELECT COUNT(*) FROM membership_userrecords WHERE memberID='$user' AND tableName='student_details'");
		if ($checkdetails>0) {
			# code...
			$_SESSION['custom_alert']="<b>Sorry you already have details in our database</b>";
			return FALSE;
		}
		return TRUE;
	}

	function student_details_after_insert($data, $memberInfo, &$args){

		return TRUE;
	}

	function student_details_before_update(&$data, $memberInfo, &$args){

		return TRUE;
	}

	function student_details_after_update($data, $memberInfo, &$args){

		return TRUE;
	}

	function student_details_before_delete($selectedID, &$skipChecks, $memberInfo, &$args){

		return TRUE;
	}

	function student_details_after_delete($selectedID, $memberInfo, &$args){

	}

	function student_details_dv($selectedID, $memberInfo, &$html, &$args){

	}

	function student_details_csv($query, $memberInfo, &$args){

		return $query;
	}
	function student_details_batch_actions(&$args){

		return array();
	}
