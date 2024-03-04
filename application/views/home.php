<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
    <title>CRUD SMKN 1 Kepanjen</title>
    <script type="text/javascript"> 
        var base_url = "<?php echo base_url(); ?>";  
    </script>
    <link rel="shortcut icon" href="<?php echo base_url("image/favicon.ico"); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/themes/metro/easyui.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/themes/icon.css') ?>">
    <link id="theme_style" rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">
    <script type="text/javascript" src="<?php echo base_url('assets/jquery.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/jquery.easyui.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/datagrid-export.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('pdfmake/build/pdfmake.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('pdfmake/build/vfs_fonts.js') ?>"></script>
    <script src="https://unpkg.com/jspdf-invoice-template@1.4.0/dist/index.js"></script>
</head>

<body class="easyui-layout" style="overflow-y: hidden;" scroll="no">
     <!-- <div data-options="region:'north',border:false" style="height:50px;background:#a1caf4;padding:10px; background-image:url(<?php echo base_url('image/banner.png');?>); background-repeat:no-repeat; background-position:center left;">
        <a href="user_authentication/logout" class="btn btn-info" role="button" style="float: right;height:30px">Logout</a> 
        <span style="float: right; margin-right:20px; font-size:13px; margin-top:7px; color:#16a085"><?php echo $this->session->userdata['logged_in']['real_name']." (".$this->session->userdata['logged_in']['jabatan'].")"?></span> 
     </div> -->
    <div data-options="region:'center'" id="center-content" style="background:#eee; overflow: hidden;">
        <div id='content_tab' class="easyui-tabs isinya" border='false' fit="true" cache='false'>
            <div id='isi_content' title="Dashboard" style='overflow:hidden'>
            <?php include('dashboard.php') ?>
            </div>
        </div>
    </div>
    <div data-options="region:'west',title:'Menu',collapsible:true" style="width:200px;">
        <?php include('common/sidebar_menu.php') ?>
    </div>
    <div data-options="region:'north' "style="height:50px;"><img src="<?php echo base_url("image/bnr.png"); ?>" height="80%" width="auto" style="margin-left: 30px; margin-top: 5px;"></div>

   
   
</body>
<script type="text/javascript">
</script> 
</html>