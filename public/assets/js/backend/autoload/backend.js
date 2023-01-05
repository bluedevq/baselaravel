if ('undefined' === $.type(Admin)) {
    var Admin = {};
}

if (!$.isPlainObject(Admin)) {
    Admin = {};
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

Admin.submitForm = function (form, url, showMessageError) {
    var formData = new FormData(form[0]);
    Admin.removeError();
    showLoading();

    sendRequest({
        url: url,
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
            let response = JSON.parse(res);

            if (!response.status) {
                hideLoading();
                let data = response.data;

                if (response.message) {
                    toastr.error(response.message);

                    return;
                }

                if (typeof showMessageError === 'function') {
                    showMessageError(data);
                } else {
                    Admin.parseError(data);
                }
            } else {
                let modalSuccess = form.find('button.btn-submit').attr('modal-success');

                if (typeof modalSuccess != 'undefined') {
                    hideLoading();
                    form.closest('.modal').modal('hide');
                    $(modalSuccess).modal('show');
                } else {
                    response.redirect_url ? (window.location = response.redirect_url) : location.reload();
                }
            }
        },
    }, function (response) {
        if (!response.ok) {
            location.reload();
        } else {
            showErrorFlash(response.message);
        }
    });
};

Admin.parseError = function (errors) {
    let firstElement = '';

    $.each(errors, function (field, mess) {
        let ele = '';
        let error = $('<p class="error">' + mess + '</p>');

        if ($('[name="' + field + '"]').length) {
            ele = $('[name="' + field + '"]');
        } else if ($('[name="' + field + '[]"]').length) {
            ele = $('[name="' + field + '[]"]');

            if (ele.closest('.show-one-message').length) {
                ele = ele.closest('.show-one-message');
            }
        }

        if (ele) {
            if (!firstElement) {
                firstElement = ele;
            }

            let showErrorOn = ele.closest('.show-error-on');

            if (showErrorOn.length > 0) {
                showErrorOn.append(error);
            } else {
                error.insertAfter(ele);
            }

            Admin.showBorderError();

            return true;
        }

        // show error multiple file
        let input = field.split('.');

        if ($('[name="' + input[0] + '[]"]').length) {
            $('#preview-file-' + input[0] + ' p.file-name').each(function (index, file) {
                if (index === parseInt(input[1])) {
                    error.insertAfter($(file));
                }
            })
        }
    });

    if (firstElement) {
        let position = firstElement.offset().top;

        if (firstElement.attr('name') === 'start_date') {
            position = $('.datepicker-range').offset().top
        }

        if (firstElement.closest('.modal').length > 0) {
            jQuery('.modal').animate({
                scrollTop: position - 150
            }, 1000);
        } else {
            jQuery('html, body').animate({
                scrollTop: position - 150
            }, 1000);
        }
    }
};

Admin.showBorderError = function () {
    $('.form-group').each(function () {
        let self = $(this);
        if ($(this).find('.error').length > 0) {
            self.find('.error').closest('div').find('.show-error').addClass('border-error');
        } else {
            self.find('.show-error').removeClass('border-error');
        }
    });
}

Admin.modalConfirmShow = function (callback, title = '') {
    let modalConfirm = $('#confirm-modal');
    if (title !== '') {
        modalConfirm.find('.modal-title').html(title);
    }
    modalConfirm.modal('show');
    modalConfirm.find('.confirm').off('click').click(callback);
}

Admin.removeError = function () {
    $('p.error').remove();
    $('.border-error').removeClass('border-error');
};

$('.action-delete').click(function () {
    Admin.deleteItem(this)
});

Admin.deleteItem = function (e) {
    showLoading();
    $('#delete-form').attr('action', $(e).data('action'));
    $('#delete-form').submit();

    return false;
};

Admin.formatMoney = function (e) {
    var money = Admin.formatNumber($(e).val());
    $(e).val(money);
};

Admin.formatNumber = function (number) {
    if (number !== '') {
        number = number.replace(/,/g, "");
        number = number.split('.', 2);

        if (number[0] && typeof number[1] == "undefined") {
            return number.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
        } else {
            return number[0].toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") + '.' + number[1];
        }
    }
};

$('.number-decimal').keypress(function (event) {
    if ((event.which != 46 || $(this).val().indexOf('.') != -1) &&
        ((event.which < 48 || event.which > 57) &&
            (event.which != 0 && event.which != 8))) {
        event.preventDefault();
    }

    var text = $(this).val();

    if ((text.indexOf('.') != -1) &&
        (text.substring(text.indexOf('.')).length > 2) &&
        (event.which != 0 && event.which != 8) &&
        ($(this)[0].selectionStart >= text.length - 2)) {
        event.preventDefault();
    }
});

$('.number-integer').keypress(function (event) {
    if (((event.which < 48 || event.which > 57) &&
        (event.which != 0 && event.which != 8))) {
        event.preventDefault();
    }

    var val = $(this).val();

    if (val != '') {
        $(this).val(parseInt(val));
    }
}).on('focusout', function () {
    var val = $(this).val();

    if (val != '') {
        $(this).val(parseInt(val));
    }
});

$(function () {
    $('.btn-submit').off('click').click(function () {
        let form = $(this).closest('form');
        Admin.submitForm(form, form.attr('action'));
        return false;
    });

    $('.btn-upload').on('click', function () {
        $(this).parent().find('.input-file').trigger('click');
    });

    $('.input-file').on('change', function () {
        previewFile(this);
    });
});

$('.ajax-submit-form').click(function (e) {
    let form = $(this).closest('form');

    if (form.hasClass('show-loading')) {
        showLoading();
    }

    form.submit();
});
