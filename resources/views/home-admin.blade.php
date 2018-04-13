@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
                <div class="jumbotron-fluid">
                <h1 class="display-4 text-center">Admin Dashboard</h1>
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
                      <div class="card-header">Total Amount Due</div>
                      <div class="card-body">
                        <h4 class="card-title">$@php echo number_format($due, 2) @endphp</h4>
                      </div>
                    </div>

                  </div>
              
                 </div>
                 <div class="row align-items-center justify-content-center">
                  <!--<div class="col-md-4"></div>-->
                  <div class="col-md-4">

                    <div class="card border-success mb-3 text-center font-weight-bold" style="max-width: 20rem;">
                      <div class="card-header">Total Consignment Profit</div>
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


                <form class="horizontal" method="POST" action="{{ url('/insert') }}" >
                {{csrf_field()}}
                  <fieldset>
                    <div class="card-header"><h2>Add New Inventory Item</h2><span style="display:block; height: 20px;"></span>
                    <div class="row">
                    <div class="col-md-16 col-lg-16">
                    @if(count($errors) > 0)
                      @foreach($errors->all() as $error)
                        <div class="alert alert-danger">
                          {{$error}}
                        </div>
                      @endforeach
                    @endif
                  </div>
                  </div>


                    <div class="row">
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="customerID1">Cust ID</label>
                          <input type="text" name="custid" class="form-control" id="customerID1" aria-describedby="emailHelp" placeholder="Cust ID">           
                        </div>
                      </div>

                      <div class="col-md-1">
                        <div class="form-group">
                          <label for="sku1">SKU</label>
                          <input type="text" name="sku" class="form-control" id="sku1" aria-describedby="emailHelp" placeholder="SKU">           
                        </div>
                      </div>

                      <div class="col-md-1">
                        <div class="form-group">
                          <label for="loc1">Loc</label>
                          <input type="text" name="loc" class="form-control" id="loc1" aria-describedby="emailHelp" placeholder="Loc">           
                        </div>
                      </div>

                      <div class="col-md-8">
                        <div class="form-group">
                          <label for="title1">Item Title</label>
                          <input type="text" name="title" class="form-control" id="title1" aria-describedby="emailHelp" placeholder="Item Title">
                        </div>
                      </div>

                    </div>

                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="received1">Date Received</label>
                          <input type="text" name="received" class="form-control" id="received1" aria-describedby="emailHelp" placeholder="mm/dd/yyyy">
                        </div>
                      </div>

                      <div class="col-md-1">
                        <div class="form-group">
                          <label for="qty1">Qty</label>
                          <input type="text" name="qty" class="form-control" id="qty1" aria-describedby="emailHelp" placeholder="Qty">      
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="platform1">Platform</label>
                          <input type="text" name="platform" class="form-control" id="platform1" aria-describedby="emailHelp" placeholder="Platform">
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="status1">Status</label>
                          <div class="row">
                            <input type="radio" name="status" id="r1" value="LISTED"/>LISTED
                          </div>
                          <div class="row">
                            <input type="radio" name="status" id="r2" value="BUNDLE"/>BUNDLE
                          </div>
                        </div>
                      </div>
                    </div>

                    
                    </fieldset>
                    <span style="display:block; height: 10px;"></span>
                    *Note: Item ID will be created automatically
                    <span style="display:block; height:20px;"></span>
                    <button type="submit" class="btn col-md-1 btn-primary">Submit</button>
                    <button type="button" onclick="clearFields()" class="btn col-md-1 btn-secondary">Clear</button>
                   </form>
                  </fieldset>
                

              <span style="display:block; height: 50px;"></span>

                <div class="card-header border"><h2>Active Inventory</h2></div>
              
                  <div class="span3 border">
                            <table class="table table-fixed table-striped">
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
                                  <th scope="col">Action</th>
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
                                  <td>
                                    <a href='{{ url("/update/{$listed->itemid}") }}' class="label label-success">Update |</a>
                                    <a href='{{ url("/delete/{$listed->itemid}") }}' class="label label-danger">Delete</a>
                                  </td>
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
                                  <th scope="col">Consign Pct</th>
                                  <th scope="col">Consign Fee</th>
                                  <th scope="col">Amt Due</th>
                                  <th scope="col">Action</th>
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
                                  <td>
                                    <a href='{{ url("/update/{$sold->itemid}") }}' class="label label-success">Update |</a>
                                    <a href='{{ url("/delete/{$sold->itemid}") }}' class="label label-danger">Delete</a>
                                  </td>
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
<script src="{{ url('js/clearFields.js') }}"></script>
@endsection