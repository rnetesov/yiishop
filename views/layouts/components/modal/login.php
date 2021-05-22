<?php

use yii\helpers\Url;

?>
<div class="modal fade" id="modal-login-form">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <form action="<?= Url::to(['customer/login']) ?>" method="post">
                    <h2 class="text-center">Login In</h2>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><b class="glyphicon glyphicon-user"></b></span>
                            <input type="text" class="form-control" placeholder="Email" name="email">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><b class="glyphicon glyphicon-lock"></b></span>
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Log in <b
                                    class="glyphicon glyphicon-log-in"></b></button>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 text-left">
                            <label for="remember">Remember Me</label>
                            <input type="checkbox" id="remember" name="remember">
                        </div>
                        <div class="col-lg-6 text-right">
                            <a href="#">Forgot Password?</a>
                        </div>
                    </div>
                </form>
                <div class="row text-center" style="margin-top: 20px">
                    <a href="" id="create-account-btn">Create an Account</a>
                </div>
            </div>
        </div>
    </div>
</div>