<div class="easyui-layout" data-options="fit:true" style="background:#eee;">
    <div data-options="region:'east',split:true" title="PENCARIAN" style="width:350px;padding:7px">
        <input  id="searchSiswa" class="easyui-searchbox" data-options="prompt:'Ketikkan nama siswa',searcher:doSiswa" style="width:100%">
        <p><label>KELAS:</label><p>
        <select id="cb-siswa-filter_kelas" class="easyui-combobox" name="nama_kelas" style="width:150px;" editable="false"   panelHeight="100%">
            <option>RPL 1</option>
            <option>RPL 2</option>
            <option>RPL 3</option>
            <option>TKJ 1</option>
            <option>TKJ 2</option>
            <option>TKJ 3</option>
            <option>TEI 1</option>
            <option>TEI 2</option>
            <option>TEI 3</option>

          
        </select>
        <p><label>JENIS KELAMIN:</label><p>
        <select id="cb-siswa-filter_kelamin" class="easyui-combobox" name="kelamin" style="width:150px;" editable="false"  panelHeight="100%">
            <option>LAKI-LAKI</option>
            <option>PEREMPUAN</option>
        </select>
    </div>

    <div data-options="region:'center',border:false">
        <table 
            id='dg-siswa' toolbar='#tb-siswa' class='easyui-datagrid' 
            style="width:auto;height:567px;" 
            singleSelect="true" 
            fitColumns="true" 
            rowNumbers="false" 
            pagination="true" 
            url="<?= site_url('siswa/getAllDataSiswa') ?>" 
            pageSize="50" pageList="[25,50,75,100,125,150,200]" 
            nowrap="false" data-options="singleSelect:true" >
            <thead>
                <tr>
                    <th field="nisn" width="225" sortable="true" halign="center">NISN</th>
                    <th field="nama"  width="300" sortable="true" halign="center">NAMA</th>
                    <th field="alamat"  width="430" sortable="true" halign="center">ALAMAT</th>
                    <th field="telepon"  width="300" sortable="true" halign="center">TELEPON</th>
                    <th field="kelamin"  width="300" sortable="true" halign="center">JENIS KELAMIN</th>
                    <th field="nama_kelas"  width="200" sortable="true" halign="center">KELAS</th>
                </tr>
            </thead>
        </table>
    </div>

    <div id="tb-siswa">
        <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newSiswa()" >Tambah Siswa</a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editSiswa()" >Edit Siswa</a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="hapusSiswa()" >Hapus Siswa</a>
        <a href = "#" class = "easyui-linkbutton" iconCls = "icon-print"  onclick="cetakpdf()">Cetak PDF </a>
        <a href = "#" class = "easyui-linkbutton" iconCls = "icon-print"  onclick="cetakexcel()">Cetak Excel </a>   
    </div>

    <div id="dlg-siswa" class="easyui-dialog"  style="width:420px;height:510px;padding:10px 20px" closed="true" buttons="#buttons-simpan_siswa">
        <div class="ftitle">DATA SISWA</div>
            <form id="form-tambah_siswa" method="post" novalidate>
                <div class="fitem">
                    <label>Nisn:</label>
                    <input id="tb-nisn" name="nisn" class="easyui-textbox" width= "300" required="true"></p>
                </div>
                <div class="fitem">
                    <p>
                    <label>Nama:</label>
                <input name="nama" class="easyui-textbox" width="300"  required="true"></p>
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
                <div class="fitem">
                    <p>
                    <label>Jenis Kelamin:</label>
                <select id="cc" class="easyui-combobox" name="kelamin" style="width:150px;"  editable="false" panelHeight="100%">
                    <option>LAKI-LAKI</option>
                    <option>PEREMPUAN</option>
                </select>
                <label>Kelas:</label>
                <div style="margin-bottom:20px">
                    <input class="easyui-radiobutton" name="id_kelas" value="1" label="RPL 1:">
                </div>
                <div style="margin-bottom:20px">
                    <input class="easyui-radiobutton" name="id_kelas" value="2" label="RPL 2:">
                </div>
                <div style="margin-bottom:20px">
                    <input class="easyui-radiobutton" name="id_kelas" value="3" label="RPL 3:">
                </div>
                <div style="margin-bottom:20px">
                    <input class="easyui-radiobutton" name="id_kelas" value="4" label="TKJ 1:">
                </div>
                <div style="margin-bottom:20px">
                    <input class="easyui-radiobutton" name="id_kelas" value="5" label="TKJ 2:">
                </div>
                <div style="margin-bottom:20px">
                    <input class="easyui-radiobutton" name="id_kelas" value="6" label="TKJ 3:">
                </div>
                <div style="margin-bottom:20px">
                    <input class="easyui-radiobutton" name="id_kelas" value="7" label="TEI 1:">
                </div>
                <div style="margin-bottom:20px">
                    <input class="easyui-radiobutton" name="id_kelas" value="8" label="TEI 2:">
                </div>
                <div style="margin-bottom:20px">
                    <input class="easyui-radiobutton" name="id_kelas" value="9" label="TEI 3:">
                </div>
            </form>
        </div>
    </div>

    <div id="buttons-simpan_siswa">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick= "simpan()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-siswa').dialog('close')" style="width:90px">Cancel</a>
    </div>

    <div id="dlg-hapus-siswa" class="easyui-dialog" title="Confirm" closed="true" button="#buttons-hapus_siswa" style="width:400px;height:200px;" data-options="iconCls:'icon-help',resizable:true,modal:true">
        <center>
        <h1> Hapus data ini? </h1>
        <div id="buttons-hapus_siswa" >
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick= "hapus()" style="width:90px" >Hapus</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-hapus-siswa').dialog('close')" style="width:90px">Cancel</a>
        </div>
    </div>
