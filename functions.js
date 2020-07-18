

function checkField() {

    document.getElementById("demo").innerHTML = "Wprowadz dane";
    document.getElementById('demo').className = "error";
    style.innerHTML = "demo";
}

function checkRegister() {

        document.getElementById('nemo').innerHTML = "Wypełnij wszystkie pola";
        document.getElementById('nemo').className = "error";
        style.innerHTML = "nemo";
}
function checkName() {
    alert("hello");
    window.location.href = 'login.php';

}
function Hello() {

    document.getElementById('add').innerHTML = 'add';
    document.getElementById('add').className = 'add';
    style.innerHTML = "add";



}

function doGet() {
    var data = Charts.newDataTable()
        .addColumn(Charts.ColumnType.STRING, 'Month')
        .addColumn(Charts.ColumnType.NUMBER, 'In Store')
        .addColumn(Charts.ColumnType.NUMBER, 'Online')
        .addRow(['January', 10, 1])
        .addRow(['February', 12, 1])
        .addRow(['March', 20, 2])
        .addRow(['April', 25, 3])
        .addRow(['May', 30, 4])
        .build();

    var chart = Charts.newAreaChart()
        .setDataTable(data)
        .setStacked()
        .setRange(0, 40)
        .setTitle('Sales per Month')
        .build();

    var htmlOutput = HtmlService.createHtmlOutput().setTitle('My Chart');
    var imageData = Utilities.base64Encode(chart.getAs('image/png').getBytes());
    var imageUrl = "data:image/png;base64," + encodeURI(imageData);
    htmlOutput.append("Render chart server side: <br/>");
    htmlOutput.append("<img border=\"1\" src=\"" + imageUrl + "\">");
    return htmlOutput;

}

