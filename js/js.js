function ex1(){
    $.ajax({
        url: 'application/core.php',
        type: 'GET',
        data: 'action=ex1',
        chache: false,
        success: function (html){
            $('table').html(html);
        }
    });
    }
function ex2(){
    $.ajax({
        url: 'application/core.php',
        type: 'GET',
        data: 'action=ex2',
        chache: false,
        success: function (html){
            $('table').html(html);
        }
    });
}
function ex3(){
    $.ajax({
        url: 'application/core.php',
        type: 'GET',
        data: 'action=ex3',
        chache: false,
        success: function (html){
            $('table').html(html);
        }
    });
}
function ex4(){
    $.ajax({
        url: 'application/core.php',
        type: 'GET',
        data: 'action=ex4',
        chache: false,
        success: function (html){
            $('table').html(html);
        }
    });
}