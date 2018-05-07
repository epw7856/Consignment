@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
                <div class="jumbotron-fluid">
                <h1 class="display-4 text-center">User Dashboard</h1>
              </div>
      </div>
        <div class="col-md-12">
            <div>
                <span style="display:block; height: 20px;"></span>

                <div class="row justify-content-center align-items-center">
                    <h5>Current Date Filter: @php if (is_null($date)||($date=='All Time')){ echo "None"; } else if ($date=='Current Month'){ echo Illuminate\Support\Carbon::now()->format('M'); echo " "; echo Illuminate\Support\Carbon::now()->format('Y');} else if ($date=='Current Year'){ echo Illuminate\Support\Carbon::now()->format('Y');}  else if ($date=='Current Week'){ echo "&nbsp"; echo Illuminate\Support\Carbon::now()->startOfWeek()->format('M d Y'); echo "&nbsp&nbspto&nbsp&nbsp"; echo Illuminate\Support\Carbon::now()->endOfWeek()->format('M d Y');} @endphp</h5>
                </div>

                <span style="display:block; height: 20px;"></span>
                <div class="row align-items-center justify-content-center">
                  <div class="col-md-3">

                    <div class="card border-success mb-3 text-center font-weight-bold" style="max-width: 20rem;">
                      <div class="card-header">Items Sold</div>
                      <div class="card-body">
                        <h4 class="card-title">@php if (!empty($sold)){ echo count($sold); } else { echo "0"; } @endphp</h4>
                      </div>
                    </div>

                  </div>

                  <div class="col-md-3">

                    <div class="card border-success mb-3 text-center font-weight-bold" style="max-width: 20rem;">
                      <div class="card-header">Gross Amount Sold</div>
                      <div class="card-body">
                        <h4 class="card-title">$@php echo number_format($amt, 2) @endphp</h4>
                      </div>
                    </div>
                     
                  </div>
                  
                  <div class="col-md-3">

                    <div class="card border-success mb-3 text-center font-weight-bold" style="max-width: 20rem;">
                      <div class="card-header">Sell Through %</div>
                      <div class="card-body">
                        <h4 class="card-title">@php echo number_format($sellthru, 1) @endphp%</h4>
                      </div>
                    </div>

                  </div>
              
                 
                 
                  <!--<div class="col-md-4"></div>-->
                  <div class="col-md-3">

                    <div class="card border-success mb-3 text-center font-weight-bold" style="max-width: 20rem;">
                      <div class="card-header">Total Profit</div>
                      <div class="card-body">
                        <h4 class="card-title">$@php echo number_format($profit, 2) @endphp</h4>
                      </div>
                    </div>
                    
                  </div>
                 
                </div>        
            </div></div></div>

            <span style="display:block; height: 20px;"></span>
            <form class="horizontal" method="GET" action="{{ url('/home') }}" >
           
              <div class="row">
                <div class="col-md-2">
                  <h5 style="position: relative;top: 50%;transform: translateY(-50%);">Filter By Date: </h5>
                  
                </div>
                <div class="col-md-2">

                  <select name="filterDate" class="form-control">
                    <option value="default">Select Date</option>
                    <option value="All Time">All Time</option>
                    <option value="Current Week">Current Week</option>
                    <option value="Current Month">Current Month</option>
                    <option value="Current Year">Current Year</option>
                  </select>
                  
                </div>

                <button type="submit" class="btn btn-secondary btn-md">Filter</button>
              </div>
            
            </form>

            <span style="display:block; height: 20px;"></span>
            <div class="row">
                  <div class="col-md-16 col-lg-16">
                    @if(session('info'))
                    <div class="alert alert-success">
                      {{session('info')}}
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger">
                      {{session('error')}}
                    </div>
                    @endif
                  </div>
            </div>
            <span style="display:block; height: 20px;"></span>


                <div class="card-header border"><h2>Active Inventory</h2></div>
                          @if(!empty($listed))
                            @if(count($listed)>0)
                            <table class="specialTable">
                              <col width="5.5%"> <!-- Cust ID -->
                              <col width="4.5%"> <!-- SKU -->
                              <col width="4.5%"> <!-- LOC -->
                              <col width="13.75%"> <!-- Item ID -->
                              <col width="44.25%"> <!-- Item Title -->
                              <col width="8.35%"> <!-- Listed -->
                              <col width="4.0%"> <!-- Qty -->
                              <col width="7.25%"> <!-- Platform -->
                              <col width="6.90%"> <!-- Status -->
                              <!--<col width="11.80%"> <!-- Action -->
                              <thead>
                                <tr>
                                  <th><div class="sorting"><a href="#" id="link" data-column="0" data-direction="0">Cust ID</a></div></th>
                                  <th><div class="sorting"><a href="#" id="link" data-column="1" data-direction="0">SKU</a></div></th>
                                  <th><div class="sorting"><a href="#" id="link" data-column="2" data-direction="0">Loc</a></div></th>
                                  <th><div class="sorting"><a href="#" id="link" data-column="3" data-direction="0">Item ID</a></div></th>
                                  <th><div class="sorting"><a href="#" id="link" data-column="4" data-direction="0">Item Title</a></div></th>
                                  <th><div class="sorting"><a href="#" id="link" data-column="5" data-direction="0">Listed</a></div></th>
                                  <th><div class="sorting"><a href="#" id="link" data-column="6" data-direction="0">Qty</a></div></th>
                                  <th><div class="sorting"><a href="#" id="link" data-column="7" data-direction="0">Platform</a></div></th>
                                  <th><div class="sorting"><a href="#" id="link" data-column="8" data-direction="0">Status</a></div></th>
                                  <!--<th>Action</th>-->
                                  
                                </tr>
                              </thead>
                            </table>
                            
                            <div class="span3 border">
                            <table id="table1" class="table table-fixed table-striped tablesorter">
                              <col width="5.5%"> <!-- Cust ID -->
                              <col width="4.5%"> <!-- SKU -->
                              <col width="4.5%"> <!-- LOC -->
                              <col width="13.75%"> <!-- Item ID -->
                              <col width="44.25%"> <!-- Item Title -->
                              <col width="8.35%"> <!-- Listed -->
                              <col width="4.0%"> <!-- Qty -->
                              <col width="7.25%"> <!-- Platform -->
                              <col width="6.90%"> <!-- Status -->
                              <!--<col width="11.80%"> <!-- Action -->
                              <thead>
                                  <tr style="display:none;">
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                  </tr>
                              </thead>
                              <tbody>
                                      @foreach($listed->all() as $listed)
                                  <tr>
                                  <td>{{ $listed->custid }}</td>
                                  <td>{{ $listed->sku }}</td>
                                  <td>{{ $listed->loc }}</td>
                                  <td>{{ $listed->itemid }}</td>
                                  <td class="specialtd">{{ $listed->title }}</td>
                                  <td>@php 
                                        echo App\Http\Controllers\UserController::dtform($listed->listed, "Y-m-d", "-", "/");
                                      @endphp</td>
                                  <td>{{ $listed->qty }}</td>
                                  <td>{{ $listed->platform }}</td>
                                  <td>{{ $listed->status }}</td>
                                  </tr> 
                                      @endforeach
                              </tbody>
                            </table>
                            </div>
                            @else
                              <span style="display:block; height: 20px;"></span>
                              <h6>No Active Inventory to show!</h6>
                            @endif
                          @else
                              <h6>No Active Inventory to show!</h6>
                          @endif


                          <span style="display:block; height: 50px;"></span>

            </div>
      </div>
</div>
<script src="{{ url('js/sortInventoryTable.js') }}"></script>
@endsection