<div class="container-fluid">
	<form action="" id="login-frm">
		<div class="form-group">
			<label for="" class="control-label">Email</label>
			<input type="email" name="email" required="" class="form-control">
		</div>
		<div class="form-group">
			<label for="" class="control-label">Password</label>
			<input type="password" name="password" required="" class="form-control">
			<small><a href="index.php?page=signup" id="new_account">Create New Account</a></small>
		</div>
		<span class="float-right">
			<button class="button btn btn-primary btn-sm">Login</button>
			<button class="button btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
		</span>
	</form>
</div>
<style>
	#uni_modal .modal-footer{
		display: none
	}
</style>
<script>
    $('#login-frm').submit(function(e){
		e.preventDefault()
		start_load()
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'../../app/Controllers/ajax.php?action=login',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err);
                $('#login-frm button').prop('disabled', true).html('Login');
			},
			success:function(resp){
				if(resp == 1){
					location.replace('http://' + '<?php echo $_SERVER['HTTP_HOST'] ?>');
				}else{
					$('#login-frm').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
					end_load()
				}
			}
		})
	})
    $('.number').on('input',function(){
        var val = $(this).val()
        val = val.replace(/[^0-9 \,]/, '');
        $(this).val(val)
    })
</script>