<!DOCTYPE html>
<html>

<head>
    <title>Book Search</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        body{
            background: #ddd;
        }
        .box-sec {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-gap: 20px 20px;
            padding: 20px;
            height: 500px;
            overflow: auto;
        }

        .single-box {
            Padding: 20px;
            background: #fff;
        }
        .search{
            width: 100%;
            padding: 10px;
        }
        .wrapper{
            background: #ddd;
            width: 1170px;
            max-width: 1170px;
            margin: auto;
            margin-top: 20px;
        }
        .search-key{
            margin-bottom: 20px;
            padding-left: 20px;
            padding-right: 20px;
        }
        .data-table-class{
            background: white;
            padding: 14px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="search-key">
            <form action="#" id="filterData">
                <div class="row">
                    <div class="col-md-3 form-group">
                        <input type="text" class="search form-control" name="searchKey" id="searchKey" placeholder="Search Book Name" style="width: 100%; height:100%;">
                    </div>
                    <div class="col-md-3 form-group">
                        <select class="for-control" name="category" id="category" style="width: 100%; height:100%;">
                            <option value="">Select Category</option>
                            @foreach ($categories as $cat)
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <select class="for-control select2" name="tag[]" id="tag" style="width: 100%; height:100%;" multiple="multiple">
                            <option value="">Select Tag</option>
                            @foreach ($tags as $tag)
                                <option value="{{$tag->book_id}}">{{$tag->tag}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <button class="btn btn-primary" id="filterBtn" onclick="getData();">Filter</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="data-table-class">
            <table class="table table-bordered data-table" width="100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Book Name</th>
                        <th>Category</th>
                        <th>Tag</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        </div>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $( document ).ready(function() {
            getData();
        })

        function getData()
        {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                bDestroy: true,
                ajax: {
                      url: '{{route('get-book-search')}}',
                      type: 'GET',
                      data: function (d) {
                          d.searchKey = $('#searchKey').val();
                          d.category= $('#category').val();
                          d.tag = $('#tag').val();
                      }
                  },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'book-name', name: 'book-name'},
                    {data: 'category', name: 'category'},
                    {data: 'tag', name: 'tag'},
                    {data: 'status', name: 'status'},
                ]
            });
        }

    </script>
</body>

</html>
