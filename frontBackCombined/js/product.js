function triggerClick() {
    document.getElementById("productImgToUpload").click();
}

function displayImage(e) {
    if (e.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            var imgContainer = document.getElementById("img-container");
            imgContainer.innerHTML = '<img src="'+e.target.result+'" onclick = "triggerClick()" alt="">';
            var imgUploader = document.getElementsByClassName("img-uploader");
            if (!imgUploader[0].classList.contains("unshown")) {
                imgUploader[0].classList.add("unshown");
            }
        }
        reader.readAsDataURL(e.files[0]);
    }
}

function ResetInput() {
    var img = document.getElementById("img-container").getElementsByTagName("img");
    if (img[0]) {
        img[0].remove();
    }
    var imgUploader = document.getElementsByClassName("img-uploader");
    if (imgUploader[0].classList.contains("unshown")) {
        imgUploader[0].classList.remove("unshown");
    }
}

function RedirectToAddProductPage() {
    window.location.href = "add-product.php";
}
function RedirectToEditProductPage(productID) {
    window.location.href = "edit-product.php?productID="+productID;
}
function RedirectToProductPage() {
    window.location.href = "product-table.php";
}