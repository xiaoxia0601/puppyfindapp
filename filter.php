<div class="col-md-3" style="margin-left: 35px;">
	<div id="accordion" class="panel panel-default behclick-panel">
		<div class="panel-heading">
			<h3 class="panel-title">Filter</h3>
		</div>
		<form method="POST">
		<div class="panel-body" >

			<div class="panel-heading " >
				<h4 class="panel-title">
					<a data-toggle="collapse" href="#collapse0">
						<i class="indicator fa fa-chevron-down" aria-hidden="true"></i> Breed
					</a>
				</h4>
			</div>
			<div id="collapse0" class="panel-collapse collapse" >	
				<div class="breed-area">
		            <div class="col-md-12">
		                <select name="breed" class="form-control" style="margin-bottom: 50px;">
		                	<option value="IS NOT NULL" selected="selected">All Breed</option>
							<option value="= 'Australian Shepherd'">Australian Shepherd</option>
							<option value="= 'Beagle'">Beagle</option>
							<option value="= 'Belgian Malinois'">Belgian Malinois</option>
							<option value="= 'Border Collie'">Border Collie</option>
							<option value="= 'Boston Terrier'">Boston Terrier</option>
							<option value="= 'Boxer'">Boxer</option>
							<option value="= 'Brittany Spaniel'">Brittany Spaniel</option>
							<option value="= 'Brussels Griffon'">Brussels Griffon</option>
							<option value="= 'Bull Terrie'">Bull Terrier</option>
							<option value="= 'Bulldog'">Bulldog</option>
							<option value="= 'Brittany'">Brittany</option>
							<option value="= 'Chihuahua'">Chihuahua</option>
							<option value="= 'English Mastiff'">English Mastiff</option>
							<option value="= 'Golden Retriever'">Golden Retriever</option>
							<option value="= 'Goldendoodle'">Goldendoodle</option>
							<option value="= 'Great Dane'">Great Dane</option>
							<option value="= 'Labrador'">Labrador</option>
							<option value="= 'Maltese'">Maltese</option>
							<option value="= 'Pomeranian'">Pomeranian</option>
							<option value="= 'Pug'">Pug</option>
							<option value="= 'Samoyed'">Samoyed</option>
							<option value="= 'Shar Pei/Bulldog mix'">Shar Pei/Bulldog mix</option>
							<option value="= 'Shiba Inu'">Shiba Inu</option>
							<option value="= 'Siberian Husky'">Siberian Husky</option>
							<option value="= 'Yorkshire Terrier'">Yorkshire Terrier</option>
						</select> 
					</div>           
				</div>

			</div>

			<div class="panel-heading" >
				<h4 class="panel-title">
					<a data-toggle="collapse" href="#collapse1">
						<i class="indicator fa fa-chevron-down" aria-hidden="true"></i> Gender
					</a>
				</h4>
			</div>
			<div id="collapse1" class="panel-collapse collapse" >
				
				<div class="gender-area">
		            <div class="col-md-12">
		                <select name="gender" class="form-control" style="margin-bottom: 50px;">
		                	<option value="IS NOT NULL" selected="selected">Either</option>
							<option value="= 'Male'">Male</option>
							<option value="= 'Female'">Female</option>
						</select> 
					</div>           
				</div>
			</div>

			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" href="#collapse3"><i class="indicator fa fa-chevron-down" aria-hidden="true"></i> Age<span class="small"> in weeks</span></a>
				</h4>
			</div>
			<div id="collapse3" class="panel-collapse collapse">
				<div class="age-area">
					<div class="col-md-12">
		                <select name="age" class="form-control" style="margin-bottom: 50px;">
		                	<option value="IS NOT NULL" selected="selected">Any age</option>
							<option value="BETWEEN 0 AND 8">0 to 8 weeks</option>
							<option value="BETWEEN 9 AND 12">9 to 12 weeks</option>
							<option value="BETWEEN 13 AND 16">13 to 16 weeks</option>
							<option value="BETWEEN 17 AND 200">16 weeks and up</option>		
						</select> 
					</div>
				</div>
			</div>
			<div class="panel-heading" >
				<h4 class="panel-title">
					<a data-toggle="collapse" href="#collapse2"><i class="indicator fa fa-chevron-down" aria-hidden="true"></i> Color</a>
				</h4>
			</div>
			<div id="collapse2" class="panel-collapse collapse">
				
				<div class="color-area">
					<div class="col-md-12">			
						<select name="color" class="form-control" style="margin-bottom: 50px;">
							<option value="IS NOT NULL" selected="selected">All Colors</option>
							<option value="LIKE '%Black%'">Black</option>
							<option value="LIKE '%Brown%'">Brown</option>
							<option value="LIKE '%Cream%'">Cream</option>
							<option value="LIKE '%Dark Brown%'">Dark Brown</option>
							<option value="LIKE '%Dark Gray%'">Dark Gray</option>
							<option value="LIKE '%White%'">White</option>
							<option value="LIKE '%Yellow%'">Yellow</option>
						</select>
					</div>
				</div>

			</div>
		</form>
	
		<div class="text-center">
			<input type="submit" class="btn btn-default btn-lg" name="btn" value="Search"></input>
		</div>
	
		</div>
	</div>
</div>