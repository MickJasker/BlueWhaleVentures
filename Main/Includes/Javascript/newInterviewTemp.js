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