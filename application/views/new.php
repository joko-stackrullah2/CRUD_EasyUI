<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>List-data guru</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/themes/metro/easyui.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/themes/icon.css') ?>">
    <script type="text/javascript" src="<?php echo base_url('assets/jquery.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/jquery.easyui.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/datagrid-export.js') ?>"></script>


</head>
<body>
<div class="easyui-layout" style="width:1340px;height:600px;">
        <div data-options="region:'north'" style="height:50px" ></div>
        <div data-options="region:'south',split:true" style="height:50px;"></div>
        <div data-options="region:'west',split:true" title="MENU" style="width:150px;">
        <ul>
      <li><a href="index.php/Welcome/index">SISWA</a></li>
      
    </ul>
</div>
        <div data-options="region:'center',title:'LIST DATA GURU',iconCls:'icon-ok'">

<div id="container">
    
    
	<div id="body">
	<table id="dg-guru" toolbar="#toolbar"  height="570"class="easyui-datagrid"  singleSelect="true" fitColumns="true" rowNumbers="false" pagination="true" url="<?= site_url('gr/GetAllDataGuru') ?>" pageSize="50" pageList="[25,50,75,100,125,150,200]" nowrap="false" data-options="singleSelect:true" >

    <thead>
        <tr>

            
            <th field="nip" width="225" sortable="true">NIP</th>
            <th field="nama"  width="300" sortable="true">NAMA</th>
            <th field="alamat"  width="430" sortable="true">ALAMAT</th>
            <th field="telepon"  width="300" sortable="true">TELEPON</th>
            <th field="kelamin"  width="300" sortable="true">JENIS KELAMIN</th>
            <th field="mapel"  width="200" sortable="true">MAPEL</th>



        </tr>
    </thead>
</table>

<div id="toolbar">
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newGuru()" >Tambah Guru</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editGuru()" >Edit Guru</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="hapusSiswa()" >Hapus Guru</a>
    <a href = "#" class = "easyui-linkbutton" iconCls = "icon-print" onclick="cetakSiswa()">Cetak </a>  
    <input  id="searchGuru" class="easyui-searchbox" data-options="prompt:'Ketikkan nama guru',searcher:doSiswa,
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
    <div class="ftitle">DATA GURU</div>
    <form id="fm" method="post" novalidate>
        <div class="fitem">
            <p>
            <label>Nip:</label>
            <input id="tb-nip" name="nip" class="easyui-textbox" width= "300"required="true"></p>
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
        <label>Mapel:</label>
    <div style="margin-bottom:20px">
        <input class="easyui-radiobutton" name="mapel" value="RPL" label="RPL:">
    </div>
    <div style="margin-bottom:20px">
        <input class="easyui-radiobutton" name="mapel" value="TKJ" label="TKJ:">
    </div>
    <div style="margin-bottom:20px">
        <input class="easyui-radiobutton" name="mapel" value="TEI" label="TEI:">
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

function newGuru(){
    $('#dlg').dialog('open').dialog('setTitle','Tambah Data Guru');
    $('#fm').form('clear');
    $('#fm #tb-nip').textbox({readonly:false})
    url = 'Welcome/tambahgr';
}

function editGuru(){
    let row = $('#dg-guru').datagrid('getSelected');
    if (row){
    $('#dlg').dialog('open').dialog('setTitle','Edit Data Guru');
    $('#fm').form('load',row);
    $('#fm #tb-nip').textbox({readonly:true})
    url = 'index.php/gr/edit';
}
}

function hapusGuru(){
    let row = $('#dg-guru').datagrid('getSelected');
    if (row){
    $('#dd').dialog('open').dialog('setTitle','Hapus Data Guru');
    $('#fm').form('load',row);
    url = 'index.php/Welcome/hapus';
}
}
function cetakGuru() {
    $('#dg-guru').datagrid('print','Data Guru');  
    $('#dg-guru').datagrid('print', {
    title: 'Data Guru',
    fields: ['nip','nama','alamat','telepon','kelamin','mapel'],
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
                $("#dg-guru").datagrid("reload");
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
    var row = $('#dg-guru').datagrid('getSelected');
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
                $("#dg-guru").datagrid("reload");
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
    var row = $('#dg-guru').datagrid('getSelected');
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
                $('#dg-guru').datagrid('reload');
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