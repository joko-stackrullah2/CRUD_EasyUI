<ul id="tt" class="easyui-tree" animate="true" lines="true">
</ul>

<script type="text/javascript" src="<?php echo base_url();?>static/plupload/js/plupload.full.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url("static/fancybox/css/normalize.css")?>" />
<link rel="stylesheet" href="<?php echo base_url("static/fancybox/css/popelt.css")?>" />
<script type="text/javascript" src="<?php echo base_url("static/fancybox/minified/popelt-v1.0.min.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/fancybox.js"></script>

<script type="text/javascript">
 $(document).ready(function() {
     $('#tt').tree({
         url: '<?php echo base_url('index.php/menu/getData');?>',
         onClick: function(node){
            //console.log(node);
            loadCenterContent(node);
        }
    });

      function loadCenterContent(param){
         var url  = param.attributes.url;
         var view = param.attributes.view;
         var title=param.attributes.title;

     //    var target = '#center-content';
     //    var param={url:url,view:view};
     //    $.ajax({
     //      method: "POST",
     //      url: "<?Php echo base_url();?>index.php/menu/getContent",
     //      data: param,
     //      beforeSend: function(){
     //         // Handle the beforeSend event
     //        },
     //       complete: function(response){
            //console.log(response.responseText);
             // Handle the complete event
             // $('#center-content').html('');
             // $('#center-content').html(response.responseText);
             // $.parser.parse();
             // $.parser.parse('#center-content');
             
            // $('#dlg').dialog('close');
            // $('#dlg_ekspedisi').dialog('close');
            $('#content_tab').tabs("close", 0);
            $('#content_tab').tabs('add', {
                
                    title: title,
                    // iconCls:node.iconCls,   
                    cache:false,
                    href:base_url+'index.php/menu/getContentMenu/'+view+'/'+title
                    
                
            });
            
            
            //$('#content_tab').panel('refresh',base_url+'index.php/menu/getContentMenu/'+view);
     //       }
     //    });
      }

});
</script> 