@extends('layouts.user_type.admin-app')
@section('content')

<div class="admin-card-header">
    <h4 class="card-title">User Business Details</h4>
</div>
    <form id="user_form">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>User ID</label>
                                    <input class="admin-form-control form-inline" placeholder="enter User ID" type="text" id="user_id" onkeyup="checkUserAvailable(this.value)" />
                                </div>
                            </div>
                            <input type="hidden" id="add_user_id" value="">
                            <div class="col-md-2 mt-4">
                                <div class="text-center">
                                   <button type="button" class="btn btn-success waves-effect waves-light" id="add_user" style="color: #fff;" disabled> Add </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="row justify-content-center">
    </div>
    <script>
        var base_url = '{{url('/')}}'
        var csrf_token = $('meta[name="csrf-token"]').attr('content');

        function loadUserBusinessData() {
            $.ajax({
                url: '{{ url('/1Rto5efWp86Z/user-business-data') }}',
                method: 'GET',
                success: function (response) {
                    if (response.data.length > 0) {                      
                        // Clear existing cards
                        $('.row.justify-content-center').empty();

                        $.each(response.data, function (index, user) {
                            var cardHtml = `
                                <div class="col-md-6">
                                    <div class="widget-stat admin-card">
                                        <div class="admin-card-header">
                                            <h4>Username : <span>${user.username}</span></h4>
                                            <button class="btn btn-outline-danger btn-sm float-end deleteCardBtn" data-id="${user.id}">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </div>
                                        <div class="admin-card-body">                
                                            <div class="media ai-icon">
                                                <div class="media-body">
                                                    <p>Yesterday BV</p>
                                                    <h4 id="totalUserYesterday">${user.yesterday_bv}</h4>
                                                </div>
                                                <div class="media-body">
                                                    <p>Today BV</p>
                                                    <h4 id="totalUserToday">${user.today_bv}</h4>
                                                </div>
                                                <div class="media-body">
                                                    <p>Total BV</p>
                                                    <h4 id="totalUserTotal">${user.total_bv}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                            $('.row.justify-content-center').append(cardHtml);
                        });

                        // Attach click event to new delete buttons
                        $('.deleteCardBtn').click(function () {
                            var userId = $(this).data('id');
                            Swal.fire({
                                title: "Are you sure?",
                                text: "You want to delete this User",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonText: "Yes!",
                                cancelButtonText: "Cancel",
                            }).then((result) => {
                                if (result.value) {
                                    var data = {
                                        user_id: userId,
                                    };

                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': csrf_token
                                        }
                                    });

                                    $.ajax({
                                        url: '{{url('/1Rto5efWp86Z/delete_users')}}',
                                        method: 'POST',
                                        data: data,
                                        success: (resp) => {
                                            if (resp.code === 200) {
                                                toastr.success(resp.message);
                                                // Reload user business data after successful deletion
                                                loadUserBusinessData();
                                                $("#add_user").prop('disabled', true);
                                            } else {
                                                toastr.error(resp.message);
                                            }
                                            $("#user_form").trigger("reset");
                                        },
                                        error: (err) => {
                                            toastr.error("An error occurred. Please try again.");
                                        }
                                    });
                                }
                            });
                        });
                    } else {
                        // Clear existing cards
                        $('.row.justify-content-center').empty();
                        console.log('No data available.');
                    }
                },
                error: function (err) {
                    console.error('Error fetching data:', err);
                }
            });
        }

        $("#add_user").click(function () {
            Swal.fire({
                title: "Are you sure?",
                text: "You want to Add this User",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes!",
                cancelButtonText: "Cancel",
            }).then((result) => {
                if (result.value) {
                    var data = {
                        user_id: $('#add_user_id').val(),
                    };

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': csrf_token
                        }
                    });

                    $.ajax({
                        url: '{{url('/1Rto5efWp86Z/add_users')}}',
                        method: 'POST',
                        data: data,
                        success: (resp) => {
                            if (resp.code === 200) {
                                toastr.success(resp.message);
                                $("#add_user").prop('disabled', true);
                                // Reload user business data after successful addition
                                loadUserBusinessData();
                            } else {
                                toastr.error(resp.message);
                            }
                            $("#user_form").trigger("reset");
                        },
                        error: (err) => {
                            toastr.error("An error occurred. Please try again.");
                        }
                    });
                }
            });
        });

        // Initial load of user business data
        loadUserBusinessData();


        function checkUserAvailable(username) {
            if (username != '') {
                var data = {
                    user_id: username
                };
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': csrf_token
                    }
                });
                $.ajax({
                    type: "POST",
                    url: '{{ url('/1Rto5efWp86Z/checkuserexist') }}', 
                    data: data,
                    dataType: "json",
                    success: (resp) => {
                        if (resp.code === 200) {
                            toastr.success(resp.message);
                            $('#add_user_id').val(resp.data.id);
                            $("#add_user").prop('disabled', false);
                        } else {
                            toastr.error(resp.message);
                            $('#add_user_id').val(" ");
                            $("#add_user").prop('disabled', true);
                        }
                    },
                    error: (err) => {
                        toastr.error(err)
                    }
                });
            }
        }
    </script>
@endsection
