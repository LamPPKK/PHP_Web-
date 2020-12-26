<?php
session_start();
    include('connection.php');
    include "partials/header.php";
?>
<div class="container">
<?php if(isset($_SESSION['statusRegiter']) ) { ?>
          <div class="row">
            <div class="col-12 col-xs-12 col-md-12 col-lg-12  pd-0 pd-t-15">
                <div class="alert alert-success mg-b-0 ">
                Đăng ký tài khoản thành công
                    <button type="button" class="close iconAlert" data-dismiss="alert" aria-label="Close">x</button>
                </div>
            </div>
        </div>
        <?php } ?>
       
       <?php   unset($_SESSION['statusRegiter']); ?>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Đăng ký tài khoản</div>

                <div class="card-body">
                    <form method="POST" action="controller/doRegister.php">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Họ và tên</label>

                            <div class="col-md-6">
                                <input id="name" required type="text" class="form-control " name="name" value=""  autocomplete="name" autofocus>

                               
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" required type="email" class="form-control " name="email" value=""  autocomplete="email">

                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Mật khẩu</label>

                            <div class="col-md-6">
                                <input id="password" required type="password" class="form-control " name="password"  autocomplete="new-password">

                               
                            </div>
                        </div>

                        

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Đăng ký
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include "partials/footer.php";
?>