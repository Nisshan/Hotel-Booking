<!--Testimonials Section-->
<section>
    <div class="testimonial-title" data-aos="fade-up">
        <p>Testimonial</p>
        <h5>Our Happy <span class="green-text"> Clients</span></h5>
    </div>

    <div id="testimonial" class="owl-carousel owl-theme">
        @foreach($testimonials as $testimony)
        <div class="item" data-aos="zoom-in">
            <div class="testimonial-content">
                <div class="cd-author">
                    <img
                        class="author"
                        src="{{asset($testimony->getFirstMedia('testimony')->getUrl('thumb'))}}"
                        alt="{{$testimony->name}}"
                    />
                    <p>{{$testimony->name}}</p>

                    <p id="quote">
                        <i class="fas fa-quote-left"></i>
                        {{$testimony->description}}

                        <i class="fas fa-quote-right"></i>
                    </p>
                    <span id="rating">
                <i class="material-icons yellow-text">star</i>
                <i class="material-icons yellow-text">star</i>
                <i class="material-icons yellow-text">star</i>
                <i class="material-icons yellow-text">star</i>
                <i class="material-icons yellow-text">star</i>
              </span>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</section>
