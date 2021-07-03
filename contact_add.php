<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$sender_id = $_POST['sender_id'];
		$sender_name = $_POST['sender_name'];
		$sender_email = $_POST['sender_email'];
		$sender_img	= $_POST['sender_img'];
		$receiver_id = $_POST['receiver_id'];
		$receiver_img = $_POST['receiver_img'];
		$message = $_POST['message'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("INSERT INTO message (sender_id, sender_name, sender_email, sender_img, receiver_id, receiver_img, message) VALUES (:sender_id, :sender_name, :sender_email, :sender_img, :receiver_id,  :receiver_img, :message)");
		$stmt->execute(['sender_id'=>$sender_id, 'sender_name'=>$sender_name, 'sender_email'=>$sender_email, 'sender_img'=>$sender_img, 'receiver_id'=>$receiver_id, 'receiver_img'=>$receiver_img, 'message'=>$message]);

		$_SESSION['success'] = 'Message sent';


		
		

		$pdo->close();

		header('location: contact.php');
	}

?>