<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>List-data siswa</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/themes/metro/easyui.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/themes/icon.css') ?>">
    <script type="text/javascript" src="<?php echo base_url('assets/jquery.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/jquery.easyui.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/datagrid-export.js') ?>"></script>


</head>
<body>

<div id="container">
    <center>
	<h1>LIST DATA SISWA </h1>
    </center>
    
	<div id="body">
	<table id="dg-siswa" toolbar="#toolbar" title="DATA SISWA" height="570"class="easyui-datagrid"  singleSelect="true" fitColumns="true" rowNumbers="false" pagination="true" url="<?= site_url('welcome/getAllDataSiswa') ?>" pageSize="50" pageList="[25,50,75,100,125,150,200]" nowrap="false" data-options="singleSelect:true" >

    <thead>
        <tr>
            
            
            <th field="nisn" width="225">NISN</th>
            <th field="nama"  width="300">NAMA</th>
            <th field="alamat"  width="430">ALAMAT</th>
            <th field="telepon"  width="300">TELEPON</th>
            <th field="kelamin"  width="300">JENIS KELAMIN</th>
            <th field="kelas"  width="200">KELAS</th>
            



        </tr>
    </thead>
</table>

<div id="toolbar">
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newSiswa()" >Tambah Siswa</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editSiswa()" >Edit Siswa</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="hapusSiswa()" >Hapus Siswa</a>
    <a href = "#" class = "easyui-linkbutton" iconCls = "icon-print" onclick="cetakSiswa()">Cetak </a>  
    <input  id="searchSiswa" class="easyui-searchbox" data-options="prompt:'Ketikkan nama siswa',searcher:doSiswa,
            inputEvents: $.extend({}, $.fn.searchbox.defaults.inputEvents, {
                keyup: function(e){
                    var t = $(e.data.target);
                    var opts = t.searchbox('options');
                    t.searchbox('setValue', $(this).val());
                    opts.searcher.call(t[0],t.searchbox('getValue'),t.searchbox('getName'));
                }
              })" style="width:50%;"></input>
</div>
<div id="dlg" class="easyui-dialog"  style="width:420px;height:510px;padding:10px 20px" closed="true" buttons="#dlg-buttons">
    <div class="ftitle">DATA SISWA</div>
    <form id="fm" method="post" novalidate>
        <div class="fitem">
            <p>
            <label>Nisn:</label>
            <input id="tb-nisn" name="nisn" class="easyui-textbox" width= "300"required="true"></p>
        </div>
        <div class="fitem">
            <p>
            <label>Nama:</label>
           <input name="nama" class="easyui-textbox" width="300" required="true"></p>
        </div>
        <div class="fitem">
            <p>
            <label>Alamat:</label>
            <input name="alamat" class="easyui-textbox" width="300" required="true"></p>
        </div>
        <div class="fitem">
            <p>
            <label>Telepon:</label>
            <input name="telepon" class="easyui-textbox" width="300" validType="text"></p>
        </div>
        <div class="fitem">
            <p>
            <label>Jenis Kelamin:</label>
           <select id="cc" class="easyui-combobox" name="kelamin" style="width:150px;"  panelHeight="100%">
    <option>LAKI-LAKI</option>
    <option>PEREMPUAN</option>
    
</select></p>


        <form id="ff">
        <label>Kelas:</label>
    <div style="margin-bottom:20px">
        <input class="easyui-radiobutton" name="kelas" value="RPL" label="RPL:">
    </div>
    <div style="margin-bottom:20px">
        <input class="easyui-radiobutton" name="kelas" value="TKJ" label="TKJ:">
    </div>
    <div style="margin-bottom:20px">
        <input class="easyui-radiobutton" name="kelas" value="TEI" label="TEI:">
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

    function doSiswa(){
	$('#dg-siswa').datagrid('load',{
		search_siswa: $('#searchSiswa').val()
	});
}

function newSiswa(){
    $('#dlg').dialog('open').dialog('setTitle','Tambah Data Siswa');
    $('#fm').form('clear');
    $('#fm #tb-nisn').textbox({readonly:false})
    url = 'index.php/Welcome/tambah';
}

function editSiswa(){
    let row = $('#dg-siswa').datagrid('getSelected');
    if (row){
    $('#dlg').dialog('open').dialog('setTitle','Edit Data Siswa');
    $('#fm').form('load',row);
    $('#fm #tb-nisn').textbox({readonly:true})
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
function cetakSiswa() {
    $('#dg-siswa').datagrid('print','Data Siswa');  
    $('#dg-siswa').datagrid('print', {
    title: 'Data Siswa',
    caption: 'Caption',
    fields: ['nisn','nama','alamat','telepon','kelamin','kelas'],
    rows: rows,
});
      }

function simpan(){
    $('#fm').form('submit',{
        url: url,
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(response){
            var obj = jQuery.parseJSON(response);
            console.log(obj)
            if(obj.success=="1"){				
                $.messager.progress('close');	
                $.messager.alert('Info',obj.msg,'info');
                $("#dg-siswa").datagrid("reload");
                $('#dlg').dialog('close'); 
            }else{
                $('#dlg').dialog('close'); 
                $.messager.progress('close');
                $.messager.alert('Info',obj.msg,'info');
            }
        },
        error: function(){
            $.messager.progress('close');
            $.messager.alert('Info','Terjadi kesalahan','info');
        },
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
        success: function(response){
            var obj = jQuery.parseJSON(response);
            console.log(obj)
            if(obj.success=="1"){				
                $.messager.progress('close');	
                $.messager.alert('Info',obj.msg,'info');
                $("#dg-siswa").datagrid("reload");
                $('#dlg').dialog('close'); 
            }else{
                $('#dlg').dialog('close'); 
                $.messager.progress('close');
                $.messager.alert('Info',obj.msg,'info');
            }
        },
        error: function(){
            $.messager.progress('close');
            $.messager.alert('Info','Terjadi kesalahan','info');
        },
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