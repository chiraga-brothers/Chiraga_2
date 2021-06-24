var validate = function () {

    var flag = true;

    removeElementsByClass("error");
    removeClass("error-form");

    // お名前の入力をチェック
    if (document.form.user_name.value == "") {
        errorElement(document.form.user_name, "お名前が入力されていません");
        flag = false;
    }

    // メールアドレスの入力をチェック
    if (document.form.mail.value == "") {
        errorElement(document.form.mail, "メールアドレスが入力されていません");
        flag = false;
    } else {
        // メールアドレスの形式をチェック
        if (!validateMail(document.form.mail.value)) {
            errorElement(document.form.mail, "メールアドレスが正しくありません");
            flag = false;
        }
    }

    // パスワードの入力をチェック
    if (document.form.password.value == "") {
        errorElement(document.form.password, "パスワードが入力されていません");
        flag = false;
    }

    // 住所の入力をチェック
    if (document.form.address.value == "") {
        errorElement(document.form.address, "住所が入力されていません");
        flag = false;
    }

    // 電話番号の入力をチェック
    if (document.form.phone.value == "") {
        errorElement(document.form.phone, "電話番号が入力されていません");
        flag = false;
    } else {
        // 電話番号の形式をチェック
        if (!validateNumber(document.form.phone.value)) {
            errorElement(document.form.phone, "半角数字のみを入力してください");
            flag = false;
        } else {
            if (!validateTel(document.form.phone.value)) {
                errorElement(document.form.phone, "電話番号が正しくありません");
                flag = false;
            }
        }
    }

    return flag;

}




var errorElement = function (form, msg) {
    form.className = "error-form";
    var newElement = document.createElement("div");
    newElement.className = "error";
    var newText = document.createTextNode(msg);
    newElement.appendChild(newText);
    form.parentNode.insertBefore(newElement, form.nextSibling);
}


var removeElementsByClass = function (className) {
    var elements = document.getElementsByClassName(className);
    while (elements.length > 0) {
        elements[0].parentNode.removeChild(elements[0]);
    }
}

var removeClass = function (className) {
    var elements = document.getElementsByClassName(className);
    while (elements.length > 0) {
        elements[0].className = "";
    }
}

var validateMail = function (val) {
    if (val.match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/) == null) {
        return false;
    } else {
        return true;
    }
}


var validateNumber = function (val) {
    if (val.match(/[^0-9]+/)) {
        return false;
    } else {
        return true;
    }
}


var validateTel = function (val) {
    if (val.match(/^[0-9-]{6,13}$/) == null) {
        return false;
    } else {
        return true;
    }
}


var validateKana = function (val) {
    if (val.match(/^[ぁ-ん]+$/) == null) {
        return false;
    } else {
        return true;
    }
}