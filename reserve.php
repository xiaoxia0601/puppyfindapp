<?php
session_start();
require_once 'admin/dbconfig.php';

if($_SERVER['REQUEST_METHOD'] == "GET") {
	if(!isset($_GET["id"])) header("location:index.php");	
	$dogId = $_GET["id"];
	$query = "SELECT * FROM doginfo WHERE dog_id=$dogId";
	$stmt = $DB_con->prepare($query);
	$stmt->execute();

	if($stmt->rowCount() > 0) {
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
	}
} elseif($_SERVER['REQUEST_METHOD'] == "POST") {
	extract($_POST);

	$stmt = $DB_con->prepare('INSERT INTO order_info(dog_id, last_name, first_name, d_st, d_city, d_state,
	d_zipcode, b_st, b_city, b_state, b_zipcode) VALUES(:ddog_id,:dlast_name, :dfirst_name, :dd_st, :dd_city, :dd_state,:dd_zipcode,:db_st,:db_city,:db_state,:db_zipcode)');

	$stmt->bindParam(':ddog_id', $dogId);
	$stmt->bindParam(':dlast_name', $last_name);
	$stmt->bindParam(':dfirst_name', $first_name);
	$stmt->bindParam(':dd_st', $ship_address);
	$stmt->bindParam(':dd_city', $ship_city);
	$stmt->bindParam(':dd_state', $ship_state);
	$stmt->bindParam(':dd_zipcode', $ship_zip);
	$stmt->bindParam(':db_st', $bill_address);
	$stmt->bindParam(':db_city', $bill_city);
	$stmt->bindParam(':db_state', $bill_state);
	$stmt->bindParam(':db_zipcode', $bill_zip);

	try {
		$stmt->execute();
		$successMSG = "Reservation Success!!<br>Redirecting to homepage in 3 seconds...";
		header( "Refresh: 3;url=index.php" );
	} catch (PDOException $e) {
		$errMSG = $e->getMessage();
	}
}



?>
<!DOCTYPE html>
<head>
	<link rel="stylesheet/less" type="text/css" href="reserve.less"/>
	<?php include "head_src.php" ?>
	<script src="reserve.js"></script>
</head>

<body>

<?php include "header.php" ?>

