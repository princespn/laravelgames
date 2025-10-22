@extends('layouts.user_type.admin-app')
@section('content')

    <div class="admin-card">
        <div class="admin-card-body">
            <div class="row">
                <div class="col-md-12">
                  <h4 class="page-title">Edit Profile</h4>
                </div>
                <div class="col-md-12 col-sm-3">
                    <a class="btn btn-primary waves-effect waves-light pull-right" href="{{url('/1Rto5efWp86Z/user/manage-user-account')}}">
                        <i class="fa fa-mail-reply"></i> &nbsp;Back
                    </a>
                </div>
                <div class="col-md-12">
                    <div v-if="profileotpstatus == 1">
                      <button type="button" class="btn btn-primary waves-effect waves-light" onclick="sendAdminOtp(3)"> Send Otp </button>
                      <p>Note :- Otp Valid 2 Hours</p>
                    </div>
                </div>
            </div>
              
              
                  <form class="row g-3"  id="updatefrm"  name="updatefrm">
                    <div class="col-md-12">
                      <h4>Personal Information</h4>
                    </div>
                    <input type="hidden" name="id" value="{{$editUser['id']}}" />
                    <div class="col-md-6">
                        <label> Station ID </label>
                        <input class="admin-form-control" placeholder="Station ID" <?php if($editUser['old_user_id'] != ''){ ?> readonly title="Username can change only once." <?php } ?> type="text"  name="user_id" value="{{$editUser['user_id']}}" />
                        <input class="admin-form-control" type="hidden"  name="old_user_id" value="{{$editUser['user_id']}}" />
                    </div>
                    <div class="col-md-6">
                        <label> Sponsor  ID </label>
                        <input class="admin-form-control" placeholder="Sponsor  ID" readonly type="text" name ="ref_user_id" value="{{$editUser['ref_user_id']}}" />
                    </div>
                    <div class="col-md-6">
                        <label> Full Name </label>
                        <input name="fullname" class="admin-form-control" placeholder="Update Full Name" type="text" value="{{$editUser['fullname']}}" />
                    </div>
                    <div class="col-md-6">
                        <label> Mobile </label>
                        <input name="mobile" class="admin-form-control" id="mobile" placeholder="Enter Mobile" required type="text" value="{{$editUser['mobile']}}" />
                    </div>
                    <div class="col-md-6">
                        <label> Email </label>
                        <input class="admin-form-control" name="email" required placeholder="Update Email" type="text" value="{{$editUser['email']}}" />
                    </div>
                      <!-- <div class="col-md-6">
                        <label> Bitcoin </label>
                         <div class="input-group">

                         <span class="input-group-text">
                      <img src="{{asset('/admin-assets/images/payment-mode/bitcoin.png')}}" width="25">
                    </span>
                        <input class="admin-form-control" name="btc_address"  placeholder="Bitcion Address" type="text" value="{{$editUser['btc_address']}}"  v-on:input="checkBTCAddress" minlength="26" maxlength="50"  />
                      </div>
                        
                    </div> -->
                      <!-- <div class="col-md-6">
                        <label> Tron </label>
                         <div class="input-group">

                          <span class="input-group-text">
                      <img src="{{asset('/admin-assets/images/payment-mode/tron.png')}}" width="25">
                    </span>
                        <input class="admin-form-control" name="trn_address"  placeholder="Tron Address" type="text" value="{{$editUser['trn_address']}}"  maxlength="50" v-on:input="checkTRXAddress(1)" />
                      </div>
                       
                    </div> -->
                      <!-- <div class="col-md-6">
                        <label> Ethereum </label>
                         <div class="input-group">
                        <span class="input-group-text">
                      <img src="{{asset('/admin-assets/images/payment-mode/Ethereum.png')}}" width="25">
                    </span>
                        <input class="admin-form-control" name="ethereum"  placeholder="Ethereum Address" type="text" value="{{$editUser['ethereum']}}"  maxlength="50" v-on:input="checkETHAddress" />
                      </div>
                       
                    </div> -->
                     <!-- <div class="col-md-6">
                        <label> DOGE </label>
                         <div class="input-group">
                        <span class="input-group-text">
                      <img src="{{asset('/admin-assets/images/payment-mode/Dogecoin.png')}}" width="25">
                    </span>
                        <input class="admin-form-control" name="doge_address"  placeholder="Doge Address" type="text" value="{{$editUser['doge_address']}}"  maxlength="50" v-on:input="checkDOGEAddress"/>
                      </div>
                      
                    </div> -->
                     <!-- <div class="col-md-6">
                        <label> LTC </label>
                         <div class="input-group">
                           <span class="input-group-text">
                      <img src="{{asset('/admin-assets/images/payment-mode/litecoin.png')}}" width="25">
                    </span>
                        <input class="admin-form-control" name="ltc_address"  placeholder="Ltc Address" type="text" value="{{$editUser['ltc_address']}}" maxlength="50" v-on:input="checkLTCAddress"/>
                      </div>
                      
                    </div> -->
                     <!-- <div class="col-md-6">
                        <label> SOL </label>
                         <div class="input-group">
                        <span class="input-group-text">
                      <img src="{{asset('/admin-assets/images/payment-mode/solana.png')}}" width="25">
                    </span>
                        <input class="admin-form-control" name="sol_address"  placeholder="Sol Address" type="text" value="{{$editUser['sol_address']}}" maxlength="50" v-on:input="checkSolAddress" />
                      </div>
                        
                    </div> -->
                    {{--  <div class="col-md-6">
                        <label> MATIC </label>
                         <div class="input-group">
                       <span class="input-group-text">
                          <img src="{{asset('/admin-assets/images/payment-mode/payment_matic.png')}}" width="25">
                        </span>
                        <input class="admin-form-control" name="matic_address"  placeholder="MATIC Address" type="text" id="matic_address" maxlength="50" value="{{$editUser['matic_address']}}" onblur="validateMaticAddress()" />
                      </div>
                      </div> --}}
                       <div class="col-md-6">
                        <label> USDT.BEP20 </label>
                         <div class="input-group">
                       <span class="input-group-text">
                          <img src="{{asset('/admin-assets/images/payment-mode/payment_theaterh.png')}}" width="25">
                        </span>

                        <input class="admin-form-control" name="usdt_bep20_address"  placeholder="USDT.BEP20 Address" type="text" maxlength="50" value="{{$editUser['usdt_bep20_address']}}" id="usdt_bep20_address" onblur="validateUSDTBEPAddress()" />
                      </div> 
                      </div>
                           
                    

                    <!-- <div class="col-md-6">
                        <label> USDT.ERC20 </label>
                        <div class="input-group">
                          <span class="input-group-text">
                            <img src="{{asset('/admin-assets/images/payment-mode/tether.png')}}" width="25">
                          </span> 

                          <input class="admin-form-control" name="usdt_erc20_address"  placeholder="USDT.ERC20 Address" type="text" maxlength="50" value="{{$editUser['usdt_erc20_address']}}" v-on:input="checkUSDTERCAddress" />
                        </div>
                        
                    </div> -->


                    <!-- <div class="col-md-6">
                        <label> BITCOIN CASH (BCH) </label>
                        <div class="input-group">
                          <span class="input-group-text">
                            <img src="{{asset('/admin-assets/images/payment-mode/BTCC.png')}}" width="25">
                          </span> 

                          <input class="admin-form-control" name="bch_address"  placeholder="BITCOIN CASH (BCH) Address" type="text"  value="{{$editUser['bch_address']}}" />
                        </div>
                        
                    </div> -->


                    <!-- <div class="col-md-6">
                        <label> BEAM </label>
                        <div class="input-group">
                          <span class="input-group-text">
                            <img src="{{asset('/admin-assets/images/payment-mode/BEAM.png')}}" width="25">
                          </span> 

                          <input class="admin-form-control" name="beam_address"  placeholder="BEAM Address" type="text"  value="{{$editUser['beam_address']}}" />
                        </div>
                        
                    </div> -->

                    <!-- <div class="col-md-6">
                        <label> BITCOIN GOLD (BTG) </label>
                        <div class="input-group">
                          <span class="input-group-text">
                            <img src="{{asset('/admin-assets/images/payment-mode/BTG1.png')}}" width="25">
                          </span> 

                          <input class="admin-form-control" name="btg_address"  placeholder="BITCOIN GOLD (BTG) Address" type="text" value="{{$editUser['btg_address']}}" />
                        </div>
                        
                    </div> -->


                    <!-- <div class="col-md-6">
                        <label> MONERO (XMR) </label>
                        <div class="input-group">
                          <span class="input-group-text">
                            <img src="{{asset('/admin-assets/images/payment-mode/XMR.png')}}" width="25">
                          </span> 

                          <input class="admin-form-control" name="xmr_address"  placeholder="MONERO (XMR) Address" type="text"  value="{{$editUser['xmr_address']}}" />
                        </div>
                    </div> -->


                    <!-- <div class="col-md-6">
                        <label> VERGE (XVG) </label>
                        <div class="input-group">
                          <span class="input-group-text">
                            <img src="{{asset('/admin-assets/images/payment-mode/XVG.png')}}" width="25">
                          </span> 

                          <input class="admin-form-control" name="xvg_address"  placeholder="VERGE (XVG) Address" type="text"  value="{{$editUser['xvg_address']}}" />
                        </div>
                        
                    </div> -->
