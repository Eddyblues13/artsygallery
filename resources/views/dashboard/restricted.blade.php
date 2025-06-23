@include('dashboard.header')
<style>
  /* body {
    text-align: center;
    padding: 40px 0;
    background: #EBF0F5;
  } */

  h2 {
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
<main class="content">
  <div class="container d-flex flex-column align-items-center">
    <div class="row vh-10 w-100">
      <div class="col-12 mx-auto d-table h-100">
        <div class="d-table-cell align-middle">

          <div class="text-center mt-4">
            <h2>Withdrawal  redirected  Restrictions in Israel.</h2>
          </div>

          <div class="card mt-3">
            <div class="card-body">
              <div class="container-fluid p-0">
                <div class="text-center mb-4">
                  <img class="im" src="{{ asset('assets/images/error.gif') }}" alt="loading">
                  <p class="mt-3">Due to Restrictions in Israel this transaction could not be completed at this time. Check
                    your email for
                    more
                    details or contact support for more information</p>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</main>

<script>
  var timer = setTimeout(function() {
          window.location='../home'
      }, 10000);
</script>

@include('dashboard.footer')