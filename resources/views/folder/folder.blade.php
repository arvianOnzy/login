@extends('layouts.main')
@section('body')
@include('sections.cardOpen')
@include('components.loading')
@include('folder.form')
<div class="row mb-4 mt-2">
    <div class="col-6">
        <h3 class="card-title">Halaman Folder</h3>
    </div>
    <div class="col-6">
        <div class="d-flex justify-content-end">
            <a class="btn btn-primary tambah-folder m-1" role="button">Tambah</a>
            <a class="btn btn-warning edit-folder m-1" role="button">Edit</a>
            <a class="btn btn-danger hapus-folder m-1" role="button">Hapus</a>
        </div>
    </div>
</div>


<div class="row">
  <div class="col">
    <div id="jstree"></div>
  </div>
</div>


  
    
@include('sections.cardClose')
@endsection

@section('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(document).ready(function(){
    const app = {
      init:function(){
        var me = this;
        me.listeners();
        me.loadTree();
      },
      listeners:function(){
          var me = this;
          $(".tambah-folder").click(function(){
             $(".modal-folder").modal('show');

          });

          $(".hapus-folder").click(function(){
            Swal.fire({
              title: 'Yakin data akan di hapus?',
              showDenyButton: true,
              confirmButtonText: 'Hapus',
              denyButtonText: `Batal`,
            }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed) {
                me.onHapusFolder();
              } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
              }
            })
          })

          $(".edit-folder").click(function(){
            const data = $("#jstree").jstree(true).get_selected('full',true)[0].original;
            if(data.id === '1.'){
              Swal.fire(
                'Informasi!',
                'Mohon maaf node ini tidak bisa di edit!',
                'info'
              );
              return;
            }
            $("[name=folder]").val(data.text);
            $("[name=id_folder]").val(data.id_folder);
            $(".modal-folder").modal('show');
          });

          $(".btn-save-folder").click(function(){
           var me = this;
           $(".loading-overlay").show();
           const url = "{{ url('/store-folder') }}";
           var datastring = $("#form-folder").serialize();
            $.ajax({
                type: "POST",
                url,
                data: datastring,
                dataType: "json",
                success: function(data) {
                    me.loadTree();
                    $("#form-folder")[0].reset();
                    $(".modal-folder").modal('hide');
                    $(".loading-overlay").hide();
                     Swal.fire(
                      'Informasi!',
                      data.message,
                      'success'
                    );
                     
                },
                error: function() {
                    
                    $("#form-folder")[0].reset();
                    $(".modal-folder").modal('hide');
                     $(".loading-overlay").hide();
                     Swal.fire(
                      'Informasi!',
                      'Ada Kesalahan Server',
                      'warning'
                    );
                    
                }
            });

          }.bind(this));
      },
      onHapusFolder:function(){
        var me = this;
        $(".loading-overlay").show();
        var tree_id = $("#jstree").jstree('get_selected')[0];
        if(tree_id === '1.'){
           Swal.fire(
                'Informasi!',
                'Mohon maaf node ini tidak bisa di hapus!',
                'info'
              );
            return;
        }
          const url = "{{ url('/hapus-folder') }}";
         $.ajax({
          type: "POST",
          url,
          data: { tree_id,  "_token": "{{ csrf_token() }}", },
          dataType: "json",
          success: function(data) {
              me.loadTree();
              $("#form-folder")[0].reset();
              $(".modal-folder").modal('hide');
              $(".loading-overlay").hide();
               Swal.fire(
                'Informasi!',
                data.message,
                data.success ? 'success' : 'warning'
              );
               
          },
          error: function() {
              
              $("#form-folder")[0].reset();
              $(".modal-folder").modal('hide');
               $(".loading-overlay").hide();
               Swal.fire(
                'Informasi!',
                'Ada Kesalahan Server',
                'warning'
              );
              
          }
      });


      },
      initTree:function(){
           $('#jstree').jstree("destroy");
           $("#jstree").on('select_node.jstree', async function(e) {
              $("#form-folder")[0].reset();
              $('[name="tree_id"]').val($("#jstree").jstree('get_selected')[0]);
          });
      },
      loadTree:function(){
        var me = this;
        me.initTree();
        $('#jstree').jstree({
            'core' : {
              'data' : {
                "url" : "{{ url('/get-tree-folder') }}",
                "data" : function (node) {
                  return { "id" : node.id };
                }
              }
            }
          });
        }

      

    }

    app.init();
  })
    
</script>

@endsection()