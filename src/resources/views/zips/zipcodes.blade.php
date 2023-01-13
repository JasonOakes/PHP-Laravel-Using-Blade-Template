<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PHP-Laravel-Using-Blade-Template</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    </head>
    <body >
    <h1 style="text-align:center;">ZipCode Distances Using The Haversine Formula</h1>   
    <br />
    <x-form method="GET" action="/api/distances" >
    <div style="width:55%; float:inline-center; margin:auto;">
        {{ csrf_field() }} 
          <div id="zipCodeFormContainer" class="form-group">
            <div>
              <x-label for="Origin Zip Code" />
            </div><div>
            <input class="form-control" id="originzipcodeid" placeholder="US or Canadian" name="originzipcode" type="text" maxlength="7" value="{{ $originzipcode ?? ''}}" required/>
              </div>
          </div>

          <div class="form-group" id="dest" >
              <div>
                <x-label for="Destination Zip Code(s)" />
              </div>
              <div>
                <input class="form-control" id="destinationzipcodeid" name="destinationzipcode" placeholder="Comma Seperated" type="text" value="{{ $destinationzipcode ?? ''}}" required />
              </div>
          </div>
          <div style="text-align:center;">
              <div class="form-group">
                  <input class="btn btn-default" type="submit" value="Get Distances" />
                  <input class="btn btn-default"  id="clear" value="Clear Results & Form" />
              </div>
          </div>
        </x-form>
    </div>
          <!-- Error Section -->
        @if (count($errors))
        <div class="alert alert-danger" style="margin:auto;width:60%;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error ?? '' }}</li>
                @endforeach
            </ul>
        </div>
      @endif     
      <!-- Results Section -->
        @php
          if (!isset($results))
          {
            $results = [];
          }
        @endphp
          <div id="results" style="margin:auto;width:95%;">
           @include('zips.distances',['results' => $results ])
        </div>
    
    <script type="text/javascript">
        //Add Remove Action
        $("#clear").click(function(){
          $("#results").remove();
          $("#originzipcodeid").val('');
          $("#destinationzipcodeid").val('');
        });  

    </script>

    </body>
</html>
