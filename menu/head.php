<base href="http://localhost/otis/">
<meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
<meta name="author" content="Otis">
<meta name="description" content="Otis">
<meta name="keywords" content="Otis">
<title>Otis</title>
<link rel="stylesheet" href="assets/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/dist/css/all.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<link rel="stylesheet" href="assets/plugins/jqvmap/dist/jqvmap.min.css">
<link rel="stylesheet" href="assets/plugins/weathericons/css/weather-icons.min.css">
<link rel="stylesheet" href="assets/plugins/weathericons/css/weather-icons-wind.min.css">
<link rel="stylesheet" href="assets/plugins/owl.carousel/dist/assets/owl.carousel.min.css">
<link rel="stylesheet" href="assets/plugins/owl.carousel/dist/assets/owl.theme.default.min.css">
<link rel="stylesheet" href="assets/plugins/summernote/dist/summernote-bs4.css">
<link rel="stylesheet" href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="assets/plugins/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
<link rel="stylesheet" href="assets/plugins/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="assets/plugins/selectric/public/selectric.css">
<link rel="stylesheet" href="assets/plugins/chocolat/dist/css/chocolat.css">
<link rel="stylesheet" href="assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
<link rel="stylesheet" href="assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
<link rel="stylesheet" href="assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/plugins/datatables.net-select-bs4/css/select.bootstrap4.min.css">
<link rel="stylesheet" href="assets/plugins/dropzone/dist/min/dropzone.min.css">
<link rel="stylesheet" type="text/css" href="assets/dist/css/style.css">
<link rel="stylesheet" href="assets/dist/css/components.css">
<?php
if(isset($_SESSION['role'])) {
	$username = $_SESSION['username'];
	$syntax = $conn->prepare("SELECT * FROM tb_user WHERE username = '$username'");
	$syntax->execute();
	$online = $syntax->fetch(PDO::FETCH_ASSOC);
}else {
	header("Location: index");
}
?>