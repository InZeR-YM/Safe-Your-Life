<?php
require_once('../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `stock_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<div class="container-fluid">
    <form action="" id="stock-form">
        <input type="hidden" name="id" value='<?= isset($id) ? $id : '' ?>'>
        <input type="hidden" name="product_id" value='<?= isset($product_id) ? $product_id : (isset($_GET['pid']) ? $_GET['pid'] : '') ?>'>
        <div class="form-group">
            <label for="code" class="control-label">Код</label>
            <input type="text" class="form-control form-control-sm rounded-0" name="code" id="code" required="required" value="<?= isset($code) ? $code : '' ?>">
        </div>
        <div class="form-group">
            <label for="quantity" class="control-label">Количество (шт.)</label>
            <input type="number" class="form-control form-control-sm rounded-0 text-right" name="quantity" id="quantity" required="required" value="<?= isset($quantity) ? $quantity : '' ?>">
        </div>
        <div class="form-group">
            <label for="expiration" class="control-label">Срок годности</label>
            <input type="date" class="form-control form-control-sm rounded-0 text-right" name="expiration" id="expiration" value="<?= isset($expiration) && !empty($expiration) ? date("Y-m-d", strtotime($expiration)) : '' ?>">
            <small class="text-muted"><i>Оставьте поле со сроком годности пустым, если он не ограничен.</i></small>
        </div>
    </form>
</div>
<script>
    $(function(){
        $('#stock-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
             var el = $('<div>')
                 el.addClass("alert alert-danger err-msg")
                 el.hide()
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_stock",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("Произошла ошибка",'error');
					end_loader();
				},
				success:function(resp){
					if(typeof resp =='object' && resp.status == 'success'){
						location.reload()
					}else if(resp.status == 'failed' && !!resp.msg){
                            el.text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            $("html, body, .modal").scrollTop(0);
                    }else{
						alert_toast("Произошла ошибка",'error');
						end_loader();
					}
                    end_loader()
				}
			})
		})
    })
</script>