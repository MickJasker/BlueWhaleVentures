function addQuestion() {

    var i = document.getElementById('hiddenP').innerHTML;

    document.getElementById('form').innerHTML += '<textarea name="question' + i +'" placeholder="Question"></textarea>';

    i++;

    document.getElementById('hiddenP').innerHTML = i;

}