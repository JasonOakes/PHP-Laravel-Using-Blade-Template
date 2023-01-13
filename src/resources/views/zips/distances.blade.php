 @if (count($results)) 
  <h1 style="text-align:center;"> Results</h1>
      <table class="table table-bordered table-hover">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Zip Code</th>
            <th scope="col">Latitude</th>
            <th scope="col">Longitude</th>
            <th scope="col">Miles From Previous Point</th>
            <th scope="col">Total Miles From Origin</th>            
          </tr>
        </thead>
         @foreach ($results as $result)
              @if ($result['Lat']==0)
                <tr class="alert-danger">
              @else
                <tr class="alert-success">
              @endif
                <td>{{ $result['Point'] }}    </td>              
                <td>{{ $result['Zip'] }}    </td>
                <td>{{ $result['Lat'] }}    </td>
                <td>{{ $result['Long'] }}    </td>  
                <td><b>{{$result['Distance'] }}</b> </td>
                <td><b>{{$result['CurrentDistance'] }} </b></td>                
              </tr>
          @endforeach
            </table>
@endif 