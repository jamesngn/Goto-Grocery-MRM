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
function highlightProduct(checkbox) {
    var parentElement = checkbox.parentElement.parentElement;
    var data = parentElement.getElementsByTagName("td");
    var viewIcon = data[data.length - 1].getElementsByClassName("fa-eye")[0];
    if (checkbox.checked) {
        parentElement.style.backgroundColor = "#28B5B5";
        for(var i = 0; i < data.length; i++) {
            data[i].style.color="#F2FFE9";
        }
        viewIcon.style.color = "#C2F3FC";
        console.log(viewIcon);
    } else {
        parentElement.style.backgroundColor = "white";
        for(var i = 0; i < data.length; i++) {
            data[i].style.color="black";
        }
        viewIcon.style.color = "#435D7D";
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
