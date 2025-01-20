/*
const openNav = () => {
    document.querySelector("#navSections").style.width = "100%";
    document.querySelector(".menu-i").style.display = "none";
    document.querySelector(".close-i").style.display = "flex";
};

const closeNav = () => {
    const navSections = document.querySelector("#navSections");
    
    if (navSections.style.width === "100%") {
        navSections.style.width = "0";
        document.querySelector(".close-i").style.display = "none";
        document.querySelector(".menu-i").style.display = "flex";
    }
};
*/
function openNav(){
	document.getElementById("navSections").style.left = "0%";
	document.getElementsByClassName("menu-i")[0].style.display = "none";
	document.getElementsByClassName("close-i")[0].style.display = "flex";
}


function closeNav(){
	 
	if( document.getElementById("navSections").style.left == "0%"){
		document.getElementById("navSections").style.left = "-100%";
		document.getElementsByClassName("close-i")[0].style.display = "none";
		document.getElementsByClassName("menu-i")[0].style.display = "flex";
	}
}
/*
function hideMenuButton(){
	if( document.getElementById("nav-menu").style.width == "100%"  ||  document.getElementById("nav-menu").style.width == "0px" ){
		document.getElementById("nav-menu").style.width = "";
		document.getElementsByClassName("close-i")[0].style.display = "";
		document.getElementsByClassName("menu-i")[0].style.display = "";
	}
}

window.onresize = hideMenuButton;

*/
