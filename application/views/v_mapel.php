
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
                                <th field="id_mapel" width="50" sortable="true" halign="center">ID MAPEL</th>
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
                <div id="dd" class="easyui-dialog" title="Confirm" closed="true" button="#dd-buttons" style="width:400px;height:200px;" data-options="iconCls:'icon-help',resizable:true,modal:true">
                <div id="dlg-mapel" class="easyui-dialog"  style="width:420px;height:300px;padding:10px 20px" closed="true" buttons="#buttons-simpan_kelas">
                 <div class="ftitle">DAFTAR MAPEL</div>
                 <p>
            <form id="form-tambah_mapel" method="post" novalidate>
                <div class="fitem">
                    <label> Id Mapel:</label>
                    <p>
                    <input id="tb-id_mapel" name="id_mapel" class="easyui-textbox" width= "300" required="true"></p>
                </div>
                <div class="fitem">
                    <p>
                    <label>Nama Mapel:</label>
                <input name="nama_mapel" class="easyui-textbox" width="300"  required="true"></p>
                </div>
            </form>
        </div>
    </div>
    <div id="buttons-simpan_kelas">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick= "simpan()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-mapel').dialog('close')" style="width:90px">Cancel</a>
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
    
    function doMapel(){
        $('#dg-mapel').datagrid('load',{
            search_mapel: $('#searchMapel').val()
        });
    }

    function newMapel(){
        $('#dlg-mapel').dialog('open').dialog('setTitle','Tambah Data Mapel');
        $('#form-tambah_mapel').form('clear');
        $('#form-tambah_mapel #tb-id_mapel').textbox({readonly:false})
        url = 'index.php/Mapel/tambah';
    }

    function editMapel(){
        let row = $('#dg-mapel').datagrid('getSelected');
        if (row){
        $('#dlg-mapel').dialog('open').dialog('setTitle','Edit Data Mapel');
        $('#form-tambah_mapel').form('load',row);
        $('#form-tambah_mapel #tb-id_mapel').textbox({readonly:true})
        url = 'index.php/Mapel/edit';
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


</script>