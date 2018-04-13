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
                <span style="display:block; height: 30px;"></span>
                <div class="row align-items-center justify-content-center">
                  <div class="col-md-3">

                    <div class="card border-primary mb-3 text-center font-weight-bold" style="max-width: 20rem;">
                      <div class="card-header">Items Listed</div>
                      <div class="card-body">
                        <h4 class="card-title">@php if (!empty($listed)){ echo count($listed); } else { echo "0"; } @endphp</h4>
                      </div>
                    </div>
                    
                  </div>

                  <div class="col-md-3">

                    <div class="card border-primary mb-3 text-center font-weight-bold" style="max-width: 20rem;">
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
                      <div class="card-header">Total Profit</div>
                      <div class="card-body">
                        <h4 class="card-title">$@php echo number_format($profit, 2) @endphp</h4>
                      </div>
                    </div>
                  </div>
              
                 </div>
                 
                </div>        
            </div>
                
            </div><span style="display:block; height: 20px;"></span>
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
              
                  <div class="span3 border">
                            <table class="table table-striped table-hover">
                              <thead>
                                <tr>
                                @if(!empty($listed))
                                    @if(count($listed)>0)
                                  <th scope="col">Cust ID</th>
                                  <th scope="col">SKU</th>
                                  <th scope="col">Loc</th>
                                  <th scope="col">Item ID</th>
                                  <th scope="col">Item Title</th>
                                  <th scope="col">Received</th>
                                  <th scope="col">Qty</th>
                                  <th scope="col">Platform</th>
                                  <th scope="col">Status</th>
                                </tr>
                              </thead>
                              <tbody>
                                        @foreach($listed->all() as $listed)
                                      <tr>
                                      <td>{{ $listed->custid }}</td>
                                      <td>{{ $listed->sku }}</td>
                                      <td>{{ $listed->loc }}</td>
                                      <td>{{ $listed->itemid }}</td>
                                      <td>{{ $listed->title }}</td>
                                      <td>@php 
                                            echo App\Http\Controllers\UserController::dtform($listed->received, "Y-m-d", "-", "/");
                                          @endphp</td>
                                      <td>{{ $listed->qty }}</td>
                                      <td>{{ $listed->platform }}</td>
                                      <td>{{ $listed->status }}</td>
                                      </tr> 
                                        @endforeach
                                    @else
                                        <h6>No Active Inventory to show!</h6>
                                    @endif
                                @else
                                    <h6>No Active Inventory to show!</h6>
                                @endif
                              </tbody>
                            </table></div><span style="display:block; height: 50px;"></span>


                            <div class="card-header border"><h2>Sold Inventory</h2></div>
                            <div class="span3 border">
                            <table class="table table-striped table-hover">
                              <thead>
                                <tr>
                                @if(!empty($sold))
                                    @if(count($sold)>0)
                                  <th scope="col">Cust ID</th>
                                  <th scope="col">Item ID</th>
                                  <th scope="col">Item Title</th>
                                  <!--<th scope="col">Status</th>-->
                                  <th scope="col">Listed</th>
                                  <th scope="col">Sold</th>
                                  <th scope="col">Sales ID</th>
                                  <th scope="col">Sale Amt</th>
                                  <th scope="col">Consignment Pct</th>
                                  <th scope="col">Consignment Fee</th>
                                  <th scope="col">Profit</th>
                                </tr>
                              </thead>
                              <tbody>
                                        @foreach($sold->all() as $sold)
                                  <tr>
                                  <td>{{ $sold->custid }}</td>
                                  <td>{{ $sold->itemid }}</td>
                                  <td>{{ $sold->title }}</td>
                                  <!--<td>{{ $sold->status }}</td>-->
                                  <td>@php 
                                        echo App\Http\Controllers\UserController::dtform($sold->listed, "Y-m-d", "-", "/");
                                      @endphp</td>
                                  <td>@php 
                                        echo App\Http\Controllers\UserController::dtform($sold->sold, "Y-m-d", "-", "/");
                                      @endphp</td>
                                  <td>{{ $sold->salesid }}</td>
                                  <td>${{ $sold->saleamt }}</td>
                                  <td>{{ $sold->fee }}%</td>
                                  <td>${{ $sold->consignfee }}</td>
                                  <td>${{ $sold->due }}</td>
                                        @endforeach 
                                    @else
                                        <h6>No Sold Inventory to show!</h6>
                                    @endif
                                @else
                                    <h6>No Sold Inventory to show!</h6>
                                @endif
                              </tbody>
                            </table></div>

            </div>
      </div>
</div>
@endsection