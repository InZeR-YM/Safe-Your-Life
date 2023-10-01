<?php 
if(isset($_GET['id'])){
    $user = $conn->query("SELECT * FROM customer_list where id ='{$_GET['id']}' ");
    foreach($user->fetch_array() as $k =>$v){
		if(!is_numeric($k))
        $$k = $v;
    }
}
?>
<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline rounded-0 card-danger">
	<div class="card-body">
		<div class="container-fluid">
			<div id="msg"></div>
			<form action="" id="update-form">	
				<input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<label for="firstname" class="control-label">Имя</label>
							<input type="text" class="form-control form-control-sm rounded-0" reqiured="" name="firstname" id="firstname" value="<?= isset($firstname) ? $firstname : '' ?>">
						</div>
						<div class="form-group">
							<label for="middlename" class="control-label">Отчество</label>
							<input type="text" class="form-control form-control-sm rounded-0" name="middlename" id="middlename" value="<?= isset($middlename) ? $middlename : '' ?>">
						</div>
						<div class="form-group">
							<label for="lastname" class="control-label">Фамилия</label>
							<input type="text" class="form-control form-control-sm rounded-0" reqiured="" name="lastname" id="lastname" value="<?= isset($lastname) ? $lastname : '' ?>">
						</div>
						<div class="form-group">
							<label for="gender" class="control-label">Пол</label>
							<select class="custom-select custom-select-sm rounded-0" reqiured="" name="gender" id="gender">
							<option <?= isset($gender) && $gender == 'Male' ? "selected" : '' ?>>Мужской</option>
							<option <?= isset($gender) && $gender == 'Female' ? "selected" : '' ?>>Женский</option>
							</select>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<label for="email" class="control-label">Почта</label>
							<input type="text" class="form-control form-control-sm rounded-0" reqiured="" name="email" id="email" value="<?= isset($email) ? $email : '' ?>">
						</div>
						<div class="form-group">
							<label for="contact" class="control-label">Контакт</label>
							<input type="text" class="form-control form-control-sm rounded-0" reqiured="" name="contact" id="contact" value="<?= isset($contact) ? $contact : '' ?>">
						</div>
						<div class="form-group">
							<label for="password" class="control-label">Новый пароль</label>
							<div class="input-group input-group-sm">
								<input type="password" class="form-control form-control-sm rounded-0" name="password" id="password">
								<button tabindex="-1" class="btn btn-outline-secondary btn-sm rounded-0 pass_view" type="button"><i class="fa fa-eye-slash"></i></button>
							</div>
						</div>
						<div class="form-group">
							<label for="cpassword" class="control-label">Подтвердите пароль</label>
							<div class="input-group input-group-sm">
								<input type="password" class="form-control form-control-sm rounded-0" id="cpassword">
								<button tabindex="-1" class="btn btn-outline-secondary btn-sm rounded-0 pass_view" type="button"><i class="fa fa-eye-slash"></i></button>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<label for="" class="control-label">Аватар</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input rounded-0" id="customFile" name="img" onchange="displayImg(this,$(this))" accept="image/png, image/jpeg">
								<label class="custom-file-label rounded-0" for="customFile">Выберите файл</label>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group d-flex justify-content-center">
							<img src="<?php echo validate_image(isset($avatar) ? $avatar : '') ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="card-footer">
			<div class="col-md-12">
				<div class="row">
					<button class="btn btn-sm btn-primary rounded-0 mr-3" form="update-form">Сохранить</button>
					<a href="./?page=customers/" class="btn btn-sm btn-default border rounded-0" form="update-form"><i class="fa fa-angle-left"></i> Отмена</a>
				</div>
			</div>
		</div>
</div>
<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
</style>
<script>
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }else{
			$('#cimg').attr('src', "<?php echo validate_image(isset($meta['avatar']) ? $meta['avatar'] :'') ?>");
		}
	}
	$('#update-form').submit(function(e){
		e.preventDefault();
		start_loader()
		$.ajax({
            url:_base_url_+"classes/Users.php?f=registration",
            method:'POST',
            type:'POST',
            data:new FormData($(this)[0]),
            dataType:'json',
            cache:false,
            processData:false,
            contentType: false,
            error:err=>{
                console.log(err)
                alert('Произошла ошибка.')
                end_loader()
            },
            success:function(resp){
                if(resp.status == 'success'){
                  location.reload()
                }else if(!!resp.msg){
                    el.html(resp.msg)
                    el.show('slow')
                    _this.prepend(el)
                    $('html, body').scrollTop(0)
                }else{
                    alert('Произошла ошибка.')
                    console.log(resp)
                }
                end_loader()
            }
        })
	})

</script>