<?php

use yii\helpers\Url;

?>

<div class="modal fade" id="modal-register-form">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <form action="<?= Url::to(['customer/sign-up']) ?>" method="post">
                    <h2 class="text-center">Login Up</h2>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><b class="glyphicon glyphicon-user"></b></span>
                            <input type="text" class="form-control" placeholder="Login" name="login">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><b class=" glyphicon glyphicon-envelope"></b></span>
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
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>