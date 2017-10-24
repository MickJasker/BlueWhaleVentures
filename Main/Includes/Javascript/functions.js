//Enable textview and submit button
function editPage(textareas, type)
{
	var x = document.getElementsByClassName("textarea1");
	
	var i = 0;
	while (i < textareas)
	{
		x[i].disabled = false;
		i++;
	}
	 if (type == "pitch")
	 {
		document.getElementById("file1").type = 'file';
	 }
	document.getElementById("edit1").style.display = 'none';
    document.getElementById("submit1").type = 'submit';
}

function sendHeader(path)
{
	location.replace(path);
}