<!-- 
                    <div class="col-md-6">
                        <label> FIRO </label>
                        <div class="input-group">
                          <span class="input-group-text">
                            <img src="{{asset('/admin-assets/images/payment-mode/FIRO.png')}}" width="25">
                          </span> 

                          <input class="admin-form-control" name="firo_address"  placeholder="FIRO Address" type="text"  value="{{$editUser['firo_address']}}" />
                        </div>
                        
                    </div> -->


                    <!-- <div class="col-md-6">
                        <label> OMNI </label>
                        <div class="input-group">
                          <span class="input-group-text">
                            <img src="{{asset('/admin-assets/images/payment-mode/OMNI.png')}}" width="25">
                          </span> 

                          <input class="admin-form-control" name="omni_address"  placeholder="OMNI Address" type="text"  value="{{$editUser['omni_address']}}" />
                        </div>
                        
                    </div> -->


                    <!-- <div class="col-md-6">
                        <label> BNB Coin </label>
                        <div class="input-group">
                          <span class="input-group-text">
                            <img src="{{asset('/admin-assets/images/payment-mode/BNB.png')}}" width="25">
                          </span> 

                          <input class="admin-form-control" name="bnb_address"  placeholder="BNB Coin Address" type="text" value="{{$editUser['bnb_address']}}" />
                        </div>
                        
                    </div> -->


                    <!-- <div class="col-md-6">
                        <label> ZCASH (ZEN) </label>
                        <div class="input-group">
                          <span class="input-group-text">
                            <img src="{{asset('/admin-assets/images/payment-mode/ZEN.png')}}" width="25">
                          </span> 

                          <input class="admin-form-control" name="zen_address"  placeholder="ZCASH (ZEN) Address" type="text"  value="{{$editUser['zen_address']}}" />
                        </div>
                        
                    </div> -->

                    <!-- <div class="col-md-6">
                        <label> ELECTRONEUM (ETN) </label>
                        <div class="input-group">
                          <span class="input-group-text">
                            <img src="{{asset('/admin-assets/images/payment-mode/ETN.png')}}" width="25">
                          </span> 

                          <input class="admin-form-control" name="etn_address"  placeholder="ELECTRONEUM (ETN) Address" type="text"  value="{{$editUser['etn_address']}}" />
                        </div>
                        
                    </div>
                     -->



                    <div class="col-md-6" v-if="profileotpstatus == 1">
                        <label> Enter Otp </label>
                        <input class="admin-form-control" name="otp" placeholder="otp" type="password" value="" data-vv-as="otp" />
                    </div>
                    <div class="col-md-6">
                        <label> Country </label>
                        
                        <select class="admin-form-control" name="country">
                          <option value="null">Select</option>

                          @foreach($cntry as $c)
                          @if($editUser['country'] == $c->country)
                          <option value="{{$c->iso_code}}"  selected>
                            {{ $c->country }}                          
                          </option>
                          @else
                          <option value="{{$c->iso_code}}"  >
                            {{ $c->country }}                          
                          </option>
                          @endif
                          @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mx-auto mt-5 mb-3 text-center">
                        <button class="btn btn-primary ps-5 pe-5" name="submit" onclick="onUpdateUserClick()" type="button" id="updateAddressBTN">
                          <i class="ace-icon fa fa-check bigger-110"></i> Submit </button>
                      </div>
                  </form>
        </div>
      </div>




