/**
* Author: Thanh 101607169
* Target: configuration-generate-csv.php
* Purpose: Validation/required
* Created: 07/09/2022
* Last Updated: 07/09/2022
* Credits: (Any guidance/help/code? Credit it here.)
*/

  function checkboxchecker()
{
    var form_data = new FormData(document.querySelector("form"));
    
    if(!form_data.has("Table[]"))
    {
        document.getElementById("chk_error").style.visibility = "visible";
      return false;
    }
    else
    {
        document.getElementById("chk_error").style.visibility = "hidden";
      return true;
    }
    
}