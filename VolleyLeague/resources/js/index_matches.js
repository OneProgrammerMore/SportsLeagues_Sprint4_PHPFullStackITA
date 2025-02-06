
// Javascript function for matches index
function openSelectWeeksForm(){
	var element = document.getElementById("search-tool-hidden-form");
	
	if (element) {
		var display = element.style.display;

		if (display == "block") {
			element.style.display = "none";
		} else {
			element.style.display = "block";
		}
	}
	
}

function showMoreInfoMatchesOld(){
	
	coll = document.getElementsByClassName("match-table-row-address");
	
	if(document.getElementsByClassName("match-table-row-address")[0].style.display == "table-row"){
		changeStyle(coll, "display", "none");
		
	}else{
		changeStyle(coll, "display", "table-row");
	}
}

function showMoreInfoMatches(){
	
	let elements = document.querySelectorAll(".match-table-row-address"); // Select elements by class

    elements.forEach(element => {
		if(element.style.display == "table-row"){
			element.style.display = "none"; // Change display to table-row if text exists
		}else if(element.textContent.trim() !== ""){
			element.style.display = "table-row"; // Change display to table-row if text exists
		}
    });
}

function changeStyle(coll, styleProperty, styleChange){
	for(var i=0, len=coll.length; i<len; i++)
    {
        coll[i].style[styleProperty] = styleChange;
    }
}

function addColorStyleToTableByRowClass(rowClassName){
	
	coll = document.getElementsByClassName(rowClassName);
	
	for(var i=0, len=coll.length; i<len; i++)
    {	
		if(i%4 == 0 || (i-2)%4 == 0 ){
			//coll[i].style["background-color"] = "rgb(241 245 249)";
			coll[i].style.backgroundColor = 'rgb(241 245 249)';
			console.log("Changing Colors....");
		}else{
			coll[i].style.backgroundColor = 'rgb(203 213 225)';
		}
    }
	
}

document.addEventListener('DOMContentLoaded', function(){
	addColorStyleToTableByRowClass("match-table-row");
	addColorStyleToTableByRowClass("match-table-row-address");
},false);


