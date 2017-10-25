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
	 
	if (type == "prototype")
	{
		document.getElementById("file2").type = 'file';
		document.getElementById("file3").type = 'file';
	}
	 
	document.getElementById("edit1").style.display = 'none';
    document.getElementById("submit1").type = 'submit';
}

function sendHeader(path)
{
	location.replace(path);
}

function addQuestion() {

    var areaArray = [];

    $('textarea').each(
        function(){
            areaArray.push($(this).val());
        }
    );

    var i = document.getElementById('hiddenP').innerHTML;

    var x = 0;

    $('textarea').each(
        function(){
            $(this).text(areaArray[x]);
            x++;
        }
    );

    document.getElementById('form').innerHTML += '<textarea name="question' + i +'" placeholder="Question"></textarea>';

    i++;

    document.getElementById('hiddenP').innerHTML = i;

}

function addAnswer() {

    var questionArray = [];
    var answerArray = [];


    $('#question textarea').each(
        function(){
            questionArray.push($(this).val());
        }
    );

    $('#answers textarea').each(
        function(){
            answerArray.push($(this).val());
        }
    );

    console.log(questionArray);
    console.log(answerArray);


}