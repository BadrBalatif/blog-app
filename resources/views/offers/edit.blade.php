<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">


        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
      <li class="nav-item active">
        <a class="nav-link" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"> {{ $properties['native'] }} <span class="sr-only">(current)</span></a>
      </li>
      @endforeach
  </div>
</nav>

        <div class="flex-center position-ref full-height">
    
            <div class="content">
                <div class="title m-b-md">
                {{__('messages.Edit your Offer')}}
                </div>

                @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}
                </div>
                @endif

                <form method="POST" action="{{route('offers.update', $offer -> id)}}">
                    @csrf
                        <div class="form-group">
                            <label>{{__('messages.Offer Name ar')}}</label>
                            <input type="text" class="form-control" name="name_ar" value="{{$offer -> name_ar}}">
                        @error('name_ar')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror   
                        </div>

                        <div class="form-group">
                            <label>{{__('messages.Offer Name en')}}</label>
                            <input type="text" class="form-control" name="name_en" value="{{$offer -> name_en}}">
                        @error('name_en')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror   
                        </div>

                        <div class="form-group">
                            <label>{{__('messages.Offer Price')}}</label>
                            <input type="text" class="form-control" name="price" value="{{$offer -> price}}">
                        @error('price')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                        </div>

                        <div class="form-group">
                            <label>{{__('messages.Offer Details ar')}}</label>
                            <input type="text" class="form-control" name="details_ar" value="{{$offer -> details_ar}}">
                        @error('details_ar')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                        </div>

                        <div class="form-group">
                            <label>{{__('messages.Offer Details en')}}</label>
                            <input type="text" class="form-control" name="details_en" value="{{$offer -> details_en}}">
                        @error('details_en')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary">update</button>
                </form>

            </div>
        </div>
    </body>
</html>
