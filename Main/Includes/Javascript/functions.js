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
		document.getElementById("label2").style.display = 'inline-block';
	}
	 
	if (type == "prototype")
	{
		document.getElementById("file2").type = 'file';
		document.getElementById("file3").type = 'file';
		document.getElementById("label2").style.display = 'inline-block';
		document.getElementById("label3").style.display = 'inline-block';
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

    document.getElementById('form').innerHTML += '<textarea name="question' + i +'" placeholder="Question"></textarea><br>';

    i++;

    document.getElementById('hiddenP').innerHTML = i;

}

function addAnswer(questionID) {

    var questionArray = [];
    var answerArray = [];
    var i = document.getElementById('hiddenP').innerHTML;
    var x = 0;
    var y = 0;
    var z = 0;


    $("textarea[id='question']").each(
        function(){
            questionArray.push($(this).val());
        }
    );

    $("textarea[id='answer']").each(
        function(){
            answerArray.push({id: $(this).attr('name'), answer: $(this).val()});
        }
    );


    document.getElementById('question' + questionID + '').innerHTML += '<textarea name="answer' + i + '" id="answer" placeholder="Answer"></textarea>';

    $("#question textarea[id='question']").each(
        function(){
            $(this).text(questionArray[x]);
            x++;
        }
    );


    for( a = 0, l = answerArray.length; a < l; a++ ) {

        var ID = answerArray[a].id;
        console.log(ID);

        document.getElementsByName('' + ID + '')[0].value = answerArray[a].answer;

    }

    i++;

    document.getElementById('hiddenP').innerHTML = i;


    console.log(questionArray);
    console.log(answerArray);

}
