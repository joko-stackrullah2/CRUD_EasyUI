
<div class="easyui-layout" data-options="fit:true" style="width:1340px;height:600px;">
    <div data-options="region:'east',split:true" title="PENCARIAN" style="width:350px;padding:7px">
        <input  id="searchMapel" class="easyui-searchbox" data-options="prompt:'Ketikkan nama mapel',searcher:doMapel" style="width:100%">                        
    </div>
    <div data-options="region:'center',title:'DAFTAR MATA PELAJARAN',iconCls:'icon-ok'">
        <div id="container">
            <div id="body">
            <table id="dg-mapel" toolbar="#toolbar" class="easyui-datagrid" style="width:auto;height:567px;;" singleSelect="true" fitColumns="true" rowNumbers="false" pagination="true" url="<?= site_url('mapel/getAllDataMapel') ?>" pageSize="50" pageList="[25,50,75,100,125,150,200]" nowrap="false" data-options="singleSelect:true" >
                <thead>
                    <tr>
                    <th field="id_mapel" width="80" sortable="true" halign="center">NO</th>
                        <th field="kode" width="80" sortable="true" halign="center">KODE</th>
                        <th field="nama_mapel"  width="300" sortable="true" halign="center">NAMA MAPEL</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div id="toolbar">
        <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newMapel()" >Tambah Mapel</a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editMapel()" >Edit Mapel</a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="hapusMapel()" >Hapus Mapel</a>
        <a href = "#" class = "easyui-linkbutton" iconCls = "icon-print"  onclick="cetakpdf()">Cetak PDF </a>
        <a href = "#" class = "easyui-linkbutton" iconCls = "icon-print"  onclick="cetakexcel()">Cetak Excel </a>   
    </div>
    <div id="toolbarfile">
        <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newFile()" >Tambah File</a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editFile()" >Edit File</a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="hapusFile()" >Hapus File</a>
        <a href = "#" class = "easyui-linkbutton" iconCls = "icon-print"  onclick="cetakpdf()">Cetak PDF </a>
        <a href = "#" class = "easyui-linkbutton" iconCls = "icon-print"  onclick="cetakexcel()">Cetak Excel </a>   
    </div>

    <div id="dlg-hapus_mapel" class="easyui-dialog" title="Confirm" closed="true" button="#dlg-hapus_mapel-buttons" style="width:600px;height:400px;" data-options="iconCls:'icon-help',resizable:true,modal:true">
    </div>
    <div id="dlg-mapel" class="easyui-dialog" datagrid="dg-file" style="width:600px;height:550px;padding:10px 20px" closed="true" buttons="#buttons-simpan_kelas">
        <input type="hidden" name="key_file" id="key_file" value="">
        <div class="ftitle">DAFTAR MAPEL</div>
        <form id="form-tambah_mapel" method="post" novalidate>
            <div class="fitem">
                <P>
                <label>Kode mapel:</label>
                <p>
                <input id="tb-kode" name="kode" value="kode" class="easyui-textbox" width= "300" ></p>
            </div>
            <div class="fitem">
                <p>
                <label>Nama Mapel:</label>
                <p>
                <input name="nama_mapel" value="nama_mapel" class="easyui-textbox" width="300" ></p>
            </div>
            <div class="fitem">
                <table id="dg-file" toolbar="#toolbarfile" class="easyui-datagrid" style="width:auto;height:250px;;" singleSelect="true" fitColumns="true" rowNumbers="false" pagination="true" pageSize="50" pageList="[25,50,75,100,125,150,200]" nowrap="false" data-options="singleSelect:true" >
                    <thead>
                        <tr>
                            <th field="upload_file_id"  width="300" sortable="true" halign="center">UPLOAD FILE ID</th>
                            <th field="nama_file"  width="300" sortable="true" halign="center">NAMA FILE</th>
                            <th field="path_file"  width="300" sortable="true" halign="center">FILE PATH</th>
                            <th field="tipe_file"  width="300" sortable="true" halign="center">FILE TYPE</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </form>
    </div>

    <div id="dlg-file" class="easyui-dialog"  style="width:520px;height:500px;padding:10px 20px" closed="true" buttons="#buttons-simpan_file">
        <div class="ftitle">DAFTAR MAPEL</div>
        <form id="form-tambah_file" method="post" novalidate>
            <input type="hidden" name='key_file' id='key_file_dokumen'/>
            <div class="fitem">
                <P>
                <label>Kode mapel:</label>
                <p>
                <input name="kode_mapel_id" id="kode_mapel_id" class="easyui-textbox" width= "300" ></p>
            </div>
            <div class="fitem">
            <div class="fitem">
                <P>
                <label>Path file:</label>
                <p>
                <input name="path_file" id="path_file" class="easyui-filebox" width= "300" ></p>
            </div>
            <div class="fitem">
                <P>
                <label>Keterangan file:</label>
                <p>
                <input name="keterangan_file" id="keterangan_file" class="easyui-textbox" width= "300" ></p>
            </div>
            <div class="fitem">
                <P>
                <label>Key file:</label>
                <p>
                <input name="key_file" id="key_file" class="easyui-textbox" width= "300" ></p>
            </div>
        </form>
    </div>

    <div id="buttons-simpan_mapel">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick= "simpanF(); simpan();" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-mapel').dialog('close')" style="width:90px">Cancel</a>
    </div>
    <div id="buttons-simpan_file">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick= "uploadDokumenMapel()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-file').dialog('close')" style="width:90px">Cancel</a>
    </div>

    <div id="dlg-hapus-mapel" class="easyui-dialog" title="Confirm" closed="true" button="#buttons-hapus_mapel " style="width:400px;height:200px;" data-options="iconCls:'icon-help',resizable:true,modal:true">
        <center>
        <h1> Hapus data ini? </h1>
        <div id="buttons-hapus_kelas" >
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick= "hapus()" style="width:90px" >Hapus</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-hapus-mapel').dialog('close')" style="width:90px">Cancel</a>
        </div>
    </div>
