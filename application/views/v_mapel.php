
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
                <a href = "#" class = "easyui-linkbutton" iconCls = "icon-print"  onclick="cetakMapel()">Cetak </a>
                <a href = "#" class = "easyui-linkbutton" iconCls = "icon-print"  onclick="cetakpdf()">Cetak PDF </a>
                <a href = "#" class = "easyui-linkbutton" iconCls = "icon-print"  onclick="cetakexcel()">Cetak Excel </a>   
            </div>
                <div id="dd" class="easyui-dialog" title="Confirm" closed="true" button="#dd-buttons" style="width:400px;height:200px;" data-options="iconCls:'icon-help',resizable:true,modal:true">
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

    function newGuru(){
        $('#dlg').dialog('open').dialog('setTitle','Tambah Data Guru');
        $('#fm').form('clear');
        $('#fm #tb-id').textbox({readonly:false})
        url = '';
    }

    function editGuru(){
        let row = $('#dg-guru').datagrid('getSelected');
        if (row){
        $('#dlg').dialog('open').dialog('setTitle','Edit Data Guru');
        $('#fm').form('load',row);
        $('#fm #tb-nisn').textbox({readonly:true})
        url = 'index.php/Siswa/edit';
    }
    }

    function hapusGuru(){
        let row = $('#dg-guru').datagrid('getSelected');
        if (row){
        $('#dd').dialog('open').dialog('setTitle','Hapus Data Guru');
        $('#fm').form('load',row);
        url = 'index.php/Siswa/hapus';
    }
    }
    function cetakMapel() {
        $('#dg-mapel').datagrid('print','Daftar Mata Pelajaran');  
        $('#dg-mapel').datagrid('print', {
        paper: 'A4',
        title: 'Daftar Mata Pelajaran',
        fields: ['id_mapel','nama_mapel'],
        rows: rows,
    });
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