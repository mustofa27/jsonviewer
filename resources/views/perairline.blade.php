@extends('layouts.parent_airline')

@section('content')
<div>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

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
                <tbody>
                  @foreach($data['airline'] as $s)
                    <tr>
                      <td>{{ $s->airline }}</td>
                      <td>{{ $s->callsign2 }}</td>
                      <td>{{ $s->regno }}</td>
                      <td>{{ $s->airport_name }}</td>
                      <td>{{ $s->belt }}</td>
                      @if(!empty($s->new_time))
                      <?php 
                        $time = explode("T",$s->new_time);
                        $jam = explode("+", $time[1]);
                      ?>
                      <td>{{ $jam[1] }}</td>
                      @else
                      <td>{{ $s->new_time }}</td>
                      @endif
                      @if(!empty($s->est))
                      <?php 
                        $time = explode("T",$s->est);
                        $jam = explode("+", $time[1]);
                      ?>
                      <td>{{ $jam[1] }}</td>
                      @else
                      <td>{{ $s->est }}</td>
                      @endif
                      @if(!empty($s->act))
                      <?php 
                        $time = explode("T",$s->act);
                        $jam = explode("+", $time[1]);
                      ?>
                      <td>{{ $s->jam[1] }}</td>
                      @else
                      <td>{{ $s->act }}</td>
                      @endif
                      @if(!empty($s->block))
                      <?php 
                        $time = explode("T",$s->block);
                        $jam = explode("+", $time[1]);
                      ?>
                      <td>{{ $s->jam[1] }}</td>
                      @else
                      <td>{{ $s->block }}</td>
                      @endif
                      <td>{{ $s->bay }}</td>
                      <td>{{ $s->status }}</td>
                      <td>{{ $s->terminal }}</td>
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