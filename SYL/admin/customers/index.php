<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<style>
    .customer-avatar{
        width:3rem;
        height:3rem;
        object-fit:scale-down;
        object-position:center center;
    }
</style>
<div class="card card-outline rounded-0 card-danger">
	<div class="card-header">
		<h3 class="card-title">Список покупателей</h3>
		<div class="card-tools">
			<a href="./?page=customers/manage_customer" id="create_new" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Создать новый</a>
		</div>
	</div>
	<div class="card-body">
        <div class="container-fluid">
			<table class="table table-hover table-striped table-bordered" id="list">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="20%">
					<col width="25%">
					<col width="20%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>Дата изменения</th>
						<th>Аватар</th>
						<th>Имя</th>
						<th>Почта</th>
						<th>Действие</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT *, concat(firstname,' ', coalesce(concat(middlename,' '), '') , lastname) as `name` from `customer_list` order by `name` asc ");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php echo date("Y-m-d H:i",strtotime($row['date_updated'])) ?></td>
							<td class="text-center">
                                <img src="<?= validate_image($row['avatar']) ?>" alt="" class="img-thumbnail rounded-circle customer-avatar">
                            </td>
							<td><?php echo $row['name'] ?></td>
							<td><?php echo $row['email'] ?></td>
							<td align="center">
								 <button type="button" class="btn btn-flat p-1 btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Действие
				                    <span class="sr-only">Включить выпадающий список</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item" href="./?page=customers/manage_customer&id=<?= $row['id'] ?>"><span class="fa fa-edit text-dark"></span> Редактировать</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Удалить</a>
				                  </div>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Вы уверены, что хотите безвозвратно удалить данную категорию?","delete_customer",[$(this).attr('data-id')])
		})
		$('.table').dataTable({
			columnDefs: [
					{ orderable: false, targets: [5] }
			],
			order:[0,'asc']
		});
		$('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle')
	})
	function delete_customer($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Users.php?f=delete_customer",
			method:"POST",
			data:{id: $id},
			dataType:'json',
			error:err=>{
				console.log(err)
				alert_toast("Произошла ошибка.",'error');
				end_loader();
			},
			success:function(resp){
				if(resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("Произошла ошибка.",'error');
					end_loader();
				}
			}
		})
	}
</script>