var capFirstLetter = function(word) {
    words = word.split(" ");
    for (index = 0; index < words.length; ++index) {
        words[index] = words[index].toLowerCase().replace(/\b[a-z]/g, function(letter) {
            return letter.toUpperCase();
        });
    }
    return words.join(" ");
};

var capSelf = function() {
    $(this).val(capFirstLetter($(this).val()));
}

var updateNameReview = function() {
    var fname = capFirstLetter($("#first_name").val());
    var lname = capFirstLetter($("#last_name").val());
    $("#first_name").val(fname);
    $("#last_name").val(lname);

    if(fname != "" && lname != "") {
        $("#name_review").text(lname + ", " + fname);
    }
};

var updateAddressReview = function() {
    var addr = capFirstLetter($("#ship_address").val());
    $("#ship_address").val(addr);
    if(addr != "") {
        $("#address_review").text(addr);
    }
};

var updateAddress2Review = function() {
    var city = capFirstLetter($("#ship_city").val());
    var zip = $("#ship_zip").val();
    var state = $("#ship_state").val();
    
    $("#ship_city").val(city);
    $("#ship_zip").val(zip);
    
    if(city != "" || zip != "" || state != "") {
        $("#address2_review").text(city + ", " + state + ", " + zip);
    }
};

var updatePrice = function() {
    var shipPrice = parseInt($("#ship_type").val());
    var dogPrice = parseInt($("#sub_price").text());
    var totalPrice = shipPrice + dogPrice;
    $("#sub_ship").text("$" + shipPrice);
    $("#calculated_total").text("$" + totalPrice);
};

var updateCreditCard = function() {
    var cn = $("#card_number").val();
    var cnLen = cn.length;
    var cnHide = "";
    for (var i = 0; i < cnLen - 4; i++) {
        cnHide = cnHide + "*";
    }
    cnHide = cnHide + cn.substring(cnLen - 4, cnLen);
    $("#card_review").text(cnHide);
};

var copyAddress = function() {
    $("#ship_state").val($("#bill_state").val());
    $("#ship_city").val(capFirstLetter($("#bill_city").val()));
    $("#ship_address").val(capFirstLetter($("#bill_address").val()));
    $("#ship_zip").val($("#bill_zip").val());
};

var copyUserInfo = function() {
    $("#first_name").val(capFirstLetter($("#session_fname").text()));
    $("#last_name").val(capFirstLetter($("#session_lname").text()));
    $("#telephone").val($("#session_phone").text());
    $("#email-address").val($("#session_email").text());
}

$(document).ready(function() {
    updatePrice();

    $("#useUserInfo").change(function() {
        if(this.checked) {
            copyUserInfo();
            updateNameReview();
        }
    });

    $('#sameAddr').change(function() {
        if($("#sameAddr").is(":checked")) {
            copyAddress();
            updateAddressReview();
            updateAddress2Review();            
        }
    });

    $("#last_name").focusout(updateNameReview);
    $("#first_name").focusout(updateNameReview);
    
    $("#bill_address").focusout(capSelf);
    $("#bill_city").focusout(capSelf);

    $("#ship_address").focusout(updateAddressReview);
    $("#ship_city").focusout(updateAddress2Review);
    $("#ship_state").change(updateAddress2Review);
    $("#ship_zip").focusout(updateAddress2Review);

    $("#telephone").focusout(function() {
        var telep = $("#telephone").val();
        $("#telephone_review").text(telep);
    });

    $("#card_number").focusout(updateCreditCard);

    $("#ship_type").change(updatePrice);
});