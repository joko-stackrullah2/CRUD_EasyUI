
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
                                <th field="id_kelas" width="30" sortable="true" halign="center">ID KELAS</th>
                                <th field="nama_kelas"  width="200" sortable="true" halign="center">NAMA KELAS</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div id="toolbar">
                <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newKelas()" >Tambah Kelas</a>
                <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editKelas()" >Edit Kelas</a>
                <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="hapusKelas()" >Hapus Kelas</a>
                <a href = "#" class = "easyui-linkbutton" iconCls = "icon-print"  onclick="cetakpdf()">Cetak PDF </a>
                <a href = "#" class = "easyui-linkbutton" iconCls = "icon-print"  onclick="cetakexcel()">Cetak Excel </a>   
            </div>
                <div id="dd" class="easyui-dialog" title="Confirm" closed="true" button="#dd-buttons" style="width:400px;height:200px;" data-options="iconCls:'icon-help',resizable:true,modal:true">
            
                
                <div id="dlg-kelas" class="easyui-dialog"  style="width:420px;height:300px;padding:10px 20px" closed="true" buttons="#buttons-simpan_kelas">
                 <div class="ftitle">DATA KELAS</div>
                 <p>
            <form id="form-tambah_kelas" method="post" novalidate>
                <div class="fitem">
                    <label> Id Kelas:</label>
                    <p>
                    <input id="tb-id_kelas" name="id_kelas" class="easyui-textbox" width= "300" required="true"></p>
                </div>
                <div class="fitem">
                    <p>
                    <label>Nama Kelas:</label>
                <input name="nama_kelas" class="easyui-textbox" width="300"  required="true"></p>
                </div>
            </form>
        </div>
    </div>

    <div id="buttons-simpan_kelas">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick= "simpan()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-kelas').dialog('close')" style="width:90px">Cancel</a>
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
            $('#dg-kelas').datagrid('load',{
                kelas : val.value
            });
        }
    })


    function doKelas(){
        $('#dg-kelas').datagrid('load',{
            search_kelas: $('#searchKelas').val()
        });
    }

    function newKelas(){
        $('#dlg-kelas').dialog('open').dialog('setTitle','Tambah Data Kelas');
        $('#form-tambah_kelas').form('clear');
        $('#form-tambah_kelas #tb-id').textbox({readonly:false})
        url = 'index.php/Kelas/tambah';
    }

    function editKelas(){
        let row = $('#dg-kelas').datagrid('getSelected');
        if (row){
        $('#dlg-kelas').dialog('open').dialog('setTitle','Edit Data Kelas');
        $('#form-tambah_kelas').form('load',row);
        $('#form-tambah_kelas #tb-id').textbox({readonly:true})
        url = 'index.php/Kelas/edit';
    }
    }

    function hapusKelas(){
        let row = $('#dg-kelas').datagrid('getSelected');
        if (row){
        $('#dd').dialog('open').dialog('setTitle','Hapus Data Kelas');
        $('#form-tambah_kelas').form('load',row);
        url = 'index.php/Kelas/hapus';
    }
    }
    

   
        function cetakexcel(){
        $('#dg-kelas').datagrid('toExcel',{
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
                    widths: ['auto','*'],
                    body: body
                }
            }]
        };
        pdfMake.createPdf(docDefinition).download('data-kelas.pdf');
    }

    function simpan(){
        $('#form-tambah_kelas').form('submit',{
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
                    $('#dlg-kelas').dialog('close'); 
                }else{
                    $('#dlg-kelas').dialog('close'); 
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
        $('#form-tambah_kelas').form('load',row);
        $('#form-tambah_kelas').form('submit',{
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
        $('#form-tambah_kelas').form('load',row);
        $('#form-tambah_kelas').form('submit',{
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