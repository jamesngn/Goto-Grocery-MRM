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
function displayDeleteMessage(deleteButton) {
    var parentElement = deleteButton.parentElement;
    var child = parentElement.lastElementChild;
    while (child) {
        parentElement.removeChild(child);
        child = parentElement.lastElementChild;
    }
    parentElement.classList.add("delete-message");
    parentElement.innerHTML = 
    "<div class='question'>DELETE ? </div>"+
    "<div class='choice'>"+
        "<div class='yes-choice'>"+
                "<button type='submit' onclick='deleteAjax(this)' value='"+deleteButton.getAttribute("value")+"'>"+
                    "<i class='fa-solid fa-check'></i>"+
                "</button>"+
            "</form>"+
        "</div>"+
        "<div class='no-choice'onclick='displayActionIcons(this)'>"+
            "<i class='fa-solid fa-xmark'></i>"+
        "</div>"+
    "</div>";
}

function deleteAjax(deleteButton) {
    var deletedID = deleteButton.getAttribute("value");
    $.ajax({
        type:'post',
        url: 'delete-product.php',
        data: {delete_id:deletedID},
        success:function(data){
            $('#product'+deletedID).hide();
        }
    })
}

function displayActionIcons(deleteButton) {
    console.log("hello");
    var parentElement = deleteButton.parentElement.parentElement;
    var child = parentElement.lastElementChild;
    while (child) {
        parentElement.removeChild(child);
        child = parentElement.lastElementChild;
    }
    parentElement.classList.remove("delete-message");
    parentElement.innerHTML = 
    "<form action='read-product.php' method='get'>"+
        "<input type='hidden' name='productID' value='100000'>"+
        "<button type='submit'><i class='fa-solid fa-eye'></i></button>"+
    "</form>"+
    "<form action='edit-product.php' method='get'>"+
        "<input type='hidden' name='productID' value='100000'>"+
        "<button type='submit'><i class='fa-solid fa-pen'></i></button>"+
    "</form>"+
    "<i class='fa-solid fa-trash' onclick='displayDeleteMessage(this)' name = 'productID' value = '100000'></i>";
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
