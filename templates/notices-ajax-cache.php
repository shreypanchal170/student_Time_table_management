<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function(){
		var tn = 'notices';

		/* data for selected record, or defaults if none is selected */
		var data = {
			school: <?php echo json_encode(array('id' => $rdata['school'], 'value' => $rdata['school'], 'text' => $jdata['school'])); ?>,
			department: <?php echo json_encode(array('id' => $rdata['department'], 'value' => $rdata['department'], 'text' => $jdata['department'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for school */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'school' && d.id == data.school.id)
				return { results: [ data.school ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for department */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'department' && d.id == data.department.id)
				return { results: [ data.department ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

