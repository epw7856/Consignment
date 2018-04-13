@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12">
        
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
        </div><span style="display:block; height: 20px;"></span>

        <form class="horizontal" method="POST" action="{{ url('/edit', array($itemid->itemid)) }}">
        {{csrf_field()}}
          <fieldset>
            <div class="card-header"><h2>Update Inventory Item</h2><span style="display:block; height: 20px;"></span>
            @if(count($errors) > 0)
              @foreach($errors->all() as $error)
                <div class="alert alert-danger">
                  {{$error}}
                </div>
              @endforeach
            @endif

            
                    <div class="row">
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="customerID1">Cust ID</label>
                          <input type="text" name="custid" class="form-control" id="customerID1" value="<?php echo $itemid->custid; ?>" placeholder="Cust ID">           
                        </div>
                      </div>

                      <div class="col-md-1">
                        <div class="form-group">
                          <label for="sku1">SKU</label>
                          <input type="text" name="sku" class="form-control" id="sku1" value="<?php echo $itemid->sku; ?>" placeholder="SKU">           
                        </div>
                      </div>

                      <div class="col-md-1">
                        <div class="form-group">
                          <label for="loc1">Loc</label>
                          <input type="text" name="loc" class="form-control" id="loc1" value="<?php echo $itemid->loc; ?>" placeholder="Loc">
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="itemid1">Item ID</label>
                          <input type="text" name="itemid" class="form-control" id="itemid1" value="<?php echo $itemid->itemid; ?>" placeholder="Item ID" disabled>
                        </div>
                      </div>
                  </div>

                    <div class="row">
                      <div class="col-md-8">
                        <div class="form-group">
                          <label for="title1">Item Title</label>
                          <input type="text" name="title" class="form-control" id="title1" value="<?php echo $itemid->title; ?>" placeholder="Item Title">
                        </div>
                      </div>

                    </div>

                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="received1">Date Received</label>
                          <input type="text" name="received" class="form-control" id="received1" value="@php echo App\Http\Controllers\UserController::dtform($itemid->received, "Y-m-d", "-", "/");@endphp" placeholder="Date Received">
                        </div>
                      </div>

                      <div class="col-md-1">
                        <div class="form-group">
                          <label for="qty1">Qty</label>
                          <input type="text" name="qty" class="form-control" id="qty1" value="<?php echo $itemid->qty; ?>" placeholder="Qty">      
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="platform1">Platform</label>
                          <input type="text" name="platform" class="form-control" id="platform1" value="<?php echo $itemid->platform; ?>" placeholder="Platform">
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="status1">Status</label><br>
                          
                          <div class="row">
                            <input type="radio" name="status" id="r2" value="LISTED" <?php echo ($itemid->status=='LISTED')?'checked':'' ?> onclick="showSold()"/>LISTED
                          </div>
                          <div class="row">
                            <input type="radio" name="status" id="r3" value="BUNDLE" <?php echo ($itemid->status=='BUNDLE')?'checked':'' ?> onclick="showSold()"/>BUNDLE
                          </div>
                          <div class="row">
                            <input type="radio" name="status" id="r1" value="SOLD" <?php echo ($itemid->status=='SOLD')?'checked':'' ?> onclick="showSold()"/>SOLD
                          </div></span>


                        </div>
                      </div>
                    </div>

                    <span style="display:block; height:30px;"></span>

                   
                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="listed1">Date Listed</label>
                              <input type="text" name="listed" class="form-control" id="listed1" value="<?php if (property_exists($itemid, 'listed')){ echo App\Http\Controllers\UserController::dtform($itemid->listed, "Y-m-d", "-", "/");}  
                              ?>" placeholder="Date Listed" disabled>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="sold1">Date Sold</label>
                              <input type="text" name="sold" class="form-control" id="sold1" value="<?php if (property_exists($itemid, 'sold')){echo App\Http\Controllers\UserController::dtform($itemid->sold, "Y-m-d", "-", "/");}?>" placeholder="Date Sold" disabled>
                            </div>
                          </div>

                          <div class="col-md-2">
                            <div class="form-group">
                              <label for="salesid1">Sales ID</label>
                              <input type="text" name="salesid" class="form-control" id="salesid1" value="<?php if (property_exists($itemid, 'salesid')){ echo $itemid->salesid;}?>" placeholder="Sales ID" disabled>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-2">
                            <div class="form-group">
                              <label for="saleamt1">Total Sale Amount</label>
                              <input type="text" name="saleamt" class="form-control" id="saleamt1" value="<?php if (property_exists($itemid, 'saleamt')){ echo $itemid->saleamt;}?>" placeholder="Sale Amt" disabled>
                            </div>
                          </div>

                          <div class="col-md-2">
                            <div class="form-group">
                              <label for="costs1">Costs</label>
                              <input type="text" name="costs" class="form-control" id="costs1" value="<?php if (property_exists($itemid, 'costs')){ echo $itemid->costs;}?>" placeholder="Costs" disabled>
                            </div>
                          </div>

                          <div class="col-md-2">
                            <div class="form-group">
                              <label for="pct1">Consignment Percent</label>
                              <input type="text" name="pct" class="form-control" id="pct1" value="<?php if (property_exists($itemid, 'fee')){ echo $itemid->fee;}?>" placeholder="%" disabled>
                            </div>
                          </div>
                        </div>     

            </fieldset>
            <span style="display:block; height: 10px;"></span>
            *Note: Item ID will be updated automatically
            <span style="display:block; height:20px;"></span>

            <button type="submit" class="btn col-md-1 btn-primary">Update</button>
            <a href="{{ url('/') }}" class="btn col-md-1 btn-secondary">Back</a>

          </fieldset>
        </form>
      </div>
    </div>
  </div>
<script src="{{ url('js/showSold.js') }}"></script>
@endsection