</div>
<script>
    var url =''

    $("#cb-siswa-filter_kelas").combobox({
        onClick : function(val){
            $('#dg-siswa').datagrid('load',{
                nama_kelas : val.value
            });
        }
    })

    $("#cb-siswa-filter_kelamin").combobox({
        onClick : function(val){
            $('#dg-siswa').datagrid('load',{
                kelamin : val.value
            });
        }
    }) 
    
    function doSiswa(){
        $('#dg-siswa').datagrid('load',{
            search_siswa: $('#searchSiswa').val()
        });
    }

    function newSiswa(){
        $('#dlg-siswa').dialog('open').dialog('setTitle','Tambah Data Siswa');
        $('#form-tambah_siswa').form('clear');
        $('#form-tambah_siswa #tb-nisn').textbox({readonly:false})
        url = 'index.php/Siswa/tambah';
    }

    function editSiswa(){
        let row = $('#dg-siswa').datagrid('getSelected');
        if (row){
        $('#dlg-siswa').dialog('open').dialog('setTitle','Edit Data Siswa');
        $('#form-tambah_siswa').form('load',row);
        $('#form-tambah_siswa #tb-nisn').textbox({readonly:true})
        url = 'index.php/Siswa/edit';
    }
    }

    function hapusSiswa(){
        let row = $('#dg-siswa').datagrid('getSelected');
        if (row){
        $('#dlg-hapus-siswa').dialog('open').dialog('setTitle','Hapus Data Siswa');
        $('#form-tambah_siswa').form('load',row);
        url = 'index.php/Siswa/hapus';
    }
    }
   

   
        function cetakexcel(){
        $('#dg-siswa').datagrid('toExcel',{
            filename: 'data_siswa.xls',
            worksheet: 'Worksheet',
            caption: 'DATA SELURUH SISWA',
        }); 
    }
    
    
    function cetakpdf(){
        var body = $('#dg-siswa').datagrid('toArray');
        console.log(JSON.stringify(body))
        var docDefinition = {
                        header: {
                        margin: 10,
                        columns: [
                            {
                                margin: [230, 10, 10, 250],
                                text: 'DATA SELURUH SISWA'
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
        pdfMake.createPdf(docDefinition).download('data-siswa.pdf');
    }

    function simpan(){
        $('#form-tambah_siswa').form('submit',{
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
                    $('#dlg-siswa').dialog('close'); 
                }else{
                    $('#dlg-siswa').dialog('close'); 
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
        $('#form-tambah_siswa').form('load',row);
        $('#form-tambah_siswa').form('submit',{
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
                    $('#dlg-siswa').dialog('close'); 
                }else{
                    $('#dlg-siswa').dialog('close'); 
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
        $('#form-tambah_siswa').form('load',row);
        $('#form-tambah_siswa').form('submit',{
            url: url,
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                var result = eval('('+result+')');
                if (result.success){
                    $('#dlg-hapus-siswa').dialog('close');        
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