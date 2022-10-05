let arrow = document.querySelectorAll('.arrow');
console.log(arrow);
for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click",function(e){
        let arrowParent = e.target.parentElement.parentElement;
        console.log(arrowParent);
        arrowParent.classList.toggle("showMenu");
    })
}
let sidebar = document.querySelector(".sidebar");
let item3Card4 = document.querySelector(".item3 .card4");
let sidebarBtn = document.querySelector(".fa-bars");
sidebarBtn.addEventListener("click", function() {
    sidebar.classList.toggle("close");
    item3Card4.classList.toggle("unshown");
});
