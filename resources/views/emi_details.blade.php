<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMI Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>


<body>

<div class="container mt-5">
    <h2 class="mb-4">EMI Details</h2>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Client ID</th>
                @if(count($emiDetails) > 0)
                    @foreach(array_keys((array)$emiDetails[0]) as $column)
                        @if($column != 'clientid')
                            <th>{{ $column }}</th>
                        @endif
                    @endforeach
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($emiDetails as $row)
            <tr>
                <td>{{ $row->clientid }}</td>
                @foreach((array)$row as $key => $value)
                    @if($key != 'clientid')
                        <td>{{ $value }}</td>
                    @endif
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
