function openNav() {
    document.getElementById("navSections").style.left = "0%";
    document.getElementsByClassName("menu-i")[0].style.display = "none";
    document.getElementsByClassName("close-i")[0].style.display = "flex";
}

function closeNav() {
    if (document.getElementById("navSections").style.left == "0%") {
        document.getElementById("navSections").style.left = "-100%";
        document.getElementsByClassName("close-i")[0].style.display = "none";
        document.getElementsByClassName("menu-i")[0].style.display = "flex";
    }
}

//window.openNav = openNav;
//window.closeNav = closeNav;



document.addEventListener("DOMContentLoaded", function() {
    let openNavIcon = document.getElementById("openNavIcon");
    if(openNavIcon){
        openNavIcon.addEventListener("click", () => {
            openNav();
        })
    }
    let closeNavIcon = document.getElementById("closeNavIcon");
    if(closeNavIcon){
        closeNavIcon.addEventListener("click", () => {
            closeNav();
        })
    }
});