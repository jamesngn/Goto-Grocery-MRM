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
            if (imgUploader[0].classList != "unshown") {
                imgUploader[0].classList.add("unshown");
            }
        }
        reader.readAsDataURL(e.files[0]);
    }
}