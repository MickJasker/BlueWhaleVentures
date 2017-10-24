//Enable textview and submit button
function editPage(textareas)
{
	var x = document.getElementsByClassName("textarea1");
	
	var i = 0;
	while (i < textareas)
	{
		x[i].disabled = false;
		i++;
	}
	 
	document.getElementById("edit1").style.display = 'none';
    document.getElementById("submit1").type = 'submit';
}

function sendHeader(path)
{
	location.replace(path);
}