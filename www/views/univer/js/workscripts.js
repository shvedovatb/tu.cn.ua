$(document).ready(function(){
    /* ===Аккордеон=== */
$(".category").dcAccordion();
    /* ===Аккордеон=== */ 
    /*статистика: очищем список преподавателей при выборе новой кафедры
	$('select[name="departments"]').on('change', function() {
		$('select[name="staff"]').empty();
	});
	 /*статистика: очищем список преподавателей при выборе новой кафедры*/
});
$(document).ready(function() {
$('#keyword').on('input', function() {
	var searchKeyword = $(this).val();
	if (searchKeyword.length >= 1) {
		$.ajax({
			url:"/index.php",
			type:"GET",
			dataType:"json",
			data:({view: 'search', keywords: searchKeyword }),
			error:function(p, q, r) {alert(p+q+r)},
			success:function(data){
				if ($('select#content').css('display')=='none') {$('select#content').show()};
				$('select#content').empty()
				$.each(data, function() {
					$('select#content').append($('<option value="' + this.staff_id + '">' + this.f_name +' '+this.s_name+' '+this.l_name+' '+this.dep_name+'</option>'));
				});
			}	
		});
	}
});	
});	

