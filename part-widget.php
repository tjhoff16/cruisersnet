<div class="apple_overlay" id="csb">
	
	<div class="overlay-head">
		Chart View Search
	</div>
	
	<h2>Search Waterway by Nautical Mile</h2>
	<form id="searchMiles">
		<table align="center" cellspacing="10">
			<tr>
				<td valign="top">
					Select Waterway:<br />
  					<select id="wwSelect">
    					<option value="5" minMile="0" maxMile="1095">Atlantic Intercoastal Waterway</option>
    					<option value="13" minMile="10" maxMile="80">Dismal Swamp Canal</option>
    					<option value="16" minMile="1100" maxMile="1230">Florida Keys Inside Route</option>
    					<option value="48" minMile="0" maxMile="150">Western Florida ICW</option>
    					<option value="37" minMile="0" maxMile="150">Okeechobee Waterway</option>
 		 			</select>
				</td>
				<td valign="top">
					Statute Mile:<br /> 
					<input type="textbox" id="wwMile" value=""> <br />
					<span style="font-size: 12px;">(Min: <span id="wwMin">0</span>nm Max: <span id="wwMax">1095</span>nm)</span>
				</td>
			</tr>
		</table>
  		<br />
  		<input type="button" onclick="javascript:searchMile()" value="View ChartView At the Specified Statute Mile" class="csb-submit">
	</form>
	
	<h2>Search by Latitude/Longtitude</h2>
	<form action="/cruisersnet-marine-map/?ll=">
		<div id="format-select">
			<input type="radio" id="format-deg" name="latlon-format" value="format-deg" checked="checked" /> Degrees/Minutes/Decimal Minutes Format<br />
			<input type="radio" id="format-dec" name="latlon-format" value="format-dec" /> Degrees/Decimal Degrees Format
		</div>
		<div id="format-input">
			<div id="format-input-dec">
				<table align="center" cellspacing="10">
					<tr>
						<td valign="top">
							<div>Latitude:</div>
  							<input type="textbox" id="csb-lat" value="">
						</td>
						<td valign="top">
							<div>Longitude:</div>
							<input type="textbox" id="csb-lon" value="">
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<span style="font-size: 12px;">(Degrees/Decimal Degrees Format Only)</span>
						</td>
					</tr>
				</table>
			</div>
			<div id="format-input-deg">
				<br />
				<div>Latitude:</div>
				Deg: <input type="textbox" class="lat-deg-input" value=""> &nbsp;&nbsp;Min/Dec. Min: <input type="textbox" class="lat-min-input" value="">&nbsp;&nbsp;
				<select name="lat-deg-dir" class="lat-deg-dir">
					<option value="1" selected="selected">N</option>
					<option value="-1">S</option>
				</select>
				<br /><br />
				<div>Longitude:</div>
				Deg: <input type="textbox" class="lon-deg-input" value=""> &nbsp;&nbsp;Min/Dec. Min: <input type="textbox" class="lon-min-input" value="">&nbsp;&nbsp;
				<select name="lon-deg-dir" class="lon-deg-dir">
					<option value="1">E</option>
					<option value="-1" selected="selected">W</option>
				</select>
				<br /><br />
				<span style="font-size: 12px;">(Degrees/Minutes/Decimal Minutes Format Only)</span>
			</div>
		</div>
  		
  		<br />
  		<input type="button" onclick="javascript:searchLatLon()" value="View ChartView At The Specified Lat/Lon" class="csb-submit">
	</form>
	
	<div class="widget-close"><a href="#" class="widget-close-link">Close</a></div>
		
</div> 
