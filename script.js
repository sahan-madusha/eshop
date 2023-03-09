function changeView(){
    var signUpBox =document.getElementById("signUpBox");
    var signInBox =document.getElementById("signInBox");

    signUpBox.classList.toggle("d-none");
    signInBox.classList.toggle("d-none");
    //toggle -- class list eka balala d-none innawanam eka ayin karanawa , d-none nattan d-none add karanawa
}




function signUp(){
    var f = document.getElementById("f");
    var l = document.getElementById("l");
    var e = document.getElementById("e");
    var p = document.getElementById("p");
    var m = document.getElementById("m");
    var g = document.getElementById("g");


    var form = new FormData();
    form.append("f",f.value);
    form.append("l",l.value);
    form.append("e",e.value);
    form.append("p",p.value);
    form.append("m",m.value);
    form.append("g",g.value);

    var request = new XMLHttpRequest();
    
    request.onreadystatechange = function(){
        if(request.readyState == 4){
            var text = request.responseText;
            document.getElementById("msg").innerHTML = text;
            document.getElementById("msgdiv").className = "d-block";
            if(text == "success"){
                document.getElementById("msgbox").className = "alert alert-success";
            }
        }
    }

    request.open("POST", "./signUpProcess.php" ,true);
    request.send(form);
}





function signIn(){
    var email2 = document.getElementById("email2");
    var password2 = document.getElementById("password2");
    var rememberme = document.getElementById("rememberme");

    var form = new FormData();
    form.append("email2",email2.value);
    form.append("password2",password2.value);
    form.append("rememberme",rememberme.checked);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        if(request.readyState == 4){
            var text = request.responseText;
            if(text=="success"){
                window.location ="./home.php";
            }else{
                document.getElementById("msg2").innerHTML = text;
                document.getElementById("msgdiv2").className = "d-block";
            }
        }
    }
    
    request.open("POST", "./signIpProcess.php" ,true);
    request.send(form);
}








var bm;
function forgotPassword(){
    var email = document.getElementById("email2");
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                alert("Verification code has sent to your email. Please check your inbox");
                var m = document.getElementById("forgotPasswordModal");
                bm = new bootstrap.Modal(m);
                bm.show();
            }else{
                alert(t);
            }
            
        }
    }

    r.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
    r.send();

}
function showPassword1(){

    var i = document.getElementById("npi");
    var eye = document.getElementById("e1");

    if(i.type == "password"){
        i.type = "text";
        eye.className = "bi bi-eye-fill";
    }else{
        i.type = "password";
        eye.className = "bi bi-eye-slash-fill";
    }

}

function showPassword2(){

    var i = document.getElementById("rnp");
    var eye = document.getElementById("e2");

    if(i.type == "password"){
        i.type = "text";
        eye.className = "bi bi-eye-fill";
    }else{
        i.type = "password";
        eye.className = "bi bi-eye-slash-fill";
    }

}

function resetpw(){

    var email = document.getElementById("email2");
    var np = document.getElementById("npi");
    var rnp = document.getElementById("rnp");
    var vcode = document.getElementById("vc");
    
    var f = new FormData();
    f.append("e",email.value);
    f.append("n",np.value);
    f.append("r",rnp.value);
    f.append("v",vcode.value);
    
    var r = new XMLHttpRequest();
    
    r.onreadystatechange = function (){
        if(r.readyState == 4){
            var t = r.responseText;
            if(t == "success"){
    
                bm.hide();
                alert ("Password reset success");
    
            }else{
                alert (t);
            }
            
        }
    };
    
    r.open("POST","resetPassword.php",true);
    r.send(f);

}

function signout(){
    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState == 4){
            var t = r.responseText;
            if(t == "success"){

                // window.location = "home.php";
                window.location.reload();

            }else{
                alert (t);
            }
        }
    };

    r.open("GET","signoutProcess.php",true);
    r.send(); 
}

function changeImage(){
    var view = document.getElementById("viewImg");
    var file = document.getElementById("profileimg");

   file.onchange = function (){
       var file1 = this.files[0];
       var url = window.URL.createObjectURL(file1);
       view.src = url;
   };
}


