@extends('layouts.user_type.auth-app')

@section('content')
 <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Strucutre Pull Report</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('svg/icon-sprite.svg#stroke-home')}}"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Withdrawal</li>
                    <li class="breadcrumb-item active"> Strucutre Pull Report</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
    <div class="row">
      <div class="col-xl-12">
        {{-- optional filters (kept hidden by your original d-none) --}}
        <div class="card custom-card">
          <div class="card-body">
            <form id="searchForm" class="d-none">
              <div class="row align-items-center">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>From Date</label>
                    <input type="date" class="form-control" name="frm_date" id="frm_date" />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>To Date</label>
                    <input type="date" class="form-control" name="to_date" id="to_date" />
                  </div>
                </div>
                <div class="col-md-3 mt-lg-4">
                  <div class="mt-1 searchFormButwrap">
                    <button type="button" id="onSearchClick" class="btn btn-success">Search</button>
                    <button type="button" id="onResetClick" class="btn btn-warning">Reset</button>
                  </div>
                </div>
              </div>
            </form>
            <br><br>
            <div class="d-flex gap-2 mb-3">
                <button id="btnWorking" class="btn btn-primary">Pull Downline Working Income</button>
                <button id="btnRoi" class="btn btn-secondary">Pull Downline ROI Income</button>
            </div>
            <pre id="output" class="p-3 bg-dark border rounded d-none" style="min-height:100px"></pre>
          </div>
        </div>

        <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
              <table id="withdrawals-income-report" class="table table-bordered text-nowrap w-100">
                <thead>
                  <tr>
                    <th><div class="d-flex align-items-center"><span class="icon-calendar me-1 fs-5s"></span>No.</div></th>
                    <th><div class="d-flex align-items-center"><span class="icon-calendar me-1 fs-5s"></span>Station ID</div></th>
                    <th><div class="d-flex align-items-center"><span class="icon-calendar me-1 fs-5s"></span>Working Wallet Balance</div></th>
                    <th><div class="d-flex align-items-center"><span class="icon-calendar me-1 fs-5s"></span>ROI Wallet Balance</div></th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="odd">
                    <td valign="top" colspan="10" class="dataTables_empty">
                      Data not available currently, click on the below button to Activate your account and start earning.
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- JS/CSS --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="{{ asset('js/toastr.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
  var csrf_token = '{{ csrf_token() }}';

  $(function() {
    let rowIndexStart = 1;

    const reportsTable = $("#withdrawals-income-report").DataTable({
      responsive: true,
      lengthMenu: [[10, 50, 100], [10, 50, 100]],
      serverSide: true,
      processing: true,
      ordering: false,
      {{-- dom: "lrtip", --}}
      language: { emptyTable: "Nothing here yet. Stay tuned!" },
      ajax: {
        url: '{{ url("structure-income") }}',   
        type: "POST",
        headers: { 'X-CSRF-TOKEN': csrf_token },
        data: function (d) {
          rowIndexStart = d.start + 1;
          d.frm_date = $("#frm_date").val() || '';
          d.to_date  = $("#to_date").val() || '';
          d.type     = 2;
          return d;
        },
        dataSrc: function (json) {
          if (json && json.code === 200 && json.data) {
            json.recordsFiltered = json.data.recordsFiltered ?? 0;
            json.recordsTotal    = json.data.recordsTotal ?? 0;
            return json.data.records || [];
          }
          if (json && (json.code === 401 || json.code === 403)) {
            window.location.href = '{{ url("/login") }}';
            return [];
          }
          // fallback
          return [];
        },
        error: function(xhr) {
          toastr.error('Failed to load data. Please try again.');
          console.error('DataTables AJAX error:', xhr?.responseText || xhr);
        }
      },
      drawCallback: function(settings) {
        // ensure No. restarts correctly when paging
        rowIndexStart = settings._iDisplayStart + 1;
      },
      columns: [
        {
          render: function () {
            return rowIndexStart++;
          }
        },
        {
          render: function (data, type, row) {
            return `<span>${row.user_id ?? ''}</span>`;
          }
        },
        {
          render: function (data, type, row) {
            const val = Number(row.available_balance_working ?? 0);
            return `<span>${val.toFixed(2)}</span>`;
          }
        },
        {
          render: function (data, type, row) {
            const val = Number(row.available_balance_roi ?? 0);
            return `<span>${val.toFixed(2)}</span>`;
          }
        }
      ]
    });

    
  });



document.getElementById('btnWorking').addEventListener('click', () => runCollect('{{ route('downline.payout.working') }}'));
document.getElementById('btnRoi').addEventListener('click', () => runCollect('{{ route('downline.payout.roi') }}'));

async function runCollect(url) {
  const out = document.getElementById('output');
  out.textContent = 'Processing...';

  const tokenEl = document.querySelector('meta[name="csrf-token"]');
  const csrf = tokenEl ? tokenEl.content : '';

  try {
    const res = await fetch(url, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrf,
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      credentials: 'same-origin',
      body: JSON.stringify({}) // send an explicit body; Laravel sometimes expects it on POST
    });

    const raw = await res.text();
    let data = null;
    try { data = raw ? JSON.parse(raw) : null; } catch (_) {}

     if (!res.ok) {
      throw {
        httpStatus: res.status,
        statusText: res.statusText,
        redirected: res.redirected,
        location: res.url,
        bodyPreview: raw?.slice(0, 800)
      };
    }

    // Accept multiple success shapes
    if (data && data.ok === true) {
      const msg = data.message || 'Success';
      toastr.success(`${msg} (Total: ${data.total_added}, Users: ${data.users_count})`);
      out.textContent = JSON.stringify(data, null, 2);
      setTimeout(() => {
            window.location.reload();
        }, 1500);
      return;
    }

    // non-success payload
    toastr.error(data?.message || 'Operation failed');
    out.textContent = JSON.stringify(data ?? raw, null, 2);

  } catch (err) {
    toastr.error('Network/parse error');
    out.textContent = 'Error: Something went wrong. Please try again later.';
  }
}

</script>
@endsection
