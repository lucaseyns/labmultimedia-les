<?php
$mysqli = new mysqli('localhost', 'pi', 'raspberry', 'temperature');
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
        . $mysqli->connect_error);
}
?>

<table id="tabel" class="table table-striped table-hover">
<thead class="thead-dark">
<tr>
<th>TEMP</th>
</tr>
</thead>

<?php
$result = $mysqli->query("SELECT * FROM temperature");
while ($row = $result->fetch_assoc()) {
    print '<tr id="row">';
    print "<td>" . $row["TEMP"] . "</td>";
    print "</tr>";
}
?>
</tbody>

<html>
<head>
<script type="text/javascript" src="http://www.gstatic.com/charts/loader.js"></script>
<script src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
<script type="text/javascript">
$(window).on("load", function(){
var Row = document.getElementById("row");
var Cells = Row.getElementsByTagName("td");
var oTable = document.getElementById("tabel");
var arr = [];
for (var i=1; i < tabel.rows.length;i++){
	var oCells = oTable.rows.item(i).cells;
	var arr2 = [i,parseInt(oCells[0].firstChild.data)];
	arr.push(arr2);
}
google.charts.load('current', {'packages':['line']});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
var data = new google.visualization.DataTable();
data.addColumn('number', 'Tijd');
data.addColumn('number', 'Temperatuur');
data.addRows(arr);
var options = {
chart: {
title: 'its getting hot in here',
subtitle: 'how hot ?'
},
width: 900,
height: 500
};
var chart = new google.charts.Line(document.getElementById('linechart_material'));
chart.draw(data, google.charts.Line.convertOptions(options));
}
});
</script>
</head>

<body>
<div id="linechart_material"><div>
</body>
</html>
