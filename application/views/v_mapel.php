
<div class="easyui-layout" data-options="fit:true" style="width:1340px;height:600px;">
            <div data-options="region:'east',split:true" title="PENCARIAN" style="width:350px;padding:7px">
                <!-- <div>Pencarian</div> -->
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
                <div id="dd" class="easyui-dialog" title="Confirm" closed="true" button="#dd-buttons" style="width:600px;height:400px;" data-options="iconCls:'icon-help',resizable:true,modal:true">
                <div id="dlg-mapel" class="easyui-dialog"  style="width:520px;height:400px;padding:10px 20px" closed="true" buttons="#buttons-simpan_kelas">
                 <div class="ftitle">DAFTAR MAPEL</div>
                 <p>
            <form id="form-tambah_mapel" method="post" novalidate>
            <div class="fitem">
                            <P>
                            <label>Kode mapel:</label>
                            <p>
                            <input id="tb-kode" name="kode" class="easyui-textbox" width= "300" ></p>
                        </div>
                <div class="fitem">
                    <p>
                    <label>Nama Mapel:</label>
                    <p>
                    <input name="nama_mapel" class="easyui-textbox" width="300" ></p>
                </div>
                <div class="fitem">
                    <p>
                    <label>File:</label>
                    <p>
                    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newFile()" >Tambah File</a>
</p>
                </div>
                </form>
            
                <div id="dlg-file" class="easyui-dialog"  style="width:520px;height:500px;padding:10px 20px" closed="true" buttons="#buttons-simpan_file">
                 <div class="ftitle">DAFTAR MAPEL</div>
                 <p>
            <form id="form-tambah_file" method="post" novalidate>
                        <div class="fitem">
                            <P>
                            <label>Kode mapel:</label>
                            <p>
                            <input name="kode_mapel_id" class="easyui-textbox" width= "300" ></p>
                        </div>
                        <div class="fitem">
                            <P>
                            <label>Path file:</label>
                            <p>
                            <input  name="path_file" class="easyui-textbox" width= "300" ></p>
                        </div>
                        <div class="fitem">
                            <P>
                            <label>Nama file:</label>
                            <p>
                            <input name="nama_file" class="easyui-textbox" width= "300" ></p>
                        </div>
                        <div class="fitem">
                            <P>
                            <label>Keterangan file:</label>
                            <p>
                            <input  name="keterangan_file" class="easyui-textbox" width= "300" ></p>
                        </div>
                
                  
                </div>
            </form>
        </div>
    </div>
    <div id="buttons-simpan_kelas">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick= "simpan()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-mapel').dialog('close')" style="width:90px">Cancel</a>
    </div>
    <div id="buttons-simpan_file">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick= "simpanF()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-file').dialog('close')" style="width:90px">Cancel</a>
    </div>

    <div id="dlg-hapus-kelas" class="easyui-dialog" title="Confirm" closed="true" button="#buttons-hapus_kelas " style="width:400px;height:200px;" data-options="iconCls:'icon-help',resizable:true,modal:true">
        <center>
        <h1> Hapus data ini? </h1>
        <div id="buttons-hapus_kelas" >
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick= "hapus()" style="width:90px" >Hapus</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-hapus-kelas').dialog('close')" style="width:90px">Cancel</a>
        </div>
    </div>
    </body>
</html>
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
        $('#dd').dialog('open').dialog('setTitle','Hapus Data Mapel');
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

    function simpanF(){
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
                    $('#dlg-file').dialog('close'); 
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
                    $('#dd').dialog('close');        
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

    let uploaderBerkasAset = null;

    function initUploadFile(){
        console.log("asyu");
        function initg(){
            return new plupload.Uploader({
                browse_button : 'pickFile', // you can pass an id...
                container: document.getElementById('container2'), // ... or DOM Element itself
                url : '<?php echo base_url();?>upload/go',
                max_files: 200,
                multi_selection:false,
                multipart_params : {
                    lokasi  : "aset",
                    jenis   : "berkas_aset" 
                },
                flash_swf_url : '<?php echo base_url();?>static/plupload/js/Moxie.swf',
                silverlight_xap_url : '<?php echo base_url();?>static/plupload/js/Moxie.xap',
                            
                filters : {
                    max_file_size : '10mb',
                    mime_types: [
                        {title : "Image files", extensions : "jpg,pdf,xls,xlsx,png,,jpeg,doc,docx"}
                    ]
                },
                        
                init: {
                    PostInit: function() {
                        document.getElementById('uploadfiles').onclick = function() {
                            uploaderBerkasAset.start();
                            return false;
                        };
                    },
                                
                    FilesAdded: function(up, files) {
                        plupload.each(files, function(file) {
                            if(up.files.length == up.settings.max_files){
                            } 
                            if (up.files.length > up.settings.max_files) {
                                alert('Cannot send more than ' + up.settings.max_files + ' file(s).');
                                return false;
                            }	
                            if(file.origSize == file.size){
                                $('#uploadfiles').click();
                                $('#uploadfiles').hide();
                            }
                        });
                    },
                    UploadProgress: function(up, file) {
                        $.messager.progress({
                            title: 'Please waiting',
                            msg: 'Uploading...',
                            interval: 0
                        });
                        var bar = $.messager.progress('bar');
                        bar.progressbar('setValue', file.percent);
                        if (file.percent == 100) {
                            $.messager.progress('close');
                        }
                    },
                    Error: function(up, err) {
                        window.alert("Maaf, terdapat kesalahan sistem");
                    },
                    FileUploaded: function(up, file, jsonresp){
                        let jsonObj = JSON.parse(jsonresp.response);
                        console.log(jsonObj);
                        var listBerkasAset = $("#grid-berkas_mapel").datagrid('getRows');
                        $('#grid-berkas_mapel').datagrid('insertRow', {index: listBerkasAset.length + 1, row: {
                            tgl_upload: jsonObj.tgl_upload,
                            file_path: jsonObj.relativePath + jsonObj.fileName,
                            file_name: jsonObj.fileName
                        }});
                        $("#grid-berkas_mapel").datagrid("reload");
                    },
                    UploadComplete : function(up, files) {
                        plupload.each(files, function(file) {
                            //-- 
                        });			
                    }
                }
            });
        }
    
        uploaderBerkasAset = initg();
        uploaderBerkasAset.init();
        uploaderBerkasAset.splice();
        uploaderBerkasAset.refresh();
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