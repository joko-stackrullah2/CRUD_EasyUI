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
        <script type="text/javascript" src="<?php echo base_url('pdfmake/build/pdfmake.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('pdfmake/build/vfs_fonts.js') ?>"></script>
        <script src="https://unpkg.com/jspdf-invoice-template@1.4.0/dist/index.js"></script>
    </head>
    <body>
        <div class="easyui-layout" style="width:1340px;height:600px;">
            <div data-options="region:'west',split:true" title="MENU" style="width:150px;">
            <ul id="tt" class="easyui-tree">
         <li>
        <span>smkn 1 kepanjen</span>
        <ul>
            <li><span>siswa</span></li>
            <li><span>guru</span></li>
            <li><span>mata pelajaran</span></li>
            <li><span>kelas</span></li>
        </ul>
        </li>
        </ul>
            </div>
            <div data-options="region:'east',split:true" title="PENCARIAN" style="width:350px;padding:7px">
                <!-- <div>Pencarian</div> -->
                <input  id="searchGuru" class="easyui-searchbox" data-options="prompt:'Ketikkan nama guru',searcher:doGuru" style="width:100%">
                            <p>
                            <label>KELAS:</label>
                            <p>
                        <select id="cb-filter_kelas" class="easyui-combobox" name="kelas" style="width:150px;" editable="false"   panelHeight="100%">
                            <option>RPL</option>
                            <option>TKJ</option>
                            <option>TEI</option>
                        </select>

                        <p>
                            <label>JENIS KELAMIN:</label>
                            <p>
                        <select id="cb-filter_kelamin" class="easyui-combobox" name="kelamin" style="width:150px;" editable="false"  panelHeight="100%">
                            <option>LAKI-LAKI</option>
                            <option>PEREMPUAN</option>
                        </select>
            </div>
            <div data-options="region:'center',title:'LIST DATA GURU',iconCls:'icon-ok'">
                <div id="container">
                    <div id="body">
                    <table id="dg-guru" toolbar="#toolbar" class="easyui-datagrid" style="width:auto;height:567px;; singleSelect="true" fitColumns="true" rowNumbers="false" pagination="true" url="<?= site_url('welcome/getAllDataGuru') ?>" pageSize="50" pageList="[25,50,75,100,125,150,200]" nowrap="false" data-options="singleSelect:true" >
                        <thead>
                            <tr>
                                <th field="id_guru" width="225" sortable="true">ID GURU</th>
                                <th field="nama_guru"  width="300" sortable="true">NAMA</th>
                                <th field="alamat_guru"  width="430" sortable="true">ALAMAT</th>
                                <th field="telp_guru"  width="300" sortable="true">TELEPON</th>
                                <th field="jk_guru"  width="300" sortable="true">JENIS KELAMIN</th>
                                <th field="id_mapel"  width="200" sortable="true">ID MAPEL</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div id="toolbar">
                <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newGuru()" >Tambah Guru</a>
                <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editGuru()" >Edit Guru</a>
                <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="hapusGuru()" >Hapus Guru</a>
                <a href = "#" class = "easyui-linkbutton" iconCls = "icon-print"  onclick="cetakSiswa()">Cetak </a>
                <a href = "#" class = "easyui-linkbutton" iconCls = "icon-print"  onclick="cetakpdf()">Cetak PDF </a>
                <a href = "#" class = "easyui-linkbutton" iconCls = "icon-print"  onclick="cetakexcel()">Cetak Excel </a>   



            </div>
            <div id="dlg" class="easyui-dialog"  style="width:420px;height:510px;padding:10px 20px" closed="true" buttons="#dlg-buttons">
                <div class="ftitle">DATA GURU </div>
                    <form id="fm" method="post" novalidate>
                        <div class="fitem">
                            <label>ID GURU:</label>
                            <input id="tb-nisn" name="nisn" class="easyui-textbox" width= "300"required="true"></p>
                        </div>
                        <div class="fitem">
                            <p>
                            <label>Nama GURU:</label>
                        <input name="nama_guru" class="easyui-textbox" width="300" required="true"></p>
                        </div>
                        <div class="fitem">
                            <p>
                            <label>Alamat GURU:</label>
                            <input name="alamat_guru" class="easyui-textbox" width="300" required="true"></p>
                        </div>
                        <div class="fitem">
                            <p>
                            <label>Telepon GURU:</label>
                            <input name="telp_guru" class="easyui-textbox" width="300" validType="text"></p>
                        </div>
                        <div class="fitem">
                            <p>
                            <label>Mapel:</label>
                        <select id="cc" class="easyui-combobox" name="id_mapel" style="width:150px;"  panelHeight="100%">
                            <option>IPA</option>
                            <option>PKN</option>
                            <option>MATEMATIKA</option>
                            <option>INGGRIS</option>

                        </select>
                        <label>Jenis kelamin:</label>
                        <div style="margin-bottom:20px">
                            <input class="easyui-radiobutton" name="jk_guru" value="PEREMPUAN" label="PEREMPUAN:">
                        </div>
                        <div style="margin-bottom:20px">
                            <input class="easyui-radiobutton" name="jk_guru" value="LAKI-LAKI" label="LAKI-LAKI:">
                        </div>
                    </form>
                </div>
                <div id="dlg-buttons">
                    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick= "simpan()" style="width:90px">Save</a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
                </div>
                <div id="dd" class="easyui-dialog" title="Confirm" closed="true" button="#dd-buttons" style="width:400px;height:200px;" data-options="iconCls:'icon-help',resizable:true,modal:true">
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
    </body>
</html>
<script>
    var url =''

    $("#cb-filter_kelas").combobox({
        onClick : function(val){
            $('#dg-guru').datagrid('load',{
                kelas : val.value
            });
        }
    })

    $("#cb-filter_kelamin").combobox({
        onClick : function(val){
            $('#dg-guru').datagrid('load',{
                kelamin : val.value
            });
        }
    }) 
    
    function doGuru(){
        $('#dg-guru').datagrid('load',{
            search_siswa: $('#searchSiswaGuru').val()
        });
    }

    function newGuru(){
        $('#dlg').dialog('open').dialog('setTitle','Tambah Data Guru');
        $('#fm').form('clear');
        $('#fm #tb-id').textbox({readonly:false})
        url = 'index.php/Welcome/tambah';
    }

    function editGuru(){
        let row = $('#dg-guru').datagrid('getSelected');
        if (row){
        $('#dlg').dialog('open').dialog('setTitle','Edit Data Guru');
        $('#fm').form('load',row);
        $('#fm #tb-nisn').textbox({readonly:true})
        url = 'index.php/Welcome/edit';
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
        paper: 'A4',
        title: 'Data Guru',
        fields: ['nisn','nama','alamat','telepon','kelamin','kelas'],
        rows: rows,
    });
        }

   
        function cetakexcel(){
        $('#dg-guru').datagrid('toExcel',{
            filename: 'data_guru.xls',
            worksheet: 'Worksheet',
            caption: 'DATA EXCEL SELURUH SISWA',
        }); 
    }
    
    
    function cetakpdf(){
        var body = $('#dg-guru').datagrid('toArray');
        console.log(JSON.stringify(body))
        var docDefinition = {
                        header: {
                        margin: 10,
                        columns: [
                            {
                                margin: [230, 10, 10, 250],
                                text: 'DATA PDF SELURUH SISWA'
                            }
                        ]
                    },
                    content: [{
                    table: {
                    headerRows: 1,
                    widths: ['*','*','*','*','auto','*'],
                    body: body
                }
            }]
        };
        pdfMake.createPdf(docDefinition).download('data-guru.pdf');
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