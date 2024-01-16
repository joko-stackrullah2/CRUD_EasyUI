<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>List-data siswa</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/themes/metro/easyui.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/themes/icon.css') ?>">
    <script type="text/javascript" src="<?php echo base_url('assets/jquery.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/jquery.easyui.min.js') ?>"></script>


</head>
<body>

<div id="container">
    <center>
	<h1>LIST DATA SISWA RPL</h1>
    </center>
    
	<div id="body">
	<table id="dg-siswa" toolbar="#toolbar" title="DATA SISWA" class="easyui-datagrid" fit="true" singleSelect="true" fitColumns="true" rowNumbers="false" pagination="true" url="<?= site_url('welcome/getAllDataSiswa') ?>" pageSize="50" pageList="[25,50,75,100,125,150,200]" nowrap="false" data-options="singleSelect:true" >

    <thead>
        <tr>
            
            
            <th field="nisn" width="225">NISN</th>
            <th field="nama"  width="300">NAMA</th>
            <th field="alamat"  width="430">ALAMAT</th>
            <th field="telepon"  width="300">TELEPON</th>
            <th field="kelas"  width="150">KELAS</th>


        </tr>
    </thead>
</table>

<div id="toolbar">
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newSiswa()" >Tambah Siswa</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editSiswa()" >Edit Siswa</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="hapusSiswa()" >Hapus Siswa</a>
</div>
<div id="dlg" class="easyui-dialog"  style="width:400px;height:280px;padding:10px 20px"
        closed="true" buttons="#dlg-buttons">
        <center>
    <div class="ftitle">DATA SISWA</div>
</center>
    <form id="fm" method="post" novalidate>

        <div class="fitem">
            <p>
            <label>Nisn:</label>
            <br><input name="nisn" class="easyui-textbox" width= "300"required="true"></br></p>
        </div>
        <div class="fitem">
            <p>
            <label>Nama:</label>
           <input name="nama" class="easyui-textbox" width="300" required="true"></p>
        </div>
        <div class="fitem">
            <p>
            <label>Alamat:</label>
            <input name="alamat" class="easyui-textbox" width="300"></p>
        </div>
        <div class="fitem">
            <p>
            <label>Telepon:</label>
            <input name="telepon" class="easyui-textbox" width="300" validType="text"></p>
        </div>
        <form id="ff">
        <label>Kelas:</label>
    <div style="margin-bottom:20px">
        <input class="easyui-radiobutton" name="kelas" value="rpl" label="RPL:">
    </div>
    <div style="margin-bottom:20px">
        <input class="easyui-radiobutton" name="kelas" value="tkj" label="TKJ:">
    </div>
    <div style="margin-bottom:20px">
        <input class="easyui-radiobutton" name="kelas" value="tei" label="TEI:">
    </div>
</form>
    </form>
</div>
<div id="dlg-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick= "simpan()" style="width:90px">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
</div>
<div id="dd" class="easyui-dialog" title="Confirm" closed="true" button="#dd-buttons" style="width:400px;height:200px;"
        data-options="iconCls:'icon-help',resizable:true,modal:true">
        <center>
       <h1> Hapus data ini? </h1>
        </center>
        <div id="dd-buttons" >
            <center>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick= "hapus()" style="width:90px" >Hapus</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dd').dialog('close')" style="width:90px">Cancel</a>
            </center>
</div>
</div>

	</div>

</div>
<script>


    var url =''
function newSiswa(){
    $('#dlg').dialog('open').dialog('setTitle','Tambah Data Siswa');
    $('#fm').form('clear');
    url = 'index.php/Welcome/tambah';
}

function editSiswa(){
    let row = $('#dg-siswa').datagrid('getSelected');
    if (row){
    $('#dlg').dialog('open').dialog('setTitle','Edit Data Siswa');
    $('#fm').form('load',row);
    url = 'index.php/Welcome/edit';
}
}

function hapusSiswa(){
    let row = $('#dg-siswa').datagrid('getSelected');
    if (row){
    $('#dd').dialog('open').dialog('setTitle','Hapus Data Siswa');
    $('#fm').form('load',row);
    url = 'index.php/Welcome/hapus';
}
}

function simpan(){
    $('#fm').form('submit',{
        url: url,
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(result){
            console.log(result)
            var result = eval('('+result+')');
            if (result.success){
                $('#dlg').dialog('close');        
                $('#dg-siswa').datagrid('reload');
            } else {
                $.messager.show({
                    title: 'Error',
                    msg: result.errorMsg
                });
                ;
            }
        }
    });
}

function edit(){
    var row = $('#dg-siswa').datagrid('getSelected');
    $('#fm').form('load',row);
    $('#fm').form('submit',{
        url: url,
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(result){
            var result = eval('('+result+')');
            if (result.success){
                $('#dlg').dialog('close');        
                $('#dg-siswa').datagrid('reload');
            } else {
                $.messager.show({
                    title: 'Error',
                    msg: result.errorMsg
                });
                ;
            }
        }
    });
}

function hapus(){
    var row = $('#dg-siswa').datagrid('getSelected');
    $('#fm').form('load',row);
    $('#fm').form('submit',{
        url: url,
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(result){
            var result = eval('('+result+')');
            if (result.success){
                $('#dd').dialog('close');        
                $('#dg-siswa').datagrid('reload');
            } else {
                $.messager.show({
                    title: 'Error',
                    msg: result.errorMsg
                });
                ;
            }
        }
    });
}







</script>
</body>
</html>