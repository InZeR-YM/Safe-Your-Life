<?php require_once('./config.php') ?>
<!DOCTYPE html>
<html lang="ru" class="" style="height: auto;">
 <?php require_once('inc/header.php') ?>
<body class="hold-transition login-page">
  <script>
    start_loader()
  </script>
  <style>
    body{
      background-image: url("<?php echo validate_image($_settings->info('cover')) ?>");
      background-size:cover;
      background-repeat:no-repeat;
      backdrop-filter: contrast(1);
    }
    #page-title{
      text-shadow: 6px 4px 7px black;
      font-size: 3.5em;
      color: #fff4f4 !important;
      background: #8080801c;
    }
  </style>
  <h1 class="text-center text-white px-4 py-5" id="page-title"><b><?php echo $_settings->info('name') ?></b></h1>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-navy my-2">
    <div class="card-body">
      <p class="login-box-msg">Пожалуйста, заполните все необходимые поля</p>
      <form id="ulogin-form" action="" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" autofocus placeholder="Почта">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control"  name="password" placeholder="Пароль">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <a href="<?php echo base_url ?>">Вернуться на сайт</a>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Войти</button>
          </div>
          <!-- /.col -->
          <div class="col-12 text-center">
            <a href="<?php echo base_url ?>register.php">Зарегистрироваться</a>
          </div>
        </div>
      </form>
      <!-- /.social-auth-links -->

      <!-- <p class="mb-1">
        <a href="forgot-password.html">Забыли пароль?</a>
      </p> -->
      
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url ?>dist/js/adminlte.min.js"></script>

<script>
  $(document).ready(function(){
    end_loader();
    $('#ulogin-form').submit(function(e){
        e.preventDefault()
        var _this = $(this)
        var el = $('<div>')
            el.addClass('alert alert-danger err_msg')
            el.hide()
        $('.err_msg').remove()
        if($('#password').val() != $('#cpassword').val()){
            el.text('Пароли не совпадают')
            _this.prepend(el)
            el.show('slow')
            $('html, body').scrollTop(0)
            return false;
        }
        if(_this[0].checkValidity() == false){
            _this[0].reportValidity();
            return false;
        }
        start_loader()
        $.ajax({
            url:_base_url_+"classes/Login.php?f=login_customer",
            method:'POST',
            type:'POST',
            data:new FormData($(this)[0]),
            dataType:'json',
            cache:false,
            processData:false,
            contentType: false,
            error:err=>{
                console.log(err)
                alert('Произошла ошибка')
                end_loader()
            },
            success:function(resp){
                if(resp.status == 'success'){
                    location.href = ('./')
                }else if(!!resp.msg){
                    el.html(resp.msg)
                    el.show('slow')
                    _this.prepend(el)
                    $('html, body').scrollTop(0)
                }else{
                    alert('Произошла ошибка')
                    console.log(resp)
                }
                end_loader()
            }
        })
    })
  })
</script>
</body>
</html>