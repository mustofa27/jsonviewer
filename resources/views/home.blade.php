@extends('layouts.parent_admin')

@section('content')
<div>
    <section class="content">
      <div class="row">
        <div class="col-xs-11">

          <div class="box" style="overflow:auto">
            <div class="box-header">
              <h3 class="box-title">
                @if(isset($data['title']))
                    {{ $data['title'] }}
                @endif
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
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
                <tfoot>
                  <tr>
                    <th>No</th>
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
                </tfoot>
                <tbody>
                  <?php $count = 0;?>
                  @foreach($data['main'] as $s)
                    <tr>
                      <td>{{ ++$count }}</td>
                      <td>{{ $s->airline }}</td>
                      <td>{{ $s->airline }}</td>
                      <td>{{ $s->regno }}</td>
                      <td>{{ $s->regno }}</td>
                      <td>{{ $s->belt }}</td>
                      <td>{{ $s->time }}</td>
                      <td>{{ $s->est }}</td>
                      <td>{{ $s->act }}</td>
                      <td>{{ $s->block }}</td>
                      <td>{{ $s->bay }}</td>
                      <td>{{ $s->bay }}</td>
                      <td>{{ $s->terminal }}</td>
                      <td></td>
                    </tr>
                  @endforeach
                </tbody>
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