<script>
    var base_url = '{{url(' / ')}}'
var csrftoken = $('meta[name="csrf-token"]').attr('content');

function onUpdateUserClick() {

     new Swal({
        title: "Are you sure?",
        text: `You want to update this user`,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
      }).then((result) => {
        if (result.value) {
                    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrftoken
            }
        });
                    $.ajax({

                    url: "{{url('/1Rto5efWp86Z/user/update-profile')}}",
                    type: 'POST',
                    cache:false,
                    data: $('#updatefrm').serialize(),
                   
                    success: function(resp) {
                    if (resp.code === 200) {
                    window.location.href = "{{url('1Rto5efWp86Z/user/manage-user-account')}}";
                    // Show success message using a toast library
                    toastr.success(resp.message);
                    } else {
                    // Show error message using a toast library
                    toastr.error(resp.message);
                    }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                    // Show error message using a toast library
                    toastr.error('An error occurred while updating the user profile.');
                    }
                    });

                }
            })
            
        }

        function validateMaticAddress(){      
        var csrf_token = "{{ csrf_token() }}";
        var data = {"matic_address" : $('#matic_address').val()};
        if ($('#matic_address').val() == '') {
            $('#updateAddressBTN').prop('disabled', false);
            return false;
        }
        $('#updateAddressBTN').prop('disabled', true);
        $.ajax({
            url: "{{ url('/validateMATICAddress') }}",
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf_token
            },
            data: data,
            success: function(response) {
                if(response.code == 200)
                {
                    toastr.success(response.message);
                    $('#updateAddressBTN').prop('disabled', false);
                }
                else{
                    $('#matic_address_error').show();
                    toastr.error(response.message);                    
                }
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    }

        function validateUSDTBEPAddress(){      
        var csrf_token = "{{ csrf_token() }}";
        var data = {"usdt_bep20_address" : $('#usdt_bep20_address').val()};

        if(data.usdt_bep20_address.startsWith('0x')) {
                if ($('#usdt_bep20_address').val() == ' ') {
                    $('#updateAddressBTN').prop('disabled', false);
                        return false;
                    }
                $('#updateAddressBTN').prop('disabled', true);
                $.ajax({
                    url: "{{ url('/validateUSDTBEPAddress') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrf_token
                    },
                    data: data,
                    success: function(response) {
                        if(response.code == 200)
                        {
                            toastr.success(response.message);
                            $('#updateAddressBTN').prop('disabled', false);
                        }
                        else{
                            toastr.error(response.message);                    
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
        } else {
            $('#updateAddressBTN').prop('disabled', true);
            toastr.error("Address Must start with 0x");
        }
        
    }
     

    function checkTRXAddress(addFor) {
      var trx_address = "";
      if (addFor == "1") {
        trx_address = "" + this.editUser.trn_address + "";
      } else {
        trx_address = "" + this.editUser.tether_address + "";
      }
      if (trx_address.charAt(0) == 't' || trx_address.charAt(0) == 'T' || trx_address == '') {
        this.trxactive = true;
        this.tetheractive = true;
        this.trxmsg = "";
        this.tethermsg = "";
        if (addFor == 1) {
          if (trx_address.length < 26 || trx_address.length > 50) {
            this.trxactive = false;
            this.trxmsg = "TRON Address length should be 26 to 50 characters";
          }
        } else {
          if (trx_address.length < 26 || trx_address.length > 50) {
            this.tetheractive = false;
            this.tethermsg = "TETHER Address length should be 26 to 50 characters";
          }
        }
      } else {
        if (addFor == 1) {
          this.trxactive = false;
          this.trxmsg = "TRON Address should be start with 'T or t'";
        } else {
          this.tetheractive = false;
          this.tethermsg = "Tether Address should be start with 'T or t'";
        }
      }
    }


  function  checkDOGEAddress() {
      let doge_address = "" + this.editUser.doge_address + "";
      if (doge_address.charAt(0) == 'D'  || doge_address == '') {
        this.dogeactive = true;
        this.dogemsg = "";
        if (doge_address.length < 26 || doge_address.length > 50) {
          this.dogeactive = false;
          this.dogemsg = "DOGE Address length should be 26 to 50 characters";
        }
      } else {
        this.dogeactive = false;
        this.dogemsg = "DOGE Address should be start with 'D'";
      }
    }

    function  checkLTCAddress() {
      let ltc_address = "" + this.editUser.ltc_address + "";
      if (ltc_address.charAt(0) == 'L' || ltc_address.charAt(0) == 'l' || ltc_address.charAt(0) == 'M' || ltc_address.charAt(0) == 'm' ||ltc_address == '') {
        this.rippleactive = true;
        this.ripplemsg = "";
        if (ltc_address.length < 26 || ltc_address.length > 50) {
          this.rippleactive = false;
          this.ripplemsg = "LTC Address length should be 26 to 50 characters";
        }
      } else {
        this.rippleactive = false;
        this.ripplemsg = "LTC Address should be start with 'L','l' or 'M','m'";
      }
    }


    function  checkSolAddress() {
      let sol_address = "" + this.editUser.sol_address + "";
      if (sol_address.charAt(0) == 's' || sol_address == '') {
        this.solanactive = true;
        this.solmsg = "";
        if (sol_address.length < 26 || sol_address.length > 50) {
          this.solanactive = false;
          this.solmsg = "Solana Address length should be 26 to 50 characters";
        }
      } else {
        this.solanactive = false;
        this.solmsg = "Solana Address should be start with 's'";
      }
    }
    function checkUSDTAddress() {
      let usdt_trc20_address = "" + this.editUser.usdt_trc20_address + "";
      if (usdt_trc20_address.charAt(0) == 't' || usdt_trc20_address.charAt(0) == 'T') {
        this.usdtactive = true;
        this.usdtmsg = "";
        if (usdt_trc20_address.length < 26 || usdt_trc20_address.length > 50) {
          this.usdtactive = false;
          this.usdtmsg = "USDT_TRC20 Address length should be 26 to 50 characters";
        }
      } else {
        this.usdtactive = false;
        this.usdtmsg = "USDT_TRC20 Address should be start with 't' or 'T'";
      }
    }

    

    
    function checkETHAddress() {
      let ethereum_address = "" + this.editUser.ethereum + "";
      if ((ethereum_address.charAt(0) == '0') && (ethereum_address.charAt(1) == 'x')) {
        this.ethereumactive = true;
        this.ethereummsg = "";
        if (ethereum_address.length < 26 || ethereum_address.length > 50) {
          this.ethereumactive = false;
          this.ethereummsg = "ETH Address length should be 26 to 50 characters";
        }
      } else {
        this.ethereumactive = false;
        this.ethereummsg = "ETH Address should be start with '0x'";
      }
    }
    function checkUSDTERCAddress() {
      let usdt_erc20_address = "" + this.editUser.usdt_erc20_address + "";
      if ((usdt_erc20_address.charAt(0) == '0') && (usdt_erc20_address.charAt(1) == 'x')) {
        this.usdt_erc_active = true;
        this.usdt_erc_msg = "";
        if (usdt_erc20_address.length < 26 || usdt_erc20_address.length > 50) {
          this.usdt_erc_active = false;
          this.usdt_erc_msg = "USDT_ERC20 Address length should be 26 to 50 characters";
        }
      } else {
        this.usdt_erc_active = false;
        this.usdt_erc_msg = "USDT_ERC20 Address should be start with '0x'";
      }
    }
    function checkBTCAddress() {
      let btc_address = "" + this.editUser.btc_address + "";
      if (btc_address.charAt(0) == 'b' || btc_address.charAt(0) == '1' || btc_address.charAt(0) == '3') {
        this.btcactive = true;
        this.btcmsg = "";
        if (btc_address.length < 26 || btc_address.length > 50) {
          this.btcactive = false;
          this.btcmsg = "BTC Address length should be 26 to 50 characters";
        }
      } else {
        this.btcactive = false;
        this.btcmsg = "BTC Address should be start with 'b', '1' or '3'";
      }
    }

</script>

@endsection
