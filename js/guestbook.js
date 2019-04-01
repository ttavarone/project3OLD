var colorIn;
var nameIn;

function getTextInput() {
	nameIn = document.getElementById('sign').value;
	
}

function getColor() {
	colorIn = document.getElementById( 'backColor' ).value;
	console.log(colorIn);
}

function displayInput () {
	document.getElementById('nameOut').style.color = this.colorIn;
	document.getElementById('nameOut').innerHTML = nameIn;

}