@extends('layouts.user_type.admin-app')
@section('content')
    <style>

        .bulkBtn {
         display: block;
         padding: 10px 20px;
         float: right;
         background-color: #4CAF50;
         color: #fff;
         border: none;
         border-radius: 5px;
         cursor: pointer;
        }

        button:hover {
         background-color: #45a049;
        }
    </style>
    <div class="row">
        <div class="col-6 mx-auto">
            <div class="admin-card">
                <div class="admin-card-header">
                  <h4 class="card-title">Send Bulk SMS</h4>
                </div>
                <div class="admin-card-body">
                    <form class="row g-3" action="{{ url('/1Rto5efWp86Z/sendbulksms') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12">
                            <label for="users">To Users:</label>
                            <div class="input-group">
                                <select name="users[]" id="users" class="admin-form-control" multiple required>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <label>Enter Message</label>
                            <div class="input-group">
                                <textarea class="admin-form-control" id="message" name="message" rows="5" cols="50"></textarea>
                            </div>
                        </div>

                        <div class="col-12">
                            <label>Attach Image</label>
                            <div class="input-group">
                                <input type="file" class="admin-form-control" name="attached_file" id="attached_file">
                            </div>
                        </div>

                        <div class="col-12">
                            <label>Enter Image Caption</label>
                            <div class="input-group">
                                <input class="admin-form-control" id="caption" name="caption" maxlength="100"></input>
                            </div>
                        </div>

                        <div class="col-12">
                            <button class="btn signin bulkBtn btn-primary" type="submit">Send SMS</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>     
    <script>
      // '{{ url('1Rto5efWp86Z/get-users') }}',   
 
    $(document).ready(function() {
        $('#users').select2({
            placeholder: 'Select users',
            allowClear: true,
            closeOnSelect: false,
            tags: false,
            ajax: {
                url: '{{ url('1Rto5efWp86Z/get-users') }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        term: params.term,
                        per_page: 10,
                        page: params.page || 1,
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;

                    return {
                        results: data.results.map(function(user) {
                            return { id: user.user_id, text: user.user_id };
                        }),
                        pagination: {
                            more: data.pagination.more,
                        },
                    };
                },
                cache: true,
            },
            escapeMarkup: function (markup) {
                return markup;
            }
        });

        // Infinite scroll functionality
        $('#users').on('select2:scroll', function(e) {
            if (e.params.data.pagination.more) {
                // Load more results
                var page = e.params.data.pagination.page + 1;
                $('#users').select2('trigger', 'query', { page: page });
            }
        });
    });
</script>
@endsection
