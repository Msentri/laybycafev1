$(document).on("click", "#openModal", function (){
    var url = "http://testing.dev/index.html";
    $('#myModal').modal({ show: 'true', remote: url })
});