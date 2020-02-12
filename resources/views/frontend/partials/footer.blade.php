<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="footer-contact-details col s12 l4 xl4">
                <h5>{{setting('app_name')}}</h5>
                <ul class="quick-links">
                    @if(setting('address'))
                        <li>
                            <a href="javascript:void(0);"
                            ><i class="fas fa-home mr-3"></i> {{setting('address')}}</a
                            >
                        </li>
                    @endif
                    @if(setting('email'))
                        <li>
                            <a href="javascript:void(0);"
                            ><i class="fas fa-envelope mr-3"></i>{{setting('email')}}</a
                            >
                        </li>
                    @endif
                    @if(setting('telephone'))
                        <li>
                            <a href="javascript:void(0);"
                            ><i class="fas fa-phone mr-3"></i>{{setting('telephone')}}</a
                            >
                        </li>
                    @endif
                    @if(setting('phone_number'))
                        <li>
                            <a href="javascript:void(0);"
                            ><i class="fas fa-mobile mr-3"></i> +81-805-5563-890</a
                            >
                        </li>
                    @endif
                </ul>
            </div>
            @if(setting('about') == 1)
            <div class="footer-aboutUs col s12 l4 xl4">
                <h5>{{__('About Us')}}</h5>
                <p>
                    {{setting('about_us')}}
                </p>
            </div>
            @endif
            <div class="col s12 l4 xl4">
                <h5>{{__('Links')}}</h5>
                <ul class="quick-links">
                    <li>
                        <a href="index.html"
                        ><i class="fa fa-hand-o-right" aria-hidden="false"></i>
                            {{__('Home')}}</a
                        >
                    </li>
                    <li>
                        <a href="Rooms.html"
                        ><i class="fa fa-hand-o-right" aria-hidden="true"></i>
                            {{__('Rooms')}}</a
                        >
                    </li>
                    <li>
                        <a href="servicesAndFacilities.html"
                        ><i class="fa fa-hand-o-right" aria-hidden="true"></i>
                            {{__('Facilities')}}</a
                        >
                    </li>
                    <li>
                        <a href="menu.html"
                        ><i class="fa fa-hand-o-right" aria-hidden="true"></i> {{__('Gokyo
                            Delicatessen')}}</a
                        >
                    </li>
                </ul>
            </div>
        </div>

        <div class="col s12 l12 xl12">
            <ul class="social center">
                @if(setting('twitter_link'))
                    <li>
                        <a href="{{setting('twitter_link')}}"><i class="fab fa-twitter"></i></a>
                    </li>
                @endif
                @if(setting('facebook_link'))
                    <li>
                        <a href="{{setting('facebook_link')}}"><i class="fab fa-facebook-f"></i></a>
                    </li>
                @endif
                @if(setting('email'))
                    <li>
                        <a href="mailto::{{setting('email')}}"   target="_blank"
                        ><i class="fa fa-envelope"></i
                            ></a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</footer>
