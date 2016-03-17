$(document).ready(function(){
	
	/* ===Аккордеон=== */
    var openItem = false;
	if(jQuery.cookie("openItem") && jQuery.cookie("openItem") != 'false'){
		openItem = parseInt(jQuery.cookie("openItem"));
	}	
	jQuery("#accordion").accordion({
		active: openItem,
		collapsible: true,
        autoHeight: false,
        header: 'h3'
	});
	jQuery("#accordion h3").click(function(){
		jQuery.cookie("openItem", jQuery("#accordion").accordion("option", "active"));
	});	
	jQuery("#accordion > li").click(function(){
		jQuery.cookie("openItem", null);
        var link = jQuery(this).find('a').attr('href');
        window.location = link;
	});
    /* ===Аккордеон=== */
    
    // удаление
    $(".del").click(function(){
        var res = confirm("Подтвердите удаление");
        if(!res) return false;
    });
    // удаление
    
    // слайд информеров
    $(".toggle").click(function(){
        $(this).parent().next().slideToggle(500);
        
        if($(this).parent().attr("class") == "inf-down"){
            $(this).parent().removeClass("inf-down");
            $(this).parent().addClass("inf-up");
        }else{
            $(this).parent().removeClass("inf-up");
            $(this).parent().addClass("inf-down");
        }
    });
    // слайд информеров
    
    // поля картинок галереи
    var max = 5;
    var min = 1;
    $("#del").attr("disabled", true);
    $("#add").click(function(){
        var total = $("input[name='galleryimg[]']").length;
        if(total < max){
            $("#btnimg").append('<div><input type="file" name="galleryimg[]" /></div>');
            if(max == total + 1){
                $("#add").attr("disabled", true);
            }
            $("#del").removeAttr("disabled");
        }
    });
    $("#del").click(function(){
        var total = $("input[name='galleryimg[]']").length;
        if(total > min){
           $("#btnimg div:last-child").remove();
           if(min == total - 1){
                $("#del").attr("disabled", true);
           }
           $("#add").removeAttr("disabled");
        }
    });
    // поля картинок галереи
    
    // удаление картинок
    $(".delimg").on("click", function(){
        var res = confirm("Подтвердите удаление");
        if(!res) return false;
        
        var img = $(this).attr("alt"); // имя картинки
        var rel = $(this).attr("rel"); // 0 - базовая картинка, 1 - картинка галереи
        var goods_id = $("#goods_id").text(); // ID товара
        $.ajax({
            url: "./",
            type: "POST",
            data: {img: img, rel: rel, goods_id: goods_id},
            success: function(res){
                if(rel == 0){
                    // базовая картинка
                    $(".baseimg").fadeOut(500, function(){
                        $(".baseimg").empty().fadeIn(500).html(res);
                    });
                }else{
                    // картинка галереи
                    $(".slideimg").find("img[alt='" + img + "']").hide(500);
                }
            },
            error: function(){
                alert("Error");
            }
        });
    });
    // удаление картинок
    
    //сортировка страниц
	//применяем метод sortable
    $( "#sort tbody" ).sortable({
		//стиль для пустого места - куда можно перемещать объект при сортировке.
    	placeholder: "ui-state-highlight",
		//исключяаем элементы которые не нужно сортировать - хедер таблицы страниц
		items: "tr:not(.no_sort)",
		//перемещение объектов только по вертикали
		axis: "y",
		//прозрачность элементов при перетаскивании
		opacity: 0.5,
		//окончание перемещения
		stop: function(){
			//получаем массив идентификаторов страниц - в новом порядке, для каждой строки таблицы был добавлен атрибут id
			var id_s = $('#sort tbody').sortable("toArray");
			//показ блока с вращающимся изображением - начало сортировки
			$(".load").fadeIn(300);
			//применяем аякс и отправляем массив идентификаторов методом ПОСТ в файл index.php
			$.ajax({
				url: 'index.php',
				type: 'POST',
				data: {sortable:id_s},
				error: function(){
					//если ошибка то показываем блок  с соответстующим сообщением
					$(".load").fadeOut(200);
					$('#res').text("Ошибка!").fadeIn(300);
				},
				//если все хорошо
				success: function(html){
					//плавно скрываем вращающиеся изображение и...
					$(".load").fadeOut(200,function () {
						//проверяем что вернулось нам в качестве ответа, если вернулся массив
						if(html) {
						///
							//то сохраняем этот массив в переменную arr
							var arr = JSON.parse(html);
							// в цикле проходимся по массиву и записываем новые значения позиций страниц в соответствующий столбец таблицы
							for(var i = 0; i < arr.length; i++) {
								var p = "#"+arr[i]['page_id']+ ">.position";
								$(p).text(arr[i]['position']);
							}
						///
							//Показываем блок с сообщением об успешности выполнения сортировки.
							$(".res").text("Изменения сохранены").stop(true, true).fadeIn(300).fadeOut(2000);
						}
						if(!html){
						//если ЛОЖЬ то выводим сообщение о ошибке
							$(".res").text("Ошибка").css({"border":"1px solid red","backgroundColor":"#ffb7b7"}).fadeIn(300).fadeOut(5000);
						}	
					});	
				}
			});
		} 
   	});
	//запрет выделения
    $( "#sort tbody" ).disableSelection();
	//сортировка страниц
    
    //сортировка ссылок - аналогично страницам, только передаем в файл index.php кроме идентификаторов,идентификатор информера к которому принадлежат ссылки
	$(".inf-page tbody").sortable({
		axis: "y",
		opacity: 0.5,
		placeholder: "ui-state-highlight1",
		items: "tr:not(.no_sort)",
		stop: function(){
			// идентификаторы ссылок после перемещения
			var id_s = $(this).sortable("toArray");
			//идентификатор родительского информера
			var parent = $(this).parent().attr('id');
			$(".load").fadeIn(300);
			
			$.ajax({
				url: 'index.php',
				type: 'POST',
				data: {sort_link:id_s,parent:parent},
				error: function(){
					$(".load").fadeOut(200);
					$('#res').text("Ошибка!").fadeIn(300);
				},
				success: function(html){
					$(".load").fadeOut(200,function () {
						if(html) {
							var arr1 = JSON.parse(html);
							for(var i = 0; i < arr1.length; i++) {
								
								var p = ".inf-page>table#"+parent+" #"+arr1[i]['link_id']+ " .position";
								$(p).text(arr1[i]['links_position']);
							}
						///
							$(".res").text("Изменения сохранены").stop(true, true).fadeIn(300).fadeOut(2000);
						}
						if(!html){
							$(".res").text("Ошибка").css({"border":"1px solid red","backgroundColor":"#ffb7b7"}).fadeIn(300).fadeOut(5000);
						}
					
					});
					
				}
			
			});
		}
   	});
	//сортировка информеров - аналогично страницам
	$("#sotr_inf").sortable({
		axis: "y",
		opacity: 0.5,
		placeholder: "ui-state-highlight2",
		delay: 200,
		stop: function(){
			var id_s = $(this).sortable("toArray");
			$(".load").fadeIn(300);
			
			$.ajax({
				url: 'index.php',
				type: 'POST',
				data: {sort_inf:id_s},
				error: function(){
					$(".load").fadeOut(200);
					$('#res').text("Ошибка!").fadeIn(300);
				},
				success: function(html){
					$(".load").fadeOut(200,function () {
						if(html) {
						///
							$(".res").text("Изменения сохранены").stop(true, true).fadeIn(300).fadeOut(2000);
						}
						if(!html){
							$(".res").text("Ошибка").css({"border":"1px solid red","backgroundColor":"#ffb7b7"}).fadeIn(300).fadeOut(5000);
						}
					
					});
					
				}
			
			});
		}	
		
	});
	//сортировка информеров
      
});