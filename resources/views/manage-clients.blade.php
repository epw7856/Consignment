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
        </div><span style="display:block; height: 25px;"></span>

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
                    
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="username1">Username</label>
                          <input type="text" name="username" class="form-control" id="username1" placeholder="Username">           
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="custid1">Customer ID</label>
                          <input type="text" name="custid" class="form-control" id="custid1" placeholder="Customer ID">
                        </div>
                      </div>
          </div>
        </div>

            <span style="display:block; height:10px;"></span>

            <button type="submit" class="btn col-md-1 btn-primary">Update</button>
            <a href="{{ url()->previous() }}" class="btn col-md-1 btn-secondary">Back</a>

            <span style="display:block; height:50px;"></span>


                <div class="card-header border"><h2>Registered Users</h2></div>
              
                  <div class="span3 border">
                            <table class="table table-fixed table-striped">
                              <thead>
                                <tr>
                                 @if(count($client)>0)
                                  <th scope="col">Name</th>
                                  <th scope="col">Username</th>
                                  <th scope="col">Customer ID</th>
                                </tr>
                              </thead>
                              <tbody>
                               
                                    @foreach($client->all() as $client)
                                  <tr>
                                  <td>{{ $client->name }}</td>
                                  <td>{{ $client->username }}</td>
                                  <td>{{ $client->custid }}</td>
                                  </tr> 
                                    @endforeach
                                @else
                                    No Registered Users!
                                @endif
                              </tbody>
                            </table><span style="display:block; height: 50px;"></span>
                  </div>
                </div></div>

          </fieldset>
        </form>
      </div>
    </div>
  </div>

<script src="{{ url('js/showClient.js') }}"></script>
@endsection