<?php
	include('functions.php');

	if (!isLoggedIn()) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}

	$userid = $_SESSION['user']['id'];
	$targetDir = "uploads/".$userid ;
	$imagePath =$targetDir;

	$query = "SELECT * FROM user_data where user_id = $userid ORDER BY id DESC LIMIT 1";
	$result = mysqli_query($db, $query);
	while($row=mysqli_fetch_array($result)){
    	$name = $row['name'];
    	$card_name = $row['card_name'];
    	$card_type = $row['card_type'];
    	$father_name = $row['father_name'];
    	$dob = $row['dob'];
    	$shop_code = $row['shop_code'];
    	$address = $row['address'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
	<div class="header">
		<h2>Home Page</h2>
	</div>
	<div class="content">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php
						echo $_SESSION['success'];
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>
		<!-- logged in user information -->
		<div class="profile_info">
			<img class="user_pic" src="images/user_profile.png"  >
		<?php  if (isset($_SESSION['user'])) : ?>
			<div>

					<strong><?php echo $_SESSION['user']['username']; ?></strong>
					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i>
						<br>
						<a href="index.php?logout='1'" style="color: red;">logout</a>
					</small>
			</div>
			<form method="post" enctype="multipart/form-data" class="login">
			    Select PDF File to Upload:
			    <input id="sortpicture" type="file" name="sortpic" />
			    <input type="submit" name="submit" id= "upload" value="Upload">
			</form>
			<?php endif ?>
	<div class="app"><span class="label danger" style="display: none;">Invalid Pdf</span></div>
	<div class="application_container" style="display: none;">
		<div class="app">Application</div>
				<div class="presentation">
					<section>
						<table style="width: 100%" class="memt">
							<tbody>
								<tr>
									<td>Name : <span class="name"></span></td>
									<td>Card Number : <span class="card_name"></span></td>
								</tr>
								<tr>
									<td>Father Name : <span class="father_name"></span></td>
									<td>Card Type : <span class="card_type"></span></td>
								</tr>
								<tr>
									<td>Date of Birth : <span class="dob"></span></td>
									<td>Shop No : <span class="shop_code"></span></td>
								</tr>
								<tr>
									<td><div style="display: inline-block;">Address : </div><div class="address" style="width: 191px; margin: -22px 0px 0px 87px;"></div></td>
									<td><div style="margin-top: -68px;">Year : <span class="year">2010</span></div></td>
								</tr>
								<tr>
                                    <td><div style="display: inline-block;">Member Details : </div>
                                        <div class="memb" style="width: 191px; margin: -24px 0px 0px 159px;">
                                            <ul>
                                                <li>Selvam Kalirasi N</li>
                                                <li>Rithvika N</li>
                                                <li>Rittik N</li>
                                                <li>Ritvik N</li>
                                            </ul>
                                        </div></td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<td style="float: right;">
										<form method="post" enctype="multipart/form-data" action="pdf.php" >
			    <input id="hidden" type="text" name="hidden" style = "display: none" value = '<div class="print" style="font"><section style="width: 9%;float: left;"><div class="pic" style="width: 100px;height:100px;"><img class="pro-pic" style ="width: 100%;height: 100%;margin-left: -38px;" src="uploads/3/a.01.jpg" /><span class="label other" style="margin-left: -15px; margin-top:20px;border:1px solid black"><?php echo $card_name?></span><br><span class="label other" style="margin-left: 0px; margin-top:9px;border:1px solid black"><?php echo $card_type?></span><br></div></section><section style="width: 80%;float: right;"><table style="width:80%;font-size: 10px;" class="table_1print"><tbody><tr><td style="width:40%">பெயர்</td> <td> :<?php echo $name?></td></tr><tr><td style="width:40%">Father Name</td><td> :<?php echo $father_name?> </td></tr><tr><td style="width:40%">Date of Birth</td><td> :<?php echo $dob?> </td></tr><tr><td style="width:40%">Address</td><td> :<?php echo $address?> </td></tr><tr><td style="margin-left:">Member Details</td></tr></tbody></table></section><div class="page_break" style="page-break-before: always;"></div><div style="margin-left:-51px ;position: absolute;font-size: 13px;"><ul><li>Selvam Kalirasi N</li><li>Rithvika N</li><li>Rittik N</li><li>Ritvik N</li></ul></div><div class="qr-pic" style="width: 100px;height:100px;margin-left:120px;position: absolute"><div class="qr-pic" style="width: 100px;height:100px;margin-left:15px;position: absolute;margin-top: 14px;"><?php echo $shop_code?></div><div class="qr-pic" style="margin-left:32px;margin-top: 34px;position: absolute;font-size: 13px;">2018</div><img class="pro-pic" style ="margin-top :50px;width: 100px;height: 100px;" src="images/qr.png" /></div>'/>
			    <input type="submit" name="submit" id= "Submit" value="Submit">
										</form>
									</td>
								</tr>
							</tfoot>
						</table>
					</section>
				</div>

				<div class="right">
					<div class="categories">
						<section>
							<div class="pic">
								<img class="pro-pic"src="C:\xampp\htdocs\pdfScanner\uploads\uploads\2\333209874001.01.jpg" />
							</div>
							<div class="pic">
								<img class="qr-pic"src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d0/QR_code_for_mobile_English_Wikipedia.svg/1200px-QR_code_for_mobile_English_Wikipedia.svg.png" alt ="qr code"/>
							</div>
								<div class="upload-button">Upload Qr Code</div>
								<input class="file-upload" type="file" accept="image/*"/>
						</section>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>


<?php
$html = '<div class="print"><section style="width: 9%;float: left;"><div class="pic" style="width: 100px;height:100px;"><img class="pro-pic" style ="width: 100%;height: 100%;margin-left: -38px;" src="uploads/2/333209874001.01.jpg" /><span class="label other" style="margin-left: 0px; "margin-top:9px";position: absolute;border:1px solid black">Other</span><br><span class="label other" style="margin-left: 0px; "margin-top:9px";position: absolute;border:1px solid black">Other</span><br></div></section><section style="width: 80%;float: right;"><table style="width:80%" class="table_1print"><tbody><tr><td style="width:40%">Name</td> <td> : </td></tr><tr><td style="width:40%">Father Name</td><td> : </td></tr><tr><td style="width:40%">Date of Birth</td><td> : </td></tr><tr><td style="width:40%">Address</td><td> : </td></tr><tr><td style="margin-left:">Member Details</td></tr></tbody></table></section></div>'
	?>
</form>
</body>
</html>

<script>
	$('#upload').on('click', function(e) {
	e.preventDefault();
    var file_data = $('#sortpicture').prop('files')[0];
    var form_data = new FormData();
    var imagePath = "<?php echo $imagePath?>";
    console.log(imagePath);
    form_data.append('file', file_data);
    $.ajax({
        url: 'upload.php', // point to server-side PHP script
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',

        success: function(data){
        	data = JSON.parse(data.trim());

        	if(data.success){
        		$('.danger').css('display','none')
        		$('.pro-pic').attr('src', imagePath +'/'+ data.pic);
        		$('.name').html(data.pdf_details.name);
        		$('.card_name').html(data.pdf_details.card_name);
        		$('.card_type').html(data.pdf_details.card_type);
        		$('.father_name').html(data.pdf_details.father_name);
        		$('.dob').html(data.pdf_details.dob);
        		$('.shop_code').html(data.pdf_details.shop_code);
        		$('.address').html(data.pdf_details.address);
        		$('.application_container').css('display','block')
        	}else{
        		$('.danger').css('display','block')
        	}
        }
     });
});

	$(document).ready(function() {
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.qr-pic').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


    $(".file-upload").on('change', function(){
        readURL(this);
    });

    $(".upload-button").on('click', function() {
       $(".file-upload").click();
    });
});
</script>
