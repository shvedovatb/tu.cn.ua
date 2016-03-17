$(document).ready(function(){
    /* ===Аккордеон=== */
$(".category").dcAccordion();
    /* ===Аккордеон=== */ 
    /*статистика: очищем список преподавателей при выборе новой кафедры*/
	$('select[name="departments"]').on('change', function() {
		$('select[name="staff"]').empty();
	});
	 /*статистика: очищем список преподавателей при выборе новой кафедры*/
	
	});