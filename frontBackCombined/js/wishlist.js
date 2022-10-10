function highlightWishlist(checkbox) {
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
            highlightWishlist(checkBox);
        }
        else if (checkBox.checked) {
            if (!allCheckBox.checked) {
                checkBox.checked = false;
                highlightWishlist(checkBox);
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
    "<form action='read-wishlist.php' method='get'>"+
        "<input type='hidden' name='wishlistid' value='"+id+"'>"+
        "<button type='submit'><i class='fa-solid fa-eye'></i></button>"+
    "</form>"+
    "<form action='edit-wishlist.php' method='get'>"+
        "<input type='hidden' name='wishlistid' value='"+id+"'>"+
        "<button type='submit'><i class='fa-solid fa-pen'></i></button>"+
    "</form>"+
    "<i class='fa-solid fa-trash' onclick='displayDeleteQuestion(this)' name = 'wishlistid' value = '"+id+"'></i>";
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
        url: 'delete-wishlist.php',
        data: {delete_id:deletedID},
        success:function(data){
            var parentElement = document.getElementById("wishlist"+deletedID);
            var child = parentElement.lastElementChild;
            while (child) {
                parentElement.removeChild(child);
                child = parentElement.lastElementChild;
            }
            parentElement.innerHTML = "<td colspan = '7' class='delete-success-msg'>Succeeded in deleting the wishlist from the database</td>";

            setTimeout(removeMessage,2000,parentElement);
            setTimeout("window.location.reload();",500);
        }
    })
}
function removeMessage(parentElement) {
    parentElement.remove();
    
}

function goToPage(number, maxNumber) {
    if (maxNumber >= number && number > 0) {
        window.location.href = "wishlist-table.php?page="+number;
    }
}



function RedirectToAddWishlistPage() {
    window.location.href = "add-wishlist.php";
}
function RedirectToEditWishlistPage(wishlistid) {
    window.location.href = "edit-wishlist.php?wishlistid="+wishlistid;
}
function RedirectToWishlistPage() {
    window.location.href = "wishlist-table.php";
}