function updateProfile(){
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var province = document.getElementById("province");
    var district = document.getElementById("district");
    var city = document.getElementById("city");
    var pcode = document.getElementById("pcode");
    var image = document.getElementById("profileimg");

    var f = new FormData();
    f.append("fn",fname.value);
    f.append("ln",lname.value);
    f.append("m",mobile.value);
    f.append("l1",line1.value);
    f.append("l2",line2.value);
    f.append("p",province.value);
    f.append("d",district.value);
    f.append("c",city.value);
    f.append("pc",pcode.value);

   if (image.files.length == 0) {
       var confirmation = confirm("Are you sure You don't want to update Profile Image?");
       if (confirmation) {
           alert("you have not selected any image.");
       }

   } else {
       f.append("image", image.files[0]);
   }

   var r = new XMLHttpRequest();

   r.onreadystatechange = function () {
       if (r.readyState == 4) {
           var t = r.responseText;
           if (t == "success") {
            window.location.reload();
        } else {
            alert(t);
        }
       }
   } 

   r.open("POST","./updateProfileProcess.php",true);
   r.send(f);
}


function load_brand() {

    var category = document.getElementById("category").value;

   var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            //alert(t);
            document.getElementById("brand").innerHTML = t;
        }
    }

    r.open("GET", "./loadBrand.php?c=" + category, true);
    r.send();

}

function load_model(){
    var brand = document.getElementById("brand").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            //alert(t);
            document.getElementById("model").innerHTML = t;
        }
    }
    r.open("GET", "./loadModel.php?c=" + brand, true);
    r.send();
}




function changeStatus(id) {
    var product_id = id;
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "deactivated") {
                alert("Product Deactivated");
                window.location.reload();
            } else if (t == "activated") {
                alert("Product Activated");
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }
    r.open("GET", "changeStatusProcess.php?p=" + product_id, true);
    r.send();

}



function changeProductImage (){
    var image = document.getElementById("imageuploader");

    image.onchange = function (){
        var file_count = image.files.length;

        if(file_count <= 3){
            for (var x = 0; x < file_count; x++) {
                var file = this.files[x];
                var url = window.URL.createObjectURL(file);

                document.getElementById("i" + x).src = url;
            }
        }else{
            alert("Please select 3 or less than 3 images.");
        }
    }
}

function addProduct() {
    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var model = document.getElementById("model");
    var title = document.getElementById("title");

    var condition = 0;
    if (document.getElementById("b").checked) {
        condition = 1;
    } else if (document.getElementById("u").checked) {
        condition = 2;
    }

    var colour = document.getElementById("clr");
    var colour_input = document.getElementById("clr_in");
    var qty = document.getElementById("qty");
    var cost = document.getElementById("cost");
    var dwc = document.getElementById("dwc");
    var doc = document.getElementById("doc");
    var desc = document.getElementById("desc");
    var image = document.getElementById("imageuploader");

    var f = new FormData();

    f.append("ca", category.value);
    f.append("b", brand.value);
    f.append("m", model.value);
    f.append("t", title.value);
    f.append("con", condition);
    f.append("col", colour.value);
    f.append("col_in", colour_input.value);
    f.append("qty", qty.value);
    f.append("cost", cost.value);
    f.append("dwc", dwc.value);
    f.append("doc", doc.value);
    f.append("desc", desc.value);

    var file_count = image.files.length;

    for (var x = 0; x < file_count; x++) {
        f.append("image" + x, image.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
           if (t == "Product image saved successfully") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "addProductProcess.php", true);
    r.send(f);
}



function sort1(x){
    var search = document.getElementById("s");

    var time = "0";
    if(document.getElementById("n").checked){
        time = "1"; 
    }else if(document.getElementById("o").checked){
        time = "2";
    }

    var qty = "0";
    if(document.getElementById("h").checked){
        qty = "1"; 
    }else if(document.getElementById("l").checked){
        qty = "2";
    }

    var condition = "0";
    if(document.getElementById("b").checked){
        condition = "1"; 
    }else if(document.getElementById("u").checked){
        condition = "2";
    }

    var f = new FormData();
    f.append("s" , search.value);
    f.append("t" , time);
    f.append("q" , qty);
    f.append("c" , condition);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState == 4){
            var t = r.responseText;
            //alert(t);
            document.getElementById("sort").innerHTML = t;
        }
    }

    r.open("POST","./sortprocess.php",true);
    r.send(f);
}

function clearSort() {
    window.location.reload();
}


function sendId(id){
    var r = new XMLHttpRequest;

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            //alert(t);
            if(t == "success"){
                window.location = "./updateProduct.php";
            }
        }
    }

    r.open("GET","./sendPoductId.php?id=" + id ,true)
    r.send();
}


