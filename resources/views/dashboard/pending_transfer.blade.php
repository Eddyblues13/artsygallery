@include('dashboard.header')
<div class="main-content">

<div class="page-content" style="float:center;">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">All Pennding Transaction</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->



             <div class="col-lg-12">
                <div class="card" style="border-top-left-radius:20px; border-top-right-radius: 20px;">
                    <div class="card-body" style="border-radius-right: 100px;">
                        <h4 class="card-title mb-4">Pending Transactions</h4>
                         
                         <div class="table-responsive">
                            <table class="table align-middle table-nowrap">
                                <tbody>
                                No Record Found                                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@include('dashboard.footer')
