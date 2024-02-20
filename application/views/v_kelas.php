
<div class="easyui-layout" data-options="fit:true" style="width:1340px;height:600px;">
            <div data-options="region:'east',split:true" title="PENCARIAN" style="width:350px;padding:7px">
                <!-- <div>Pencarian</div> -->
                <input  id="searchKelas" class="easyui-searchbox" data-options="prompt:'Ketikkan nama kelas',searcher:doKelas" style="width:100%">

                
                
            </div>
            <div data-options="region:'center',title:'DAFTAR KELAS',iconCls:'icon-ok'">
                <div id="container">
                    <div id="body">
                    <table id="dg-kelas" toolbar="#toolbar" class="easyui-datagrid" style="width:auto;height:567px;; singleSelect="true" fitColumns="true" rowNumbers="false" pagination="true" url="<?= site_url('kelas/getAllDataKelas') ?>" pageSize="50" pageList="[25,50,75,100,125,150,200]" nowrap="false" data-options="singleSelect:true" >
                        <thead>
                            <tr>
                                <th field="id_kelas" width="200" sortable="true">ID KELAS</th>
                                <th field="nama_kelas"  width="200" sortable="true">NAMA KELAS</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div id="toolbar">
                <a href = "#" class = "easyui-linkbutton" iconCls = "icon-print"  onclick="cetakKelas()">Cetak </a>
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
            $('#dg-kelas').datagrid('load',{
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
    
    function doKelas(){
        $('#dg-kelas').datagrid('load',{
            search_guru: $('#searchKelas').val()
        });
    }

    function newKelas(){
        $('#dlg').dialog('open').dialog('setTitle','Tambah Data Kelas');
        $('#fm').form('clear');
        $('#fm #tb-id').textbox({readonly:false})
        url = '';
    }

    function editKelas(){
        let row = $('#dg-kelas').datagrid('getSelected');
        if (row){
        $('#dlg').dialog('open').dialog('setTitle','Edit Data Kelas');
        $('#fm').form('load',row);
        $('#fm #tb-id').textbox({readonly:true})
        url = 'index.php/Kelas/edit';
    }
    }

    function hapusKelas(){
        let row = $('#dg-kelas').datagrid('getSelected');
        if (row){
        $('#dd').dialog('open').dialog('setTitle','Hapus Data Kelas');
        $('#fm').form('load',row);
        url = 'index.php/Kelas/hapus';
    }
    }
    function cetakGuru() {
        $('#dg-kelas').datagrid('print','Data Kelas');  
        $('#dg-kelas').datagrid('print', {
        paper: 'A4',
        title: 'Data Kelas',
        fields: ['id_kelas','nama_kelas'],
        rows: rows,
    });
        }

   
        function cetakexcel(){
        $('#dg-guru').datagrid('toExcel',{
            filename: 'data_kelas.xls',
            worksheet: 'Worksheet',
            caption: 'DATA EXCEL SELURUH KELAS',
        }); 
    }
    
    
    function cetakpdf(){
        var body = $('#dg-kelas').datagrid('toArray');
        console.log(JSON.stringify(body))
        var docDefinition = {
                        header: {
                        margin: 10,
                        columns: [
                            {
                                margin: [230, 10, 10, 250],
                                text: 'DATA PDF SELURUH KELAS'
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
        pdfMake.createPdf(docDefinition).download('data-kelas.pdf');
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
        var row = $('#dg-kelas').datagrid('getSelected');
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
                    $("#dg-kelas").datagrid("reload");
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
        var row = $('#dg-kelas').datagrid('getSelected');
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
                    $('#dg-kelas').datagrid('reload');
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