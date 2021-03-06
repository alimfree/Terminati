<?php
/**
 * @author Ali <techsupport@brafton.com>
 * @package Terminati
 */
?>
<!DOCTYPE html>
<html>
<?php require_once 'src/header.php' ?>
<body>
	<div class="row" style="margin: 0 0 3em 0;">
    	<div class="col-md-5 main col-md-offset-1">
			<h1>Terminati</h1>
			<div class="description">
				<p>Terminati intends to help Brafton keep clients from terminating. Use this elegantly designed tool to frequently check for missing content so our clients don't have to. </p>
				<h3>Directions</h3>
				<p>1. Query the client's database for an ids list containing all successfully imported articles<p>
				<p>2. Download an xml archives history for the client from <a target="_blank" href="http://curator.brafton.com">Curator</a>.</p>
				<p>3. Fill out and submit the form on the right. (read carefully)</p>
				<p>4. Download the resulting archive file or archive zip containing smaller files. 
				<h4>Bonus</h4>
				<p>5. Import the missing content to the client's website.</p>
			</div>
		</div>
	    <div class="col-md-4 form">
	    	<form class="form-horizontal center" method="post" action="src/action.php" enctype= "multipart/form-data">
				<div class="form-group">
					<p>Article List: <input type="textarea"  name="articlelist" required="required" placeholder="Enter article id's" /></p>	
					<p>Break up xml file into several smaller files? <br />
						<input type="radio" checked="checked" name="split" 
						value="yes"  /> Yes
						<input type="radio" name="split" 
						value="no"> No
					</p>
					<p>Articles/File: <input type="number" name="maxnum" placeholder="30" /> </p>
				</div>
				<div class="form-group">
					<p>Upload your XML file: 
						<input type="file" name="archive" id="archive" required="required" /><br />
					</p>
				</div>	
			    <div class="col-md-7">
					<input type="submit" class="btn btn-primary btn-lg btn-block" value="submit"/>
				</div>
			</form>
	    </div>
	</div>
</body>
</html>