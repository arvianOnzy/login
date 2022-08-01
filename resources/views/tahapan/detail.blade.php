@extends('layouts.main')

@section('style')
    <link rel="stylesheet" href="css/bidangKeahlian/style.css">    
@endsection

@section('body')
@include('sections.cardOpen')
@include('components.loading')
<!-- Modal -->
<div class="modal fade modal-sequence" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Sequnce</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form id="form-sequence">
        {!! csrf_field() !!}
        <div class="form-group">
          <label>Nama</label>
          <input type="text" class="form-control" required name="nama">
          <input type="text" class="form-control" hidden name="id">
          <input type="text" class="form-control" hidden name="tahapan_hdr_id" value="{{ $tahapan->id }}">
        </div>
        <div class="form-group">
          <label>Urutan</label>
          <input type="number" class="form-control" required name="urutan">
        </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-save-sequence" >Save</button>
      </div>
    </div>
  </div>
</div>

<!-- end modal -->
  <div class="row mb-4 mt-2">
      <div class="col-6">
         <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Tahapan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
          </ol>
        </nav>
      </div>
  </div>
  <div class="row">
      <label for="staticEmail" class="col-sm-2 col-form-label">Master Tahapan</label>
      <div class="col-sm-2">
        <input type="text" readonly class="form-control-plaintext" value="{{ $tahapan->master_tahapan }}">
      </div>
  </div>
  <div class="row" style="margin-bottom: 20px;">
    <div class="col">
      <button type="button" class="btn btn-success tambah-sequence" style="float: right;">Tambah Sequence</button>
    </div>
  </div>
      <div style="max-height: 60vh; overflow-y:auto;">
          <div class="card-text me-3">
              <table class="table">
                  <thead class="thead">
                    <tr>
                      <th class="th" scope="col">No</th>
                      <th class="th" scope="col">Nama</th>
                      <th class="th" scope="col">Sequence</th>
                      <th class="th" scope="col">Unit</th>
                      <th class="th" scope="col">Pegawai</th>
                      <th class="th" scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody class="tbody-sequence">
                      @foreach($detail as $detail)
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $detail->nama }}</td>    
                        <td>{{ $detail->urutan }}</td>
                        <td></td>
                        <td></td>
                        <td>
                          <a class="btn-edit" style="background:none;border:none;outline:none;" data-id="{{ $detail->id }}"><i class='bx bx-pencil tableAction'></i></a>
                           <a class="btn-hapus" style="background:none;border:none;outline:none;" data-id="{{ $detail->id }}"><i class='bx bx-trash tableAction'></i></a>
                        </td>
                      </tr>
                      @endforeach
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
        me.initTabelTahapan();

        $(".tambah-sequence").click(function(e){
          e.preventDefault();
          $(".modal-sequence").modal('show');
           me.resetForm();
        })

        $(".btn-save-sequence").click(function(){
           var me = this;
           $(".loading-overlay").show();
           const url = "{{ url('/tahapan/store-sequence') }}";
           var datastring = $("#form-sequence").serialize();
            $.ajax({
                type: "POST",
                url,
                data: datastring,
                dataType: "json",
                success: function(data) {
                    $(".modal-sequence").modal('hide');
                    $(".loading-overlay").hide();
                     Swal.fire(
                      'Informasi!',
                      data.message,
                      'success'
                    );

                     setTimeout(function(){
                        me.getTahapanDetail();
                     }.bind(me),1000)
                     
                },
                error: function() {
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
      resetForm:function(){
        $("[name=nama]").val('');
        $("[name=urutan]").val('');
        $("[name=id]").val('');
      },
      getTahapanById(id){
       $(".modal-sequence").modal('show');
            $(".loading-overlay").show();
            const url = "{{ url('/tahapan/tahapan-by-id') }}" + '?id='+ id;
            $.ajax({
            url,
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                const data = res.data;
                $(".loading-overlay").hide();
                  $("[name=nama]").val(data.nama);
                  $("[name=urutan]").val(data.urutan);
                  $("[name=id]").val(data.id);
            },
            error: function() {
              $(".loading-overlay").hide();
                 Swal.fire(
                  'Informasi!',
                  'Ada Kesalahan Server',
                  'warning'
                );
                
            }
        });

      },
      initTabelTahapan:function(){
         var me = this;
         $(".btn-edit").click(function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            me.getTahapanById(id);
            
        });

        $(".btn-hapus").click(function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            me.hapusTahapanSeq(id);
            
        });

      },
      hapusTahapanSeq:function(id){
        var me = this;
        Swal.fire({
          title: 'Apakah anda yakin akan menghapus data ini?',
          showCancelButton: true,
          confirmButtonText: 'Hapus',
          denyButtonText: `Batal`,
        }).then((result) => {
          
          if (result.isConfirmed) {
              const url = "{{ url('/tahapan/hapus') }}";
              $(".loading-overlay").show();
              $.ajax({
                type: "POST",
                url,
                data: {id, _token:"{{ csrf_token() }}" },
                dataType: "json",
                success: function(data) {
                    $(".loading-overlay").hide();
                     Swal.fire(
                      'Informasi!',
                      data.message,
                      'success'
                    );

                     setTimeout(function(){
                        me.getTahapanDetail();
                     }.bind(me),1000)
                     
                },
                error: function() {
                    $(".modal-folder").modal('hide');
                     $(".loading-overlay").hide();
                     Swal.fire(
                      'Informasi!',
                      'Ada Kesalahan Server',
                      'warning'
                    );
                    
                }
            });

          } 
        })
      },
      getTahapanDetail:function(){
        var me = this;
        $(".loading-overlay").show();
        var tahapan_hdr_id = $("[name=tahapan_hdr_id]").val();
        var url = '{{ route("detailTahapan", ":id") }}';
        url = url.replace(':id', tahapan_hdr_id);
         $.ajax({
            url,
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                $(".loading-overlay").hide();
                $(".tbody-sequence").html('');
                const data = res.data;
                var html = '';
                $.each(data, function(index, item) {
                    html+=`
                      <tr>
                        <td>${index + 1}</td>
                        <td>${item.nama}</td>    
                        <td>${item.urutan}</td>
                        <td></td>
                        <td></td>
                        <td>
                          <a class="btn-edit" href="" style="background:none;border:none;outline:none;" data-id="${item.id}"><i class='bx bx-pencil tableAction'></i></a>
                           <a class="btn-hapus"  href="" style="background:none;border:none;outline:none;" data-id="${item.id}"><i class='bx bx-trash tableAction'></i></a>
                        </td>
                      <tr>
                    `
                });

                 $(".tbody-sequence").html(html);
                 me.initTabelTahapan();

            },
            error: function() {
              $(".loading-overlay").hide();
                 Swal.fire(
                  'Informasi!',
                  'Ada Kesalahan Server',
                  'warning'
                );
                
            }
        });
      }
    }

    app.init();
  })
</script>
@endsection