function updateProduct() {

    var title = document.getElementById("t");
    var qty = document.getElementById("q");
    var delivery_within_colombo = document.getElementById("dwc");
    var delivery_outof_colombo = document.getElementById("doc");
    var description = document.getElementById("d");
    var images = document.getElementById("imageuploader");

    var f = new FormData();

    f.append("t", title.value);
    f.append("q", qty.value);
    f.append("dwc", delivery_within_colombo.value);
    f.append("doc", delivery_outof_colombo.value);
    f.append("d", description.value);

    var img_count = images.files.length;

    for (var x = 0; x < img_count; x++) {
        f.append("i" + x, images.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
        }
    }

    r.open("POST", "./updateProcess.php", true);
    r.send(f);

}


function advancedSearch(x) {
    var txt = document.getElementById("t");
    var category = document.getElementById("c1");
    var brand = document.getElementById("b");
    var model = document.getElementById("m");
    var condition = document.getElementById("c2");
    var color = document.getElementById("c3");
    var from = document.getElementById("pf");
    var to = document.getElementById("pt");
    var sort = document.getElementById("s");

    var f = new FormData();
    f.append("t", txt.value);
    f.append("cat", category.value);
    f.append("b", brand.value);
    f.append("m", model.value);
    f.append("con", condition.value);
    f.append("col", color.value);
    f.append("pf", from.value);
    f.append("to", to.value);
    f.append("s", sort.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            //alert(t)
            document.getElementById("view_area").innerHTML = t;
        }
    }

    r.open("POST", "./advancedSearchProcess.php", true);
    r.send(f);
}


function loadMainImg(id){
    var img = document.getElementById("productImg" + id).src;
    document.getElementById("main_img").src = img ;
}

function checkValue(qty){
    var input = document.getElementById("qty_input");

   if (input.value <= 0) {
       alert("Quantity must be 1 or more");
   } else if (input.value > qty) {
       alert("Maximum quantity achieved");
       input.value = qty;
   }
}

function qty_inc(qty) {
    var input = document.getElementById("qty_input");
    if (input.value < qty) {
        var newValue = parseInt(input.value) + 1;
        input.value = newValue.toString();
    } else {
        alert("Maximum quantity has achieved");
        input.value = qty;
    }
}

function qty_dec() {
    var input = document.getElementById("qty_input");
    if (input.value > 1) {
        var newValue = parseInt(input.value) - 1;
        input.value = newValue.toString();
    } else {
        alert("Minimum quantity has achieved");
        input.value = 1;
    }
} 





function addToWatchlist(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "removed") {
                document.getElementById("heart" + id).style.className = "text-dark";
                window.location.reload();
            } else if (t == "added") {
                document.getElementById("heart" + id).style.className = "text-danger";
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "addToWatchlistProcess.php?id=" + id, true);
    r.send();
}

function removeFromWatchlist(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "removeWatchlistProcess.php?id=" + id, true);
    r.send();

}

function addToCart(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
        }
    }

    r.open("GET", "addToCartProcess.php?id=" + id, true);
    r.send();

}

function deleteFromCart(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                alert("Product removed from cart");
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "deleteFromCartProcess.php?id=" + id, true);
    r.send();

}


function viewMessages(email) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("chat_box").innerHTML = t;
        }
    }

    r.open("GET", "viewMsgProcess.php?e=" + email, true);
    r.send();

}

function send_msg() {
    var email = document.getElementById("rmail");
    var txt = document.getElementById("msg_txt");

    var f = new FormData();
    f.append("e", email.innerHTML);
    f.append("t", txt.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "sendMsgProcess.php", true);
    r.send(f);
}


