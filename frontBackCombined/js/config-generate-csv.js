/**
* Author: Thanh 101607169
* Target: configuration-generate-csv.php
* Purpose: Validation/required
* Created: 07/09/2022
* Last Updated: 07/09/2022
* Credits: (Any guidance/help/code? Credit it here.)
*/

  function handleData()
{
    var form_data = new FormData(document.getElementById("list_table"));
    
    if(!form_data.has("Table[]"))
    {
        document.getElementById("chk_option_error").style.visibility = "visible";
      return false;
    }
    else
    {
        document.getElementById("chk_option_error").style.visibility = "hidden";
      return true;
    }
  }

    function displayDateMemberQuestion(dateMemberButton) {
      var parentElement = dateMemberButton.parentElement;
      var child = parentElement.lastElementChild;
      while (child) {
          parentElement.removeChild(child);
          child = parentElement.lastElementChild;
      }
      parentElement.classList.add("delete-message");
      parentElement.innerHTML = 
      "<div class='question'>Do you wish allocate period of time for Member Data? </div>"+
      "<div class='choice'>"+
          "<div class='yes-choice'>"+
                  "<button type='submit' onclick='additionalDateMemberButton(this)' >"+
                      "<i class='fa-solid fa-check'></i>"+
                  "</button>"+
              "</form>"+
          "</div>"+
          "<div class='no-choice'onclick='displayDateMemberButton(this)' >"+
              "<i class='fa-solid fa-xmark'></i>"+
          "</div>"+
      "</div>";
    }

    function displayDateMemberButton(dateMemberButton) {
      console.log("hello");
      var parentElement = dateMemberButton.parentElement.parentElement;
      var child = parentElement.lastElementChild;
      
      while (child) {
          parentElement.removeChild(child);
          child = parentElement.lastElementChild;
      }
      parentElement.classList.remove("delete-message"); 
      parentElement.innerHTML = 
      "<p>" +
           "<label for='member'>Member Data</label> " +
           "<input type='checkbox' onclick='displayDateMemberQuestion(this)' id='member_mysql_table' name='Table[]' value='member'/>"+
      "</p>"
  }
    
  function additionalDateMemberButton(dateMemberButton) {
    var parentElement = dateMemberButton.parentElement;
    var child = parentElement.lastElementChild;
   
    while (child) {
      parentElement.removeChild(child);
      child = parentElement.lastElementChild;
  }
  parentElement.classList.remove("delete-message"); 
  parentElement.innerHTML = 
  "<input type='hidden'  id='member_mysql_table' name='Table[]' value='member'/>"+
       "<label for='Start_Date-Member'>Start Date:</label> " +
       "<input type='date' id='Start_Date-Member' name='Start_Date-Member' required>"+
       "<label for='End_Date-Member'>End Date:</label>"+
       "<input type='date' id='End_Date-Member' name='End_Date-Member' required>"
    }



    function displayDatePurchaseQuestion(datePurchaseButton) {
      var parentElement = datePurchaseButton.parentElement;
      var child = parentElement.lastElementChild;
      while (child) {
          parentElement.removeChild(child);
          child = parentElement.lastElementChild;
      }
      parentElement.classList.add("delete-message");
      parentElement.innerHTML = 
      "<div class='question'>Do you wish allocate period of time for Purchase Data? </div>"+
      "<div class='choice'>"+
          "<div class='yes-choice'>"+
                  "<button type='submit' onclick='additionalDatePurchaseButton(this)' >"+
                      "<i class='fa-solid fa-check'></i>"+
                  "</button>"+
              "</form>"+
          "</div>"+
          "<div class='no-choice'onclick='displayDatePurchaseButton(this)' >"+
              "<i class='fa-solid fa-xmark'></i>"+
          "</div>"+
      "</div>";
    }

    function displayDatePurchaseButton(datePurchaseButton) {
      console.log("hello");
      var parentElement = datePurchaseButton.parentElement.parentElement;
      var child = parentElement.lastElementChild;
      
      while (child) {
          parentElement.removeChild(child);
          child = parentElement.lastElementChild;
      }
      parentElement.classList.remove("delete-message"); 
      parentElement.innerHTML = 
      "<p>" +
           "<label for='purchase'>PurchaseData</label> " +
           "<input type='checkbox' onclick='displayDatePurchaseQuestion(this)' id='purchase_mysql_table' name='Table[]' value='purchase'/>"+
      "</p>"
  }
    
  function additionalDatePurchaseButton(datePurchaseButton) {
    var parentElement = datePurchaseButton.parentElement;
    var child = parentElement.lastElementChild;
   
    while (child) {
      parentElement.removeChild(child);
      child = parentElement.lastElementChild;
  }
  parentElement.classList.remove("delete-message"); 
  parentElement.innerHTML = 
  "<input type='hidden'  id='purchase_mysql_table' name='Table[]' value='purchase'/>"+
       "<label for='Start_Date-Purchase'>Start Date:</label> " +
       "<input type='date' id='Start_Date-Purchase' name='Start_Date-Purchase' required>"+
       "<label for='End_Date-Purchase'>End Date:</label>"+
       "<input type='date' id='End_Date-Purchase' name='End_Date-Purchase' required>"
    }

function removeMessage(parentElement) {
    parentElement.remove();
    
}
  /*<label for="Start_Date-Member">Start Date:</label>
  <input type="date" id="Start_Date-Member" name="Start_Date-Member" required>
  <label for="End_Date-Member">End Date:</label>
  <input type="date" id="End_Date-Member" name="End_Date-Member" required>
  */