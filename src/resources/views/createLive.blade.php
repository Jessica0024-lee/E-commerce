<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Promote New Live Streaming</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
</head>

<body>

    <div class="bg-dark py-3">
        <div class="container">
            <div class="h4 text-black">Ecommerce</div>
        </div>
    </div>

    <div class="container ">
        <div class="d-flex justify-content-between py-3">
            <div class="h4">Announcement</div>
            <div>
                <a href="{{ route('products.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>

        <form action="{{ route('liveStream.save') }}" method="POST">
            @csrf
            <div class="card border-0 shadow-lg">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label"> Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="desc" class="form-label">Description</label>
                        <input type="text" class="form-control" id="desv" name="desc" required>
                    </div>
                    <div class="mb-3">
                        <label for="embed_link" class="form-label">Link</label>
                        <input type="text" class="form-control" id="embed_link" name="embed_link" >
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Save </button>
        </form>
    </div>

</body>

</html>
