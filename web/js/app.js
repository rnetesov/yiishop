$(document).ready(function () {
    function changeIndicateTotalQtyItemsInCart() {
        $.get('/cart/total-qty', function (data) {
            $('#cart-total-items').text(data.qty);
        });
    }

    function changeTotalPriceInCart() {
        $.get('/cart/total-price', function (data) {
            if (data.status === 'ok') {
                $shoppingCart.find('.total-price-item').text('$' + data.price);
            }
        });
    }
    function changeIndicateTotalPrice()
    {
        $.get('/cart/total-price', function (data) {
            if (data.status === 'ok') {
                $('#cart-indicate span.total-price').text(data.price);
            }
        })
    }

    let $shoppingCart = $('#shopping-cart');

    $('#row-products').on('click', '.add-to-cart-btn', function (e) {
        e.preventDefault();
        let $btnElem = $(this);
        let url = $(this).attr('href') + '&qty=1';
        $.get(url, function (data) {
            if (data.status === 'ok') {
                changeIndicateTotalQtyItemsInCart();
                changeIndicateTotalPrice();
                let btn = `<a href="/cart/index" 
                            class="glyphicon glyphicon-ok" style="color: #e38d13; border-color: #e38d13"></a>`;
                $btnElem.replaceWith(btn);
            }
        });
    });

    $shoppingCart.on('click', '.remove-from-cart-btn', function () {
        let $removeBtn = $(this);
        let url = '/cart/delete?code=' + $(this).data('product-code');
        $.get(url, function (data) {
            if (data.status === 'ok') {
                $removeBtn.closest('tr').fadeOut(500, function () {
                    $(this).remove();

                    changeIndicateTotalQtyItemsInCart();
                    changeTotalPriceInCart();
                    /**
                     * Если в корзине не осталось больше товаров
                     * но остался заголовок и футер таблицы
                     */
                    if ($shoppingCart.find('tr').length === 3) {
                        $shoppingCart.replaceWith('<p>Cart is empty</p>');
                    }
                });
            }
        });
    });

    $shoppingCart.on('change', '.change-qty-cart-input', function () {
        let qty = +$(this).val();
        let inputElem = $(this);
        $formGroupElem = $(this).closest('.form-group');

        if (!isNaN(qty) && qty > 0 && qty < 1000) {
            if ($formGroupElem.hasClass('has-error')) {
                $formGroupElem.removeClass('has-error');
            }
            let code = $(this).data('product-code');
            $.get(`/cart/update?code=${code}&qty=${qty}`, function (data) {
                if (data.status === 'ok') {
                    $.get(`/cart/total-price-item?code=${code}`, function (data) {
                        inputElem.closest('tr').find('td.total-price').text('$' + data.price);
                    });

                    changeTotalPriceInCart();
                    changeIndicateTotalQtyItemsInCart();
                    changeIndicateTotalPrice();
                }
            });
        } else {
            $formGroupElem.addClass('has-error');
        }
    });

    $shoppingCart.find('.clear-shopping-cart-btn').click(function (e) {
        e.preventDefault();
        $.get('/cart/clear', function () {
            changeIndicateTotalPrice();
            $('#cart-total-items').text(0);
            $('#shopping-cart').replaceWith('<p>Cart is empty</p>');
        });
    });

    $('#login-in-link').click(function () {
        $('#modal-login-form').modal('show');
    });

    $('#modal-login-form').find('form').submit(function (e) {
        e.preventDefault();

        $(this).find('label.control-label').remove();
        $(this).find('.form-group').removeClass('has-error');
        $(this).find('div.error-msg').remove();

        let email = $(this.email);
        let password = $(this.password);

        let emailVal = email.val().trim();
        let passwordVal = password.val().trim();
        let remember = $(this.remember).prop('checked');

        if (!emailVal) {
            email.closest('.form-group')
                .addClass('has-error')
                .prepend('<label class="control-label" for="inputError2">This field must be filled</label>');
        }

        if (!passwordVal) {
            password.closest('.form-group')
                .addClass('has-error')
                .prepend('<label class="control-label" for="inputError2">This field must be filled</label>');
        }

        if (emailVal && passwordVal) {
            data = {email: emailVal, password: passwordVal, [yii.getCsrfParam()] : yii.getCsrfToken()}

            if (remember) {
                data.remember = 'on';
            }

            let action = $(this).attr('action');

            $.post(action, data).done(function (data) {
                if (data === 'error') {
                    let errorHtml = `<div class="row error-msg"><p class="col-lg-12 text-left" 
                                           style="color: #b92c28">Invalid email or password</p></div>`;
                    password.closest('.form-group').after(errorHtml);
                }
                if (data === 'success') {
                    window.location.reload();
                }
            });
        }

    });

    $('#create-account-btn').click(function (e) {
        e.preventDefault();
        $('#modal-login-form').modal('hide');
        $('#modal-register-form').modal('show');
    });

    $modalRegisterWnd = $('#modal-register-form');

    $modalRegisterWnd.find('form').submit(function (e) {
        e.preventDefault();
        $(this).find('label').remove();
        $(this).find('.form-group').each(function () {
            if ($(this).hasClass('has-error')) {
                $(this).removeClass('has-error');
            }
        });

        let form = this;
        let action = $(this).attr('action');
        let data = {
            'email' : $(form.email).val(),
            'login' : $(form.login).val(),
            'password' : $(form.password).val()
        };

        $.post(action, data).done(function (data) {
            if (data.status === 'success') {
                $modalRegisterWnd.modal('hide');
                $('#modal-login-form').modal('show');
            }
            if (data.status === 'error') {
                let errors = data.errors;
                for (let field in errors) {
                    if (form[field]) {
                        $(form[field]).closest('.form-group').addClass('has-error');
                        for (let k in errors[field]) {
                            let label = `<label class="control-label" for="">${errors[field][k]}</label>`;
                            $(form[field]).closest('.form-group').prepend(label);
                        }
                    }
                }
            }
        });
    });

    $modalRegisterWnd.on('hidden.bs.modal', function () {
        $(this).find('label').remove();
        $(this).find('.form-group').each(function () {
            if ($(this).hasClass('has-error')) {
                $(this).removeClass('has-error');
            }
        });
    });
});