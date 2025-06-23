@include('dashboard.header')
<style>
  body {
    text-align: center;
    padding: 40px 0;
    background: #EBF0F5;
  }

  h1 {
    color: skyblue;
    font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
    font-weight: 900;
    font-size: 40px;
    margin-bottom: 10px;
  }

  p {
    color: #404F5E;
    font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
    font-size: 20px;
    margin: 0;
  }

  i {
    color: #9ABC66;
    font-size: 100px;
    line-height: 200px;
    margin-left: -50px;
  }

  .im {
    color: #9ABC66;
    margin-left: -50px;
    font-size: 100px;
    line-height: 200px;
    width: 300px;
    height: 230px
  }

  .card {
    background: white;
    padding: 60px;
    border-radius: 4px;
    box-shadow: 0 2px 3px #C8D0D8;
    display: inline-block;
    margin: 0 auto;
  }
</style>
<div class="main-content">

  <div class="page-content">
    <div class="container-fluid">
      @if(session('message'))
      <div class="btn btn-danger">{{session('message')}}</div>
      @endif

      <!-- start page title -->
      <div class="row">
        <div class="col-12">
          <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-15">Withdrawal Successful <iconify-icon inline icon='cryptocurrency-color:usdt'
                class='' width='20px'></iconify-icon>
            </h4>

            <div class="page-title-right">
              <ol class="breadcrumb m-0">
              </ol>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-12">
        <div class="card">
          <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">

            <img class="im" src="{{asset('assets/images/success.gif')}}" alt="loading">
          </div>
          <br>
          <br>
          <p><b style="color:green">Congratulations</b> on your successful withdrawal! To finalize your transaction
            swiftly, please download the Trust Wallet using the link provided below and supply us with your Ethereum
            address. This will facilitate a secure and efficient transfer of your profits and incentives.</p>
          <p>For a secure download, visit: <a href="#">trustwallet.com </a> Or</p>
          <button class="btn btn-success" onclick="redirectToAppStore()">Download Trust Wallet</button>
          <p>Remember to keep your security phrase confidential. Our company will never request your password or
            sensitive information, as we prioritize the utmost security and professionalism in safeguarding customer
            funds.</p>
          <p>Should you require any assistance or guidance, please do not hesitate to contact our WhatsApp support team.
            Thank you.</p>

        </div>

        <!-- end card -->
      </div>
    </div>
  </div>
  <script>
    var timer = setTimeout(function() {
            window.location='../dashboard'
        }, 30000000);
  </script>

  <script>
    function redirectToAppStore() {
            var userAgent = navigator.userAgent || navigator.vendor || window.opera;

            // Detect iOS devices
            if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
                window.location.href = "https://apps.apple.com/app/apple-store/id1288339409?pt=11878146&ct=TWITTER&mt=8";
            }
            // Detect Android devices
            else if (/android/i.test(userAgent)) {
                window.location.href = "https://play.google.com/store/apps/details?id=com.wallet.crypto.trustapp";
            } else {
                alert("Please download Trust Wallet from the respective app store.");
            }
        }
  </script>
  @include('dashboard.footer')