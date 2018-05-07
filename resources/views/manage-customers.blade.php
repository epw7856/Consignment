@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-8">

        <span style="display:block; height: 25px;"></span>

        <form class="horizontal" method="POST" action="{{ route('client.data') }}">
        {{csrf_field()}}
          <fieldset>
            <div class="card-header"><h2>Update Customer ID</h2><span style="display:block; height: 20px;"></span>
            @if(count($errors) > 0)
              @foreach($errors->all() as $error)
                <div class="alert alert-danger">
                  {{$error}}
                </div>
              @endforeach
            @endif
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

            <div class="row">
                    
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="name1">Name</label>
                          <input type="text" name="name" class="form-control" id="name1" value="<?php if (isset($pick)){ echo $pick->name;}?>" placeholder="Name">           
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="username1">Username</label>
                          <input type="text" name="username" class="form-control" id="username1" value="<?php if (isset($pick)){ echo $pick->username;}?>" placeholder="Username">           
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="custid1">Customer ID</label>
                          <input type="text" name="custid" class="form-control" id="custid1" value="<?php if (isset($pick)){ echo $pick->custid;}?>" placeholder="Customer ID">
                        </div>
                      </div>
          </div>
        </div>

            <span style="display:block; height:10px;"></span>

            <button type="submit" class="btn col-md-2 btn-primary">Update</button>
            <a href="{{ url()->previous() }}" class="btn col-md-2 btn-secondary">Back</a>
            </div>

                
                <div class="col-md-8"><span style="display:block; height: 50px;"></span>
                <div class="card-header border"><h2>Registered Users</h2></div>
                            
                            <table class="table table-fixed table-striped specialTable">
                              <col width="40%">
                              <col width="20%">
                              <col width="20%">
                              <col width="20%">

                              <thead>
                                <tr>
                                 @if(count($client)>0)
                                  <th><div class="sorting"><a href="#" id="link" data-column="0" data-direction="0">Name</a></div></th>
                                  <th><div class="sorting"><a href="#" id="link" data-column="1" data-direction="0">Username</a></div></th>
                                  <th><div class="sorting"><a href="#" id="link" data-column="2" data-direction="0">Customer ID</a></div></th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                            </table>

                            <div class="span4 border">
                            <table id="table1" class="table table-fixed table-striped tablesorter">
                              <tbody>
                                <col width="40%">
                                <col width="20%">
                                <col width="20%">
                                <col width="20%">
                                    @foreach($client->all() as $client)
                                  <tr>
                                  <td>{{ $client->name }}</td>
                                  <td>{{ $client->username }}</td>
                                  <td>{{ $client->custid }}</td>
                                  <td>
                                    <a href='{{ url("/manage-customers/{$client->username}") }}' class="label label-success">Update |</a>
                                    <a href='{{ url("/delete-customers/{$client->username}") }}' class="label label-danger">Delete</a>
                                  </td>
                                  </tr> 
                                    @endforeach
                                @else
                                    No Registered Users!
                                @endif
                                
                              </tbody>
                            </table></div><span style="display:block; height: 50px;"></span>
                  </div>
                </div></div>

          </fieldset>
        </form>
      </div>
    </div>
  </div>

<script src="{{ url('js/sortCustomerTable.js') }}"></script>
@endsection