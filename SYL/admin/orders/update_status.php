<?php 
require_once('../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `order_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<div class="container-fluid">
    <form action="" id="take-action-form">
        <input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>">
        <div class="form-group">
            <label for="status" class="control-label">Статус</label>
            <select class="form-control form-control-sm rounded-0" name="status" id="status" required="required">
                <option value="0" <?= isset($status) && $status == 0 ? 'selected' : '' ?>>Выполняется</option>
                <option value="1" <?= isset($status) && $status == 1 ? 'selected' : '' ?>>Упакован</option>
                <option value="2" <?= isset($status) && $status == 2 ? 'selected' : '' ?>>В доставке</option>
                <option value="3" <?= isset($status) && $status == 3 ? 'selected' : '' ?>>Выполнен</option>
            </select>
        </div>
    </form>
</div>
<script>
    $(function(){
        $('#take-action-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=update_order_status",
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
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            $("html, body, .modal").scrollTop(0);
                            end_loader()
                    }else{
						alert_toast("Произошла ошибка",'error');
						end_loader();
                        console.log(resp)
					}
				}
			})
		})
    })
</script>