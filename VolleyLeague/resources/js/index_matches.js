
let expandToolBar = false;
function checkIfMatchesExist(){
    let lengthDiv = document.getElementsByClassName('matches-calendar-container')[0]?.children.length;
    const icon = document.getElementById("search-icon-tool");
    if(lengthDiv == 0){
        icon.style.color = "red";
        return false;
    }
    return true;
}

// Javascript function for matches index
function openSelectWeeksForm() {
    const element = document.getElementById("search-tool-hidden-form");
    const icon = document.getElementById("search-icon-tool");
    if (element && expandToolBar) {
        var display = element.style.display;

        if (display == "block") {
            element.style.display = "none";
            icon.style.color = "white";
        } else {
            element.style.display = "block";
            icon.style.color = "blue";
        }
    }
}

function showMoreInfoMatches() {
    if(expandToolBar){
        let elements = document.querySelectorAll(".match-table-row-address"); // Select elements by class

    elements.forEach((element) => {
        if (element.style.display == "table-row") {
            element.style.display = "none"; // Change display to table-row if text exists
        } else if (element.textContent.trim() !== "") {
            element.style.display = "table-row"; // Change display to table-row if text exists
        }
    });
    }
    
}

function changeStyle(coll, styleProperty, styleChange) {
    for (var i = 0, len = coll.length; i < len; i++) {
        coll[i].style[styleProperty] = styleChange;
    }
}

function addColorStyleToTableByRowClass(rowClassName) {
    const coll = document.getElementsByClassName(rowClassName);

    for (var i = 0, len = coll.length; i < len; i++) {
        if (i % 4 == 0 || (i - 2) % 4 == 0) {
            //coll[i].style["background-color"] = "rgb(241 245 249)";
            coll[i].style.backgroundColor = "rgb(241 245 249)";
        } else {
            coll[i].style.backgroundColor = "rgb(203 213 225)";
        }
    }
}



document.addEventListener(
    "DOMContentLoaded",
    function () {
        addColorStyleToTableByRowClass("calendar-row-data");
        addColorStyleToTableByRowClass("match-table-row-address");
        expandToolBar = checkIfMatchesExist();
    },
    false,
);
window.showMoreInfoMatches = showMoreInfoMatches;
window.openSelectWeeksForm = openSelectWeeksForm;