</div>
<script>
    var url =''
    $("#cb-filter_kelas").combobox({
        onClick : function(val){
            $('#dg-guru').datagrid('load',{
                mapel : val.value
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

    $('#filebox').filebox({
	accept: 'image/*'
});
    
    function doMapel(){
        $('#dg-mapel').datagrid('load',{
            search_mapel: $('#searchMapel').val()
        });
    }

    function newMapel(){
        $('#dlg-mapel').dialog('open').dialog('setTitle','Tambah Data Mapel');
        $('#form-tambah_mapel').form('clear');
        $('#form-tambah_mapel #tb').textbox({readonly:false})
        url = 'index.php/Mapel/tambah';
        initUploadFile()
    }
    function newFile(){
        $('#dlg-file').dialog('open').dialog('setTitle','Tambah File');
        $('#form-tambah_file').form('clear');
        $('#form-tambah_file #tb').textbox({readonly:false})
        url = 'index.php/File/tambah';
        initUploadFile()
    }

    function editMapel(){
        let row = $('#dg-mapel').datagrid('getSelected');
        if (row){
        $('#dlg-mapel').dialog('open').dialog('setTitle','Edit Data Mapel');
        $('#form-tambah_mapel').form('load',row);
        $('#form-tambah_mapel #tb-kode').textbox({readonly:true})
        url = 'index.php/Mapel/edit';
        initUploadFile()
    }
    }

    function hapusMapel(){
        let row = $('#dg-mapel').datagrid('getSelected');
        if (row){
        $('#dlg-hapus-mapel').dialog('open').dialog('setTitle','Hapus Data Mapel');
        $('#fm').form('load',row);
        url = 'index.php/Mapel/hapus';
    }
    }

   
        function cetakexcel(){
        $('#dg-mapel').datagrid('toExcel',{
            filename: 'daftar_mapel.xls',
            worksheet: 'Worksheet',
            caption: 'DAFTAR MATA PELAJARAN',
        }); 
    }
    
    
    function cetakpdf(){
        var body = $('#dg-mapel').datagrid('toArray');
        console.log(JSON.stringify(body))
        var docDefinition = {
                        header: {
                        margin: 10,
                        columns: [
                            {
                                margin: [230, 10, 10, 250],
                                text: 'DAFTAR MATA PELAJARAN'
                            }
                        ]
                    },
                    content: [{
                    table: {
                    headerRows: 1,
                    widths: ['auto','*'],
                    body: body
                }
            }]
        };
        pdfMake.createPdf(docDefinition).download('daftar-mapel.pdf');
    }
    
    function simpan(){
        let dataForm = $('#form-tambah_mapel').serializeArray();
        let dokumen = $("#dg-file").datagrid('getRows');
        dataForm.push({name:'dokumen', value:dokumen});
        let data = Object.fromEntries(dataForm.map(obj => [obj.name, obj.value]));
        console.log(data);
        $('#form-tambah_file').form('submit',{
            url: url,
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(response){
                var obj = jQuery.parseJSON(response);
                console.log(obj)
                if(obj.success=="1"){				
                    $.messager.progress('close');	
                    $.messager.alert('Info',obj. msg,'info');
                    $("#dg-mapel").datagrid("reload");
                    $('#dlg-mapel').dialog('close'); 
                }else{
                    $('#dlg-mapel').dialog('close'); 
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

    function tambahFileMapel(dg) {
   let values = $('#form-tambah_file').serializeArray();
    
            let kode_mapel_id = values.filter(item => item.name === 'kode_mapel_id')[0].value;
            let path_file = document.getElementById("path_file").value;
            let nama_file = values.filter(item => item.name === 'nama_file')[0].value;
            let keterangan_file =  values.filter(item => item.name === 'keterangan_file')[0].value;
            let tambahFile = {
                kode_mapel_id: kode_mapel_id,
                nama_file: nama_file,
                path_file:path_file,
                keterangan_file: keterangan_file
            }
            console.log(tambahFile)
            $('#dg-file').datagrid('appendRow',tambahFile);
            
            $('#dlg-file').dialog('close');
            
        }

    function simpanF(){
        $('#form-tambah_mapel').form('submit',{
            url: url,
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(response){
                var obj = jQuery.parseJSON(response);
                console.log(obj)
                if(obj.success=="1"){				
                    $.messager.progress('close');	
                    $.messager.alert('Info',obj. msg,'info');
                    $("#dg-mapel").datagrid("reload");
                    $('#dlg-mapel').dialog('close'); 
                }else{
                    $('#dlg-file').dialog('close'); 
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
        var row = $('#dg-mapel').datagrid('getSelected');
        $('#form-tambah_mapel').form('load',row);
        $('#form-tambah_mapel').form('submit',{
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
                    $("#dg-mapel").datagrid("reload");
                    $('#dlg-mapel').dialog('close'); 
                }else{
                    $('#dlg-mapel').dialog('close'); 
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
        var row = $('#dg-mapel').datagrid('getSelected');
        $('#form-tambah_mapel').form('load',row);
        $('#form-tambah_mapel').form('submit',{
            url: url,
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                var result = eval('('+result+')');
                if (result.success){
                    $('#dlg-hapus-mapel').dialog('close');        
                    $('#dg-mapel').datagrid('reload');
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

    function uploadDokumenMapel(){
    var form = $('#form-tambah_file')[0];
    if ($(form).form('enableValidation').form('validate')){
        var data = new FormData(form);

        $.ajax({
            url:'<?php echo site_url('mapel/saveDokumenMapel'); ?>',
            type:"post",
            enctype: 'multipart/form-data',
            data: data,
            dataType:'json',
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            beforeSend	: function(){
                $.messager.progress({
                    title:'Mohon tunggu',
                    msg:'Menyimpan Dokumen'
                });
            },
            success: function(data){
                $.messager.progress('close');
                if(data.success){
                    key_file = $("#key_file").val();
                    dokumen_id_array = $("#dokume_id_array").val();
                    if (key_file == '') {
                        $("#dokume_id_array").val(dokumen_id_array+","+data.id);
                        $("#dg-file").datagrid("appendRow",{
                            upload_file_id: data.upload_file_id,
                            key_file: null,
                            nama_file: data.nama_file,
                            tipe_file: data.tipe_file,
                            path_file: data.path_file
                        });
                    }else{
                        $('#dg-file').datagrid('reload');
                    }
                    $('#dlg-file').dialog('close');
                }else{
                    $.messager.alert('INFO',data.msg,'info');

                }
                
        }
        });
    }
    }

    function customLink(val,row){
		var ext=row.file_name.slice((row.file_name.lastIndexOf(".") - 1 >>> 0) + 2);
		ext = ext.toLowerCase();
		
		var foods = ["jpeg","jpg","png","pdf"];
		if(jQuery.inArray(ext, foods) !== -1){
			return '<a href="<?php echo base_url("")?>'+ row.file_path +'" style="color:#000000; text-decoration:none">'+row.file_name+'</a>';
		}else{
			return '<a style="border:padding:0 5px; margin:1px 0; width:300px;float:left;display:inline;" href="<?php echo base_url("")?>'+ row.file_path +'">'+ row.file_name +'</a>';
		}
	}

</script>