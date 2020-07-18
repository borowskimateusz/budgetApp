
// function  myFunction(x) {
//     // document.getElementById("demo").innerHTML = alert("Hello World");
//     x.style.background = "green";
//
// }
var mysql =require('mysql');

var con = mysqli.createConnection( {
    host: 'localhost',
    user: 'www1595_orcio',
    password: 'LDzBDurQVn',
    database: 'www1595_dbbudget'
});
con.connect(function (err) {
    if(err) throw err;
    window.alert("Connected!");
});




function timWrite() {
    var x = document.getElementById("myInput").value;
    document.getElementById("demo").innerHTML = "You wrote: " + x;

}
function range(val) {
    document.getElementById("range").innerHTML = val;
}

