<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APT</title>
    <link href="{{ asset('css/style.css')}}" rel="stylesheet">
</head>
<body>
    <div class="logo">
        <img src="{{ asset('img/ampito-logo.png') }}" alt="Company Logo" class="logo-img">
    </div>

    <div class="query-form">
        <h1 style="color:black">My Quotations</h1>

        <form action="{{ route('search') }}" method="POST">
            @csrf
            <input type="text" name="query" class="query-input" placeholder="Search For Price">
            <button type="submit" class="query-submit">Search</button>
        </form>
    </div>

    <div class="results">
        <h2>Search Results</h2>
        @if(isset($data) && count($data) > 0)
            <ul>
                @foreach($data as $result)
                    <li>{{ $result }}</li>
                @endforeach
            </ul>
        @else
            <p>No search results found.</p>
        @endif
    </div>

    <div class="errors">
        @if(session('error'))
            <div class="error-message">
                {{ session('error') }}
            </div>
        @endif
    </div>

</body>
</html>
