<?php
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `category_list` where id = '{$_GET['id']}' and delete_flag = 0 ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<div class="content py-5 px-3 bg-gradient-danger">
	<h2><b>Подробности категории</b></h2>
</div>
<div class="row mt-lg-n4 mt-md-n4 justify-content-center">
	<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
		<div class="card rounded-0">
			<div class="card-body">
                <div class="container-fluid">
                    <dl>
                        <dt class="text-muted">Категория</dt>
                        <dd class="pl-4"><?= isset($name) ? $name : "" ?></dd>
                        <dt class="text-muted">Описание</dt>
                        <dd class="pl-4"><?= isset($description) ? str_replace(["\n\r", "\n", "\r"],"<br>", $description) : '' ?></dd>
                        <dt class="text-muted">Статус</dt>
                        <dd class="pl-4">
                            <?php if($status == 1): ?>
                                <span class="badge badge-success px-3 rounded-pill">Активный</span>
                            <?php else: ?>
                                <span class="badge badge-danger px-3 rounded-pill">Отключён</span>
                            <?php endif; ?>
                        </dd>
                    </dl>
                </div>
            </div>
			<div class="card-footer py-1 text-center">
				<button class="btn btn-danger btn-sm bg-gradient-danger rounded-0" type="button" id="delete_data"><i class="fa fa-trash"></i> Удалить</button>
				<a class="btn btn-primary btn-sm bg-gradient-primary rounded-0" href="./?page=categories/manage_category&id=<?= isset($id) ? $id : '' ?>"><i class="fa fa-edit"></i> Редактировать</a>
				<a class="btn btn-light btn-sm bg-gradient-light border rounded-0" href="./?page=categories"><i class="fa fa-angle-left"></i> Вернуться к списку</a>
			</div>
		</div>
	</div>
</div>
<script>
    $(function(){
		$('#delete_data').click(function(){
			_conf("Вы уверены, что хотите безвозвратно удалить эту категорию?","delete_category", ["<?= isset($id) ? $id :'' ?>"])
		})
    })
    function delete_category($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_category",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("Произошла ошибка.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.replace("./?page=categories");
				}else{
					alert_toast("Произошла ошибка.",'error');
					end_loader();
				}
			}
		})
	}
</script>