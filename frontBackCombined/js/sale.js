function updatePrice(selectElement) {
    var currFormWrap = selectElement.parentElement.parentElement;
    var value = selectElement.value;
    var indexDelimiter = value.search(",");
    var productID = value.slice(0,indexDelimiter);
    var price = value.slice(indexDelimiter+1, value.length);

    if (price.length == 0) {
        currFormWrap.querySelector("#price").setAttribute("value","");
    } else {
        currFormWrap.querySelector("#price").setAttribute("value","$"+parseFloat(price).toFixed(2));
    }
    var quantityElement = currFormWrap.querySelector("#quantity");
    calculateSubtotal(quantityElement);
}

function calculateSubtotal(quantityElement) {
    var currFormWrap = quantityElement.parentElement.parentElement;
    // console.log(currFormWrap.querySelector("#price"));
    var str = currFormWrap.querySelector("#price").value;
    var filteredStr = str.slice(1,str.length);
    var retailPrice = parseFloat(filteredStr);
    
    var quantity = quantityElement.value;

    currFormWrap.querySelector("#subtotal").setAttribute("value", "$"+parseFloat(retailPrice*quantity).toFixed(2));
}
function addNewProduct(button) {
    button.remove();
    var value = button.getAttribute("value");
    $.ajax({
        url:"add-sale-item.php",
        method:"POST",
        data:{value:value},
        success:function(data) {
            const node1 = document.createElement("div");
            node1.className = "form-wrap";
            node1.innerHTML = data;
            document.getElementById("sale-section").appendChild(node1);

            const node2 = document.createElement("div");
            node2.className="add-new-product-section";
            node2.setAttribute("onclick","addNewProduct(this)");
            node2.setAttribute("value",parseInt(value)+1);
            node2.innerHTML =
                '<input type="hidden" name="ItemNo" value="'+value+'">'+
                '<i class="fa-solid fa-circle-plus"></i>'+
                '<div class="content">Add another product</div>'+
            '</div>';
            document.getElementById("sale-section").appendChild(node2);
        }
    })
}
function RedirectToAddSalePage() {
    window.location.href = "add-sale.php";
}
function RedirectToEditSalePage(saleID) {
    window.location.href = "edit-sale.php?saleID="+saleID;
}
function RedirectToSalePage() {
    window.location.href = "sale-table.php";
}