
function horizontal_menu(element) {
		var menuElement = document.getElementById('menu_horizontal').getElementsByTagName('li');
		var classHolder;
		for (var i = menuElement.length - 1; i >= 0; i--) {

			if ( hasClass(menuElement[i], 'selected-menu-element' ) ) {
				removeClass(menuElement[i], 'selected-menu-element');
				break;
			}

		}
		addClass(element.parentNode, 'selected-menu-element');
}

function hasClass(ele, cls) {
    return ele.className.match(new RegExp('(\\s|^)' + cls + '(\\s|$)'));
}
function addClass(ele, cls) {
    if (!hasClass(ele, cls)) ele.className += " " + cls;
}
function removeClass(ele, cls) {
    if (hasClass(ele, cls)) {
        var reg = new RegExp('(\\s|^)' + cls + '(\\s|$)');
        ele.className = ele.className.replace(reg, ' ');
    }
}

function vider_le_champ(element, valeur){
		if (element.value == valeur) {element.value = ""};
}

function valeur_par_defaut(element, valeur_par_defaut){
		if (element.value == "") {element.value = valeur_par_defaut};
}

function details_page() {
    	window.location.assign("Details.html")
}

function recherche_avance(element){

	if( element.getAttribute("expanded") == "false" ) {
		document.getElementById("recherche_rapide").style.height="90px";
		document.getElementById("recherche_avancee").style.visibility="visible";
		document.getElementById("recherche_avancee").style.opacity="1";

		element.innerHTML = "Moins de criteres <<";
		element.setAttribute("expanded", "true");

	}else{
		document.getElementById("recherche_avancee").style.visibility="hidden";
		document.getElementById("recherche_avancee").style.opacity="0";
		document.getElementById("recherche_rapide").style.height="50px";

		element.innerHTML = "Plus de criteres >>";
		element.setAttribute("expanded", "false");
	}
}

function showInMainPan(imageName){
	document.getElementById("first_plan").src = imageName;
}

function thundernailMouseOver(element){
	element.style.boxShadow = "2px 2px 2px gray, -1px -1px 2px white";
	element.style.height = "60px";
	element.style.width = "60px";
}

function thundernailMouseOut(element){
	element.style.boxShadow = "";
	element.style.height = "55px";
	element.style.width = "55px";
}