function payNow(id){
    var qty = document.getElementById("qty_input").value;
    
    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;

            var obj = JSON.parse(t);
            var mail = obj["umail"];
            var amount = obj["amount"];

           if(t == 1){
                alert ("Please login.");
                window.location = "index.php";
            }else if(t == 2){
                alert ("Please Update your profile");
                window.location = "userProfile.php";
            }else{

    // Payment completed. It can be a successful failure.
    payhere.onCompleted = function onCompleted(orderId){
    console.log("Payment completed. OrderID:" + orderId);

    saveInvoice(orderId,id,mail,amount,qty);
    // Note: validate the payment and show success or failure page to the customer
    };

    // Payment window closed
    payhere.onDismissed = function onDismissed() {
        alert("cancel");
        // Note: Prompt user to pay again or show an error page
        console.log("Payment dismissed");
    };

    // Error occurred
    payhere.onError = function onError(error) {
        // Note: show an error page
        alert("error");
        console.log("Error:"  + error);
    };

    // Put the payment variables here
    var payment = {
        "sandbox": true,
        "merchant_id": "1221550",    // Replace your Merchant ID
        "return_url": "http://localhost/java_ins/1st%20year/WP_01/eshop/singleProductView.php?id="+id,     // Important
        "cancel_url": "http://localhost/java_ins/1st%20year/WP_01/eshop/singleProductView.php?id="+id,     // Important
        "notify_url": "http://sample.com/notify",
        "order_id":obj["id"],
        "items": obj["item"],
        "amount":amount,
        "currency": "LKR",
        "first_name": obj["fname"],
        "last_name": obj["lname"],
        "email": mail,
        "phone": obj["mobile"],
        "address": obj["address"],
        "city": obj["city"],
        "country": "Sri Lanka",
        "delivery_address": obj["address"],
        "delivery_city": obj["city"],
        "delivery_country": "Sri Lanka",
        "custom_1": "",
        "custom_2": ""
    };

    // Show the payhere.js popup, when "PayHere Pay" is clicked
   // document.getElementById('payhere-payment').onclick = function (e) {
        payhere.startPayment(payment);
   // };
            }
        }
    }
    r.open("GET","./buyNowProcess.php?id="+id+"&qty="+qty,true);
    r.send();
}


function saveInvoice(orderId,id,mail,amount,qty){

    var f = new FormData();
    f.append("o",orderId);
    f.append("i",id);
    f.append("m",mail);
    f.append("a",amount);
    f.append("q",qty);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState == 4){
            var t = r.responseText;
           if(t == "1"){

                window.location = "invoice.php?id="+orderId;

            }else{
                alert (t);
            }
        }
    }

    r.open("POST","saveInvoice.php",true);
    r.send(f);

}
function printInvoice(){
    var restorepage = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = restorepage;
}


var m;
function addFeedback(id){
    var feedbackModal = document.getElementById("feedbackModal"+id);
    m = new bootstrap.Modal(feedbackModal);
    m.show();
}

function saveFeedback(id){

    var type;

    if(document.getElementById("type1").checked){
        type = 1;
    }else if(document.getElementById("type2").checked){
        type = 2;
    }else if(document.getElementById("type3").checked){
        type = 3;
    }

    var feedback = document.getElementById("feed");

    var f = new FormData();
    f.append("pid",id);
    f.append("t",type);
    f.append("feed",feedback.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () { 
        if(r.readyState == 4){
            var t = r.responseText;
            if(t == "1"){
                m.hide();
            }else{
                alert (t);
            }
        }
     }

    r.open("POST","saveFeedbackProcess.php",true);
    r.send(f);

}



var av;
function adminVerification(){
    var email = document.getElementById("e");

    var f = new FormData();
    f.append("e",email.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState == 4){
            var t = r.responseText;
          if(t == "Success"){
                var adminVerificationModal = document.getElementById("verificationModal");
                av = new bootstrap.Modal(adminVerificationModal);
                av.show();
            }else{
                alert(t);
            }
        }
    }

    r.open("POST","adminVerificationProcess.php",true);
    r.send(f);
}


function verify(){
    var verification = document.getElementById("vcode");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState == 4){
            var t = r.responseText;
           if(t == "success"){
                av.hide();
                window.location = "./adminPanel.php";
            }else{
                alert (t);
            }
            
        }
    }

    r.open("GET","verificationProcess.php?v="+verification.value,true);
    r.send();
}

function blockProduct(id){

    var request = new XMLHttpRequest();

    request.onreadystatechange = function(){
        if(request.readyState == 4){
            var txt = request.responseText;
            if(txt == "blocked"){
                document.getElementById("pb"+id).innerHTML = "Unblock";
                document.getElementById("pb"+id).classList = "btn btn-success";
            }else if(txt == "unblocked"){
                document.getElementById("pb"+id).innerHTML = "Block";
                document.getElementById("pb"+id).classList = "btn btn-danger";
            }else{
                alert (txt);
            }
        }
    }

    request.open("GET","productBlockProcess.php?id="+id,true);
    request.send();

}

