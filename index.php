<?php 
	include('functions.php');

	if (!isLoggedIn()) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
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
			<img src="images/user_profile.png"  >
		<?php  if (isset($_SESSION['user'])) : ?>
			<div>
				
					<strong><?php echo $_SESSION['user']['username']; ?></strong>
					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<a href="index.php?logout='1'" style="color: red;">logout</a>
					</small>				
			</div>
			<form method="post" enctype="multipart/form-data">
			    Select PDF File to Upload:
			    <input id="sortpicture" type="file" name="sortpic" />
			    <input type="submit" name="submit" id= "upload" value="Upload">
			</form>
			<?php endif ?>
	<div class="application_container" style="display: none;">
		<div class="app">Application</div>
				<div class="presentation">
					<section>
						<table style="width: 100%" class="memt">
							<tbody>
								<tr>
									<td>Name :</td>
									<td>Card Number</td>
								</tr>
								<tr>
									<td>Father Name :</td>
									<td>Card Type :</td>
								</tr>
								<tr>
									<td>Date of Birth :</td>
									<td>Shop No :</td>
								</tr>
								<tr>
									<td>Address :</td>
									<td>year :</td>
								</tr>
								<tr>
									<td>Member Details :</td>
								</tr>									
							</tbody>
							<tfoot>
								<tr>
									<td>
										<button class="button">Submit</button>					
									</td>									
								</tr>
							</tfoot>																		
						</table>
					</section>
				</div>

				<div class="right">
					<div class="login">
						<section>
						</section>
					</div>
					
					<div class="categories">
						<section>
							<div class="pic"></div>
							<div class="pic">
								<img class="qr-pic" src="" />
							</div>
								<div class="upload-button">Upload Image</div>
								<input class="file-upload" type="file" accept="image/*"/>				
						</section>
					</div>
				</div>			
			</div>
		</div>
	</div>
</body>
</html>

<script type="text/javascript">
	$('#upload').on('click', function(e) {
		e.preventDefault();
		console.log("sdsd")
    var file_data = $('#sortpicture').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('file', file_data);          
    $.ajax({
        url: 'upload.php', // point to server-side PHP script 
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(php_script_response){
        	$('.application_container').css('display','block')
        }
     });
});

	$(document).ready(function() {    
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
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