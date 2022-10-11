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
function highlightAll(allCheckBox) {
    var rowElements = document.getElementsByTagName("tr");
    for(var i = 1; i < rowElements.length; i++) {
        var checkBox = rowElements[i].getElementsByTagName("input")[0];

        console.log(allCheckBox.checked);
        console.log(checkBox.checked);

        if (checkBox.checked == false && allCheckBox.checked == true) {
            checkBox.checked = true;
            highlightProduct(checkBox);
        }
        else if (checkBox.checked) {
            if (!allCheckBox.checked) {
                checkBox.checked = false;
                highlightProduct(checkBox);
            } 
            else {
            }
        }

        
    }
}

function displayActionIcons(deleteButton) {
    var id = deleteButton.getAttribute("value");
    var parentElement = deleteButton.parentElement.parentElement;
    var child = parentElement.lastElementChild;
    while (child) {
        parentElement.removeChild(child);
        child = parentElement.lastElementChild;
    }
    parentElement.classList.remove("delete-message");
    parentElement.innerHTML = 
    "<form action='read-product.php' method='get'>"+
        "<input type='hidden' name='productID' value='"+id+"'>"+
        "<button type='submit'><i class='fa-solid fa-eye'></i></button>"+
    "</form>"+
    "<form action='edit-product.php' method='get'>"+
        "<input type='hidden' name='productID' value='"+id+"'>"+
        "<button type='submit'><i class='fa-solid fa-pen'></i></button>"+
    "</form>"+
    "<i class='fa-solid fa-trash' onclick='displayDeleteQuestion(this)' name = 'productID' value = '"+id+"'></i>";
}

function displayDeleteQuestion(deleteButton) {
    var id = deleteButton.getAttribute("value");
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
                "<button type='submit' onclick='deleteAjax(this)' value='"+id+"'>"+
                    "<i class='fa-solid fa-check'></i>"+
                "</button>"+
            "</form>"+
        "</div>"+
        "<div class='no-choice' value = '"+id+"' onclick='displayActionIcons(this)'>"+
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
            var parentElement = document.getElementById("product"+deletedID);
            console.log(parentElement);
            var child = parentElement.lastElementChild;
            while (child) {
                parentElement.removeChild(child);
                child = parentElement.lastElementChild;
            }
            parentElement.innerHTML = "<td colspan = '7' class='delete-success-msg'>Succeed to delete the product from the database</td>";

            setTimeout(removeMessage,2000,parentElement);
           
        }
    })
}
function removeMessage(parentElement) {
    parentElement.remove();
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
