@extends('layouts.main')

@section('style')
    <link rel="stylesheet" href="css/bidangKeahlian/style.css">    
@endsection

@section('body')
@include('sections.cardOpen')
@include('components.loading')
<!-- Modal -->
<div class="modal fade modal-tahapan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form id="form-tahapan">
        {!! csrf_field() !!}
        <div class="form-group">
          <label>Master Tahapan</label>
          <input type="text" class="form-control" required name="master_tahapan">
          <input type="text" class="form-control" hidden name="id">
        </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-save-tahapan" >Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- end modal -->
  <div class="row mb-4 mt-2">
      <div class="col-6">
          <h5 class="card-title">Master Tahapan</h5>
      </div>
      <div class="col-6">
          <div class="d-flex justify-content-end">
              <a class="btn btn-primary tambah-tahapan" role="button">Tambah</a>
          </div>
      </div>
  </div>
      <div style="max-height: 60vh; overflow-y:auto;">
          <div class="card-text me-3">
              <table class="table">
                  <thead class="thead">
                    <tr>
                      <th class="th" scope="col">No</th>
                      <th class="th" scope="col">Master Tahapan</th>
                      <th class="th" scope="col">Active</th>
                      <th class="th" scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      
                      <tr>
                        <td>BKK</td>
                        <td>abal</td>    
                        <td>5</td>
                          
                        <td>
                          <a href="" style="background:none;border:none;outline:none;"><i class='bx bx-pencil tableAction'></i></a>
                        </td>
                      </tr>
                      <tr>
                        <td>1</td>
                        <td>abal</td>    
                        <td>5</td>
                          
                        <td>
                          <a href="" style="background:none;border:none;outline:none;"><i class='bx bx-pencil tableAction'></i></a>
                        </td>
                      </tr>
                      <tr>
                        <td>1</td>
                        <td>abal</td>    
                        <td>5</td>
                          
                        <td>
                          <a href="" style="background:none;border:none;outline:none;"><i class='bx bx-pencil tableAction'></i></a>
                        </td>
                      </tr>
                      
                  </tbody>
              </table>                    
          </div>
      </div>
    @include('sections.cardClose')
@endsection

@section('script')
<script>
  $(document).ready(function(){
    const app = {
      init:function(){
        var me = this;
        me.listeners();
      },
      listeners:function(){
        var me = this;

        $(".tambah-tahapan").click(function(e){
          e.preventDefault();
          $(".modal-tahapan").modal('show');
        })

        $(".btn-save-tahapan").click(function(){
           var me = this;
           $(".loading-overlay").show();
           const url = "{{ url('/tahapan/store') }}";
           var datastring = $("#form-tahapan").serialize();
            $.ajax({
                type: "POST",
                url,
                data: datastring,
                dataType: "json",
                success: function(data) {
                    $("#form-tahapan")[0].reset();
                    $(".modal-tahapan").modal('hide');
                    $(".loading-overlay").hide();
                     Swal.fire(
                      'Informasi!',
                      data.message,
                      'success'
                    );

                     setTimeout(function(){
                        var url = '{{ route("detailTahapan", ":id") }}';
                        url = url.replace(':id', data.id);
                        window.location.replace(url);
                     },1000)
                     
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
      }
    }

    app.init();
  })
</script>
@endsection

