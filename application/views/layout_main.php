<?php
$session = $this->session->userdata('username');
$system = $this->Hrms_model->read_setting_info(1);
$layout = $this->Hrms_model->system_layout();
?>
<?php $this->load->view('components/htmlheader');?>
<body class="large-sidebar <?php echo $layout;?> <?php echo $system[0]->system_skin;?> material-design">
	<div class="wrapper">
		<div class="preloader" style="display: none;"></div>
		<!-- Sidebar -->
		<div class="site-sidebar-overlay"></div>
		
        
		<!-- Header -->
		<?php $this->load->view('components/header');?>

		
			<!-- Footer -->
			<?php $this->load->view('components/footer');?>
		</div>
	</div>
<?php $this->load->view('components/htmlfooter');?>
