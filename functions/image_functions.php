<?php

function get_image($img_id) {
	include_once 'includes/connect.php';


	$get_img_sql = "SELECT * FROM images WHERE img_id=?";
	$get_img = $con->prepare($get_img_sql);
	$get_img->execute([$img_id]);

	$img = $get_img->fetch();
	$img_nme = $img['img_name'];
	echo "	<div class='tile is-ancestor'>
					<div class='tile is-8 is-vertical'>
						<div class='tile is-parent'>
						<article class='tile is-child box'>
							<figure class='image'>
										<img src='data:image/png;base64,".$img_nme."' />
							</figure>
							<br/>
							<p class='button'>Like</p>
						</article>
					  </div>
					</div>
				</div>";
}

?>