<div id="maincontent" class="container-fluid">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<?php if(isset($errMSG)){ ?>
			<div class="alert alert-danger text-center">
				<span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
			</div>
			<?php } else if(isset($successMSG)){ ?>
			<div class="alert alert-success text-center">
				<strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG; ?></strong>
			</div>
			<?php } ?>

			<div id="payment-grid" class="row">
				<form method="post">
				<div class="col-md-4">
				<div class="column">
					<div style="display: none;">
						<input type="text" name="dogId" value="<?= $dogId ?>"/>
						<input type="text" name="dogimg1" value="<?= $dogimg1 ?>"/>
					</div>
					<div class="step" id="step1">
						<div class="number">
							<span>1</span>
						</div>
						<div class="title">
							<h3>Shipping</h3>
						</div>
					</div>
	
					<div class="content" id="address">
						<?php if(isset($_SESSION["user_name"])) { ?> 
						<div style="display: none;">          
							<span id="session_fname"><?= $_SESSION['first_name'] ?></span>
							<span id="session_lname"><?= $_SESSION['last_name'] ?></span>
							<span id="session_phone"><?= $_SESSION['user_phone'] ?></span>
							<span id="session_email"><?= $_SESSION['user_email'] ?></span>
						</div>
						<div class="checkbox-inline">
							<label><input id="useUserInfo" type="checkbox" value="">Use user profile</label>
						</div>
						<?php } ?>
						<div>
							<input type="text" name="first_name"  id="first_name" placeholder="First Name" required="required"/>
					    </div>

						<div>
							<input type="text" name="last_name" id="last_name" placeholder="Last Name" required="required"/>
						</div>

						<div>
							<input type="text" name="telephone"  id="telephone" placeholder="Phone" required="required"/>
						</div>

						<div>
							<input type="email" name="email"  id="email-address" placeholder="Email Address" required="required"/>
						</div>

						<div>
							<div class="state_options">
								<div class="select">
									<select id="bill_state" name="bill_state">
										<option value="AL">Alabama</option>
										<option value="AK">Alaska</option>
										<option value="AZ">Arizona</option>
										<option value="AR">Arkansas</option>
										<option value="CA">California</option>
										<option value="CO">Colorado</option>
										<option value="CT">Connecticut</option>
										<option value="DE">Delaware</option>
										<option value="DC">District Of Columbia</option>
										<option value="FL">Florida</option>
										<option value="GA">Georgia</option>
										<option value="HI">Hawaii</option>
										<option value="ID">Idaho</option>
										<option value="IL">Illinois</option>
										<option value="IN">Indiana</option>
										<option value="IA">Iowa</option>
										<option value="KS">Kansas</option>
										<option value="KY">Kentucky</option>
										<option value="LA">Louisiana</option>
										<option value="ME">Maine</option>
										<option value="MD">Maryland</option>
										<option value="MA">Massachusetts</option>
										<option value="MI">Michigan</option>
										<option value="MN">Minnesota</option>
										<option value="MS">Mississippi</option>
										<option value="MO">Missouri</option>
										<option value="MT">Montana</option>
										<option value="NE">Nebraska</option>
										<option value="NV">Nevada</option>
										<option value="NH">New Hampshire</option>
										<option value="NJ">New Jersey</option>
										<option value="NM">New Mexico</option>
										<option value="NY">New York</option>
										<option value="NC">North Carolina</option>
										<option value="ND">North Dakota</option>
										<option value="OH">Ohio</option>
										<option value="OK">Oklahoma</option>
										<option value="OR">Oregon</option>
										<option value="PA">Pennsylvania</option>
										<option value="RI">Rhode Island</option>
										<option value="SC">South Carolina</option>
										<option value="SD">South Dakota</option>
										<option value="TN">Tennessee</option>
										<option value="TX">Texas</option>
										<option value="UT">Utah</option>
										<option value="VT">Vermont</option>
										<option value="VA">Virginia</option>
										<option value="WA">Washington</option>
										<option value="WV">West Virginia</option>
										<option value="WI">Wisconsin</option>
										<option value="WY">Wyoming</option>
									</select>
								</div>
							</div>
						</div>

						<div>
							<input type="text" name="bill_city"  id="bill_city" placeholder="City" required="required"/>
						</div>

						<div>
							<input type="text" name="bill_address"  id="bill_address" placeholder="Address" required="required"/>
						</div>

						<div>
							<input type="number" name="bill_zip"  id="bill_zip" placeholder="Zip Code" required="required" maxlength="5"/>
						</div>
					</div>

					<div class="step" id="step2">
						<div class="number">
							<span>2</span>
						</div>
						<div class="title">
							<h3>Billing</h3>
						</div>
					</div>

					<div class="content" id="address">
						<div class="checkbox-inline">
							<label><input id="sameAddr" type="checkbox" value="">Same as Shipping</label>
						</div>
						<div>
							<div class="state_options">
								<div class="select">
									<select id="ship_state" name="ship_state">
										<option value="AL">Alabama</option>
										<option value="AK">Alaska</option>
										<option value="AZ">Arizona</option>
										<option value="AR">Arkansas</option>
										<option value="CA">California</option>
										<option value="CO">Colorado</option>
										<option value="CT">Connecticut</option>
										<option value="DE">Delaware</option>
										<option value="DC">District Of Columbia</option>
										<option value="FL">Florida</option>
										<option value="GA">Georgia</option>
										<option value="HI">Hawaii</option>
										<option value="ID">Idaho</option>
										<option value="IL">Illinois</option>
										<option value="IN">Indiana</option>
										<option value="IA">Iowa</option>
										<option value="KS">Kansas</option>
										<option value="KY">Kentucky</option>
										<option value="LA">Louisiana</option>
										<option value="ME">Maine</option>
										<option value="MD">Maryland</option>
										<option value="MA">Massachusetts</option>
										<option value="MI">Michigan</option>
										<option value="MN">Minnesota</option>
										<option value="MS">Mississippi</option>
										<option value="MO">Missouri</option>
										<option value="MT">Montana</option>
										<option value="NE">Nebraska</option>
										<option value="NV">Nevada</option>
										<option value="NH">New Hampshire</option>
										<option value="NJ">New Jersey</option>
										<option value="NM">New Mexico</option>
										<option value="NY">New York</option>
										<option value="NC">North Carolina</option>
										<option value="ND">North Dakota</option>
										<option value="OH">Ohio</option>
										<option value="OK">Oklahoma</option>
										<option value="OR">Oregon</option>
										<option value="PA">Pennsylvania</option>
										<option value="RI">Rhode Island</option>
										<option value="SC">South Carolina</option>
										<option value="SD">South Dakota</option>
										<option value="TN">Tennessee</option>
										<option value="TX">Texas</option>
										<option value="UT">Utah</option>
										<option value="VT">Vermont</option>
										<option value="VA">Virginia</option>
										<option value="WA">Washington</option>
										<option value="WV">West Virginia</option>
										<option value="WI">Wisconsin</option>
										<option value="WY">Wyoming</option>
									</select>
								</div>
							</div>
						</div>

						<div>
							<input type="text" name="ship_city"  id="ship_city" placeholder="City" required="required"/>
						</div>

						<div>
							<input type="text" name="ship_address" id="ship_address" placeholder="Address" required="required"/>
						</div>

						<div>
							<input type="number" name="ship_zip"  id="ship_zip" placeholder="Zip Code" required="required" maxlength="5"/>
						</div>
					</div>
				</div>	
				</div>
				<div class="col-md-4">
				<div class="column">
					<div class="step" id="step3">
						<div class="number">
							<span>3</span>
						</div>
						<div class="title">
							<h3>Delivery</h3>
						</div>
					</div>
					<div class="content" id="shipping">
						<div>
							<div class="shipping_options">
								<div class="select">
									<select id="ship_type" name="ship_type">
										<option value="68">Regular Shipping $68</option>
										<option value="128">Express Shipping $128</option>
										<option value="228">24Hour Shipping $228</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="step" id="step4">
						<div class="number">
							<span>4</span>
						</div>
						<div class="title">
							<h3>Payment</h3>
						</div>
					</div>
					<div class="content" id="payment">
						<div class="left">
							<div>
								<input type="text" name="card_number"  id="card_number" placeholder="xxxx-xxxx-xxxx-xxxx" required="required"/>
							</div>
							<div>
								<div class="row">
									<div class="col-md-6">
										<div class="select">
								       		<select name="exp_month"  id="exp_month">
												<option value = "1">01 </option>
												<option value = "2">02 </option>
												<option value = "3">03 </option>
												<option value = "4">04 </option>
												<option value = "5">05 </option>
												<option value = "6">06</option>
												<option value = "7">07 </option>
												<option value = "8">08 </option>
												<option value = "9">09 </option>
												<option value = "10">10 </option>
												<option value = "11">11 </option>
												<option value = "12">12 </option>
				                        	</select>
			                        	</div>
									</div>
									<div class="col-md-6">
										<div class="select">
											<select name="exp_year"  id="exp_year">
												<option value = "17">2017 </option>
												<option value = "18">2018 </option>
												<option value = "19">2019 </option>
												<option value = "20">2020 </option>
												<option value = "21">2021 </option>
												<option value = "22">2022 </option>
												<option value = "23">2023</option>
												<option value = "24">2024</option>
					                        </select>
					                    </div>    
									</div>
					            </div>
				            	<div class="sec_num">
				            		<div>
										<input type="text" name="ccv"  id="ccv" placeholder="CVV code" required="required"/>
									</div>
								</div>
							</div>	
						</div>
						<div class="right">
							<div class="accepted">
								<span><img src="reserimg/Z5HVIOt.png"></span>
								<span><img src="reserimg/Le0Vvgx.png"></span>
								<span><img src="reserimg/D2eQTim.png"></span>
								<span><img src="reserimg/Pu4e7AT.png"></span>
								<span><img src="reserimg/ewMjaHv.png"></span>
								<span><img src="reserimg/3LmmFFV.png"></span>
							</div>
							<div class="secured">
								<img class="lock" src="reserimg/lock.png">
								<p class="security_info sub">All your private information will be protected by PuppyFinder</p>
							</div>
						</div>
			 		</div>
				</div>
				</div>
				<div class="col-md-4">
				<div class="column">
					<div class="step" id="step5">
						<div class="number">
							<span>5</span>
						</div>
						<div class="title">
							<h3>Confirmation</h3>
						</div>
					</div>
					<div class="content" id="final_products">
						<div class="left" id="ordered">
							<div class="products">
								<div class="product_image">
									<img src="admin/dog_images/<?= $dogimg1 ?>" style="border-radius: 10%"/>
								</div>
								<div class="product_details text-center">
									<span class="product_name"><?= $dog_name ?></span>
								</div>
							</div>
							<div class="totals">
								<div class="item">Puppy price <span class="price">$<span id="sub_price"><?= $price ?></span></span></div>
								<div class="item">Shipping <span id="sub_ship" class="price"></span></div>
							</div>
							<div class="final">
								<div class="item title">Total <span id="calculated_total" class="price"></span></div>
							</div>
						</div>	
						<div class="right" id="reviewed">
							<div class="billing">
								<div class="item title">Shipping:
									<div class="price">
										<span id="name_review"></span><br>
										<span id="address_review"></span><br>
										<span id="address2_review"></span><br>
										<span id="telephone_review"></span>
									</div>
								</div>
							</div>

							<div class="payment">
								<div class="item title">Payment:
									<div class="price">
										<span id="card_review"></span>
									</div>
								</div>
							</div>	
							<div id="complete" class="text-center">
								<button type="submit" name="btnsave" class="btn btn-default btn-lg"> Reserve </button>
								<span class="sub">By selecting this button you agree to the purchase and subsequent payment for this reservation.</span>
							</div>
						</div>
					</div>
				</div>	
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php include "footer.php" ?>

</body>
</html>
