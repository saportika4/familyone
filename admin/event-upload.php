<?php


if (isset($_POST['submit']) && isset($_FILES['fileUpload'])) {

	include "db.php";

	$img_name = $_FILES['fileUpload']['name'];
	$img_size = $_FILES['fileUpload']['size'];
	$tmp_name = $_FILES['fileUpload']['tmp_name'];
	$error = $_FILES['fileUpload']['error'];

	// $title = $_POST['Title'];
	

	if ($error === 0) {
		if ($img_size > 1000000) {
			$em = "Image is too large, max-limit is 1 mb";
		    header("Location: add-event.php?error=$em");
		}else {
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			$allowed_exs = array("jpg", "jpeg", "png", "webp"); 

			if (in_array($img_ex_lc, $allowed_exs)) {
				$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
				$img_upload_path = 'assets/uploads/events/'.$new_img_name;

				// Insert into Database

				$sql= "INSERT INTO events (img_url) VALUES (?)";
					$stmt = mysqli_stmt_init($conn);
					if(!mysqli_stmt_prepare($stmt, $sql)) {
						header("location: add-event.php?error=statementfailed");
						exit();
					}
					mysqli_stmt_bind_param($stmt, "s",$new_img_name);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);

					move_uploaded_file($tmp_name, $img_upload_path);
				
					$succ = "Event Posted successfully";
					header("Location: add-event.php?success=$succ");
					exit();
		
			}else {
				$em = "You can't upload files of this type";
		        header("Location: add-event.php?error=$em");
			}
		}
	}else {
		$em = "unknown error occurred!";
		header("Location: add-event.php?error=$em");
	}

}else {
	header("Location: add-event.php?eerror");
}