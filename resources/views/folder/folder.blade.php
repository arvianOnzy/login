@extends('layouts.main')
@section('body')
@include('sections.cardOpen')
<div class="row mb-4 mt-2">
    <div class="col-6">
        <h3 class="card-title">Halaman Folder</h3>
    </div>
    <div class="col-6">
        <div class="d-flex justify-content-end">
            <a class="btn btn-primary" href="/tambahkan-data" role="button">Tambahkan Dokumen</a>
        </div>
    </div>
</div>


<div id="data" class="demo">
  <ul>
    <li>Electronics
      <ul>
        <li>Mobile
          <ul>
            <li>Samsung</li>
            <li>Apple</li>
          </ul>
        </li>
        <li>Laptop
          <ul>
            <li>Dell</li>
            <li>Computer Peripherals
              <ul>
                <li>Printers</li>
                <li>Monitor</li>
              </ul>
            </li>
            <li>Keyboard</li>
          </ul>
        </li>
      </ul>
    </li>
  </ul>
</div>


  
    
@include('sections.cardClose')
@endsection

@section('script')
<script>
  $(document).ready(function(){
    $.jstree.defaults.core.themes.variant = "large";
    $('#data').jstree({
    
	  });
  })
    
</script>

@endsection()