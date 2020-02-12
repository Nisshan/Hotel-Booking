<section>
    <div class="facilities-title" data-aos="fade-up">
        <p>{{__('Facilities/Services')}}</p>
        <h5>{{__('Our Hotel')}} <span class="green-text"> {{__('Facilities')}}</span></h5>
    </div>

    <div id="facilities" class="owl-carousel owl-theme">
        @foreach($facilities as $facility)
        <div class="item" data-aos="zoom-in">
            <div class="facilities-content">
                <div class="facilities-image">
                    <img src="{{asset($facility->getFirstMedia('services')->getUrl())}}" alt="Author image" />
                </div>

                <div class="facilities-text-overlay">
                    <p class="white-text">{{$facility->name}}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="view-all">
        <a href="/" class="btn">{{__('View All')}}</a>
    </div>
</section>
