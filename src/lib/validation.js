function name_regex_jq(value) {
    let pattern = /^([a-zA-ZáàảãạăắằẳẵặâấầẩẫậéèẻẽẹêềếểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưừứửữựýỳỷỹỵÁÀẢÃẠĂẮẰẲẴẶÂẤẦẨẪẬÉÈẺẼẸÊỀẾỂỄỆÍÌỈĨỊÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢÚÙỦŨỤƯỪỨỬỮỰÝỲỶỸỴđĐ][\s]*){2,32}$/;
    return pattern.test(value);
}

function date_regex_jq(value) {
    let pattern = /^(19|20)\d{2}-(0[1-9]|1[0-2])-(0[1-9]|1\d|2\d|3[01])$/;
    let current = new Date().toISOString().split('T')[0];
    return pattern.test(value) && value < current;
}

function email_regex_jq(value) {
    let pattern = /^([A-Za-z]{2,32})([a-z0-9_]{0,32})@gmail(.[A-Za-z]{2,12})+$/;
    return pattern.test(value);
}

function phone_regex_jq(value) {
    let pattern = /^0[0-9]{9,11}$/;
    return pattern.test(value);
}