function blockUser(email){

    var request = new XMLHttpRequest();

    request.onreadystatechange = function(){
        if(request.readyState == 4){
            var txt = request.responseText;
            if(txt == "blocked"){
                document.getElementById("ub"+email).innerHTML = "Unblock";
                document.getElementById("ub"+email).classList = "btn btn-success";
            }else if(txt == "unblocked"){
                document.getElementById("ub"+email).innerHTML = "Block";
                document.getElementById("ub"+email).classList = "btn btn-danger";
            }else{
                alert (txt);
            }
        }
    }

    request.open("GET","userBlockProcess.php?email="+email,true);
    request.send();

}

var mm;
function viewMsgModal(email){
    var m = document.getElementById("userMsgModal"+email);
    mm =new bootstrap.Modal(m);
    mm.show();
}

var pm;
function viewProductModal(id){
    var m = document.getElementById("viewProductModal"+id);
    pm = new bootstrap.Modal(m);
    pm.show();
}

var cm;
function addNewCategory(){
    var m = document.getElementById("addCategoryModal");
    cm = new bootstrap.Modal(m);
    cm.show();
}

var vc;
var e;
var n;
function verifyCategory(){
    var ncm = document.getElementById("addCategoryVerificationModal");
    vc = new bootstrap.Modal(ncm);

    e = document.getElementById("e").value;
    n = document.getElementById("n").value;

    var f = new FormData();
    f.append("email",e);
    f.append("name",n);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            if(t == "Success"){
                cm.hide();
                vc.show();
            }else{
                alert (t);
            }
        }
    }
    r.open("POST","addNewCategoryProcess.php",true);
    r.send(f);
}

function saveCategory(){
    var txt = document.getElementById("txt").value;

    var f = new FormData();
    f.append("t",txt);
    f.append("e",e);
    f.append("n",n);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            if(t == "success"){
                vc.hide();
                window.location.reload();
            }else{
                alert (t);
            }
        }
    }

    r.open("POST","SaveCategoryProcess.php",true);
    r.send(f);
}


function changeInvoiceStatus(id){

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;

            if(t == 1){
                document.getElementById("btn"+id).innerHTML = "Packing";
                document.getElementById("btn"+id).classList = "btn btn-warning fw-bold mt-1 mb-1";
            }else if(t == 2){
                document.getElementById("btn"+id).innerHTML = "Dispatch";
                document.getElementById("btn"+id).classList = "btn btn-info fw-bold mt-1 mb-1";
            }else if(t == 3){
                document.getElementById("btn"+id).innerHTML = "Shipping";
                document.getElementById("btn"+id).classList = "btn btn-primary fw-bold mt-1 mb-1";
            }else if(t == 4){
                document.getElementById("btn"+id).innerHTML = "Delivered";
                document.getElementById("btn"+id).classList = "btn btn-danger fw-bold mt-1 mb-1 disabled";
            }else{
                alert(t);
            }
        }
    }

    r.open("GET","changeInvoiceStatusProcess.php?id="+id,true);
    r.send();

}

function searchInvoiceId() { 
    var txt = document.getElementById("searchtxt").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            
            document.getElementById("viewArea").innerHTML = t;
            
        }
    }

    r.open("GET","searchInvoiceIdProcess.php?id="+txt,true);
    r.send();
 }

 function findSellings(){

    var from = document.getElementById("from").value;
    var to = document.getElementById("to").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState == 4){
            var t = r.responseText;
            document.getElementById("viewArea").innerHTML = t;
        }
    }

    r.open("GET","findSellingsProcess.php?f="+from+"&t="+to,true);
    r.send();

 }


 var cam;
 function contactAdmin(email){
    var m = document.getElementById("contactAdmin");
    cam = new bootstrap.Modal(m);
    cam.show();
 }

 function sendAdminMsg(){
    var txt = document.getElementById("msgtxt").value;

    var f = new FormData();
    f.append("t",txt);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            alert (t);
        }
    }

    r.open("POST","sendAdminMessageProcess.php",true);
    r.send(f);
 }

 function sendAdminMsg(email){
    var txt = document.getElementById("msgtxt").value;

    var f = new FormData();
    f.append("t",txt);
    f.append("r",email);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            alert (t);
        }
    }

    r.open("POST","sendAdminMessageProcess.php",true);
    r.send(f);
 }