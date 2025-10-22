@extends('layouts.user_type.admin-app')
@section('content')
<style>
#activeUser {
    height: auto !important;
}
.card-body {
    border-radius: 10px;
    margin-bottom: 15px;
}
p.mb-1 {
    font-size: 12px!important;
}
.dashboard-card {
    border-radius: 12px;
    transition: all 0.3s ease;
    color: white;
    padding: 15px;
    background: linear-gradient(135deg, #4facfe, #00f2fe); /* default */
}
.dashboard-card:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
}
.dashboard-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 55px;
    height: 55px;
    font-size: 1.6rem;
    border-radius: 8px;
    background-color: rgba(255,255,255,0.2);
}

/* Card background color variations */
.card-blue    { background: linear-gradient(135deg, #4facfe, #00f2fe); }
.card-orange  { background: linear-gradient(135deg, #ff7e5f, #feb47b); }
.card-green   { background: linear-gradient(135deg, #43cea2, #185a9d); }
.card-purple  { background: linear-gradient(135deg, #a18cd1, #fbc2eb); }
.card-pink    { background: linear-gradient(135deg, #ff758c, #ff7eb3); }
.card-yellow  { background: linear-gradient(135deg, #f7971e, #ffd200); }
.card-red     { background: linear-gradient(135deg, #f85032, #e73827); }
.card-teal    { background: linear-gradient(135deg, #11998e, #38ef7d); }
.card-active    { background: linear-gradient(135deg, #30ae00, #16d18e); }
</style>
    <div class="row justify-content-center">
    
    @if(Auth::user()->admin_access == 2) 
        <?php
            $css = "d-none";
        ?>
    @else
        <?php
            $css = "";
        ?>
    @endif
    <div class="col-lg-12 {{ $css }}">
        <div class="card">
            <div class="card-body">
                <form id="searchForm">
                    <div class="row align-items-end g-3">
                        <!-- From Date -->
                        <div class="col-md-3">
                            <label for="frm_date" class="form-label">From Date</label>
                            <input type="date" class="admin-form-control" name="frm_date" id="frm_date" placeholder="From Date">
                        </div>

                        <!-- To Date -->
                        <div class="col-md-3">
                            <label for="to_date" class="form-label">To Date</label>
                            <input type="date" class="admin-form-control" name="to_date" id="to_date" placeholder="To Date">
                        </div>

                        <!-- Search Button -->
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary w-100" id="onSearchClick">
                                Search
                            </button>
                        </div>

                        <!-- All Button -->
                        <div class="col-md-2">
                            <button type="button" class="btn btn-dark w-100" id="onResetClick">
                                All
                            </button>
                        </div>

                        <!-- Today Button -->
                        <div class="col-md-2">
                            <button type="button" class="btn btn-warning w-100" id="onTodayClick">
                                Today’s
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row g-3 mb-5">

    <!-- All Users -->
    <div class="col-md-3 col-sm-6">
        <a href="{{url('1Rto5efWp86Z/user/manage-user-account')}}" class="text-decoration-none">
            <div class="card dashboard-card p-3 card-blue shadow-sm">
                <div class="dashboard-icon bg-warning text-white me-3">
                  <i class="fa-solid fa-user-tie"></i>
                </div>
                <div>
                    <p class="mb-1 fw-bold">Total Registration's</p>
                    <h4 class="mb-0" id="totalUser">0</h4>
                </div>
            </div>
        </a>
    </div>

    <!-- Unblock Users -->
    <div class="col-md-3 col-sm-6">
        <a href="{{url('1Rto5efWp86Z/user/manage-user-account')}}" class="text-decoration-none">
            <div class="card dashboard-card p-3 shadow-sm card-purple">
                <div class="dashboard-icon bg-warning text-white me-3">
                    <i class="fa-solid fa-user-check"></i>
                </div>
                <div>
                    <p class="mb-1 fw-bold">Unblock Id</p>
                    <h4 class="mb-0" id="unblockUser">0</h4>
                </div>
            </div>
        </a>
    </div>

    <!-- Block Users -->
    <div class="col-md-3 col-sm-6">
        <a href="{{url('1Rto5efWp86Z/user/block-users-report')}}" class="text-decoration-none">
            <div class="card dashboard-card p-3 shadow-sm card-red">
                <div class="dashboard-icon bg-danger text-white me-3">
                    <i class="fa-solid fa-user-slash"></i>
                </div>
                <div>
                    <p class="mb-1 fw-bold">Blocked Id</p>
                    <h4 class="mb-0" id="blockUser">0</h4>
                </div>
            </div>
        </a>
    </div>

    <!-- Active Users -->
    <div class="col-md-3 col-sm-6">
        <a href="{{url('1Rto5efWp86Z/user/manage-user-account')}}" class="text-decoration-none">
            <div class="card dashboard-card p-3 shadow-sm card-active">
                <div class="dashboard-icon bg-success text-white me-3">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div>
                    <p class="mb-1 fw-bold">Active Id </p>
                    <h4 class="mb-0" id="activeUser">0</h4>
                </div>
            </div>
        </a>
    </div>

    <!-- Inactive User -->
    <div class="col-md-3 col-sm-6">
        <a href="{{url('1Rto5efWp86Z/user/block-users-report')}}" class="text-decoration-none">
            <div class="card dashboard-card p-3 shadow-sm card-yellow">
                <div class="dashboard-icon bg-secondary text-white me-3">
                    <i class="fa-solid fa-user-clock"></i>
                </div>
                <div>
                    <p class="mb-1 fw-bold">Inactive Id</p>
                    <h4 class="mb-0" id="inActiveUser">0</h4>
                </div>
            </div>
        </a>
    </div>

    <!-- Active Users -->
    <div class="col-md-3 col-sm-6">
        <a href="{{url('1Rto5efWp86Z/top-up/top-up-report')}}" class="text-decoration-none">
            <div class="card dashboard-card p-3 shadow-sm card-active">
                <div class="dashboard-icon bg-success text-white me-3">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div>
                    <p class="mb-1 fw-bold">Total Install Station</p>
                    <h4 class="mb-0" id="total_topup_count">0</h4>
                </div>
            </div>
        </a>
    </div>

    <!-- Pending Net Withdrawal -->
    <div class="col-md-3 col-sm-6">
        <a href="{{url('1Rto5efWp86Z/top-up/top-up-report')}}" class="text-decoration-none">
            <div class="card dashboard-card p-3 shadow-sm card-pink">
                <div class="dashboard-icon bg-orange text-white me-3">
                    <i class="fa-solid fa-money-bill-transfer"></i>
                </div>
                <div>
                    <p class="mb-1 fw-bold">Install Station Amount</p>
                    <h4 class="mb-0" id="totalTopup">0</h4>
                </div>
            </div>
        </a>
    </div>

    <!-- Direct Income -->
    <div class="col-md-3 col-sm-6">
        <a href="{{url('1Rto5efWp86Z/e-wallet/roi-income')}}" class="text-decoration-none">
            <div class="card dashboard-card p-3 shadow-sm card-teal">
                <div class="dashboard-icon bg-green text-white me-3">
                    <i class="fa-solid fa-money-bill"></i>
                </div>
                <div>
                    <p class="mb-1 fw-bold">Total PRI</p>
                    <h4 class="mb-0" id="ROIIncome">0</h4>
                </div>
            </div>
        </a>
    </div>

     <!-- Direct Income -->
    <div class="col-md-3 col-sm-6">
        <a href="{{url('1Rto5efWp86Z/e-wallet/rank-report')}}" class="text-decoration-none">
            <div class="card dashboard-card p-3 shadow-sm card-purple">
                <div class="dashboard-icon bg-green text-white me-3">
                    <i class="fa-solid fa-money-bill"></i>
                </div>
                <div>
                    <p class="mb-1 fw-bold">Rank Income </p>
                    <h4 class="mb-0" id="matchingIncome">0</h4>
                </div>
            </div>
        </a>
    </div>

    <!-- Direct Income -->
    <div class="col-md-3 col-sm-6">
        <a href="{{url('1Rto5efWp86Z/e-wallet/direct-income')}}" class="text-decoration-none">
            <div class="card dashboard-card p-3 shadow-sm card-teal">
                <div class="dashboard-icon bg-green text-white me-3">
                    <i class="fa-solid fa-money-bill"></i>
                </div>
                <div>
                    <p class="mb-1 fw-bold">Direct Income</p>
                    <h4 class="mb-0" id="directIncome">0</h4>
                </div>
            </div>
        </a>
    </div>

    <!-- Binary Income -->
    <div class="col-md-3 col-sm-6">
        <a href="{{url('1Rto5efWp86Z/e-wallet/binary-income')}}" class="text-decoration-none">
            <div class="card dashboard-card p-3 shadow-sm card-purple">
                <div class="dashboard-icon bg-purple text-white me-3">
                    <i class="fa-solid fa-diagram-project"></i>
                </div>
                <div>
                    <p class="mb-1 fw-bold">Total Matching Income</p>
                    <h4 class="mb-0" id="binaryIncome">0</h4>
                </div>
            </div>
        </a>
    </div>

    <!-- Fund Added By Admin -->
    <div class="col-md-3 col-sm-6">
        <a href="{{url('1Rto5efWp86Z/admin-add-fundreport')}}" class="text-decoration-none">
            <div class="card dashboard-card p-3 shadow-sm card">
                <div class="dashboard-icon bg-pink text-white me-3">
                    <i class="fa-solid fa-sack-dollar"></i>
                </div>
                <div>
                    <p class="mb-1 fw-bold">Total Add Fund</p>
                    <h4 class="mb-0" id="totalFundAdded">0</h4>
                </div>
            </div>
        </a>
    </div>

    <!-- Total Coinpayment Deposit -->
    <div class="col-md-3 col-sm-6">
        <a href="{{url('1Rto5efWp86Z/coinpayment/confirm-address-transaction')}}" class="text-decoration-none">
            <div class="card dashboard-card p-3 shadow-sm card-yellow">
                <div class="dashboard-icon bg-red text-white me-3">
                    <i class="fa-solid fa-hand-holding-dollar"></i>
                </div>
                <div>
                    <p class="mb-1 fw-bold">Total Deposit Fund</p>
                    <h4 class="mb-0" id="totalconfirmedCoinPayment">0</h4>
                </div>
            </div>
        </a>
    </div>

    <!-- Pending Net Withdrawal -->
    <div class="col-md-3 col-sm-6">
        <a href="{{url('1Rto5efWp86Z/sell/sell-request')}}" class="text-decoration-none">
            <div class="card dashboard-card p-3 shadow-sm card-pink">
                <div class="dashboard-icon bg-orange text-white me-3">
                    <i class="fa-solid fa-money-bill-transfer"></i>
                </div>
                <div>
                    <p class="mb-1 fw-bold">Pending Net Withdrawal</p>
                    <h4 class="mb-0" id="pendingWithdrawls">0</h4>
                </div>
            </div>
        </a>
    </div>

    <!-- Total Withdrawal -->
    <div class="col-md-3 col-sm-6">
        <a href="{{url('1Rto5efWp86Z/sell/verified-sell')}}" class="text-decoration-none">
            <div class="card dashboard-card p-3 shadow-sm card-red">
                <div class="dashboard-icon bg-gray text-white me-3">
                    <i class="fa-solid fa-arrow-down"></i>
                </div>
                <div>
                    <p class="mb-1 fw-bold">Total Withdrawal Paid</p>
                    <h4 class="mb-0" id="confirmedWithdrawl">0</h4>
                </div>
            </div>
        </a>
    </div>
</div>

    <script>
        var base_url = '{{url('/')}}'
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var record_type = '';
        $(document).ready(function() {
            getDashboardData()
        });
        function getDashboardData() {
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
           var frm_date = ($('#frm_date').val() !== '') ? moment($('#frm_date').val()).format('DD-MM-YYYY') : '';
           var to_date = ($('#to_date').val() !== '') ? moment($('#to_date').val()).format('DD-MM-YYYY') : '';
            var id = $('#hiddenUserId').val();
            var user_id = $('#user_id').val();

            var data = {
               frm_date: frm_date,
               to_date: to_date,
               id: id,
               user_id: user_id,
               record_type: record_type,
            };
            $.ajax({
                type: "POST",
                url: "{{url('/1Rto5efWp86Z/dashboard-data')}}",
                data: data,
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                success: function(response){
                    $('#totalUser').text(response.data.total_users);
                    $('#unblockUser').text(response.data.total_unblock_users);
                    $('#blockUser').text(response.data.total_block_users);
                    $('#activeUser').text(response.data.total_active_user);
                    $('#inActiveUser').text(response.data.total_inactive_user);
                    $('#pendingWithdrawls').text(response.data.total_withdraw_pending);
                    $('#confirmedWithdrawl').text(response.data.total_withdraw_confirm);
                    $('#totalconfirmedCoinPayment').text(response.data.totalconfirmedCoinPayment);
                    $('#directIncome').text(response.data.total_direct_income);
                    $('#binaryIncome').text(response.data.total_binary_income);
                    $('#totalFundAdded').text(response.data.total_fund_added);
                    $('#ROIIncome').text(response.data.total_roi_income);
                    $('#totalTopup').text(response.data.total_topup_amount);
                    $('#total_topup_count').text(response.data.total_topup_count);
                    $('#matchingIncome').text(response.data.total_matching_income);
                }
            });
        }

        $("#onSearchClick").click(function() {
            toastr.remove();
            var startDate = $("#frm_date").val();
            var endDate = $("#to_date").val();
            if (startDate && endDate){
                if (endDate < startDate) {
                    toastr.error("To date should be greater than from date");
                    return false;
                }
                record_type = '';
                getDashboardData()
                toastr.success("Searching Date Wise Record...");
            }else{
                return toastr.error("Please select valid date");
            }
        });

        $("#onResetClick").click(function() {
            toastr.remove();
            $("#searchForm").trigger("reset");
            var startDate = $("#frm_date").val("");
            var endDate = $("#to_date").val("");
            var user_id = $("#user_id").val("");
            record_type = '';
            getDashboardData()
            toastr.success("Searching All Record...");
        });

        $("#onTodayClick").click(function() {
            toastr.remove();
            $("#searchForm").trigger("reset");
            var startDate = $("#frm_date").val("");
            var endDate = $("#to_date").val("");
            var user_id = $("#user_id").val("");
            record_type = 'today';
            getDashboardData()
            toastr.success("Searching Today’s Record...");
        });

    </script>
@endsection
