<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Đăng nhập hệ thống</title>
	<link rel="stylesheet" href="public/css/bootstrap.min.css" >
	<style>
	.khung
	{
		max-width: 500px;
		min-height: 300px;
		padding: 20px;
		margin: auto;
		border: 1px solid #ccc;
		border-radius: 7px;
	}
</style>
</head>
<?php 
if(isset($_POST['DANGNHAP']))
{
	require_once('Config.php');
	require_once('system/Database.php');
	require_once('system/load.php');
	$auth=loadModel('backend/authencation');
	$username=$_POST['username'];
	$password=sha1($_POST['password']);
	if($auth->user_exists_username($username))
	{
		$user=$auth->auth_guard($username,$password);
		if($user!=FALSE)
		{
			$_SESSION['user_admin']=$user['user_username'];
			$_SESSION['user_id']=$user['user_id'];
			$_SESSION['user_fullname']=$user['user_fullname'];
			$_SESSION['user_access']=$user['user_access'];
			header('location:admin.php');
		}
		else
		{
			$error='Mật khẩu không đúng!';
		}
	}
	else
	{
		$error='Tên đăng nhập không tồn tại!';
	}

}
?>
<body>
	<div class="khung mt-0 mt-md-5">
		<h1>ĐĂNG NHẬP</h1>
		<form name="dangnhap" action="loginadmin.php" method="post">
			<div class="form-group">
				<label for="">Tên đăng nhập hoặc email</label>
				<input name="username" type="text" class="form-control" required placeholder="Tên đăng nhập hoặc email">
			</div>
			<div class="form-group">
				<label for="">Mật khẩu</label>
				<input name="password" type="password" class="form-control" required placeholder="Mật khẩu">
			</div>
			<div class="form-group">
				<button name="DANGNHAP" class="btn btn-success" type="submit">ĐĂNG NHẬP</button>
			</div>
			<div class="form-group">
				<?php echo(isset($error))?$error:''; ?>
			</div>
		</form>
	</div>
</body>
</html>