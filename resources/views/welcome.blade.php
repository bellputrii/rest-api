    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
    </head>
    <body>
        
    </body>
    </html>
    
    <head>
        <style>
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .alert-danger {
            background-color: #f2dede;
            border-color: #ebccd1;
            color: #a94442;
        }
        .alert-success {
            color: #155724; 
            background-color: #d4edda; 
            border-color: #c3e6cb;
        }
        </style>
    </head>
    <body class="antialiased">
        <div class="mt-16">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{$message}}
            </div>
            @elseif ($message = Session::get('error'))
            <div class="alert alert-danger" role="alert">
                {{$message}}
            </div>
            @endif
        </div>
