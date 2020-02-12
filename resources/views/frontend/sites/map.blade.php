<!--Map Section-->
<section
    id="map-section"
    style="background-image: url({{asset('images/worldMap.png')}});">
    <div class="address-section">
        <div class="address-section-title" data-aos="fade-up">
            <h4>{{__('Find Us')}} <span class="green-text">{{__('Now')}}</span></h4>
        </div>
        <div id="map" data-aos="fade-down">
            <div class="mapouter">
                <div class="gmap_canvas">
                     {!!setting('mapframe')!!}
                </div>
            </div>
        </div>
        <div class="address-details" data-aos="fade-up">
            <h6>{{__('Contact Us')}}</h6>
            @if(setting('email') != NULL)
                <div>
                    <p>{{__('Address')}}</p>
                    <p>{{setting('address')}}</p>
                </div>
            @endif
            @if(setting('email') != NULL)
                <div>
                    <p>{{__('E-Mail')}}</p>
                    <p>{{setting('email')}}</p>
                </div>
            @endif
            @if(setting('phone_number') != NULL)
                <div>
                    <p>{{__('Phone')}}</p>
                    <p>{{setting('phone_number')}}</p>
                </div>
            @endif
            @if(setting('telephone') != NULL)
                <div>
                    <p>{{__('Telephone')}}</p>
                    <p>{{setting('telephone')}}</p>
                </div>
            @endif
        </div>
    </div>
</section>
