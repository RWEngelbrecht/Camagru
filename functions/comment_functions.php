<?php

function get_comment_count($img_id) {
	try {
		$con = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "qwerqwer");
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e) {
		echo "ERROR: ".$e->getMessage();
	}

	$get_cmnts_sql = "SELECT * FROM comments WHERE cmnt_img_id=?";
	$get_cmnts = $con->prepare($get_cmnts_sql);
	$get_cmnts->execute([$img_id]);
	$cmnts = $get_cmnts->fetchAll();
	$con = null;
	return count($cmnts);
}

function get_commentor_name($usr_id) {
	include 'includes/connect.php';

	$cmntr_name_sql = "SELECT user_name FROM users WHERE user_id=?";
	$get_cmntr_name = $con->prepare($cmntr_name_sql);
	$get_cmntr_name->execute([$usr_id]);
	$cmntr_name = $get_cmntr_name->fetch();

	return $cmntr_name['user_name'];
}

function get_comments($img_id) {
	include 'includes/connect.php';

	$get_cmnts_sql = "SELECT * FROM comments WHERE cmnt_img_id=? ORDER BY cmnt_id DESC";
	$get_cmnts = $con->prepare($get_cmnts_sql);
	$get_cmnts->execute([$img_id]);

	while ($cmnts = $get_cmnts->fetch()) {
		$commentor = get_commentor_name($cmnts['cmnt_usr_id']);
		$comment = $cmnts['comment'];
		echo "	<div class='tile is-ancestor'>
					<div class='tile is-8 is-vertical'>
						<div class='tile is-parent'>
						<article class='tile is-child box'>
							<p class='title'>$commentor</p>
							<p class='subtitle'>$comment</p>
						</article>
					  </div>
					</div>
				</div>";
	}
	$con = null;
}

function post_comment($img) {
	include 'includes/connect.php';

	if (isset($_SESSION['user_id'])) {
		$comment = $_POST['cmntContent'];
		$commentor_id = $_SESSION['user_id'];
	}
	if ($commentor_id) {

		$post_cmnt_sql = "INSERT INTO comments(cmnt_img_id, cmnt_usr_id, comment) VALUES(:img_id, :cmntr_id, :cmnt)";
		$post_cmnt = $con->prepare($post_cmnt_sql);
		$post_cmnt->execute(array(':img_id'=>$img, ':cmntr_id'=>$commentor_id, ':cmnt'=>$comment));
	} else {
		echo "<script>alert('Please Log In or Register to like or comment!')</script>";
	}
}

?>
