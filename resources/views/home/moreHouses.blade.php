@include('home.header')
    
                 <!-- Property List Start -->
                 <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-0 gx-5 align-items-end">
                    <div class="col-lg-6">
                        <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                            <h1 class="mb-3">Property Listing</h1>
                            <a  class="border-bottom d-block" style="color: black;"  href="#">View All 3599 New Listings</a>
                        </div>
                    </div>
                </div>
               
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                        @foreach($trendingHouses as $house)
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href="{{ url('/house-details/'.$house->country->slug).'/'.$house->slug.'/'.$house->id}}"><img class="img-fluid" src="{{asset($house->houseImages[0]->image)}}" alt=""></a>
                                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">{{$house->status}}</div>
                                  
                                    </div>
                                    <div class="p-4 pb-0">
                                        <h5 class="text-primary mb-3">${{number_format($house->selling_price, 2, '.', ',')}}</h5>
                                        <a class="d-block h5 mb-2" href="#">{{$house->name}}</a>
                                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{$house->address}}, {{$house->state}}</p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i>{{$house->square}} Sqft</small>
                                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i>{{$house->bed}} Bed</small>
                                        <small class="flex-fill text-center py-2"><i class="fa fa-bath text-primary me-2"></i>{{$house->bath}} Bath</small>
                                    </div>
                                </div>
                            </div>
                               @endforeach   
                        </div>
                    </div>
                 </div>
          
            </div>
        </div>
        <!-- Property List End -->

@include('home.footer')