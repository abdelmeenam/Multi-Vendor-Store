(function(t){t(".item-quantity").on("change",function(a){t.ajax({url:"/cart/"+t(this).data("id"),method:"put",data:{quantity:t(this).val(),_token:csrf_token}})})})(jQuery);
