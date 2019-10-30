<form method="POST" enctype="multipart/form-data">
	<label class="label">Name:  <?php echo $_SESSION['user_name'] ?></label>
	<div class="field has-addons">
		<p class="control has-icons-left">
			<input class="input is-medium" type="text" name="new_name" placeholder="Choose a username" required/>
			<span class="icon is-small is-left">
				<i class="fas fa-user"></i>
			</span>
		</p>
		<div class="control" >
			<input class="button is-success is-medium" type="submit" name="updt_name" value="Update">
		</div>
	</div>
</form>
<form method="POST" enctype="multipart/form-data">
	<label class="label">Email:  <?php echo $_SESSION['user_email'] ?></label>
	<div class="field has-addons">
		<p class="control has-icons-left">
			<input class="input is-medium" type="email" name="new_email" placeholder="Enter an email address" required/>
			<span class="icon is-small is-left">
				<i class="fas fa-envelope"></i>
			</span>
		</p>
		<div class="control" >
			<input class="button is-success is-medium" type="submit" name="updt_email" value="Update">
		</div>
	</div>
</form>
<form method="POST" enctype="multipart/form-data">
	<label class="label">Password: </label>
	<div class="field has-addons">
		<p class="control has-icons-left">
			<input class="input is-medium" type="password" name="new_passwd" placeholder="Password" required/>
			<span class="icon is-small is-left">
				<i class="fas fa-lock"></i>
			</span>
		</p>
		<div class="control" >
			<input class="button is-success is-medium" type="submit" name="updt_passwd" value="Update">
		</div>
	</div>
</form>
<form method="POST" enctype="multipart/form-data">
	<label class="label">Profile Picture: </label>
	<div class="field has-addons">
		<div class="file has-name">
			<label class="file-label">
				<input class="input is-medium" type="file" name="u_image" placeholder="" required/>
			</label>
		</div>
		<div class="control" >
			<input class="button is-success is-medium" type="submit" name="updt_image" value="Update">
		</div>
	</div>
</form>

<!-- <div class="modal">
	<div class="modal-background"></div>
	<div class="modal-card">
		<header class="modal-card-head">
			<p class="modal-card-title">Edit Info</p>
			<button class="delete" aria-label="close"></button>
		</header>
		<section class="model-card-body">

		</section>
		<footer class="modal-card-foot">
			<button class="button is-success">Update Info</button>
			<button class="button">Cancel</button>
		</footer>
	</div>
	<script>
				document.querySelector('#open-modal').addEventListener('click', function(event) {
					event.preventDefault();
					var modal = document.querySelector('.modal');
					var html =document.querySelector('html');
					modal.classList.add('is-active');
					html.classList.add('is-clipped');

					modal.querySelector('.modal-background').addEventListener('click', function(e) {
						e.preventDefault();
						modal.classList.remove('is-active');
						html.classList.remove('is-clipped');
					});
				});
			</script>
</div> -->
