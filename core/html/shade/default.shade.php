<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		[[HEADER]]
		<style>
		#wmydiv {
  position: absolute;
  z-index: 9;
  background-color: #f1f1f1;
  border: 1px solid #d3d3d3;
  text-align: center;
}

#movemydiv {
  padding: 10px;
  cursor: move;
  z-index: 10;
  background-color: #2196F3;
  color: #fff;
}
			[[STYLE]]
		</style>
	</head>
	<body id="[[SHADE]]">
		<div id="xerror"></div>
		<div id="master" class="container-fluid">
			<div id="xmain" class="row" style="[[HEIGHT]]">
				[[CONSTRUCT]]
			</div>
		</div>
	</body>
	<div id="dyjs">
		[[SCRIPTS]]
	</div>
	<div id="debug"></div>	
	<div id="bb">
		[[BB]]
	</div>	
</html>
