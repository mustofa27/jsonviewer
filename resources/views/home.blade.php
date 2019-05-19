@extends('layouts.parent_admin')

@section('content')
<div>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box" style="overflow:auto">
            <div class="box-header">
              <h3 class="box-title">
                Filter
              </h3>
              <div class="form-group">
                <label>Kode Airlines</label>
                <input type="text" class="form-control col-sm-12" required="" id="kode">
              </div>
              <!-- <div class="form-group">
                <label>Tanggal</label>
                <input id="datepicker" class='date form-control datepicker'>
              </div> -->
              <div class="form-group">
                <label>Terminal</label>
                <input type="text" class="form-control col-sm-12" required="" id="terminal">
              </div>
              <div class="form-group">
                <button class="btn btn-primary" id="show" name="show">Show</button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="table1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Airline</th>
                    <th>Flight</th>
                    <th>RegNo</th>
                    <th>Origin</th>
                    <th>Belt</th>
                    <th>Time</th>
                    <th>Est</th>
                    <th>Act</th>
                    <th>Block</th>
                    <th>Bay</th>
                    <th>Remark</th>
                    <th>Terminal</th>
                  </tr>
                </thead>
                <!-- <tfoot>
                  <tr>
                    <th>Airline</th>
                    <th>Flight</th>
                    <th>RegNo</th>
                    <th>Origin</th>
                    <th>Belt</th>
                    <th>Time</th>
                    <th>Est</th>
                    <th>Act</th>
                    <th>Block</th>
                    <th>Bay</th>
                    <th>Remark</th>
                    <th>Terminal</th>
                  </tr>
                </tfoot> -->
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
</div>

@endsection